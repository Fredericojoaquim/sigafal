-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09-Jan-2023 às 10:55
-- Versão do servidor: 5.7.36
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sigfal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientepagamentos`
--

DROP TABLE IF EXISTS `clientepagamentos`;
CREATE TABLE IF NOT EXISTS `clientepagamentos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ano` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mes` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `pagamento_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `multa` double NOT NULL,
  `estado` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valorcaixa` double DEFAULT NULL,
  `valorbanco` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientepagamentos_cliente_id_foreign` (`cliente_id`),
  KEY `clientepagamentos_pagamento_id_foreign` (`pagamento_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `clientepagamentos`
--

INSERT INTO `clientepagamentos` (`id`, `ano`, `mes`, `cliente_id`, `pagamento_id`, `created_at`, `updated_at`, `valor`, `multa`, `estado`, `valorcaixa`, `valorbanco`) VALUES
(29, '2022', 'Dezembro', 17, 66, '2022-12-07 18:41:26', '2022-12-07 18:41:26', 1, 0, 'não verificado', NULL, NULL),
(35, '2022', 'Dezembro', 11, 88, '2022-12-15 20:50:55', '2022-12-15 20:50:55', NULL, 0, 'não verificado', 0, 0),
(36, '2022', 'Novembro', 15, 90, '2022-12-19 06:24:58', '2022-12-19 06:24:58', NULL, 0, 'não verificado', 0, 0),
(26, '2022', 'Novembro', 17, 63, '2022-11-27 13:35:49', '2022-12-19 14:06:14', 2000, 0, 'verificado', NULL, NULL),
(27, '2022', 'Outubro', 18, 64, '2022-11-27 14:21:15', '2022-11-29 20:48:30', 1, 1, 'não verificado', NULL, NULL),
(28, '2022', 'Setembro', 19, 65, '2022-11-27 14:43:52', '2022-12-22 12:15:30', 1, 1, 'verificado', NULL, NULL),
(30, '2022', 'Novembro', 15, 83, '2022-12-13 03:18:30', '2022-12-13 03:18:30', NULL, 1000, 'não verificado', 0, 7000),
(31, '2022', 'Abril', 15, 83, '2022-12-13 03:22:25', '2022-12-13 03:22:25', NULL, 0, 'não verificado', 2000, 3000),
(32, '2022', 'Agosto', 15, 83, '2022-12-13 03:23:15', '2022-12-13 03:23:15', NULL, 0, 'não verificado', 0, 2000),
(33, '2022', 'Setembro', 15, 83, '2022-12-13 03:30:53', '2022-12-13 03:30:53', NULL, 0, 'não verificado', 4000, 1000),
(37, '2022', 'Outubro', 15, 91, '2022-12-19 06:27:05', '2022-12-19 06:27:05', NULL, 0, 'não verificado', 0, 0),
(38, '2022', 'Novembro', 15, 92, '2022-12-19 06:31:32', '2022-12-19 06:31:32', NULL, 0, 'não verificado', 0, 0),
(39, '2022', 'Outubro', 15, 92, '2022-12-19 06:31:42', '2022-12-19 06:31:42', NULL, 0, 'não verificado', 0, 0),
(40, '2022', 'Novembro', 15, 92, '2022-12-19 06:31:49', '2022-12-19 06:31:49', NULL, 0, 'não verificado', 0, 0),
(41, '2022', 'Outubro', 15, 95, '2022-12-19 11:26:58', '2022-12-19 11:26:58', NULL, 0, 'não verificado', 0, 0),
(42, '2022', 'Novembro', 15, 97, '2022-12-19 11:51:31', '2022-12-19 11:51:31', NULL, 0, 'não verificado', 0, 0),
(43, '2022', 'Dezembro', 15, 99, '2022-12-19 12:31:47', '2022-12-19 12:31:47', NULL, 0, 'não verificado', 0, 0),
(44, '2022', 'Outubro', 19, 129, '2022-12-22 12:06:35', '2022-12-22 12:06:35', NULL, 0, 'não verificado', 5000, 0),
(45, '2022', 'Outubro', 15, 131, '2022-12-23 22:09:40', '2022-12-23 22:09:40', NULL, 0, 'não verificado', 5000, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nif` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `morada` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servico_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pt_id` bigint(20) UNSIGNED NOT NULL,
  `preco` double NOT NULL,
  `observacao` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientes_servico_id_foreign` (`servico_id`),
  KEY `clientes_pt_id_foreign` (`pt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `nif`, `telefone`, `tipo`, `email`, `morada`, `servico_id`, `created_at`, `updated_at`, `pt_id`, `preco`, `observacao`) VALUES
