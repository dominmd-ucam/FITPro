<?php
// require_once("view/menu.php");
?>

<body>
<?php
// Usuario conectado
if (isset($_SESSION["nombre"])) {

    // Si es administrador (admin = 1)
    // console_log($_SESSION);
    if (isset($_SESSION["nombre"]) && $_SESSION["admin"] == 1) {
        include("view/dashboard_admin.php");

    // Si es un usuario normal
    } else {
        require_once("view/menu.php");
        include("view/dashboard_user.php");
        echo "<p>HOLA MUNDO</p>";
        echo "<p>ESTÁS CONECTADO COMO " . htmlspecialchars($_SESSION["nombre"]) . "</p>";
    }

// Usuario no conectado: mostrar landing
} else {
    require_once("view/menu.php");
    include("view/landing_page.php");
}
?>
</body>
