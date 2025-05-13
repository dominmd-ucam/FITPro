<?php
require_once 'conectar.php';

class ClasesModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conectar::conexion();
    }

    public function getClases() {
        $query = "SELECT c.*, e.nombre as nombre_entrenador, h.dia_semana, h.hora_inicio, h.hora_fin 
                 FROM clases c 
                 LEFT JOIN entrenadores e ON c.entrenador_id = e.id 
                 LEFT JOIN horarios h ON c.id = h.clase_id";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }
}
?> 