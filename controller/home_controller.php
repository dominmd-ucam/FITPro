<?php
// No necesitamos session_start() aquí porque ya se inició en el front_controller

function home() {
    // Si es administrador, cargar los datos del dashboard
    if (isset($_SESSION["nombre"]) && $_SESSION["admin"] == 1) {
        require_once("model/dashboard_model.php");
        $dashboard = new DashboardModel();
        
        $totalMembers = $dashboard->getTotalMembers();
        $activeMembers = $dashboard->getActiveMembers();
        $inactiveMembers = $dashboard->getInactiveMembers();
        $totalRevenue = $dashboard->getTotalRevenue();
        $lastAccessLogs = $dashboard->getLastAccessLogs();
    } 
    // Si es usuario normal, cargar los datos del dashboard de usuario
    else if (isset($_SESSION["nombre"])) {
        require_once("model/dashboard_user_model.php");
        $dashboard = new DashboardUserModel();
        
        // Obtener el ID del usuario actual
        require_once("model/miembros_model.php");
        $miembros = new Miembros_model();
        $usuario_id = $miembros->getUserIdByEmail($_SESSION["email"]);
        
        // Obtener los datos para el dashboard
        $clasesAsignadas = $dashboard->getClasesAsignadas($usuario_id);
        $proximaClase = $dashboard->getProximaClase($usuario_id);
        $estadoMembresia = $dashboard->getEstadoMembresia($usuario_id);
        $ultimosAccesos = $dashboard->getUltimosAccesos($usuario_id);
        $proximasClases = $dashboard->getProximasClases($usuario_id);
    }

    include_once 'view/home_view.php';
}
?>
