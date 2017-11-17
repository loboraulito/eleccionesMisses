-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2017 a las 23:23:09
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`idcalificacion`, `calificacion`, `idjurado`, `idparticipante`, `idpasarela`) VALUES
(35, 13, 2, 2, 3),
(36, 8, 2, 2, 1),
(37, 14, 2, 2, 2),
(38, 6, 2, 2, 4),
(39, 10, 3, 1, 1),
(40, 20, 3, 1, 2),
(41, 10, 3, 1, 3),
(42, 18, 2, 1, 1),
(43, 18, 2, 1, 2),
(44, 4, 3, 1, 4),
(45, 21, 2, 1, 3),
(46, 6, 2, 1, 4),
(47, 15, 1, 1, 1),
(48, 17, 3, 2, 1),
(49, 8, 1, 1, 2),
(50, 8, 1, 1, 3),
(51, 5, 1, 1, 4),
(52, 10, 1, 2, 1),
(53, 23, 3, 2, 2),
(54, 15, 1, 2, 2),
(55, 5, 1, 2, 4),
(56, 20, 1, 2, 3),
(57, 40, 3, 2, 3),
(58, 6, 3, 2, 4),
(59, 13, 4, 1, 1),
(60, 19, 4, 1, 2),
(61, 19, 4, 1, 3),
(62, 5, 4, 1, 4),
(63, 10, 4, 2, 1),
(64, 22, 4, 2, 3),
(65, 12, 4, 2, 2),
(66, 4, 4, 2, 4),
(73, 10, 5, 1, 1),
(74, 12, 5, 1, 2),
(75, 13, 5, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE IF NOT EXISTS `foto` (
`idfoto` int(11) NOT NULL,
  `nombre_archivo` varchar(45) NOT NULL,
  `extension` varchar(4) NOT NULL DEFAULT '.jpg',
  `idparticipante` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `foto`
--

INSERT INTO `foto` (`idfoto`, `nombre_archivo`, `extension`, `idparticipante`) VALUES
(1, '1', '.jpg', 1),
(2, '2', '.jpg', 1),
(3, '3', '.jpg', 1),
(4, '1', '.jpg', 2),
(5, '2', '.jpg', 2),
(6, '3', '.jpg', 2);

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
MODIFY `idcalificacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
MODIFY `idfoto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
