-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2022 a las 21:37:42
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `myb2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `send` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_applicant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_spanish_ci NOT NULL,
  `price` int(8) NOT NULL,
  `amount` int(11) NOT NULL,
  `description` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `sell_point_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `amount`, `description`, `img`, `sell_point_id`) VALUES
(1, 'cuchara', 3100, 10, 'A la simple vista de comprador que pase buscando utencilicios estas no seran mas que unas cuantas de las cucharas más comunes, nada llamativo, nada inovador, nada digno de verdadera atencion, pero para quien se fije en un producto por la calidad de su elaboracion y no solo por su apariencia podra ver que estas fueron elaboradas meticulosamente, curvas casi perfectas, tamaño y empuñadura comodos debido a su ancho un poco mas grande que los normales, ciertamente una perfectamente herramienta que nos ayudara a llevar a cabo una de las necesidad primales como lo son la alimentacion, haciendo de esta mas comoda sin alejarnos de los estanderas de la sociedad actual.', 'Raven3.jpg', 1),
(2, 'Wallpaper', 15300, 35, 'Fondos de pantalla para escritorio sin licencia comercial', '20220425_155759_raven_bird_art_131978_1600x900.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `description`) VALUES
(1, 'administrador'),
(2, 'usuario'),
(3, 'Entrenador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sell_point`
--

CREATE TABLE `sell_point` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sell_point`
--

INSERT INTO `sell_point` (`id`, `name`) VALUES
(1, 'Punto de venta (prueba)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `phone_number` text COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `pass`, `img`, `role`) VALUES
(0, 'administrador', 'admin@admin.admin', '0', '$2a$12$w4PjnYV/BY.KSqHKI7J/gOVhjWxaKqhFGs0nW9OK1g5GD/vFijYWC', 'IMG2.jpeg', 1),
(4, 'brahian', 'brahian@gmail.com', '312478945', '$2y$10$QBMgYNiRUN3562MYpbTMt.Rgpf7r4zUGHSp5e7f/bDS4Vyp0gGPvG', 'IMG2.jpeg', 2),
(18, 'brahian', 'brahians@gmail.com', '3124789650', '$2y$10$pyPRDIM4U56S0C1BT1/E/eMkzyqm702Oiu/mHKu1H8o5mLeOJX9E6', 'IMG2.jpeg', 2),
(20, 'brahian', 'bsmv@gmail.com', '3124478978', '$2y$10$uD1slg6zyRr5n0ZLOqVUTudyRQ8eGg2jwdI9ES.xlIhe19ZmAHk/K', 'IMG2.jpeg', 3),
(21, 'asd', '2d4asd@gmail.com', '312478940', '$2y$10$lvEt23xBF2qwQzW4fXVL6.J905pw/zQl4z9qucRQippbhpLZQcLKO', 'IMG2.jpeg', 2),
(23, 'Lewis', 'syl@gmail.com', '312357850', '$2y$10$lXWYVE6fD/RjVEEK3eqN4ucrPuvI0iPVeBxyjdZToibKDoRBhFmKC', 'corvus.png', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_applicant` (`id_applicant`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sell_point_id` (`sell_point_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `description` (`description`) USING HASH;

--
-- Indices de la tabla `sell_point`
--
ALTER TABLE `sell_point`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_UserRole` (`role`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sell_point`
--
ALTER TABLE `sell_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_ibfk_1` FOREIGN KEY (`id_applicant`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`sell_point_id`) REFERENCES `sell_point` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_UserRole` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
