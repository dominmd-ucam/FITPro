<?php
require_once 'conectar.php';

class Gimnasio_model {
    private $db;
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
        $sql = "SELECT re.*, e.nombre, e.grupo_muscular 
                FROM rutina_ejercicios re 
                JOIN ejercicios e ON re.ejercicio_id = e.id 
                WHERE re.rutina_id = $rutina_id";
        $resultado = $this->db->query($sql);
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
    
    public function get_plan_nutricional_by_id($id) {
        $sql = "SELECT p.*, u.nombre as nombre_usuario 
                FROM planes_nutricionales p 
                JOIN usuarios u ON p.usuario_id = u.id_usuario 
                WHERE p.id = $id";
        $resultado = $this->db->query($sql);
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
}
?>