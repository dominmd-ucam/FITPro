-- Insertar datos en la tabla usuarios (añadiendo 8 nuevos además de los existentes)
INSERT INTO usuarios (id, nombre, email, contraseña, tipo) VALUES
(1, 'roberto', 'robertosegadodiaz@gmail.com', '1234', 'admin'),
(2, 'lui', 'asdasd@asda.com', '1234', 'cliente'),
(3, 'Domin', 'dominmd99@gmail.com', '1234', 'admin'),
(5, 'pedro', 'pericopericales@elterrordelospascales', '1234', 'cliente'),
(6, 'Domin2', 'domin2@gmail.com', '1234', 'cliente'),
(7, 'María García', 'maria.garcia@email.com', 'pass123', 'cliente'),
(8, 'Juan Pérez', 'juan.perez@email.com', 'pass123', 'cliente'),
(9, 'Ana Rodríguez', 'ana.rodriguez@email.com', 'pass123', 'cliente'),
(10, 'Carlos Sánchez', 'carlos.sanchez@email.com', 'pass123', 'cliente'),
(11, 'Laura Martínez', 'laura.martinez@email.com', 'pass123', 'cliente'),
(12, 'David López', 'david.lopez@email.com', 'pass123', 'cliente'),
(13, 'Sofía Fernández', 'sofia.fernandez@email.com', 'pass123', 'cliente');

-- Insertar datos en la tabla entrenadores
INSERT INTO entrenadores (id, nombre, especialidad, telefono, email) VALUES
(1, 'Carlos Martínez', 'Crossfit', '555-1234', 'carlos.martinez@gimnasio.com'),
(2, 'Ana López', 'Yoga', '555-5678', 'ana.lopez@gimnasio.com'),
(3, 'Miguel Ángel', 'Boxeo', '555-9012', 'miguel.angel@gimnasio.com'),
(4, 'Elena Gómez', 'Pilates', '555-3456', 'elena.gomez@gimnasio.com'),
(5, 'Javier Ruiz', 'Spinning', '555-7890', 'javier.ruiz@gimnasio.com'),
(6, 'Patricia Díaz', 'Zumba', '555-2345', 'patricia.diaz@gimnasio.com'),
(7, 'Fernando Castro', 'Funcional', '555-6789', 'fernando.castro@gimnasio.com'),
(8, 'Lucía Méndez', 'TRX', '555-0123', 'lucia.mendez@gimnasio.com'),
(9, 'Raúl Navarro', 'Calistenia', '555-4567', 'raul.navarro@gimnasio.com'),
(10, 'Marta Jiménez', 'HIIT', '555-8901', 'marta.jimenez@gimnasio.com');

-- Insertar datos en la tabla clases
INSERT INTO clases (id, nombre, descripcion, entrenador_id) VALUES
(1, 'Crossfit Avanzado', 'Clase intensiva de crossfit para niveles avanzados', 1),
(2, 'Yoga Matutino', 'Clase de yoga para empezar el día con energía', 2),
(3, 'Boxeo Fitness', 'Clase de boxeo para mejorar condición física', 3),
(4, 'Pilates Reformer', 'Clase de pilates con máquinas especializadas', 4),
(5, 'Spinning Intenso', 'Clase de ciclismo indoor de alta intensidad', 5),
(6, 'Zumba Party', 'Clase de baile divertida para quemar calorías', 6),
(7, 'Entrenamiento Funcional', 'Ejercicios para mejorar movimientos cotidianos', 7),
(8, 'TRX Total', 'Entrenamiento en suspensión para todo el cuerpo', 8),
(9, 'Calistenia Básica', 'Ejercicios con peso corporal para principiantes', 9),
(10, 'HIIT Challenge', 'Entrenamiento interválico de alta intensidad', 10);

