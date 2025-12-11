-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2025
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `tienda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tienda`;

-- Tabla marcas
CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `marcas` (`id_marca`, `marca`) VALUES
(1, 'Logitech'),
(2, 'Samsung'),
(3, 'HP'),
(4, 'ASUS'),
(5, 'Kingston'),
(6, 'Lenovo'),
(7, 'Xiaomi'),
(8, 'Razer'),
(9, 'Corsair'),
(10, 'Apple');

-- Tabla productos
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `presentacion` varchar(100) NOT NULL DEFAULT '',
  `precio` decimal(7,2) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `productos` (`id_producto`, `id_marca`, `nombre`, `presentacion`, `precio`, `foto`) VALUES
(1, 1, 'Auriculares inalámbricos', 'Auriculares Inalambricos de Calidad', 351.00, '1.jpg'),
(2, 2, 'Teclado mecánico RGB', 'Teclado Mecanico de Calidad', 354.00, '2.jpg'),
(3, 1, 'Monitor 27 pulgadas', 'Monitor de Calidad', 347.00, '3.jpg'),
(4, 2, 'Mouse Gamer Inalambrico', 'Mouse Inalambrico', 349.00, '4.jpg'),
(5, 3, 'Notebook Intel i5', 'Notebook 15 pulgadas Intel i5', 352.00, '5.jpg'),
(6, 4, 'Disco SSD 1TB', 'Disco SSD de 1B NVMe', 351.50, '6.jpg'),
(7, 3, 'Smartphone 128GB', 'Smartphone Samsung de 128GB', 354.00, '7.jpg'),
(8, 5, 'Parlante Bluetooth', 'Parlante Bluetooth Portatil Bateria duradera', 380.60, '8.jpg'),
(9, 6, 'Webcam Full HD', 'Webcam inalambrica Calidad Full HD', 694.00, '9.jpg'),
(10, 7, 'Tablet Android', 'Tablet de 12 pulgadas Android 256GB', 698.00, '10.jpg'),
(11, 8, 'Macbook Pro', 'MacBook pro Apple nueva', 659.00, '11.jpg'),
(12, 5, 'Placa de video RTX 4060', 'Placa de video RTX 4060 32GB GDDR6', 481.00, '12.jpg'),
(13, 9, 'Impresora multifuncion', 'Impresora Multifuncion, wifi Bluetooth', 442.00, '13.jpg'),
(14, 5, 'Microfono USB', 'Microfono Cable 2m USB profesional', 456.00, '14.jpg'),
(15, 10, 'Microfono Inalambrico', 'Microfono Inalambrico 20m alcance Bluetooth', 448.00, '15.jpg');

-- Tabla usuarios 
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL DEFAULT '',
  `clave` varchar(255) NOT NULL,
  `nombre` varchar(20) NOT NULL DEFAULT '',
  `apellido` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `clave`, `nombre`, `apellido`) VALUES
(1, 'pepe@pepe.com', '$2y$10$XH7kDy3eGtf4W/TP6aaIb.b/IpK30Y.k.LMUxd3gKAaWvC0PtWFqK', 'Juan', 'Pérez'),
(2, 'ana@ana.com', '123', 'Ana', 'García'),
(3, 'ceci@ceci.com', '123', 'Cecilia', 'Florez'),
(4, 'car@car.com', '123', 'Carlos', 'Juarez'),
(5, 'rob@rob.com', '123', 'Roberto', 'López'),
(6, 'ram@ram.com', '123', 'Ramiro', 'García'),
(7, 'gri@gri.com', '123', 'Griselda', 'Totora'),
(8, 'clau@clau.com', '123', 'Claudia', 'Ceres'),
(9, 'van@van.com', '123', 'Vanina', 'Mieres'),
(10, 'an@an.com', '123', 'Andrés', 'López');

-- Índices
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`),
  ADD UNIQUE KEY `id_marca_unico` (`id_marca`);

ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `id_producto_unico` (`id_producto`),
  ADD KEY `pertenecen_a` (`id_marca`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_usuario_unico` (`id_usuario`),
  ADD UNIQUE KEY `usuario_unico` (`usuario`);

-- Auto increment
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

-- Relaciones
ALTER TABLE `productos`
  ADD CONSTRAINT `pertenecen_a` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;
