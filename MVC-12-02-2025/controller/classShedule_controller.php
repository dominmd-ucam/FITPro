<?php
session_start();

function home(){
    require_once("model/gimnasio_model.php");
    $datos = new Gimnasio_model();
    
    $array = $datos->get_horarios();
    require_once("view/classShedule_view.php");
}


?>