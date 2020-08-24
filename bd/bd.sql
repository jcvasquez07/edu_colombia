-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `anho_academico`;
CREATE TABLE `anho_academico` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `anho` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `anho_academico` (`id`, `anho`) VALUES
(1,	'2020 - 2021'),
(2,	'2020');

DROP TABLE IF EXISTS `convenios`;
CREATE TABLE `convenios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `convenio` varchar(100) NOT NULL,
  `matricula` varchar(100) NOT NULL,
  `pension` varchar(100) NOT NULL,
  `id_asesor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `convenios` (`id`, `convenio`, `matricula`, `pension`, `id_asesor`) VALUES
(1,	'540-4',	'150000',	'150000',	12);

DROP TABLE IF EXISTS `docentes_materias`;
CREATE TABLE `docentes_materias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_docente` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `docentes_materias` (`id`, `id_docente`, `id_materia`) VALUES
(4,	16,	2);

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE `estudiantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `id_tarifa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `estudiantes` (`id`, `lugar_nacimiento`, `fecha_nacimiento`, `telefono`, `direccion`, `pais`, `numero_identificacion`, `lugar_expedido`, `materia_complementaria`, `genero`, `grupo_sanguineo`, `eps`, `simat`, `estado`, `foto`, `id_tipo_identificacion`, `id_acudiente`, `id_coordinador`, `id_programa_academico`, `id_oferta_educativa`, `id_grupo`, `id_tarifa`, `id_usuario`) VALUES
(1,	'CALI, COLOMBIA',	'1995-06-11',	'1234-5678',	'CALLE UNO CASA DOS',	'COLOMBIA',	'1234567890101',	'CALI, COLOMBIA',	'MI MATERIA COMPLEMENTARIA 2',	'F',	'op',	'1231BC',	'456DEF',	'retirado',	'',	1,	2,	3,	2,	3,	4,	1,	2),
(2,	'CALI, COLOMBIA',	'1995-06-11',	'1234-5678',	'MI DIRECCI&#211;N EN COLMBIA',	'COLOMBIA',	'1234567890101',	'CALI, COLOMBIA',	'MI MATERIA COMPLEMENTARIA 2',	'F',	'abp',	'1231BC',	'456DEF',	'matriculado',	'',	1,	1,	1,	5,	1,	1,	0,	3),
(3,	'MEDELLIN, COLOMBIA',	'1995-06-11',	'1234-5678',	'MI DIRECCI&#211;N EN COLMBIA',	'COLOMBIA',	'1234567890101',	'CALI, COLOMBIA',	'MI MATERIA COMPLEMENTARIA 2',	'M',	'bn',	'1231BC',	'456DEF',	'matriculado',	'',	1,	1,	1,	1,	1,	1,	0,	4),
(4,	'MEDELLIN, COLOMBIA',	'1995-06-11',	'1234-5678',	'MI DIRECCI&#211;N EN COLMBIA',	'COLOMBIA',	'1234567890101',	'CALI, COLOMBIA',	'MI MATERIA COMPLEMENTARIA 2',	'M',	'bn',	'1231BC',	'456DEF',	'matriculado',	'',	1,	1,	1,	1,	1,	1,	0,	7),
(5,	'MEDELLIN, COLOMBIA',	'1995-06-11',	'1234-5678',	'MI DIRECCI&#211;N EN COLMBIA',	'COLOMBIA',	'1234567890101',	'CALI, COLOMBIA',	'MI MATERIA COMPLEMENTARIA 2',	'M',	'bn',	'1231BC',	'456DEF',	'matriculado',	'',	1,	1,	1,	1,	1,	1,	0,	8),
(6,	'MEDELLIN, COLOMBIA',	'1995-06-11',	'1234-5678',	'MI DIRECCI&#211;N EN COLMBIA',	'COLOMBIA',	'1234567890101',	'CALI, COLOMBIA',	'MI MATERIA COMPLEMENTARIA 2',	'M',	'bn',	'1231BC',	'456DEF',	'matriculado',	'',	1,	1,	1,	1,	1,	1,	0,	9),
(7,	'MEDELLIN, COLOMBIA',	'1995-06-11',	'1234-5678',	'MI DIRECCI&#211;N EN COLMBIA',	'COLOMBIA',	'1234567890101',	'CALI, COLOMBIA',	'MI MATERIA COMPLEMENTARIA 2',	'M',	'bn',	'1231BC',	'456DEF',	'matriculado',	'',	1,	1,	1,	1,	1,	1,	2,	10),
(8,	'CUCUTA',	'1993-06-02',	'+5703106062752',	'CLL 20 # 17-25',	'COLOMBIA',	'807982563232',	'CUCUTA',	'ARTISTICA',	'M',	'an',	'',	'',	'matriculado',	'',	1,	13,	11,	1,	2,	1,	0,	14);

