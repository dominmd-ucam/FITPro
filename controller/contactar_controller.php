<?php

session_start();

function contactar(){
    if (isset($_POST["enviar"])) {
    $to_email = "prueba@localhost.com";
    $from = isset($_POST["mail"])?$_POST["mail"]:"";
    $asunto= isset($_POST["asunto"])?$_POST["asunto"]:"";
    $nombre= isset($_POST["nombre"])?$_POST["nombre"]:"";
    $mensaje= isset($_POST["mensaje"])?$_POST["mensaje"]:"";
    $body = "Mensaje de: $nombre.<br>$mensaje";
    $headers = "From: $from";

    if (mail($to_email, $asunto, $body, $headers)) {
    echo "Email enviado correctamente a $to_email...";
    } else {
    echo "Envio de Email fallido...";
    }
}
//que me mande al home cuando lo tenga
    require_once("view/contacto_view.php");
}

?>