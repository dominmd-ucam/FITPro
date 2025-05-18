<?php
require_once 'conectar.php';

class Gimnasio_model {
    public $db;
    private $datos;
    
    public function __construct() {
        $this->db = Conectar::conexion();
        $this->datos = array();
    }
    
    // Métodos para usuarios
    public function get_usuarios() {
        $sql = "SELECT * FROM usuarios";
        $resultado = $this->db->query($sql);
        while($row = $resultado->fetch_assoc()) {
            $this->datos[] = $row;
        }
        return $this->datos;
    }
    
    public function get_usuario_by_id($id) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = $id";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }
    
    // Métodos para entrenadores
    public function get_entrenadores() {
        $sql = "SELECT * FROM entrenadores";
        $resultado = $this->db->query($sql);
        while($row = $resultado->fetch_assoc()) {
            $this->datos[] = $row;
        }
        return $this->datos;
    }
    
    public function get_entrenador_by_id($id) {
        $sql = "SELECT * FROM entrenadores WHERE id = $id";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }
    
    // Métodos para clases
    public function get_clases() {
        $sql = "SELECT c.*, e.nombre as nombre_entrenador 
                FROM clases c 
                LEFT JOIN entrenadores e ON c.entrenador_id = e.id";
        $resultado = $this->db->query($sql);
        while($row = $resultado->fetch_assoc()) {
            $this->datos[] = $row;
        }
        return $this->datos;
    }
    
