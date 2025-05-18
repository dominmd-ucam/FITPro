<?php
require_once 'conectar.php';

class ProgresoModel {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    /**
     * Obtiene el progreso de un usuario específico
     * @param int $usuario_id ID del usuario
     * @return array Array con los registros de progreso
     */
    public function getProgresoUsuario($usuario_id) {
        $sql = "SELECT * FROM progreso_usuario 
                WHERE usuario_id = ? 
                ORDER BY fecha DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $progreso = array();
        while($row = $resultado->fetch_assoc()) {
            $progreso[] = $row;
        }
        return $progreso;
    }

    /**
     * Registra un nuevo progreso para un usuario
     * @param array $datos Array con los datos del progreso
     * @return bool True si se registró correctamente
     */
    public function registrarProgreso($datos) {
        $sql = "INSERT INTO progreso_usuario (usuario_id, fecha, peso, grasa_corporal, musculo, notas) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $fecha = date('Y-m-d');
        $stmt->bind_param("isddds", 
            $datos['usuario_id'], 
            $fecha, 
            $datos['peso'], 
            $datos['grasa_corporal'], 
            $datos['musculo'], 
            $datos['notas']
        );
        return $stmt->execute();
    }

    /**
     * Obtiene el progreso de un ejercicio específico
     * @param int $usuario_id ID del usuario
     * @param int $ejercicio_id ID del ejercicio
     * @return array Array con los registros de progreso del ejercicio
     */
    public function getProgresoEjercicio($usuario_id, $ejercicio_id) {
        $sql = "SELECT * FROM progreso_usuario 
                WHERE usuario_id = ? 
                AND ejercicio_id = ? 
                ORDER BY fecha DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $usuario_id, $ejercicio_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $progreso = array();
        while($row = $resultado->fetch_assoc()) {
            $progreso[] = $row;
        }
        return $progreso;
    }

    /**
     * Obtiene el último progreso registrado de un usuario
     * @param int $usuario_id ID del usuario
     * @return array Array con el último registro de progreso
     */
    public function getUltimoProgreso($usuario_id) {
        $sql = "SELECT * FROM progreso_usuario 
                WHERE usuario_id = ? 
                ORDER BY id DESC 
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    /**
     * Obtiene estadísticas de progreso de un usuario
     * @param int $usuario_id ID del usuario
     * @return array Array con estadísticas de progreso
     */
    public function getEstadisticasProgreso($usuario_id) {
        $sql = "SELECT 
                    COUNT(*) as total_registros,
                    MAX(peso) as max_peso,
                    MIN(peso) as min_peso,
                    AVG(peso) as promedio_peso,
                    MAX(grasa_corporal) as max_grasa,
                    MIN(grasa_corporal) as min_grasa,
                    MAX(musculo) as max_musculo,
                    MIN(musculo) as min_musculo
                FROM progreso_usuario 
                WHERE usuario_id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    /**
     * Elimina un registro de progreso
     * @param int $progreso_id ID del registro de progreso
     * @return bool True si se eliminó correctamente
     */
    public function eliminarProgreso($progreso_id) {
        $sql = "DELETE FROM progreso_usuario WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $progreso_id);
        return $stmt->execute();
    }
} 