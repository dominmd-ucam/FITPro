<?php
require_once 'conectar.php';

class ClasesModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conectar::conexion();
    }

    public function getClases() {
        $query = "SELECT c.*, e.nombre as nombre_entrenador, h.dia_semana, h.hora_inicio, h.hora_fin 
                 FROM clases c 
                 LEFT JOIN entrenadores e ON c.entrenador_id = e.id 
                 LEFT JOIN horarios h ON c.id = h.clase_id";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }

    public function crear_clase($nombre, $descripcion, $entrenador_id, $dia_semana, $hora_inicio, $hora_fin) {
        try {
            // Iniciar transacción
            $this->conexion->begin_transaction();

            // Insertar la clase
            $stmt = $this->conexion->prepare("INSERT INTO clases (nombre, descripcion, entrenador_id) VALUES (?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta de clase: " . $this->conexion->error);
            }
            
            $stmt->bind_param("ssi", $nombre, $descripcion, $entrenador_id);
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar la clase: " . $stmt->error);
            }
            
            $clase_id = $this->conexion->insert_id;

            // Insertar el horario
            $stmt = $this->conexion->prepare("INSERT INTO horarios (clase_id, dia_semana, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta de horario: " . $this->conexion->error);
            }
            
            $stmt->bind_param("isss", $clase_id, $dia_semana, $hora_inicio, $hora_fin);
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar el horario: " . $stmt->error);
            }

            // Confirmar transacción
            $this->conexion->commit();
            
            return ['success' => true, 'message' => 'Clase creada exitosamente'];
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $this->conexion->rollback();
            error_log("Error en crear_clase: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error al crear la clase: ' . $e->getMessage()];
        }
    }

    public function get_clase_by_id($id) {
        try {
            $query = "SELECT c.*, e.nombre as nombre_entrenador, h.dia_semana, h.hora_inicio, h.hora_fin 
                     FROM clases c 
                     LEFT JOIN entrenadores e ON c.entrenador_id = e.id 
                     LEFT JOIN horarios h ON c.id = h.clase_id 
                     WHERE c.id = ?";
            $stmt = $this->conexion->prepare($query);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
            }
            
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }
            
            $resultado = $stmt->get_result();
            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            error_log("Error en get_clase_by_id: " . $e->getMessage());
            return false;
        }
    }

    public function actualizar_clase($id, $nombre, $descripcion, $entrenador_id, $dia_semana, $hora_inicio, $hora_fin) {
        try {
            // Iniciar transacción
            $this->conexion->begin_transaction();

            // Actualizar la clase
            $stmt = $this->conexion->prepare("UPDATE clases SET nombre = ?, descripcion = ?, entrenador_id = ? WHERE id = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta de clase: " . $this->conexion->error);
            }
            
            $stmt->bind_param("ssii", $nombre, $descripcion, $entrenador_id, $id);
            if (!$stmt->execute()) {
                throw new Exception("Error al actualizar la clase: " . $stmt->error);
            }

            // Actualizar el horario
            $stmt = $this->conexion->prepare("UPDATE horarios SET dia_semana = ?, hora_inicio = ?, hora_fin = ? WHERE clase_id = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta de horario: " . $this->conexion->error);
            }
            
            $stmt->bind_param("sssi", $dia_semana, $hora_inicio, $hora_fin, $id);
            if (!$stmt->execute()) {
                throw new Exception("Error al actualizar el horario: " . $stmt->error);
            }

            // Confirmar transacción
            $this->conexion->commit();
            
            return ['success' => true, 'message' => 'Clase actualizada exitosamente'];
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $this->conexion->rollback();
            error_log("Error en actualizar_clase: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error al actualizar la clase: ' . $e->getMessage()];
        }
    }

    public function eliminar_clase($id) {
        try {
            // Iniciar transacción
            $this->conexion->begin_transaction();

            // Primero eliminar el horario asociado
            $stmt = $this->conexion->prepare("DELETE FROM horarios WHERE clase_id = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta de horario: " . $this->conexion->error);
            }
            
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar el horario: " . $stmt->error);
            }

            // Luego eliminar la clase
            $stmt = $this->conexion->prepare("DELETE FROM clases WHERE id = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta de clase: " . $this->conexion->error);
            }
            
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar la clase: " . $stmt->error);
            }

            // Confirmar transacción
            $this->conexion->commit();
            
            return ['success' => true, 'message' => 'Clase eliminada exitosamente'];
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $this->conexion->rollback();
            error_log("Error en eliminar_clase: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error al eliminar la clase: ' . $e->getMessage()];
        }
    }

    public function get_clases_hoy() {
        try {
            // Obtener el día actual en español
            $sql_dia = "SELECT CASE DAYNAME(CURDATE())
                WHEN 'Monday' THEN 'Lunes'
                WHEN 'Tuesday' THEN 'Martes'
                WHEN 'Wednesday' THEN 'Miércoles'
                WHEN 'Thursday' THEN 'Jueves'
                WHEN 'Friday' THEN 'Viernes'
                WHEN 'Saturday' THEN 'Sábado'
                WHEN 'Sunday' THEN 'Domingo'
            END as dia_actual";
            
            $resultado_dia = $this->conexion->query($sql_dia);
            $dia_actual = $resultado_dia->fetch_assoc()['dia_actual'];

            // Consulta para obtener las clases de hoy con sus alumnos
            $query = "SELECT c.id, c.nombre, c.descripcion, e.nombre as nombre_entrenador, 
                            h.dia_semana, h.hora_inicio, h.hora_fin,
                            GROUP_CONCAT(u.nombre SEPARATOR '||') as alumnos
                     FROM clases c 
                     LEFT JOIN entrenadores e ON c.entrenador_id = e.id 
                     LEFT JOIN horarios h ON c.id = h.clase_id 
                     LEFT JOIN inscripciones i ON c.id = i.clase_id
                     LEFT JOIN usuarios u ON i.usuario_id = u.id_usuario
                     WHERE h.dia_semana = ?
                     GROUP BY c.id, c.nombre, c.descripcion, e.nombre, h.dia_semana, h.hora_inicio, h.hora_fin
                     ORDER BY h.hora_inicio";

            $stmt = $this->conexion->prepare($query);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
            }
            
            $stmt->bind_param("s", $dia_actual);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }
            
            $resultado = $stmt->get_result();
            $clases = array();
            
            while($row = $resultado->fetch_assoc()) {
                // Convertir la cadena de alumnos en un array
                $row['alumnos'] = $row['alumnos'] ? explode('||', $row['alumnos']) : array();
                $clases[] = $row;
            }
            
            return $clases;
        } catch (Exception $e) {
            error_log("Error en get_clases_hoy: " . $e->getMessage());
            return array();
        }
    }

    public function eliminar_alumno_clase($clase_id, $alumno_nombre) {
        try {
            // Primero obtener el ID del usuario por su nombre
            $stmt = $this->conexion->prepare("SELECT id_usuario FROM usuarios WHERE nombre = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta de usuario: " . $this->conexion->error);
            }
            
            $stmt->bind_param("s", $alumno_nombre);
            if (!$stmt->execute()) {
                throw new Exception("Error al buscar el usuario: " . $stmt->error);
            }
            
            $resultado = $stmt->get_result();
            if ($resultado->num_rows === 0) {
                throw new Exception("Usuario no encontrado");
            }
            
            $usuario_id = $resultado->fetch_assoc()['id_usuario'];

            // Eliminar la inscripción
            $stmt = $this->conexion->prepare("DELETE FROM inscripciones WHERE clase_id = ? AND usuario_id = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta de inscripción: " . $this->conexion->error);
            }
            
            $stmt->bind_param("ii", $clase_id, $usuario_id);
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar la inscripción: " . $stmt->error);
            }

            return ['success' => true, 'message' => 'Alumno eliminado de la clase exitosamente'];
        } catch (Exception $e) {
            error_log("Error en eliminar_alumno_clase: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error al eliminar el alumno de la clase: ' . $e->getMessage()];
        }
    }
}
?> 