-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2023 a las 23:11:29
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `puntos_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_actividad`
--

CREATE TABLE `tb_actividad` (
  `id` int(11) NOT NULL,
  `actividad` varchar(100) NOT NULL,
  `puntos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_canjes`
--

CREATE TABLE `tb_canjes` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_regalo` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cargo`
--

CREATE TABLE `tb_cargo` (
  `id` int(11) NOT NULL,
  `cargo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tb_cargo`
--

INSERT INTO `tb_cargo` (`id`, `cargo`) VALUES
(1, 'Responsable'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_departamento`
--

CREATE TABLE `tb_departamento` (
  `id` int(11) NOT NULL,
  `id_responsable` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empleado`
--

CREATE TABLE `tb_empleado` (
  `id` int(11) NOT NULL,
  `tipo_docu` varchar(20) NOT NULL,
  `num_docu` varchar(20) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_puntos`
--

CREATE TABLE `tb_puntos` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_regalos`
--

CREATE TABLE `tb_regalos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `puntos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_emple` int(11) NOT NULL DEFAULT 0,
  `id_cargo` int(11) DEFAULT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sts_usuario` char(2) COLLATE utf8mb4_unicode_ci DEFAULT 'AC',
  `id_usuarioelim` int(11) NOT NULL DEFAULT 0,
  `motivo_elim` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `id_emple`, `id_cargo`, `nombre_usuario`, `email`, `email_verified_at`, `password`, `remember_token`, `sts_usuario`, `id_usuarioelim`, `motivo_elim`, `deleted_at`, `created_at`, `updated_at`) VALUES
(45, 0, 1, 'Daniel Alcalá', 'socialmedia@jumpin.com.mx', NULL, '$2y$10$TF2DBAnWTs7b0KOGzCleeuPtU5.p7bGVbKnhFsH2FRrMjo4bdEwh6', NULL, 'AC', 0, '', NULL, '2023-10-20 22:10:03', '2023-10-20 22:10:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_actividad`
--
ALTER TABLE `tb_actividad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_canjes`
--
ALTER TABLE `tb_canjes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_regalo` (`id_regalo`);

--
-- Indices de la tabla `tb_cargo`
--
ALTER TABLE `tb_cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_departamento`
--
ALTER TABLE `tb_departamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_responsable` (`id_responsable`);

--
-- Indices de la tabla `tb_empleado`
--
ALTER TABLE `tb_empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `tb_puntos`
--
ALTER TABLE `tb_puntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indices de la tabla `tb_regalos`
--
ALTER TABLE `tb_regalos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_actividad`
--
ALTER TABLE `tb_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tb_canjes`
--
ALTER TABLE `tb_canjes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tb_cargo`
--
ALTER TABLE `tb_cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_departamento`
--
ALTER TABLE `tb_departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tb_empleado`
--
ALTER TABLE `tb_empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tb_puntos`
--
ALTER TABLE `tb_puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tb_regalos`
--
ALTER TABLE `tb_regalos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_canjes`
--
ALTER TABLE `tb_canjes`
  ADD CONSTRAINT `tb_canjes_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `tb_empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_canjes_ibfk_2` FOREIGN KEY (`id_regalo`) REFERENCES `tb_regalos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_departamento`
--
ALTER TABLE `tb_departamento`
  ADD CONSTRAINT `tb_departamento_ibfk_1` FOREIGN KEY (`id_responsable`) REFERENCES `tb_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_empleado`
--
ALTER TABLE `tb_empleado`
  ADD CONSTRAINT `tb_empleado_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `tb_departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_puntos`
--
ALTER TABLE `tb_puntos`
  ADD CONSTRAINT `tb_puntos_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `tb_empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_puntos_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `tb_actividad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `tb_usuario_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `tb_cargo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
