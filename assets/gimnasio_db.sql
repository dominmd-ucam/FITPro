-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generacion: 18-05-2025 a las 05:00:57
-- Version del servidor: 10.4.28-MariaDB
-- Version de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gimnasio_db`
--
CREATE DATABASE IF NOT EXISTS `gimnasio_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gimnasio_db`;

-- --------------------------------------------------------



--
-- Estructura de tabla para la tabla `alimentos`
--

CREATE TABLE `alimentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `calorias` decimal(6,2) DEFAULT NULL,
  `proteinas` decimal(6,2) DEFAULT NULL,
  `carbohidratos` decimal(6,2) DEFAULT NULL,
  `grasas` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alimentos`
--

INSERT INTO `alimentos` (`id`, `nombre`, `calorias`, `proteinas`, `carbohidratos`, `grasas`) VALUES
(1, 'Pechuga de pollo', 165.00, 31.00, 0.00, 3.60),
(2, 'Avena', 68.00, 2.40, 12.00, 1.40),
(3, 'Salmon', 208.00, 20.00, 0.00, 13.00),
(4, 'Huevo', 155.00, 13.00, 1.10, 11.00),
(5, 'Arroz integral', 111.00, 2.60, 23.00, 0.90),
(6, 'Brocoli', 34.00, 2.80, 6.60, 0.40),
(7, 'Atun', 144.00, 23.00, 0.00, 5.00),
(8, 'Aguacate', 160.00, 2.00, 9.00, 15.00),
(9, 'Yogur griego', 59.00, 10.00, 3.60, 0.40),
(10, 'Nueces', 654.00, 15.00, 14.00, 65.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `entrenador_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `nombre`, `descripcion`, `entrenador_id`) VALUES
(1, 'Crossfit Avanzado', 'Clase intensiva de crossfit para niveles avanzados', 1),
(2, 'Yoga Matutino', 'Clase de yoga para empezar el dia con energia', 2),
(3, 'Boxeo Fitness', 'Clase de boxeo para mejorar condicion fisica', 3),
(4, 'Pilates Reformer', 'Clase de pilates con maquinas especializadas', 4),
(5, 'Spinning Intenso', 'Clase de ciclismo indoor de alta intensidad', 5),
(6, 'Zumba Party', 'Clase de baile divertida para quemar calorias', 6),
(7, 'Entrenamiento Funcional', 'Ejercicios para mejorar movimientos cotidianos', 7),
(8, 'TRX Total', 'Entrenamiento en suspension para todo el cuerpo', 8),
(9, 'Calistenia Basica', 'Ejercicios con peso corporal para principiantes', 9),
(10, 'HIIT Challenge', 'Entrenamiento intervalico de alta intensidad', 10),
(11, 'Clase MMA', 'Clase de tecnicas de defensa personal y MMA', 7),
(17, 'Pilates', 'Clase especializada en pilates para señoras', 10),
(18, 'Power Pump', 'Entrenamiento de fuerza con pesas y barra.', 7),
(19, 'Yoga Flow', 'Secuencia fluida para activar cuerpo y mente.', 2),
(20, 'HIIT Inferno', 'Cardio intenso en intervalos cortos para quemar grasa.', 1),
(21, 'Spinning Energy', 'Clase de ciclismo indoor con música motivadora.', 8),
(22, 'Pilates Core', 'Fortalece tu centro y mejora la postura.', 7),
(23, 'Box Fit', 'Entrenamiento funcional con técnicas de boxeo.', 3),
(24, 'Cardio Dance', 'Baile aeróbico para quemar calorías con ritmo.', 4),
(25, 'Stretch & Relax', 'Estiramientos guiados para soltar tensiones.', 1),
(26, 'Full Body Circuit', 'Circuito completo para trabajar todo el cuerpo.', 9),
(27, 'Functional Express', '30 minutos intensos de entrenamiento funcional.', 6),
(28, 'TRX Training', 'Suspensión corporal para fuerza y equilibrio.', 5),
(29, 'Zumba Party', 'Clase de baile latino para divertirte y sudar.', 7),
(30, 'Sunrise Mobility', 'Movilidad articular y activación suave.', 5),
(31, 'Core Blast', 'Rutina específica para abdominales y zona lumbar.', 5),
(32, 'Bootcamp Outdoor', 'Entrenamiento en el parque con peso corporal.', 9),
(33, 'Weekend Warrior', 'Entrenamiento de alta intensidad en grupo.', 5),
(34, 'Yoga Restaurativo', 'Práctica suave para relajación profunda.', 3),
(35, 'Combat Cardio', 'Movimientos inspirados en artes marciales.', 9),
(36, 'Mindful Movement', 'Movimientos conscientes para conectar cuerpo y mente.', 9),
(39, 'Stretch & Breathe', 'Estiramientos largos y respiración guiada.', 7),
(40, 'Family Fit', 'Sesión divertida para todas las edades.', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dieta_diaria`
--

CREATE TABLE `dieta_diaria` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `dia_semana` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo') DEFAULT NULL,
  `comida` enum('Desayuno','Almuerzo','Cena','Snack') DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dieta_diaria`
--

INSERT INTO `dieta_diaria` (`id`, `plan_id`, `dia_semana`, `comida`, `descripcion`) VALUES
(1, 1, 'Lunes', 'Desayuno', 'Avena con proteina y frutas'),
(4, 4, 'Jueves', 'Desayuno', 'Tortilla de claras con pan integral'),
(5, 5, 'Viernes', 'Almuerzo', 'Lentejas con verduras y pollo'),
(6, 6, 'Sabado', 'Cena', 'Ensalada de atun con aguacate'),
(7, 7, 'Domingo', 'Desayuno', 'Smoothie de proteina con espinacas'),
(8, 8, 'Lunes', 'Almuerzo', 'Arroz con ternera y pimientos'),
(9, 9, 'Miercoles', 'Cena', 'Merluza con pure de coliflor'),
(10, 10, 'Jueves', 'Snack', 'Yogur griego con nueces'),
(12, 1, 'Lunes', 'Almuerzo', 'Arroz integral, pechuga de pollo a la plancha y brocoli al vapor'),
(13, 1, 'Lunes', 'Cena', 'Salmon al horno con esparragos y pure de batata'),
(14, 1, 'Martes', 'Desayuno', 'Tortilla de 3 claras y 1 huevo entero con pan integral y aguacate'),
(15, 1, 'Martes', 'Almuerzo', 'Lentejas con arroz, filete de ternera y ensalada verde'),
(16, 1, 'Martes', 'Cena', 'Atun a la plancha con quinoa y espinacas salteadas'),
(17, 1, 'Miercoles', 'Desayuno', 'Yogur griego con granola, nueces y miel'),
(18, 1, 'Miercoles', 'Almuerzo', 'Pasta integral con carne picada magra y salsa de tomate natural'),
(19, 1, 'Miercoles', 'Cena', 'Pechuga de pavo con pure de coliflor y zanahorias'),
(20, 1, 'Jueves', 'Desayuno', 'Smoothie de proteina con leche de almendras, espinacas y frutos rojos'),
(21, 1, 'Jueves', 'Almuerzo', 'Arroz basmati, merluza al horno y judias verdes'),
(22, 1, 'Jueves', 'Cena', 'Tortilla francesa con jamon de pavo y ensalada de tomate'),
(23, 1, 'Viernes', 'Desayuno', 'Tostadas integrales con huevo pochado y aguacate'),
(24, 1, 'Viernes', 'Almuerzo', 'Patata asada, filete de lomo y pimientos asados'),
(25, 1, 'Viernes', 'Cena', 'Ensalada Cesar con pollo a la parrilla y aderezo light'),
(26, 1, 'Sabado', 'Desayuno', 'Gachas de avena con canela, manzana y almendras'),
(27, 1, 'Sabado', 'Almuerzo', 'Paella de marisco con ensalada mediterranea'),
(28, 1, 'Sabado', 'Cena', 'Sardinas a la plancha con pan integral y pimientos'),
(29, 1, 'Domingo', 'Desayuno', 'Revuelto de huevos con champiñones y jamon serrano'),
(30, 1, 'Domingo', 'Almuerzo', 'Estofado de ternera con patatas y zanahorias'),
(31, 1, 'Domingo', 'Cena', 'Ensalada de quinoa con aguacate, tomate y pepino'),
(32, 2, 'Lunes', 'Desayuno', 'Yogur natural desnatado con semillas de chia y fresas'),
(33, 2, 'Lunes', 'Almuerzo', 'Ensalada de espinacas, pechuga de pollo y vinagreta de limon'),
(34, 2, 'Lunes', 'Cena', 'Crema de calabacin con tortilla de esparragos'),
(35, 2, 'Martes', 'Desayuno', 'Te verde con tostada de pan integral y queso fresco'),
(36, 2, 'Martes', 'Almuerzo', 'Merluza al vapor con esparragos trigueros y alcachofas'),
(37, 2, 'Martes', 'Cena', 'Ensalada de tomate, atun y cebolla con aceite de oliva'),
(38, 2, 'Miercoles', 'Desayuno', 'Smoothie verde (espinaca, piña y jengibre)'),
(39, 2, 'Miercoles', 'Almuerzo', 'Calabacin relleno de carne picada magra al horno'),
(40, 2, 'Miercoles', 'Cena', 'Sopa de miso con tofu y algas wakame'),
(41, 2, 'Jueves', 'Desayuno', 'Avena con leche desnatada y canela'),
(42, 2, 'Jueves', 'Almuerzo', 'Ensalada Cesar light con pechuga a la plancha'),
(43, 2, 'Jueves', 'Cena', 'Revuelto de setas con gambas y esparragos'),
(44, 2, 'Viernes', 'Desayuno', 'Tortitas de avena con compota de manzana sin azucar'),
(45, 2, 'Viernes', 'Almuerzo', 'Pescado blanco al horno con pimientos asados'),
(46, 2, 'Viernes', 'Cena', 'Crema de puerros con trocitos de jamon cocido'),
(47, 2, 'Sabado', 'Desayuno', 'Tostada integral con aguacate y huevo escalfado'),
(48, 2, 'Sabado', 'Almuerzo', 'Ensalada de garbanzos, pimiento y atun'),
(49, 2, 'Sabado', 'Cena', 'Caldo depurativo con trozos de pollo y verduras'),
(50, 2, 'Domingo', 'Desayuno', 'Batido de proteinas con leche de almendras'),
(51, 2, 'Domingo', 'Almuerzo', 'Ternera a la plancha con ensalada de rucula y parmesano'),
(52, 2, 'Domingo', 'Cena', 'Sopa de pescado con trozos de merluza'),
(53, 3, 'Lunes', 'Desayuno', 'Claras de huevo con espinacas y avena'),
(54, 3, 'Lunes', 'Almuerzo', 'Pechuga de pollo con brocoli y arroz basmati'),
(55, 3, 'Lunes', 'Cena', 'Merluza con ensalada de esparragos y tomate'),
(56, 3, 'Martes', 'Desayuno', 'Yogur griego 0% con nueces y semillas de lino'),
(57, 3, 'Martes', 'Almuerzo', 'Solomillo de ternera con pure de coliflor'),
(58, 3, 'Martes', 'Cena', 'Tortilla de claras con champiñones y esparragos'),
(59, 3, 'Miercoles', 'Desayuno', 'Smoothie de proteina con agua y fresas'),
(60, 3, 'Miercoles', 'Almuerzo', 'Salmon a la plancha con quinoa y espinacas'),
(61, 3, 'Miercoles', 'Cena', 'Ensalada de pollo, lechuga y pepino con vinagreta'),
(62, 3, 'Jueves', 'Desayuno', 'Tostadas de pan integral con pavo y queso fresco'),
(63, 3, 'Jueves', 'Almuerzo', 'Pulpo a la gallega con patatas cocidas'),
(64, 3, 'Jueves', 'Cena', 'Revuelto de gambas con calabacin'),
(65, 3, 'Viernes', 'Desayuno', 'Gachas de avena con proteina en polvo'),
(66, 3, 'Viernes', 'Almuerzo', 'Lomo de cerdo magro con ensalada de tomate'),
(67, 3, 'Viernes', 'Cena', 'Sopa de marisco con trozos de pescado'),
(68, 3, 'Sabado', 'Desayuno', 'Claras de huevo con avena y canela'),
(69, 3, 'Sabado', 'Almuerzo', 'Pechuga de pavo con arroz salvaje y esparragos'),
(70, 3, 'Sabado', 'Cena', 'Atun rojo con pimientos asados'),
(71, 3, 'Domingo', 'Desayuno', 'Tortitas de proteina con frutos rojos'),
(72, 3, 'Domingo', 'Almuerzo', 'Conejo al horno con ensalada verde'),
(73, 3, 'Domingo', 'Cena', 'Sopa de pescado con trozos de merluza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `grupo_muscular` varchar(100) DEFAULT NULL,
  `equipo_necesario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id`, `nombre`, `descripcion`, `grupo_muscular`, `equipo_necesario`) VALUES
(1, 'Press banca', 'Ejercicio para pectorales', 'Pectorales', 'Banco plano y barra'),
(2, 'Sentadillas', 'Ejercicio para piernas', 'Piernas', 'Ninguno'),
(3, 'Dominadas', 'Ejercicio para espalda', 'Espalda', 'Barra de dominadas'),
(4, 'Fondos', 'Ejercicio para triceps', 'Triceps', 'Barras paralelas'),
(5, 'Curl de biceps', 'Ejercicio para biceps', 'Biceps', 'Mancuernas'),
(6, 'Peso muerto', 'Ejercicio completo', 'Piernas y espalda', 'Barra olimpica'),
(7, 'Elevaciones laterales', 'Ejercicio para hombros', 'Hombros', 'Mancuernas'),
(8, 'Plancha abdominal', 'Ejercicio para core', 'Abdomen', 'Ninguno'),
(9, 'Zancadas', 'Ejercicio para piernas', 'Piernas', 'Ninguno'),
(10, 'Remo con barra', 'Ejercicio para espalda', 'Espalda', 'Barra olimpica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores`
--

CREATE TABLE `entrenadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrenadores`
--

INSERT INTO `entrenadores` (`id`, `nombre`, `especialidad`, `telefono`, `email`) VALUES
(1, 'Carlos Martinez', 'Crossfit', '+34 600 000 002', 'carlos.martinez@gimnasio.com'),
(2, 'Ana Lopez', 'Yoga', '+34 600 000 001', 'ana.lopez@gimnasio.com'),
(3, 'Miguel angel', 'Boxeo', '+34 600 000 008', 'miguel.angel@gimnasio.com'),
(4, 'Elena Gomez', 'Pilates', '+34 600 000 003', 'elena.gomez@gimnasio.com'),
(5, 'Javier Ruiz', 'Spinning', '+34 600 000 005', 'javier.ruiz@gimnasio.com'),
(6, 'Patricia Diaz', 'Zumba', '+34 600 000 009', 'patricia.diaz@gimnasio.com'),
(7, 'Fernando Castro', 'Funcional', '+34 600 000 004', 'fernando.castro@gimnasio.com'),
(8, 'Lucia Mendez', 'TRX', '+34 600 000 006', 'lucia.mendez@gimnasio.com'),
(9, 'Raul Navarro', 'Calistenia', '+34 600 000 010', 'raul.navarro@gimnasio.com'),
(10, 'Marta Jimenez', 'HIIT', '+34 600 000 007', 'marta.jimenez@gimnasio.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `clase_id` int(11) DEFAULT NULL,
  `dia_semana` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo') DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `clase_id`, `dia_semana`, `hora_inicio`, `hora_fin`) VALUES
(1, 1, 'Lunes', '18:00:00', '19:00:00'),
(2, 2, 'Martes', '07:00:00', '08:00:00'),
(3, 3, 'Miercoles', '19:00:00', '20:00:00'),
(4, 4, 'Jueves', '09:00:00', '10:00:00'),
(5, 5, 'Viernes', '18:30:00', '19:30:00'),
(6, 6, 'Sabado', '11:00:00', '12:00:00'),
(7, 7, 'Lunes', '17:00:00', '18:00:00'),
(8, 8, 'Martes', '20:00:00', '21:00:00'),
(9, 9, 'Miercoles', '18:00:00', '19:00:00'),
(10, 10, 'Jueves', '19:30:00', '20:15:00'),
(11, 11, 'Domingo', '17:30:00', '21:00:00'),
(17, 17, 'Jueves', '09:30:00', '11:00:00'),
(18, 18, 'Lunes', '07:00:00', '08:00:00'),
(19, 19, 'Lunes', '13:30:00', '14:30:00'),
(20, 20, 'Lunes', '19:00:00', '19:45:00'),
(21, 21, 'Martes', '06:45:00', '07:30:00'),
(22, 22, 'Martes', '12:30:00', '13:30:00'),
(23, 23, 'Martes', '18:00:00', '19:00:00'),
(24, 24, 'Miercoles', '08:00:00', '09:00:00'),
(25, 25, 'Miercoles', '14:00:00', '14:45:00'),
(26, 26, 'Miercoles', '20:00:00', '21:00:00'),
(27, 27, 'Jueves', '07:15:00', '07:45:00'),
(28, 28, 'Jueves', '13:00:00', '13:45:00'),
(29, 29, 'Jueves', '18:30:00', '19:30:00'),
(30, 30, 'Viernes', '08:00:00', '08:45:00'),
(31, 31, 'Viernes', '12:00:00', '12:30:00'),
(32, 32, 'Viernes', '17:30:00', '18:30:00'),
(33, 33, 'Sabado', '09:00:00', '10:00:00'),
(34, 34, 'Sabado', '11:30:00', '12:30:00'),
(35, 35, 'Sabado', '17:00:00', '18:00:00'),
(36, 36, 'Domingo', '10:00:00', '11:00:00'),
(39, 39, 'Domingo', '12:00:00', '12:45:00'),
(40, 40, 'Domingo', '17:00:00', '17:45:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `clase_id` int(11) DEFAULT NULL,
  `horario_id` int(11) DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `usuario_id`, `clase_id`, `horario_id`, `fecha_inscripcion`) VALUES
(33, 24, 1, 1, '2025-06-02'),
(34, 24, 8, 8, '2025-06-03'),
(35, 24, 3, 3, '2025-06-04'),
(37, 24, 17, 17, '2025-06-05'),
(38, 24, 11, 11, '2025-06-01'),
(39, 24, 19, 19, '2025-06-02'),
(41, 24, 7, 7, '2025-06-09'),
(42, 24, 8, 8, '2025-06-10'),
(43, 24, 27, 27, '2025-06-12'),
(44, 24, 32, 32, '2025-06-13'),
(45, 24, 20, 20, '2025-06-23'),
(68, 25, 20, 20, '2025-06-02'),
(69, 25, 8, 8, '2025-06-03'),
(70, 25, 26, 26, '2025-06-04'),
(71, 25, 10, 10, '2025-06-05'),
(72, 25, 5, 5, '2025-06-06'),
(73, 25, 35, 35, '2025-06-07'),
(75, 25, 20, 20, '2025-06-09'),
(76, 25, 8, 8, '2025-06-10'),
(77, 25, 26, 26, '2025-06-11'),
(78, 25, 10, 10, '2025-06-12'),
(79, 25, 5, 5, '2025-06-13'),
(80, 25, 35, 35, '2025-06-14'),
(137, 12, 36, 36, '2025-06-01'),
(138, 12, 18, 18, '2025-06-02'),
(139, 12, 21, 21, '2025-06-03'),
(140, 12, 24, 24, '2025-06-04'),
(141, 12, 27, 27, '2025-06-05'),
(142, 12, 30, 30, '2025-06-06'),
(143, 12, 33, 33, '2025-06-07'),
(144, 12, 39, 39, '2025-06-08'),
(145, 12, 19, 19, '2025-06-09'),
(146, 12, 2, 2, '2025-06-10'),
(147, 12, 25, 25, '2025-06-11'),
(148, 12, 4, 4, '2025-06-12'),
(149, 12, 31, 31, '2025-06-13'),
(150, 12, 6, 6, '2025-06-14'),
(151, 12, 40, 40, '2025-06-15'),
(152, 12, 7, 7, '2025-06-16'),
(153, 12, 22, 22, '2025-06-17'),
(154, 12, 9, 9, '2025-06-18'),
(155, 12, 17, 17, '2025-06-19'),
(156, 12, 32, 32, '2025-06-20'),
(157, 12, 34, 34, '2025-06-21'),
(158, 13, 39, 39, '2025-06-01'),
(159, 13, 19, 19, '2025-06-02'),
(160, 13, 2, 2, '2025-06-03'),
(161, 13, 25, 25, '2025-06-04'),
(162, 13, 4, 4, '2025-06-05'),
(163, 13, 31, 31, '2025-06-06'),
(164, 13, 6, 6, '2025-06-07'),
(165, 13, 11, 11, '2025-06-08'),
(166, 13, 1, 1, '2025-06-09'),
(167, 13, 23, 23, '2025-06-10'),
(168, 11, 36, 36, '2025-06-01'),
(169, 11, 18, 18, '2025-06-02'),
(170, 11, 21, 21, '2025-06-03'),
(171, 11, 24, 24, '2025-06-04'),
(172, 11, 27, 27, '2025-06-05'),
(173, 11, 30, 30, '2025-06-06'),
(174, 11, 33, 33, '2025-06-07'),
(175, 11, 39, 39, '2025-06-08'),
(176, 11, 19, 19, '2025-06-09'),
(177, 11, 2, 2, '2025-06-10'),
(178, 11, 25, 25, '2025-06-11'),
(179, 11, 4, 4, '2025-06-12'),
(180, 11, 31, 31, '2025-06-13'),
(181, 11, 6, 6, '2025-06-14'),
(182, 13, 3, 3, '2025-06-11'),
(183, 13, 28, 28, '2025-06-12'),
(184, 13, 5, 5, '2025-06-13'),
(185, 13, 35, 35, '2025-06-14'),
(187, 8, 11, 11, '2025-06-01'),
(188, 8, 20, 20, '2025-06-02'),
(189, 8, 8, 8, '2025-06-03'),
(190, 8, 26, 26, '2025-06-04'),
(191, 8, 10, 10, '2025-06-05'),
(192, 8, 5, 5, '2025-06-06'),
(193, 8, 35, 35, '2025-06-07'),
(194, 8, 39, 39, '2025-06-08'),
(195, 8, 19, 19, '2025-06-09'),
(196, 8, 2, 2, '2025-06-10'),
(197, 8, 25, 25, '2025-06-11'),
(198, 8, 4, 4, '2025-06-12'),
(199, 8, 31, 31, '2025-06-13'),
(200, 8, 6, 6, '2025-06-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `nombre_equipo` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `estado` enum('bueno','mantenimiento','dañado') DEFAULT 'bueno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `nombre_equipo`, `cantidad`, `estado`) VALUES
(1, 'Mancuernas 10kg', 15, 'bueno'),
(2, 'Bicicleta estatica', 5, 'mantenimiento'),
(3, 'Barras olimpicas', 8, 'bueno'),
(4, 'Discos de peso', 50, 'bueno'),
(5, 'Colchonetas', 20, 'bueno'),
(6, 'Kettlebells', 12, 'bueno'),
(7, 'Cuerdas para saltar', 15, 'dañado'),
(8, 'Bandas elasticas', 30, 'bueno'),
(9, 'Steps', 10, 'bueno'),
(10, 'Balones medicinales', 8, 'mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias`
--

CREATE TABLE `membresias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `duracion_dias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membresias`
--

INSERT INTO `membresias` (`id`, `nombre`, `precio`, `duracion_dias`) VALUES
(1, 'Premium', 59.99, 30),
(2, 'Basica', 29.99, 30),
(3, 'Anual Gold', 499.99, 365),
(4, 'Trimestral', 149.99, 90),
(5, 'Familiar', 99.99, 30),
(6, 'Estudiante', 24.99, 30),
(7, 'Nocturna', 39.99, 30),
(8, 'Weekend', 19.99, 30),
(9, 'Solo Clases', 44.99, 30),
(10, 'VIP', 89.99, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_nutricionales`
--

CREATE TABLE `planes_nutricionales` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `objetivo` enum('perdida de peso','ganancia muscular','mantenimiento') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes_nutricionales`
--

INSERT INTO `planes_nutricionales` (`id`, `usuario_id`, `fecha_inicio`, `fecha_fin`, `objetivo`) VALUES
(1, 24, '2025-03-02', '2025-07-31', 'mantenimiento'),
(2, 5, '2023-01-15', '2023-02-15', 'perdida de peso'),
(3, 7, '2023-02-01', '2023-04-01', ''),
(4, 8, '2023-03-01', '2023-06-01', 'ganancia muscular'),
(5, 9, '2023-01-10', '2023-02-10', 'mantenimiento'),
(6, 10, '2023-02-15', '2023-03-15', 'perdida de peso'),
(7, 11, '2023-01-20', '2023-03-20', ''),
(8, 12, '2023-03-01', '2023-05-01', 'ganancia muscular'),
(9, 13, '2023-02-10', '2023-04-10', 'mantenimiento'),
(10, 6, '2023-01-05', '2023-02-05', 'perdida de peso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso_ejercicios`
--

CREATE TABLE `progreso_ejercicios` (
  `id` int(11) NOT NULL,
  `rutina_id` int(11) NOT NULL,
  `ejercicio_id` int(11) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `repeticiones` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `progreso_ejercicios`
--

INSERT INTO `progreso_ejercicios` (`id`, `rutina_id`, `ejercicio_id`, `peso`, `repeticiones`, `fecha`) VALUES
(2, 2, 3, 0.00, 12, '2024-05-16 09:00:00'),
(3, 3, 4, 0.00, 15, '2024-05-17 11:15:00'),
(4, 4, 5, 12.00, 12, '2024-05-18 16:30:00'),
(5, 5, 6, 100.00, 5, '2024-05-19 17:00:00'),
(6, 6, 7, 8.00, 10, '2024-05-20 15:45:00'),
(7, 7, 8, 0.00, 30, '2024-05-21 14:30:00'),
(8, 8, 9, 0.00, 12, '2024-05-22 13:15:00'),
(9, 9, 10, 40.00, 10, '2024-05-23 12:00:00'),
(19, 1, 1, 20.00, 8, '2025-06-01 21:30:21'),
(20, 1, 6, 40.00, 12, '2025-06-01 21:30:31'),
(21, 1, 2, 30.00, 8, '2025-06-01 21:30:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso_usuario`
--

CREATE TABLE `progreso_usuario` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `grasa_corporal` decimal(5,2) DEFAULT NULL,
  `musculo` decimal(5,2) DEFAULT NULL,
  `notas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `progreso_usuario`
--

INSERT INTO `progreso_usuario` (`id`, `usuario_id`, `fecha`, `peso`, `grasa_corporal`, `musculo`, `notas`) VALUES
(1, 2, '2023-01-01', 75.50, 18.20, 42.10, 'Primera medicion'),
(2, 2, '2023-02-01', 74.80, 17.50, 42.80, 'Progreso notable'),
(3, 5, '2023-01-15', 68.30, 20.10, 39.50, 'Inicio de rutina'),
(4, 5, '2023-02-15', 67.50, 19.30, 40.20, 'Mejoria visible'),
(5, 7, '2023-02-01', 82.00, 15.80, 45.30, 'Primer control'),
(6, 8, '2023-03-01', 70.20, 16.70, 43.00, 'Inicio volumen'),
(7, 9, '2023-01-10', 65.80, 19.50, 40.00, 'Primera medicion'),
(8, 10, '2023-02-15', 60.50, 22.00, 38.00, 'Inicio entrenamiento'),
(9, 11, '2023-01-20', 58.70, 21.50, 37.50, 'Primer registro'),
(10, 12, '2023-03-01', 77.30, 14.90, 44.80, 'Inicio rutina espalda'),
(19, 24, '2025-06-01', 140.00, 20.00, 20.00, 'Primer registro'),
(20, 24, '2025-06-01', 120.00, 18.00, 25.00, 'Segundo registro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_accesos`
--

CREATE TABLE `registro_accesos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `tipo` enum('entrada','salida') DEFAULT NULL,
  `codigo_qr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_accesos`
--

INSERT INTO `registro_accesos` (`id`, `usuario_id`, `fecha`, `tipo`, `codigo_qr`) VALUES
(1, 2, '2023-01-10 17:45:00', 'entrada', 'QR12345678'),
(2, 2, '2023-01-10 19:05:00', 'salida', 'QR12345678'),
(3, 5, '2023-01-12 06:50:00', 'entrada', 'QR23456789'),
(4, 5, '2023-01-12 08:10:00', 'salida', 'QR23456789'),
(5, 7, '2023-02-05 18:45:00', 'entrada', 'QR34567890'),
(6, 7, '2023-02-05 20:05:00', 'salida', 'QR34567890'),
(7, 8, '2023-03-02 08:45:00', 'entrada', 'QR45678901'),
(8, 8, '2023-03-02 10:05:00', 'salida', 'QR45678901'),
(9, 9, '2023-01-18 18:15:00', 'entrada', 'QR56789012'),
(10, 9, '2023-01-18 19:45:00', 'salida', 'QR56789012'),
(11, 24, '2024-11-17 04:01:54', 'entrada', 'QR123456'),
(12, 24, '2024-11-17 10:02:29', 'salida', 'QR123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas`
--

CREATE TABLE `rutinas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutinas`
--

INSERT INTO `rutinas` (`id`, `usuario_id`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 24, 'Rutina fuerza', 'Rutina para ganar fuerza muscular', '2023-01-01', '2023-03-01'),
(2, 5, 'Rutina cardio', 'Rutina para mejorar resistencia cardiovascular', '2023-01-15', '2023-02-15'),
(3, 7, 'Definicion', 'Rutina para definir musculo', '2023-02-01', '2023-04-01'),
(4, 8, 'Volumen', 'Rutina para ganar masa muscular', '2023-03-01', '2023-06-01'),
(5, 9, 'Full Body', 'Rutina completa para todo el cuerpo', '2023-01-10', '2023-02-10'),
(6, 10, 'Piernas y gluteos', 'Rutina focalizada en piernas y gluteos', '2023-02-15', '2023-03-15'),
(7, 11, 'Abdomen marcado', 'Rutina para marcar abdomen', '2023-01-20', '2023-03-20'),
(8, 12, 'Espalda ancha', 'Rutina para desarrollar espalda', '2023-03-01', '2023-05-01'),
(9, 13, 'Brazos fuertes', 'Rutina para fortalecer brazos', '2023-02-10', '2023-04-10'),
(10, 6, 'Resistencia', 'Rutina para mejorar resistencia', '2023-01-05', '2023-02-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina_ejercicios`
--

CREATE TABLE `rutina_ejercicios` (
  `id` int(11) NOT NULL,
  `rutina_id` int(11) DEFAULT NULL,
  `ejercicio_id` int(11) DEFAULT NULL,
  `series` int(11) DEFAULT NULL,
  `repeticiones` int(11) DEFAULT NULL,
  `dia_semana` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutina_ejercicios`
--

INSERT INTO `rutina_ejercicios` (`id`, `rutina_id`, `ejercicio_id`, `series`, `repeticiones`, `dia_semana`) VALUES
(1, 1, 1, 4, 8, 'Lunes'),
(2, 2, 2, 3, 12, 'Miercoles'),
(3, 3, 3, 4, 10, 'Martes'),
(4, 4, 4, 3, 15, 'Jueves'),
(5, 5, 5, 3, 12, 'Viernes'),
(6, 6, 6, 5, 5, 'Lunes'),
(7, 7, 7, 4, 10, 'Miercoles'),
(8, 8, 8, 3, 30, 'Viernes'),
(9, 9, 9, 4, 12, 'Martes'),
(10, 10, 10, 3, 10, 'Jueves'),
(11, 1, 6, 4, 12, 'Lunes'),
(12, 1, 2, 4, 12, 'Lunes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `fecha_registro` date DEFAULT curdate(),
  `tipo` enum('cliente','admin') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `passwd`, `fecha_registro`, `tipo`) VALUES
(1, 'roberto', 'robertosegadodiaz@gmail.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'admin'),
(3, 'Domin', 'dominmd99@gmail.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'admin'),
(5, 'pedro', 'pericos@gmail.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'cliente'),
(7, 'Maria Garcia', 'maria.garcia@email.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'cliente'),
(8, 'Juan Perez', 'juan.perez@email.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'cliente'),
(9, 'Ana Rodriguez', 'ana.rodriguez@email.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'cliente'),
(10, 'Carlos Sanchez', 'carlos.sanchez@email.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'cliente'),
(11, 'Laura Martinez', 'laura.martinez@email.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'cliente'),
(12, 'David Lopez', 'david.lopez@email.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'cliente'),
(13, 'Sofia Fernandez', 'sofia.fernandez@email.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-10', 'cliente'),
(24, 'Ana', 'ana@gmail.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-17', 'cliente'),
(25, 'Manu', 'manu@gmail.com', '$2y$10$hirml3fXTR6oXx6Ga9VvouTNhWMdJe2IzmcDR/9laAPXPtsENdCHa', '2025-05-31', 'cliente'),
(29, 'Admin', 'admin@gimnasiofitpro.com', '$2y$10$/xxJyTX1Xv4Z/gnWfMHhbuE.UdH6fnEkGdWG8QtBko7DB/cGKN5Sa', '2025-06-01', 'admin'),
(30, 'rober1', 'rober1@gmail.com', '$2y$10$DKe9oxAOem37897/fssK1eEiKAVSSGx9KjXikkiozucEv20fF2f3q', '2025-06-01', 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_membresias`
--

CREATE TABLE `usuarios_membresias` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `membresia_id` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_membresias`
--

INSERT INTO `usuarios_membresias` (`id`, `usuario_id`, `membresia_id`, `fecha_inicio`, `fecha_fin`) VALUES
(3, 7, 3, '2023-02-01', '2027-02-04'),
(11, 24, 10, '2025-05-13', '2026-05-15'),
(12, 5, 6, '2025-06-01', '2025-07-01'),
(13, 8, 9, '2025-06-01', '2025-07-01'),
(14, 9, 5, '2025-06-20', '2025-07-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entrenador_id` (`entrenador_id`);

--
-- Indices de la tabla `dieta_diaria`
--
ALTER TABLE `dieta_diaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clase_id` (`clase_id`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `clase_id` (`clase_id`),
  ADD KEY `horario_id` (`horario_id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `planes_nutricionales`
--
ALTER TABLE `planes_nutricionales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `progreso_ejercicios`
--
ALTER TABLE `progreso_ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `progreso_usuario`
--
ALTER TABLE `progreso_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_accesos`
--
ALTER TABLE `registro_accesos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutina_ejercicios`
--
ALTER TABLE `rutina_ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios_membresias`
--
ALTER TABLE `usuarios_membresias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `dieta_diaria`
--
ALTER TABLE `dieta_diaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `membresias`
--
ALTER TABLE `membresias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `planes_nutricionales`
--
ALTER TABLE `planes_nutricionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `progreso_ejercicios`
--
ALTER TABLE `progreso_ejercicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `progreso_usuario`
--
ALTER TABLE `progreso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `registro_accesos`
--
ALTER TABLE `registro_accesos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rutina_ejercicios`
--
ALTER TABLE `rutina_ejercicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios_membresias`
--
ALTER TABLE `usuarios_membresias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
