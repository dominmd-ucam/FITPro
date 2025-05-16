<?php
require_once 'conectar.php';

class EntrenadoresModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conectar::conexion();
    }

    public function getEntrenadores() {
        try {
            $query = "SELECT * FROM entrenadores";
            $resultado = $this->conexion->query($query);
            if (!$resultado) {
                throw new Exception("Error en la consulta: " . $this->conexion->error);
            }
            return $resultado;
        } catch (Exception $e) {
            error_log("Error en getEntrenadores: " . $e->getMessage());
            return false;
        }
    }

    public function getEntrenadorById($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM entrenadores WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function crearEntrenador($nombre, $especialidad, $telefono, $email) {
        $stmt = $this->conexion->prepare("INSERT INTO entrenadores (nombre, especialidad, telefono, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $especialidad, $telefono, $email);
        return $stmt->execute();
    }

    public function actualizarEntrenador($id, $nombre, $especialidad, $telefono, $email) {
        try {
            $stmt = $this->conexion->prepare("UPDATE entrenadores SET nombre = ?, especialidad = ?, telefono = ?, email = ? WHERE id = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
            }
            
            $stmt->bind_param("ssssi", $nombre, $especialidad, $telefono, $email, $id);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la actualización: " . $stmt->error);
            }
            
            return $stmt->affected_rows > 0;
        } catch (Exception $e) {
            error_log("Error en actualizarEntrenador: " . $e->getMessage());
            return false;
        }
    }

    public function getClasesEntrenador($id) {
        $stmt = $this->conexion->prepare("SELECT c.*, h.dia_semana, h.hora_inicio, h.hora_fin 
                                        FROM clases c 
                                        LEFT JOIN horarios h ON c.id = h.clase_id 
                                        WHERE c.entrenador_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $clases = array();
        while($row = $resultado->fetch_assoc()) {
            $clases[] = $row;
        }
        return $clases;
    }

    public function crear_entrenador($nombre, $email, $telefono, $especialidad) {
        try {
            // Verificar si el email ya existe
            $stmt = $this->conexion->prepare("SELECT COUNT(*) as count FROM entrenadores WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            if ($row['count'] > 0) {
                return ['success' => false, 'message' => 'El email ya está registrado'];
            }

            // Si el email no existe, proceder con la inserción
            $stmt = $this->conexion->prepare("INSERT INTO entrenadores (nombre, email, telefono, especialidad) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $email, $telefono, $especialidad);
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Entrenador creado exitosamente'];
            } else {
                return ['success' => false, 'message' => 'Error al crear el entrenador: ' . $stmt->error];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error al crear el entrenador: ' . $e->getMessage()];
        }
    }

    public function get_entrenador_by_id($id) {
        try {
            $sql = "SELECT * FROM entrenadores WHERE id = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([$id]);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update_entrenador($id, $nombre, $email, $telefono, $especialidad) {
        try {
            $sql = "UPDATE entrenadores SET nombre = ?, email = ?, telefono = ?, especialidad = ? WHERE id = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([$nombre, $email, $telefono, $especialidad, $id]);
            
            return ['success' => true, 'message' => 'Entrenador actualizado exitosamente'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error al actualizar el entrenador: ' . $e->getMessage()];
        }
    }

    public function delete_entrenador($id) {
        try {
            $sql = "DELETE FROM entrenadores WHERE id = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([$id]);
            
            return ['success' => true, 'message' => 'Entrenador eliminado exitosamente'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error al eliminar el entrenador: ' . $e->getMessage()];
        }
    }

    public function verificarEmail($email, $id = null) {
        try {
            $sql = "SELECT COUNT(*) as count FROM entrenadores WHERE email = ?";
            $params = [$email];
            
            if ($id !== null) {
                $sql .= " AND id != ?";
            }
            
            $stmt = $this->conexion->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
            }
            
            if ($id !== null) {
                $stmt->bind_param("si", $email, $id);
            } else {
                $stmt->bind_param("s", $email);
            }
            
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }
            
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            return $row['count'] > 0;
        } catch (Exception $e) {
            error_log("Error en verificarEmail: " . $e->getMessage());
            return false;
        }
    }
}
?>