<?php
// No necesitamos session_start() aquí porque ya se inició en el front_controller

function home(){
    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    
    $resultado = $datos->get_usuarios();
    
    $html = '';
    while($row = $resultado->fetch_assoc()) {
        $html .= '<tr class="border-t border-t-[#344c65]">';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-120 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal">' . $row['nombre'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-240 h-[72px] px-4 py-2 w-[400px] text-[#93adc8] text-sm font-normal leading-normal">' . $row['email'] . '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-360 h-[72px] px-4 py-2 w-[400px] text-[#93adc8] text-sm font-normal leading-normal">-</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-480 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">';
        $html .= '<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#243547] text-white text-sm font-medium leading-normal w-full">';
        $html .= '<span class="truncate">' . $row['tipo'] . '</span>';
        $html .= '</button>';
        $html .= '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-600 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">';
        $html .= '<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#243547] text-white text-sm font-medium leading-normal w-full">';
        $html .= '<span class="truncate">Active</span>';
        $html .= '</button>';
        $html .= '</td>';
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-720 h-[72px] px-4 py-2 w-60 text-[#93adc8] text-sm font-bold leading-normal tracking-[0.015em]">';
        $html .= '<div class="flex gap-2">';
        $html .= '<button class="edit-member-btn cursor-pointer" data-id="' . $row['id_usuario'] . '"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>';
        $html .= '<button onclick="confirmarBorrado(' . $row['id_usuario'] . ')" class="text-red-500 hover:text-red-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
    }
    
    require_once("view/miembros_view.php");
}

function desconectar() {
    session_destroy();
    header("Location: index.php");
    exit();
}

function login() {
    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    $message = "";

    if (!isset($_SESSION["nombre"])) {
        if (isset($_POST["submit"])) {
            $usuario = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
            $paswd = isset($_POST["pswd"]) ? $_POST["pswd"] : '';

            if ($datos->login($usuario, $paswd)) {
                $_SESSION["nombre"] = $usuario;
                $_SESSION["passwd"] = $paswd;
                $_SESSION["email"] = $datos->getEmail($usuario);
                $_SESSION["admin"] = $datos->esAdmin($_SESSION["email"]);

                header("Location: index.php");
            } else {
                $message = "Usuario o contraseña incorrectos";
            }
        }
    }

    require_once("view/login_view.php");
}

function registrar() {
    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    $message = "";

    if (isset($_POST["registro_submit"])) {
        $usuario = trim($_POST["nombre"] ?? '');
        $paswd = trim($_POST["pswd"] ?? '');
        $email = trim($_POST["email"] ?? '');

        if ($usuario === '' || $paswd === '') {
            $message = "Todos los campos son obligatorios.";
        } elseif ($datos->usuario_existe($usuario)) {
            $message = "El usuario ya existe. Intenta con otro nombre.";
        } else {
            if ($datos->registrar_usuario($usuario,$email ,$paswd)) {
                $_SESSION["nombre"] = $usuario;
                header("Location: index.php");
                exit();
            } else {
                $message = "Error al registrar el usuario.";
            }
        }
    }

    require_once("view/registro_view.php");
}

function crear_miembro() {
    // Asegurarnos de que no hay salida antes de los headers
    ob_clean();
    
    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    
    $response = array('success' => false, 'message' => '');
    
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $passwd = trim($_POST['passwd'] ?? '');
            $tipo = trim($_POST['tipo'] ?? 'cliente');
            
            if (empty($nombre) || empty($email) || empty($passwd)) {
                $response['message'] = "Todos los campos son obligatorios.";
            } elseif ($datos->usuario_existe($nombre)) {
                $response['message'] = "El usuario ya existe. Intenta con otro nombre.";
            } elseif ($datos->email_existe($email)) {
                $response['message'] = "El email ya está registrado.";
            } else {
                if ($datos->registrar_usuario($nombre, $email, $passwd, $tipo)) {
                    $response['success'] = true;
                    $response['message'] = "Miembro creado exitosamente.";
                } else {
                    $response['message'] = "Error al crear el miembro en la base de datos.";
                }
            }
        } else {
            $response['message'] = "Método de solicitud no válido.";
        }
    } catch (Exception $e) {
        $response['message'] = "Error: " . $e->getMessage();
    }
    
    // Asegurarnos de que no hay salida antes de los headers
    if (ob_get_length()) ob_clean();
    
    // Establecer los headers correctos
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    // Enviar la respuesta JSON
    echo json_encode($response);
    exit();
}

function get_member_data() {
    // Limpiar cualquier salida anterior
    if (ob_get_length()) ob_clean();
    
    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    
    // Establecer headers
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    try {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $resultado = $datos->get_member_complete_data($id);
            
            if ($resultado) {
                echo json_encode($resultado);
            } else {
                echo json_encode(['error' => 'No se encontró el miembro']);
            }
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al obtener datos del miembro: ' . $e->getMessage()]);
    }
    
    exit();
}

function update_member() {
    // Limpiar cualquier salida anterior
    if (ob_get_length()) ob_clean();
    
    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    
    // Establecer headers
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    try {
        if (isset($_POST['id_usuario'])) {
            $id = $_POST['id_usuario'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $tipo = $_POST['tipo'];
            $passwd = isset($_POST['passwd']) && !empty($_POST['passwd']) ? $_POST['passwd'] : null;
            
            $resultado = $datos->update_member($id, $nombre, $email, $tipo, $passwd);
            
            if ($resultado) {
                echo json_encode(['success' => true, 'message' => 'Miembro actualizado correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar el miembro']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit();
}

function get_membresia_data() {
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        return;
    }

    $id = $_GET['id'];
    $membresia = $this->model->get_membresia_data($id);
    
    if ($membresia) {
        echo json_encode(['success' => true, 'data' => $membresia]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró la membresía']);
    }
}

function get_rutinas_data() {
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        return;
    }

    $id = $_GET['id'];
    $rutinas = $this->model->get_rutinas_data($id);
    
    if ($rutinas) {
        echo json_encode(['success' => true, 'data' => $rutinas]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron rutinas']);
    }
}

function get_accesos_data() {
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        return;
    }

    $id = $_GET['id'];
    $accesos = $this->model->get_accesos_data($id);
    
    if ($accesos) {
        echo json_encode(['success' => true, 'data' => $accesos]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron accesos']);
    }
}

function get_progreso_data() {
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        return;
    }

    $id = $_GET['id'];
    $progreso = $this->model->get_progreso_data($id);
    
    if ($progreso) {
        echo json_encode(['success' => true, 'data' => $progreso]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró progreso']);
    }
}

function get_nutricion_data() {
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        return;
    }

    $id = $_GET['id'];
    $nutricion = $this->model->get_nutricion_data($id);
    
    if ($nutricion) {
        echo json_encode(['success' => true, 'data' => $nutricion]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró plan nutricional']);
    }
}

function get_clases_data() {
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        return;
    }

    $id = $_GET['id'];
    $clases = $this->model->get_clases_data($id);
    
    if ($clases) {
        echo json_encode(['success' => true, 'data' => $clases]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron clases']);
    }
}

function delete_member() {
    if (ob_get_length()) ob_clean();
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        
        if (empty($id)) {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
            exit();
        }

        require_once("model/miembros_model.php");
        $datos = new Miembros_model();
        $result = $datos->delete_member($id);
        echo json_encode($result);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }
}
