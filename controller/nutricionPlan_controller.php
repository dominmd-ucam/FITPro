<?php

function home(){
    require_once("model/gimnasio_model.php");
    $datos = new Gimnasio_model();
    
    // Obtener el plan nutricional del usuario actual
    $plan_nutricional = $datos->get_plan_nutricional_by_id($_SESSION['nombre']);
    
    // Si no hay plan nutricional, inicializar las variables como null
    $dieta_diaria = null;
    $info_nutricional = null;
    
    // Solo obtener la dieta y la información nutricional si existe un plan
    if ($plan_nutricional) {
        // Obtener la dieta diaria del plan
        $dieta_diaria = $datos->get_dieta_by_plan($plan_nutricional['id']);
        
        // Obtener información nutricional total
        $info_nutricional = $datos->get_info_nutricional_plan($plan_nutricional['id']);
    }
    
    require_once("view/nutricionPlan_view.php");
}

function get_info_nutricional_plan($plan_id) {
    require_once("model/gimnasio_model.php");
    $datos = new Gimnasio_model();
    return $datos->get_info_nutricional_plan($plan_id);
}
?>