-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2018 a las 22:34:17
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `optica421`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_menus`
--

CREATE TABLE `sys_menus` (
  `menus_id_i` int(50) NOT NULL,
  `menus_html_href_v` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `menus_html_icon_v` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `menus_nombre_v` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `menus_treeview_i` int(10) DEFAULT NULL,
  `menus_superadmin` int(10) DEFAULT '0',
  `menus_order_i` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sys_menus`
--

INSERT INTO `sys_menus` (`menus_id_i`, `menus_html_href_v`, `menus_html_icon_v`, `menus_nombre_v`, `menus_treeview_i`, `menus_superadmin`, `menus_order_i`) VALUES
(1, 'inicio', 'fa fa-dashboard', 'Inicio', 0, 1, 1),
(2, 'pacientes', 'fa fa-circle-o', 'Pacientes', 0, 1, 2),
(3, 'historias', 'fa fa-circle-o', 'Historial clinico', 0, 1, 3),
(4, 'usuarios', 'fa fa-circle-o', 'Usuarios', 0, 1, 4),
(5, 'optometra', 'fa fa-circle-o', 'Optómetra', 0, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_opciones`
--

CREATE TABLE `sys_opciones` (
  `opciones_id_i` int(50) NOT NULL,
  `opciones_menus_id_i` int(50) DEFAULT NULL,
  `opciones_html_href_v` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `opciones_html_icon_v` varchar(255) CHARACTER SET utf8 DEFAULT 'fa fa-circle-o',
  `opciones_nombre_v` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `opciones_superadmin` int(10) DEFAULT '0',
  `opciones_padre_id_i` int(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_perfiles`
--

CREATE TABLE `sys_perfiles` (
  `perfiles_id_i` int(50) NOT NULL,
  `perfiles_proyectos_id_i` int(50) DEFAULT NULL,
  `perfiles_descripcion_v` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `perfilies_estado_i` int(50) DEFAULT '0',
  `perfiles_adiciona_i` int(11) DEFAULT '0',
  `perfiles_edita_i` int(11) DEFAULT '0',
  `perfiles_elimina_i` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sys_perfiles`
--

INSERT INTO `sys_perfiles` (`perfiles_id_i`, `perfiles_proyectos_id_i`, `perfiles_descripcion_v`, `perfilies_estado_i`, `perfiles_adiciona_i`, `perfiles_edita_i`, `perfiles_elimina_i`) VALUES
(3, 1, 'Administrador', 1, 1, 1, 1),
(4, 1, 'Usuario', 1, 1, 0, 0),
(7, 1, 'Optómetra', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_perfiles_permisos`
--

CREATE TABLE `sys_perfiles_permisos` (
  `perfiles_permisos_id_i` int(50) NOT NULL,
  `perfiles_permisos_perfil_id_i` int(50) DEFAULT NULL,
  `perfiles_permisos_menu_id_i` int(50) DEFAULT NULL,
  `perfiles_permisos_opciones_id_i` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sys_perfiles_permisos`
--

INSERT INTO `sys_perfiles_permisos` (`perfiles_permisos_id_i`, `perfiles_permisos_perfil_id_i`, `perfiles_permisos_menu_id_i`, `perfiles_permisos_opciones_id_i`) VALUES
(1, 3, 1, '1'),
(2, 3, 2, '1'),
(3, 3, 3, '1'),
(4, 3, 4, '1'),
(5, 3, 5, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sys_menus`
--
ALTER TABLE `sys_menus`
  ADD PRIMARY KEY (`menus_id_i`);

--
-- Indices de la tabla `sys_opciones`
--
ALTER TABLE `sys_opciones`
  ADD PRIMARY KEY (`opciones_id_i`);

--
-- Indices de la tabla `sys_perfiles`
--
ALTER TABLE `sys_perfiles`
  ADD PRIMARY KEY (`perfiles_id_i`);

--
-- Indices de la tabla `sys_perfiles_permisos`
--
ALTER TABLE `sys_perfiles_permisos`
  ADD PRIMARY KEY (`perfiles_permisos_id_i`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sys_menus`
--
ALTER TABLE `sys_menus`
  MODIFY `menus_id_i` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sys_opciones`
--
ALTER TABLE `sys_opciones`
  MODIFY `opciones_id_i` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sys_perfiles`
--
ALTER TABLE `sys_perfiles`
  MODIFY `perfiles_id_i` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sys_perfiles_permisos`
--
ALTER TABLE `sys_perfiles_permisos`
  MODIFY `perfiles_permisos_id_i` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
