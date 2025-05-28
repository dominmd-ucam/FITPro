<?php

require_once 'model/gimnasio_model.php';

class Rutina_controller {
    public $model;
    
    public function __construct() {
        $this->model = new Gimnasio_model();
    }
}

// Función global para el método home
function home() {
    if (!isset($_SESSION['nombre'])) {
        header('Location: index.php?controlador=miembros&action=login');
        exit;
    }

    $controller = new Rutina_controller();
    // Obtener la rutina del usuario actual
    $rutina = $controller->model->get_rutina_by_usuario($_SESSION['nombre']);
    
    // Si no hay rutina, mostrar mensaje
    if (!$rutina) {
        $ruta_base = dirname(__DIR__);
        require_once $ruta_base . '/view/rutina_entreno_view.php';
        return;
    }
    
    // Obtener los ejercicios de la rutina
    $ejercicios = $controller->model->get_ejercicios_by_rutina($rutina['id']);
    
    // Obtener el progreso de la rutina
    $progreso = $controller->model->get_progreso_rutina($rutina['id']);
    
    // Definir la ruta base para las vistas
    $ruta_base = dirname(__DIR__);
    
    // Cargar la vista
    require_once $ruta_base . '/view/rutina_entreno_view.php';
}

// Función global para registrar progreso
function registrar_progreso() {
    if (!isset($_SESSION['nombre'])) {
        header('Location: index.php?controlador=miembros&action=login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new Rutina_controller();
        $ejercicio_id = $_POST['ejercicio_id'];
        $peso = $_POST['peso'];
        $repeticiones = $_POST['repeticiones'];
        $rutina_id = $_POST['rutina_id'];
        
        $controller->model->registrar_progreso_ejercicio($rutina_id, $ejercicio_id, $peso, $repeticiones);
        
        // Redirigir de vuelta a la página de rutina
        header('Location: index.php?controlador=rutina&action=home');
    }
}
?> 