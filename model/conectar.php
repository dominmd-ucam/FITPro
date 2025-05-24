<?php
class Conectar{
    public static function conexion(){
        try {
            $conexion=new mysqli("localhost","root","","gimnasio_db");
            $conexion->set_charset("utf8mb4");
        } catch (Exception $e) {
            die('Error:'.$e->getMessage());
        }
        return $conexion;
    }
}
?>