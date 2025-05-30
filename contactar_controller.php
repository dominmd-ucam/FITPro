<?php

function contacto() {
  $message = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $destinatario = 'robertosegadodiaz@gmail.com';  // ← Sustituye por tu email real
    $asunto = "Nuevo mensaje de $nombre (FitPro)";
    $cuerpo = "Nombre: $nombre\n";
    $cuerpo .= "Email: $email\n";
    $cuerpo .= "Mensaje:\n$mensaje\n";

    $cabeceras = "From: $email\r\nReply-To: $email\r\n";

    if (mail($destinatario, $asunto, $cuerpo, $cabeceras)) {
      $message = "✅ ¡Mensaje enviado correctamente!";
    } else {
      $message = "❌ Error al enviar el mensaje. Inténtalo más tarde.";
    }
  }

  include 'view/contacto_view.php';
}
