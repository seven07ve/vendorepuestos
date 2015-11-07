-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Servidor: 50.63.244.184
-- Tiempo de generación: 25-10-2015 a las 16:30:37
-- Versión del servidor: 5.0.96
-- Versión de PHP: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `vendorepuestos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda_virtual`
--

CREATE TABLE `tienda_virtual` (
  `id` int(11) NOT NULL auto_increment,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `rif` varchar(20) NOT NULL,
  `nombre_oficial` varchar(255) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `telefono1` varchar(20) NOT NULL,
  `telefono2` varchar(20) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `latitud` varchar(25) NOT NULL,
  `longitud` varchar(25) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `foto1` varchar(100) NOT NULL,
  `foto2` varchar(100) NOT NULL,
  `foto3` varchar(100) NOT NULL,
  `pagina_web` varchar(255) NOT NULL,
  `facebook` varchar(500) default NULL,
  `twitter` varchar(100) default NULL,
  `email` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `horario` text NOT NULL,
  `datos_pago` varchar(100) NOT NULL,
  `datos_envio` varchar(100) NOT NULL,
  `datos_banco` varchar(100) NOT NULL,
  `color_titulo` varchar(10) NOT NULL,
  `color_fondo` varchar(10) NOT NULL,
  `color_contenido` varchar(10) NOT NULL,
  `persona_mantenimiento` varchar(100) NOT NULL,
  `telefono_mantenimiento` varchar(100) NOT NULL,
  `email_mantenimiento` varchar(100) NOT NULL,
  `fecha_activacion` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `activo` enum('0','1') NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `nombre_oficial` (`nombre_oficial`,`razon_social`,`direccion`,`descripcion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Volcar la base de datos para la tabla `tienda_virtual`
--

INSERT INTO `tienda_virtual` VALUES(103, 'tiendamaster', '123456', 'J-31737187-9', 'Tienda Master', 'Vendorepuestos Venezuela CA', '0424-7401981', '', '', 2, 3, 'los curos', '', '', 'tm web.png', '053.jpg', '268.jpg', '1239.jpg', 'vendorepuestos.com.ve', NULL, NULL, 'vendorepuestos.com.ve@gmail.com', 'empresa de repuestos', 'todo el dia', '2', '6', '7', '', '', '00a060', 'jesus', '04147401928', 'jesus.sntg@hotmail.com', '2015-08-27 14:47:05', '1');
INSERT INTO `tienda_virtual` VALUES(109, 'evalero1', 'hannah07', '', 'evalero1', 'Evalero 1, CA', '04147250425', '', '', 2, 3, 'Av Alfredo Briceño Zona industrial Los Curos galponca Local 31', '            ', '', 'logo ev1.png', '', '', '', '', '', '', 'evalero1cuenta2@gmail.com', 'Venta en línea de Repuestos y Accesorios automotrices. Importación directa marca RALLY', '              9:00am a 5:00pm', '2,3,4,1', '1,4', '', '#000000', '#ffff00', '#ffffff', 'Nathaly', '04147250425', 'evalero1cuenta2@gmail.com', '2015-09-21 13:21:26', '1');
