<?php
function console_log($data) {
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

session_start();

const BASE_URL = '/MVC/MVC/';
define('CONTROLLERS_FOLDER', "controller/");
define('DEFAULT_CONTROLLER', "home");
define('DEFAULT_ACTION', "home");

$public_routes = [
    'home_home' => true,
    'miembros_login' => true,
    'miembros_registrar' => true,
    'entrenamientoyconsejo_mostrar' => true,
    'entrenamientoyconsejo_nutricion' => true,
    'entrenamientoyconsejo_homefichas' => true,
    'entrenamientoyconsejo_comunidad' => true,
    'entrenamientoyconsejo_quienes_somos' => true,
    'contactar_contacto' => true
];

function verificarSesionIniciada() {
    return isset($_SESSION['nombre']);
}

// Obtener controlador y acción
$controlador = !empty($_GET['controlador']) ? $_GET['controlador'] : DEFAULT_CONTROLLER;
$action = !empty($_GET['action']) ? $_GET['action'] : DEFAULT_ACTION;

// Comprobar si el archivo del controlador existe
$controller_path = CONTROLLERS_FOLDER . $controlador . '_controller.php';

if (!is_file($controller_path)) {
    require_once 'view/404.php';
    exit();
}

// Requerir el controlador
require_once($controller_path);

// Comprobar si la acción existe
if (!function_exists($action)) {
    require_once 'view/404.php';
    exit();
}

// Comprobar si la acción requiere sesión
$ruta_actual = $controlador . '_' . $action;
$requiere_sesion = !isset($public_routes[$ruta_actual]);

if ($requiere_sesion && !verificarSesionIniciada()) {
    header("Location: index.php?controlador=miembros&action=login");
    exit();
}

// Ejecutar la acción
$action();
