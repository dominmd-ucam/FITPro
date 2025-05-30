<?php
function home(){
    require_once("model/clases_model.php");
    $clases = new ClasesModel();
    $resultado = $clases->getClases();

    $html = '';
    while($row = $resultado->fetch_assoc()) {
        $html .= '<tr class="border-t border-t-[#344c65]">';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-120 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal">' . $row['nombre'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-240 h-[72px] px-4 py-2 w-[400px] text-[#93adc8] text-sm font-normal leading-normal">' . $row['descripcion'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-360 h-[72px] px-4 py-2 w-[400px] text-[#93adc8] text-sm font-normal leading-normal">' . $row['nombre_entrenador'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-480 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">';
        $html .= '<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#243547] text-white text-sm font-medium leading-normal w-full">';
        $html .= '<span class="truncate">' . $row['dia_semana'] . ' ' . date('H:i', strtotime($row['hora_inicio'])) . '</span>';
        $html .= '</button>';
        $html .= '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-600 h-[72px] px-4 py-2 w-60 text-[#93adc8] text-sm font-bold leading-normal tracking-[0.015em]">';
        $html .= '<div class="flex gap-2">';
        $html .= '<button onclick="showEditModal(' . $row['id'] . ')" class="edit-class-btn cursor-pointer" data-id="' . $row['id'] . '"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>';
        $html .= '<button onclick="confirmarBorrado(' . $row['id'] . ')" class="text-red-500 hover:text-red-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
    }

    require_once("view/clases_view.php");
}

function desconectar(){
    session_destroy();
    header("Location: index.php");
}

function get_trainers() {
    if (ob_get_length()) ob_clean();
    
    require_once("model/entrenadores_model.php");
    $entrenadores = new EntrenadoresModel();
    $resultado = $entrenadores->getEntrenadores();
    
    if (!$resultado) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error al obtener los entrenadores']);
        exit();
    }
    
    $trainers = array();
    while($row = $resultado->fetch_assoc()) {
        $trainers[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre']
        );
    }
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    echo json_encode($trainers);
    exit();
}

function crear_clase() {
    if (ob_get_length()) ob_clean();
    
    require_once("model/clases_model.php");
    $clases = new ClasesModel();
    
    $response = array('success' => false, 'message' => '');
    
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $entrenador_id = $_POST['entrenador_id'] ?? '';
            $dia_semana = $_POST['dia_semana'] ?? '';
            $hora_inicio = $_POST['hora_inicio'] ?? '';
            $hora_fin = $_POST['hora_fin'] ?? '';

            if (empty($nombre) || empty($descripcion) || empty($entrenador_id) || 
                empty($dia_semana) || empty($hora_inicio) || empty($hora_fin)) {
                $response['message'] = 'Todos los campos son requeridos';
            } else {
                $result = $clases->crear_clase($nombre, $descripcion, $entrenador_id, $dia_semana, $hora_inicio, $hora_fin);
                $response = $result;
            }
        } else {
            $response['message'] = "Método de solicitud no válido.";
        }
    } catch (Exception $e) {
        $response['message'] = "Error: " . $e->getMessage();
    }
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    echo json_encode($response);
    exit();
}

function get_clase_data() {
    if (ob_get_length()) ob_clean();
    
    require_once("model/clases_model.php");
    $clases = new ClasesModel();
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    try {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $resultado = $clases->get_clase_by_id($id);
            
            if ($resultado) {
                echo json_encode($resultado);
            } else {
                echo json_encode(['error' => 'No se encontró la clase']);
            }
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al obtener datos de la clase: ' . $e->getMessage()]);
    }
    
    exit();
}

function update_clase() {
    if (ob_get_length()) ob_clean();
    
    require_once("model/clases_model.php");
    $clases = new ClasesModel();
    
    $response = array('success' => false, 'message' => '');
    
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $entrenador_id = $_POST['entrenador_id'] ?? '';
            $dia_semana = $_POST['dia_semana'] ?? '';
            $hora_inicio = $_POST['hora_inicio'] ?? '';
            $hora_fin = $_POST['hora_fin'] ?? '';

            if (empty($id) || empty($nombre) || empty($descripcion) || empty($entrenador_id) || 
                empty($dia_semana) || empty($hora_inicio) || empty($hora_fin)) {
                $response['message'] = 'Todos los campos son requeridos';
            } else {
                $result = $clases->actualizar_clase($id, $nombre, $descripcion, $entrenador_id, $dia_semana, $hora_inicio, $hora_fin);
                if ($result['success']) {
                    $response['success'] = true;
                    $response['message'] = 'Clase actualizada exitosamente';
                } else {
                    $response['message'] = $result['message'];
                }
            }
        } else {
            $response['message'] = "Método de solicitud no válido.";
        }
    } catch (Exception $e) {
        $response['message'] = "Error: " . $e->getMessage();
    }
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    echo json_encode($response);
    exit();
}

function eliminar_clase() {
    if (ob_get_length()) ob_clean();
    
    require_once("model/clases_model.php");
    $clases = new ClasesModel();
    
    $response = array('success' => false, 'message' => '');
    
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            
            if (empty($id)) {
                $response['message'] = 'ID de clase no proporcionado';
            } else {
                $result = $clases->eliminar_clase($id);
                $response = $result;
            }
        } else {
            $response['message'] = "Método de solicitud no válido.";
        }
    } catch (Exception $e) {
        $response['message'] = "Error: " . $e->getMessage();
    }
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    echo json_encode($response);
    exit();
}

function eliminarAlumno() {
    require_once("model/clases_model.php");
    $clases = new ClasesModel();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clase_id']) && isset($_POST['alumno_nombre'])) {
        $clase_id = $_POST['clase_id'];
        $alumno_nombre = $_POST['alumno_nombre'];
        
        $resultado = $clases->eliminar_alumno_clase($clase_id, $alumno_nombre);
        
        if ($resultado['success']) {
            $_SESSION['mensaje'] = $resultado['message'];
        } else {
            $_SESSION['error'] = $resultado['message'];
        }
    }
    header("Location: index.php?controlador=home&action=home");
    exit();
}
?> 