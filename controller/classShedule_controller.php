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
    
    require_once("view/classShedule_view.php");
}


?>