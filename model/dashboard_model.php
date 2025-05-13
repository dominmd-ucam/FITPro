<?php
require_once 'conectar.php';

class DashboardModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conectar::conexion();
    }

    public function getTotalMembers() {
        $query = "SELECT COUNT(*) as total FROM usuarios WHERE tipo = 'cliente'";
        $resultado = $this->conexion->query($query);
        $row = $resultado->fetch_assoc();
        return $row['total'];
    }

    public function getActiveMembers() {
        $query = "SELECT COUNT(*) as activos FROM usuarios u 
                 INNER JOIN usuarios_membresias um ON u.id_usuario = um.usuario_id 
                 WHERE u.tipo = 'cliente' 
                 AND um.fecha_fin >= CURRENT_DATE()";
        $resultado = $this->conexion->query($query);
        $row = $resultado->fetch_assoc();
        return $row['activos'];
    }

    public function getInactiveMembers() {
        $query = "SELECT COUNT(*) as inactivos FROM usuarios u 
                 LEFT JOIN usuarios_membresias um ON u.id_usuario = um.usuario_id 
                 WHERE u.tipo = 'cliente' 
                 AND (um.fecha_fin < CURRENT_DATE() OR um.id IS NULL)";
        $resultado = $this->conexion->query($query);
        $row = $resultado->fetch_assoc();
        return $row['inactivos'];
    }

    public function getTotalRevenue() {
        $query = "SELECT 
                    SUM(m.precio / m.duracion_dias * 30) as total 
                 FROM usuarios_membresias um 
                 INNER JOIN membresias m ON um.membresia_id = m.id 
                 WHERE um.fecha_inicio <= CURRENT_DATE() 
                 AND um.fecha_fin >= CURRENT_DATE()";
        $resultado = $this->conexion->query($query);
        $row = $resultado->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function getLastAccessLogs() {
        $query = "SELECT ra.*, u.nombre 
                 FROM registro_accesos ra 
                 INNER JOIN usuarios u ON ra.usuario_id = u.id_usuario 
                 ORDER BY ra.fecha DESC 
                 LIMIT 5";
        $resultado = $this->conexion->query($query);
        $logs = [];
        while ($row = $resultado->fetch_assoc()) {
            $logs[] = $row;
        }
        return $logs;
    }
}
?> 