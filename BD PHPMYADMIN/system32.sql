-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2022 a las 04:29:19
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `system32`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(58) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(59) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(33) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dni` int(8) NOT NULL,
  `clave` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `direccion`, `telefono`, `email`, `dni`, `clave`) VALUES
(1, 'Garcia Manuel', 'San Juan 80', '4324231', 'manologarcia@gmail.com', 32456576, '123'),
(2, 'Facundo Tagliavini', 'San Luis 30', '4354731', 'facundot773@gmail.com', 42456546, '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_rubro` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` double NOT NULL,
  `notas` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `id_rubro`, `stock`, `precio`, `notas`) VALUES
(1, 'Ryzen 5 1600 af zen', 1, 8, 15000, ''),
(3, 'Disco solido kingstone', 11, 14, 1577, 'discardo'),
(4, 'intel i5 9500k', 1, 1, 7777, 'iuliu'),
(5, 'Memoria ram 8gb', 3, 33, 6555, 'gfdgdsgsd'),
(6, 'Redragon kumara', 2, 77, 2455, 'buenarod'),
(7, 'memoria ssd', 11, 88, 6666, 'fghgf'),
(8, 'Intel i7', 1, 98, 77790, 'ultima generaion'),
(9, 'Gabinete sentey', 9, 77, 9999, 'ultra resistente'),
(17, 'mesita ', 10, 66, 14577, 'ghfhfghhfghfghfgh'),
(19, 'sika ganergg ', 13, 55, 76766, 'hgfhgfhg'),
(20, 'mouse inalambrico', 12, 55, 2500, 'inalambrico'),
(21, 'Instalación Windows 11', 14, 0, 1300, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(33) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`id`, `nombre`) VALUES
(1, 'Microprocesadores'),
(2, 'Teclados'),
(3, 'Memorias'),
(9, 'Gabinete'),
(10, 'Mesa'),
(11, 'Disco'),
(12, 'Mousessss'),
(13, 'Sillas'),
(14, 'Servicio Técnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dni` int(8) NOT NULL,
  `clave` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `direccion`, `telefono`, `email`, `dni`, `clave`, `admin`) VALUES
(1, 'Juan Perez', 'casamia 234', '345786654', 'juanp@gmail.com', 42185246, '123', b'0'),
(2, 'Facundo', 'Calle123', '3534190869', 'Facundot773@gmail.com', 42185246, 'facu', b'1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rubro` (`id_rubro`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_rubro`) REFERENCES `rubros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