-- Insertar datos en la tabla horarios
INSERT INTO horarios (id, clase_id, dia_semana, hora_inicio, hora_fin) VALUES
(1, 1, 'Lunes', '18:00:00', '19:00:00'),
(2, 2, 'Martes', '07:00:00', '08:00:00'),
(3, 3, 'Miércoles', '19:00:00', '20:00:00'),
(4, 4, 'Jueves', '09:00:00', '10:00:00'),
(5, 5, 'Viernes', '18:30:00', '19:30:00'),
(6, 6, 'Sábado', '11:00:00', '12:00:00'),
(7, 7, 'Lunes', '17:00:00', '18:00:00'),
(8, 8, 'Martes', '20:00:00', '21:00:00'),
(9, 9, 'Miércoles', '18:00:00', '19:00:00'),
(10, 10, 'Jueves', '19:30:00', '20:15:00');

-- Insertar datos en la tabla inventario
INSERT INTO inventario (id, nombre_equipo, cantidad, estado) VALUES
(1, 'Mancuernas 10kg', 15, 'bueno'),
(2, 'Bicicleta estática', 5, 'mantenimiento'),
(3, 'Barras olímpicas', 8, 'bueno'),
(4, 'Discos de peso', 50, 'bueno'),
(5, 'Colchonetas', 20, 'bueno'),
(6, 'Kettlebells', 12, 'bueno'),
(7, 'Cuerdas para saltar', 15, 'dañado'),
(8, 'Bandas elásticas', 30, 'bueno'),
(9, 'Steps', 10, 'bueno'),
(10, 'Balones medicinales', 8, 'mantenimiento');

-- Insertar datos en la tabla membresias
INSERT INTO membresias (id, nombre, precio, duracion_dias) VALUES
(1, 'Premium', 59.99, 30),
(2, 'Básica', 29.99, 30),
(3, 'Anual Gold', 499.99, 365),
(4, 'Trimestral', 149.99, 90),
(5, 'Familiar', 99.99, 30),
(6, 'Estudiante', 24.99, 30),
(7, 'Nocturna', 39.99, 30),
(8, 'Weekend', 19.99, 30),
(9, 'Solo Clases', 44.99, 30),
(10, 'VIP', 89.99, 30);

-- Insertar datos en la tabla usuarios_membresias
INSERT INTO usuarios_membresias (id, usuario_id, membresia_id, fecha_inicio, fecha_fin) VALUES
(1, 2, 1, '2023-01-01', '2023-01-31'),
(2, 5, 2, '2023-01-15', '2023-02-14'),
(3, 7, 3, '2023-02-01', '2024-02-01'),
(4, 8, 4, '2023-03-01', '2023-05-30'),
(5, 9, 5, '2023-01-10', '2023-02-09'),
(6, 10, 6, '2023-02-15', '2023-03-17'),
(7, 11, 7, '2023-01-20', '2023-02-19'),
(8, 12, 8, '2023-03-01', '2023-03-31'),
(9, 13, 9, '2023-02-10', '2023-03-12'),
(10, 6, 10, '2023-01-05', '2023-02-04');

-- Insertar datos en la tabla inscripciones
INSERT INTO inscripciones (id, usuario_id, clase_id, horario_id, fecha_inscripcion) VALUES
(1, 2, 1, 1, '2023-01-10'),
(2, 5, 2, 2, '2023-01-12'),
(3, 7, 3, 3, '2023-02-05'),
(4, 8, 4, 4, '2023-03-02'),
(5, 9, 5, 5, '2023-01-18'),
(6, 10, 6, 6, '2023-02-20'),
(7, 11, 7, 7, '2023-01-22'),
(8, 12, 8, 8, '2023-03-05'),
(9, 13, 9, 9, '2023-02-12'),
(10, 6, 10, 10, '2023-01-08');

-- Insertar datos en la tabla registro_accesos
INSERT INTO registro_accesos (id, usuario_id, fecha, tipo, codigo_qr) VALUES
(1, 2, '2023-01-10 17:45:00', 'entrada', 'QR12345678'),
(2, 2, '2023-01-10 19:05:00', 'salida', 'QR12345678'),
(3, 5, '2023-01-12 06:50:00', 'entrada', 'QR23456789'),
(4, 5, '2023-01-12 08:10:00', 'salida', 'QR23456789'),
(5, 7, '2023-02-05 18:45:00', 'entrada', 'QR34567890'),
(6, 7, '2023-02-05 20:05:00', 'salida', 'QR34567890'),
(7, 8, '2023-03-02 08:45:00', 'entrada', 'QR45678901'),
(8, 8, '2023-03-02 10:05:00', 'salida', 'QR45678901'),
(9, 9, '2023-01-18 18:15:00', 'entrada', 'QR56789012'),
(10, 9, '2023-01-18 19:45:00', 'salida', 'QR56789012');

