-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 29-Jan-2024 às 18:27
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bot`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `areas`
--

INSERT INTO `areas` (`id`, `name`, `status`) VALUES
(1, 'Área Metropolitana do Porto', 1),
(2, 'Área Metropolitana de Lisboa', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `companies`
--

INSERT INTO `companies` (`id`, `name`, `status`) VALUES
(1, 'STCP', 1),
(2, 'Metro do Porto', 1),
(3, 'UNIR', 1),
(4, 'Comboios de Portugal', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorites`
--

CREATE TABLE `favorites` (
  `id_schedule` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `overview` text NOT NULL,
  `report` text NOT NULL,
  `img` text NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `news`
--

INSERT INTO `news` (`id`, `title`, `overview`, `report`, `img`, `date`, `status`) VALUES
(1, 'Novos autocarros da UNIR são usados e estavam a circular em Lisboa', 'Foram adquiridos novos veículos elétricos para Lisboa, com recurso a fundos comunitários. No Porto, não foi possível recorrer a esses apoios.', 'O Porto Canal avançou, esta quarta-feira dia 29 de novembro, que alguns dos novos autocarros que irão integrar a frota da UNIR, a nova marca de transportes metropolitanos do Porto, a partir da próxima sexta-feira, são veículos usados, anteriormente ao serviço da Carris Metropolitana de Lisboa.\r\nEsta informação foi apurada pelo Porto Canal, que destaca a origem dos veículos da operadora Nex Continental, pertencente ao grupo Alsa. Citado pelo mesmo canal, Juan Gomez Piña, diretor-geral do grupo Alsa, esclareceu que os autocarros estiveram ao serviço da Carris Metropolitana “por um curto período de tempo”. Afirmou ainda que estes veículos, com cerca de um ano, “garantem total segurança, conforto e operacionalidade”, atendendo às necessidades dos passageiros do Porto.', 'imagem.jpg', '2024-01-23 17:31:06', 1),
(2, 'Área Metropolitana do Porto aperta fiscalização da Unir em Fevereiro ', 'Autarcas têm queixas da operação que arrancou no dia 1 de Dezembro. Em 700 autocarros, há ainda perto de 100 que não têm validadores. Tribunal de Contas analisa criação de empresa metropolitana.', 'Apesar de a operação ter começado no primeiro dia de Dezembro de 2023, o serviço dos autocarros metropolitanos da Unir continua com problemas. A partir de Fevereiro, a Área Metropolitana do Porto vai controlar mais um sistema de transportes que ainda origina múltiplas queixas dos seus utilizadores.\r\nNa reunião do conselho metropolitano, que decorreu nesta sexta-feira, os autarcas de Oliveira de Azeméis e de Vale de Cambra, que integram o lote 5 (o único que continua sem horários publicados), deram nota dos problemas que persistem.“Já asseguramos cinco autocarros diários para tentar minimizar ou atenuar problemas”, disse o presidente da câmara de Oliveira de Azeméis, Joaquim Jorge Ferreira (PS), que lamentou a falta de informação disponível junto da Área Metropolitana do Porto. Ferreira acrescentou que deixará de garantir as cinco viaturas por dia. Também o autarca de Vale de Cambra, José Alberto Pinheiro e Silva (CDS), mostrou-se preocupado com a faltam de publicação de horários e com o que diz ser a desadequação de linhas.', '1878263.jpg', '2024-01-28 23:58:59', 1),
(3, 'Metrobus no Porto cumpre prazos, mas operação vai arrancar sem os novos veículos', 'A empreitada do metrobus entre a Casa da Música e a Praça do Império está a cumprir os prazos previstos e a operação deve arrancar a tempo do verão, mas sem os novos veículos BRT.', '“Nós vamos receber os veículos mais para o final do ano. Vamos arranjar uma alternativa para operar o canal”, explica o presidente do Conselho de Administração da Metro do Porto, Tiago Braga, na visita da empresa ao modelo de transporte em Nantes, França.\r\n\r\nConsiderando que o troço do metrobus se vai localizar no eixo central, a entrada dos veículos será feita pela via mais à esquerda. Apesar de ser uma questão temporária, o arranque da operação não está comprometido.', 'noticia_00345270-580x326.jpg', '2024-01-28 23:58:59', 1),
(4, 'Saiba mais sobre a Unir, a nova rede de autocarros do Grande Porto', 'O que é a Unir? O que vai mudar? Desde que iniciou a sua operação na última sexta-feira, são muitas as dúvidas e críticas sobre a nova rede de autocarros da Área Metropolitana do Porto. Neste artigo, o JPN tenta responder a algumas dessas questões.', 'É a nova rede de autocarros da Área Metropolitana do Porto (AMP) que começou as operações na sexta-feira, dia 1 de dezembro. Surgiu da iniciativa dos 17 municípios da AMP com o objetivo de garantir um serviço de transporte público uniformizado, com mais ligações e mais horários, entre outras melhorias. A nova rede assenta em 439 linhas de autocarro e representa investimento de 311,5 milhões de euros ao logo de sete anos.\r\nDesde o dia 1 de dezembro, com o surgimento Unir, que o transporte público no Grande Porto passou a ser prestado exclusivamente por duas entidades: a STCP, que vai continuar a operar a partir o Porto, onde detém exclusividade; e a UNIR, que vai servir os restantes concelhos.', 'rede_unir_autocarro-1440x960.jpg', '2024-01-29 00:01:19', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_transportation` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `name` text NOT NULL,
  `keywords` text NOT NULL,
  `file` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `schedules`
--

INSERT INTO `schedules` (`id`, `id_area`, `id_transportation`, `id_company`, `name`, `keywords`, `file`, `status`) VALUES
(1, 1, 1, 1, '201 | VISO - ALIADOS', 'Viso, IMTT, Pereiró, Lidador, Foco, Bessa, Av. Aliados, Trindade, Cordoaria', '201_volta_vis3.pdf', 1),
(2, 1, 3, 2, 'Frequências Programadas', 'Porto, Trindade, Aliados, Metro, Casa da Música, Santo Ovídio, D. João 2, Jardim do Morro, Câmara de Gaia, General Torres, Hospital S. João, Estádio do Dragão, Bolhão, Francos, Ramalde, Viso, Lapa, Carolina Michaelis, Senhora da Hora, Póvoa de Varzim, ISMAI, Campanhâ, Fanzeres', 'frequencias_online_08_01_2024(1).pdf', 1),
(3, 1, 3, 2, 'Horários', 'Porto, Trindade, Aliados, Metro, Casa da Música, Santo Ovídio, D. João 2, Jardim do Morro, Câmara de Gaia, General Torres, Hospital S. João, Estádio do Dragão, Bolhão, Francos, Ramalde, Viso, Lapa, Carolina Michaelis, Senhora da Hora, Póvoa de Varzim, ISMAI, Campanhâ, Fanzeres', 'horarios_online_08_01_2024(1).pdf', 1),
(4, 1, 3, 2, 'Mapa de Rede', 'Porto, Trindade, Aliados, Metro, Casa da Música, Santo Ovídio, D. João 2, Jardim do Morro, Câmara de Gaia, General Torres, Hospital S. João, Estádio do Dragão, Bolhão, Francos, Ramalde, Viso, Lapa, Carolina Michaelis, Senhora da Hora, Póvoa de Varzim, ISMAI, Campanhâ, Fanzeres', 'mapa_de_rede(1).pdf', 1),
(5, 1, 2, 4, 'Horário dos Comboios Urbanos do Porto  < > Aveiro', 'General Torres, Devesas, São Bento, Campanhã, Coimbrões, Madalena, Valadares, Francelos, Miramar, Aveiro, Ovar', 'comboios-urbanos-porto-aveiro(1).pdf', 1),
(6, 1, 2, 4, 'Horário dos Comboios Urbanos do Porto < > Braga', 'São Bento, Campanhã, Rio Tinto, Ermesinde, Leandro, Louro, Nine, Ruilhe, Tadim, Braga', 'comboios-urbanos-porto-braga.pdf', 1),
(7, 1, 1, 1, '201 | ALIADOS - VISO', 'Viso, IMTT, Pereiró, Lidador, Foco, Bessa, Av. Aliados, Trindade, Cordoaria', '201_ida_trd6.pdf', 1),
(8, 1, 1, 1, '504 | BOAVISTA - NORTESHOPPING', 'Sete Bicas, Norteshopping, Preciosa, Ruela, Lidador, Fonte da Moura, Cristo Rei', '504_ida_jrc1.pdf', 1),
(9, 1, 1, 1, '504 | NORTESHOPPING - BOAVISTA', 'Sete Bicas, Norteshopping, Preciosa, Ruela, Lidador, Fonte da Moura, Cristo Rei', '504_volta_nshp.pdf', 1),
(10, 1, 1, 3, '9027 | CANEDO - D. JOÃO 2', 'Canedo, Mosteirô, Lever, Estrada Nova, Salvador Caetano, Olival, D. João 2, Gaia', 'UNIR9027.pdf', 1),
(11, 1, 1, 3, '9028 | CANEDO - D. JOÃO 2', 'Canedo, Mosteirô, Lever, Estrada Nova, Salvador Caetano, Olival, D. João 2, Gaia', 'UNIR9028.pdf', 1),
(12, 1, 1, 3, '9029 | CANEDO - D. JOÃO 2', 'Canedo, Mosteirô, Lever, Estrada Nova, Salvador Caetano, Olival, D. João 2, Gaia', 'UNIR9029.pdf', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `transportation`
--

CREATE TABLE `transportation` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `icon` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `transportation`
--

INSERT INTO `transportation` (`id`, `name`, `icon`, `status`) VALUES
(1, 'Autocarros', 'fa-bus-simple', 1),
(2, 'Comboios', 'fa-train', 1),
(3, 'Metros', 'fa-train-subway', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(70) NOT NULL,
  `isadmin` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `isadmin`, `status`) VALUES
(1, 'Gonçalo Coval', 'covalgoncalo2003@gmail.com', '$2y$10$PM.G1R1hgRIlKDu5hfuAiOZmuO6kJm7/DCsum7w4EUanmyZnlmnb2', 1, 1),
(2, 'Rafa', 'rafa@rafa.pt', '$2y$10$.KRFyDhTkzSOKcclABk70.HbT1VglUxGRcXCm5Fh3cg9zKruHYTJS', 0, 1),
(3, 'Bruno', 'bruno@gmail.com', '$2y$10$nUy30sTt0LDAPo2kXb6jYuabZ0j0VaRRQ3Gj3Vyee.tyaBcbSQWa2', 0, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `transportation`
--
ALTER TABLE `transportation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
