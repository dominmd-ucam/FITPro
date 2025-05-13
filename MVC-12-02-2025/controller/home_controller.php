<?php
session_start();

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

    include_once 'view/home_view.php';
}
?>
