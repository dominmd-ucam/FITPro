<?php
session_start();

function home(){
    require_once("model/gimnasio_model.php");
    $datos = new Gimnasio_model();
    
    $array = $datos->get_planes_nutricionales();
    require_once("view/nutricionPlan_view.php");
}


?>