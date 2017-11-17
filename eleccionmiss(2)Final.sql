-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2017 a las 07:10:41
-- Versión del servidor: 5.5.39
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eleccionmiss`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
`idcalificacion` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL DEFAULT '0',
  `idjurado` int(11) NOT NULL,
  `idparticipante` int(11) NOT NULL,
  `idpasarela` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=201 ;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`idcalificacion`, `calificacion`, `idjurado`, `idparticipante`, `idpasarela`) VALUES
(1, 5, 2, 1, 1),
(2, 10, 1, 1, 1),
(3, 5, 2, 2, 1),
(4, 3, 2, 2, 4),
(5, 14, 2, 9, 1),
(6, 4, 5, 1, 1),
(7, 14, 1, 4, 1),
(8, 4, 1, 4, 4),
(9, 15, 1, 4, 2),
(10, 10, 1, 2, 3),
(11, 3, 3, 1, 1),
(12, 8, 4, 1, 1),
(13, 8, 4, 2, 1),
(14, 7, 5, 5, 1),
(15, 30, 3, 5, 3),
(16, 8, 4, 3, 1),
(17, 8, 4, 4, 1),
(18, 8, 4, 6, 1),
(19, 9, 4, 5, 1),
(20, 10, 4, 7, 1),
(21, 10, 4, 9, 1),
(22, 9, 4, 10, 1),
(23, 5, 3, 1, 2),
(24, 21, 1, 1, 2),
(25, 10, 2, 1, 2),
(26, 3, 3, 2, 2),
(27, 7, 4, 1, 2),
(28, 26, 1, 2, 2),
(29, 3, 4, 2, 2),
(30, 10, 2, 2, 2),
(31, 20, 1, 2, 1),
(32, 3, 5, 2, 1),
(33, 15, 1, 3, 1),
(34, 4, 3, 3, 2),
(35, 3, 4, 3, 2),
(36, 2, 3, 3, 1),
(37, 3, 3, 2, 1),
(38, 8, 2, 3, 1),
(39, 15, 2, 3, 2),
(40, 18, 1, 3, 2),
(41, 3, 5, 3, 1),
(42, 3, 4, 4, 2),
(43, 6, 5, 4, 1),
(44, 8, 2, 4, 1),
(45, 3, 3, 4, 2),
(46, 15, 2, 4, 2),
(47, 6, 3, 4, 1),
(48, 16, 3, 5, 1),
(49, 10, 2, 5, 2),
(50, 8, 2, 5, 1),
(51, 9, 4, 5, 2),
(52, 12, 1, 5, 1),
(53, 8, 3, 5, 2),
(54, 12, 1, 5, 2),
(55, 8, 2, 6, 1),
(56, 10, 2, 6, 2),
(57, 14, 3, 6, 1),
(58, 10, 1, 6, 1),
(59, 11, 3, 6, 2),
(60, 12, 1, 6, 2),
(61, 6, 4, 6, 2),
(62, 8, 5, 6, 1),
(63, 15, 2, 7, 1),
(64, 26, 3, 7, 2),
(65, 20, 1, 7, 1),
(66, 30, 1, 7, 2),
(67, 23, 2, 7, 2),
(68, 13, 4, 7, 2),
(69, 14, 5, 7, 1),
(70, 20, 3, 7, 1),
(71, 7, 4, 8, 1),
(72, 3, 4, 8, 2),
(73, 5, 2, 8, 1),
(74, 5, 3, 8, 2),
(75, 5, 2, 8, 2),
(76, 4, 3, 8, 1),
(77, 18, 1, 8, 1),
(78, 6, 5, 8, 1),
(79, 18, 1, 8, 2),
(80, 19, 3, 9, 1),
(81, 10, 4, 9, 2),
(82, 27, 3, 9, 2),
(83, 10, 5, 9, 1),
(84, 20, 1, 9, 1),
(85, 20, 2, 9, 2),
(86, 26, 1, 9, 2),
(87, 18, 3, 10, 1),
(88, 12, 2, 10, 1),
(89, 18, 2, 10, 2),
(90, 20, 1, 10, 1),
(91, 15, 3, 10, 2),
(92, 28, 1, 10, 2),
(93, 9, 4, 10, 2),
(94, 9, 5, 10, 1),
(95, 8, 5, 10, 2),
(96, 8, 5, 1, 2),
(97, 7, 5, 2, 2),
(98, 8, 5, 3, 2),
(99, 11, 5, 4, 2),
(100, 11, 5, 5, 2),
(101, 10, 5, 6, 2),
(102, 20, 5, 7, 2),
(103, 7, 5, 8, 2),
(104, 10, 5, 9, 2),
(105, 10, 1, 1, 3),
(106, 15, 3, 1, 3),
(107, 20, 4, 1, 3),
(108, 15, 3, 2, 3),
(109, 20, 4, 2, 3),
(110, 11, 5, 2, 3),
(111, 9, 5, 1, 3),
(112, 12, 4, 3, 3),
(113, 12, 5, 3, 3),
(114, 7, 3, 3, 3),
(115, 15, 1, 3, 3),
(116, 20, 1, 4, 3),
(117, 20, 3, 4, 3),
(118, 20, 4, 4, 3),
(119, 20, 5, 4, 3),
(120, 20, 1, 5, 3),
(121, 29, 4, 5, 3),
(122, 20, 5, 5, 3),
(123, 33, 3, 6, 3),
(124, 22, 4, 6, 3),
(125, 25, 5, 6, 3),
(126, 15, 1, 6, 3),
(127, 40, 3, 7, 3),
(128, 26, 1, 7, 3),
(129, 36, 4, 7, 3),
(130, 25, 5, 7, 3),
(131, 30, 1, 8, 3),
(132, 25, 3, 8, 3),
(133, 22, 4, 8, 3),
(134, 10, 5, 8, 3),
(135, 16, 2, 1, 3),
(136, 16, 2, 2, 3),
(137, 16, 2, 3, 3),
(138, 40, 3, 9, 3),
(139, 34, 4, 9, 3),
(140, 30, 5, 9, 3),
(141, 36, 1, 9, 3),
(142, 34, 1, 10, 3),
(143, 20, 2, 4, 3),
(144, 25, 2, 5, 3),
(145, 24, 2, 6, 3),
(146, 35, 3, 10, 3),
(147, 35, 2, 7, 3),
(148, 20, 2, 8, 3),
(149, 40, 2, 9, 3),
(150, 32, 2, 10, 3),
(151, 32, 4, 10, 3),
(152, 30, 5, 10, 3),
(153, 7, 1, 1, 4),
(154, 5, 4, 1, 4),
(155, 1, 3, 1, 4),
(156, 3, 5, 1, 4),
(157, 7, 1, 2, 4),
(158, 3, 2, 1, 4),
(159, 3, 2, 3, 4),
(160, 3, 3, 2, 4),
(161, 4, 2, 4, 4),
(162, 5, 4, 2, 4),
(163, 3, 2, 5, 4),
(164, 4, 1, 3, 4),
(165, 4, 5, 2, 4),
(166, 4, 4, 3, 4),
(167, 2, 5, 3, 4),
(168, 1, 3, 3, 4),
(169, 7, 5, 4, 4),
(170, 6, 3, 4, 4),
(171, 6, 4, 4, 4),
(172, 5, 1, 5, 4),
(173, 5, 4, 5, 4),
(174, 4, 3, 5, 4),
(175, 5, 5, 5, 4),
(176, 6, 1, 6, 4),
(177, 2, 3, 6, 4),
(178, 5, 4, 6, 4),
(179, 4, 5, 6, 4),
(180, 4, 2, 6, 4),
(181, 10, 3, 7, 4),
(182, 10, 4, 7, 4),
(183, 10, 1, 7, 4),
(184, 9, 2, 7, 4),
(185, 10, 5, 7, 4),
(186, 3, 1, 8, 4),
(187, 3, 5, 8, 4),
(188, 5, 4, 8, 4),
(189, 2, 3, 8, 4),
(190, 3, 2, 8, 4),
(191, 9, 1, 9, 4),
(192, 8, 3, 9, 4),
(193, 8, 2, 9, 4),
(194, 9, 5, 9, 4),
(195, 8, 4, 9, 4),
(196, 8, 1, 10, 4),
(197, 6, 3, 10, 4),
(198, 8, 5, 10, 4),
(199, 6, 4, 10, 4),
(200, 7, 2, 10, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE IF NOT EXISTS `foto` (
`idfoto` int(11) NOT NULL,
  `nombre_archivo` varchar(45) NOT NULL,
  `extension` varchar(4) NOT NULL DEFAULT '.jpg',
  `idparticipante` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `foto`
--

INSERT INTO `foto` (`idfoto`, `nombre_archivo`, `extension`, `idparticipante`) VALUES
(1, '1', '.jpg', 1),
(2, '2', '.jpg', 1),
(3, '3', '.jpg', 1),
(4, '1', '.jpg', 2),
(5, '2', '.jpg', 2),
(6, '3', '.jpg', 2),
(7, '1', '.jpg', 3),
(8, '2', '.jpg', 3),
(9, '3', '.jpg', 3),
(10, '1', '.jpg', 4),
(11, '2', '.jpg', 4),
(12, '3', '.jpg', 4),
(13, '1', '.jpg', 5),
(14, '2', '.jpg', 5),
(15, '3', '.jpg', 5),
(16, '1', '.jpg', 6),
(17, '2', '.jpg', 6),
(18, '3', '.jpg', 6),
(19, '1', '.jpg', 7),
(20, '2', '.jpg', 7),
(21, '3', '.jpg', 7),
(22, '1', '.jpg', 8),
(23, '2', '.jpg', 8),
(24, '3', '.jpg', 8),
(25, '1', '.jpg', 9),
(26, '2', '.jpg', 9),
(28, '3', '.jpg', 9),
(29, '1', '.jpg', 10),
(30, '3', '.jpg', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jurado`
--

