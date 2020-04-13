-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-06-2016 a las 02:23:04
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_sys_cursos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cursos`
--

CREATE TABLE IF NOT EXISTS `tb_cursos` (
  `crs_id` int(11) NOT NULL AUTO_INCREMENT,
  `crs_nombre` varchar(50) NOT NULL,
  `crs_tipo` int(11) NOT NULL,
  `crs_jornada` varchar(50) DEFAULT NULL,
  `crs_ini` date DEFAULT NULL,
  `crs_fin` date DEFAULT NULL,
  `crs_patrocinador` int(11) DEFAULT NULL,
  `crs_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`crs_id`),
  KEY `tb_cursos_ibfk_1` (`crs_patrocinador`),
  KEY `tb_cursos_ibfk_2` (`crs_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tb_cursos`
--

INSERT INTO `tb_cursos` (`crs_id`, `crs_nombre`, `crs_tipo`, `crs_jornada`, `crs_ini`, `crs_fin`, `crs_patrocinador`, `crs_status`) VALUES
(1, 'Capacitacion PLSQL', 1, '8:00 am - 10:00 am', '2016-06-01', '2016-06-15', 1, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_departamentos`
--

CREATE TABLE IF NOT EXISTS `tb_departamentos` (
  `dpt_id` int(11) NOT NULL AUTO_INCREMENT,
  `dpt_nombre` varchar(50) NOT NULL,
  `dpt_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`dpt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tb_departamentos`
--

INSERT INTO `tb_departamentos` (`dpt_id`, `dpt_nombre`, `dpt_desc`) VALUES
(1, 'InformÃ¡tica', 'Departamento de Tecnologias de la Informacion'),
(2, 'Finanzas', 'departamento de Finanzas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empleados`
--

CREATE TABLE IF NOT EXISTS `tb_empleados` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_nombre` varchar(50) NOT NULL,
  `emp_apellido` varchar(50) NOT NULL,
  `emp_fecha_nac` date NOT NULL,
  `emp_genero` varchar(20) DEFAULT NULL,
  `emp_depto` int(11) DEFAULT NULL,
  `emp_cargo` varchar(50) DEFAULT NULL,
  `emp_nivel_acad` varchar(50) DEFAULT NULL,
  `emp_ubicacion` varchar(50) DEFAULT NULL,
  `emp_fecha_ing` date NOT NULL,
  PRIMARY KEY (`emp_id`),
  KEY `tb_empleados_ibfk_1` (`emp_depto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tb_empleados`
--

INSERT INTO `tb_empleados` (`emp_id`, `emp_nombre`, `emp_apellido`, `emp_fecha_nac`, `emp_genero`, `emp_depto`, `emp_cargo`, `emp_nivel_acad`, `emp_ubicacion`, `emp_fecha_ing`) VALUES
(1, 'Marvin', 'Galdamez', '1994-05-06', 'M', 1, 'Programador Analista', 'Ingeniero', 'Santa Elena', '2014-03-24'),
(2, 'Samuel', 'Aviles', '1985-06-13', 'M', 1, 'Programador Analista', 'Ing', 'Santa Tecla', '2016-01-01'),
(3, 'Juan', 'Perez', '2016-05-05', 'M', 1, 'Veterinario', 'Licenciado', 'San Salvador', '2016-06-06'),
(6, 'Manuel', 'Galdamez', '1997-03-18', 'M', 2, 'Analista Financiero', 'Licenciado', 'San Salvador', '2016-06-05'),
(7, 'TST', 'tst', '2016-06-01', 'F', 2, 'Analista Financiero', 'Ing', 'San Salvador', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_opcion`
--

CREATE TABLE IF NOT EXISTS `tb_opcion` (
  `OPC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OPC_LABEL` varchar(200) NOT NULL,
  `OPC_ACTION` varchar(300) DEFAULT NULL,
  `OPC_ID_PADRE` int(11) NOT NULL,
  `OPC_ORDEN` int(11) NOT NULL,
  `OPC_ESTADO` char(1) NOT NULL,
  PRIMARY KEY (`OPC_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tb_opcion`
--

INSERT INTO `tb_opcion` (`OPC_ID`, `OPC_LABEL`, `OPC_ACTION`, `OPC_ID_PADRE`, `OPC_ORDEN`, `OPC_ESTADO`) VALUES
(1, 'Cursos', NULL, 1000, 0, 'A'),
(2, 'Departamentos', 'deptos.php', 1000, 1, 'A'),
(3, 'Empleados', 'empleados.php', 1000, 2, 'A'),
(4, 'Fuente de Financiamiento', 'patrocinadores.php', 1000, 3, 'A'),
(5, 'Tipo de Evento', 'tevento.php', 1000, 4, 'A'),
(6, 'Cursos', 'cursos.php', 1000, 5, 'A'),
(7, 'Detalle de Curso', 'dcursos.php', 1000, 6, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_opcion_x_rol`
--

CREATE TABLE IF NOT EXISTS `tb_opcion_x_rol` (
  `ROL_ID` int(11) NOT NULL,
  `OPC_ID` int(11) NOT NULL,
  PRIMARY KEY (`ROL_ID`,`OPC_ID`),
  KEY `ROL_ID` (`ROL_ID`),
  KEY `OPC_ID` (`OPC_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_opcion_x_rol`
--

INSERT INTO `tb_opcion_x_rol` (`ROL_ID`, `OPC_ID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_part_curso`
--

CREATE TABLE IF NOT EXISTS `tb_part_curso` (
  `CURSO_ID` int(11) NOT NULL,
  `EMPLEADO_ID` int(11) NOT NULL,
  `COMENTARIO` varchar(300) DEFAULT NULL,
  `FIN_CHECK` char(1) DEFAULT NULL,
  KEY `tb_part_curso_ibfk_1` (`CURSO_ID`),
  KEY `tb_part_curso_ibfk_2` (`EMPLEADO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_part_curso`
--

INSERT INTO `tb_part_curso` (`CURSO_ID`, `EMPLEADO_ID`, `COMENTARIO`, `FIN_CHECK`) VALUES
(1, 1, NULL, NULL),
(1, 2, NULL, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_patrocinadores`
--

CREATE TABLE IF NOT EXISTS `tb_patrocinadores` (
  `PAT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PAT_NOMBRE` varchar(50) NOT NULL,
  `PAT_DESC` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tb_patrocinadores`
--

INSERT INTO `tb_patrocinadores` (`PAT_ID`, `PAT_NOMBRE`, `PAT_DESC`) VALUES
(1, 'Fepade', 'FundaciÃ³n Empresarial Para El Desarrollo'),
(2, 'Patrocinador1', 'test1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_rol`
--

CREATE TABLE IF NOT EXISTS `tb_rol` (
  `ROL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ROL_NOMBRE` varchar(200) NOT NULL,
  `ROL_DESCRIPCION` varchar(400) NOT NULL,
  `ROL_ESTADO` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ROL_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tb_rol`
--

INSERT INTO `tb_rol` (`ROL_ID`, `ROL_NOMBRE`, `ROL_DESCRIPCION`, `ROL_ESTADO`) VALUES
(1, 'Administrador', 'Administrador', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_curso`
--

CREATE TABLE IF NOT EXISTS `tb_tipo_curso` (
  `TPC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TPC_NOMBRE` varchar(50) NOT NULL,
  `TPC_DESC` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`TPC_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tb_tipo_curso`
--

INSERT INTO `tb_tipo_curso` (`TPC_ID`, `TPC_NOMBRE`, `TPC_DESC`) VALUES
(1, 'CapacitaciÃ³n', 'CapacitaciÃ³n'),
(2, 'Diplomado', 'diplomado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `USR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USR_IDENTIFICACION` varchar(50) NOT NULL,
  `USR_NOMBRE` varchar(200) NOT NULL,
  `USR_APELLIDO` varchar(200) NOT NULL,
  `USR_CORREO` varchar(100) NOT NULL,
  `USR_TEL` varchar(15) NOT NULL,
  `USR_TEL2` varchar(15) DEFAULT NULL,
  `USR_USER` varchar(50) NOT NULL,
  `USR_PASSWORD` blob NOT NULL,
  `USR_ESTADO` char(1) NOT NULL DEFAULT 'A',
  `USR_CREAT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USR_ROL` int(11) NOT NULL,
  PRIMARY KEY (`USR_ID`),
  UNIQUE KEY `USR_USER` (`USR_USER`),
  KEY `USR_ROL` (`USR_ROL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`USR_ID`, `USR_IDENTIFICACION`, `USR_NOMBRE`, `USR_APELLIDO`, `USR_CORREO`, `USR_TEL`, `USR_TEL2`, `USR_USER`, `USR_PASSWORD`, `USR_ESTADO`, `USR_CREAT`, `USR_ROL`) VALUES
(1, '05035742-3', 'Marvin', 'Galdamez', 'marvin31_@hotmail.com', '77471556', '23319862', 'mgaldamez', 0x456dc6382b0fa38b0d90f9ec227cf723, 'A', '2015-06-03 22:05:32', 1),
(2, '0123456789', 'Samuel', 'Aviles', 'samuelavils@gmail.com', '6318963851', '6318963851', 'saviles', 0x456dc6382b0fa38b0d90f9ec227cf723, 'A', '2015-08-20 00:44:55', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_cursos`
--
ALTER TABLE `tb_cursos`
  ADD CONSTRAINT `tb_cursos_ibfk_1` FOREIGN KEY (`crs_patrocinador`) REFERENCES `tb_patrocinadores` (`PAT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_cursos_ibfk_2` FOREIGN KEY (`crs_tipo`) REFERENCES `tb_tipo_curso` (`TPC_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_empleados`
--
ALTER TABLE `tb_empleados`
  ADD CONSTRAINT `tb_empleados_ibfk_1` FOREIGN KEY (`emp_depto`) REFERENCES `tb_departamentos` (`dpt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_opcion_x_rol`
--
ALTER TABLE `tb_opcion_x_rol`
  ADD CONSTRAINT `tb_opcion_x_rol_ibfk_1` FOREIGN KEY (`ROL_ID`) REFERENCES `tb_rol` (`ROL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_opcion_x_rol_ibfk_2` FOREIGN KEY (`OPC_ID`) REFERENCES `tb_opcion` (`OPC_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_part_curso`
--
ALTER TABLE `tb_part_curso`
  ADD CONSTRAINT `tb_part_curso_ibfk_1` FOREIGN KEY (`CURSO_ID`) REFERENCES `tb_cursos` (`crs_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_part_curso_ibfk_2` FOREIGN KEY (`EMPLEADO_ID`) REFERENCES `tb_empleados` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`USR_ROL`) REFERENCES `tb_rol` (`ROL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
