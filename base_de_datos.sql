-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2018 a las 17:21:43
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `abanico`
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
  `CATEGORIA_PADRE` int(6) NOT NULL,
  `CATEGORIA_NIVEL` int(6) NOT NULL,
  `CATEGORIA_TIPO` varchar(255) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_productos`
--

CREATE TABLE `categorias_productos` (
  `ID` bigint(6) NOT NULL,
  `ID_CATEGORIA` bigint(6) NOT NULL,
  `ID_PRODUCTO` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `ACTIVO` tinyint(1) NOT NULL
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
  `DIVISA_CONVERSION` decimal(10,2) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `ID_ESTADO` bigint(6) NOT NULL,
  `ID_PAIS` bigint(6) NOT NULL,
  `ESTADO_ISO` bigint(6) NOT NULL,
  `ESTADO_NOMBRE` varchar(255) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_productos`
--

CREATE TABLE `imagenes_productos` (
  `ID_IMAGEN` bigint(10) NOT NULL,
  `ID_PRODUCTO` bigint(10) NOT NULL,
  `IMAGEN_ARCHIVO` varchar(255) NOT NULL,
  `IMAGEN_PORTADA` tinyint(1) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL,
  `ORDEN` bigint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lenguajes`
--

CREATE TABLE `lenguajes` (
  `ID_LENGUAJE` int(6) NOT NULL,
  `LENGUAJE_ISO` varchar(10) NOT NULL,
  `LENGUAJE_NOMBRE` varchar(255) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `ID_PAIS` bigint(6) NOT NULL,
  `PAIS_ISO` varchar(255) NOT NULL,
  `PAIS_NOMBRE` varchar(255) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_PRODUCTO` bigint(10) NOT NULL,
  `PRODUCTO_NOMBRE` varchar(255) NOT NULL,
  `PRODUCTO_URL` varchar(255) NOT NULL,
  `PRODUCTO_DESCRIPCION` text NOT NULL,
  `PRODUCTO_MODELO` varchar(255) NOT NULL,
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
  `PRODUCTO_ESTADO` varchar(255) NOT NULL,
  `ORDEN` bigint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguridad_usuarios`
--

CREATE TABLE `seguridad_usuarios` (
  `ID` bigint(10) NOT NULL,
  `ID_USUARIO` bigint(10) NOT NULL,
  `CLAVE` varchar(128) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ESTADO` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `TIENDA_FECHA_REGISTRO` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TIENDA_FECHA_ACTUALIZACIÓN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ACTIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` varchar(255) NOT NULL,
  `USUARIO_NOMBRE` varchar(255) NOT NULL,
  `USUARIO_APELLIDO_PAT` varchar(255) NOT NULL,
  `USUARIO_APELLIDO_MAT` varchar(255) NOT NULL,
  `USUARIO_CORREO` varchar(255) NOT NULL,
  `USUARIO_TELEFONO` varchar(255) NOT NULL,
  `USUARIO_FECHA_NACIMIENTO` date NOT NULL DEFAULT '0000-00-00',
  `USUARIO_PASSWORD` varchar(255) NOT NULL,
  `USUARIO_FECHA_REGISTRO` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USUARIO_ FECHA_ACTUALIZACIÓN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `USUARIO_TIPO` varchar(255) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`ID_ESTADO`);

--
-- Indices de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  ADD PRIMARY KEY (`ID_IMAGEN`);

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
  MODIFY `ID_CATEGORIA` bigint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  MODIFY `ID` bigint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `ID_DIRECCION` bigint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `ID_ESTADO` bigint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  MODIFY `ID_IMAGEN` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lenguajes`
--
ALTER TABLE `lenguajes`
  MODIFY `ID_LENGUAJE` int(6) NOT NULL AUTO_INCREMENT;
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
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `ID_PAIS` bigint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_PRODUCTO` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `seguridad_usuarios`
--
ALTER TABLE `seguridad_usuarios`
  MODIFY `ID` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `ID_TIENDA` bigint(6) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