DROP TABLE IF EXISTS `estudiantes_tareas`;
CREATE TABLE `estudiantes_tareas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `estudiantes_tareas` (`id`, `id_estudiante`, `id_tarea`) VALUES
(1,	3,	1),
(2,	2,	1),
(3,	4,	1);

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_grupo` varchar(250) NOT NULL,
  `periodo_tiempo` varchar(250) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `id_anho` int(11) NOT NULL,
  `id_nivel_academico` int(11) NOT NULL,
  `id_jornada` int(11) NOT NULL,
  `id_modalidad` int(11) NOT NULL,
  `id_oferta_educativa` int(11) NOT NULL,
  `id_semestre` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `grupos` (`id`, `nombre_grupo`, `periodo_tiempo`, `fecha_inicio`, `fecha_final`, `id_anho`, `id_nivel_academico`, `id_jornada`, `id_modalidad`, `id_oferta_educativa`, `id_semestre`, `id_convenio`, `id_ubicacion`) VALUES
(1,	'TEOR&#205;A MUSICAL',	'',	'2020-08-01',	'2020-08-31',	1,	1,	1,	1,	1,	1,	1,	1),
(2,	'Grupo 2',	'Dos semanas',	'2020-08-01',	'2020-08-31',	1,	1,	1,	1,	1,	1,	1,	1),
(3,	'Grupo 3',	'',	'2020-08-01',	'2020-08-31',	1,	1,	1,	1,	1,	1,	1,	1),
(4,	'Grupo 4',	'',	'2020-08-01',	'2020-08-31',	1,	1,	1,	1,	1,	1,	1,	1),
(6,	'TROMPETA',	'DOS SEMANAS',	'2020-08-01',	'2020-08-16',	1,	1,	1,	1,	1,	1,	1,	1);

DROP TABLE IF EXISTS `grupos_asesor`;
CREATE TABLE `grupos_asesor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_asesor` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `grupos_asesor` (`id`, `id_asesor`, `id_grupo`) VALUES
(1,	12,	1),
(3,	12,	2);

DROP TABLE IF EXISTS `grupos_estudiante`;
CREATE TABLE `grupos_estudiante` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `grupos_estudiante` (`id`, `id_estudiante`, `id_grupo`) VALUES
(1,	3,	1),
(2,	2,	1),
(3,	4,	1);

DROP TABLE IF EXISTS `intervalos_tiempo`;
CREATE TABLE `intervalos_tiempo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intervalo_tiempo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `intervalos_tiempo` (`id`, `intervalo_tiempo`) VALUES
(1,	'ENERO A JUNIO'),
(2,	'JUNIO A NOVIEMBRE'),
(3,	'ENERO A NOVIEMBRE');

DROP TABLE IF EXISTS `jornadas`;
CREATE TABLE `jornadas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jornada` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `jornadas` (`id`, `jornada`) VALUES
(1,	'FIN DE SEMANA');

DROP TABLE IF EXISTS `libros`;
CREATE TABLE `libros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(500) NOT NULL,
  `autor` varchar(250) NOT NULL,
  `foto_portada` varchar(250) NOT NULL,
  `archivo` varchar(250) NOT NULL,
  `id_oferta_educativa` int(11) NOT NULL,
  `id_nivel_academico` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `libros` (`id`, `titulo`, `autor`, `foto_portada`, `archivo`, `id_oferta_educativa`, `id_nivel_academico`, `id_grupo`) VALUES
(1,	'La Mujer de la Arena',	'Kobo Abe',	'ebooks/IMG-20200818-070644.JPG',	'ebooks/La mujer de la arena - Kobo Abe.pdf',	1,	1,	1);

