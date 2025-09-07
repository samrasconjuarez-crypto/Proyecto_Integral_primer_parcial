-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: fdb1034.awardspace.net
-- Tiempo de generación: 07-09-2025 a las 21:27:06
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `4667269_particularbooks`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `id` int NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_entrada` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_salida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`id`, `tipo`, `nombre`, `fecha_entrada`, `fecha_salida`) VALUES
(1, 'Ilustrador', 'Heilend', '2025-09-07 04:31:48', '2025-09-07 04:41:56'),
(2, 'Empleado', 'Administrador', '2025-09-07 04:37:48', '2025-09-07 04:37:58'),
(3, 'Empleado', 'Administrador', '2025-09-07 04:38:04', '2025-09-07 04:42:56'),
(4, 'Empleado', 'Administrador', '2025-09-07 04:38:40', '2025-09-07 04:42:03'),
(5, 'Empleado', 'nate', '2025-09-07 04:42:30', '2025-09-07 04:42:52'),
(6, 'Reportero', 'roma', '2025-09-07 04:43:10', '2025-09-07 04:43:31'),
(7, 'Empleado', 'Administrador', '2025-09-07 04:43:25', '2025-09-07 04:46:57'),
(8, 'Ilustrador', 'Felipe', '2025-09-07 04:47:06', '2025-09-07 04:48:32'),
(9, 'Empleado', 'Administrador', '2025-09-07 04:49:02', '2025-09-07 04:49:08'),
(10, 'Dueño de librería', 'Lorenzo Medici', '2025-09-07 04:49:23', '2025-09-07 04:50:32'),
(11, 'Empleado', 'Administrador', '2025-09-07 04:49:34', '2025-09-07 04:49:46'),
(12, 'Corrector de estilo', 'Cocoloco', '2025-09-07 04:50:08', '2025-09-07 04:50:35'),
(13, 'Empleado', 'Administrador', '2025-09-07 04:50:12', '2025-09-07 04:50:19'),
(14, 'Empleado', 'Administrador', '2025-09-07 04:50:40', '2025-09-07 04:50:46'),
(15, 'Empleado', 'Ginger', '2025-09-07 04:54:29', '2025-09-07 04:54:41'),
(16, 'Ilustrador', 'Andrea Zelda Solis Torres', '2025-09-07 05:00:17', '2025-09-07 20:18:32'),
(17, 'Ilustrador', 'Itzel Chávez', '2025-09-07 05:02:28', '2025-09-07 05:02:47'),
(18, 'Empleado', 'Benjamin', '2025-09-07 05:11:15', '2025-09-07 05:11:24'),
(19, 'Empleado', 'Administrador', '2025-09-07 05:12:34', '2025-09-07 05:13:26'),
(20, 'Entrega de alimentos', 'Roman', '2025-09-07 05:12:56', '2025-09-07 20:18:34'),
(21, 'Empleado', 'Administrador', '2025-09-07 05:13:07', '2025-09-07 05:13:27'),
(22, 'Escritor', 'Zahira García', '2025-09-07 05:16:08', '2025-09-07 20:18:36'),
(23, 'Empleado', 'Administrador', '2025-09-07 05:17:14', '2025-09-07 05:17:22'),
(24, 'Empleado', 'Administrador', '2025-09-07 05:18:13', '2025-09-07 05:19:10'),
(25, 'Empleado', 'Administrador', '2025-09-07 20:18:46', '2025-09-07 20:18:58'),
(26, 'Corrector de estilo', 'Okarun', '2025-09-07 20:20:00', '2025-09-07 20:20:38'),
(27, 'Empleado', 'Administrador', '2025-09-07 20:21:28', '2025-09-07 20:32:10'),
(28, 'Ilustrador', 'Ayase', '2025-09-07 20:23:39', '2025-09-07 20:32:14'),
(29, 'Escritor', 'Lucy', '2025-09-07 20:31:19', '2025-09-07 20:32:14'),
(30, 'Empleado', 'Pericles Ramirez', '2025-09-07 20:32:05', '2025-09-07 20:34:02'),
(31, 'Empleado', 'Pericles Ramirez', '2025-09-07 20:34:15', '2025-09-07 20:34:31'),
(32, 'Empleado', 'Administrador', '2025-09-07 21:00:02', '2025-09-07 21:23:40'),
(33, 'Empleado', 'Administrador', '2025-09-07 21:23:16', '2025-09-07 21:23:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `usuario`, `nombre`, `password`) VALUES
(1, 'lore', 'lorena', '$2y$10$zeGrUsSpKM6Qvj3CIcIXvO5B7he44tVpSPVdFYCJbvrGSw2PpZ9mG'),
(2, 'Administrador', 'Administrador', '$2y$10$p9kfvjpsNWidltZioql5dOqlFqCXlY7JZSswr7dKa.mSfus.VEUK6'),
(3, 'nate', 'nate', '$2y$10$QwQVYthhbV0YR7kCZnOZfeAllmdHMY1tqQu.zLktWl6I8o4QEFSou'),
(4, 'Ginger', 'Ginger', '$2y$10$6slvfFrYjeOjIj7N..RGxOAmm491KHSmLnX/eAGE2/zk7rGu0W1Ii'),
(5, 'Benjamin', 'Benjamin', '$2y$10$mOJ9OTWrGR9WQjIYyyZXHOBvPxyzIfPfDEQg.fHzpt8wGu1Hm0tkW'),
(6, 'Peca', 'Pericles Ramirez', '$2y$10$zFogtFQk8WYxEtUrfqpsD.BZZ5F8EHsmwLgzXn0o8uRC/JlvpdZPe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

CREATE TABLE `visitantes` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`id`, `nombre`, `tipo`, `fecha_registro`) VALUES
(1, 'Lucy', 'Escritor', '2025-09-07 20:31:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
