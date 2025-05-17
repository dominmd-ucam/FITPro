<?php
require_once 'conectar.php';

class DashboardUserModel {
    private $db;
    
    public function __construct() {
        $this->db = Conectar::conexion();
    }
    
    public function getClasesAsignadas($usuario_id) {
        $sql = "SELECT COUNT(*) as total FROM inscripciones WHERE usuario_id = $usuario_id";
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row['total'];
    }
    
    public function getProximaClase($usuario_id) {
        // Primero, obtener el día actual en español
        $dias = array(
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        );
        $dia_actual = $dias[date('l')];
        
        // Consulta simplificada
        $sql = "SELECT c.nombre, h.dia_semana, h.hora_inicio 
                FROM inscripciones i 
                JOIN clases c ON i.clase_id = c.id 
                JOIN horarios h ON i.horario_id = h.id 
                WHERE i.usuario_id = $usuario_id 
                AND h.hora_inicio > CURRENT_TIME()
                ORDER BY 
                    CASE h.dia_semana
                        WHEN 'Lunes' THEN 1
                        WHEN 'Martes' THEN 2
                        WHEN 'Miércoles' THEN 3
                        WHEN 'Jueves' THEN 4
                        WHEN 'Viernes' THEN 5
                        WHEN 'Sábado' THEN 6
                        WHEN 'Domingo' THEN 7
                    END,
                    h.hora_inicio 
                LIMIT 1";
                
        // Log para depuración
        error_log("SQL Query: " . $sql);
        error_log("Día actual: " . $dia_actual);
        
        $resultado = $this->db->query($sql);
        if ($resultado === false) {
            error_log("Error en la consulta: " . $this->db->error);
            return 'Error al obtener la próxima clase';
        }
        
        if ($row = $resultado->fetch_assoc()) {
            error_log("Clase encontrada: " . print_r($row, true));
            return $row['nombre'] . ' - ' . $row['dia_semana'] . ' ' . date('H:i', strtotime($row['hora_inicio']));
        }
        
        error_log("No se encontraron clases");
        return 'No hay clases programadas';
    }
    
    public function getEstadoMembresia($usuario_id) {
        $sql = "SELECT m.nombre, um.fecha_fin 
                FROM usuarios_membresias um 
                JOIN membresias m ON um.membresia_id = m.id 
                WHERE um.usuario_id = $usuario_id 
                AND um.fecha_fin >= CURRENT_DATE() 
                ORDER BY um.fecha_fin ASC 
                LIMIT 1";
        $resultado = $this->db->query($sql);
        if ($row = $resultado->fetch_assoc()) {
            $dias_restantes = (strtotime($row['fecha_fin']) - strtotime('today')) / (60 * 60 * 24);
            return $row['nombre'] . ' (' . ceil($dias_restantes) . ' días)';
        }
        return 'Sin membresía activa';
    }
    
    public function getUltimosAccesos($usuario_id) {
        $sql = "SELECT ra.*, u.nombre 
                FROM registro_accesos ra 
                JOIN usuarios u ON ra.usuario_id = u.id_usuario 
                WHERE ra.usuario_id = $usuario_id 
                ORDER BY ra.fecha DESC 
                LIMIT 5";
        $resultado = $this->db->query($sql);
        $accesos = array();
        while($row = $resultado->fetch_assoc()) {
            $accesos[] = $row;
        }
        return $accesos;
    }
    
    public function getProximasClases($usuario_id) {
        $sql = "SELECT c.nombre, h.dia_semana, h.hora_inicio, e.nombre as entrenador 
                FROM inscripciones i 
                JOIN clases c ON i.clase_id = c.id 
                JOIN horarios h ON i.horario_id = h.id 
                JOIN entrenadores e ON c.entrenador_id = e.id 
                WHERE i.usuario_id = $usuario_id 
                AND h.hora_inicio > CURRENT_TIME()
                ORDER BY 
                    CASE h.dia_semana
                        WHEN 'Lunes' THEN 1
                        WHEN 'Martes' THEN 2
                        WHEN 'Miércoles' THEN 3
                        WHEN 'Jueves' THEN 4
                        WHEN 'Viernes' THEN 5
                        WHEN 'Sábado' THEN 6
                        WHEN 'Domingo' THEN 7
                    END,
                    h.hora_inicio";
        $resultado = $this->db->query($sql);
        $clases = array();
        while($row = $resultado->fetch_assoc()) {
            $clases[] = array(
                'nombre' => $row['nombre'],
                'fecha' => $row['dia_semana'] . ' ' . date('H:i', strtotime($row['hora_inicio'])),
                'entrenador' => $row['entrenador']
            );
        }
        return $clases;
    }
}
?> 