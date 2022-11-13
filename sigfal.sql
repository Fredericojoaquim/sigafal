-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 12-Nov-2022 às 10:18
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
  `valor` double NOT NULL,
  `multa` double NOT NULL,
  `estado` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clientepagamentos_cliente_id_foreign` (`cliente_id`),
  KEY `clientepagamentos_pagamento_id_foreign` (`pagamento_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `clientepagamentos`
--

INSERT INTO `clientepagamentos` (`id`, `ano`, `mes`, `cliente_id`, `pagamento_id`, `created_at`, `updated_at`, `valor`, `multa`, `estado`) VALUES
(1, '2022', 'Abril', 11, 2, '2022-10-01 23:29:22', '2022-11-03 20:27:25', 5000, 0, 'verificado'),
(2, '2022', 'Março', 11, 2, NULL, '2022-10-29 13:42:32', 100, 0, 'verificado'),
(3, '2022', 'Maio', 11, 36, '2022-10-29 08:40:34', '2022-11-02 18:13:40', 5000, 1, 'verificado'),
(4, '2022', 'Junho', 11, 37, '2022-10-29 09:26:24', '2022-10-29 09:26:24', 1, 1, 'não verificado'),
(5, '2022', 'Julho', 11, 37, '2022-10-29 09:26:24', '2022-10-29 09:26:24', 1, 0, 'não verificado'),
(6, '2022', 'Agosto', 11, 37, '2022-10-29 09:26:24', '2022-10-29 09:26:24', 2, 2, 'não verificado'),
(7, '2022', 'Setembro', 11, 38, '2022-10-29 09:28:42', '2022-10-29 09:28:42', 5, 1, 'não verificado'),
(8, '2022', 'Outubro', 11, 38, '2022-10-29 09:28:42', '2022-10-29 09:28:42', 12, 0, 'não verificado'),
(9, '2022', 'Novembro', 11, 38, '2022-10-29 09:28:42', '2022-10-29 09:28:42', 10, 1, 'não verificado'),
(10, '2022', 'Dezembro', 11, 38, '2022-10-29 09:28:42', '2022-10-29 09:28:42', 1, 0, 'não verificado'),
(11, '2023', 'Janeiro', 11, 41, '2022-11-06 11:49:40', '2022-11-06 11:49:40', 2000, 1000, 'não verificado');

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
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `morada` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servico_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pt_id` bigint(20) UNSIGNED NOT NULL,
  `preco` double NOT NULL,
  `observacao` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clientes_servico_id_foreign` (`servico_id`),
  KEY `clientes_pt_id_foreign` (`pt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `nif`, `telefone`, `tipo`, `email`, `morada`, `servico_id`, `created_at`, `updated_at`, `pt_id`, `preco`, `observacao`) VALUES
(11, 'Fred Joaquim', '004983291KS049', '+244 923-905-781', 'Empresa', 'aa@gmail.com', 'Benfica', 8, '2022-10-27 21:52:43', '2022-10-31 08:21:12', 2, 9000, 'aaa'),
(13, 's', '1', '912', 'Particular', 'ggg@gmail', 'aa', 8, '2022-10-31 07:51:45', '2022-10-31 07:51:45', 2, 1.11, 'q');

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
  `valorpagamento` double NOT NULL,
  `modopagamento` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contratos_cliente_id_foreign` (`cliente_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contratos`
--

INSERT INTO `contratos` (`id`, `datacontrato`, `precocontrato`, `cliente_id`, `created_at`, `updated_at`, `valorpagamento`, `modopagamento`) VALUES
(1, '2022-09-25', 70000, 4, '2022-09-25 14:20:01', '2022-09-25 14:20:01', 0, ''),
(2, '2022-09-25', 70000, 1, '2022-09-25 14:28:13', '2022-09-25 14:28:13', 0, ''),
(5, '2022-10-02', 2000, 10, '2022-10-02 19:07:43', '2022-10-02 19:07:43', 0, ''),
(6, '2022-10-03', 70000, 11, '2022-10-03 07:44:11', '2022-10-31 08:24:26', 0, ''),
(7, '2022-10-31', 20000, 13, '2022-10-31 09:11:41', '2022-11-05 15:09:32', 10000, 'Prestação'),
(8, '2022-10-31', 8, 13, '2022-10-31 09:24:49', '2022-10-31 09:24:49', 0, ''),
(9, '2022-11-05', 11, 13, '2022-11-05 14:38:44', '2022-11-05 15:00:13', 50000, 'Prestação');

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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(31, '2022_11_06_161604_add_imagem_to_users', 26);

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
-- Estrutura da tabela `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datapagamento` date NOT NULL,
  `modopagamento` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomebanco` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_docpagamento` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtd` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagamentos_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `datapagamento`, `modopagamento`, `nomebanco`, `id_docpagamento`, `qtd`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2022-10-02', 'TPA', 'BFA', '1234', 2, 7, '2022-10-01 23:27:57', '2022-10-01 23:27:57'),
(2, '2022-10-02', 'TPA', 'BAI', '1234', 1, 7, '2022-10-01 23:29:22', '2022-10-01 23:29:22'),
(3, '2022-10-15', 'TPA', 'Milenium Atlântico', '11', 1, 11, '2022-10-15 13:53:34', '2022-10-15 13:53:34'),
(4, '2022-10-15', 'Deposito', 'Milenium Atlântico', '11', 1, 11, '2022-10-15 13:55:27', '2022-10-15 13:55:27'),
(5, '2022-10-15', 'Deposito', 'Milenium Atlântico', '11', 1, 11, '2022-10-15 13:56:38', '2022-10-15 13:56:38'),
(6, '2022-10-15', 'TPA', 'BPC', '11', 1, 11, '2022-10-15 13:58:35', '2022-10-15 13:58:35'),
(7, '2022-10-15', 'TPA', 'BPC', '11', 1, 11, '2022-10-15 14:01:35', '2022-10-15 14:01:35'),
(8, '2022-10-15', 'TPA', 'BPC', '11', 1, 11, '2022-10-15 14:03:37', '2022-10-15 14:03:37'),
(9, '2022-10-15', 'Deposito', 'BNI', '11', 1, 11, '2022-10-15 14:05:00', '2022-10-15 14:05:00'),
(10, '2022-10-15', 'Deposito', 'BNI', '11', 1, 11, '2022-10-15 14:16:32', '2022-10-15 14:16:32'),
(11, '2022-10-15', 'TPA', 'Privado Atlântico', '11', 1, 11, '2022-10-15 14:18:18', '2022-10-15 14:18:18'),
(12, '2022-10-22', 'TPA', 'Privado Atlântico', '1', 1, 11, '2022-10-22 07:46:52', '2022-10-22 07:46:52'),
(13, '2022-10-22', 'TPA', 'BPC', '1', 1, 11, '2022-10-22 07:49:05', '2022-10-22 07:49:05'),
(14, '2022-10-27', 'TPA', 'BFA', '1', 1, 11, '2022-10-27 22:48:23', '2022-10-27 22:48:23'),
(15, '2022-10-27', 'TPA', 'BAI', '1', 1, 11, '2022-10-27 22:50:17', '2022-10-27 22:50:17'),
(16, '2022-10-27', 'TPA', 'BPC', '1', 1, 11, '2022-10-27 22:52:46', '2022-10-27 22:52:46'),
(17, '2022-10-27', 'TPA', 'BPC', '1', 1, 11, '2022-10-27 22:57:44', '2022-10-27 22:57:44'),
(18, '2022-10-27', 'TPA', 'BPC', '1', 1, 11, '2022-10-27 22:58:41', '2022-10-27 22:58:41'),
(19, '2022-10-28', 'Deposito', 'BNI', '1', 1, 11, '2022-10-27 23:00:57', '2022-10-27 23:00:57'),
(20, '2022-10-28', 'TPA', 'SOL', '1', 1, 11, '2022-10-27 23:01:45', '2022-10-27 23:01:45'),
(21, '2022-10-28', 'TPA', 'BNI', '\\', 1, 11, '2022-10-27 23:02:46', '2022-10-27 23:02:46'),
(22, '2022-10-29', 'TPA', 'BNI', '1', 1, 11, '2022-10-29 07:48:53', '2022-10-29 07:48:53'),
(23, '2022-10-29', 'TPA', 'BNI', '1', 1, 11, '2022-10-29 07:51:41', '2022-10-29 07:51:41'),
(24, '2022-10-29', 'TPA', 'Privado Atlântico', '1', 1, 11, '2022-10-29 07:53:47', '2022-10-29 07:53:47'),
(25, '2022-10-29', 'TPA', 'Privado Atlântico', '1', 1, 11, '2022-10-29 07:54:09', '2022-10-29 07:54:09'),
(26, '2022-10-29', 'TPA', 'Prestígio', '1', 1, 11, '2022-10-29 07:56:33', '2022-10-29 07:56:33'),
(27, '2022-10-29', 'TPA', 'Prestígio', '1', 1, 11, '2022-10-29 07:57:36', '2022-10-29 07:57:36'),
(28, '2022-10-29', 'TPA', 'Prestígio', '1', 1, 11, '2022-10-29 07:59:00', '2022-10-29 07:59:00'),
(29, '2022-10-29', 'TPA', 'BNI', '1', 1, 11, '2022-10-29 08:22:31', '2022-10-29 08:22:31'),
(30, '2022-10-29', 'TPA', 'Privado Atlântico', '2', 1, 11, '2022-10-29 08:28:16', '2022-10-29 08:28:16'),
(31, '2022-10-29', 'TPA', 'Milenium Atlântico', '4', 1, 11, '2022-10-29 08:30:40', '2022-10-29 08:30:40'),
(32, '2022-10-29', 'TPA', 'BPC', '1', 1, 11, '2022-10-29 08:31:55', '2022-10-29 08:31:55'),
(33, '2022-10-29', 'TPA', 'BPC', '1', 1, 11, '2022-10-29 08:37:37', '2022-10-29 08:37:37'),
(34, '2022-10-29', 'TPA', 'BPC', '1', 1, 11, '2022-10-29 08:39:01', '2022-10-29 08:39:01'),
(35, '2022-10-29', 'TPA', 'BPC', '1', 1, 11, '2022-10-29 08:40:07', '2022-10-29 08:40:07'),
(36, '2022-10-29', 'TPA', 'BPC', '1', 1, 11, '2022-10-29 08:40:34', '2022-10-29 08:40:34'),
(37, '2022-10-29', 'TPA', 'Privado Atlântico', '2', 3, 11, '2022-10-29 09:26:24', '2022-10-29 09:26:24'),
(38, '2022-10-29', 'TPA', 'BPC', '12', 4, 11, '2022-10-29 09:28:42', '2022-10-29 09:28:42'),
(39, '2022-10-29', 'TPA', 'Privado Atlântico', '1', 1, 11, '2022-10-29 09:29:29', '2022-10-29 09:29:29'),
(40, '2022-11-06', 'TPA', 'BPC', '1234567', 1, 11, '2022-11-06 11:48:38', '2022-11-06 11:48:38'),
(41, '2022-11-06', 'TPA', 'BPC', '1234567', 1, 11, '2022-11-06 11:49:40', '2022-11-06 11:49:40');

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
(6, 'Luanda', '2022-10-31 17:16:16', '2022-10-31 17:22:50');

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
(8, 'Monofásico', 5000, '2022-09-30 20:44:32', '2022-10-31 09:55:48'),
(11, 'Trifásico', 1000, '2022-09-30 20:52:49', '2022-09-30 20:52:49'),
(12, 'Monofásico', 222.22, '2022-10-29 08:13:06', '2022-10-29 08:13:06');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ultimopagamentos`
--

INSERT INTO `ultimopagamentos` (`id`, `data`, `cliente_id`, `created_at`, `updated_at`) VALUES
(1, '2022-09', 11, NULL, NULL);

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
(11, 'Josefina da Costa', 'josefina@gmail.com', NULL, '$2y$10$vMZkod9z9she701NWYV1eOpLtJlphEisC86HLfBO7TLb3wuXwyFQG', NULL, '2022-09-18 16:36:52', '2022-09-18 16:36:52', '', NULL),
(13, 'Fred', 'fred@gmail.com', NULL, '$2y$10$MoN5TVyshq6IZqL6yevo2.QjK8yc93K3aBtU18I96WBC1oQE7Eh9G', NULL, '2022-11-06 14:30:26', '2022-11-06 14:30:26', 'ativo', NULL),
(14, 'meta', 'meta@gmail.com', NULL, '$2y$10$ACt78p0Bp1KJT2EHlT/ZyeOhs7uZMv7sXC47O5jGwrf//eikWiYt6', NULL, '2022-11-06 14:40:09', '2022-11-06 14:40:09', 'ativo', NULL),
(15, 'Manuela Adélia', 'meta2@gmail.com', NULL, '$2y$10$cvTwe5ISe4Uyef5zBcn7Q.cB3ZF9ON24Rxp5VpWCdX3vFHs135w6u', NULL, '2022-11-06 15:19:51', '2022-11-09 21:12:11', 'ativo', '4c504b1dec7cf5a319fc46c678090e09.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
