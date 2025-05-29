<?php
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

// Iniciar la sesión al principio de todo
session_start();

const BASE_URL = '/MVC/MVC/';

// La carpeta donde buscaremos los controladores
define('CONTROLLERS_FOLDER', "controller/");
// Si no se indica un controlador, este es el controlador que se usará por defecto
define('DEFAULT_CONTROLLER', "home");
// Si no se indica una acción, esta acción es la que se usará por defecto
define('DEFAULT_ACTION', "home");

// Lista de rutas públicas que no requieren sesión
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

// Función para verificar la sesión
function verificarSesionIniciada() {
    return isset($_SESSION['nombre']);
}

// Obtenemos el controlador.
// Si el usuario no lo introduce, seleccionamos el de por defecto.
$controlador = DEFAULT_CONTROLLER;
if (!empty($_GET['controlador']))
    $controlador = $_GET['controlador'];

// Obtenemos la acción seleccionada.
// Si el usuario no la introduce, seleccionamos la de por defecto.
$action = DEFAULT_ACTION;
if (!empty($_GET['action']))
    $action = $_GET['action'];

// Verificar si la ruta actual requiere autenticación
$ruta_actual = $controlador . '_' . $action;
$requiere_sesion = !isset($public_routes[$ruta_actual]);

// Si la ruta requiere sesión y el usuario no está autenticado, redirigir al login
if ($requiere_sesion && !verificarSesionIniciada()) {
    header("Location: index.php?controlador=miembros&action=login");
    exit();
}

// Ya tenemos el controlador y la acción
// Formamos el nombre del fichero que contiene nuestro controlador
$controller = CONTROLLERS_FOLDER . $controlador . '_controller.php';

// Si la variable ($controller) es un fichero, lo requerimos
if (is_file($controller))
    require_once($controller);
else
    die('El controlador no existe - 404 not found');

// Si la variable $action es una función la ejecutamos o detenemos el script
if (is_callable($action))
    $action();
else
    die('La acción no existe - 404 not found');
?>