-- Insertar datos en la tabla rutinas
INSERT INTO rutinas (id, usuario_id, nombre, descripcion, fecha_inicio, fecha_fin) VALUES
(1, 2, 'Rutina fuerza', 'Rutina para ganar fuerza muscular', '2023-01-01', '2023-03-01'),
(2, 5, 'Rutina cardio', 'Rutina para mejorar resistencia cardiovascular', '2023-01-15', '2023-02-15'),
(3, 7, 'Definición', 'Rutina para definir músculo', '2023-02-01', '2023-04-01'),
(4, 8, 'Volumen', 'Rutina para ganar masa muscular', '2023-03-01', '2023-06-01'),
(5, 9, 'Full Body', 'Rutina completa para todo el cuerpo', '2023-01-10', '2023-02-10'),
(6, 10, 'Piernas y glúteos', 'Rutina focalizada en piernas y glúteos', '2023-02-15', '2023-03-15'),
(7, 11, 'Abdomen marcado', 'Rutina para marcar abdomen', '2023-01-20', '2023-03-20'),
(8, 12, 'Espalda ancha', 'Rutina para desarrollar espalda', '2023-03-01', '2023-05-01'),
(9, 13, 'Brazos fuertes', 'Rutina para fortalecer brazos', '2023-02-10', '2023-04-10'),
(10, 6, 'Resistencia', 'Rutina para mejorar resistencia', '2023-01-05', '2023-02-05');

-- Insertar datos en la tabla ejercicios
INSERT INTO ejercicios (id, nombre, descripcion, grupo_muscular, equipo_necesario) VALUES
(1, 'Press banca', 'Ejercicio para pectorales', 'Pectorales', 'Banco plano y barra'),
(2, 'Sentadillas', 'Ejercicio para piernas', 'Piernas', 'Ninguno'),
(3, 'Dominadas', 'Ejercicio para espalda', 'Espalda', 'Barra de dominadas'),
(4, 'Fondos', 'Ejercicio para tríceps', 'Tríceps', 'Barras paralelas'),
(5, 'Curl de bíceps', 'Ejercicio para bíceps', 'Bíceps', 'Mancuernas'),
(6, 'Peso muerto', 'Ejercicio completo', 'Piernas y espalda', 'Barra olímpica'),
(7, 'Elevaciones laterales', 'Ejercicio para hombros', 'Hombros', 'Mancuernas'),
(8, 'Plancha abdominal', 'Ejercicio para core', 'Abdomen', 'Ninguno'),
(9, 'Zancadas', 'Ejercicio para piernas', 'Piernas', 'Ninguno'),
(10, 'Remo con barra', 'Ejercicio para espalda', 'Espalda', 'Barra olímpica');

-- Insertar datos en la tabla rutina_ejercicios
INSERT INTO rutina_ejercicios (id, rutina_id, ejercicio_id, series, repeticiones, dia_semana) VALUES
(1, 1, 1, 4, 8, 'Lunes'),
(2, 2, 2, 3, 12, 'Miércoles'),
(3, 3, 3, 4, 10, 'Martes'),
(4, 4, 4, 3, 15, 'Jueves'),
(5, 5, 5, 3, 12, 'Viernes'),
(6, 6, 6, 5, 5, 'Lunes'),
(7, 7, 7, 4, 10, 'Miércoles'),
(8, 8, 8, 3, 30, 'Viernes'),
(9, 9, 9, 4, 12, 'Martes'),
(10, 10, 10, 3, 10, 'Jueves');

