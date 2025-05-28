<?php


require_once 'model/progreso_model.php';
require_once 'model/miembros_model.php';

function home() {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['nombre'])) {
        header('Location: index.php?controlador=miembros&action=login');
        exit;
    }

    $model = new ProgresoModel();
    $miembros = new Miembros_model();
    
    // Obtener el ID del usuario a partir del nombre
    $usuario_id = $miembros->getUserIdByEmail($_SESSION['email']);

    // Obtener datos del progreso del usuario
    $progreso = $model->getProgresoUsuario($usuario_id);
    $estadisticas = $model->getEstadisticasProgreso($usuario_id);
    $ultimo_progreso = $model->getUltimoProgreso($usuario_id);

    // Cargar la vista
    require_once 'view/progreso_view.php';
}

function registrarProgreso() {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['nombre'])) {
        header('Location: index.php?controlador=miembros&action=login');
        exit;
    }

    $model = new ProgresoModel();
    $miembros = new Miembros_model();
    
    // Obtener el ID del usuario a partir del nombre
    $usuario_id = $miembros->getUserIdByEmail($_SESSION['email']);

    // Verificar si se recibieron los datos necesarios
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datos = [
            'usuario_id' => $usuario_id,
            'peso' => $_POST['peso'],
            'grasa_corporal' => $_POST['grasa_corporal'],
            'musculo' => $_POST['musculo'],
            'notas' => $_POST['notas'] ?? ''
        ];

        // Registrar el progreso
        if ($model->registrarProgreso($datos)) {
            $_SESSION['mensaje'] = "¡Excelente! Tu progreso ha sido registrado exitosamente";
        } else {
            $_SESSION['error'] = "Lo sentimos, hubo un error al registrar tu progreso. Por favor, intenta nuevamente";
        }
    }

    // Redirigir de vuelta a la página de progreso
    header('Location: index.php?controlador=progreso&action=home');
    exit;
}

function eliminarProgreso() {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['nombre'])) {
        header('Location: index.php?controlador=miembros&action=login');
        exit;
    }

    $model = new ProgresoModel();

    // Verificar si se recibió el ID del progreso
    if (isset($_POST['progreso_id'])) {
        if ($model->eliminarProgreso($_POST['progreso_id'])) {
            $_SESSION['mensaje'] = "¡Listo! El registro de progreso ha sido eliminado correctamente";
        } else {
            $_SESSION['error'] = "Lo sentimos, hubo un error al eliminar el registro. Por favor, intenta nuevamente";
        }
    }

    // Redirigir de vuelta a la página de progreso
    header('Location: index.php?controlador=progreso&action=home');
    exit;
}

function getProgresoEjercicio() {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['nombre'])) {
        http_response_code(401);
        echo json_encode(['error' => 'No autorizado']);
        exit;
    }

    $model = new ProgresoModel();
    $miembros = new Miembros_model();
    
    // Obtener el ID del usuario a partir del nombre
    $usuario_id = $miembros->getUserIdByEmail($_SESSION['email']);

    // Verificar si se recibió el ID del ejercicio
    if (isset($_GET['ejercicio_id'])) {
        $progreso = $model->getProgresoEjercicio(
            $usuario_id,
            $_GET['ejercicio_id']
        );
        echo json_encode($progreso);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID de ejercicio no proporcionado']);
    }
    exit;
}