-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Set-2024 às 01:50
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
-- Estrutura da tabela `wp_pronto_psi_clientes`
--

CREATE TABLE `wp_pronto_psi_clientes` (
  `id` int(11) NOT NULL,
  `bookly_user_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `cartao_sus` varchar(20) DEFAULT NULL,
  `responsavel_financeiro` varchar(128) DEFAULT NULL,
  `plano_saude` varchar(128) DEFAULT NULL,
  `motivo_consulta` text DEFAULT NULL,
  `sintomas_rel` text DEFAULT NULL,
  `diagnostico` text DEFAULT NULL,
  `tratamento_anterior` text DEFAULT NULL,
  `medicacoes_uso` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `wp_pronto_psi_clientes`
--

INSERT INTO `wp_pronto_psi_clientes` (`id`, `bookly_user_id`, `full_name`, `genero`, `estado_civil`, `cpf`, `cartao_sus`, `responsavel_financeiro`, `plano_saude`, `motivo_consulta`, `sintomas_rel`, `diagnostico`, `tratamento_anterior`, `medicacoes_uso`) VALUES
(2, 2, 'Leticia Albuquerque ', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 11, 'Beatriz ', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 8, 'Vilma Herminio da Silva ', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 10, 'Patrícia Rebelo', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 'jucivan freitas', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 9, 'Felipe Bertuol', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 4, 'Matheus Farripas da Rocha Bezerra', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 13, 'Vanessa Natal', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 14, 'Nathalia Oliveira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `wp_pronto_psi_clientes`
--
ALTER TABLE `wp_pronto_psi_clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookly_user_id` (`bookly_user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `wp_pronto_psi_clientes`
--
ALTER TABLE `wp_pronto_psi_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `wp_pronto_psi_clientes`
--
ALTER TABLE `wp_pronto_psi_clientes`
  ADD CONSTRAINT `fk_bookly_user_id` FOREIGN KEY (`bookly_user_id`) REFERENCES `wp_bookly_customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