    public function get_clase_by_id($id) {
        $sql = "SELECT c.*, e.nombre as nombre_entrenador 
                FROM clases c 
                LEFT JOIN entrenadores e ON c.entrenador_id = e.id 
                WHERE c.id = $id";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }
    
    // Métodos para horarios
    public function get_horarios() {
        $sql = "SELECT h.*, c.nombre as nombre_clase 
                FROM horarios h 
                JOIN clases c ON h.clase_id = c.id";
        $resultado = $this->db->query($sql);
        while($row = $resultado->fetch_assoc()) {
            $this->datos[] = $row;
        }
        return $this->datos;
    }
    
    public function get_horarios_by_clase($clase_id) {
        $sql = "SELECT h.*, c.nombre as nombre_clase 
                FROM horarios h 
                JOIN clases c ON h.clase_id = c.id 
                WHERE h.clase_id = $clase_id";
        $resultado = $this->db->query($sql);
        $horarios = array();
        while($row = $resultado->fetch_assoc()) {
            $horarios[] = $row;
        }
        return $horarios;
    }
    
    // Métodos para ejercicios
    public function get_ejercicios() {
        $sql = "SELECT * FROM ejercicios";
        $resultado = $this->db->query($sql);
        while($row = $resultado->fetch_assoc()) {
            $this->datos[] = $row;
        }
        return $this->datos;
    }
    
    public function get_ejercicio_by_id($id) {
        $sql = "SELECT * FROM ejercicios WHERE id = $id";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }
    
    // Métodos para rutinas
    public function get_rutinas() {
        $sql = "SELECT r.*, u.nombre as nombre_usuario 
                FROM rutinas r 
                JOIN usuarios u ON r.usuario_id = u.id_usuario";
        $resultado = $this->db->query($sql);
        while($row = $resultado->fetch_assoc()) {
            $this->datos[] = $row;
        }
        return $this->datos;
    }
    
    public function get_rutina_by_id($id) {
        $sql = "SELECT r.*, u.nombre as nombre_usuario 
                FROM rutinas r 
                JOIN usuarios u ON r.usuario_id = u.id_usuario 
                WHERE r.id = $id";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }
    
    public function get_ejercicios_by_rutina($rutina_id) {
        $sql = "SELECT e.*, re.series, re.repeticiones, re.dia_semana 
                FROM ejercicios e 
                INNER JOIN rutina_ejercicios re ON e.id = re.ejercicio_id 
                WHERE re.rutina_id = ? 
                ORDER BY 
                    CASE re.dia_semana 
                        WHEN 'Lunes' THEN 1 
                        WHEN 'Martes' THEN 2 
                        WHEN 'Miércoles' THEN 3 
                        WHEN 'Jueves' THEN 4 
                        WHEN 'Viernes' THEN 5 
                        WHEN 'Sábado' THEN 6 
                        WHEN 'Domingo' THEN 7 
                    END";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $rutina_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $ejercicios = array();
        while($row = $resultado->fetch_assoc()) {
            $ejercicios[] = $row;
        }
        return $ejercicios;
    }
    
    // Métodos para planes nutricionales
    public function get_planes_nutricionales() {
        $sql = "SELECT p.*, u.nombre as nombre_usuario 
                FROM planes_nutricionales p 
                JOIN usuarios u ON p.usuario_id = u.id_usuario";
        $resultado = $this->db->query($sql);
        while($row = $resultado->fetch_assoc()) {
            $this->datos[] = $row;
        }
        return $this->datos;
    }
    
    public function get_plan_nutricional_by_id($nombre) {
        $sql = "SELECT p.*, u.nombre as nombre_usuario 
                FROM planes_nutricionales p 
                JOIN usuarios u ON p.usuario_id = u.id_usuario 
                WHERE u.nombre = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
    
    public function get_dieta_by_plan($plan_id) {
        $sql = "SELECT * FROM dieta_diaria WHERE plan_id = $plan_id";
        $resultado = $this->db->query($sql);
        $dietas = array();
        while($row = $resultado->fetch_assoc()) {
            $dietas[] = $row;
        }
        return $dietas;
    }
    
    // Método general para obtener todas las datos
    public function get_datos() {
        $this->get_usuarios();
        $this->get_entrenadores();
        $this->get_clases();
        $this->get_horarios();
        $this->get_ejercicios();
        $this->get_rutinas();
        $this->get_planes_nutricionales();
        return $this->datos;
    }

    // Método para obtener las clases del usuario para hoy
    public function get_clases_hoy_usuario($usuario_id) {
        // Primero obtenemos el día actual y lo convertimos a español
        $sql_dia = "SELECT CASE DAYNAME(CURDATE())
            WHEN 'Monday' THEN 'Lunes'
            WHEN 'Tuesday' THEN 'Martes'
            WHEN 'Wednesday' THEN 'Miércoles'
            WHEN 'Thursday' THEN 'Jueves'
            WHEN 'Friday' THEN 'Viernes'
            WHEN 'Saturday' THEN 'Sábado'
            WHEN 'Sunday' THEN 'Domingo'
        END as dia_actual";
        
        $resultado_dia = $this->db->query($sql_dia);
        $dia_actual = $resultado_dia->fetch_assoc()['dia_actual'];
        
        error_log("Día actual en español: " . $dia_actual);
        error_log("ID de usuario: " . $usuario_id);

        // Primero verificamos todas las clases del usuario sin filtrar por día
        $sql_check = "SELECT c.nombre, h.dia_semana, h.hora_inicio, h.hora_fin 
                     FROM inscripciones i 
                     JOIN clases c ON i.clase_id = c.id 
                     JOIN horarios h ON i.horario_id = h.id 
                     WHERE i.usuario_id = ?";
        
        $stmt = $this->db->prepare($sql_check);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado_check = $stmt->get_result();
        
        error_log("Todas las clases del usuario:");
        while($row = $resultado_check->fetch_assoc()) {
            error_log(print_r($row, true));
        }

        // Ahora la consulta principal
        $sql = "SELECT c.nombre, c.descripcion, e.nombre as nombre_entrenador, h.dia_semana, h.hora_inicio, h.hora_fin 
                FROM inscripciones i 
                JOIN clases c ON i.clase_id = c.id 
                JOIN horarios h ON i.horario_id = h.id 
                JOIN entrenadores e ON c.entrenador_id = e.id 
                WHERE i.usuario_id = ? 
                AND h.dia_semana = ?
                ORDER BY h.hora_inicio";
        
        error_log("SQL Query (clases hoy): " . $sql);
        error_log("Parámetros: usuario_id=" . $usuario_id . ", dia_actual=" . $dia_actual);
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $usuario_id, $dia_actual);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $clases = array();
        while($row = $resultado->fetch_assoc()) {
            $clases[] = $row;
            error_log("Clase encontrada: " . print_r($row, true));
        }
        
        error_log("Número de clases hoy encontradas: " . count($clases));
        return $clases;
    }

    // Método para obtener las próximas clases del usuario
    public function get_proximas_clases_usuario($usuario_id) {
        // Primero obtenemos el día actual y lo convertimos a español
        $sql_dia = "SELECT CASE DAYNAME(CURDATE())
            WHEN 'Monday' THEN 'Lunes'
            WHEN 'Tuesday' THEN 'Martes'
            WHEN 'Wednesday' THEN 'Miércoles'
            WHEN 'Thursday' THEN 'Jueves'
            WHEN 'Friday' THEN 'Viernes'
            WHEN 'Saturday' THEN 'Sábado'
            WHEN 'Sunday' THEN 'Domingo'
        END as dia_actual";
        
        $resultado_dia = $this->db->query($sql_dia);
        $dia_actual = $resultado_dia->fetch_assoc()['dia_actual'];
        
        error_log("Día actual en español (próximas): " . $dia_actual);

        $sql = "SELECT c.nombre, c.descripcion, e.nombre as nombre_entrenador, h.dia_semana, h.hora_inicio, h.hora_fin 
                FROM inscripciones i 
                JOIN clases c ON i.clase_id = c.id 
                JOIN horarios h ON i.horario_id = h.id 
                JOIN entrenadores e ON c.entrenador_id = e.id 
                WHERE i.usuario_id = ? 
                AND h.dia_semana != ?
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
        
        error_log("SQL Query (próximas clases): " . $sql);
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $usuario_id, $dia_actual);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $clases = array();
        while($row = $resultado->fetch_assoc()) {
            $clases[] = $row;
        }
        
        error_log("Número de próximas clases encontradas: " . count($clases));
        return $clases;
    }

    public function get_info_nutricional_plan($plan_id) {
        $sql = "SELECT 
                SUM(a.calorias) as total_calorias,
                SUM(a.proteinas) as total_proteinas,
                SUM(a.carbohidratos) as total_carbohidratos,
                SUM(a.grasas) as total_grasas
                FROM dieta_diaria d
                JOIN alimentos a ON d.descripcion LIKE CONCAT('%', a.nombre, '%')
                WHERE d.plan_id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $plan_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function get_rutina_by_usuario($nombre_usuario) {
        $sql = "SELECT r.* FROM rutinas r 
                INNER JOIN usuarios u ON r.usuario_id = u.id_usuario 
                WHERE u.nombre = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function get_progreso_rutina($rutina_id) {
        $sql = "SELECT e.nombre, p.peso, p.repeticiones, p.fecha 
                FROM progreso_ejercicios p 
                INNER JOIN ejercicios e ON p.ejercicio_id = e.id 
                WHERE p.rutina_id = ? 
                ORDER BY p.fecha DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $rutina_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $progreso = array();
        while($row = $resultado->fetch_assoc()) {
            $progreso[] = $row;
        }
        return $progreso;
    }

    public function registrar_progreso_ejercicio($rutina_id, $ejercicio_id, $peso, $repeticiones) {
        $sql = "INSERT INTO progreso_ejercicios (rutina_id, ejercicio_id, peso, repeticiones, fecha) 
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiii", $rutina_id, $ejercicio_id, $peso, $repeticiones);
        return $stmt->execute();
    }
}
?>