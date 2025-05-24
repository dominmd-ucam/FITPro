<?php
session_start();

function home(){
    require_once("model/gimnasio_model.php");
    $datos = new Gimnasio_model();
    
    // Obtener el ID del usuario actual
    $nombre_usuario = $_SESSION['nombre'];
    error_log("Nombre de usuario en el controlador: " . $nombre_usuario);
    
    // Obtener el ID del usuario a partir del nombre
    $sql = "SELECT id_usuario FROM usuarios WHERE nombre = ?";
    $stmt = $datos->db->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $usuario_id = $usuario['id_usuario'];
    
    error_log("ID de usuario obtenido: " . $usuario_id);
    
    // Obtener las clases de hoy y las próximas clases
    $clases_hoy = $datos->get_clases_hoy_usuario($usuario_id);
    error_log("Clases hoy en el controlador: " . print_r($clases_hoy, true));
    
    $proximas_clases = $datos->get_proximas_clases_usuario($usuario_id);
    error_log("Próximas clases en el controlador: " . print_r($proximas_clases, true));
    
    // Obtener todas las inscripciones del usuario
    $inscripciones = $datos->get_inscripciones_usuario($usuario_id);
    error_log("Inscripciones del usuario: " . print_r($inscripciones, true));
    
    // Asegurarse de que todas las clases tengan la descripción
    foreach ($clases_hoy as &$clase) {
        if (!isset($clase['descripcion'])) {
            $clase['descripcion'] = '';
        }
    }
    foreach ($proximas_clases as &$clase) {
        if (!isset($clase['descripcion'])) {
            $clase['descripcion'] = '';
        }
    }
    
    require_once("view/classShedule_view.php");
}


?>