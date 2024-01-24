-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2024 a las 22:07:35
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
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  edad INT,
  usuario VARCHAR(50) UNIQUE NOT NULL,
  contrasena VARCHAR(255) NOT NULL
);

-- Estructura de tabla para la tabla `donaciones`
CREATE TABLE IF NOT EXISTS donaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cantidad_donada DECIMAL(10,2) NOT NULL,
  fecha_donacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  usuario_id INT,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Crear la tabla para el seguimiento global de donaciones
CREATE TABLE IF NOT EXISTS total_donado_global (
    id INT PRIMARY KEY,
    cantidad DECIMAL(10, 2) DEFAULT 0
);

-- Agregar un trigger para actualizar la cantidad total global donada
CREATE TRIGGER after_donacion_insert
AFTER INSERT ON donaciones
FOR EACH ROW
UPDATE total_donado_global
SET cantidad = cantidad + NEW.cantidad_donada
WHERE id = 1;

-- Inicializar la tabla de total_donado_global con un registro
INSERT IGNORE INTO total_donado_global (id, cantidad) VALUES (1, 0);

