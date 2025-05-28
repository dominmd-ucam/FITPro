<?php



    // Acción por defecto: mostrar la vista de entrenamientos
    function mostrar() {
        require_once "view/entreno_view.php";
    }

    // Puedes añadir más acciones si necesitas otras vistas relacionadas
    function nutricion() {
        require_once "view/nutricion_view.php";
    }

    function quienes_somos(){
        require_once "view/quienessomos_view.php";
    }
      function comunidad(){
        require_once "view/comunidad_view.php";
    }
    function homefichas(){
    require_once("model/entrenadores_model.php");
    $entrenadores = new EntrenadoresModel();
    $resultado = $entrenadores->getEntrenadores();

    // Convertimos el resultado (mysqli_result) en un array
    $listaEntrenadores = [];
    while($row = $resultado->fetch_assoc()) {
        $listaEntrenadores[] = $row;
    }

    // Pasamos $listaEntrenadores como $entrenadores a la vista
    $entrenadores = $listaEntrenadores;

    require_once("view/entrenadoresHome_view.php");
}
