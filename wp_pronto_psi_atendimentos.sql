-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09-Set-2024 às 20:54
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
  -- Estrutura da tabela `wp_pronto_psi_atendimentos`
  --

  CREATE TABLE `wp_pronto_psi_atendimentos` (
    `id` int(11) NOT NULL,
    `prontuario_id` int(11) NOT NULL,
    `data_atendimento` date NOT NULL,
    `horario_inicio` time NOT NULL,
    `horario_termino` time NOT NULL,
    `tipo_atendimento` varchar(20) NOT NULL,
    `duracao_atendimento` time NOT NULL,
    `resumo_atendimento` text DEFAULT NULL,
    `observacoes` text DEFAULT NULL,
    `pontos_pos_e_melhorias` text DEFAULT NULL,
    `reacoes_respostas` text DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

  --
  -- Índices para tabelas despejadas
  --

  --
  -- Índices para tabela `wp_pronto_psi_atendimentos`
  --
  ALTER TABLE `wp_pronto_psi_atendimentos`
    ADD PRIMARY KEY (`id`),
    ADD KEY `prontuario_id` (`prontuario_id`);

  --
  -- AUTO_INCREMENT de tabelas despejadas
  --

  --
  -- AUTO_INCREMENT de tabela `wp_pronto_psi_atendimentos`
  --
  ALTER TABLE `wp_pronto_psi_atendimentos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- Restrições para despejos de tabelas
  --

  --
  -- Limitadores para a tabela `wp_pronto_psi_atendimentos`
  --
  ALTER TABLE `wp_pronto_psi_atendimentos`
    ADD CONSTRAINT `wp_pronto_psi_atendimentos_ibfk_1` FOREIGN KEY (`prontuario_id`) REFERENCES `wp_pronto_psi_clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
