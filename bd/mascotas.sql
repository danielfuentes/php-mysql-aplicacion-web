-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2021 a las 16:12:44
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mascotas`
--
CREATE DATABASE IF NOT EXISTS `mascotas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mascotas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animalitos`
--

CREATE TABLE `animalitos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `aporte` decimal(12,2) DEFAULT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `animalitos`
--

INSERT INTO `animalitos` (`id`, `nombre`, `descripcion`, `aporte`, `imagen`) VALUES
(1, 'Lola', 'Es un perrita muy bonito', '100.00', 'foto1'),
(2, 'Sofia', 'Es un gatita muy linda', '200.00', 'foto2'),
(3, 'Pelusa', 'Es una perrita muy cariñosa', '300.00', 'foto3'),
(4, 'Nala', 'Es una perrita muy chillona', '400.00', 'foto4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `perfil` int(11) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `perfil`, `avatar`) VALUES
(1, 'Victor', 'Fuentes', 'victor@gmail.com', '$2y$10$fycIGMgEXFrND8VMCEoViu7oSfSt.fVhCtIXw1Qk6yPS4tZhAVIya', 1, 'avatar-61ae20e696b2a.jpg'),
(2, 'Luis', 'Fuentes', 'luis@gmail.com', '$2y$10$Ay08wAaSk7rz4l6qBgXQP.srcMHATKLvsWBlxrVKwxdobi0iWzPk2', 1, 'avatar-61ae21b572c04.jpg'),
(3, 'Daniel', 'Fuentes', 'cedavilu@gmail.com', '$2y$10$xXMKmzGBFqNx3OAJdzH.P.LAP4YmxYoRdeSjjRgOAGWhlSLYxt9RS', 9, 'avatar-61bc9c9fcfba6.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animalitos`
--
ALTER TABLE `animalitos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animalitos`
--
ALTER TABLE `animalitos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
