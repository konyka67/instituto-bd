-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-09-2020 a las 16:07:31
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `instituto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_materias`
--

CREATE TABLE `asignacion_materias` (
  `id_profesor` int(10) UNSIGNED NOT NULL,
  `id_materia` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asig_profe_asigs`
--

CREATE TABLE `asig_profe_asigs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_programa` int(10) UNSIGNED NOT NULL,
  `id_profesor` int(10) UNSIGNED DEFAULT NULL,
  `id_plan` int(10) UNSIGNED NOT NULL,
  `id_salon` int(10) UNSIGNED NOT NULL,
  `id_materia` int(10) UNSIGNED NOT NULL,
  `cupos` int(10) UNSIGNED NOT NULL,
  `grupo` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asig_profe_asigs`
--

INSERT INTO `asig_profe_asigs` (`id`, `id_programa`, `id_profesor`, `id_plan`, `id_salon`, `id_materia`, `cupos`, `grupo`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 1, 50, 1, '2020-05-26 02:49:59', '2020-05-26 02:49:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion_corte_es`
--

CREATE TABLE `calificacion_corte_es` (
  `cortes` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `id_programa` int(10) UNSIGNED NOT NULL,
  `id_materia` int(10) UNSIGNED NOT NULL,
  `id_plan` int(10) UNSIGNED NOT NULL,
  `calificacion` double(1,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objetivo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mision` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `creditos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudads`
--

CREATE TABLE `ciudads` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_departamento` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudads`
--

INSERT INTO `ciudads` (`id`, `nombre`, `id_departamento`, `created_at`, `updated_at`) VALUES
(1, 'BOGOTÁ', 1, '2020-05-25 19:14:30', '2020-05-25 19:14:30'),
(2, 'ANTONIO NARIÑO', 1, '2020-05-25 22:25:55', '2020-05-25 22:25:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `key` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_medium` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_long` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`key`, `foto`, `value`, `value_medium`, `value_long`, `created_at`, `updated_at`) VALUES
('logo', NULL, 'default_logo.png', NULL, NULL, '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
('titulo', NULL, 'Institución', NULL, NULL, '2020-05-25 19:14:31', '2020-05-25 19:14:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pais` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `id_pais`, `created_at`, `updated_at`) VALUES
(1, 'BOGOTÁ', 1, '2020-05-25 19:14:30', '2020-05-25 19:14:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuelas`
--

CREATE TABLE `escuelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sede` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `escuelas`
--

INSERT INTO `escuelas` (`id`, `nombre`, `id_sede`, `created_at`, `updated_at`) VALUES
(1, 'Ingenieria', 1, '2020-05-26 02:01:06', '2020-05-26 02:01:06'),
(2, 'Derecho', 1, '2020-05-26 02:01:17', '2020-05-26 02:01:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela_programas`
--

CREATE TABLE `escuela_programas` (
  `id_programa` int(10) UNSIGNED NOT NULL,
  `id_escuela` int(10) UNSIGNED NOT NULL,
  `anio_vigencia_inicial` int(11) NOT NULL,
  `anio_vigencia_final` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `escuela_programas`
--

INSERT INTO `escuela_programas` (`id_programa`, `id_escuela`, `anio_vigencia_inicial`, `anio_vigencia_final`, `created_at`, `updated_at`) VALUES
(1, 1, 2001, 9999, '2020-05-26 02:36:53', '2020-05-26 02:36:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela_usuarios`
--

CREATE TABLE `escuela_usuarios` (
  `id_programa` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_escuela` int(10) UNSIGNED NOT NULL,
  `anio_vigencia_inicial` int(11) NOT NULL,
  `anio_vigencia_final` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_escuela` int(10) UNSIGNED NOT NULL,
  `id_materia` int(10) UNSIGNED NOT NULL,
  `id_profesor` int(10) UNSIGNED NOT NULL,
  `numero` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion_asig_es`
--

CREATE TABLE `inscripcion_asig_es` (
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `id_programacion` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inscripcion_asig_es`
--

INSERT INTO `inscripcion_asig_es` (`id_estudiante`, `id_programacion`, `created_at`, `updated_at`) VALUES
(2, 1, '2020-05-25 05:00:00', '2020-05-25 05:00:00'),
(3, 1, '2020-05-25 05:00:00', '2020-05-25 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localizacions`
--

CREATE TABLE `localizacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitud` decimal(10,7) NOT NULL,
  `longitud` decimal(10,7) NOT NULL,
  `id_ciudad` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `localizacions`
--

INSERT INTO `localizacions` (`id`, `direccion`, `latitud`, `longitud`, `id_ciudad`, `created_at`, `updated_at`) VALUES
(1, 'DG. 4A #174A24', '4.5972098', '-74.0887461', 1, '2020-05-25 19:14:30', '2020-05-25 19:14:30'),
(2, 'DG. 4A #174A24', '4.5972098', '-74.0887461', 2, '2020-05-25 22:25:55', '2020-05-25 22:25:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credito` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `credito`, `created_at`, `updated_at`) VALUES
(1, 'Calculo I', 2, '2020-05-25 19:14:30', '2020-05-25 19:14:30'),
(2, 'Calculo II', 2, '2020-05-25 19:14:30', '2020-05-25 19:14:30'),
(3, 'Algoritmos y Programación', 4, '2020-05-26 02:02:26', '2020-05-26 02:02:26'),
(4, 'Cálculo I', 4, '2020-05-26 02:02:35', '2020-05-26 02:02:35'),
(5, 'Cátedra Universidad y Entorno', 3, '2020-05-26 02:02:43', '2020-05-26 02:02:43'),
(6, 'Competencias Comunicativas', 4, '2020-05-26 02:03:04', '2020-05-26 02:03:04'),
(7, 'Socio Humanística I', 3, '2020-05-26 02:03:09', '2020-05-26 02:03:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_lineas`
--

CREATE TABLE `materias_lineas` (
  `id_materia_origen` int(10) UNSIGNED NOT NULL,
  `id_materia` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_carrera` int(10) UNSIGNED NOT NULL,
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `id_sede` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2014_10_12_100000_create_users_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_04_100001_create_pais_table', 1),
(5, '2020_03_04_100002_create_departamentos_table', 1),
(6, '2020_03_04_100003_create_ciudads_table', 1),
(7, '2020_03_04_100005_create_localizacions_table', 1),
(8, '2020_03_04_100006_create_carreras_table', 1),
(9, '2020_03_04_100007_create_sedes_table', 1),
(10, '2020_03_04_100008_create_roles_table', 1),
(11, '2020_03_04_100008_create_usuarios_table', 1),
(12, '2020_03_04_100009_create_matriculas_table', 1),
(13, '2020_03_04_100009_create_rol_usuarios_table', 1),
(14, '2020_03_04_100010_create_escuelas_table', 1),
(15, '2020_03_04_100012_create_materias_table', 1),
(16, '2020_03_04_100013_create_materias_lineas_table', 1),
(17, '2020_03_04_100014_create_asignacion_materias_table', 1),
(18, '2020_03_04_100014_create_nivel_academicos_table', 1),
(19, '2020_03_04_100015_create_programas_table', 1),
(20, '2020_03_04_100016_create_escuela_usuarios_table', 1),
(21, '2020_03_04_100016_create_semestres_table', 1),
(22, '2020_03_04_100017_create_areas_table', 1),
(23, '2020_03_04_100018_create_grupos_table', 1),
(24, '2020_03_04_100018_create_planes_table', 1),
(25, '2020_03_04_100019_create_multimedias_table', 1),
(26, '2020_03_04_100019_create_noticias_table', 1),
(27, '2020_03_04_100019_create_plan_periodos_table', 1),
(28, '2020_03_04_100020_create_modalidads_table', 1),
(29, '2020_03_04_100020_create_multimedia_noticias_table', 1),
(30, '2020_03_04_100020_create_plan_estudios_table', 1),
(31, '2020_03_04_100020_create_salons_table', 1),
(32, '2020_03_04_100021_create_asig_profe_asigs_table', 1),
(33, '2020_03_04_100021_create_calificacion_corte_es_table', 1),
(34, '2020_03_04_100021_create_configuraciones_table', 1),
(35, '2020_03_04_100021_create_escuela_programas_table', 1),
(36, '2020_03_04_100021_create_modalidad_programas_table', 1),
(37, '2020_03_04_100021_create_objetivos_table', 1),
(38, '2020_03_04_100021_create_programacion_horarios_table', 1),
(39, '2020_03_04_100022_create_inscripcion_asig_es_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidads`
--

CREATE TABLE `modalidads` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('PRE','DIS','VIR','OTR') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modalidads`
--

INSERT INTO `modalidads` (`id`, `tipo`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'VIR', 'Virtual', 'Virtual', '2020-05-26 02:03:32', '2020-05-26 02:03:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad_programas`
--

CREATE TABLE `modalidad_programas` (
  `id_modalidad` int(10) UNSIGNED NOT NULL,
  `id_programa` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modalidad_programas`
--

INSERT INTO `modalidad_programas` (`id_modalidad`, `id_programa`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-05-26 02:37:04', '2020-05-26 02:37:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedias`
--

CREATE TABLE `multimedias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia_noticias`
--

CREATE TABLE `multimedia_noticias` (
  `id_noticia` int(10) UNSIGNED NOT NULL,
  `id_multimedia` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_academicos`
--

CREATE TABLE `nivel_academicos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('DO','MA','ES','POS','PRO','TECNO','TECNI') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nivel_academicos`
--

INSERT INTO `nivel_academicos` (`id`, `nombre`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Doctorado', 'DO', '2020-05-25 19:23:03', '2020-05-25 19:23:16'),
(2, 'Pregrado', 'PRO', '2020-05-26 02:07:11', '2020-05-26 02:07:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_estudiantes`
--

CREATE TABLE `nota_estudiantes` (
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `id_plan` int(10) UNSIGNED NOT NULL,
  `id_profesor` int(10) UNSIGNED NOT NULL,
  `nota_1` int(11) NOT NULL,
  `nota_2` int(11) NOT NULL,
  `nota_definitiva` int(11) NOT NULL,
  `aplico` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivos`
--

CREATE TABLE `objetivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_programa` int(10) UNSIGNED NOT NULL,
  `id_general` int(10) UNSIGNED DEFAULT NULL,
  `texto` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'COLOMBIA', '2020-05-25 19:14:30', '2020-05-25 19:14:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'CUATRIMESTRAL', '2020-05-25 19:14:30', '2020-05-25 19:14:30'),
(2, 'SEMESTRAL', '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
(3, 'ANUAL', '2020-05-25 19:14:31', '2020-05-25 19:14:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_estudios`
--

CREATE TABLE `plan_estudios` (
  `id_programa` int(10) UNSIGNED NOT NULL,
  `id_materia` int(10) UNSIGNED NOT NULL,
  `id_area` int(10) UNSIGNED DEFAULT NULL,
  `id_plan` int(10) UNSIGNED NOT NULL,
  `periodo` tinyint(3) UNSIGNED NOT NULL,
  `fecha_inicial` int(10) UNSIGNED NOT NULL,
  `fecha_hasta` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plan_estudios`
--

INSERT INTO `plan_estudios` (`id_programa`, `id_materia`, `id_area`, `id_plan`, `periodo`, `fecha_inicial`, `fecha_hasta`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 2, 1, 20010101, 20200101, '2020-05-26 02:38:06', '2020-05-26 02:38:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_periodos`
--

CREATE TABLE `plan_periodos` (
  `id_plan` int(10) UNSIGNED NOT NULL,
  `periodo` tinyint(3) UNSIGNED NOT NULL,
  `fecha_inicial` int(10) UNSIGNED NOT NULL,
  `fecha_final` int(10) UNSIGNED NOT NULL,
  `ano_gravable` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_horarios`
--

CREATE TABLE `programacion_horarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_asig_profe` int(10) UNSIGNED NOT NULL,
  `dia` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_inicial` time NOT NULL,
  `hora_final` time NOT NULL,
  `fecha_inicial` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `programacion_horarios`
--

INSERT INTO `programacion_horarios` (`id`, `id_asig_profe`, `dia`, `hora_inicial`, `hora_final`, `fecha_inicial`, `fecha_final`, `created_at`, `updated_at`) VALUES
(1, 1, 'Martes', '10:00:00', '12:00:00', '2020-05-04 05:00:00', '2020-05-10 23:59:00', '2020-05-26 02:53:57', '2020-05-26 02:53:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_nivel` int(10) UNSIGNED NOT NULL,
  `mision` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vision` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `justificacion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competencias` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perfiles` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caracteristicas` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `propositos` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `nombre`, `id_nivel`, `mision`, `vision`, `justificacion`, `description`, `competencias`, `perfiles`, `caracteristicas`, `propositos`, `created_at`, `updated_at`) VALUES
(1, 'Ingeniera de sistemas', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-26 02:32:38', '2020-05-26 02:32:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('ES','AD','PR','SE') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `tipo`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'AD', 'Administrador', 'administrador del sistema tiene todos los privilegios.', '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
(2, 'PR', 'Profesor', 'Profesor de la entidad.', '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
(3, 'ES', 'Estudiante', 'Estudiante de la entidad.', '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
(4, 'SE', 'Secretaria(o)', 'Secretario tiene los privilegios suficientes para soportar el sistema.', '2020-05-25 19:14:31', '2020-05-25 19:14:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuarios`
--

CREATE TABLE `rol_usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_rol` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol_usuarios`
--

INSERT INTO `rol_usuarios` (`id_usuario`, `id_rol`, `created_at`, `updated_at`) VALUES
(1, 2, '2020-05-25 05:00:00', '2020-05-25 05:00:00'),
(2, 3, '2020-05-25 05:00:00', '2020-05-25 05:00:00'),
(3, 3, '2020-05-25 05:00:00', '2020-05-25 05:00:00'),
(4, 1, '2020-05-25 19:14:31', '2020-05-25 19:14:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salons`
--

CREATE TABLE `salons` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sede` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `salons`
--

INSERT INTO `salons` (`id`, `nombre`, `id_sede`, `created_at`, `updated_at`) VALUES
(1, 'RA-305', 1, '2020-05-26 02:00:25', '2020-05-26 02:00:25'),
(2, 'C-101', 1, '2020-05-26 02:00:40', '2020-05-26 02:00:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_localizacion` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `nombre`, `id_localizacion`, `created_at`, `updated_at`) VALUES
(1, 'Sede Centro Bogota', 2, '2020-05-25 22:25:55', '2020-05-25 22:25:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres`
--

CREATE TABLE `semestres` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_uno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_dos` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido_uno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_dos` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` enum('ES','AD','PR','SE') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_localizacion` int(10) UNSIGNED DEFAULT NULL,
  `fechanacimiento` datetime DEFAULT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `sex` enum('F','M','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `nombre_uno`, `nombre_dos`, `apellido_uno`, `apellido_dos`, `tipo`, `email`, `password`, `cedula`, `telefono`, `celular`, `id_localizacion`, `fechanacimiento`, `foto`, `sex`, `created_at`, `updated_at`) VALUES
(1, 'Carol Tatiana Rodriguez Becerra', 'Carol', 'Tatiana', 'Rodriguez', 'Becerra', 'PR', 'tatiana@gmail.com', '$2y$10$xN7C1iK2mPER2GqEtB8abOl3MYBObKg7yC3bWaeBFMrh2L6.8pEW6', '1282353929', NULL, '3115907753', 1, NULL, 'default.png', 'F', '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
(2, 'Candida Rosa Tamayo', 'candida', 'rosa', 'tamayo', '', 'ES', 'rosa@gmail.com', '$2y$10$Bax9bMtHPFvRq58QQ1KUJeaR1mijq9l8qi.CfPTOVVztYBp8/yV3u', '1022353929', NULL, '3115907753', 1, NULL, 'default.png', 'F', '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
(3, 'Nancy Jhoanna Becerra Tamayo', 'Nancy', 'Jhoanna', 'Becerra', 'Tamayo', 'ES', 'nancy@gmail.com', '$2y$10$AMaY4noracoVufCT7fMReO5BVn1NN7SGDr2GdYYmX9OdpPgm3fHjq', '1122353929', NULL, '3115907753', 1, NULL, 'default.png', 'F', '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
(4, 'juan camilo rodriguez diaz', 'juan', 'camilo', 'rodriguez', 'diaz', 'AD', 'admin@gmail.com', '$2y$10$OYmz7hcDfCeA19gO6x/cJufkB4tjJhSZwAxodXBpzjkbRDx3LBaiq', '1022353924', NULL, '3115907753', 1, NULL, 'default.png', 'M', '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
(5, 'constanza becerra tamayo', 'constanza', '', 'becerra', 'tamayo', 'PR', 'ing.constanza1@gmail.com', '$2y$10$8sP9/GnUT62dsiCersYo/ePC.0MJ1/gLryMFVSMfDoezAl2/YwzlO', '1052401466', NULL, '3132657947', NULL, NULL, 'default.png', 'F', '2020-05-25 19:14:31', '2020-05-25 19:14:31'),
(6, 'carlos humberto rodriguez parra', 'carlos', 'humberto', 'rodriguez', 'parra', 'PR', 'carlos@gmail.com', '$2y$10$N6DkoA9/ihW5/yxZRRnJ0.aQPS0Zm/B2ltJXCfdvTUwsaFWKvcMUq', '1052401467', NULL, '3115208693', NULL, NULL, 'default.png', 'M', '2020-05-25 19:14:31', '2020-05-25 19:14:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignacion_materias`
--
ALTER TABLE `asignacion_materias`
  ADD KEY `asignacion_materias_id_profesor_foreign` (`id_profesor`),
  ADD KEY `asignacion_materias_id_materia_foreign` (`id_materia`);

--
-- Indices de la tabla `asig_profe_asigs`
--
ALTER TABLE `asig_profe_asigs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asig_profe_asigs_id_profesor_foreign` (`id_profesor`),
  ADD KEY `asig_profe_asigs_id_salon_foreign` (`id_salon`),
  ADD KEY `asig_profe_asigs_id_materia_foreign` (`id_materia`),
  ADD KEY `asig_profe_asigs_id_programa_foreign` (`id_programa`),
  ADD KEY `asig_profe_asigs_id_plan_foreign` (`id_plan`);

--
-- Indices de la tabla `calificacion_corte_es`
--
ALTER TABLE `calificacion_corte_es`
  ADD PRIMARY KEY (`id_estudiante`,`id_programa`,`id_materia`,`id_plan`),
  ADD UNIQUE KEY `calificacion_corte_es_id_estudiante_id_programa` (`id_estudiante`,`id_programa`,`id_materia`,`id_plan`),
  ADD KEY `calificacion_corte_es_id_programa_foreign` (`id_programa`),
  ADD KEY `calificacion_corte_es_id_materia_foreign` (`id_materia`),
  ADD KEY `calificacion_corte_es_id_plan_foreign` (`id_plan`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudads`
--
ALTER TABLE `ciudads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ciudads_id_departamento_foreign` (`id_departamento`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamentos_id_pais_foreign` (`id_pais`);

--
-- Indices de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `escuelas_id_sede_foreign` (`id_sede`);

--
-- Indices de la tabla `escuela_programas`
--
ALTER TABLE `escuela_programas`
  ADD PRIMARY KEY (`id_escuela`,`id_programa`),
  ADD UNIQUE KEY `escuela_programas_id_escuela_id_programa_unique` (`id_escuela`,`id_programa`),
  ADD KEY `escuela_programas_id_programa_foreign` (`id_programa`);

--
-- Indices de la tabla `escuela_usuarios`
--
ALTER TABLE `escuela_usuarios`
  ADD PRIMARY KEY (`id_escuela`,`id_programa`,`id_usuario`),
  ADD UNIQUE KEY `escuela_usuarios_id_escuela_id_programa_id_usuario_unique` (`id_escuela`,`id_programa`,`id_usuario`),
  ADD KEY `escuela_usuarios_id_programa_foreign` (`id_programa`),
  ADD KEY `escuela_usuarios_id_usuario_foreign` (`id_usuario`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupos_id_materia_foreign` (`id_materia`),
  ADD KEY `grupos_id_escuela_foreign` (`id_escuela`),
  ADD KEY `grupos_id_profesor_foreign` (`id_profesor`);

--
-- Indices de la tabla `inscripcion_asig_es`
--
ALTER TABLE `inscripcion_asig_es`
  ADD PRIMARY KEY (`id_estudiante`,`id_programacion`),
  ADD UNIQUE KEY `inscripcion_asig_es_id_estudiante_id_programacion_unique` (`id_estudiante`,`id_programacion`),
  ADD KEY `inscripcion_asig_es_id_programacion_foreign` (`id_programacion`);

--
-- Indices de la tabla `localizacions`
--
ALTER TABLE `localizacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `localizacions_id_ciudad_foreign` (`id_ciudad`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materias_lineas`
--
ALTER TABLE `materias_lineas`
  ADD PRIMARY KEY (`id_materia_origen`,`id_materia`),
  ADD UNIQUE KEY `materias_lineas_id_materia_origen_id_materia_unique` (`id_materia_origen`,`id_materia`),
  ADD KEY `materias_lineas_id_materia_foreign` (`id_materia`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matriculas_id_carrera_foreign` (`id_carrera`),
  ADD KEY `matriculas_id_sede_foreign` (`id_sede`),
  ADD KEY `matriculas_id_estudiante_foreign` (`id_estudiante`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modalidads`
--
ALTER TABLE `modalidads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modalidads_nombre_unique` (`nombre`);

--
-- Indices de la tabla `modalidad_programas`
--
ALTER TABLE `modalidad_programas`
  ADD PRIMARY KEY (`id_modalidad`,`id_programa`),
  ADD UNIQUE KEY `modalidad_programas_id_modalidad_id_programa_unique` (`id_modalidad`,`id_programa`),
  ADD KEY `modalidad_programas_id_programa_foreign` (`id_programa`);

--
-- Indices de la tabla `multimedias`
--
ALTER TABLE `multimedias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `multimedia_noticias`
--
ALTER TABLE `multimedia_noticias`
  ADD PRIMARY KEY (`id_noticia`,`id_multimedia`),
  ADD UNIQUE KEY `multimedia_noticias_id_multimedia_id_noticia_unique` (`id_multimedia`,`id_noticia`);

--
-- Indices de la tabla `nivel_academicos`
--
ALTER TABLE `nivel_academicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_estudiantes`
--
ALTER TABLE `nota_estudiantes`
  ADD KEY `nota_estudiantes_id_estudiante_foreign` (`id_estudiante`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `objetivos`
--
ALTER TABLE `objetivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objetivos_id_programa_foreign` (`id_programa`),
  ADD KEY `objetivos_id_general_foreign` (`id_general`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plan_estudios`
--
ALTER TABLE `plan_estudios`
  ADD PRIMARY KEY (`id_programa`,`id_materia`,`id_plan`),
  ADD KEY `plan_estudios_id_area_foreign` (`id_area`),
  ADD KEY `plan_estudios_id_materia_foreign` (`id_materia`),
  ADD KEY `plan_estudios_id_plan_foreign` (`id_plan`);

--
-- Indices de la tabla `plan_periodos`
--
ALTER TABLE `plan_periodos`
  ADD KEY `plan_periodos_id_plan_foreign` (`id_plan`);

--
-- Indices de la tabla `programacion_horarios`
--
ALTER TABLE `programacion_horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programacion_horarios_id_asig_profe_foreign` (`id_asig_profe`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programas_id_nivel_foreign` (`id_nivel`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`nombre`);

--
-- Indices de la tabla `rol_usuarios`
--
ALTER TABLE `rol_usuarios`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`),
  ADD UNIQUE KEY `rol_usuarios_id_usuario_id_rol_unique` (`id_usuario`,`id_rol`),
  ADD KEY `rol_usuarios_id_rol_foreign` (`id_rol`);

--
-- Indices de la tabla `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salons_id_sede_foreign` (`id_sede`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sedes_id_localizacion_foreign` (`id_localizacion`);

--
-- Indices de la tabla `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id_localizacion_foreign` (`id_localizacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asig_profe_asigs`
--
ALTER TABLE `asig_profe_asigs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudads`
--
ALTER TABLE `ciudads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `localizacions`
--
ALTER TABLE `localizacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `modalidads`
--
ALTER TABLE `modalidads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `multimedias`
--
ALTER TABLE `multimedias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nivel_academicos`
--
ALTER TABLE `nivel_academicos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `objetivos`
--
ALTER TABLE `objetivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `programacion_horarios`
--
ALTER TABLE `programacion_horarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `salons`
--
ALTER TABLE `salons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `semestres`
--
ALTER TABLE `semestres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion_materias`
--
ALTER TABLE `asignacion_materias`
  ADD CONSTRAINT `asignacion_materias_id_materia_foreign` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `asignacion_materias_id_profesor_foreign` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `asig_profe_asigs`
--
ALTER TABLE `asig_profe_asigs`
  ADD CONSTRAINT `asig_profe_asigs_id_materia_foreign` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `asig_profe_asigs_id_plan_foreign` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id`),
  ADD CONSTRAINT `asig_profe_asigs_id_profesor_foreign` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asig_profe_asigs_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`),
  ADD CONSTRAINT `asig_profe_asigs_id_salon_foreign` FOREIGN KEY (`id_salon`) REFERENCES `salons` (`id`);

--
-- Filtros para la tabla `calificacion_corte_es`
--
ALTER TABLE `calificacion_corte_es`
  ADD CONSTRAINT `calificacion_corte_es_id_estudiante_foreign` FOREIGN KEY (`id_estudiante`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `calificacion_corte_es_id_materia_foreign` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `calificacion_corte_es_id_plan_foreign` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id`),
  ADD CONSTRAINT `calificacion_corte_es_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`);

--
-- Filtros para la tabla `ciudads`
--
ALTER TABLE `ciudads`
  ADD CONSTRAINT `ciudads_id_departamento_foreign` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_id_pais_foreign` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`);

--
-- Filtros para la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD CONSTRAINT `escuelas_id_sede_foreign` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id`);

--
-- Filtros para la tabla `escuela_programas`
--
ALTER TABLE `escuela_programas`
  ADD CONSTRAINT `escuela_programas_id_escuela_foreign` FOREIGN KEY (`id_escuela`) REFERENCES `escuelas` (`id`),
  ADD CONSTRAINT `escuela_programas_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`);

--
-- Filtros para la tabla `escuela_usuarios`
--
ALTER TABLE `escuela_usuarios`
  ADD CONSTRAINT `escuela_usuarios_id_escuela_foreign` FOREIGN KEY (`id_escuela`) REFERENCES `escuelas` (`id`),
  ADD CONSTRAINT `escuela_usuarios_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`),
  ADD CONSTRAINT `escuela_usuarios_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_id_escuela_foreign` FOREIGN KEY (`id_escuela`) REFERENCES `escuelas` (`id`),
  ADD CONSTRAINT `grupos_id_materia_foreign` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `grupos_id_profesor_foreign` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inscripcion_asig_es`
--
ALTER TABLE `inscripcion_asig_es`
  ADD CONSTRAINT `inscripcion_asig_es_id_estudiante_foreign` FOREIGN KEY (`id_estudiante`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripcion_asig_es_id_programacion_foreign` FOREIGN KEY (`id_programacion`) REFERENCES `programacion_horarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `localizacions`
--
ALTER TABLE `localizacions`
  ADD CONSTRAINT `localizacions_id_ciudad_foreign` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudads` (`id`);

--
-- Filtros para la tabla `materias_lineas`
--
ALTER TABLE `materias_lineas`
  ADD CONSTRAINT `materias_lineas_id_materia_foreign` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `materias_lineas_id_materia_origen_foreign` FOREIGN KEY (`id_materia_origen`) REFERENCES `materias` (`id`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_id_carrera_foreign` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`),
  ADD CONSTRAINT `matriculas_id_estudiante_foreign` FOREIGN KEY (`id_estudiante`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `matriculas_id_sede_foreign` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id`);

--
-- Filtros para la tabla `modalidad_programas`
--
ALTER TABLE `modalidad_programas`
  ADD CONSTRAINT `modalidad_programas_id_modalidad_foreign` FOREIGN KEY (`id_modalidad`) REFERENCES `modalidads` (`id`),
  ADD CONSTRAINT `modalidad_programas_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`);

--
-- Filtros para la tabla `multimedia_noticias`
--
ALTER TABLE `multimedia_noticias`
  ADD CONSTRAINT `multimedia_noticias_id_multimedia_foreign` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedias` (`id`),
  ADD CONSTRAINT `multimedia_noticias_id_noticia_foreign` FOREIGN KEY (`id_noticia`) REFERENCES `noticias` (`id`);

--
-- Filtros para la tabla `nota_estudiantes`
--
ALTER TABLE `nota_estudiantes`
  ADD CONSTRAINT `nota_estudiantes_id_estudiante_foreign` FOREIGN KEY (`id_estudiante`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `objetivos`
--
ALTER TABLE `objetivos`
  ADD CONSTRAINT `objetivos_id_general_foreign` FOREIGN KEY (`id_general`) REFERENCES `objetivos` (`id`),
  ADD CONSTRAINT `objetivos_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`);

--
-- Filtros para la tabla `plan_estudios`
--
ALTER TABLE `plan_estudios`
  ADD CONSTRAINT `plan_estudios_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `plan_estudios_id_materia_foreign` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `plan_estudios_id_plan_foreign` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id`),
  ADD CONSTRAINT `plan_estudios_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`);

--
-- Filtros para la tabla `plan_periodos`
--
ALTER TABLE `plan_periodos`
  ADD CONSTRAINT `plan_periodos_id_plan_foreign` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id`);

--
-- Filtros para la tabla `programacion_horarios`
--
ALTER TABLE `programacion_horarios`
  ADD CONSTRAINT `programacion_horarios_id_asig_profe_foreign` FOREIGN KEY (`id_asig_profe`) REFERENCES `asig_profe_asigs` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `programas`
--
ALTER TABLE `programas`
  ADD CONSTRAINT `programas_id_nivel_foreign` FOREIGN KEY (`id_nivel`) REFERENCES `nivel_academicos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rol_usuarios`
--
ALTER TABLE `rol_usuarios`
  ADD CONSTRAINT `rol_usuarios_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `rol_usuarios_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `salons`
--
ALTER TABLE `salons`
  ADD CONSTRAINT `salons_id_sede_foreign` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id`);

--
-- Filtros para la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD CONSTRAINT `sedes_id_localizacion_foreign` FOREIGN KEY (`id_localizacion`) REFERENCES `localizacions` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_id_localizacion_foreign` FOREIGN KEY (`id_localizacion`) REFERENCES `localizacions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