DROP TABLE IF EXISTS `materias`;
CREATE TABLE `materias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo_materia` varchar(50) NOT NULL,
  `nombre_materia` varchar(500) NOT NULL,
  `aprobacion_promedio` varchar(10) NOT NULL,
  `promedio_final` varchar(10) NOT NULL,
  `id_oferta_educativa` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_nivel_academico` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `materias` (`id`, `codigo_materia`, `nombre_materia`, `aprobacion_promedio`, `promedio_final`, `id_oferta_educativa`, `id_grupo`, `id_nivel_academico`) VALUES
(1,	'BP0003',	'LECTURA ELEMENTAL',	'60.0',	'61.0',	1,	1,	1),
(2,	'BP0004',	'ARITMETICA',	'60.2',	'61.2',	1,	1,	1);

DROP TABLE IF EXISTS `modalidades`;
CREATE TABLE `modalidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modalidad` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `modalidades` (`id`, `modalidad`) VALUES
(1,	'PRESENCIAL'),
(2,	'SEMI PRESENCIAL'),
(3,	'A DISTANCIA'),
(4,	'VIRTUAL');

DROP TABLE IF EXISTS `niveles_academicos`;
CREATE TABLE `niveles_academicos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_nivel_academico` varchar(250) NOT NULL,
  `id_oferta` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `niveles_academicos` (`id`, `nombre_nivel_academico`, `id_oferta`) VALUES
(1,	'NIVEL PRIMARIO',	1),
(2,	'NIVEL PRIMARIO 2',	1);

DROP TABLE IF EXISTS `ofertas_educativas`;
CREATE TABLE `ofertas_educativas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo_oferta` varchar(5) NOT NULL,
  `siguiente` int(4) NOT NULL,
  `nombre_oferta` varchar(250) NOT NULL,
  `anho` varchar(20) NOT NULL,
  `nivel_academico` int(11) NOT NULL,
  `oferta` varchar(250) NOT NULL,
  `jornada` int(11) NOT NULL,
  `modalidad` int(11) NOT NULL,
  `ubicacion` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `convenio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `ofertas_educativas` (`id`, `codigo_oferta`, `siguiente`, `nombre_oferta`, `anho`, `nivel_academico`, `oferta`, `jornada`, `modalidad`, `ubicacion`, `grupo`, `convenio`) VALUES
(1,	'BP',	5,	'Educaci&#243;n B&#225;sica Primaria',	'1',	0,	'',	0,	0,	0,	0,	0),
(2,	'BS',	2,	'Educaci&#243;n B&#225;sica Secundaria',	'1',	0,	'',	0,	0,	0,	0,	0),
(3,	'MA',	2,	'Educaci&#243;n Media Acad&#233;mica',	'1',	0,	'',	0,	0,	0,	0,	0),
(5,	'ET',	1,	'Educaci&#243;n para el Trabajo y el Desarrollo Humano',	'1',	0,	'',	0,	0,	0,	0,	0),
(6,	'FC',	1,	'Formaci&#243;n Complementaria',	'1',	0,	'',	0,	0,	0,	0,	0);

DROP TABLE IF EXISTS `personal`;
CREATE TABLE `personal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `telefono` varchar(30) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `personal` (`id`, `telefono`, `direccion`, `id_usuario`) VALUES
(1,	'7890-1234',	'ESTA ES LA DIRECCI&#211;N DEL COORDINADOR 1',	11),
(2,	'9012-3456',	'ACUDIENTE 1',	13),
(3,	'2345-6789',	'ROCADURA CASA 23',	12);

DROP TABLE IF EXISTS `programas_academicos`;
CREATE TABLE `programas_academicos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_programa` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `programas_academicos` (`id`, `nombre_programa`) VALUES
(1,	'Ciclos'),
(2,	'T&#233;cnicas'),
(3,	'Cursos'),
(4,	'Seminarios'),
(5,	'Diplomados');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `roles` (`id`, `rol`) VALUES
(1,	'administrador'),
(2,	'administrativo'),
(3,	'secretaria'),
(4,	'acudiente'),
(5,	'docente'),
(6,	'asesor educativo'),
(7,	'asistente'),
(8,	'estudiante');

DROP TABLE IF EXISTS `semestres`;
CREATE TABLE `semestres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `semestre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `semestres` (`id`, `semestre`) VALUES
(1,	'SEMESTRE 1'),
(2,	'SEMESTRE 2');

DROP TABLE IF EXISTS `tareas`;
CREATE TABLE `tareas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_tarea` varchar(250) NOT NULL,
  `descripcion_tarea` varchar(500) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `id_oferta_educativa` int(11) NOT NULL,
  `id_nivel_academico` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `archivo` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tareas` (`id`, `nombre_tarea`, `descripcion_tarea`, `fecha_entrega`, `id_oferta_educativa`, `id_nivel_academico`, `id_grupo`, `id_materia`, `archivo`) VALUES
(1,	'TAREA DE PRUEBA',	'ESTA ES LA DESCRIPCION DE LA TAREA DE PRUEBA',	'2020-08-31',	1,	1,	1,	2,	''),
(2,	'TAREA DOS',	'TAREA MUY COMPLICADA Y DIF&#205;CIL',	'2020-08-31',	2,	2,	3,	1,	''),
(3,	'TAREA TRES',	'OTRA TAREA MAS',	'2020-08-17',	1,	1,	2,	2,	'');

