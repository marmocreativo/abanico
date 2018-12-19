-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-12-2018 a las 11:23:17
-- Versión del servidor: 5.6.40-84.0-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quarkser_abanico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `ID_CATEGORIA` bigint(6) NOT NULL,
  `CATEGORIA_NOMBRE` varchar(255) NOT NULL,
  `CATEGORIA_URL` varchar(255) NOT NULL,
  `CATEGORIA_DESCRIPCION` text NOT NULL,
  `CATEGORIA_COLOR` varchar(255) NOT NULL DEFAULT '-primary',
  `CATEGORIA_ICONO` varchar(255) NOT NULL DEFAULT 'fa-list',
  `CATEGORIA_IMAGEN` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `CATEGORIA_PADRE` int(6) NOT NULL DEFAULT '0',
  `CATEGORIA_FINAL` int(11) NOT NULL,
  `CATEGORIA_TIPO` varchar(255) NOT NULL,
  `CATEGORIA_ESTADO` varchar(255) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ID_CATEGORIA`, `CATEGORIA_NOMBRE`, `CATEGORIA_URL`, `CATEGORIA_DESCRIPCION`, `CATEGORIA_COLOR`, `CATEGORIA_ICONO`, `CATEGORIA_IMAGEN`, `CATEGORIA_PADRE`, `CATEGORIA_FINAL`, `CATEGORIA_TIPO`, `CATEGORIA_ESTADO`) VALUES
(19, 'Hogar y Electrodomésticos', 'hogar-y-electrodomésticos', 'Categoría de prueba', '-primary-1', 'fas fa-home', 'default.jpg', 0, 0, 'productos', 'activo'),
(20, 'Electrodomésticos', 'electrodomésticos', '', '-primary-2', 'fas fa-list', 'default.jpg', 19, 0, 'productos', 'activo'),
(21, 'Utensilios de Cocina', 'utensilios-de-cocina', '', '-primary-4', 'fas fa-list', 'default.jpg', 19, 0, 'productos', 'activo'),
(23, 'Refrigeradores', 'refrigeradores', '', '-default', 'fas fa-list', 'default.jpg', 20, 0, 'productos', 'activo'),
(24, 'Cucharas', 'cucharas', '', '-default', 'fas fa-list', 'default.jpg', 21, 0, 'productos', 'activo'),
(25, 'Varios', 'varios', '', '-primary-1', 'fas fa-list', 'default.jpg', 19, 0, 'productos', 'activo'),
(26, 'Varios', 'varios-1', '', '-primary-4', 'fas fa-list', 'default.jpg', 25, 0, 'productos', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_productos`
--

