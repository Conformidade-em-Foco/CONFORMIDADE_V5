-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/07/2025 às 14:18
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
-- Banco de dados: `lgpd_em_foco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `subtitulo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `banner`
--

INSERT INTO `banner` (`id`, `imagem`, `titulo`, `subtitulo`) VALUES
(0, '687565b0d40c1_b9972f46-8e53-4e16-8887-e0a3641a2268.png', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `checklist_resultados`
--

CREATE TABLE `checklist_resultados` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `resultado_json` text NOT NULL,
  `pontuacao_total` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens_home`
--

CREATE TABLE `imagens_home` (
  `id` int(11) NOT NULL,
  `caminho` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `tipo` enum('banner','icone','outro') DEFAULT 'banner',
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs_acesso`
--

CREATE TABLE `logs_acesso` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `navegador` text DEFAULT NULL,
  `data_hora` datetime DEFAULT current_timestamp(),
  `acao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `de_id` int(11) NOT NULL,
  `para_id` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp(),
  `lida` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `de_id`, `para_id`, `conteudo`, `criado_em`, `lida`) VALUES
(1, 8, 9, 'Teste de mensagem hahahaa', '2025-07-15 16:36:06', 1),
(2, 8, 9, 'Teste de mensagem hahahaa', '2025-07-15 16:39:20', 1),
(3, 8, 9, 'Teste de mensagem hahahaa', '2025-07-15 16:40:25', 1),
(4, 8, 9, 'Teste de mensagem hahahaa', '2025-07-15 16:40:30', 1),
(5, 8, 9, 'Teste de mensagem hahahaa', '2025-07-15 16:40:31', 1),
(6, 8, 9, 'teste', '2025-07-15 16:53:20', 1),
(7, 8, 9, 'teste', '2025-07-15 17:06:30', 1),
(8, 8, 9, 'Teste', '2025-07-15 17:22:42', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `ordem` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `data_publicacao` datetime DEFAULT current_timestamp(),
  `imagem` varchar(255) DEFAULT NULL,
  `destaque` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `conteudo`, `data_publicacao`, `imagem`, `destaque`) VALUES
(1, 'Novo Portal Foco Em Conformidade', 'SEJA MUITO BEM-VINDO Aqui é sua central de notícias de segurança!', '2025-07-11 16:49:53', '68716ae131b3d.jpg', 1),
(4, 'Suspeito preso por desviar R$ 540 milhões via PIX', 'Na última semana, a polícia prendeu João Roque, funcionário da C&M Software, sob suspeita de vender credenciais para hackers que realizaram uma fraude de R$ 540 milhões em instituições conectadas ao PIX. Apenas R$ 270 milhões foram estancados até o momento', '2025-07-14 12:07:20', '68751d28378c5.png', 1),
(5, 'Exploração no PIX: heist de R$ 1 bilhão', 'Também nas últimas semanas, relatórios indicam que hackers conseguiram drenar cerca de R$ 1 bilhão do sistema PIX via falhas na infraestrutura da C&M Software e levaram os valores em criptomoedas. O Banco Central reagiu bloqueando transações suspeitas', '2025-07-14 12:10:20', '68751ddc99dd3.png', 1),
(6, 'C&M hackeada: R$ 140 milhões desviados', 'Em 30 de junho, atacantes exploraram vulnerabilidades da C&M Software — fornecedora do Banco Central — e roubaram aproximadamente R$ 140 milhões de contas reservadas de seis bancos. A empresa foi suspensa e o autor foi detido em 4 de julho', '2025-07-14 12:14:03', '68751ebb901e2.png', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `novidades`
--

CREATE TABLE `novidades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `tipo_usuario` enum('empresa','dpo') NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `razao_social` varchar(100) DEFAULT NULL,
  `nome_fantasia` varchar(100) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `setor_atividade` varchar(100) DEFAULT NULL,
  `porte_empresa` varchar(50) DEFAULT NULL,
  `numero_funcionarios` int(11) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `nome_completo` varchar(100) DEFAULT NULL,
  `formacao_academica` varchar(100) DEFAULT NULL,
  `experiencia_anos` int(11) DEFAULT NULL,
  `certificacoes` text DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT NULL,
  `disponivel_para_contato` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `tipo_usuario`, `email`, `senha`, `telefone`, `razao_social`, `nome_fantasia`, `cnpj`, `setor_atividade`, `porte_empresa`, `numero_funcionarios`, `cpf`, `nome_completo`, `formacao_academica`, `experiencia_anos`, `certificacoes`, `cep`, `cidade`, `estado`, `criado_em`, `foto`, `disponivel_para_contato`) VALUES
(7, 'dpo', 'bomretiro@farocapital.com.br', '$2y$10$IBhyc9.sayAfze23OwPRju4RQ30cRKpjbYWT0npJFG.uMCu5fO0TW', '16992015874', NULL, NULL, NULL, NULL, NULL, NULL, '42686967846', 'GEOVANI RODRIGUES DOS SANTOS', 'MBA Cyber Security', 3, '', '14066408', 'Ribeirão Preto', 'SP', '2025-07-15 17:57:18', NULL, 0),
(8, 'dpo', 'geovanirodrigues.rp4@gmail.com', '$2y$10$oUNVk6nF2qnitxmKOrb.aem1VW8bEq62a/7mBk9Ar9ld1pkNzgtL2', '16992015874', NULL, NULL, NULL, NULL, NULL, NULL, '42686967846', 'GEOVANI RODRIGUES DOS SANTOS', 'MBA Cyber Security', 3, '', '14066408', 'Ribeirão Preto', 'SP', '2025-07-15 18:52:46', NULL, 0),
(9, 'empresa', 'simone@farocapital.com.br', '$2y$10$jrngN6.R3PhTNqNz1rVG5O1As4En/iGKs0cGnvREaHhjsrGTKINTe', '16992015874', 'FC URBANIZADORA', 'FC Urbanizador Urbanizadora', '51862026000180', 'TI', 'media', 300, NULL, NULL, NULL, NULL, NULL, '14020450', 'Ribeirão Preto', 'SP', '2025-07-15 19:30:05', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_admin`
--

CREATE TABLE `usuarios_admin` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome_completo` varchar(100) DEFAULT NULL,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios_admin`
--

INSERT INTO `usuarios_admin` (`id`, `usuario`, `senha`, `nome_completo`, `status`, `criado_em`) VALUES
(1, 'admin', '$2y$10$zbXkxHQjvIp9Ed6mFa5hTOHLIZtXg09gsyXPJza3CxCTZp9WFUXo2', 'Administrador', 'ativo', '2025-07-10 19:51:40');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `checklist_resultados`
--
ALTER TABLE `checklist_resultados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `imagens_home`
--
ALTER TABLE `imagens_home`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `logs_acesso`
--
ALTER TABLE `logs_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `novidades`
--
ALTER TABLE `novidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `checklist_resultados`
--
ALTER TABLE `checklist_resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagens_home`
--
ALTER TABLE `imagens_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logs_acesso`
--
ALTER TABLE `logs_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `novidades`
--
ALTER TABLE `novidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `checklist_resultados`
--
ALTER TABLE `checklist_resultados`
  ADD CONSTRAINT `checklist_resultados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `logs_acesso`
--
ALTER TABLE `logs_acesso`
  ADD CONSTRAINT `logs_acesso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
