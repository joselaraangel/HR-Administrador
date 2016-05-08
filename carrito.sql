-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-11-2014 a las 06:18:17
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `carrito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `nom` varchar(30) NOT NULL,
  `ape_pat` varchar(30) NOT NULL,
  `ape_mat` varchar(30) NOT NULL,
  `usu` varchar(30) NOT NULL,
  `con` varchar(30) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`usu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`nom`, `ape_pat`, `ape_mat`, `usu`, `con`, `status`) VALUES
('jose', 'lara', 'aguirre', 'admin', 'root', 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE IF NOT EXISTS `carrito` (
  `usu` varchar(30) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `cantidad` varchar(255) NOT NULL,
  `modelo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usu` (`usu`,`codigo`,`modelo`),
  KEY `codigo` (`codigo`),
  KEY `modelo` (`modelo`),
  KEY `codigo_2` (`codigo`),
  KEY `modelo_2` (`modelo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=208 ;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`usu`, `id`, `codigo`, `cantidad`, `modelo`) VALUES
('lara', 152, 104, '2', 3),
('lara', 155, 105, '1', 2),
('sergio', 159, 107, '1', 3),
('sergio', 170, 105, '1', 3),
('sergio', 175, 104, '1', 4),
('sergio', 176, 109, '1', 2),
('y', 202, 104, '1', 2),
('y', 203, 107, '2', 2),
('y', 204, 104, '1', 2),
('y', 205, 105, '1', 1),
('sergio', 206, 104, '1', 2),
('sergio', 207, 111, '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedidos`
--

CREATE TABLE IF NOT EXISTS `estado_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `estado_pedidos`
--

INSERT INTO `estado_pedidos` (`id`, `modelo`, `nombre`) VALUES
(1, 'P', 'procesando..'),
(2, 'R', 'En espera de pago'),
(3, 'A', 'Concretada'),
(4, 'C', 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `modelo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modelo` (`modelo`),
  KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `nota`, `valor`, `estado`, `modelo`) VALUES
(1, 104, 'Mario Kart Wii', 'Juego de video Mario Kart para wii', '600', 's', 5),
(12, 107, 'Mario Power Tenis', 'Juego de video para consola Wii', '800', 's', 5),
(13, 108, 'Mario Sports Mix', 'Juego de video para consolaWii', '800', 's', 5),
(15, 109, 'Laptop Sony Vaio', 'Equipo de computo Sony Vaio de 500 GB DD', '11000', 's', 4),
(18, 111, 'PokePark', 'juego de video para consola Wii', '800', 's', 5),
(53, 105, 'iphone 6', 'iphone 6 de apple color blanco', '14900', 's', 6),
(54, 5456, 'Moto G 16Gb', '16Gb procesador con doble nucleo', '2999', 's', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `estado` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `modelo`, `nombre`, `estado`) VALUES
(1, 'D', 'Dell', 's'),
(2, 'S', 'Samsung', 's'),
(3, 'H', 'HP', 's'),
(4, 'V', 'Sony', 's'),
(5, 'N', 'Nintendo', 's'),
(6, 'A', 'Apple', 's'),
(7, 'M', 'Motorola', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `nom` varchar(30) NOT NULL,
  `ape_pat` varchar(30) NOT NULL,
  `ape_mat` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `usu` varchar(30) NOT NULL,
  `con` varchar(30) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`usu`),
  UNIQUE KEY `usu` (`usu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nom`, `ape_pat`, `ape_mat`, `email`, `usu`, `con`, `status`) VALUES
('', '', '', '', '', '', ''),
('abraham', 'franco', 'laguera', 'al@aol.com', 'afl', 'gato', 'b'),
('Batman', 'Bat', 'Man', 'bat28@aol.net', 'Batman-28', 'batman', 'b'),
('bat', 'man', 'batman', 'bat29@aol.es', 'Batman-29', 'batman', 'b'),
('abraham', 'franco', 'laguera', 'cat@aol.com', 'gato', 'gato', 'b'),
('Jose', 'lara', 'aguirre', 'lara08@aol.net', 'lara', 'lara', 'b'),
('sergio', 'paz', 'holguin', 'sergio@yahoo.es', 'sergio', 'sergio', 'b'),
('sergio', 'x', 'x', 'x', 'x', 'x', 'b'),
('abraham', 'franco', 'laguera', 'y@yahoo.mx', 'y', 'y', 'b');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usu`) REFERENCES `usuarios` (`usu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`modelo`) REFERENCES `estado_pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_3` FOREIGN KEY (`codigo`) REFERENCES `producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`modelo`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
