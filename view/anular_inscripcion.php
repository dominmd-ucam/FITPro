<?php
// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/php_errors.log');

// Asegurar que el directorio de logs existe
if (!file_exists(__DIR__ . '/../logs')) {
    mkdir(__DIR__ . '/../logs', 0777, true);
}

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

// Función para enviar respuesta JSON
function sendJsonResponse($success, $message) {
    $response = [
        'success' => $success,
        'message' => $message
    ];
    error_log("Enviando respuesta: " . json_encode($response));
    echo json_encode($response);
    exit;
}

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Log para depuración
error_log("Estado de la sesión: " . print_r($_SESSION, true));

// Verificar si hay una sesión activa y si el usuario está logueado
if (!isset($_SESSION['email'])) {
    error_log("No hay email en la sesión");
    sendJsonResponse(false, 'No hay sesión activa');
}

try {
    // Obtener el ID de la inscripción del cuerpo de la petición
    $input = file_get_contents('php://input');
    error_log("Input recibido: " . $input);
    
    $data = json_decode($input, true);
    error_log("Datos decodificados: " . print_r($data, true));
    
    if (!isset($data['inscripcion_id'])) {
        throw new Exception('ID de inscripción no proporcionado');
    }
    
    $inscripcion_id = $data['inscripcion_id'];
    $email = $_SESSION['email'];
    
    error_log("Email: " . $email);
    error_log("Inscripción ID: " . $inscripcion_id);
    
    // Conectar a la base de datos
    $db_path = __DIR__ . '/../model/conectar.php';
    error_log("Intentando cargar conectar.php desde: " . $db_path);
    
    if (!file_exists($db_path)) {
        error_log("El archivo no existe en la ruta: " . $db_path);
        throw new Exception('No se pudo encontrar el archivo de conexión a la base de datos');
    }
    
    require_once $db_path;
    $conexion = Conectar::conexion();
    
    // Primero obtener el ID del usuario basado en el email
    $sql = "SELECT id_usuario FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error al preparar la consulta: ' . $conexion->error);
    }
    
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
    }
    
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 0) {
        throw new Exception('Usuario no encontrado');
    }
    
    $usuario = $resultado->fetch_assoc();
    $usuario_id = $usuario['id_usuario'];
    
    error_log("Usuario ID encontrado: " . $usuario_id);
    
    // Verificar que la inscripción pertenece al usuario
    $sql = "SELECT * FROM inscripciones WHERE id = ? AND usuario_id = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error al preparar la consulta: ' . $conexion->error);
    }
    
    $stmt->bind_param("ii", $inscripcion_id, $usuario_id);
    if (!$stmt->execute()) {
        throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
    }
    
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 0) {
        throw new Exception('No tienes permiso para anular esta inscripción');
    }
    
    // Eliminar la inscripción
    $sql = "DELETE FROM inscripciones WHERE id = ? AND usuario_id = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error al preparar la consulta: ' . $conexion->error);
    }
    
    $stmt->bind_param("ii", $inscripcion_id, $usuario_id);
    if (!$stmt->execute()) {
        throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
    }
    
    error_log("Inscripción eliminada correctamente");
    sendJsonResponse(true, 'Inscripción anulada correctamente');
    
} catch (Exception $e) {
    error_log("Error en anular_inscripcion.php: " . $e->getMessage());
    sendJsonResponse(false, $e->getMessage());
} 