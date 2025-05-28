<?php
require_once("controller/front_controller.php");

// No necesitamos verificar la sesión aquí ya que el front_controller ya lo hace

// Usuario conectado
if (isset($_SESSION["nombre"])) {
    // Si es administrador (admin = 1)
    if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
        include("view/dashboard_admin.php");
    // Si es un usuario normal
    } else {
        include("view/dashboard_user.php");
    }
// Usuario no conectado: mostrar landing
} else {
    require_once("view/menu.php");
    include("view/landing_page.php");
}
?>

<!DOCTYPE html>
<html>
<body>
</body>
</html>
