<?php
session_start();
require_once("../model/gimnasio_model.php");

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['nombre'])) {
    echo json_encode(['error' => 'No hay sesión activa'], JSON_UNESCAPED_UNICODE);
    exit;
}

$dia = $_GET['dia'] ?? '';
$fecha = $_GET['fecha'] ?? date('Y-m-d');

error_log("Día recibido: " . $dia);
error_log("Fecha recibida: " . $fecha);

if (empty($dia)) {
    echo json_encode(['error' => 'Día no especificado'], JSON_UNESCAPED_UNICODE);
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

// Obtener las clases disponibles para ese día
$sql = "SELECT c.id, c.nombre, h.id as horario_id, h.hora_inicio, h.hora_fin, e.nombre as nombre_entrenador
        FROM clases c 
        JOIN horarios h ON c.id = h.clase_id 
        JOIN entrenadores e ON c.entrenador_id = e.id 
        WHERE h.dia_semana = ? 
        ORDER BY h.hora_inicio";

$stmt = $modelo->db->prepare($sql);
$stmt->bind_param("s", $dia);
$stmt->execute();
$resultado = $stmt->get_result();

$clases = array();
while($row = $resultado->fetch_assoc()) {
    $clases[] = $row;
}

error_log("Número de clases encontradas: " . count($clases));
error_log("Clases: " . print_r($clases, true));

echo json_encode($clases, JSON_UNESCAPED_UNICODE);
?> 