-- Insertar datos en la tabla progreso_usuario
INSERT INTO progreso_usuario (id, usuario_id, fecha, peso, grasa_corporal, musculo, notas) VALUES
(1, 2, '2023-01-01', 75.5, 18.2, 42.1, 'Primera medición'),
(2, 2, '2023-02-01', 74.8, 17.5, 42.8, 'Progreso notable'),
(3, 5, '2023-01-15', 68.3, 20.1, 39.5, 'Inicio de rutina'),
(4, 5, '2023-02-15', 67.5, 19.3, 40.2, 'Mejoría visible'),
(5, 7, '2023-02-01', 82.0, 15.8, 45.3, 'Primer control'),
(6, 8, '2023-03-01', 70.2, 16.7, 43.0, 'Inicio volumen'),
(7, 9, '2023-01-10', 65.8, 19.5, 40.0, 'Primera medición'),
(8, 10, '2023-02-15', 60.5, 22.0, 38.0, 'Inicio entrenamiento'),
(9, 11, '2023-01-20', 58.7, 21.5, 37.5, 'Primer registro'),
(10, 12, '2023-03-01', 77.3, 14.9, 44.8, 'Inicio rutina espalda');

-- Insertar datos en la tabla planes_nutricionales
INSERT INTO planes_nutricionales (id, usuario_id, fecha_inicio, fecha_fin, objetivo) VALUES
(1, 2, '2023-01-01', '2023-03-01', 'ganancia muscular'),
(2, 5, '2023-01-15', '2023-02-15', 'pérdida de peso'),
(3, 7, '2023-02-01', '2023-04-01', 'definición'),
(4, 8, '2023-03-01', '2023-06-01', 'ganancia muscular'),
(5, 9, '2023-01-10', '2023-02-10', 'mantenimiento'),
(6, 10, '2023-02-15', '2023-03-15', 'pérdida de peso'),
(7, 11, '2023-01-20', '2023-03-20', 'definición'),
(8, 12, '2023-03-01', '2023-05-01', 'ganancia muscular'),
(9, 13, '2023-02-10', '2023-04-10', 'mantenimiento'),
(10, 6, '2023-01-05', '2023-02-05', 'pérdida de peso');

-- Insertar datos en la tabla dieta_diaria
INSERT INTO dieta_diaria (id, plan_id, dia_semana, comida, descripcion) VALUES
(1, 1, 'Lunes', 'Desayuno', 'Avena con proteína y frutas'),
(2, 2, 'Miércoles', 'Almuerzo', 'Pechuga de pollo con arroz integral y verduras'),
(3, 3, 'Martes', 'Cena', 'Salmón al horno con brócoli'),
(4, 4, 'Jueves', 'Desayuno', 'Tortilla de claras con pan integral'),
(5, 5, 'Viernes', 'Almuerzo', 'Lentejas con verduras y pollo'),
(6, 6, 'Sábado', 'Cena', 'Ensalada de atún con aguacate'),
(7, 7, 'Domingo', 'Desayuno', 'Smoothie de proteína con espinacas'),
(8, 8, 'Lunes', 'Almuerzo', 'Arroz con ternera y pimientos'),
(9, 9, 'Miércoles', 'Cena', 'Merluza con puré de coliflor'),
(10, 10, 'Jueves', 'Snack', 'Yogur griego con nueces');

-- Insertar datos en la tabla alimentos
INSERT INTO alimentos (id, nombre, calorias, proteinas, carbohidratos, grasas) VALUES
(1, 'Pechuga de pollo', 165.0, 31.0, 0.0, 3.6),
(2, 'Avena', 68.0, 2.4, 12.0, 1.4),
(3, 'Salmón', 208.0, 20.0, 0.0, 13.0),
(4, 'Huevo', 155.0, 13.0, 1.1, 11.0),
(5, 'Arroz integral', 111.0, 2.6, 23.0, 0.9),
(6, 'Brócoli', 34.0, 2.8, 6.6, 0.4),
(7, 'Atún', 144.0, 23.0, 0.0, 5.0),
(8, 'Aguacate', 160.0, 2.0, 9.0, 15.0),
(9, 'Yogur griego', 59.0, 10.0, 3.6, 0.4),
(10, 'Nueces', 654.0, 15.0, 14.0, 65.0);