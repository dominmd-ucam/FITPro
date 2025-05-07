<?php
session_start();

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
