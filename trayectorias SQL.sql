-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2022 a las 23:34:12
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trayectorias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `usuario` varchar(15) NOT NULL,
  `contrasena` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `carrera` varchar(15) NOT NULL,
  `docente` int(15) NOT NULL,
  `rol` varchar(10) NOT NULL,
  `dAcademica` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`usuario`, `contrasena`, `nombre`, `apellidos`, `correo`, `carrera`, `docente`, `rol`, `dAcademica`) VALUES
('162H8029', '1136031989', 'JESUS RAYMUNDO', 'HERNANDEZ ZAPATA', '162H8029@alumno.ujat.mx', 'LTI', 123456, 'alumno', 'CYTI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `clave` varchar(10) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `horasT` int(10) NOT NULL,
  `horasP` int(10) NOT NULL,
  `creditos` int(10) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `optativa` int(11) NOT NULL,
  `areaFormacion` int(10) NOT NULL,
  `areaConocimiento` int(11) NOT NULL,
  `antecedente` varchar(10) NOT NULL,
  `urlPDF` varchar(100) NOT NULL,
  `carrera` varchar(15) NOT NULL,
  `ciclo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`clave`, `nombre`, `horasT`, `horasP`, `creditos`, `tipo`, `optativa`, `areaFormacion`, `areaConocimiento`, `antecedente`, `urlPDF`, `carrera`, `ciclo`) VALUES
('F1001', 'Ética', 2, 1, 5, 'obligatoria', 0, 1, 7, '', '../Archivos/Ética.pdf', 'LTI', 1),
('F1002', 'Filosofía', 2, 1, 5, 'obligatoria', 0, 1, 7, '', '../Archivos/Filosofía.pdf', 'LTI', 1),
('F1003', 'Metodología', 2, 1, 5, 'obligatoria', 0, 1, 7, '', '../Archivos/Metodología.pdf', 'LTI', 1),
('F1004', 'Cultura Ambiental', 2, 1, 5, 'obligatoria', 0, 1, 7, '', '../Archivos/Cultura Ambiental.pdf', 'LTI', 1),
('F1005', 'Lengua Extranjera ', 1, 2, 4, 'obligatoria', 0, 1, 7, '', '../Archivos/Lengua Extranjera .pdf', 'LTI', 1),
('F1006', 'Lectura y Redacción', 1, 3, 5, 'obligatoria', 0, 1, 7, '', '../Archivos/Lectura y Redacción.pdf', 'LTI', 1),
('F1007', 'Derechos Humanos', 2, 1, 5, 'obligatoria', 0, 1, 7, '', '../Archivos/Derechos Humanos.pdf', 'LTI', 1),
('F1008', 'Pensamiento Matemático', 1, 4, 6, 'obligatoria', 0, 1, 8, '', '../Archivos/Pensamiento Matemático.pdf', 'LTI', 1),
('F1009', 'Herramientas de Computación', 0, 4, 4, 'obligatoria', 0, 1, 6, '', '../Archivos/Herramientas de Computación.pdf', 'LTI', 1),
('F1011', 'Programación Orientada a Objetos', 3, 1, 7, 'obligatoria', 0, 2, 1, 'F1201', '../Archivos/Programación Orientada a Objetos.pdf', 'LTI', 1),
('F1018', 'Modelado, Diseño y Manejo de Base de Datos', 3, 2, 8, 'obligatoria', 0, 2, 3, '', '../Archivos/Modelado, Diseño y Manejo de Base de Datos.pdf', 'LTI', 0),
('F1019', 'Protocolo de Proyecto', 2, 3, 7, 'obligatoria', 0, 3, 3, 'F1003', '../Archivos/Protocolo de Proyecto.pdf', 'LTI', 0),
('F1020', 'Desarrollo de Proyecto', 2, 2, 6, 'obligatoria', 0, 4, 3, 'F1019', '../Archivos/Desarrollo de Proyecto.pdf', 'LTI', 0),
('F1021', 'Fundamento de Redes', 3, 2, 8, 'obligatoria', 0, 2, 4, '', '../Archivos/Fundamento de Redes.pdf', 'LTI', 1),
('F1022', 'Planeación de Redes', 2, 3, 7, 'obligatoria', 0, 2, 4, 'F1021', '../Archivos/Planeación de Redes.pdf', 'LTI', 1),
('F1023', 'Interacción Hombre-Máquina', 3, 2, 8, 'obligatoria', 0, 2, 2, '', '../Archivos/Interacción Hombre-Máquina.pdf', 'LTI', 1),
('F1098', 'Servicio Social', 0, 10, 10, 'especial', 0, 4, 7, '', '', 'LTI', 0),
('F1099', 'Prácticas Profesionales', 0, 8, 8, 'especial', 0, 4, 7, '', '', 'LTI', 0),
('F1103', 'Estructura de Datos', 2, 3, 7, 'obligatoria', 0, 2, 1, '', '../Archivos/Estructura de Datos.pdf', 'LTI', 1),
('F1111', 'Matemáticas Básicas', 2, 3, 7, 'obligatoria', 0, 1, 8, 'F1008', '../Archivos/Matemáticas Básicas.pdf', 'LTI', 1),
('F1131', 'Fundamentos de Sistemas Operativos', 3, 2, 8, 'obligatoria', 0, 2, 6, '', '../Archivos/Fundamentos de Sistemas Operativos.pdf', 'LTI', 1),
('F1143', 'Contabilidad', 2, 2, 6, 'obligatoria', 0, 1, 7, '', '../Archivos/Contabilidad.pdf', 'LTI', 1),
('F1201', 'Algoritmos y Programación', 2, 4, 8, 'obligatoria', 0, 1, 1, '', '../Archivos/Algoritmos y Programación.pdf', 'LTI', 0),
('F1381', 'Comprensión de Textos en Inglés para las TICs', 2, 2, 6, 'obligatoria', 0, 2, 7, 'F1005', '../Archivos/Compresión de Textos en Inglés para las TICs.pdf', 'LTI', 1),
('F1401', 'Programación en Dispositivo Móviles', 2, 4, 8, 'obligatoria', 0, 2, 1, 'F1011', '../Archivos/Programación en Dispositivo Móviles.pdf', 'LTI', 0),
('F1402', 'Tecnologías y Sistemas Web', 2, 4, 8, 'obligatoria', 0, 2, 1, '', '../Archivos/Tecnologías y Sistemas Web.pdf', 'LTI', 0),
('F1403', 'Industria de Software', 2, 4, 8, 'obligatoria', 0, 3, 1, '', '../Archivos/Industria de Software.pdf', 'LTI', 1),
('F1404', 'Estándares y Métricas de Software', 2, 2, 6, 'optativa', 5, 4, 1, '', '../Archivos/Estándares y Métricas de Software.pdf', 'LTI', 1),
('F1405', 'Tecnología de Componentes', 2, 2, 6, 'optativa', 5, 4, 1, '', '../Archivos/Tecnología de Componentes.pdf', 'LTI', 1),
('F1406', 'WebService', 2, 2, 6, 'optativa', 5, 4, 1, '', '../Archivos/WebService.pdf', 'LTI', 1),
('F1407', 'Servicio Web Móvil', 2, 2, 6, 'optativa', 5, 4, 1, '', '../Archivos/Servicio Web Móvil.pdf', 'LTI', 1),
('F1412', 'Desarrollo de Interfaces', 1, 3, 5, 'obligatoria', 0, 2, 2, '', '../Archivos/Desarrollo de Interfaces.pdf', 'LTI', 0),
('F1413', 'Sistemas Inteligentes para TI', 1, 3, 5, 'obligatoria', 0, 2, 2, '', '../Archivos/Sistemas Inteligentes para TI.pdf', 'LTI', 0),
('F1421', 'Sistemas de Información', 2, 2, 6, 'obligatoria', 0, 2, 3, '', '../Archivos/Sistemas de Información.pdf', 'LTI', 1),
('F1422', 'Administración y Programación de Base de Datos', 2, 4, 8, 'obligatoria', 0, 2, 3, 'F1018', '../Archivos/Administración y Programación de Base de Datos.pdf', 'LTI', 0),
('F1423', 'Temas Selectos de Base de Datos', 2, 3, 7, 'obligatoria', 0, 2, 3, '', '../Archivos/Temas Selectos de Base de Datos.pdf', 'LTI', 1),
('F1424', 'Manejo de Grandes Volúmenes de Información', 2, 2, 6, 'obligatoria', 0, 2, 3, '', '../Archivos/Manejo de Grandes Volúmenes de Información.pdf', 'LTI', 0),
('F1425', 'Minería de Datos', 2, 3, 7, 'obligatoria', 0, 2, 3, '', '../Archivos/Minería de Datos.pdf', 'LTI', 0),
('F1426', 'Administración de Sistemas Intranet y Extranet', 2, 2, 6, 'obligatoria', 0, 2, 3, '', '../Archivos/Administración de Sistemas Intranet y Extranet.pdf', 'LTI', 0),
('F1433', 'Administración y Seguridad en Redes', 2, 3, 7, 'obligatoria', 0, 2, 4, 'F1022', '../Archivos/Administración y Seguridad en Redes.pdf', 'LTI', 1),
('F1434', 'Redes Inalambricas', 2, 2, 6, 'optativa', 3, 3, 4, '', '../Archivos/Redes Inalambricas.pdf', 'LTI', 1),
('F1435', 'Wifi', 2, 2, 6, 'optativa', 3, 3, 4, '', '../Archivos/Wifi.pdf', 'LTI', 1),
('F1436', 'Domotica', 2, 2, 6, 'optativa', 3, 3, 5, '', '../Archivos/Domotica.pdf', 'LTI', 1),
('F1441', 'Infraestructura Computacional', 2, 3, 7, 'obligatoria', 0, 1, 5, '', '../Archivos/Infraestructura Computacional.pdf', 'LTI', 1),
('F1442', 'Plataformas Tecnológicas', 2, 4, 8, 'obligatoria', 0, 2, 5, '', '../Archivos/Plataformas Tecnológicas.pdf', 'LTI', 1),
('F1453', 'Planeación y Administración de Sistemas Operativos de Red', 1, 3, 5, 'obligatoria', 0, 2, 6, 'F1131', '../Archivos/Planeación y Administración de Sistemas Operativos de Red.pdf', 'LTI', 0),
('F1454', 'Administración de Sistemas', 1, 3, 5, 'obligatoria', 0, 2, 6, '', '../Archivos/Administración de Sistemas.pdf', 'LTI', 1),
('F1456', 'Computación en la Nube', 2, 2, 6, 'optativa', 4, 3, 6, '', '../Archivos/Computación en la Nube.pdf', 'LTI', 1),
('F1457', 'Sistemas Operativos Embebidos ', 2, 2, 6, 'optativa', 4, 3, 6, '', '../Archivos/Sistemas Operativos Embebidos .pdf', 'LTI', 1),
('F1461', 'Economía Digital', 2, 2, 6, 'obligatoria', 0, 2, 7, '', '../Archivos/Economía Digital.pdf', 'LTI', 1),
('F1462', 'Finanzas', 1, 3, 5, 'obligatoria', 0, 2, 7, 'F1143', '../Archivos/Finanzas.pdf', 'LTI', 1),
('F1463', 'Administración de Proyectos de TI', 2, 2, 6, 'obligatoria', 0, 2, 7, 'F1462', '../Archivos/Administración de Proyectos de TI.pdf', 'LTI', 0),
('F1464', 'Normatividad en TI', 2, 1, 5, 'obligatoria', 0, 2, 7, '', '../Archivos/Normatividad en TI.pdf', 'LTI', 1),
('F1465', 'eCommerce', 2, 3, 7, 'obligatoria', 0, 2, 7, 'F1461', '../Archivos/eCommerce.pdf', 'LTI', 0),
('F1467', 'Auditoria Informatica', 2, 2, 6, 'optativa', 1, 3, 7, '', '../Archivos/Auditoria Informatica.pdf', 'LTI', 1),
('F1468', 'Técnicas de Planeación', 2, 2, 6, 'optativa', 1, 3, 7, '', '../Archivos/Técnicas de Planeación.pdf', 'LTI', 1),
('F1469', 'Administración de Servicios de Tecnologías de la Información', 2, 2, 6, 'optativa', 1, 3, 7, '', '../Archivos/Administración de Servicios de Tecnologías de la Información.pdf', 'LTI', 1),
('F1470', 'Administración Estratégica ', 2, 2, 6, 'optativa', 1, 3, 7, '', '../Archivos/Administración Estratégica .pdf', 'LTI', 1),
('F1471', 'Matemáticas Discretas', 2, 4, 8, 'obligatoria', 0, 2, 8, 'F1111', '../Archivos/Matemáticas Discretas.pdf', 'LTI', 1),
('F1472', 'Estadística para TI', 2, 3, 7, 'obligatoria', 0, 2, 8, '', '../Archivos/Estadística para TI.pdf', 'LTI', 1),
('F1474', 'Simulación', 2, 2, 6, 'optativa', 2, 3, 8, '', '../Archivos/Simulación.pdf', 'LTI', 1),
('F1475', 'Teoría de Grafos', 2, 2, 6, 'optativa', 2, 3, 8, '', '../Archivos/Teoría de Grafos.pdf', 'LTI', 1),
('F1476', 'Análisis y Diseño de Algoritmos', 2, 2, 6, 'optativa', 2, 3, 8, '', '../Archivos/Análisis y Diseño de Algoritmos.pdf', 'LTI', 1),
('F1477', 'Métodos de Optimización', 2, 2, 6, 'optativa', 2, 3, 8, '', '../Archivos/Métodos de Optimización.pdf', 'LTI', 1),
('F1478', 'Matemáticas Avanzadas para Negocios ', 2, 2, 6, 'optativa', 2, 3, 8, '', '../Archivos/Matemáticas Avanzadas para Negocios .pdf', 'LTI', 1),
('F1490', 'Formación de Emprendedores', 2, 2, 6, 'obligatoria', 0, 2, 7, '', '../Archivos/Formación de Emprendedores.pdf', 'LTI', 0),
('F1491', 'Optativa del Área de Entorno Social', 2, 2, 6, 'especial', 0, 3, 7, '', '', 'LTI', 1),
('F1492', 'Optativa del Área de Matemáticas', 2, 2, 6, 'especial', 0, 3, 8, '', '', 'LTI', 1),
('F1493', 'Optativa del Área de Redes', 2, 2, 6, 'especial', 0, 3, 4, '', '', 'LTI', 1),
('F1494', 'Optativa del Área de Software Base', 2, 2, 6, 'especial', 0, 3, 6, '', '', 'LTI', 1),
('F1495', 'Optativa 1 Área de Programación e Ingeniería de Software', 2, 2, 6, 'especial', 0, 3, 1, '', '', 'LTI', 1),
('F1496', 'Optativa 2 Área de Programación e Ingeniería de Software', 2, 2, 6, 'especial', 0, 4, 1, '', '', 'LTI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `creditos` int(10) NOT NULL,
  `dAcademica` varchar(15) NOT NULL,
  `areaConocimiento` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`, `creditos`, `dAcademica`, `areaConocimiento`) VALUES
