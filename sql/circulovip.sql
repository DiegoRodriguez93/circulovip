-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Servidor: mysql3001.mochahost.com
-- Tiempo de generación: 16-05-2020 a las 16:13:45
-- Versión del servidor: 5.6.33
-- Versión de PHP: 7.2.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `swsangel_circulovip`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `id_cita` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_emisor` int(11) DEFAULT NULL,
  `id_receptor` int(11) DEFAULT NULL,
  `dia_hora` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `estado` int(1) DEFAULT NULL,
  `zona_horaria_emisor` int(3) DEFAULT NULL,
  `sala` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cita`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_emisor`, `id_receptor`, `dia_hora`, `estado`, `zona_horaria_emisor`, `sala`) VALUES
(1, 12, 10, '2020-02-24 20:44:44', 1, -3, 'Circulo_Vip_SGZOLNVH47'),
(2, 10, 12, '2020-03-03 04:25:00', 2, -2, 'Circulo_Vip_RWP39MII84'),
(3, 10, 12, '1969-12-31 21:00:00', 2, -2, 'Circulo_Vip_2TSTSGF5DZ'),
(4, 10, 12, '2020-03-03 14:00:00', 2, -2, 'Circulo_Vip_HO1JXPHPAY'),
(5, 14, 10, '2020-03-15 22:00:48', 1, 0, 'Circulo_Vip_LIJ90XPTVF'),
(6, 9, 13, '2020-03-16 22:12:10', 1, 0, 'Circulo_Vip_X2XR2TTJ87'),
(7, 9, 13, '2020-03-16 22:16:24', 0, 0, 'Circulo_Vip_IAGHG9MIMP'),
(8, 10, 12, '2020-03-30 18:30:00', 2, -2, 'Circulo_Vip_0P2CCGDO2H'),
(9, 12, 10, '2020-04-10 17:00:00', 2, -3, 'Circulo_Vip_3UCLRO5FPG'),
(10, 10, 12, '2020-04-27 18:00:00', 2, -2, 'Circulo_Vip_Q8LS9I4593'),
(11, 10, 12, '2020-04-26 14:33:16', 2, -2, 'Circulo_Vip_VOGLQRPFJW'),
(12, 9, 10, '2020-04-27 10:50:44', 1, 0, 'Circulo_Vip_NBXM2C5SLL'),
(13, 9, 10, '2020-04-27 12:30:00', 2, 0, 'Circulo_Vip_WMIEZB9W3W');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_empresa`
--

