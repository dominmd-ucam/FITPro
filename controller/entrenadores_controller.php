<?php
session_start();

function home(){
    require_once("model/entrenadores_model.php");
    $entrenadores = new EntrenadoresModel();
    $resultado = $entrenadores->getEntrenadores();

    // Generar el HTML para la tabla
    $html = '';
    while($row = $resultado->fetch_assoc()) {
        $html .= '<tr class="border-t border-t-[#344c65]">';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-120 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal">' . $row['nombre'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-240 h-[72px] px-4 py-2 w-[400px] text-[#93adc8] text-sm font-normal leading-normal">' . $row['email'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-360 h-[72px] px-4 py-2 w-[400px] text-[#93adc8] text-sm font-normal leading-normal">' . $row['telefono'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-480 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">';
        $html .= '<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#243547] text-white text-sm font-medium leading-normal w-full">';
        $html .= '<span class="truncate">' . $row['especialidad'] . '</span>';
        $html .= '</button>';
        $html .= '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-600 h-[72px] px-4 py-2 w-60 text-[#93adc8] text-sm font-bold leading-normal tracking-[0.015em]">';
        $html .= '<div class="flex gap-2">';
        $html .= '<button class="edit-trainer-btn cursor-pointer" data-id="' . $row['id'] . '"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>';
        $html .= '<button onclick="confirmarBorrado(' . $row['id'] . ')" class="text-red-500 hover:text-red-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
    }

    require_once("view/entrenadores_view.php");
}

function desconectar(){
    session_destroy();
    header("Location: index.php");
}

function crear_entrenador() {
    if (ob_get_length()) ob_clean();
    
    require_once("model/entrenadores_model.php");
    $entrenadores = new EntrenadoresModel();
    
    $response = array('success' => false, 'message' => '');
    
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $email = $_POST['email'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $especialidad = $_POST['especialidad'] ?? '';

            if (empty($nombre) || empty($email) || empty($telefono) || empty($especialidad)) {
                $response['message'] = 'Todos los campos son requeridos';
            } else {
                $result = $entrenadores->crear_entrenador($nombre, $email, $telefono, $especialidad);
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

function get_entrenador_data() {
    if (ob_get_length()) ob_clean();
    
    require_once("model/entrenadores_model.php");
    $entrenadores = new EntrenadoresModel();
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    try {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $resultado = $entrenadores->getEntrenadorById($id);
            
            if ($resultado) {
                echo json_encode($resultado);
            } else {
                echo json_encode(['error' => 'No se encontró el entrenador']);
            }
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al obtener datos del entrenador: ' . $e->getMessage()]);
    }
    
    exit();
}

function update_entrenador() {
    if (ob_get_length()) ob_clean();
    
    require_once("model/entrenadores_model.php");
    $entrenadores = new EntrenadoresModel();
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    $response = ['success' => false, 'message' => ''];
    
    try {
        if (!isset($_POST['id'])) {
            $response['message'] = 'ID no proporcionado';
            echo json_encode($response);
            exit();
        }

        $id = $_POST['id'];
        $nombre = $_POST['nombre'] ?? '';
        $especialidad = $_POST['especialidad'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $email = $_POST['email'] ?? '';
        
        if (empty($id) || empty($nombre) || empty($email) || empty($telefono) || empty($especialidad)) {
            $response['message'] = 'Todos los campos son requeridos';
            echo json_encode($response);
            exit();
        }

        // Verificar si el email ya existe para otro entrenador
        if ($entrenadores->verificarEmail($email, $id)) {
            $response['message'] = 'El email ya está registrado';
            echo json_encode($response);
            exit();
        }

        $resultado = $entrenadores->actualizarEntrenador($id, $nombre, $especialidad, $telefono, $email);
        
        if ($resultado) {
            $response['success'] = true;
            $response['message'] = 'Entrenador actualizado correctamente';
        } else {
            $response['message'] = 'Error al actualizar el entrenador';
        }
    } catch (Exception $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}

function get_clases_entrenador() {
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        return;
    }

    require_once("model/entrenadores_model.php");
    $entrenadores = new EntrenadoresModel();
    
    $id = $_GET['id'];
    $clases = $entrenadores->getClasesEntrenador($id);
    
    if ($clases) {
        echo json_encode(['success' => true, 'data' => $clases]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron clases']);
    }
}

function delete_entrenador() {
    if (ob_get_length()) ob_clean();
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        
        if (empty($id)) {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
            exit();
        }

        require_once("model/entrenadores_model.php");
        $entrenadores = new EntrenadoresModel();
        $result = $entrenadores->delete_entrenador($id);
        echo json_encode($result);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }
}
?>