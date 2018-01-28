-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2017 a las 13:59:12
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbtest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cars`
--

CREATE TABLE `cars` (
  `Modelo` varchar(32) NOT NULL,
  `Marca` varchar(32) NOT NULL,
  `Matricula` varchar(32) NOT NULL,
  `Vel_max` int(32) NOT NULL,
  `Cap_bateria` int(11) NOT NULL,
  `Precio` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cars`
--

INSERT INTO `cars` (`Modelo`, `Marca`, `Matricula`, `Vel_max`, `Cap_bateria`, `Precio`) VALUES
('Captur', 'Renault', '1234 FFF', 200, 18000, '15.000 EUR'),
('Golf', 'Volkswagen', '2250 HGY', 45, 19400, '20.000 EUR'),
('Q3', 'Audi', '3211 AQW', 221, 432, '32.000 EUR'),
('Megane', 'Renault', '3241 TRF', 32, 4874, '42.000  EUR'),
('Clio', 'Renault', '3758 KLQ', 190, 254000, '13.560 EUR'),
('A6', 'Audi', '4233 CLO', 213, 32131, '5.000  EUR'),
('Scirocco', 'Volkswagen', '4324 GFH', 123, 3232, '90.000 EUR'),
('Passat', 'Volkswagen', '4324 JJJ', 123, 434432, '123.000 EUR'),
('Polo', 'Volkswagen', '4324 THU', 132, 32132, '121.000 EUR'),
('R8', 'Audi', '4397 RQE', 300, 31232, '1.355.321 EUR'),
('Ibiza', 'Seat', '4576 HJT', 129, 78940, '130.000 EUR'),
('Toledo', 'Seat', '5432 YYY', 145, 31232, '120.000 EUR'),
('Leon', 'Seat', '5453 HJY', 200, 3424, '12.000 EUR'),
('Ateca', 'Seat', '6754 GGG', 145, 32132, '45.000 EUR'),
('A1', 'Audi', '9876 TTT', 123, 321322, '45.000 EUR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `nombre` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `email`, `nombre`) VALUES
(1, 'pchack1996@gmail.com', 'wilson.jpg'),
(3, 'pchack1996@gmail.com', 'wilson.jpg'),
(4, 'maria', 'prueba1.jpg'),
(5, 'maria', 'emma_emma.jpg'),
(6, 'g', 'wilson.jpg'),
(7, 'g', 'wilson2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_semana`
--

CREATE TABLE `imagenes_semana` (
  `id` int(11) NOT NULL,
  `dia` varchar(32) NOT NULL,
  `numero` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes_semana`
--

INSERT INTO `imagenes_semana` (`id`, `dia`, `numero`) VALUES
(1, 'Monday', 200),
(2, 'Tuesday', 33),
(3, 'Wednesday', 52),
(4, 'Thursday', 6),
(5, 'Friday', 90),
(6, 'Saturday', 40),
(7, 'Sunday', 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo_semana`
--

CREATE TABLE `modelo_semana` (
  `id` int(11) NOT NULL,
  `modelo` varchar(32) NOT NULL,
  `numero` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modelo_semana`
--

INSERT INTO `modelo_semana` (`id`, `modelo`, `numero`) VALUES
(1, 'Captur', 20),
(2, 'Golf', 0),
(3, 'Q3', 5),
(4, 'Megane', 2),
(5, 'Clio', 90),
(6, 'A6', 5),
(7, 'Scirocco', 3),
(8, 'Passat', 4),
(9, 'Polo', 0),
(10, 'R8', 0),
(11, 'Ibiza', 10),
(12, 'Toledo', 0),
(13, 'Leon', 5),
(14, 'Ateca', 1),
(15, 'A1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `name` varchar(45) NOT NULL,
  `apellidos` varchar(32) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `provincia` varchar(32) DEFAULT NULL,
  `codigo_postal` varchar(32) DEFAULT NULL,
  `pais` varchar(32) DEFAULT NULL,
  `telefono` varchar(32) DEFAULT NULL,
  `Matricula` varchar(32) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`name`, `apellidos`, `email`, `contrasena`, `provincia`, `codigo_postal`, `pais`, `telefono`, `Matricula`, `fecha_registro`) VALUES
('323', '32321', '1@gmail.com', '695ebed04dd1f67f67eb3f853f3be728', '1@gmail.com', '1@gmail.com', '1@gmail.com', '1@gmail.com', NULL, '2017-06-09 03:31:17'),
('a', NULL, 'a', '0cc175b9c0f1b6a831c399e269772661', NULL, NULL, NULL, NULL, NULL, '2017-06-08 17:59:57'),
('gfgfgggf', 'gffgfgfgg', 'ali@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1111', '1111', '111', '111', NULL, '2017-06-07 16:48:21'),
('fifa@gmail.com', 'fifa@gmail.com', 'fifa@gmail.com', '9c2f88083dec3a9ad9225b7c321da819', 'fifa@gmail.com', 'fifa@gmail.com', 'fifa@gmail.com', 'fifa@gmail.com', NULL, '2017-06-08 23:12:11'),
('Torremela', NULL, 'g', 'b2f5ff47436671b6e533d8dc3614845d', NULL, NULL, NULL, NULL, '4576 HJT', '2017-06-08 17:49:59'),
('kika', 'kika', 'kika@gmail.com', '1ac26c62245e3250bccf36bb361b0e45', 'kika@gmail.com', 'kika@gmail.com', 'kika@gmail.com', 'kika@gmail.com', NULL, '2017-06-08 23:01:41'),
('kika', 'kika', 'kikfa4@gmail.com', '8fa14cdd754f91cc6554c9e71929cce7', 'kika@gmail.com', 'kika@gmail.com', 'kika@gmail.com', 'kika@gmail.com', NULL, '2017-06-08 23:08:16'),
('kika', 'kika', 'kikfa@gmail.com', '8fa14cdd754f91cc6554c9e71929cce7', 'kika@gmail.com', 'kika@gmail.com', 'kika@gmail.com', 'kika@gmail.com', NULL, '2017-06-08 23:07:22'),
('kiko', 'kiko', 'kiko@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '', '', '', '', NULL, '2017-06-05 02:18:39'),
('fdfd', 'fdf', 'kkkkkk@gmail.com', '0255672be7e45f49ece622ad7e12dbb4', 'kkkkkk@gmail.com', 'kkkkkk@gmail.com', 'kkkkkk@gmail.com', 'kkkkkk@gmail.com', NULL, '2017-06-07 17:41:51'),
('gfgfdfdgfdgfdgfdgfdfd', 'mamagfgfgf', 'mama@gmail.com', '202cb962ac59075b964b07152d234b70', 'mama@gmail.com', 'mama@gmail.com', 'mama@gmail.com', 'mama@gmail.com', NULL, '2017-06-08 23:15:27'),
('maria', NULL, 'maria', '263bce650e68ab4e23f28263760b9fa5', NULL, NULL, NULL, NULL, '3241 TRF', '2017-06-08 17:51:10'),
('Wilson', '', 'pchack1996@gmail.com', '1234', '', '', '', '', '4324 JJJ', '2017-06-05 02:18:39'),
('proyecto', 'proyecto', 'proyecto@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'proyecto', '08367', 'EspaÃ±a', '88743874387', NULL, '2017-06-09 07:56:47'),
('t', NULL, 't', 'e358efa489f58062f10dd7316b65649e', NULL, NULL, NULL, NULL, NULL, '2017-06-08 17:56:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_semana`
--

CREATE TABLE `registro_semana` (
  `id` int(11) NOT NULL,
  `dia` varchar(32) NOT NULL,
  `numero` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro_semana`
--

INSERT INTO `registro_semana` (`id`, `dia`, `numero`) VALUES
(1, 'Monday', 552),
(2, 'Tuesday', 300),
(3, 'Wednesday', 120),
(4, 'Thursday', 62),
(5, 'Friday', 44),
(6, 'Saturday', 620),
(7, 'Sunday', 230);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`Matricula`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `imagenes_semana`
--
ALTER TABLE `imagenes_semana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelo_semana`
--
ALTER TABLE `modelo_semana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`email`),
  ADD KEY `Matricula` (`Matricula`);

--
-- Indices de la tabla `registro_semana`
--
ALTER TABLE `registro_semana`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `imagenes_semana`
--
ALTER TABLE `imagenes_semana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `modelo_semana`
--
ALTER TABLE `modelo_semana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `registro_semana`
--
ALTER TABLE `registro_semana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `gfg` FOREIGN KEY (`email`) REFERENCES `people` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `people_ibfk_1` FOREIGN KEY (`Matricula`) REFERENCES `cars` (`Matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
