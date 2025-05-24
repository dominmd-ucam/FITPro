<?php
session_start();
require_once("../model/gimnasio_model.php");

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['nombre'])) {
    echo json_encode(['success' => false, 'message' => 'No hay sesión activa'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Obtener los datos del POST
$data = json_decode(file_get_contents('php://input'), true);
$clase_id = $data['clase_id'] ?? null;
$fecha = $data['fecha'] ?? date('Y-m-d');

error_log("Datos recibidos - Clase ID: " . $clase_id . ", Fecha: " . $fecha);

if (!$clase_id) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos necesarios'], JSON_UNESCAPED_UNICODE);
    exit;
}

$modelo = new Gimnasio_model();

// Obtener el ID del usuario actual
$nombre_usuario = $_SESSION['nombre'];
$sql = "SELECT id_usuario FROM usuarios WHERE nombre = ?";
$stmt = $modelo->db->prepare($sql);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
$usuario_id = $usuario['id_usuario'];

error_log("ID de usuario: " . $usuario_id);

// Obtener el horario_id por defecto para la clase
$sql = "SELECT id FROM horarios WHERE clase_id = ? LIMIT 1";
$stmt = $modelo->db->prepare($sql);
$stmt->bind_param("i", $clase_id);
$stmt->execute();
$resultado = $stmt->get_result();
$horario = $resultado->fetch_assoc();
$horario_id = $horario['id'];

error_log("Horario ID obtenido: " . $horario_id);

// Verificar si ya está inscrito para esa fecha
$sql = "SELECT id FROM inscripciones WHERE usuario_id = ? AND clase_id = ? AND fecha_inscripcion = ?";
$stmt = $modelo->db->prepare($sql);
$stmt->bind_param("iis", $usuario_id, $clase_id, $fecha);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Ya estás inscrito en esta clase para esta fecha'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Insertar la inscripción con la fecha específica
$sql = "INSERT INTO inscripciones (usuario_id, clase_id, horario_id, fecha_inscripcion) VALUES (?, ?, ?, ?)";
$stmt = $modelo->db->prepare($sql);
$stmt->bind_param("iiis", $usuario_id, $clase_id, $horario_id, $fecha);

error_log("Intentando insertar inscripción - Usuario: $usuario_id, Clase: $clase_id, Horario: $horario_id, Fecha: $fecha");

if ($stmt->execute()) {
    // Obtener los datos de la clase recién inscrita
    $sql = "SELECT c.nombre as clase_nombre, h.hora_inicio, h.hora_fin 
            FROM clases c 
            JOIN horarios h ON c.id = h.clase_id 
            WHERE c.id = ? AND h.id = ?";
    $stmt = $modelo->db->prepare($sql);
    $stmt->bind_param("ii", $clase_id, $horario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $clase_data = $resultado->fetch_assoc();

    error_log("Inscripción exitosa - Datos de la clase: " . print_r($clase_data, true));

    echo json_encode([
        'success' => true, 
        'message' => 'Inscripción realizada con éxito',
        'clase_nombre' => $clase_data['clase_nombre'],
        'hora_inicio' => date('H:i', strtotime($clase_data['hora_inicio'])),
        'hora_fin' => date('H:i', strtotime($clase_data['hora_fin']))
    ], JSON_UNESCAPED_UNICODE);
} else {
    error_log("Error en la inserción: " . $stmt->error);
    echo json_encode(['success' => false, 'message' => 'Error al realizar la inscripción: ' . $stmt->error], JSON_UNESCAPED_UNICODE);
}
?> 