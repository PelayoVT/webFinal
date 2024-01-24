-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-01-2024 a las 05:04:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webfinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `id` int(11) NOT NULL,
  `cantidad_donada` decimal(10,2) NOT NULL,
  `fecha_donacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `donaciones`
--

INSERT INTO `donaciones` (`id`, `cantidad_donada`, `fecha_donacion`, `usuario_id`) VALUES
(17, 1.00, '2024-01-24 02:52:55', 2),
(18, 5.00, '2024-01-24 02:53:24', 2),
(19, 1.00, '2024-01-24 02:54:03', 2),
(20, 5.00, '2024-01-24 02:55:23', 2),
(21, 20.00, '2024-01-24 02:55:34', 2),
(22, 5.00, '2024-01-24 02:56:57', 2),
(23, 5.00, '2024-01-24 02:59:19', 2),
(24, 1.00, '2024-01-24 03:01:13', 2),
(25, 1.00, '2024-01-24 03:01:53', 2),
(26, 4.00, '2024-01-24 03:02:38', 2),
(27, 5.00, '2024-01-24 03:04:18', 2),
(28, 5.00, '2024-01-24 03:05:57', 2),
(29, 300.00, '2024-01-24 03:10:12', 2),
(30, 50.00, '2024-01-24 03:19:34', 2),
(31, 1.00, '2024-01-24 03:52:32', 2);

--
-- Disparadores `donaciones`
--
DELIMITER $$
CREATE TRIGGER `after_donacion_insert` AFTER INSERT ON `donaciones` FOR EACH ROW UPDATE total_donado_global
SET cantidad = cantidad + NEW.cantidad_donada
WHERE id = 1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `total_donado_global`
--

CREATE TABLE `total_donado_global` (
  `id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `total_donado_global`
--

INSERT INTO `total_donado_global` (`id`, `cantidad`) VALUES
(1, 783.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `edad`, `usuario`, `contrasena`) VALUES
(1, 'Pelayo', 'Vázquez', 20, 'pelayo', '$2y$10$Gt5VXmx/jtbE0Hgbd/1suOeHp/KepyspMHU7I2Y1CVCVGhua0v8Dm'),
(2, 'Pelayo', 'Toledo', 15, 'pelay0', '$2y$10$giZ3FIWl6bHYxlR2YIYVEeeOJUIQLbjpm3Z6UyL3CPiL7um3rRguW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `total_donado_global`
--
ALTER TABLE `total_donado_global`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `donaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
