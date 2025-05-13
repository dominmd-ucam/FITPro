<?php
require_once 'conectar.php';

class EntrenadoresModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conectar::conexion();
    }

    public function getEntrenadores() {
        $query = "SELECT * FROM entrenadores";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }
}
?>