-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/04/2026 às 04:02
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdagenda`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_03_09_233417_create_usuario_table', 1),
(6, '2026_03_09_233431_create_projeto_table', 1),
(7, '2026_03_16_193125_create_tarefa_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `projeto`
--

CREATE TABLE `projeto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `projeto`
--

INSERT INTO `projeto` (`id`, `nome`, `descricao`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, 'Projeto de Matemática', 'Um projeto de apoio para matemática', 1, NULL, NULL),
(2, 'Curso de inglês', 'Curso preparatório de inglês', 2, NULL, NULL),
(9, 'Projeto de Física', 'Estudo de mecânica e movimento', 1, NULL, NULL),
(10, 'Projeto de História', 'Pesquisa sobre a Segunda Guerra Mundial', 2, NULL, NULL),
(11, 'Projeto de Programação', 'Sistema de gerenciamento em Laravel', 3, NULL, NULL),
(12, 'Projeto de Biologia', 'Estudo sobre células e DNA', 4, NULL, NULL),
(13, 'Projeto de Educação Fisica', 'Práticas sobre esportes', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefa`
--

CREATE TABLE `tarefa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `projeto_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tarefa`
--

INSERT INTO `tarefa` (`id`, `titulo`, `descricao`, `status`, `data_inicio`, `data_fim`, `usuario_id`, `projeto_id`, `created_at`, `updated_at`) VALUES
(1, 'Contas de Multiplicação', 'Fazer 10 contas de Multiplicação', 'Concluída', '2026-02-24', '2026-03-02', 1, 1, NULL, NULL),
(2, 'Pesquisa de Inglês', 'Fazer uma pesquisa sobre os verbos no passado perfeito em inglês', 'Pendente', '2026-01-23', '2026-03-24', 2, 2, NULL, NULL),
(4, 'Futebol', 'acordar para o treino as 8 horas da manhã', 'pendente', '2026-03-01', '2026-03-06', 1, 1, '2026-03-24 07:33:35', '2026-03-24 08:33:35'),
(6, 'Contas sobre matriz', 'Resolver 10 exercícios sobre matriz', 'Pendente', '2026-04-06', '2026-05-12', 3, 1, '2026-04-07 01:17:32', '2026-04-07 01:17:32'),
(7, 'Verbos no passado', 'Conjugar 10 verbos ingleses no passado', 'Pendente', '2026-04-06', '2027-10-14', 3, 2, '2026-04-07 01:54:20', '2026-04-07 01:54:20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `created_at`, `updated_at`) VALUES
(1, 'Fernando Rocha', 'fernandinho@gmail.com', '12345', NULL, NULL),
(2, 'Gustavo Lanches', 'gugudograu@gmail.com', '21314', NULL, NULL),
(3, 'Pablo Juniores', 'pabluniores@gmail.com', '31241', NULL, NULL),
(4, 'Carlos Nobrega', 'carlinhos@gmail.com', '12345', '2026-03-31 11:11:10', '2026-03-31 11:11:10'),
(5, 'Carlos Nobrega jr', 'carlinhosjr@gmail.com', '54321', '2026-03-31 11:17:53', '2026-03-31 11:17:53'),
(8, 'Mateus Vitor', 'mateusVitor@gmail.com', '543212', '2026-03-31 11:23:23', '2026-03-31 11:23:23');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projeto_usuario_id_foreign` (`usuario_id`);

--
-- Índices de tabela `tarefa`
--
ALTER TABLE `tarefa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarefa_usuario_id_foreign` (`usuario_id`),
  ADD KEY `tarefa_projeto_id_foreign` (`projeto_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tarefa`
--
ALTER TABLE `tarefa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `projeto`
--
ALTER TABLE `projeto`
  ADD CONSTRAINT `projeto_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tarefa`
--
ALTER TABLE `tarefa`
  ADD CONSTRAINT `tarefa_projeto_id_foreign` FOREIGN KEY (`projeto_id`) REFERENCES `projeto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tarefa_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
