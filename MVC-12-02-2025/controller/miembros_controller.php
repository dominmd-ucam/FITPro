<?php
session_start();

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
        $html .= '<td class="table-53b9ae36-f9b1-418a-aa1b-d77389b436cd-column-720 h-[72px] px-4 py-2 w-60 text-[#93adc8] text-sm font-bold leading-normal tracking-[0.015em]">Edit</td>';
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