CREATE TABLE `categorias_productos` (
  `ID` bigint(6) NOT NULL,
  `ID_CATEGORIA` bigint(6) NOT NULL,
  `ID_PRODUCTO` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias_productos`
--

INSERT INTO `categorias_productos` (`ID`, `ID_CATEGORIA`, `ID_PRODUCTO`) VALUES
(18, 26, 1),
(21, 26, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `ID_DIRECCION` bigint(6) NOT NULL,
  `ID_CLIENTE` varchar(255) NOT NULL,
  `ID_TIENDA` bigint(6) NOT NULL,
  `DIRECCION_TIPO` varchar(255) NOT NULL,
  `DIRECCION_ALIAS` varchar(255) NOT NULL,
  `ID_PAIS` bigint(6) NOT NULL,
  `ID_ESTADO` bigint(6) NOT NULL,
  `DIRECCION_CIUDAD` text NOT NULL,
  `DIRECCION_DELEGACION` text NOT NULL,
  `DIRECCION_COLONIA` text NOT NULL,
  `DIRECCION_CALLE_Y_NUMERO` text NOT NULL,
  `DIRECCION_CODIGO_POSTAL` varchar(255) NOT NULL,
  `DIRECCION_ENTRE_CALLES` text NOT NULL,
  `DIRECCION_REFERENCIAS` text NOT NULL,
  `DIRECCION_FECHA_REGISTRO` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DIRECCION_FECHA_ACTUALIZACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CONTACTO_NOMBRE` varchar(255) NOT NULL,
  `CONTACTO_APELLIDOS` varchar(255) NOT NULL,
  `CONTACTO_TELEFONO` varchar(255) NOT NULL,
  `DIRECCION_ESTADO` varchar(255) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisas`
--

CREATE TABLE `divisas` (
  `ID_DIVISA` int(6) NOT NULL,
  `DIVISA_ISO` varchar(10) NOT NULL,
  `DIVISA_NOMBRE` varchar(255) NOT NULL,
  `DIVISA_SIGNO` varchar(3) NOT NULL,
  `DIVISA_CONVERSION` decimal(10,3) NOT NULL,
  `DIVISA_ESTADO` varchar(255) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `divisas`
--

INSERT INTO `divisas` (`ID_DIVISA`, `DIVISA_ISO`, `DIVISA_NOMBRE`, `DIVISA_SIGNO`, `DIVISA_CONVERSION`, `DIVISA_ESTADO`) VALUES
(1, 'MXN', 'Pesos', '$', '1.000', 'activo'),
(2, 'USD', 'Dollar', '$', '0.049', 'activo'),
(3, 'EUR', 'EURO', '€', '0.043', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `ID_ESTADO` bigint(6) NOT NULL,
  `ID_PAIS` bigint(6) NOT NULL,
  `ESTADO_ISO` varchar(255) NOT NULL,
  `ESTADO_NOMBRE` varchar(255) NOT NULL,
  `ESTADO_ESTADO` varchar(255) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`ID_ESTADO`, `ID_PAIS`, `ESTADO_ISO`, `ESTADO_NOMBRE`, `ESTADO_ESTADO`) VALUES
(1, 1, 'AG', 'Aguascalientes', 'activo'),
(2, 1, 'BC', 'Baja California', 'activo'),
(3, 1, 'BS', 'Baja California Sur', 'activo'),
(4, 1, 'CM', 'Campeche', 'activo'),
(5, 1, 'CS', 'Chiapas', 'activo'),
(6, 1, 'CH', 'Chihuahua', 'activo'),
(7, 1, 'CX', 'Ciudad de México', 'activo'),
(8, 1, 'CO', 'Coahuila', 'activo'),
(9, 1, 'CL', 'Colima', 'activo'),
(10, 1, 'DG', 'Durango', 'activo'),
(11, 1, 'GT', 'Guanajuato', 'activo'),
(12, 1, 'GR', 'Guerrero', 'activo'),
(13, 1, 'HG', 'Hidalgo', 'activo'),
(14, 1, 'JC', 'Jalisco', 'activo'),
(15, 1, 'EM', 'Estado de México', 'activo'),
(16, 1, 'MI', 'Michoacán', 'activo'),
(17, 1, 'MO', 'Morelos', 'activo'),
(18, 1, 'NA', 'Nayarit', 'activo'),
(19, 1, 'NL', 'Nuevo León', 'activo'),
(20, 1, 'OA', 'Oaxaca', 'activo'),
(21, 1, 'PU', 'Puebla', 'activo'),
(22, 1, 'QT', 'Querétaro', 'activo'),
(23, 1, 'QR', 'Quintana Roo', 'activo'),
(24, 1, 'SL', 'San Luis Potosí', 'activo'),
(25, 1, 'SI', 'Sinaloa', 'activo'),
(26, 1, 'SO', 'Sonora', 'activo'),
(27, 1, 'TB', 'Tabasco', 'activo'),
(28, 1, 'TM', 'Tamaulipas', 'activo'),
(29, 1, 'TL', 'Tlaxcala', 'activo'),
(30, 1, 'VE', 'Veracruz', 'activo'),
(31, 1, 'YU', 'Yucatán', 'activo'),
(32, 1, 'ZA', 'Zacatecas', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria_productos`
--

CREATE TABLE `galeria_productos` (
  `ID_GALERIA` bigint(11) NOT NULL,
  `ID_PRODUCTO` bigint(11) NOT NULL,
  `GALERIA_ARCHIVO` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `GALERIA_PORTADA` varchar(255) NOT NULL DEFAULT 'no',
  `GALERIA_ESTADO` varchar(255) NOT NULL DEFAULT 'activo',
  `ORDEN` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `galeria_productos`
--

INSERT INTO `galeria_productos` (`ID_GALERIA`, `ID_PRODUCTO`, `GALERIA_ARCHIVO`, `GALERIA_PORTADA`, `GALERIA_ESTADO`, `ORDEN`) VALUES
(18, 8, 'categoria-5c1a76bd5a6fd.jpg', 'si', 'activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lenguajes`
--

CREATE TABLE `lenguajes` (
  `ID_LENGUAJE` int(6) NOT NULL,
  `LENGUAJE_ISO` varchar(10) NOT NULL,
  `LENGUAJE_NOMBRE` varchar(255) NOT NULL,
  `LENGUAJE_ESTADO` varchar(255) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lenguajes`
--

INSERT INTO `lenguajes` (`ID_LENGUAJE`, `LENGUAJE_ISO`, `LENGUAJE_NOMBRE`, `LENGUAJE_ESTADO`) VALUES
(1, 'es', 'Español', 'activo'),
(2, 'en', 'English', 'activo'),
(3, 'WR', 'DVXCVCVCZVZXC', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_blanca`
--

CREATE TABLE `lista_blanca` (
  `ID` bigint(10) NOT NULL,
  `DIRECCION_IP` varchar(255) NOT NULL,
  `NOTAS` text NOT NULL,
  `FECHA_REGISTRO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_negra`
--

CREATE TABLE `lista_negra` (
  `ID` bigint(10) NOT NULL,
  `DIRECCION_IP` varchar(255) NOT NULL,
  `NOTAS` text NOT NULL,
  `FECHA_REGISTRO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `ID` int(6) NOT NULL,
  `OPCION_NOMBRE` varchar(255) NOT NULL,
  `OPCION_VALOR` longtext NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`ID`, `OPCION_NOMBRE`, `OPCION_VALOR`, `ACTIVO`) VALUES
(1, 'titulo_sitio', 'Abanico siempre lo mejor', 1),
(2, 'modo_mantenimiento', 'no', 1),
(3, 'modo_debug', 'no', 1),
(4, 'lenguaje_predeterminado', 'es', 1),
(5, 'telefono_sitio', '01 5555 5555', 1),
(6, 'correo_sitio', 'atencionclientes@abanicoytu.com', 1),
(7, 'divisa_predeterminada', '1', 1),
(8, 'mailer_host', 'mail.abanicoytu.com', 1),
(9, 'mailer_port', '2525', 1),
(10, 'mailer_user', 'servidor@abanicoytu.com', 1),
(11, 'mailer_pass', '135Servidor#', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `ID_PAIS` bigint(6) NOT NULL,
  `PAIS_ISO` varchar(255) NOT NULL,
  `PAIS_NOMBRE` varchar(255) NOT NULL,
  `PAIS_ESTADO` varchar(255) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`ID_PAIS`, `PAIS_ISO`, `PAIS_NOMBRE`, `PAIS_ESTADO`) VALUES
(1, 'MX', 'México', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_PRODUCTO` bigint(10) NOT NULL,
  `ID_USUARIO` varchar(255) NOT NULL,
  `PRODUCTO_NOMBRE` varchar(255) NOT NULL,
  `PRODUCTO_URL` varchar(255) NOT NULL,
  `PRODUCTO_DESCRIPCION` text NOT NULL,
  `PRODUCTO_DETALLES` longtext NOT NULL,
  `PRODUCTO_MODELO` varchar(255) NOT NULL,
  `PRODUCTO_ORIGEN` varchar(255) NOT NULL DEFAULT 'MXN',
  `PRODUCTO_SKU` varchar(255) NOT NULL,
  `PRODUCTO_UPC` varchar(255) NOT NULL,
  `PRODUCTO_EAN` varchar(255) NOT NULL,
  `PRODUCTO_JAN` varchar(255) NOT NULL,
  `PRODUCTO_ISBN` varchar(255) NOT NULL,
  `PRODUCTO_MPN` varchar(255) NOT NULL,
  `PRODUCTO_PRECIO` decimal(10,2) NOT NULL,
  `PRODUCTO_CANTIDAD` int(6) NOT NULL,
  `PRODUCTO_CANTIDAD_MINIMA` int(6) NOT NULL,
  `PRODUCTO_INVENTARIO` tinyint(1) NOT NULL,
  `PRODUCTO_MENSAJE_SIN_STOCK` varchar(255) NOT NULL,
  `PRODUCTO_FECHA_REGISTRO` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PRODUCTO_FECHA_ACTUALIZACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PRODUCTO_FECHA_PUBLICACION` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PRODUCTO_ANCHO` decimal(10,2) NOT NULL,
  `PRODUCTO_ALTO` decimal(10,2) NOT NULL,
  `PRODUCTO_PROFUNDO` decimal(10,2) NOT NULL,
  `PRODUCTO_PESO` decimal(10,2) NOT NULL,
  `PRODUCTO_TIPO` varchar(255) NOT NULL DEFAULT 'normal',
  `PRODUCTO_ESTADO` varchar(255) NOT NULL,
  `ORDEN` bigint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_PRODUCTO`, `ID_USUARIO`, `PRODUCTO_NOMBRE`, `PRODUCTO_URL`, `PRODUCTO_DESCRIPCION`, `PRODUCTO_DETALLES`, `PRODUCTO_MODELO`, `PRODUCTO_ORIGEN`, `PRODUCTO_SKU`, `PRODUCTO_UPC`, `PRODUCTO_EAN`, `PRODUCTO_JAN`, `PRODUCTO_ISBN`, `PRODUCTO_MPN`, `PRODUCTO_PRECIO`, `PRODUCTO_CANTIDAD`, `PRODUCTO_CANTIDAD_MINIMA`, `PRODUCTO_INVENTARIO`, `PRODUCTO_MENSAJE_SIN_STOCK`, `PRODUCTO_FECHA_REGISTRO`, `PRODUCTO_FECHA_ACTUALIZACION`, `PRODUCTO_FECHA_PUBLICACION`, `PRODUCTO_ANCHO`, `PRODUCTO_ALTO`, `PRODUCTO_PROFUNDO`, `PRODUCTO_PESO`, `PRODUCTO_TIPO`, `PRODUCTO_ESTADO`, `ORDEN`) VALUES
(1, '5c0653d43d92e7.75019474', 'Iphone X 256 Gb - Plata Apple', '', 'iPhone X 256 GB es elegancia e innovación al ser de vidrio más resistente, tanto en la parte frontal como en la trasera, además de contar con carga inalámbrica y resistencia al agua y polvo. Cuenta con chip A11 Bionic con el que disfrutarás de increíble experiencia de realidad aumentada en juegos y apps. Tendrás una pantalla con tecnología OLED y Super retina HD de 5.8 pulgadas con resolución de 2436 x 1125, 459 ppi. El futuro estará en tus manos con la cámara TrueDepth de 7 MP en un espacio pequeño de la pantalla en donde tendrás la más alta tecnología desarrollada y sensores que hacen posible Face ID ¡la autentificación más segura! Cámara dual trasera de 12 MP con nuevo filtro de color y estabilización óptica de imagen. ', '<p>ESTE TEL&Eacute;FONO VIENE DESBLOQUEADO POR LO QUE PODR&Aacute; COLOCARLE LA SIM DE CUALQUIER COMPA&Ntilde;&Iacute;A TELEF&Oacute;NICA. La garant&iacute;a es directamente con la marca.</p>', 'Iphone X 256', 'Otro', '', ' ', ' ', ' ', ' ', ' ', '21599.00', 100, 1, 1, 'No disponible para la venta', '2018-12-05 21:11:50', '2018-12-19 16:44:45', '2018-12-05 21:11:50', '10.00', '21.00', '2.00', '0.50', 'normal', 'activo', 1),
(2, '5c0864799aba54.31749554', 'CAJA', '', 'ES  UNA CAJA', '<p>ES UNA CAJA GRANDE DE MADERA</p>', '345', 'México', '55665', '', '', '', '', '', '4.00', 8, 7, 1, 'No disponible para venta', '2018-12-05 23:53:41', '2018-12-05 23:53:41', '2018-12-05 23:53:41', '12.00', '44.00', '23.00', '4.00', 'normal', 'activo', 1),
(4, '5c08a9dc2cb096.56391251', 'Olla de 5 lts', '', 'Olla de 5 litros gabricada en acero inoxidable', '', 'OAI', 'México', '', '', '', '', '', '', '5000.00', 10, 1, 1, 'No disponible para la venta', '2018-12-13 04:37:54', '2018-12-13 23:20:05', '2018-12-13 04:37:54', '52.00', '68.00', '15.00', '5.00', 'normal', 'activo', 1),
(5, '5c08a9dc2cb096.56391251', 'cafetera italina', '', 'Cafetera en acero inoxidable para 5 tazas. ', '<p>&nbsp; Terminado mate</p>', 'grecko', 'México', '', '', '', '', '', '', '862.00', 4, 1, 1, 'No disponible para la venta', '2018-12-13 04:39:26', '2018-12-13 04:39:26', '2018-12-13 04:39:26', '15.00', '25.00', '12.00', '1.00', 'normal', 'activo', 1),
(8, '5c0653d43d92e7.75019474', 'JABON', '', 'JGJJJJJJRTTTTTTTTTTTTTTT', '<p>GFFGFDGFGS</p>', 'ROMA', 'México', 'ROM', '   ', '   ', '   ', '   ', '   ', '50.00', 1, 1, 1, 'No disponible para la venta', '2018-12-13 16:15:03', '2018-12-19 16:54:26', '2018-12-13 16:15:03', '30.00', '25.00', '15.00', '20.00', 'normal', 'activo', 1),
(11, '5c19944989f925.72741021', 'PASTA DENTAL', '', 'PASTA DENTAL DE VIAJE DE 60 GRAMOS.', '<p>PASTA DENTAL PRESENTACI&Oacute;N DE VIAJE GRAMAJE DE 60 GRAMOS.</p>', 'DE VIAJE', 'México', '12345', '', '', '', '', '', '70.00', 5, 1, 1, 'No disponible para venta', '2018-12-19 01:26:14', '2018-12-19 01:26:14', '2018-12-19 01:26:14', '5.00', '10.00', '5.00', '0.50', 'normal', 'activo', 1),
(12, '5c19944989f925.72741021', 'PASTA DENTAL COLGATE', '', 'PASTA DENTAL DE VIAJE DE 60 GRAMOS.', '<p>PASTA DENTAL PRESENTACI&Oacute;N DE VIAJE GRAMAJE DE 60 GRAMOS.</p>', 'DE VIAJE', 'México', '12345', '', '', '', '', '', '70.00', 5, 1, 1, 'No disponible para venta', '2018-12-19 01:30:12', '2018-12-19 01:30:12', '2018-12-19 01:30:12', '5.00', '10.00', '5.00', '0.50', 'normal', 'activo', 1),
(14, '5c19944989f925.72741021', 'LIBRO', '', 'LIBRO PASTA GRUESA', '<p>LIBRO</p>\r\n<p>PASTA GRUESA</p>\r\n<p>250 P&Aacute;GINAS</p>', 'PASTA GRUESA', 'México', '1435445', '', '', '', '', '', '500.00', 20, 1, 1, 'No disponible para venta', '2018-12-19 01:42:41', '2018-12-19 01:42:41', '2018-12-19 01:42:41', '25.00', '10.00', '4.00', '1.00', 'normal', 'activo', 1),
(15, '5c19944989f925.72741021', 'LIBRO', '', 'LIBRO PASTA GRUESA', '<p>LIBRO</p>\r\n<p>PASTA GRUESA</p>\r\n<p>250 P&Aacute;GINAS</p>', 'PASTA GRUESA', 'México', '1435445', '', '', '', '', '', '500.00', 20, 1, 1, 'No disponible para venta', '2018-12-19 01:44:52', '2018-12-19 01:44:52', '2018-12-19 01:44:52', '25.00', '10.00', '4.00', '1.00', 'normal', 'activo', 1),
(16, '5c19944989f925.72741021', 'LIBRO', '', 'LIBRO PASTA GRUESA', '<p>LIBRO</p>\r\n<p>PASTA GRUESA</p>\r\n<p>250 P&Aacute;GINAS</p>', 'PASTA GRUESA', 'México', '1435445', '', '', '', '', '', '500.00', 20, 1, 1, 'No disponible para venta', '2018-12-19 01:44:56', '2018-12-19 01:44:56', '2018-12-19 01:44:56', '25.00', '10.00', '4.00', '1.00', 'normal', 'activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguridad_usuarios`
--

CREATE TABLE `seguridad_usuarios` (
  `ID` bigint(10) NOT NULL,
  `ID_USUARIO` varchar(255) NOT NULL,
  `CLAVE` varchar(128) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ESTADO` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seguridad_usuarios`
--

INSERT INTO `seguridad_usuarios` (`ID`, `ID_USUARIO`, `CLAVE`, `FECHA_REGISTRO`, `ESTADO`) VALUES
(3, '5c0653d43d92e7.75019474', '2eHqLccQQh', '2018-12-15 18:52:49', 'inactivo'),
(4, '5c0653d43d92e7.75019474', 'IjUMTXgysC', '2018-12-16 02:06:14', 'inactivo'),
(5, '5c08a9dc2cb096.56391251', 'NT380VwLj3', '2018-12-16 02:49:23', 'inactivo'),
(6, '5c19b1d094f6e6.26249130', 'xjCwbIXwbu', '2018-12-19 02:58:15', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `ID_TIENDA` bigint(6) NOT NULL,
  `ID_USUARIO` varchar(255) NOT NULL,
  `TIENDA_NOMBRE` varchar(255) NOT NULL,
  `TIENDA_RAZON_SOCIAL` varchar(255) NOT NULL,
  `TIENDA_RFC` varchar(255) NOT NULL,
  `TIENDA_TELEFONO` varchar(255) NOT NULL,
  `TIENDA_FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TIENDA_FECHA_ACTUALIZACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`ID_TIENDA`, `ID_USUARIO`, `TIENDA_NOMBRE`, `TIENDA_RAZON_SOCIAL`, `TIENDA_RFC`, `TIENDA_TELEFONO`, `TIENDA_FECHA_REGISTRO`, `TIENDA_FECHA_ACTUALIZACION`, `ACTIVO`) VALUES
(1, '5c0653d43d92e7.75019474', 'Espejo Negro', 'Espejo Negro SA de CV', 'ESNE34565677', '26032335', '2018-12-05 14:05:30', '2018-12-05 21:05:30', 1),
(2, '5c0839a2158e44.99631671', 'TIendota', 'klakjalkjalksj', 'lkjalksjalksj', '26032335', '2018-12-05 20:50:15', '2018-12-06 03:50:15', 1),
(3, '5c0864799aba54.31749554', 'tania', 'tania saenz', 'SART880719368', '5555555555555', '2018-12-05 23:52:48', '2018-12-05 23:52:48', 1),
(4, '5c08a9dc2cb096.56391251', 'Las mejores ollas', 'S.A. de C.V.', 'ROPC830134A33', '5555555555', '2018-12-12 23:07:24', '2018-12-12 23:07:24', 1),
(5, '5c19944989f925.72741021', 'TIENDA DE MARTHA', 'TIENDA DE MARTHA SA DE CV', 'MAR456789R01', '5530003000', '2018-12-19 01:22:24', '2018-12-19 01:22:24', 1),
(6, '5c19a694185cc1.36196879', 'TEINDA DE CARLOS', 'TIENDA DE CARLOS SA DE CV', 'CAR2343843TR25', '534545435', '2018-12-19 02:03:05', '2018-12-19 02:03:05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` varchar(255) NOT NULL,
  `USUARIO_NOMBRE` varchar(255) NOT NULL,
  `USUARIO_APELLIDOS` varchar(255) NOT NULL,
  `USUARIO_CORREO` varchar(255) NOT NULL,
  `USUARIO_TELEFONO` varchar(255) DEFAULT NULL,
  `USUARIO_FECHA_NACIMIENTO` date DEFAULT '0000-00-00',
  `USUARIO_PASSWORD` varchar(255) NOT NULL,
  `USUARIO_FECHA_REGISTRO` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USUARIO_FECHA_ACTUALIZACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `USUARIO_TIPO` varchar(255) NOT NULL,
  `USUARIO_ESTADO` varchar(255) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `USUARIO_NOMBRE`, `USUARIO_APELLIDOS`, `USUARIO_CORREO`, `USUARIO_TELEFONO`, `USUARIO_FECHA_NACIMIENTO`, `USUARIO_PASSWORD`, `USUARIO_FECHA_REGISTRO`, `USUARIO_FECHA_ACTUALIZACION`, `USUARIO_TIPO`, `USUARIO_ESTADO`) VALUES
('5c0653d43d92e7.75019474', 'Manuel', 'Marmolejo Martínez', 'marmocreativo@gmail.com', ' 26032335', '1989-04-18', '$2y$10$LXIw8Tq1BsAT3xaK6AQJBuA0l9Dxw/3qzMAbsRuzi4OQLoFQip3WS', '2018-12-04 17:15:48', '2018-12-16 02:06:14', 'usr-1', 'activo'),
('5c0839a2158e44.99631671', 'Franco', 'Martínez', 'stmarmo@hotmail.com', '26032335', '0000-00-00', '$2y$10$6KUpM4SS0kXpFVfsqxXuf.Z5JVEYdfzYz0kGGm5nZjpRxXnPbV0UK', '2018-12-06 03:48:34', '2018-12-13 01:21:57', 'usr-1', 'activo'),
('5c0864799aba54.31749554', 'TANIA', 'RODRIGUEZ', 'saenztania19@gmail.com', '(559) 194-5042', '0000-00-00', '$2y$10$cNIjKg5FVO8kZ.qWWMiEYu1ZYGEykVraUjMobNXCjENE/g1GUl6Vy', '2018-12-05 23:51:21', '2018-12-13 01:22:00', 'usr-1', 'activo'),
('5c08a9dc2cb096.56391251', 'JORGE', 'CARRASCO', 'jopecaro6374@hotmail.com', '     34567890', '0000-00-00', '$2y$10$a0nvxJfzsdHyQp6A8GGKwOnqQW/YmRDOw3En0gtVPtzjQZlhC3nE6', '2018-12-06 04:47:24', '2018-12-16 02:50:32', 'usr-1', 'activo'),
('5c19944989f925.72741021', 'Martha', 'Martínez Ruíz', 'mm@gmail.com', ' 5533227755  ', '2000-12-01', '$2y$10$rzDk0zx7IzDD0jogaHrKKeNUfBrOj48LqoTtbNO3PGKteIrWxDJwS', '2018-12-19 00:43:53', '2018-12-19 01:07:37', 'usr-1', 'activo'),
('5c19b1d094f6e6.26249130', 'Kimi', 'Luvi', 'kimi.luvi.tin.yee@gmail.com', NULL, '0000-00-00', '$2y$10$m8BAzr23tQqGWCX0sH0k5.zwPU0YpVtFlX2qFpfh8DjYSiW0YEO3q', '2018-12-19 02:49:52', '2018-12-19 02:58:15', 'usr-1', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indices de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`ID_DIRECCION`);

--
-- Indices de la tabla `divisas`
--
ALTER TABLE `divisas`
  ADD PRIMARY KEY (`ID_DIVISA`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`ID_ESTADO`);

--
-- Indices de la tabla `galeria_productos`
--
ALTER TABLE `galeria_productos`
  ADD PRIMARY KEY (`ID_GALERIA`);

--
-- Indices de la tabla `lenguajes`
--
ALTER TABLE `lenguajes`
  ADD PRIMARY KEY (`ID_LENGUAJE`);

--
-- Indices de la tabla `lista_blanca`
--
ALTER TABLE `lista_blanca`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `lista_negra`
--
ALTER TABLE `lista_negra`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`ID_PAIS`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_PRODUCTO`);

--
-- Indices de la tabla `seguridad_usuarios`
--
ALTER TABLE `seguridad_usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`ID_TIENDA`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `USUARIO_CORREO` (`USUARIO_CORREO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `ID_CATEGORIA` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  MODIFY `ID` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `ID_DIRECCION` bigint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `divisas`
--
ALTER TABLE `divisas`
  MODIFY `ID_DIVISA` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `ID_ESTADO` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `galeria_productos`
--
ALTER TABLE `galeria_productos`
  MODIFY `ID_GALERIA` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `lenguajes`
--
ALTER TABLE `lenguajes`
  MODIFY `ID_LENGUAJE` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `lista_blanca`
--
ALTER TABLE `lista_blanca`
  MODIFY `ID` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lista_negra`
--
ALTER TABLE `lista_negra`
  MODIFY `ID` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `ID_PAIS` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_PRODUCTO` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `seguridad_usuarios`
--
ALTER TABLE `seguridad_usuarios`
  MODIFY `ID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `ID_TIENDA` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
