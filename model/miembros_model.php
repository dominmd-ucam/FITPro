<?php
class Miembros_model {
    private $db;     // conexión con la BBDD
    private $datos;  // array de datos de la BBDD

    public function __construct() {
        require_once("model/conectar.php");
        $this->db = Conectar::conexion();
        $this->datos = [];
    }

    // Obtener todos los usuarios
    public function get_usuarios() {
        $sql = "SELECT * FROM usuarios";
        $consulta = $this->db->query($sql);
        while ($registro = $consulta->fetch_assoc()) {
            $this->datos[] = $registro; 
        }
        return $this->datos;
    }

    // Login de usuario
    public function login($user, $contra) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE nombre=? AND passwd=?");
        $stmt->bind_param("ss", $user, $contra);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return ($resultado->num_rows > 0);
    }

    // Comprobar si el usuario ya existe
    public function usuario_existe($user) {
        $stmt = $this->db->prepare("SELECT id_usuario FROM usuarios WHERE nombre = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // Registrar nuevo usuario (ahora incluye email)
    public function registrar_usuario($user, $email, $contra) {
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, passwd, admin) VALUES (?, ?, ?, 0)");
        $stmt->bind_param("sss", $user, $email, $contra);
        return $stmt->execute();
    }

    public function getEmail($usuario) {
        $stmt = $this->db->prepare("SELECT email FROM usuarios WHERE nombre = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['email'];
        }
    
        return null; // Si no se encuentra el usuario
    }
    
    //Comprobar si el usuario es Admin
    public function esAdmin($email) {
        $stmt = $this->db->prepare("SELECT admin FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return (int)$fila['admin']; // Devuelve 0 o 1 como entero
        }
    
        return null;
    }
    
    
    
}
?>