(11, 'Fred Joaquim', '004983291KS049', '+244 923-905-781', 'Empresa', 'aa@gmail.com', 'Benfica', 8, '2022-10-27 21:52:43', '2022-10-31 08:21:12', 2, 9000, 'aaa'),
(20, 'Joaquim Fernando', '004983291CA039', '+244 934-900-876', 'Empresa', NULL, 'Dangereux', 11, '2022-12-27 19:30:25', '2022-12-27 19:30:25', 2, 5000, NULL),
(21, 'Filipe Antonio', '004983291KN022', '+244 912-346-789', 'Empresa', 'futungo@gmail.com', 'Futungo', 11, '2022-12-27 20:12:08', '2022-12-27 20:12:08', 4, 5000, NULL),
(15, 'Mano', '004983291KS040', '+244 947-042-925', 'Particular', 'frederico22joaquim@gmail.com', 'Dangere', 8, '2022-11-20 20:26:04', '2022-12-12 10:00:35', 2, 10000, NULL),
(16, 'manu', '004983291KS046', '+244 947-042-925', 'Particular', 'frederico22joaquim@gmail.com', 'município  de talatona Bairro Dangereux', 8, '2022-11-20 20:29:19', '2022-11-20 20:29:19', 3, 20000, NULL),
(17, 'Manuel da Silva', '004983291LA049', '+244 991-204-726', 'Particular', 'MANUEL', 'Dangereux', 11, '2022-11-27 13:35:07', '2022-11-27 13:35:07', 2, 2000, NULL),
(18, 'Fernando João', '004983291KN041', '+244 922-390-989', 'Particular', 'f@gmail.com', 'Talatoa', 11, '2022-11-27 14:20:35', '2022-12-13 01:15:18', 3, 2000, NULL),
(19, 'Marta Domingos', '004983291CA010', '+244 921-303-020', 'Particular', NULL, 'Benfica', 11, '2022-11-27 14:43:20', '2022-11-27 14:43:20', 3, 1000, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contaclientes`
--

DROP TABLE IF EXISTS `contaclientes`;
CREATE TABLE IF NOT EXISTS `contaclientes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contaclientes_cliente_id_foreign` (`cliente_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contaclientes`
--

INSERT INTO `contaclientes` (`id`, `data`, `saldo`, `cliente_id`, `created_at`, `updated_at`) VALUES
(1, '22-12-27', 25000, 20, '2022-12-27 19:30:25', '2022-12-28 14:23:21'),
(2, '22-12-27', 10000, 21, '2022-12-27 20:12:08', '2022-12-30 14:25:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contratopagamentos`
--

DROP TABLE IF EXISTS `contratopagamentos`;
CREATE TABLE IF NOT EXISTS `contratopagamentos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `contrato_id` bigint(20) UNSIGNED NOT NULL,
  `valor` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datapagamento` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contratopagamentos_contrato_id_foreign` (`contrato_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contratopagamentos`
--

INSERT INTO `contratopagamentos` (`id`, `contrato_id`, `valor`, `created_at`, `updated_at`, `estado`, `datapagamento`) VALUES
(18, 14, 100000, '2022-12-23 19:31:03', '2022-12-23 19:31:03', 'não verificado', '2022-12-23'),
(19, 15, 50000, '2022-12-23 19:32:04', '2022-12-23 19:32:04', 'não verificado', '2022-12-23'),
(20, 15, 50000, '2022-12-23 19:32:40', '2022-12-23 19:32:40', 'não verificado', '2022-12-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contratos`
--

DROP TABLE IF EXISTS `contratos`;
CREATE TABLE IF NOT EXISTS `contratos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datacontrato` date NOT NULL,
  `precocontrato` double NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `modopagamento` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contratos_cliente_id_foreign` (`cliente_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contratos`
--

INSERT INTO `contratos` (`id`, `datacontrato`, `precocontrato`, `cliente_id`, `created_at`, `updated_at`, `modopagamento`, `estado`) VALUES
(15, '2022-12-23', 100000, 18, '2022-12-23 19:31:53', '2022-12-23 19:32:40', 'Prestação', 'Concluido'),
(14, '2022-12-23', 100000, 19, '2022-12-23 19:30:52', '2022-12-23 19:31:03', 'Completo', 'Concluido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_17_130951_create_permission_tables', 2),
(6, '2022_08_19_095808_create_client_table', 3),
(7, '2022_08_19_101223_create_client_table', 4),
(8, '2022_08_19_101405_create_client_table', 5),
(9, '2022_08_19_101619_create_clientes_table', 6),
(10, '2022_08_19_175713_create_servicos_table', 7),
(11, '2022_09_17_112824_create_pts_table', 8),
(12, '2022_09_17_113524_create_contratos_table', 8),
(13, '2022_09_17_113808_create_clientes_table', 9),
(14, '2022_09_17_114432_create_contratos_table', 10),
(15, '2022_09_17_115313_create_pagamentos_table', 11),
(16, '2022_09_17_162748_create_clientepagamentos_table', 12),
(17, '2022_09_20_214724_add_idpt_to_clientes', 13),
(18, '2022_09_20_221506_add_preco_to_clientes', 14),
(19, '2022_10_01_233433_add_preco_to_cllientepagamentos', 15),
(20, '2022_10_02_004039_add_estado_to_users', 16),
(21, '2022_10_02_142544_add_observacao_to_users', 17),
(22, '2022_10_02_153834_add_observacao_to_clientes', 18),
(23, '2022_10_15_222909_add_multa_to_clientepagamentos', 19),
(24, '2022_10_27_220530_add_estado_to_clientepagamentos', 20),
(25, '2022_11_05_151038_add_valorpago_to_contratos', 21),
(26, '2022_11_05_151207_add_modopagamento_to_contratos', 21),
(27, '2022_11_06_132037_create_ultimopagamentos_table', 22),
(28, '2022_11_06_134847_create_ultimopagamentos_table', 23),
(29, '2022_11_06_140151_create_ultimopagamentos_table', 24),
(30, '2022_11_06_153442_add_imagem_to_users', 25),
(31, '2022_11_06_161604_add_imagem_to_users', 26),
(32, '2022_11_15_075336_create_contratopagamentos_table', 27),
(33, '2022_11_20_070355_add_estado_to_contratopagamentos', 28),
(34, '2022_11_20_202459_add_data_to_contratopagamentos', 29),
(35, '2022_12_11_140936_add_valorcaixa_to_clientepagamentos', 30),
(36, '2022_12_11_141239_add_valorbanco_to_clientepagamentos', 30),
(37, '2022_12_11_141515_create_contaclientes_table', 31),
(38, '2022_12_27_204442_create_operacao_table', 32);

-- --------------------------------------------------------

--
-- Estrutura da tabela `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(3, '', 1),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `operacao`
--

DROP TABLE IF EXISTS `operacao`;
CREATE TABLE IF NOT EXISTS `operacao` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `conta_id` bigint(20) UNSIGNED NOT NULL,
  `debito` double NOT NULL,
  `credito` double NOT NULL,
  `data` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operacao_conta_id_foreign` (`conta_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `operacao`
--

INSERT INTO `operacao` (`id`, `conta_id`, `debito`, `credito`, `data`, `created_at`, `updated_at`) VALUES
(1, 1, 5000, 0, '2022-12-28', '2022-12-28 13:48:36', '2022-12-28 13:48:36'),
(2, 1, 5000, 0, '2022-12-28', '2022-12-28 13:49:08', '2022-12-28 13:49:08'),
(3, 1, 5000, 0, '2022-12-28', '2022-12-28 13:54:02', '2022-12-28 13:54:02'),
(5, 1, 10000, 0, '2022-12-28', '2022-12-28 14:19:16', '2022-12-28 14:19:16'),
(6, 1, 5000, 0, '2022-12-28', '2022-12-28 14:21:06', '2022-12-28 14:21:06'),
(7, 1, 5000, 0, '2022-12-28', '2022-12-28 14:22:08', '2022-12-28 14:22:08'),
(8, 1, 0, 5000, '2022-12-28', '2022-12-28 14:23:11', '2022-12-28 14:23:11'),
(9, 1, 0, 5000, '2022-12-28', '2022-12-28 14:23:21', '2022-12-28 14:23:21'),
(10, 2, 5000, 0, '2022-12-30', '2022-12-30 14:23:09', '2022-12-30 14:23:09'),
(11, 2, 5000, 0, '2022-12-30', '2022-12-30 14:25:43', '2022-12-30 14:25:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datapagamento` date NOT NULL,
  `modopagamento` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomebanco` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_docpagamento` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagamentos_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `datapagamento`, `modopagamento`, `nomebanco`, `id_docpagamento`, `user_id`, `created_at`, `updated_at`) VALUES
(66, '2022-12-07', 'Cash', NULL, '1670442063647', 11, '2022-12-07 18:41:26', '2022-12-07 18:41:26'),
(65, '2022-11-27', 'Cash', NULL, '1669563822418', 11, '2022-11-27 14:43:52', '2022-11-27 14:43:52'),
(63, '2022-11-27', 'TPA', 'KEVE', '111000', 11, '2022-11-27 13:35:49', '2022-11-27 13:35:49'),
(64, '2022-11-27', 'Cash', NULL, '1669562464851', 11, '2022-11-27 14:21:15', '2022-11-27 14:21:15'),
(61, '2022-11-24', 'Cash', NULL, '1669324814890', 11, '2022-11-24 20:20:23', '2022-11-24 20:20:23'),
(62, '2022-11-24', 'Cash', NULL, '1669324908857', 11, '2022-11-24 20:21:56', '2022-11-24 20:21:56'),
(67, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 01:54:07', '2022-12-13 01:54:07'),
(68, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 02:01:58', '2022-12-13 02:01:58'),
(69, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 02:03:16', '2022-12-13 02:03:16'),
(70, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 02:04:00', '2022-12-13 02:04:00'),
(71, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 02:10:51', '2022-12-13 02:10:51'),
(72, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 02:11:44', '2022-12-13 02:11:44'),
(73, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 02:22:49', '2022-12-13 02:22:49'),
(74, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 02:23:30', '2022-12-13 02:23:30'),
(75, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 02:24:23', '2022-12-13 02:24:23'),
(76, '2022-12-13', 'Cash', NULL, '1670900045863', 11, '2022-12-13 02:24:45', '2022-12-13 02:24:45'),
(77, '2022-12-13', 'Cash', NULL, '1670903331033', 11, '2022-12-13 02:48:52', '2022-12-13 02:48:52'),
(78, '2022-12-13', 'Cash', NULL, '1670903436664', 11, '2022-12-13 02:50:37', '2022-12-13 02:50:37'),
(79, '2022-12-13', 'Cash', NULL, '1670904146208', 11, '2022-12-13 03:02:27', '2022-12-13 03:02:27'),
(80, '2022-12-13', 'Cash', NULL, '1670904528962', 11, '2022-12-13 03:08:50', '2022-12-13 03:08:50'),
(81, '2022-12-13', 'Cash', NULL, '1670904755751', 11, '2022-12-13 03:12:37', '2022-12-13 03:12:37'),
(82, '2022-12-13', 'Cash', NULL, '1670904877681', 11, '2022-12-13 03:14:38', '2022-12-13 03:14:38'),
(83, '2022-12-13', 'Cash', NULL, '1670905089715', 11, '2022-12-13 03:18:10', '2022-12-13 03:18:10'),
(84, '2022-12-14', 'Cash', NULL, '1671052146655', 11, '2022-12-14 20:09:08', '2022-12-14 20:09:08'),
(85, '2022-12-14', 'Cash', NULL, '1671053409164', 11, '2022-12-14 20:30:10', '2022-12-14 20:30:10'),
(86, '2022-12-15', 'Cash', NULL, '1671139404031', 11, '2022-12-15 20:23:25', '2022-12-15 20:23:25'),
(87, '2022-12-15', 'Cash', NULL, '1671139842034', 11, '2022-12-15 20:30:43', '2022-12-15 20:30:43'),
(88, '2022-12-15', 'Cash', NULL, '1671140674994', 11, '2022-12-15 20:44:37', '2022-12-15 20:44:37'),
(89, '2022-12-16', 'Cash', NULL, '1671204474075', 11, '2022-12-16 14:27:54', '2022-12-16 14:27:54'),
(90, '2022-12-19', 'Cash', NULL, '1671434688642', 11, '2022-12-19 06:24:49', '2022-12-19 06:24:49'),
(91, '2022-12-19', 'Cash', NULL, '1671434809669', 11, '2022-12-19 06:26:50', '2022-12-19 06:26:50'),
(92, '2022-12-19', 'Cash', NULL, '1671434934741', 11, '2022-12-19 06:28:55', '2022-12-19 06:28:55'),
(93, '2022-12-19', 'Cash', NULL, '1671435181123', 11, '2022-12-19 06:33:02', '2022-12-19 06:33:02'),
(94, '2022-12-19', 'Cash', NULL, '1671435275586', 11, '2022-12-19 06:34:36', '2022-12-19 06:34:36'),
(95, '2022-12-19', 'Cash', NULL, '1671452808754', 11, '2022-12-19 11:26:50', '2022-12-19 11:26:50'),
(96, '2022-12-19', 'Cash', NULL, '1671453870419', 11, '2022-12-19 11:44:31', '2022-12-19 11:44:31'),
(97, '2022-12-19', 'Cash', NULL, '1671453946944', 11, '2022-12-19 11:45:48', '2022-12-19 11:45:48'),
(98, '2022-12-19', 'Cash', NULL, '1671454966908', 11, '2022-12-19 12:02:48', '2022-12-19 12:02:48'),
(99, '2022-12-19', 'Cash', NULL, '1671456647819', 11, '2022-12-19 12:30:48', '2022-12-19 12:30:48'),
(100, '2022-12-19', 'Cash', NULL, '1671462540792', 11, '2022-12-19 14:09:02', '2022-12-19 14:09:02'),
(101, '2022-12-21', 'Cash', NULL, '1671619344165', 11, '2022-12-21 09:49:08', '2022-12-21 09:49:08'),
(102, '2022-12-21', 'Cash', NULL, '1671619806328', 11, '2022-12-21 09:50:07', '2022-12-21 09:50:07'),
(103, '2022-12-21', 'Cash', NULL, '1671619870392', 11, '2022-12-21 09:51:11', '2022-12-21 09:51:11'),
(104, '2022-12-21', 'Cash', NULL, '1671620856775', 11, '2022-12-21 10:07:38', '2022-12-21 10:07:38'),
(105, '2022-12-22', 'Deposito', 'BNI', '89013411', 11, '2022-12-22 10:49:09', '2022-12-22 10:49:09'),
(106, '2022-12-22', 'TPA', 'SOL', '5612000', 11, '2022-12-22 10:50:44', '2022-12-22 10:50:44'),
(107, '2022-12-22', 'TPA', 'BPC', '8760012', 11, '2022-12-22 10:52:00', '2022-12-22 10:52:00'),
(108, '2022-12-22', 'TPA', 'BPC', '8760019', 11, '2022-12-22 10:53:11', '2022-12-22 10:53:11'),
(109, '2022-12-22', 'Deposito', 'SOL', '21567', 11, '2022-12-22 10:53:58', '2022-12-22 10:53:58'),
(110, '2022-12-22', 'TPA', 'BNI', '231672000', 11, '2022-12-22 11:01:09', '2022-12-22 11:01:09'),
(131, '2022-12-23', 'Cash', NULL, '1671836948277', 11, '2022-12-23 22:09:09', '2022-12-23 22:09:09'),
(130, '2022-12-23', 'Cash', NULL, '1671836805222', 11, '2022-12-23 22:06:46', '2022-12-23 22:06:46'),
(129, '2022-12-22', 'Cash', NULL, '1671714381380', 11, '2022-12-22 12:06:22', '2022-12-22 12:06:22'),
(128, '2022-12-22', 'Cash', NULL, '1671713402724', 11, '2022-12-22 11:50:04', '2022-12-22 11:50:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-08-17 12:16:47', '2022-08-17 12:16:47'),
(2, 'operador', 'web', '2022-08-17 12:17:03', '2022-08-17 12:17:03'),
(3, 'Administrador', 'web', '2022-08-17 13:33:59', '2022-08-17 13:33:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pts`
--

DROP TABLE IF EXISTS `pts`;
CREATE TABLE IF NOT EXISTS `pts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `localizacao` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pts`
--

INSERT INTO `pts` (`id`, `localizacao`, `created_at`, `updated_at`) VALUES
(2, 'Praça da alegria', '2022-09-17 20:15:35', '2022-09-17 20:15:35'),
(3, 'Rua da Paula', '2022-09-17 20:19:39', '2022-09-17 20:19:39'),
(4, '2-muxixeiro', '2022-09-26 08:15:57', '2022-10-02 19:56:22'),
(6, 'Talatona', '2022-10-31 17:16:16', '2022-11-29 17:56:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

DROP TABLE IF EXISTS `servicos`;
CREATE TABLE IF NOT EXISTS `servicos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `multa` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id`, `descricao`, `multa`, `created_at`, `updated_at`) VALUES
(8, 'Bifásico', 5000, '2022-09-30 20:44:32', '2022-11-29 07:56:56'),
(11, 'Trifásico', 2000, '2022-09-30 20:52:49', '2022-12-20 20:01:51'),
(12, 'Trifásico', 222.22, '2022-10-29 08:13:06', '2022-11-29 07:55:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ultimopagamentos`
--

DROP TABLE IF EXISTS `ultimopagamentos`;
CREATE TABLE IF NOT EXISTS `ultimopagamentos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ultimopagamentos_cliente_id_foreign` (`cliente_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ultimopagamentos`
--

INSERT INTO `ultimopagamentos` (`id`, `data`, `cliente_id`, `created_at`, `updated_at`) VALUES
(1, '2022-12', 11, NULL, '2022-11-24 20:21:56'),
(2, '2022-10', 15, '2022-11-20 20:26:04', '2022-12-23 22:09:40'),
(3, '2023-01', 16, '2022-11-20 20:29:19', '2022-11-24 10:35:23'),
(4, '2022-12', 17, '2022-11-27 13:35:07', '2022-12-07 18:41:26'),
(5, '2022-10', 18, '2022-11-27 14:20:35', '2022-11-27 14:21:15'),
(6, '2022-10', 19, '2022-11-27 14:43:20', '2022-12-22 12:06:35'),
(7, NULL, 20, '2022-12-27 19:30:25', '2022-12-27 19:30:25'),
(8, NULL, 21, '2022-12-27 20:12:08', '2022-12-27 20:12:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `estado`, `imagem`) VALUES
(11, 'Josefina da Costa', 'josefina@gmail.com', NULL, '$2y$10$pkP6zTjWdIKBQnuuAIVJleudT164h9Ec0uwq6b7oZbIIZK8I8L9iy', NULL, '2022-09-18 16:36:52', '2022-12-04 11:14:42', 'Activo', '0a672ed2b128fde224497eed88399e9f.jpg'),
(13, 'Fred', 'fred@gmail.com', NULL, '$2y$10$MoN5TVyshq6IZqL6yevo2.QjK8yc93K3aBtU18I96WBC1oQE7Eh9G', NULL, '2022-11-06 14:30:26', '2022-11-06 14:30:26', 'ativo', NULL),
(14, 'meta', 'meta@gmail.com', NULL, '$2y$10$ACt78p0Bp1KJT2EHlT/ZyeOhs7uZMv7sXC47O5jGwrf//eikWiYt6', NULL, '2022-11-06 14:40:09', '2022-11-06 14:40:09', 'ativo', NULL),
(15, 'Manuela Adélia', 'meta2@gmail.com', NULL, '$2y$10$cvTwe5ISe4Uyef5zBcn7Q.cB3ZF9ON24Rxp5VpWCdX3vFHs135w6u', NULL, '2022-11-06 15:19:51', '2022-11-09 21:12:11', 'ativo', '4c504b1dec7cf5a319fc46c678090e09.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
