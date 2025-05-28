<?php
// Activar el logging de errores
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/php_errors.log');
error_reporting(E_ALL);

// Obtener la ruta base del proyecto
$base_path = dirname(dirname(__FILE__));
error_log("Ruta base del proyecto: " . $base_path);

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Establecer el header de JSON al principio
header('Content-Type: application/json; charset=utf-8');

try {
    error_log("Iniciando script get_available_classes.php");
    
    // Verificar sesión
    if (!isset($_SESSION['nombre'])) {
        error_log("No hay sesión activa");
        echo json_encode(['error' => 'No hay sesión activa'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    error_log("Sesión verificada correctamente");

    // Cargar el modelo de conexión
    require_once($base_path . "/model/conectar.php");
    $conexion = Conectar::conexion();
    
    if (!$conexion) {
        throw new Exception("No se pudo conectar a la base de datos");
    }
    error_log("Conexión a la base de datos establecida");

    $dia = $_GET['dia'] ?? '';
    $fecha = $_GET['fecha'] ?? date('Y-m-d');

    error_log("Parámetros recibidos - Día: " . $dia . ", Fecha: " . $fecha);

    if (empty($dia)) {
        error_log("Día no especificado");
        echo json_encode(['error' => 'Día no especificado'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Obtener el ID del usuario actual
    $nombre_usuario = $_SESSION['nombre'];
    error_log("Nombre de usuario: " . $nombre_usuario);
    
    $sql = "SELECT id_usuario FROM usuarios WHERE nombre = ?";
    error_log("SQL para obtener usuario: " . $sql);
    
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta de usuario: " . $conexion->error);
    }
    
    $stmt->bind_param("s", $nombre_usuario);
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta de usuario: " . $stmt->error);
    }
    
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    
    if (!$usuario) {
        error_log("Usuario no encontrado: " . $nombre_usuario);
        echo json_encode(['error' => 'Usuario no encontrado'], JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    $usuario_id = $usuario['id_usuario'];
    error_log("ID de usuario obtenido: " . $usuario_id);

    // Obtener las clases disponibles para ese día
    $sql = "SELECT c.id, c.nombre, h.id as horario_id, h.hora_inicio, h.hora_fin, e.nombre as nombre_entrenador
            FROM clases c 
            JOIN horarios h ON c.id = h.clase_id 
            JOIN entrenadores e ON c.entrenador_id = e.id 
            WHERE h.dia_semana = ? 
            ORDER BY h.hora_inicio";

    error_log("SQL para obtener clases: " . $sql);
    error_log("Parámetro día: " . $dia);

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta de clases: " . $conexion->error);
    }
    
    $stmt->bind_param("s", $dia);
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta de clases: " . $stmt->error);
    }
    
    $resultado = $stmt->get_result();
    $clases = array();
    
    while($row = $resultado->fetch_assoc()) {
        $clases[] = $row;
    }

    error_log("Número de clases encontradas: " . count($clases));
    error_log("Clases: " . print_r($clases, true));

    echo json_encode($clases, JSON_UNESCAPED_UNICODE);
    error_log("Respuesta JSON enviada correctamente");
} catch (Exception $e) {
    error_log("Error en get_available_classes.php: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    echo json_encode(['error' => 'Error al obtener las clases: ' . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?> 