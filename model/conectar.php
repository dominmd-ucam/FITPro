<?php
class Conectar{
    public static function conexion(){
        try {
            $conexion=new mysqli("127.0.0.1","root","","gimnasio_db");
        } catch (Exception $e) {
            die('Error:'.$e->getMessage());
        }
        return $conexion;
    }
}
?>