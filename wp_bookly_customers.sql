-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Set-2024 às 01:41
-- Versão do servidor: 10.11.8-MariaDB-cll-lve
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u642157280_ldZXg`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `wp_bookly_customers`
--

CREATE TABLE `wp_bookly_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `wp_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `facebook_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `full_name` varchar(128) NOT NULL DEFAULT '',
  `first_name` varchar(64) NOT NULL DEFAULT '',
  `last_name` varchar(64) NOT NULL DEFAULT '',
  `phone` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `birthday` date DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `state` varchar(32) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `street` varchar(64) DEFAULT NULL,
  `street_number` varchar(16) DEFAULT NULL,
  `additional_address` varchar(255) DEFAULT NULL,
  `full_address` varchar(255) DEFAULT NULL,
  `notes` text NOT NULL,
  `info_fields` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `stripe_account` varchar(36) DEFAULT NULL,
  `stripe_cloud_account` varchar(36) DEFAULT NULL,
  `attachment_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `wp_bookly_customers`
--

INSERT INTO `wp_bookly_customers` (`id`, `wp_user_id`, `facebook_id`, `group_id`, `full_name`, `first_name`, `last_name`, `phone`, `email`, `birthday`, `country`, `state`, `postcode`, `city`, `street`, `street_number`, `additional_address`, `full_address`, `notes`, `info_fields`, `tags`, `stripe_account`, `stripe_cloud_account`, `attachment_id`, `created_at`) VALUES
(1, 3, NULL, NULL, 'jucivan freitas', 'jucivan', 'freitas', '+5581989542629', 'devdatavisio@gmail.com', '1979-01-20', 'Brasil', 'PERNAMBUCO', '52021-160', 'Recife', 'Rua Frígio Lima', '85', 'Rua Frígio Lima,85', '', '', '[]', NULL, NULL, NULL, NULL, '2024-08-11 23:36:46'),
(2, 2, NULL, NULL, 'Leticia Albuquerque ', 'Leticia', 'Albuquerque', '+5561982516181', 'letsferrer@gmail.com', NULL, 'Brasil', 'DF', NULL, 'Brasília ', NULL, NULL, NULL, '', '', '[]', '[\"Particular\"]', NULL, NULL, NULL, '2024-08-16 23:27:39'),
(3, 2, NULL, NULL, 'Mara Terezinha', 'Mara', 'Terezinha', '+5561992424569', '', NULL, 'brasil', 'DF', NULL, 'Brasília', NULL, NULL, NULL, '', '', '[]', '[\"Della Vita\"]', NULL, NULL, NULL, '2024-08-17 00:49:28'),
(4, 2, NULL, NULL, 'Matheus Farripas da Rocha Bezerra', 'Matheus', 'Farripas da Rocha Bezerra', '+5561981625228', '', NULL, NULL, 'DF', NULL, 'Brasília', NULL, NULL, NULL, '', 'Paciente Della vita Militar', '[]', '[\"Della Vita\"]', NULL, NULL, NULL, '2024-08-19 23:13:34'),
(5, 2, NULL, NULL, 'Nicolas Bahmad Pinheiro', 'Nicolas', 'Bahmad Pinheiro', '', 'hff.helena@gmail.com', NULL, NULL, 'df', NULL, 'Brasília ', NULL, NULL, NULL, '', 'Paciente adolescente DellaVita', '[]', '[\"Della Vita\"]', NULL, NULL, NULL, '2024-08-19 23:16:08'),
(6, 2, NULL, NULL, 'Ana Carolina Cruz de Sousa Gomes', 'Ana', 'Carolina Cruz de Sousa Gomes', '', 'hff.helena@gmail.com', NULL, NULL, 'DF', NULL, 'Brasília', NULL, NULL, NULL, '', 'Paciente com TDAH CID: F.90 + F41.2', '[]', '[\"Della Vita\"]', NULL, NULL, NULL, '2024-08-19 23:18:12'),
(7, 2, NULL, NULL, 'Debora Laís', 'Debora', 'Laís', '+5561994252585', 'debora-laiis@hotmail.com', NULL, NULL, 'DF', NULL, 'Brasília', NULL, NULL, NULL, '', '', '[]', '[\"Particular\"]', NULL, NULL, NULL, '2024-08-19 23:19:55'),
(8, 2, NULL, NULL, 'Vilma Herminio da Silva ', 'Vilma', 'Herminio da Silva', '+5511973552920', 'jho_sousa@hotmail.com', NULL, NULL, 'SP', NULL, 'São Paulo', NULL, NULL, NULL, '', 'Consulta 95,00 ', '[]', '[\"Particular\"]', NULL, NULL, NULL, '2024-08-19 23:22:12'),
(9, 2, NULL, NULL, 'Felipe Bertuol', 'Felipe', 'Bertuol', '+5544991395101', 'lipebertuol.fb@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Consulta 125,00', '[]', '[\"Particular\"]', NULL, NULL, NULL, '2024-08-19 23:24:01'),
(10, 2, NULL, NULL, 'Patrícia Rebelo', 'Patrícia', 'Rebelo', '+5561999726480', 'patricia@aguasclarasmidia.com.br', NULL, NULL, 'DF', NULL, 'bRASILIA', NULL, NULL, NULL, '', 'Consulta 100,00', '[]', '[\"Particular\"]', NULL, NULL, NULL, '2024-08-19 23:26:18'),
(11, 8, NULL, NULL, 'Beatriz ', 'Beatriz', '', '+5561999951869', 'beatrizduartebrandão@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Paciente adolescente ', '[{\"id\":43842,\"value\":[]},{\"id\":6993,\"value\":\"\"},{\"id\":39024,\"value\":\"\"}]', '[\"Della Vita\"]', NULL, NULL, NULL, '2024-08-19 23:28:11'),
(12, 2, NULL, NULL, 'Franciane', 'Franciane', '', '+5594981120979', 'francianebuffito@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Paciente valor Social 30,00 consulta ', '[]', '[\"Particular Social\",\"Online\"]', NULL, NULL, NULL, '2024-08-19 23:31:21'),
(13, 2, NULL, NULL, 'Vanessa Natal', 'Vanessa', 'Natal', '+5581992084820', 'vanessapnatal@gmail.com', NULL, NULL, 'PE', NULL, 'Ipojuca', NULL, NULL, NULL, '', 'Consulta 80,00', '[]', '[\"Online\",\"Particular\"]', NULL, NULL, NULL, '2024-08-19 23:33:31'),
(14, 2, NULL, NULL, 'Nathalia Oliveira', 'Nathalia', 'Oliveira', '+15712300422', 'nataliashalom27@gmail.com', NULL, 'Estados Unidos ', 'Virginia', NULL, NULL, NULL, NULL, NULL, '', 'Consulta 100,00', '[]', '[\"Particular\",\"Online\"]', NULL, NULL, NULL, '2024-08-19 23:39:14'),
(15, 2, NULL, NULL, 'Rosana Marcia ', 'Rosana', 'Marcia', '+5561981351668', '', NULL, NULL, 'DF', NULL, 'Brasília', NULL, NULL, NULL, '', '', '[]', '[\"Della Vita\",\"Online\"]', NULL, NULL, NULL, '2024-08-19 23:41:15'),
(16, 2, NULL, NULL, 'Samuel', 'Samuel', '', '', '', NULL, NULL, 'DF', NULL, 'Brasília', NULL, NULL, NULL, '', 'Paciente Criança 12 anos', '[]', '[\"Della Vita\",\"Presencial\"]', NULL, NULL, NULL, '2024-08-19 23:42:55'),
(17, 2, NULL, NULL, 'Samela Miranda ', 'Samela', 'Miranda', '+5561981233551', '', NULL, NULL, 'DF', NULL, 'Brasília', NULL, NULL, NULL, '', 'Paciente com TDAH ', '[]', '[\"Della Vita\",\"Presencial\"]', NULL, NULL, NULL, '2024-08-19 23:44:30'),
(18, 2, NULL, NULL, 'Maritza', 'Maritza', '', '+5561994040638', 'criecommaritza@gmail.com', NULL, NULL, 'DF', NULL, 'Brasília', NULL, NULL, NULL, '', '', '[]', '[\"Permuta \",\"Online\"]', NULL, NULL, NULL, '2024-08-19 23:46:42'),
(19, 9, NULL, NULL, 'Marcia Kananda Cruz de Oliveira ', 'Marcia', 'Kananda Cruz de Oliveira', '', 'Kanandaoliveira978@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '[{\"id\":43842,\"value\":[]},{\"id\":6993,\"value\":\"\"},{\"id\":39024,\"value\":\"\"}]', NULL, NULL, NULL, NULL, '2024-08-24 10:58:39');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `wp_bookly_customers`
--
ALTER TABLE `wp_bookly_customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `wp_bookly_customers`
--
ALTER TABLE `wp_bookly_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
