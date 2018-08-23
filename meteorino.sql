-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2018 a las 21:20:26
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `meteorino`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gps`
--

CREATE TABLE `gps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `longitud` float DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `altitud` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` int(1) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--------------------------------------------------------

--
-- Estructura de tabla para la tabla `weather`
--

CREATE TABLE `weather` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hora` time DEFAULT NULL,
  `humedad` float DEFAULT NULL,
  `temperatura` float DEFAULT NULL,
  `presion` float DEFAULT NULL,
  `vientodir` varchar(7) DEFAULT NULL,
  `vientovel` float DEFAULT NULL,
  `lluvia` float DEFAULT NULL,
  `luz` varchar(8) DEFAULT NULL,
  `co2` int(7) DEFAULT NULL,
  `uv` float DEFAULT NULL,
  `polvo` float DEFAULT NULL,
  `temperatura2` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;