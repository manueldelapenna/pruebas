-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-09-2016 a las 11:02:56
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `valor`) VALUES
(1, 'update_id', '913479244');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `name`) VALUES
(1, 'administrador'),
(3, 'clientes'),
(9, 'OSECAC'),
(5, 'policias'),
(2, 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_permisos`
--

CREATE TABLE `grupos_permisos` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `permisos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos_permisos`
--

INSERT INTO `grupos_permisos` (`id`, `grupo_id`, `permisos_id`) VALUES
(8, 9, 5),
(9, 9, 1),
(22, 1, 8),
(23, 1, 4),
(24, 1, 5),
(25, 1, 6),
(26, 1, 1),
(27, 1, 2),
(28, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `name`) VALUES
(9, 'grupos_listar'),
(8, 'grupo_agregar'),
(10, 'permisos_listar'),
(4, 'personas_agregar'),
(5, 'personas_editar'),
(6, 'personas_eliminar'),
(1, 'personas_listar'),
(2, 'personas_mayor'),
(3, 'personas_menor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `dni`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
(1, 38460921, 'facundo', 'ares', '1995-02-17'),
(2, 19874290, 'ramiro', 'echague', '1986-02-07'),
(3, 21114708, 'monica gabriela', 'percow', '1986-02-07'),
(4, 21980734, 'marcelo', 'tinelli', '1969-08-21'),
(5, 23789093, 'moni', 'argento', '1978-07-26'),
(6, 25847389, 'marcela viviana ', 'percow', '1986-02-07'),
(7, 25984024, 'santiago', 'coraggio', '1986-02-07'),
(8, 34765384, 'manuel', 'delapenna', '1986-02-07'),
(9, 37846528, 'luciano', 'bianchi', '1986-02-07'),
(10, 38476092, 'lucas', 'desabato', '1994-07-05'),
(11, 38706974, 'tomas', 'echague', '1995-02-05'),
(12, 38726395, 'martin', 'lucena', '1986-02-07'),
(13, 38729994, 'ignacio', 'guglielmino', '1986-02-07'),
(14, 38765209, 'matias', 'grasso', '1986-02-07'),
(15, 38892746, 'ernesto', 'durruty', '1994-07-05'),
(16, 39847092, 'PEPE', 'reina', '1957-03-25'),
(17, 39847204, 'juan pablo', 'alvarez', '1986-02-07'),
(18, 43897298, 'martina', 'arguiano', '1986-02-07'),
(19, 47874278, 'bautista', 'echague', '1986-02-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_alta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimo_logueo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `salt`, `password`, `fecha_alta`, `ultimo_logueo`) VALUES
(12, 'callcenter', '285941c404c961e7f025d220e0abb228', '2bb61e557c6db6bf103caea9b93d96e8', '2016-09-02 10:44:07', NULL),
(13, 'administrador', '35402efc55b9610986c14e4e1afeded6', '2969672cb3889790c9df3f84f84960d7', '2016-09-02 10:45:21', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_grupos`
--

CREATE TABLE `usuarios_grupos` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_grupos`
--

INSERT INTO `usuarios_grupos` (`id`, `group_id`, `user_id`) VALUES
(26, 3, 12),
(27, 1, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_permisos`
--

CREATE TABLE `usuarios_permisos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permisos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `grupos_permisos`
--
ALTER TABLE `grupos_permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_id` (`grupo_id`),
  ADD KEY `permisos_id` (`permisos_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `usuarios_grupos`
--
ALTER TABLE `usuarios_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `permisos_id` (`permisos_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `grupos_permisos`
--
ALTER TABLE `grupos_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `usuarios_grupos`
--
ALTER TABLE `usuarios_grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupos_permisos`
--
ALTER TABLE `grupos_permisos`
  ADD CONSTRAINT `grupos_permisos_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupos_permisos_ibfk_2` FOREIGN KEY (`permisos_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_grupos`
--
ALTER TABLE `usuarios_grupos`
  ADD CONSTRAINT `usuarios_grupos_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_grupos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  ADD CONSTRAINT `usuarios_permisos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_permisos_ibfk_2` FOREIGN KEY (`permisos_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