('LTI', 'Licenciatura en Tecnologías de la Información', 347, 'CYTI', '{\"data\":[{\"id\":\"1\",\"nombre\":\"Programación e Ingeniería de Software\"},{\"id\":\"2\",\"nombre\":\"Interacción Hombre - Máquina\"},{\"id\":\"3\",\"nombre\":\"Tratamiento de Información\"},{\"id\":\"4\",\"nombre\":\"Redes\"},{\"id\":\"5\",\"nombre\":\"Arquitectura de Computadoras\"},{\"id\":\"6\",\"nombre\":\"Software de Base\"},{\"id\":\"7\",\"nombre\":\"Entorno Social\"},{\"id\":\"8\",\"nombre\":\"Matemáticas\"}]}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisiones`
--

CREATE TABLE `divisiones` (
  `id` varchar(15) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `divisiones`
--

INSERT INTO `divisiones` (`id`, `nombre`) VALUES
('CA', 'de Ciencias Agropecuarias'),
('CB', 'de Ciencias Básicas'),
('CBIOL', 'de Ciencias Biológicas'),
('CEA', 'de Ciencias Económico Administrativas'),
('CS', 'de Ciencias de la Salud'),
('CSYH', 'de Ciencias Sociales y Humanidades'),
('CYTI', 'de Ciencias y Tecnologías de la Información'),
('EA', 'de Educación y Artes'),
('IA', 'de Ingeniería y Arquitectura'),
('MC', 'Multidisciplinaria de Comalcalco'),
('MJM', 'Multidisssciplanaria de Jalpa de Méndez'),
('MR', 'Multidisciplinaria de los Ríos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `usuario` int(15) NOT NULL,
  `contrasena` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `dAcademica` varchar(15) NOT NULL,
  `rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`usuario`, `contrasena`, `nombre`, `apellidos`, `correo`, `dAcademica`, `rol`) VALUES
(123456, '1136031989', 'MARÍA ', 'EVILIA MAGAÑA', 'm.evilia@docente.ujat.mx', 'CYTI', 'docente'),
(789456, '1136031989', 'MANUEL', 'VILLANUEVA REYNA', 'm.villanueva@docente.ujat.mx', 'CYTI', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trayectorias`
--

CREATE TABLE `trayectorias` (
  `id` int(11) NOT NULL,
  `trayectoria` varchar(15) NOT NULL,
  `trayectoria_json` longtext NOT NULL,
  `urlTrayectoria` varchar(100) NOT NULL,
  `cAcumulados` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trayectorias`
--

INSERT INTO `trayectorias` (`id`, `trayectoria`, `trayectoria_json`, `urlTrayectoria`, `cAcumulados`) VALUES
(17, '162H8029', '{\"ciclos\":[{\"type\":\"largo\",\"creditos\":\"17\",\"asignaturas\":[{\"clave\":\"F1441\",\"nombre\":\"Infraestructura Computacional\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"1\",\"reprobadas\":\"0\",\"color\":\"5\"},{\"clave\":\"F1005\",\"nombre\":\"Lengua Extranjera \",\"ciclo\":\"1\",\"creditos\":\"4\",\"status\":\"1\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1006\",\"nombre\":\"Lectura y Redacción\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"1\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1004\",\"nombre\":\"Cultura Ambiental\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"1\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1143\",\"nombre\":\"Contabilidad\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"1\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1008\",\"nombre\":\"Pensamiento Matemático\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"1\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"9\",\"asignaturas\":[{\"clave\":\"F1009\",\"nombre\":\"Herramientas de Computación\",\"ciclo\":\"1\",\"creditos\":\"4\",\"status\":\"0\",\"reprobadas\":1,\"color\":\"6\"},{\"clave\":\"F1381\",\"nombre\":\"Comprensión de Textos en Inglés para las TICs\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1001\",\"nombre\":\"Ética\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1421\",\"nombre\":\"Sistemas de Información\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1111\",\"nombre\":\"Matemáticas Básicas\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"},{\"clave\":\"F1462\",\"nombre\":\"Finanzas\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1201\",\"nombre\":\"Algoritmos y Programación\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"1\",\"color\":\"1\"}]},{\"type\":\"largo\",\"creditos\":\"6\",\"asignaturas\":[{\"clave\":\"F1442\",\"nombre\":\"Plataformas Tecnológicas\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"5\"},{\"clave\":\"F1023\",\"nombre\":\"Interacción Hombre-Máquina\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"2\"},{\"clave\":\"F1021\",\"nombre\":\"Fundamento de Redes\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1007\",\"nombre\":\"Derechos Humanos\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1471\",\"nombre\":\"Matemáticas Discretas\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"},{\"clave\":\"F1011\",\"nombre\":\"Programación Orientada a Objetos\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"}]},{\"type\":\"largo\",\"creditos\":\"1\",\"asignaturas\":[{\"clave\":\"F1401\",\"nombre\":\"Programación en Dispositivo Móviles\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1131\",\"nombre\":\"Fundamentos de Sistemas Operativos\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1412\",\"nombre\":\"Desarrollo de Interfaces\",\"ciclo\":\"0\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"2\"},{\"clave\":\"F1022\",\"nombre\":\"Planeación de Redes\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1018\",\"nombre\":\"Modelado, Diseño y Manejo de Base de Datos\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1461\",\"nombre\":\"Economía Digital\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1103\",\"nombre\":\"Estructura de Datos\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"}]},{\"type\":\"largo\",\"creditos\":\"7\",\"asignaturas\":[{\"clave\":\"F1463\",\"nombre\":\"Administración de Proyectos de TI\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1453\",\"nombre\":\"Planeación y Administración de Sistemas Operativos de Red\",\"ciclo\":\"0\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1003\",\"nombre\":\"Metodología\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1433\",\"nombre\":\"Administración y Seguridad en Redes\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1422\",\"nombre\":\"Administración y Programación de Base de Datos\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1464\",\"nombre\":\"Normatividad en TI\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1472\",\"nombre\":\"Estadística para TI\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"10\",\"asignaturas\":[{\"clave\":\"F1402\",\"nombre\":\"Tecnologías y Sistemas Web\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1019\",\"nombre\":\"Protocolo de Proyecto\",\"ciclo\":\"0\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1491\",\"nombre\":\"Optativa del Área de Entorno Social\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1424\",\"nombre\":\"Manejo de Grandes Volúmenes de Información\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1465\",\"nombre\":\"eCommerce\",\"ciclo\":\"0\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1492\",\"nombre\":\"Optativa del Área de Matemáticas\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"3\",\"asignaturas\":[{\"clave\":\"F1495\",\"nombre\":\"Optativa 1 Área de Programación e Ingeniería de Software\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1454\",\"nombre\":\"Administración de Sistemas\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1020\",\"nombre\":\"Desarrollo de Proyecto\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1493\",\"nombre\":\"Optativa del Área de Redes\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1423\",\"nombre\":\"Temas Selectos de Base de Datos\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1425\",\"nombre\":\"Minería de Datos\",\"ciclo\":\"0\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1098\",\"nombre\":\"Servicio Social\",\"ciclo\":\"0\",\"creditos\":\"10\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"}]},{\"type\":\"largo\",\"creditos\":\"0\",\"asignaturas\":[{\"clave\":\"F1496\",\"nombre\":\"Optativa 2 Área de Programación e Ingeniería de Software\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1494\",\"nombre\":\"Optativa del Área de Software Base\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1413\",\"nombre\":\"Sistemas Inteligentes para TI\",\"ciclo\":\"0\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"2\"},{\"clave\":\"F1426\",\"nombre\":\"Administración de Sistemas Intranet y Extranet\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1403\",\"nombre\":\"Industria de Software\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1490\",\"nombre\":\"Formación de Emprendedores\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1099\",\"nombre\":\"Prácticas Profesionales\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1002\",\"nombre\":\"Filosofía\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"}]}],\"creditosAcumulados\":\"0\",\"avisos\":[\"0\",\"Herramientas de Computación&0&0&0&October 21, 2022\"],\"reprobadas\":[\"0\",{\"ciclo\":\"0\",\"nombre\":\"Algoritmos y Programación\"},{\"ciclo\":\"1\",\"nombre\":\"Herramientas de Computación\"}]}', '', 33),
(18, '162H8027', '{\"ciclos\":[{\"type\":\"largo\",\"creditos\":\"9\",\"asignaturas\":[{\"clave\":\"F1201\",\"nombre\":\"Algoritmos y Programación\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1441\",\"nombre\":\"Infraestructura Computacional\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"5\"},{\"clave\":\"F1005\",\"nombre\":\"Lengua Extranjera \",\"ciclo\":\"1\",\"creditos\":\"4\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1006\",\"nombre\":\"Lectura y Redacción\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1004\",\"nombre\":\"Cultura Ambiental\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1143\",\"nombre\":\"Contabilidad\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1008\",\"nombre\":\"Pensamiento Matemático\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"10\",\"asignaturas\":[{\"clave\":\"F1011\",\"nombre\":\"Programación Orientada a Objetos\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1009\",\"nombre\":\"Herramientas de Computación\",\"ciclo\":\"1\",\"creditos\":\"4\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1381\",\"nombre\":\"Comprensión de Textos en Inglés para las TICs\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1001\",\"nombre\":\"Ética\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1421\",\"nombre\":\"Sistemas de Información\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1111\",\"nombre\":\"Matemáticas Básicas\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"},{\"clave\":\"F1462\",\"nombre\":\"Finanzas\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"}]},{\"type\":\"largo\",\"creditos\":\"6\",\"asignaturas\":[{\"clave\":\"F1103\",\"nombre\":\"Estructura de Datos\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1442\",\"nombre\":\"Plataformas Tecnológicas\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"5\"},{\"clave\":\"F1023\",\"nombre\":\"Interacción Hombre-Máquina\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"2\"},{\"clave\":\"F1021\",\"nombre\":\"Fundamento de Redes\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1007\",\"nombre\":\"Derechos Humanos\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1471\",\"nombre\":\"Matemáticas Discretas\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"8\",\"asignaturas\":[{\"clave\":\"F1401\",\"nombre\":\"Programación en Dispositivo Móviles\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1131\",\"nombre\":\"Fundamentos de Sistemas Operativos\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1412\",\"nombre\":\"Desarrollo de Interfaces\",\"ciclo\":\"0\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"2\"},{\"clave\":\"F1022\",\"nombre\":\"Planeación de Redes\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1018\",\"nombre\":\"Modelado, Diseño y Manejo de Base de Datos\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1461\",\"nombre\":\"Economía Digital\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"}]},{\"type\":\"largo\",\"creditos\":\"7\",\"asignaturas\":[{\"clave\":\"F1463\",\"nombre\":\"Administración de Proyectos de TI\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1453\",\"nombre\":\"Planeación y Administración de Sistemas Operativos de Red\",\"ciclo\":\"0\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1003\",\"nombre\":\"Metodología\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1433\",\"nombre\":\"Administración y Seguridad en Redes\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1422\",\"nombre\":\"Administración y Programación de Base de Datos\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1464\",\"nombre\":\"Normatividad en TI\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1472\",\"nombre\":\"Estadística para TI\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"10\",\"asignaturas\":[{\"clave\":\"F1402\",\"nombre\":\"Tecnologías y Sistemas Web\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1019\",\"nombre\":\"Protocolo de Proyecto\",\"ciclo\":\"0\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1491\",\"nombre\":\"Optativa del Área de Entorno Social\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1424\",\"nombre\":\"Manejo de Grandes Volúmenes de Información\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1465\",\"nombre\":\"eCommerce\",\"ciclo\":\"0\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1492\",\"nombre\":\"Optativa del Área de Matemáticas\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"3\",\"asignaturas\":[{\"clave\":\"F1495\",\"nombre\":\"Optativa 1 Área de Programación e Ingeniería de Software\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1454\",\"nombre\":\"Administración de Sistemas\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1020\",\"nombre\":\"Desarrollo de Proyecto\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1493\",\"nombre\":\"Optativa del Área de Redes\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1423\",\"nombre\":\"Temas Selectos de Base de Datos\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1425\",\"nombre\":\"Minería de Datos\",\"ciclo\":\"0\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1098\",\"nombre\":\"Servicio Social\",\"ciclo\":\"0\",\"creditos\":\"10\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"}]},{\"type\":\"largo\",\"creditos\":\"0\",\"asignaturas\":[{\"clave\":\"F1496\",\"nombre\":\"Optativa 2 Área de Programación e Ingeniería de Software\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1494\",\"nombre\":\"Optativa del Área de Software Base\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1413\",\"nombre\":\"Sistemas Inteligentes para TI\",\"ciclo\":\"0\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"2\"},{\"clave\":\"F1403\",\"nombre\":\"Industria de Software\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1426\",\"nombre\":\"Administración de Sistemas Intranet y Extranet\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1490\",\"nombre\":\"Formación de Emprendedores\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1099\",\"nombre\":\"Prácticas Profesionales\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1002\",\"nombre\":\"Filosofía\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"}]}],\"creditosAcumulados\":\"0\",\"avisos\":[\"0\"],\"reprobadas\":[\"0\"]}', '', 0),
(20, 'LTI', '{\"ciclos\":[{\"type\":\"largo\",\"creditos\":\"9\",\"asignaturas\":[{\"clave\":\"F1201\",\"nombre\":\"Algoritmos y Programación\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1441\",\"nombre\":\"Infraestructura Computacional\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"5\"},{\"clave\":\"F1005\",\"nombre\":\"Lengua Extranjera \",\"ciclo\":\"1\",\"creditos\":\"4\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1006\",\"nombre\":\"Lectura y Redacción\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1004\",\"nombre\":\"Cultura Ambiental\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1143\",\"nombre\":\"Contabilidad\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1008\",\"nombre\":\"Pensamiento Matemático\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"10\",\"asignaturas\":[{\"clave\":\"F1011\",\"nombre\":\"Programación Orientada a Objetos\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1009\",\"nombre\":\"Herramientas de Computación\",\"ciclo\":\"1\",\"creditos\":\"4\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1381\",\"nombre\":\"Comprensión de Textos en Inglés para las TICs\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1001\",\"nombre\":\"Ética\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1421\",\"nombre\":\"Sistemas de Información\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1462\",\"nombre\":\"Finanzas\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1111\",\"nombre\":\"Matemáticas Básicas\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"6\",\"asignaturas\":[{\"clave\":\"F1103\",\"nombre\":\"Estructura de Datos\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1442\",\"nombre\":\"Plataformas Tecnológicas\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"5\"},{\"clave\":\"F1023\",\"nombre\":\"Interacción Hombre-Máquina\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"2\"},{\"clave\":\"F1021\",\"nombre\":\"Fundamento de Redes\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1007\",\"nombre\":\"Derechos Humanos\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1471\",\"nombre\":\"Matemáticas Discretas\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"8\",\"asignaturas\":[{\"clave\":\"F1401\",\"nombre\":\"Programación en Dispositivo Móviles\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1131\",\"nombre\":\"Fundamentos de Sistemas Operativos\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1412\",\"nombre\":\"Desarrollo de Interfaces\",\"ciclo\":\"0\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"2\"},{\"clave\":\"F1022\",\"nombre\":\"Planeación de Redes\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1018\",\"nombre\":\"Modelado, Diseño y Manejo de Base de Datos\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1461\",\"nombre\":\"Economía Digital\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"}]},{\"type\":\"largo\",\"creditos\":\"7\",\"asignaturas\":[{\"clave\":\"F1463\",\"nombre\":\"Administración de Proyectos de TI\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1453\",\"nombre\":\"Planeación y Administración de Sistemas Operativos de Red\",\"ciclo\":\"0\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1003\",\"nombre\":\"Metodología\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1433\",\"nombre\":\"Administración y Seguridad en Redes\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1422\",\"nombre\":\"Administración y Programación de Base de Datos\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1464\",\"nombre\":\"Normatividad en TI\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1472\",\"nombre\":\"Estadística para TI\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"10\",\"asignaturas\":[{\"clave\":\"F1402\",\"nombre\":\"Tecnologías y Sistemas Web\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1019\",\"nombre\":\"Protocolo de Proyecto\",\"ciclo\":\"0\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1491\",\"nombre\":\"Optativa del Área de Entorno Social\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1424\",\"nombre\":\"Manejo de Grandes Volúmenes de Información\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1465\",\"nombre\":\"eCommerce\",\"ciclo\":\"0\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1492\",\"nombre\":\"Optativa del Área de Matemáticas\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"8\"}]},{\"type\":\"largo\",\"creditos\":\"3\",\"asignaturas\":[{\"clave\":\"F1495\",\"nombre\":\"Optativa 1 Área de Programación e Ingeniería de Software\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1454\",\"nombre\":\"Administración de Sistemas\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1020\",\"nombre\":\"Desarrollo de Proyecto\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1493\",\"nombre\":\"Optativa del Área de Redes\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"4\"},{\"clave\":\"F1423\",\"nombre\":\"Temas Selectos de Base de Datos\",\"ciclo\":\"1\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1425\",\"nombre\":\"Minería de Datos\",\"ciclo\":\"0\",\"creditos\":\"7\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1098\",\"nombre\":\"Servicio Social\",\"ciclo\":\"0\",\"creditos\":\"10\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"}]},{\"type\":\"largo\",\"creditos\":\"0\",\"asignaturas\":[{\"clave\":\"F1496\",\"nombre\":\"Optativa 2 Área de Programación e Ingeniería de Software\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1494\",\"nombre\":\"Optativa del Área de Software Base\",\"ciclo\":\"1\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"6\"},{\"clave\":\"F1413\",\"nombre\":\"Sistemas Inteligentes para TI\",\"ciclo\":\"0\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"2\"},{\"clave\":\"F1403\",\"nombre\":\"Industria de Software\",\"ciclo\":\"1\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"1\"},{\"clave\":\"F1426\",\"nombre\":\"Administración de Sistemas Intranet y Extranet\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"3\"},{\"clave\":\"F1490\",\"nombre\":\"Formación de Emprendedores\",\"ciclo\":\"0\",\"creditos\":\"6\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1099\",\"nombre\":\"Prácticas Profesionales\",\"ciclo\":\"0\",\"creditos\":\"8\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"},{\"clave\":\"F1002\",\"nombre\":\"Filosofía\",\"ciclo\":\"1\",\"creditos\":\"5\",\"status\":\"0\",\"reprobadas\":\"0\",\"color\":\"7\"}]}],\"creditosAcumulados\":\"0\",\"avisos\":[\"0\"],\"reprobadas\":[\"0\"]}', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`usuario`),
  ADD KEY `carrera` (`carrera`,`docente`),
  ADD KEY `fk_tutor_alumno` (`docente`),
  ADD KEY `fk_alumno_division` (`dAcademica`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`clave`),
  ADD KEY `carrera` (`carrera`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dAcademica` (`dAcademica`);

--
-- Indices de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`usuario`),
  ADD KEY `fk_docente_division` (`dAcademica`);

--
-- Indices de la tabla `trayectorias`
--
ALTER TABLE `trayectorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trayectoria_carrera` (`trayectoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `trayectorias`
--
ALTER TABLE `trayectorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumno_division` FOREIGN KEY (`dAcademica`) REFERENCES `divisiones` (`id`),
  ADD CONSTRAINT `fk_carrera_alumno` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`id`),
  ADD CONSTRAINT `fk_tutor_alumno` FOREIGN KEY (`docente`) REFERENCES `docentes` (`usuario`);

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `fk_carrera_asignatura` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`id`);

--
-- Filtros para la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD CONSTRAINT `fk_carrera_division` FOREIGN KEY (`dAcademica`) REFERENCES `divisiones` (`id`);

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `fk_docente_division` FOREIGN KEY (`dAcademica`) REFERENCES `divisiones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
