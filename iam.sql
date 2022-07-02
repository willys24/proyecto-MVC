-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2022 a las 21:14:22
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filesg3`
--

CREATE TABLE `filesg3` (
  `id` int(7) UNSIGNED NOT NULL,
  `parent_id` int(7) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `content` longblob NOT NULL,
  `size` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `mtime` int(10) UNSIGNED NOT NULL,
  `mime` varchar(256) NOT NULL DEFAULT 'unknown',
  `read` enum('1','0') NOT NULL DEFAULT '1',
  `write` enum('1','0') NOT NULL DEFAULT '1',
  `locked` enum('1','0') NOT NULL DEFAULT '0',
  `hidden` enum('1','0') NOT NULL DEFAULT '0',
  `width` int(5) NOT NULL,
  `height` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `licencia_id` int(11) NOT NULL,
  `licencia_plan_id` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_numero` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_promotor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_tipo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_modalidad` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_areaCesion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_areaEquip` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_areaProy` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_viviendas` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_cargas` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_descripcion` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `licencia_distribucion` longtext COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`licencia_id`, `licencia_plan_id`, `licencia_numero`, `licencia_nombre`, `licencia_promotor`, `licencia_tipo`, `licencia_modalidad`, `licencia_areaCesion`, `licencia_areaEquip`, `licencia_areaProy`, `licencia_viviendas`, `licencia_cargas`, `licencia_descripcion`, `licencia_distribucion`) VALUES
(1, '5', '6154981', 'licencia 12', 'willy', 'tipo1', 'modalidad1', '12', '123', '123', 'asdasd', '123', 'desc', 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `plan_id` int(11) NOT NULL,
  `plan_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_constructora` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_decreto` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_unidades` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_zona` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_cronograma` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_transferencia` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `plan_departamento` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_ciudad` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_AreaNeta` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_AreaUtil` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_certificado` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_preexistencia` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_EfectoP` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_ParticipacionP` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_PParticipacionP` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_ValorP` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `plan_AnotacionP` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `plan_CancelacionP` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `plan_Observacion` longtext COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`plan_id`, `plan_nombre`, `plan_constructora`, `plan_decreto`, `plan_unidades`, `plan_zona`, `plan_cronograma`, `plan_transferencia`, `plan_departamento`, `plan_ciudad`, `plan_AreaNeta`, `plan_AreaUtil`, `plan_certificado`, `plan_preexistencia`, `plan_EfectoP`, `plan_ParticipacionP`, `plan_PParticipacionP`, `plan_ValorP`, `plan_AnotacionP`, `plan_CancelacionP`, `plan_Observacion`) VALUES
(5, 'Galicia del parque', 'willy', '46512', '32', 'rural', '2022-2025', '', 'Risaralda', 'pereira', '123', '12', '12312', 'no', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio`
--

CREATE TABLE `predio` (
  `predio_id` int(11) NOT NULL,
  `predio_plan_id` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_numero` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_matricula` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_propietario` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_areaTerr` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_areaCons` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_avaluo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_valorDeudaP` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_estrato` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_destinoEcon` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `predio_comentarios` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `predio_detallesTecn` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `predio_otras` longtext COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `predio`
--

INSERT INTO `predio` (`predio_id`, `predio_plan_id`, `predio_numero`, `predio_matricula`, `predio_propietario`, `predio_direccion`, `predio_areaTerr`, `predio_areaCons`, `predio_avaluo`, `predio_valorDeudaP`, `predio_estrato`, `predio_destinoEcon`, `predio_comentarios`, `predio_detallesTecn`, `predio_otras`) VALUES
(1, '5', '011314', 'mt-85', 'willy', 'cra 23', '61', '12', '1100200', '200003', '3', 'dest', 'coment', 'dett', 'otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_email` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_ciudad` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_clave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_privilegio` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_telefono`, `usuario_email`, `usuario_ciudad`, `usuario_usuario`, `usuario_clave`, `usuario_privilegio`) VALUES
(1, 'willy', '3135029776', 'willy@soto', 'Pereira', 'admin', 'ZCtEOXp0WDhMSmNKUDZseHAxOFFUdz09', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `filesg3`
--
ALTER TABLE `filesg3`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parent_name` (`parent_id`,`name`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`licencia_id`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indices de la tabla `predio`
--
ALTER TABLE `predio`
  ADD PRIMARY KEY (`predio_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `filesg3`
--
ALTER TABLE `filesg3`
  MODIFY `id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `licencia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `predio`
--
ALTER TABLE `predio`
  MODIFY `predio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
