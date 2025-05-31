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
        try {
            $sql = "SELECT u.*, 
                    (SELECT m.nombre 
                     FROM usuarios_membresias um 
                     JOIN membresias m ON um.membresia_id = m.id 
                     WHERE um.usuario_id = u.id_usuario 
                     ORDER BY um.fecha_fin DESC 
                     LIMIT 1) as tipo_membresia,
                    (SELECT um.fecha_fin 
                     FROM usuarios_membresias um 
                     WHERE um.usuario_id = u.id_usuario 
                     ORDER BY um.fecha_fin DESC 
                     LIMIT 1) as fecha_fin_membresia 
                    FROM usuarios u";
            $consulta = $this->db->query($sql);
            if (!$consulta) {
                error_log("Error en get_usuarios: " . $this->db->error);
                return false;
            }
            return $consulta;
        } catch (Exception $e) {
            error_log("Error en get_usuarios: " . $e->getMessage());
            return false;
        }
    }

    // Login de usuario
    public function login($user, $contra) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE nombre=?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            return password_verify($contra, $usuario['passwd']);
        }
        return false;
    }

    // Comprobar si el usuario ya existe
    public function usuario_existe($user) {
        $stmt = $this->db->prepare("SELECT id_usuario FROM usuarios WHERE nombre = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // Comprobar si el email ya existe
    public function email_existe($email) {
        $stmt = $this->db->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // Registrar nuevo usuario (ahora incluye email y tipo)
    public function registrar_usuario($user, $email, $contra, $tipo = 'cliente') {
        $hash = password_hash($contra, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, passwd, tipo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user, $email, $hash, $tipo);
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
    
    //Comprobar si el usuario es Admin BD OLD
    // public function esAdmin($email) {
    //     $stmt = $this->db->prepare("SELECT admin FROM usuarios WHERE email = ? LIMIT 1");
    //     $stmt->bind_param("s", $email);
    //     $stmt->execute();
    //     $resultado = $stmt->get_result();
    
    //     if ($resultado->num_rows > 0) {
    //         $fila = $resultado->fetch_assoc();
    //         return (int)$fila['admin']; // Devuelve 0 o 1 como entero
    //     }
    
    //     return null;
    // }
    
    //Comprobar si el usuario es Admin ACTUALIZADO a nueva DB
    public function esAdmin($email) {
    $stmt = $this->db->prepare("SELECT tipo FROM usuarios WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['tipo'] === 'admin' ? 1 : 0; // Devuelve 1 o 0 como antes
    }

    return 0; // Por defecto devuelve 0 si no encuentra el usuario
}
    
    public function get_member_complete_data($id) {
        try {
            $stmt = $this->db->prepare("SELECT id_usuario, nombre, email, tipo FROM usuarios WHERE id_usuario = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            if ($resultado->num_rows > 0) {
                return $resultado->fetch_assoc();
            }
            
            return null;
        } catch (Exception $e) {
            error_log("Error en get_member_complete_data: " . $e->getMessage());
            return null;
        }
    }

    public function update_member($id, $nombre, $email, $tipo, $passwd = null) {
        try {
            if ($passwd) {
                $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, email = ?, tipo = ?, passwd = ? WHERE id_usuario = ?");
                $stmt->bind_param("ssssi", $nombre, $email, $tipo, $passwd, $id);
            } else {
                $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, email = ?, tipo = ? WHERE id_usuario = ?");
                $stmt->bind_param("sssi", $nombre, $email, $tipo, $id);
            }
            
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_membresia_data($id_usuario) {
        try {
            $sql = "SELECT um.fecha_inicio, um.fecha_fin, m.nombre as tipo_nombre 
                    FROM usuarios_membresias um 
                    JOIN membresias m ON um.membresia_id = m.id 
                    WHERE um.usuario_id = ? 
                    ORDER BY um.fecha_inicio DESC 
                    LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            if ($resultado->num_rows > 0) {
                $membresia = $resultado->fetch_assoc();
                $membresia['estado'] = strtotime($membresia['fecha_fin']) >= time() ? 'Activo' : 'Expirado';
                return $membresia;
            }
            return null;
        } catch (Exception $e) {
            error_log("Error en get_membresia_data: " . $e->getMessage());
            return null;
        }
    }

    public function get_rutinas_data($id) {
        try {
            $sql = "SELECT r.*, ur.fecha_asignacion, ur.estado 
                    FROM rutinas r 
                    JOIN usuarios_rutinas ur ON r.id = ur.rutina_id 
                    WHERE ur.usuario_id = ? 
                    ORDER BY ur.fecha_asignacion DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $rutinas = array();
            while($row = $resultado->fetch_assoc()) {
                $rutinas[] = $row;
            }
            return $rutinas;
        } catch (Exception $e) {
            error_log("Error en get_rutinas_data: " . $e->getMessage());
            return null;
        }
    }

    public function get_accesos_data($id) {
        try {
            $sql = "SELECT * FROM accesos 
                    WHERE usuario_id = ? 
                    ORDER BY fecha DESC, hora DESC 
                    LIMIT 10";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $accesos = array();
            while($row = $resultado->fetch_assoc()) {
                $accesos[] = $row;
            }
            return $accesos;
        } catch (Exception $e) {
            error_log("Error en get_accesos_data: " . $e->getMessage());
            return null;
        }
    }

    public function get_progreso_data($id) {
        try {
            $sql = "SELECT * FROM progreso 
                    WHERE usuario_id = ? 
                    ORDER BY fecha DESC 
                    LIMIT 10";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $progreso = array();
            while($row = $resultado->fetch_assoc()) {
                $progreso[] = $row;
            }
            return $progreso;
        } catch (Exception $e) {
            error_log("Error en get_progreso_data: " . $e->getMessage());
            return null;
        }
    }

    public function get_nutricion_data($id) {
        try {
            $sql = "SELECT pn.*, o.nombre as objetivo 
                    FROM planes_nutricion pn 
                    JOIN objetivos o ON pn.objetivo_id = o.id 
                    WHERE pn.usuario_id = ? 
                    ORDER BY pn.fecha_inicio DESC 
                    LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            if ($resultado->num_rows > 0) {
                return $resultado->fetch_assoc();
            }
            return null;
        } catch (Exception $e) {
            error_log("Error en get_nutricion_data: " . $e->getMessage());
            return null;
        }
    }

    public function get_clases_data($id) {
        try {
            $sql = "SELECT c.nombre, h.dia, h.hora_inicio, h.hora_fin, u.nombre as instructor 
                    FROM clases c 
                    JOIN horarios h ON c.id = h.clase_id 
                    JOIN usuarios_clases uc ON h.id = uc.horario_id 
                    JOIN usuarios u ON h.instructor_id = u.id 
                    WHERE uc.usuario_id = ? 
                    ORDER BY h.dia, h.hora_inicio";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            $clases = array();
            while($row = $resultado->fetch_assoc()) {
                $clases[] = $row;
            }
            return $clases;
        } catch (Exception $e) {
            error_log("Error en get_clases_data: " . $e->getMessage());
            return null;
        }
    }

    public function delete_member($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Miembro eliminado correctamente'];
            } else {
                return ['success' => false, 'message' => 'Error al eliminar el miembro'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    public function getUserIdByEmail($email) {
        $sql = "SELECT id_usuario FROM usuarios WHERE email = '$email'";
        $resultado = $this->db->query($sql);
        if ($row = $resultado->fetch_assoc()) {
            return $row['id_usuario'];
        }
        return null;
    }
}
?>
