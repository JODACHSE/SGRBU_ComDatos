-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2025 a las 05:19:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgrbu_example`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alerts`
--

CREATE TABLE `alerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `alert_status` enum('reportado','en_revision','resuelto') NOT NULL DEFAULT 'reportado',
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campuses`
--

CREATE TABLE `campuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campus_type` enum('Principal','Seccional','Extensión','Oficinas') NOT NULL DEFAULT 'Extensión',
  `department` varchar(255) NOT NULL DEFAULT 'Cundinamarca',
  `municipality` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `campuses`
--

INSERT INTO `campuses` (`id`, `campus_type`, `department`, `municipality`, `address`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Principal', 'Cundinamarca', 'Fusagasugá', 'Diagonal 18 No. 20-29', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 'Seccional', 'Cundinamarca', 'Girardot', 'Carrera 19 N.º 24 - 209', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 'Seccional', 'Cundinamarca', 'Ubaté', 'Calle 6 N.º 9 - 80', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 'Extensión', 'Cundinamarca', 'Chía', 'Autopista Chía - Cajicá / Sector \"El Cuarenta\"', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(5, 'Extensión', 'Cundinamarca', 'Facatativá', 'Calle 14 con Avenida 15', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(6, 'Extensión', 'Cundinamarca', 'Soacha', 'Diagonal 9 N.º 4B-85', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(7, 'Extensión', 'Cundinamarca', 'Zipaquirá', 'Carrera 7 N.º 1-31', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(8, 'Oficinas', 'Cundinamarca', 'Bogotá', 'Carrera 20 No. 39-32, Teusaquillo', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campus_program`
--

CREATE TABLE `campus_program` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campus_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `campus_program`
--

INSERT INTO `campus_program` (`id`, `campus_id`, `program_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 1, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 6, 1, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 2, 2, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 3, 2, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(5, 7, 2, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(6, 3, 3, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(7, 7, 3, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(8, 2, 4, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(9, 5, 4, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(10, 7, 4, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(11, 1, 5, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(12, 2, 5, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(13, 2, 6, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(14, 5, 6, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(15, 8, 6, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(16, 2, 7, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(17, 5, 7, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(18, 8, 7, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(19, 1, 8, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(20, 2, 8, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(21, 6, 8, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(22, 5, 9, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(23, 7, 9, 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contact_type_id` bigint(20) UNSIGNED NOT NULL,
  `contact_value` varchar(255) NOT NULL,
  `is_principal` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `contact_type_id`, `contact_value`, `is_principal`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 5, '3334982124', 1, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(2, 1, 2, '3392524742', 0, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(3, 1, 4, 'institucional4@university.edu', 0, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(4, 2, 3, 'personal4@example.com', 1, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(5, 2, 5, '3373211150', 0, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(6, 3, 1, '3936835970', 1, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(7, 3, 3, 'personal3@example.com', 0, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(8, 3, 5, '3626604779', 0, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(9, 4, 4, 'institucional2@university.edu', 1, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(10, 4, 1, '3653001543', 0, 1, '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_types`
--

CREATE TABLE `contact_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contact_types`
--

INSERT INTO `contact_types` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Teléfono móvil', 'Número de celular personal', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 'Teléfono fijo', 'Número de teléfono fijo', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 'Correo personal', 'Correo electrónico personal', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 'Correo institucional', 'Correo electrónico universitario', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(5, 'WhatsApp', 'Número de WhatsApp', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(6, 'Facebook', 'Perfil de Facebook', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_types`
--

CREATE TABLE `document_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `document_types`
--

INSERT INTO `document_types` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cédula de Ciudadanía', 'Documento nacional de identidad colombiano', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 'Tarjeta de Identidad', 'Documento para menores de edad', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 'Cédula de Extranjería', 'Documento para extranjeros en Colombia', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 'Pasaporte', 'Documento para viajes internacionales', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(5, 'Registro Civil', 'Documento de identificación para recién nacidos', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genders`
--

CREATE TABLE `genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `genders`
--

INSERT INTO `genders` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Masculino', 'Género masculino', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 'Femenino', 'Género femenino', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 'No binario', 'Persona no binaria', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 'Prefiero no decir', 'No especificado', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `campus_id` bigint(20) UNSIGNED NOT NULL,
  `loan_date` datetime NOT NULL,
  `expected_return_date` datetime NOT NULL,
  `actual_return_date` datetime DEFAULT NULL,
  `loan_status` enum('pendiente','aprovado','activo','completado','vencido','cancelado') NOT NULL DEFAULT 'pendiente',
  `notes` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_evidences`
--

CREATE TABLE `loan_evidences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_resource_id` bigint(20) UNSIGNED NOT NULL,
  `loan_type` enum('prestamo','devuelución') NOT NULL DEFAULT 'prestamo',
  `photo_path` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_resources`
--

CREATE TABLE `loan_resources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `resource_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `programs`
--

INSERT INTO `programs` (`id`, `program_type_id`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Ingeniería de Sistemas', 'Ingeniería en desarrollo de software y TI', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 1, 'Administración de Empresas', 'Gestión y dirección empresarial', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 1, 'Contaduría Pública', 'Contabilidad y auditoría financiera', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 1, 'Derecho', 'Ciencias jurídicas y legales', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(5, 1, 'Psicología', 'Ciencias del comportamiento humano', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(6, 3, 'Tecnología en Desarrollo de Software', 'Desarrollo de aplicaciones y sistemas', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(7, 3, 'Tecnología en Gestión Empresarial', 'Gestión de pequeñas y medianas empresas', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(8, 2, 'Maestría en Educación', 'Maestría en ciencias de la educación', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(9, 2, 'Especialización en Gerencia de Proyectos', 'Especialización en dirección de proyectos', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `program_types`
--

CREATE TABLE `program_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `program_types`
--

INSERT INTO `program_types` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pregrado', 'Programas de grado universitario', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 'Posgrado', 'Especializaciones, maestrías y doctorados', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 'Tecnología', 'Programas tecnológicos', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 'Técnico', 'Programas técnicos laborales', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(5, 'Diplomado', 'Programas de educación continua', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

CREATE TABLE `resources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campus_id` bigint(20) UNSIGNED NOT NULL,
  `resource_type_id` bigint(20) UNSIGNED NOT NULL,
  `resource_status_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `resource_code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`id`, `campus_id`, `resource_type_id`, `resource_status_id`, `name`, `resource_code`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'Balón de Fútbol', 'DEP-FUT-001', 'Balón oficial tamaño 5 para fútbol', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 1, 1, 1, 'Balón de Baloncesto', 'DEP-BAS-001', 'Balón de baloncesto tamaño oficial', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 2, 1, 1, 'Balón de Voleibol', 'DEP-VOL-001', 'Balón de voleibol profesional', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 1, 1, 3, 'Balón de Fútbol Sala', 'DEP-FUTS-001', 'Balón para fútbol sala', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(5, 1, 1, 1, 'Raqueta de Tenis', 'DEP-TEN-001', 'Raqueta de tenis profesional', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(6, 3, 1, 1, 'Raqueta de Bádminton', 'DEP-BAD-001', 'Raqueta de bádminton con volantes', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(7, 2, 1, 1, 'Paletas de Ping Pong', 'DEP-PING-001', 'Set de 2 paletas y pelotas de ping pong', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(8, 1, 1, 1, 'Balón Medicinal 5kg', 'DEP-MED-001', 'Balón medicinal para entrenamiento', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(9, 1, 1, 1, 'Cuerda para Saltar', 'DEP-CUER-001', 'Cuerda profesional para saltar', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(10, 2, 1, 4, 'Vallas de Atletismo', 'DEP-VALL-001', 'Set de 5 vallas para atletismo', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(11, 1, 2, 1, 'Guitarra Acústica', 'MUS-GUIT-001', 'Guitarra acústica para principiantes', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(12, 3, 2, 1, 'Teclado Digital', 'MUS-TECL-001', 'Teclado electrónico 61 teclas', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(13, 1, 2, 2, 'Batería Electrónica', 'MUS-BAT-001', 'Batería electrónica compacta', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(14, 2, 2, 1, 'Flauta Dulce', 'MUS-FLAU-001', 'Flauta dulce soprano', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(15, 1, 2, 3, 'Micrófono Profesional', 'MUS-MIC-001', 'Micrófono para voces e instrumentos', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(16, 1, 3, 1, 'Ajedrez', 'JUE-AJED-001', 'Juego de ajedrez profesional', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(17, 2, 3, 1, 'Cartas Españolas', 'JUE-CART-001', 'Baraja de cartas españolas', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(18, 3, 3, 1, 'Jenga', 'JUE-JENG-001', 'Juego de torre de madera', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(19, 1, 3, 1, 'Dominó', 'JUE-DOM-001', 'Juego de dominó clásico', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(20, 2, 3, 1, 'Uno', 'JUE-UNO-001', 'Juego de cartas Uno oficial', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource_statuses`
--

CREATE TABLE `resource_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `resource_statuses`
--

INSERT INTO `resource_statuses` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Disponible', 'Recurso disponible para préstamo', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 'Prestado', 'Recurso actualmente en préstamo', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 'Mantenimiento', 'Recurso en mantenimiento o reparación', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 'Dañado', 'Recurso dañado fuera de servicio', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(5, 'Reservado', 'Recurso reservado para próximo préstamo', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource_types`
--

CREATE TABLE `resource_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `resource_types`
--

INSERT INTO `resource_types` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Deportivo', 'Equipos y materiales para actividades deportivas', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(2, 'Instrumento Musical', 'Instrumentos para práctica musical', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(3, 'Juego de Mesa', 'Juegos de entretenimiento y estrategia', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(4, 'Audiovisual', 'Equipos de sonido y video', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL),
(5, 'Educativo', 'Materiales para apoyo educativo', 1, '2025-11-13 09:14:58', '2025-11-13 09:14:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `second_lastname` varchar(255) DEFAULT NULL,
  `document_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `identification_number` varchar(255) NOT NULL,
  `gender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emergency_contact_name` varchar(255) NOT NULL,
  `emergency_contact_phone` varchar(255) NOT NULL,
  `role` enum('admin','staff','profesor','estudiante') NOT NULL DEFAULT 'estudiante',
  `campus_program_id` bigint(20) UNSIGNED DEFAULT NULL,
  `academic_status` enum('activo','baja temporal','baja permanente','condicional','egresado') NOT NULL DEFAULT 'activo',
  `student_code` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `second_name`, `lastname`, `second_lastname`, `document_type_id`, `identification_number`, `gender_id`, `emergency_contact_name`, `emergency_contact_phone`, `role`, `campus_program_id`, `academic_status`, `student_code`, `is_active`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, 'User', NULL, 1, '123456789', 1, 'Emergency Contact', '1234567890', 'admin', NULL, 'activo', NULL, 1, 'admin@example.com', '2025-11-13 09:15:01', '$2y$12$nvtHl.k9cnAmvVJ6SSB/i.F0nL6rYiHl4tSFpmZqGR3qemYZPYc7S', 'lcNgM45KC0', '2025-11-13 09:15:01', '2025-11-13 09:15:01', NULL),
(2, 'Staff', NULL, 'User', NULL, 1, '987654321', 2, 'Emergency Contact', '0987654321', 'staff', NULL, 'activo', NULL, 1, 'staff@example.com', '2025-11-13 09:15:01', '$2y$12$.mH7Rw1gAM0FJEQ4YNzvWOduoZC2kE1hXd.2XAdWUqz5GmLs7lLVW', 'UOtFCpUZjS', '2025-11-13 09:15:01', '2025-11-13 09:15:01', NULL),
(3, 'Estudiante', NULL, 'User', NULL, 1, '111222333', 1, 'Emergency Contact', '1112223333', 'estudiante', 1, 'activo', 'EST2024001', 1, 'estudiante@example.com', '2025-11-13 09:15:02', '$2y$12$N76IObxi3.8jia1kopzimeKplItM.wMT/Lpv5IT7dREhkUnBWiUza', 'BTtxOviJur', '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL),
(4, 'Teacher', NULL, 'User', NULL, 1, '444555666', 2, 'Emergency Contact', '4445556666', 'profesor', NULL, 'activo', NULL, 1, 'profesor@example.com', '2025-11-13 09:15:02', '$2y$12$rnKJgW1jzdnqvabpwVnfFORyIeJ8LQIiyMFbyEwWNwwK.pGOYeEw2', 'U3Dk5Xkz9o', '2025-11-13 09:15:02', '2025-11-13 09:15:02', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alerts_user_id_foreign` (`user_id`),
  ADD KEY `alerts_loan_id_foreign` (`loan_id`);

--
-- Indices de la tabla `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campuses_campus_type_department_municipality_address_unique` (`campus_type`,`department`,`municipality`,`address`);

--
-- Indices de la tabla `campus_program`
--
ALTER TABLE `campus_program`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campus_program_campus_id_program_id_unique` (`campus_id`,`program_id`),
  ADD KEY `campus_program_program_id_foreign` (`program_id`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contacts_user_id_contact_type_id_contact_value_unique` (`user_id`,`contact_type_id`,`contact_value`),
  ADD KEY `contacts_contact_type_id_foreign` (`contact_type_id`);

--
-- Indices de la tabla `contact_types`
--
ALTER TABLE `contact_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_foreign` (`user_id`),
  ADD KEY `loans_campus_id_foreign` (`campus_id`);

--
-- Indices de la tabla `loan_evidences`
--
ALTER TABLE `loan_evidences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_evidences_loan_resource_id_foreign` (`loan_resource_id`);

--
-- Indices de la tabla `loan_resources`
--
ALTER TABLE `loan_resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_resources_loan_id_foreign` (`loan_id`),
  ADD KEY `loan_resources_resource_id_foreign` (`resource_id`);

--
-- Indices de la tabla `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_program_type_id_foreign` (`program_type_id`);

--
-- Indices de la tabla `program_types`
--
ALTER TABLE `program_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resources_resource_code_unique` (`resource_code`),
  ADD KEY `resources_campus_id_foreign` (`campus_id`),
  ADD KEY `resources_resource_type_id_foreign` (`resource_type_id`),
  ADD KEY `resources_resource_status_id_foreign` (`resource_status_id`);

--
-- Indices de la tabla `resource_statuses`
--
ALTER TABLE `resource_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resource_types`
--
ALTER TABLE `resource_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_identification_number_unique` (`identification_number`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_student_code_unique` (`student_code`),
  ADD KEY `users_document_type_id_foreign` (`document_type_id`),
  ADD KEY `users_gender_id_foreign` (`gender_id`),
  ADD KEY `users_campus_program_id_foreign` (`campus_program_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `campuses`
--
ALTER TABLE `campuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `campus_program`
--
ALTER TABLE `campus_program`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `contact_types`
--
ALTER TABLE `contact_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loan_evidences`
--
ALTER TABLE `loan_evidences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loan_resources`
--
ALTER TABLE `loan_resources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `program_types`
--
ALTER TABLE `program_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `resources`
--
ALTER TABLE `resources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `resource_statuses`
--
ALTER TABLE `resource_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `resource_types`
--
ALTER TABLE `resource_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `alerts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `campus_program`
--
ALTER TABLE `campus_program`
  ADD CONSTRAINT `campus_program_campus_id_foreign` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`),
  ADD CONSTRAINT `campus_program_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`);

--
-- Filtros para la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_contact_type_id_foreign` FOREIGN KEY (`contact_type_id`) REFERENCES `contact_types` (`id`),
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_campus_id_foreign` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`),
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `loan_evidences`
--
ALTER TABLE `loan_evidences`
  ADD CONSTRAINT `loan_evidences_loan_resource_id_foreign` FOREIGN KEY (`loan_resource_id`) REFERENCES `loan_resources` (`id`);

--
-- Filtros para la tabla `loan_resources`
--
ALTER TABLE `loan_resources`
  ADD CONSTRAINT `loan_resources_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `loan_resources_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`);

--
-- Filtros para la tabla `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_program_type_id_foreign` FOREIGN KEY (`program_type_id`) REFERENCES `program_types` (`id`);

--
-- Filtros para la tabla `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_campus_id_foreign` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`),
  ADD CONSTRAINT `resources_resource_status_id_foreign` FOREIGN KEY (`resource_status_id`) REFERENCES `resource_statuses` (`id`),
  ADD CONSTRAINT `resources_resource_type_id_foreign` FOREIGN KEY (`resource_type_id`) REFERENCES `resource_types` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_campus_program_id_foreign` FOREIGN KEY (`campus_program_id`) REFERENCES `campus_program` (`id`),
  ADD CONSTRAINT `users_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`),
  ADD CONSTRAINT `users_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
