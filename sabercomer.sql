-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2024 a las 20:25:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sabercomer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adiministrador`
--

CREATE TABLE `adiministrador` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_datosPago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comidas`
--

CREATE TABLE `comidas` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Peso` decimal(10,2) NOT NULL,
  `Calorías` int(11) DEFAULT NULL,
  `Ingredientes` text DEFAULT NULL,
  `Valoración_media` decimal(3,2) DEFAULT NULL,
  `Tipo` enum('Entrante','Principal','Postre') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comidas`
--

INSERT INTO `comidas` (`id`, `Nombre`, `Precio`, `Peso`, `Calorías`, `Ingredientes`, `Valoración_media`, `Tipo`) VALUES
(10, 'Brocoli', 3.00, 0.00, NULL, 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.', NULL, 'Entrante'),
(12, 'Lasaña', 7.00, 0.00, NULL, 'Lasaña de pollo ', NULL, 'Entrante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datospago`
--

CREATE TABLE `datospago` (
  `id` int(11) NOT NULL,
  `Número_tarjeta` varchar(20) DEFAULT NULL,
  `CVV` varchar(4) DEFAULT NULL,
  `Fecha_caducidad` date DEFAULT NULL,
  `Domicilio` varchar(255) DEFAULT NULL,
  `Teléfono` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_administrador` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `ID_Cliente` int(11) NOT NULL,
  `ID_Comida` int(11) NOT NULL,
  `Fecha_pedido` datetime NOT NULL,
  `Fecha_entrega` datetime NOT NULL,
  `Domicilio_entrega` varchar(255) NOT NULL,
  `Precio_total` decimal(10,2) NOT NULL,
  `Estado` enum('En preparación','En reparto','Entregado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `contraseña`, `fecha_alta`, `fecha_baja`) VALUES
(1, 'anuarmohame2@gmail.com', '0', '2024-05-18 19:24:36', NULL),
(2, 'anuarmohame2@gmail.com', '0', '2024-05-18 19:25:35', NULL),
(3, 'anuarmohame2@gmail.com', '0', '2024-05-18 19:28:23', NULL),
(4, 'anuarmohame2@gmail.com', '0', '2024-05-18 19:31:12', NULL),
(5, 'anuarmohame2@gmail.com', '0', '2024-05-18 19:35:20', NULL),
(6, 'anuarmohame2@gmail.com', '0', '2024-05-18 19:37:52', NULL),
(7, 'a@a', '0', '2024-05-18 19:44:02', NULL),
(8, 'admin@admin', '0', '2024-05-19 11:19:57', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adiministrador`
--
ALTER TABLE `adiministrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_datosPago` (`id_datosPago`);

--
-- Indices de la tabla `comidas`
--
ALTER TABLE `comidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datospago`
--
ALTER TABLE `datospago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Cliente` (`ID_Cliente`),
  ADD KEY `ID_Comida` (`ID_Comida`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adiministrador`
--
ALTER TABLE `adiministrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comidas`
--
ALTER TABLE `comidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `datospago`
--
ALTER TABLE `datospago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adiministrador`
--
ALTER TABLE `adiministrador`
  ADD CONSTRAINT `adiministrador_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_datosPago`) REFERENCES `datospago` (`id`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`id_administrador`) REFERENCES `adiministrador` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`ID_Comida`) REFERENCES `comidas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
