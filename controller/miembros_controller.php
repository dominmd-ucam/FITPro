<?php
// No necesitamos session_start() aquí porque ya se inició en el front_controller

function home(){
    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    
    $resultado = $datos->get_usuarios();
    
    if (!$resultado) {
        error_log("Error al obtener usuarios");
        $html = '<tr><td colspan="6" class="text-center">Error al cargar los datos</td></tr>';
    } else {
        $html = '';
        while($row = $resultado->fetch_assoc()) {
            // Generar código QR único para cada miembro
            $qrCode = 'QR-' . str_pad($row['id_usuario'], 10, '0', STR_PAD_LEFT);
            
            // Verificar estado de membresía
            $isActive = false;
            $statusClass = 'status-expired';
            $statusText = 'Expirado';
            $expirationDate = 'N/A';
            
            if (isset($row['fecha_fin_membresia'])) {
                $isActive = strtotime($row['fecha_fin_membresia']) >= time();
                $statusClass = $isActive ? 'status-active' : 'status-expired';
                $statusText = $isActive ? 'Activo' : 'Expirado';
                $expirationDate = date('d/m/Y', strtotime($row['fecha_fin_membresia']));
            }
            
            $html .= '<tr>';
            // Columna 1: Nombre
            $html .= '<td class="px-4 py-2">' . htmlspecialchars($row['nombre']) . '</td>';
            
            // Columna 2: Email
            $html .= '<td class="px-4 py-2">' . htmlspecialchars($row['email']) . '</td>';
            
            // Columna 3: QR Code
            $html .= '<td class="px-4 py-2">';
            $html .= '<div class="qr-code">';
            $html .= '<svg class="qr-code-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><line x1="14" y1="14" x2="21" y2="14"/><line x1="14" y1="21" x2="21" y2="21"/><line x1="14" y1="14" x2="14" y2="21"/></svg>';
            $html .= '<span class="qr-code-text">' . $qrCode . '</span>';
            $html .= '</div>';
            $html .= '</td>';
            
            // Columna 4: Tipo de Membresía
            $html .= '<td class="px-4 py-2">';
            $html .= '<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#243547] text-white text-sm font-medium leading-normal w-full">';
            $html .= '<span class="truncate">' . (isset($row['tipo_membresia']) ? htmlspecialchars($row['tipo_membresia']) : 'Sin membresía') . '</span>';
            $html .= '</button>';
            $html .= '</td>';
            
            // Columna 5: Estado
            $html .= '<td class="px-4 py-2">';
            $html .= '<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 ' . ($isActive ? 'bg-[#22c55e]' : 'bg-[#ef4444]') . ' text-white text-sm font-medium leading-normal w-full">';
            $html .= '<span class="truncate">' . $statusText . '</span>';
            $html .= '</button>';
            $html .= '</td>';
            
            // Columna 6: Acciones
            $html .= '<td class="px-4 py-2">';
            $html .= '<div class="flex items-center gap-2">';
            $html .= '<button onclick="openEditModal(' . $row['id_usuario'] . ')" class="edit-member-btn" data-id="' . $row['id_usuario'] . '">';
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                      <path d="m15 5 4 4"></path>
                    </svg>';
            $html .= '</button>';
            $html .= '<button onclick="confirmarBorrado(' . $row['id_usuario'] . ')" class="text-red-500">';
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M3 6h18"></path>
                      <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                      <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                      <line x1="10" y1="11" x2="10" y2="17"></line>
                      <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>';
            $html .= '</button>';
            $html .= '</div>';
            $html .= '</td>';
            
            $html .= '</tr>';
        }
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
            if ($datos->registrar_usuario($usuario, $email, $paswd)) {
                $_SESSION["nombre"] = $usuario;
                $_SESSION["email"] = $email;
                $_SESSION["admin"] = false; // Por defecto, los nuevos usuarios no son admin
                
                // Asegurarnos de que no hay salida antes de los headers
                if (ob_get_length()) ob_clean();
                
                // Redirigir al inicio
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
    // Limpiar cualquier salida anterior
    if (ob_get_length()) ob_clean();
    
    // Establecer headers
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        exit();
    }

    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    $id = $_GET['id'];
    $membresia = $datos->get_membresia_data($id);
    
    if ($membresia) {
        echo json_encode(['success' => true, 'data' => $membresia]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró la membresía']);
    }
    exit();
}

function get_rutinas_data() {
    // Limpiar cualquier salida anterior
    if (ob_get_length()) ob_clean();
    
    // Establecer headers
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        exit();
    }

    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    $id = $_GET['id'];
    $rutinas = $datos->get_rutinas_data($id);
    
    if ($rutinas) {
        echo json_encode(['success' => true, 'data' => $rutinas]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron rutinas']);
    }
    exit();
}

function get_accesos_data() {
    // Limpiar cualquier salida anterior
    if (ob_get_length()) ob_clean();
    
    // Establecer headers
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        exit();
    }

    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    $id = $_GET['id'];
    $accesos = $datos->get_accesos_data($id);
    
    if ($accesos) {
        echo json_encode(['success' => true, 'data' => $accesos]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron accesos']);
    }
    exit();
}

function get_progreso_data() {
    // Limpiar cualquier salida anterior
    if (ob_get_length()) ob_clean();
    
    // Establecer headers
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        exit();
    }

    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    $id = $_GET['id'];
    $progreso = $datos->get_progreso_data($id);
    
    if ($progreso) {
        echo json_encode(['success' => true, 'data' => $progreso]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró progreso']);
    }
    exit();
}

function get_nutricion_data() {
    // Limpiar cualquier salida anterior
    if (ob_get_length()) ob_clean();
    
    // Establecer headers
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        exit();
    }

    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    $id = $_GET['id'];
    $nutricion = $datos->get_nutricion_data($id);
    
    if ($nutricion) {
        echo json_encode(['success' => true, 'data' => $nutricion]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró plan nutricional']);
    }
    exit();
}

function get_clases_data() {
    // Limpiar cualquier salida anterior
    if (ob_get_length()) ob_clean();
    
    // Establecer headers
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        exit();
    }

    require_once("model/miembros_model.php");
    $datos = new Miembros_model();
    $id = $_GET['id'];
    $clases = $datos->get_clases_data($id);
    
    if ($clases) {
        echo json_encode(['success' => true, 'data' => $clases]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron clases']);
    }
    exit();
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