CREATE TABLE IF NOT EXISTS `datos_empresa` (
  `id_empresa` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `pais` varchar(80) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `url_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `datos_empresa`
--

INSERT INTO `datos_empresa` (`id_empresa`, `id_user`, `nombre`, `pais`, `descripcion`, `url_image`) VALUES
(1, 10, 'Renoca', 'Uruguay', 'Empresa de desarrollo de software', 'renoca.ml../../../uploads/158792147125RENOCA.jpg'),
(2, 12, 'Test de emprsa', 'Brasil', 'Empresa de alimentos...', NULL),
(3, 9, 'demo 200', 'Uruguay', 'dasd  adasd  adads', 'renoca.ml../../../uploads/15828941444983779408_2355749491196273_3133785761829093376_o.jpg'),
(4, 13, 'Demo 100', 'Uruguay', 'Demo 10 2252 klljasd opasd pÃ sdjsd', 'renoca.ml../../../uploads/1582894107710 (9).jpg'),
(5, 14, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_user`
--

CREATE TABLE IF NOT EXISTS `datos_user` (
  `id_datos_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `cargo` varchar(60) DEFAULT NULL,
  `acerca_de_mi` varchar(255) DEFAULT NULL,
  `url_avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_datos_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `datos_user`
--

INSERT INTO `datos_user` (`id_datos_user`, `id_user`, `cargo`, `acerca_de_mi`, `url_avatar`) VALUES
(1, 12, 'Gerente', '123456789', NULL),
(2, 13, NULL, NULL, 'renoca.ml../../../uploads/158289406318Victor (2).jpg'),
(3, 9, 'Director', 'kasiasdad jasdasdu asdjajsdad 5552', NULL),
(4, 10, 'Director', 'Soy una persona emprendedora que nunca dejo de aprender.', 'renoca.ml/../../uploads/158646156514cv-profile-min.jpg'),
(5, 14, NULL, NULL, 'renoca.ml../../../uploads/158432414440Emanuel Cimer-min.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE IF NOT EXISTS `dias` (
  `id_dia` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `dia` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`id_dia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`id_dia`, `dia`) VALUES
(1, 'lunes'),
(2, 'martes'),
(3, 'miercoles'),
(4, 'jueves'),
(5, 'viernes'),
(6, 'sabado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas_ronda`
--

CREATE TABLE IF NOT EXISTS `fechas_ronda` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `fechas_ronda`
--

INSERT INTO `fechas_ronda` (`id`, `fecha`) VALUES
(1, '2020-02-20'),
(3, '2020-02-21'),
(4, '2020-03-02'),
(5, '2020-03-03'),
(6, '2020-03-26'),
(7, '2020-04-26'),
(8, '2020-04-15'),
(9, '2020-03-30'),
(10, '2020-04-10'),
(11, '2020-04-27'),
(12, '2020-04-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_dia` int(7) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=104 ;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `id_dia`, `hora`, `id_user`) VALUES
(1, 123456, '09:00:00', 10),
(2, 12345, '09:30:00', 10),
(3, 12345, '10:00:00', 10),
(4, 12345, '10:30:00', 10),
(5, 12345, '11:00:00', 10),
(6, 12345, '11:30:00', 10),
(7, 12345, '12:00:00', 10),
(8, 12345, '12:30:00', 10),
(9, 12345, '13:00:00', 10),
(10, 12345, '13:30:00', 10),
(11, 12345, '14:00:00', 10),
(12, 12345, '14:30:00', 10),
(13, 12345, '15:00:00', 10),
(14, 12345, '15:30:00', 10),
(15, 12345, '16:00:00', 10),
(16, 12345, '16:30:00', 10),
(17, 12345, '17:00:00', 10),
(18, 12345, '17:30:00', 10),
(19, 12345, '18:00:00', 10),
(20, 12345, '06:15:00', 10),
(103, 12345, '09:00:00', 9),
(22, 12345, '09:30:00', 9),
(23, 12345, '10:00:00', 9),
(24, 12345, '10:30:00', 9),
(25, 12345, '11:00:00', 9),
(26, 12345, '11:30:00', 9),
(27, 12345, '12:00:00', 9),
(28, 12345, '12:30:00', 9),
(29, 12345, '13:00:00', 9),
(30, 12345, '13:30:00', 9),
(31, 12345, '14:00:00', 9),
(32, 12345, '14:30:00', 9),
(33, 12345, '15:00:00', 9),
(84, 12345, '09:00:00', 14),
(35, 12345, '16:00:00', 9),
(36, 12345, '16:30:00', 9),
(37, 12345, '17:00:00', 9),
(38, 12345, '17:30:00', 9),
(39, 12345, '18:00:00', 9),
(65, 12345, '09:00:00', 13),
(41, 12345, '09:30:00', 12),
(42, 12345, '10:00:00', 12),
(43, 12345, '10:30:00', 12),
(44, 12345, '11:00:00', 12),
(45, 12345, '11:30:00', 12),
(46, 12345, '12:00:00', 12),
(47, 12345, '12:30:00', 12),
(48, 12345, '13:00:00', 12),
(49, 12345, '13:30:00', 12),
(50, 12345, '14:00:00', 12),
(51, 12345, '14:30:00', 12),
(52, 12345, '15:00:00', 12),
(53, 12345, '15:30:00', 12),
(54, 12345, '16:00:00', 12),
(55, 12345, '16:30:00', 12),
(56, 12345, '17:00:00', 12),
(57, 12345, '17:30:00', 12),
(58, 12345, '18:00:00', 12),
(64, 1234, '04:25:00', 12),
(66, 12345, '09:30:00', 13),
(67, 12345, '10:00:00', 13),
(68, 12345, '10:30:00', 13),
(69, 12345, '11:00:00', 13),
(70, 12345, '11:30:00', 13),
(71, 12345, '12:00:00', 13),
(72, 12345, '12:30:00', 13),
(73, 12345, '13:00:00', 13),
(74, 12345, '13:30:00', 13),
(75, 12345, '14:00:00', 13),
(76, 12345, '14:30:00', 13),
(77, 12345, '15:00:00', 13),
(78, 12345, '15:30:00', 13),
(79, 12345, '16:00:00', 13),
(80, 12345, '16:30:00', 13),
(81, 12345, '17:00:00', 13),
(82, 12345, '17:30:00', 13),
(83, 12345, '18:00:00', 13),
(85, 12345, '09:30:00', 14),
(86, 12345, '10:00:00', 14),
(87, 12345, '10:30:00', 14),
(88, 12345, '11:00:00', 14),
(89, 12345, '11:30:00', 14),
(90, 12345, '12:00:00', 14),
(91, 12345, '12:30:00', 14),
(92, 12345, '13:00:00', 14),
(93, 12345, '13:30:00', 14),
(94, 12345, '14:00:00', 14),
(95, 12345, '14:30:00', 14),
(96, 12345, '15:00:00', 14),
(97, 12345, '15:30:00', 14),
(98, 12345, '16:00:00', 14),
(99, 12345, '16:30:00', 14),
(100, 12345, '17:00:00', 14),
(101, 12345, '17:30:00', 14),
(102, 12345, '18:00:00', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios_personalizados`
--

CREATE TABLE IF NOT EXISTS `horarios_personalizados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horario` time NOT NULL,
  `dia_de_cita` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `horarios_personalizados`
--

INSERT INTO `horarios_personalizados` (`id`, `horario`, `dia_de_cita`, `id_user`, `tipo`) VALUES
(3, '09:00:00', '2020-04-27', 10, 0),
(2, '06:15:00', '2020-04-27', 10, 0),
(4, '09:30:00', '2020-04-27', 10, 0),
(5, '10:00:00', '2020-04-27', 10, 0),
(6, '10:30:00', '2020-04-27', 10, 0),
(7, '11:00:00', '2020-04-27', 10, 0),
(8, '11:30:00', '2020-04-27', 10, 0),
(9, '12:00:00', '2020-04-27', 10, 1),
(10, '04:10:00', '2020-04-27', 10, 0),
(11, '17:30:00', '2020-04-27', 10, 1),
(12, '17:15:00', '2020-04-27', 10, 1),
(13, '20:00:00', '2020-04-27', 12, 1),
(14, '00:00:00', '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_emisor` int(11) DEFAULT NULL,
  `id_receptor` int(11) DEFAULT NULL,
  `mensaje` varchar(250) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `leido` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `id_emisor`, `id_receptor`, `mensaje`, `fecha`, `leido`) VALUES
(5, 10, 12, '123', '2020-02-13 09:31:20', 1),
(2, 10, 12, 'testtt 22 22', '2020-02-02 11:33:00', 1),
(3, 10, 12, 'testtt 22 22', '2020-02-02 11:33:00', 1),
(9, 12, 10, 'test', '2020-02-13 11:31:24', 1),
(10, 10, 12, '123', '2020-02-18 21:00:14', 1),
(11, 10, 12, '22', '2020-02-18 21:03:50', 1),
(12, 9, 10, '11', '2020-02-18 21:04:49', 1),
(13, 10, 9, '123', '2020-02-18 21:05:43', 1),
(14, 10, 9, '22', '2020-02-18 21:10:30', 1),
(15, 10, 12, '123', '2020-02-18 21:11:54', 1),
(16, 10, 9, 'prueba', '2020-02-18 21:12:11', 1),
(17, 10, 9, '123', '2020-02-18 21:12:23', 1),
(18, 10, 9, 'para victor', '2020-02-18 21:12:47', 1),
(19, 10, 12, 'para admin', '2020-02-18 21:12:57', 1),
(20, 10, 12, 'test', '2020-02-18 21:42:36', 1),
(21, 12, 10, 'hola', '2020-02-22 17:54:42', 1),
(22, 12, 10, 'test', '2020-02-22 18:04:57', 1),
(23, 12, 10, 'mensaje para diego r', '2020-02-22 18:05:33', 1),
(24, 12, 10, 'tt5', '2020-02-22 18:12:42', 1),
(25, 10, 12, '12', '2020-02-22 21:32:38', 1),
(26, 13, 9, 'Lorem ipsum dolor sit amet consectetur adipiscing elit dictumst platea turpis nulla, nascetur porta nunc curae ornare magnis malesuada libero commodo vel cras nullam, penatibus molestie consequat aptent felis vestibulum condimentum parturient interdu', '2020-02-28 09:52:37', 1),
(27, 9, 13, 'Curabitur sem natoque non laoreet interdum nunc euismod turpis dictum condimentum taciti lectus blandit netus, facilisis molestie curae convallis mollis hendrerit ac fames pretium pellentesque consequat tincidunt. Mus erat sodales odio vestibulum mal', '2020-02-28 09:58:29', 1),
(28, 9, 13, 'hola demo', '2020-02-28 10:11:25', 1),
(29, 10, 12, '123', '2020-03-15 12:01:12', 1),
(30, 14, 10, 'test', '2020-03-15 12:12:06', 1),
(31, 10, 14, '123', '2020-03-15 12:13:54', 1),
(32, 10, 12, '321', '2020-03-15 12:14:17', 1),
(33, 10, 12, '321', '2020-03-15 12:14:17', 1),
(34, 10, 14, '321', '2020-03-15 12:14:24', 1),
(35, 10, 14, '456', '2020-03-15 12:14:27', 1),
(36, 10, 14, '123', '2020-03-15 12:49:55', 1),
(37, 10, 14, '44', '2020-03-15 13:38:40', 1),
(38, 10, 12, '322123', '2020-03-15 13:38:40', 1),
(39, 10, 14, '443', '2020-03-15 13:38:57', 1),
(40, 10, 14, '1', '2020-03-15 13:59:00', 1),
(41, 10, 14, 'mensaje de prueba desde el index', '2020-03-15 15:40:01', 1),
(42, 10, 14, 'Otra prueba de mensaje desde renoca\n', '2020-03-15 20:49:44', 1),
(43, 10, 12, 'Prueba de mensaje al admin desde renoca.', '2020-03-15 20:49:58', 1),
(44, 10, 14, 'Test!', '2020-03-15 23:00:56', 1),
(45, 14, 10, 'test', '2020-03-20 14:29:20', 1),
(46, 12, 10, 'test', '2020-04-09 17:12:51', 1),
(47, 10, 12, '123', '2020-04-09 17:13:57', 1),
(48, 10, 12, 'Prueba', '2020-04-26 14:08:41', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_empresa`, `nombre`, `descripcion`, `img_url`) VALUES
(4, 3, 'Demo Productos', 'Lorem ipsum dolor sit amet consectetur adipiscing elit dictumst platea turpis nulla, nascetur porta nunc curae ornare magnis malesuada libero commodo vel cras nullam, penatibus molestie consequat aptent felis vestibulum condimentum parturient interdu', 'renoca.ml/work/circulovip/uploads/15828946228382336455_2329480777156478_773686320550641664_o.jpg'),
(5, 4, 'Demo 222', 'Curabitur sem natoque non laoreet interdum nunc euismod turpis dictum condimentum taciti lectus blandit netus, facilisis molestie curae convallis mollis hendrerit ac fames pretium pellentesque consequat tincidunt. Mus erat sodales odio vestibulum mal', 'renoca.ml../../../uploads/158441083359covid19__.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url_image` varchar(255) DEFAULT NULL,
  `href` varchar(255) DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL,
  `time` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `sponsors`
--

INSERT INTO `sponsors` (`id`, `url_image`, `href`, `tipo`, `time`) VALUES
(1, 'https://renoca.ml/work/circulovip/images/banner1.jpg', 'https://circulovip.com', 1, 3),
(2, 'https://renoca.ml/work/circulovip/images/banner2.jpg', 'https://google.com.uy', 2, 3),
(3, 'https://renoca.ml/work/circulovip/uploads/158447002025Untitled-1.jpg', 'https://google.com.uy', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `id_referencia` varchar(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `fecha_vencimiento` date DEFAULT NULL,
  `zona_horaria` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `pass`, `hash`, `token`, `activo`, `id_referencia`, `fecha_registro`, `fecha_vencimiento`, `zona_horaria`) VALUES
(9, 'Victor', 'victor.quintanilla@gmail.com', '$2y$10$AXf2wjN/prutLX1ADDs4VuqavvsxG/SD.Q5.u0MztxOCyfWLoZU0.', '0ff39bbbf981ac0151d340c9aa40e63e', 'cfecdb276f634854f3ef915e2e980c31', '1', NULL, '2020-01-03 12:30:56', '2021-12-29', NULL),
(10, 'Diego Rodriguez', 'diego@email.com', '$2y$10$.J3IBMZuc7bvqlJXGq9unOXWMDxGSwgdl.E/7WfriJl50A5NhQbeC', '67c6a1e7ce56d3d6fa748ab6d9af3fd7', 'd2ed45a52bc0edfa11c2064e9edee8bf', '1', NULL, '2020-04-29 21:10:41', '2050-02-22', -3),
(12, 'Admin', 'webinar@circulovip.com', '$2y$10$N/HhW4YWMWXq/m4XhRsjwuWDMSUIpWAHuxJa7ZbeO4lLcwjOdR14u', 'c0e190d8267e36708f955d7ab048990d', 'c2aee86157b4a40b78132f1e71a9e6f1', '1', NULL, '2020-01-26 10:24:23', '2100-10-10', -3),
(13, 'Victor Videla', 'victor@circulovip.cl', '$2y$10$3fzCypJx9YzmQqPhJ7jtouiS2.XamFArZY90zDH0l/J/5lEvlaqgC', '10a7cdd970fe135cf4f7bb55c0e3b59f', '2421fcb1263b9530df88f7f002e78ea5', '2', NULL, '2020-04-02 11:50:32', '2022-02-28', NULL),
(14, 'Prueba', 'prueba@email.com', '$2y$10$jnpBJI3NUb16s.2i987gKOCQoH6PdhRlG9f13Uu4rEe.7M/d9BKNu', 'e00da03b685a0dd18fb6a08af0923de0', 'f718499c1c8cef6730f9fd03c8125cab', '1', NULL, '2020-04-30 06:51:45', '2030-12-02', 2),
(15, 'Victor Videla', 'circulovipempresarial@gmail.com', '$2y$10$dAggWovtaSwG2f8MAkk5TOl00t.nsStLchQFtEXX.lx01uxc0Kg4W', '99c5e07b4d5de9d18c350cdf64c5aa3d', 'd240e3d38a8882ecad8633c8f9c78c9b', '1', NULL, '2020-04-30 06:48:08', '2022-04-06', -3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