CREATE TABLE IF NOT EXISTS `jurado` (
`idjurado` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT 'jurado',
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `jurado`
--

INSERT INTO `jurado` (`idjurado`, `nombre`, `estado`) VALUES
(1, 'jurado1', 1),
(2, 'jurado2', 1),
(3, 'jurado3', 1),
(4, 'jurado4', 1),
(5, 'jurado5', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE IF NOT EXISTS `participante` (
`idparticipante` int(11) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `hobies` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `participante`
--

INSERT INTO `participante` (`idparticipante`, `apellidos`, `nombres`, `hobies`) VALUES
(1, 'COLUMBA MEZA', 'MARIA JESUS', NULL),
(2, 'MARMANILO GUZMAN', 'LITZI YHERALDY', NULL),
(3, 'GOMEZ RAMOS', 'ZINNDELL LAURA', NULL),
(4, 'VIDAURRE LEON', 'LUISA MARIA', NULL),
(5, 'CHOQUE VARGAS', 'ANDREA NICOLE', NULL),
(6, 'OCHOA GUTIERREZ', 'PRISCILA BRENDA', NULL),
(7, 'CABRERA CHOQUE', 'RAPHAELA IVANA', NULL),
(8, 'LIZONDA CHOQUE', 'NOEMI', NULL),
(9, 'ZEBALLOS ORELLANA', 'ALEXY REBECA', NULL),
(10, 'CAMACHO BELTRAN', 'MARIANA ISABEL', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasarela`
--

CREATE TABLE IF NOT EXISTS `pasarela` (
`idpasarela` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ponderacion` decimal(5,2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `pasarela`
--

INSERT INTO `pasarela` (`idpasarela`, `nombre`, `ponderacion`) VALUES
(1, 'Traje de Presentacion', '20.00'),
(2, 'Traje de Baño', '30.00'),
(3, 'Traje de Gala', '40.00'),
(4, 'Preguntas', '10.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
 ADD PRIMARY KEY (`idcalificacion`), ADD KEY `fk_calificacion_jurado_idx` (`idjurado`), ADD KEY `fk_calificacion_participante1_idx` (`idparticipante`), ADD KEY `fk_calificacion_pasarela1_idx` (`idpasarela`);

--
-- Indices de la tabla `foto`
--
ALTER TABLE `foto`
 ADD PRIMARY KEY (`idfoto`), ADD KEY `fk_foto_participante1_idx` (`idparticipante`);

--
-- Indices de la tabla `jurado`
--
ALTER TABLE `jurado`
 ADD PRIMARY KEY (`idjurado`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
 ADD PRIMARY KEY (`idparticipante`);

--
-- Indices de la tabla `pasarela`
--
ALTER TABLE `pasarela`
 ADD PRIMARY KEY (`idpasarela`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
MODIFY `idcalificacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
MODIFY `idfoto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `jurado`
--
ALTER TABLE `jurado`
MODIFY `idjurado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `participante`
--
ALTER TABLE `participante`
MODIFY `idparticipante` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `pasarela`
--
ALTER TABLE `pasarela`
MODIFY `idpasarela` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
ADD CONSTRAINT `fk_calificacion_jurado` FOREIGN KEY (`idjurado`) REFERENCES `jurado` (`idjurado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_calificacion_participante1` FOREIGN KEY (`idparticipante`) REFERENCES `participante` (`idparticipante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_calificacion_pasarela1` FOREIGN KEY (`idpasarela`) REFERENCES `pasarela` (`idpasarela`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `foto`
--
ALTER TABLE `foto`
ADD CONSTRAINT `fk_foto_participante1` FOREIGN KEY (`idparticipante`) REFERENCES `participante` (`idparticipante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