DROP TABLE IF EXISTS `tarifas`;
CREATE TABLE `tarifas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_tarifa` varchar(100) NOT NULL,
  `nombre_tarifa` varchar(100) NOT NULL,
  `valor_tarifa` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tarifas` (`id`, `tipo_tarifa`, `nombre_tarifa`, `valor_tarifa`) VALUES
(1,	'CARGO &#218;NICO',	'INSCRIPCI&#211;N',	'80'),
(2,	'MENSUALIDAD',	'MENSUALIDAD',	'25');

DROP TABLE IF EXISTS `tipos_identificaciones`;
CREATE TABLE `tipos_identificaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_identificacion` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tipos_identificaciones` (`id`, `tipo_identificacion`) VALUES
(1,	'C&#233;dula de ciudadan&#237;a'),
(2,	'Tarjeta de identidad'),
(3,	'Registro civil de nacimiento'),
(4,	'C&#233;dula de identidad Venezuela'),
(5,	'C&#233;dula de extranjer&#237;a'),
(6,	'Pasaporte'),
(7,	'Permiso especial PEP'),
(8,	'TMF');

DROP TABLE IF EXISTS `ubicaciones`;
CREATE TABLE `ubicaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ubicacion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `ubicaciones` (`id`, `ubicacion`) VALUES
(1,	'CUCUT&#193;'),
(2,	'CUCUTILLA'),
(3,	'BOCONO');

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `creado_por` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `usuarios` (`id`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `email`, `clave`, `observaciones`, `rol`, `activo`, `creado`, `creado_por`) VALUES
(1,	'ALAN',	'U/N',	'BRITO',	'DELGADO',	'admin@gmail.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	1,	'SI',	'2020-05-27 16:41:44',	1),
(2,	'PERLA',	'MARINA',	'HERNANDEZ',	'SALAZ&#193;R',	'perlita@email.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	5,	'SI',	'2020-05-27 16:41:44',	1),
(3,	'MAR&#205;A',	'AZUCENA DEL CARMEN',	'RAM&#205;REZ',	'DELGADO',	'mary95@yahoo.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	8,	'SI',	'2020-05-27 16:53:02',	1),
(4,	'JORGE',	'CESAR',	'VELASQUEZ',	'RAMOS',	'jc@abracadabra.net',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	8,	'SI',	'2020-05-29 08:31:39',	1),
(5,	'JUAN',	'CARLOS',	'VELASQUEZ',	'ROMERO',	'gifigsdr@sharklasers.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	8,	'SI',	'2020-05-29 08:44:38',	1),
(6,	'GERARDO',	'ANTONIO',	'ESCOBAR',	'SALAZAR',	'gifigsdr@yasdko.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	8,	'SI',	'2020-05-29 08:52:29',	1),
(7,	'JUAN',	'DAVID',	'FUENTES',	'OSORIO',	'david@yahoo.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	8,	'SI',	'2020-05-29 09:02:54',	1),
(8,	'JORGE',	'CARLOS',	'VELASQUEZ',	'SOSA',	'jcvs@abracadabra.net',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	8,	'SI',	'2020-05-29 10:40:09',	1),
(9,	'MAR&#205;A',	'ANTONIO',	'RAM&#205;REZ',	'DELGADO',	'sehector@yahoo.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	8,	'SI',	'2020-05-29 10:44:58',	1),
(10,	'JESUS',	'ANTONIO',	'CABEZA',	'TRUJILLO',	'soyungatocurioso@gmail.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	8,	'SI',	'2020-06-01 15:04:44',	1),
(11,	'ESTEBAN',	'JOSE',	'LAZO',	'SALAZAR',	'coordinador1@gmail.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	6,	'SI',	'2020-06-15 09:27:42',	1),
(12,	'PEDRO',	'UN',	'PICAPIEDRA',	'',	'pedro@yahoo.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	6,	'SI',	'2020-06-15 09:33:08',	1),
(13,	'ROSA',	'MARIA',	'FUENTES',	'HEREDIA',	'rosamaria@hotmail.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	4,	'SI',	'2020-06-15 09:37:20',	1),
(14,	'WILSON',	'PABLO',	'TAMARA',	'',	'pablo.andres.tamara@gmail.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	8,	'SI',	'2020-07-11 16:36:29',	1),
(15,	'JORGE',	'EDUARDO',	'VASQUEZ',	'MAYEN',	'jevasquez@email.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	5,	'SI',	'2020-05-27 16:41:44',	1),
(16,	'WENDY',	'GABRIELA',	'PINEDA',	'',	'wpineda@email.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	5,	'SI',	'2020-05-27 16:41:44',	1),
(17,	'CARLOS',	'ALBERTO',	'URRUTIA',	'',	'currutia@email.com',	'$2y$10$v3qF9BXdaSbHqDAQqTewmOjkFSyi4s.QXfb7Hzm4MlVX8sdGt72vO',	'clave es pass1',	5,	'SI',	'2020-05-27 16:41:44',	1),
(18,	'EDWIN',	'ALEJANDRO',	'RANGEL',	'HURTADO',	'rangelhurtado@gmail.com',	'$2y$10$3a0v1zRReaSOOiCzoFBdveezWpxLFgk6jhZd6u96pFOJD/havKx62',	'',	3,	'SI',	'2020-08-23 20:11:33',	1);

-- 2020-08-24 12:23:54
