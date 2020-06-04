-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-06-2020 a las 12:37:54
-- Versión del servidor: 10.3.22-MariaDB-log-cll-lve
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jcprfvau_colombia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acudientes`
--

CREATE TABLE `acudientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_acudiente` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acudientes`
--

INSERT INTO `acudientes` (`id`, `nombre_acudiente`) VALUES
(1, 'Acudiente 1'),
(2, 'Acudiente 2'),
(3, 'Acudiente 3'),
(4, 'Acudiente 4'),
(5, 'Acudiente 5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinadores`
--

CREATE TABLE `coordinadores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_coordinador` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `coordinadores`
--

INSERT INTO `coordinadores` (`id`, `nombre_coordinador`) VALUES
(1, 'Coordinador 1'),
(2, 'Coordinador 2'),
(3, 'Coordinador 3'),
(4, 'Coordinador 4'),
(5, 'Coordinador 5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `lugar_nacimiento` varchar(250) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `pais` varchar(20) NOT NULL,
  `numero_identificacion` varchar(100) NOT NULL,
  `lugar_expedido` varchar(250) NOT NULL,
  `materia_complementaria` varchar(250) NOT NULL,
  `genero` varchar(2) NOT NULL,
  `grupo_sanguineo` varchar(3) NOT NULL,
  `eps` varchar(100) NOT NULL,
  `simat` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `foto` varchar(500) NOT NULL,
  `id_tipo_identificacion` int(11) NOT NULL,
  `id_acudiente` int(11) NOT NULL,
  `id_coordinador` int(11) NOT NULL,
  `id_programa_academico` int(11) NOT NULL,
  `id_oferta_educativa` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `lugar_nacimiento`, `fecha_nacimiento`, `telefono`, `direccion`, `pais`, `numero_identificacion`, `lugar_expedido`, `materia_complementaria`, `genero`, `grupo_sanguineo`, `eps`, `simat`, `estado`, `foto`, `id_tipo_identificacion`, `id_acudiente`, `id_coordinador`, `id_programa_academico`, `id_oferta_educativa`, `id_grupo`, `id_usuario`) VALUES
(1, 'CALI, COLOMBIA', '1995-06-11', '1234-5678', 'CALLE UNO CASA DOS', 'COLOMBIA', '1234567890101', 'CALI, COLOMBIA', 'MI MATERIA COMPLEMENTARIA 2', 'F', 'op', '1231BC', '456DEF', 'retirado', '', 1, 2, 3, 2, 3, 4, 2),
(2, 'CALI, COLOMBIA', '1995-06-11', '1234-5678', 'MI DIRECCI&#211;N EN COLMBIA', 'COLOMBIA', '1234567890101', 'CALI, COLOMBIA', 'MI MATERIA COMPLEMENTARIA 2', 'F', 'abp', '1231BC', '456DEF', 'matriculado', '', 1, 1, 1, 5, 1, 1, 3),
(3, 'MEDELLIN, COLOMBIA', '1995-06-11', '1234-5678', 'MI DIRECCI&#211;N EN COLMBIA', 'COLOMBIA', '1234567890101', 'CALI, COLOMBIA', 'MI MATERIA COMPLEMENTARIA 2', 'M', 'bn', '1231BC', '456DEF', 'matriculado', '', 1, 1, 1, 1, 1, 1, 4),
(4, 'MEDELLIN, COLOMBIA', '1995-06-11', '1234-5678', 'MI DIRECCI&#211;N EN COLMBIA', 'COLOMBIA', '1234567890101', 'CALI, COLOMBIA', 'MI MATERIA COMPLEMENTARIA 2', 'M', 'bn', '1231BC', '456DEF', 'matriculado', '', 1, 1, 1, 1, 1, 1, 7),
(5, 'MEDELLIN, COLOMBIA', '1995-06-11', '1234-5678', 'MI DIRECCI&#211;N EN COLMBIA', 'COLOMBIA', '1234567890101', 'CALI, COLOMBIA', 'MI MATERIA COMPLEMENTARIA 2', 'M', 'bn', '1231BC', '456DEF', 'matriculado', '', 1, 1, 1, 1, 1, 1, 8),
(6, 'MEDELLIN, COLOMBIA', '1995-06-11', '1234-5678', 'MI DIRECCI&#211;N EN COLMBIA', 'COLOMBIA', '1234567890101', 'CALI, COLOMBIA', 'MI MATERIA COMPLEMENTARIA 2', 'M', 'bn', '1231BC', '456DEF', 'matriculado', '', 1, 1, 1, 1, 1, 1, 9),
(7, 'MEDELLIN, COLOMBIA', '1995-06-11', '1234-5678', 'MI DIRECCI&#211;N EN COLMBIA', 'COLOMBIA', '1234567890101', 'CALI, COLOMBIA', 'MI MATERIA COMPLEMENTARIA 2', 'M', 'bn', '1231BC', '456DEF', 'matriculado', '', 1, 1, 1, 1, 1, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_grupo` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre_grupo`) VALUES
(1, 'Grupo 1'),
(2, 'Grupo 2'),
(3, 'Grupo 3'),
(4, 'Grupo 4'),
(5, 'Grupo 5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_educativas`
--

CREATE TABLE `ofertas_educativas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_oferta` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ofertas_educativas`
--

INSERT INTO `ofertas_educativas` (`id`, `nombre_oferta`) VALUES
(1, 'Educaci&#243;n B&#225;sica Primaria'),
(2, 'Educaci&#243;n B&#225;sica Secundaria'),
(3, 'Educaci&#243;n Media Acad&#233;mica'),
(4, 'Educaci&#243;n B&#225;sica Acad&#233;mica'),
(5, 'Educaci&#243;n para el Trabajo y el Desarrollo Humano'),
(6, 'Formaci&#243;n Complementaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas_academicos`
--

CREATE TABLE `programas_academicos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_programa` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programas_academicos`
--

INSERT INTO `programas_academicos` (`id`, `nombre_programa`) VALUES
(1, 'Ciclos'),
(2, 'T&#233;cnicas'),
(3, 'Cursos'),
(4, 'Seminarios'),
(5, 'Diplomados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'administrador'),
(2, 'administrativo'),
(3, 'secretaria'),
(4, 'acudiente'),
(5, 'docente'),
(6, 'coordinador'),
(7, 'asistente'),
(8, 'estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_identificaciones`
--

CREATE TABLE `tipos_identificaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_identificacion` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_identificaciones`
--

INSERT INTO `tipos_identificaciones` (`id`, `tipo_identificacion`) VALUES
(1, 'C&#233;dula de ciudadan&#237;a'),
(2, 'Tarjeta de identidad'),
(3, 'Registro civil de nacimiento'),
(4, 'C&#233;dula de identidad Venezuela'),
(5, 'C&#233;dula de extranjer&#237;a'),
(6, 'Pasaporte'),
(7, 'Permiso especial PEP'),
(8, 'TMF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre1` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre2` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido2` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(2) NOT NULL,
  `activo` varchar(5) COLLATE utf8_spanish_ci DEFAULT 'SI',
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `creado_por` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `email`, `clave`, `observaciones`, `rol`, `activo`, `creado`, `creado_por`) VALUES
(1, 'ALAN', 'U/N', 'BRITO', 'DELGADO', 'admin@gmail.com', '$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO', 'LA CLAVE ES PASS1 -', 1, 'SI', '2020-05-27 16:41:44', 1),
(2, 'PERLA', 'MARINA', 'HERNANDEZ', 'SALAZ&#193;R', 'perlita@email.com', '$2y$10$kL.M3H2cygcYt9tDacTFL.4b8q5LZe7Gx5SuyA9CT0W1SJPpY75ey', 'ESTE USUARIO TIENE UNA CLAVE ALEATORIA', 8, 'SI', '2020-05-27 16:41:44', 1),
(3, 'MAR&#205;A', 'AZUCENA DEL CARMEN', 'RAM&#205;REZ', 'DELGADO', 'mary95@yahoo.com', '$2y$10$MmWRU67BzS8uoACsj0GDGeRgLzHsXKMd4aoh.SdMUVkMzSiotTGTG', '', 8, 'SI', '2020-05-27 16:53:02', 1),
(4, 'JORGE', 'CESAR', 'VELASQUEZ', 'RAMOS', 'jc@abracadabra.net', '$2y$10$hDJz1V7oRzIBmOgPIYIWi.c3sqRHDuNJnmoeYa0yP43TP7.D65wa2', 'USUARIO DE PRUEBA, BORRAR', 8, '', '2020-05-29 08:31:39', 1),
(5, 'JUAN', 'CARLOS', 'VELASQUEZ', 'ROMERO', 'gifigsdr@sharklasers.com', '$2y$10$NmEIwCwdqI4uiqpDze5X1ODwGJSg.j4R0baOA7rOYy2.xFTME1hGu', 'RNTWG)U0', 8, '', '2020-05-29 08:44:38', 1),
(6, 'GERARDO', 'ANTONIO', 'ESCOBAR', 'SALAZAR', 'gifigsdr@yasdko.com', '$2y$10$dC0eg0Dp6lH8SwKxug7BeuiG0nA3RRzZQBEtbG6zBfn5jvpjzs74u', 'V4J@*P$@', 8, '', '2020-05-29 08:52:29', 1),
(7, 'JUAN', 'DAVID', 'FUENTES', 'OSORIO', 'david@yahoo.com', '$2y$10$Eq7GNXD3kDJRPECijLnaz.ud1UfcraWKFjdzU1a3fIVJ8OwloJKfW', 'AORP2LAI', 8, '', '2020-05-29 09:02:54', 1),
(8, 'JORGE', 'CARLOS', 'VELASQUEZ', 'SOSA', 'jcvs@abracadabra.net', '$2y$10$Oq3x0wQ/IS9/Kc7O8t/sqO4Rwfg7oawtUCkXWGu5mMgStcQYmvjxK', 'FX%AS*OU', 8, '', '2020-05-29 10:40:09', 1),
(9, 'MAR&#205;A', 'ANTONIO', 'RAM&#205;REZ', 'DELGADO', 'sehector@yahoo.com', '$2y$10$j5zWsPMOOGu0uLX.EAIgFOKS7ATrZqdDjzLI3SupZC18EhFg7nx7W', '5DKVD6BP', 8, '', '2020-05-29 10:44:58', 1),
(10, 'JESUS', 'ANTONIO', 'CABEZA', 'TRUJILLO', 'soyungatocurioso@gmail.com', '$2y$10$jEkTkJa1ABzSjlsWsmuHpu8pv0LUYRpi8zKKHRURe.5w.WfQby.rO', '121324GGUGUYG', 8, '', '2020-06-01 15:04:44', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acudientes`
--
ALTER TABLE `acudientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ofertas_educativas`
--
ALTER TABLE `ofertas_educativas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programas_academicos`
--
ALTER TABLE `programas_academicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_identificaciones`
--
ALTER TABLE `tipos_identificaciones`
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
-- AUTO_INCREMENT de la tabla `acudientes`
--
ALTER TABLE `acudientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ofertas_educativas`
--
ALTER TABLE `ofertas_educativas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `programas_academicos`
--
ALTER TABLE `programas_academicos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipos_identificaciones`
--
ALTER TABLE `tipos_identificaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
