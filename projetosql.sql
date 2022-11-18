-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Nov-2022 às 05:25
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetosql`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `nome` varchar(255) NOT NULL DEFAULT '',
  `sobrenome` varchar(255) NOT NULL DEFAULT '',
  `departamento` varchar(255) NOT NULL DEFAULT '',
  `cargo` varchar(255) NOT NULL DEFAULT '',
  `foto` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `accounts`
--

INSERT INTO `accounts` (`id`, `matricula`, `email`, `nome`, `sobrenome`, `departamento`, `cargo`, `foto`) VALUES
(1, 3748, 'lucas.fernandes@cliente.com', 'Lucas', 'Fernandes', 'Financeiro', 'Analista', 'Lucas_Fernandes.png'),
(2, 2482, 'pedro.lima@cliente.com', 'Pedro', 'Lima', 'Logistica', 'Transportador', 'Pedro_Lima.png'),
(3, 6449, 'maria.julianelli@cliente.com', 'Maria', 'Julianelli', 'Logistica', 'Planejador', 'Maria_Julianelli.png'),
(4, 2749, 'kevin.restom@cliente.com', 'Kevin', 'Restom', 'Logistica', 'Transportador', 'Kevin_Restom.png'),
(5, 4128, 'amanda.amorim@cliente.com', 'Amanda', 'Amorim', 'Suprimentos', 'Operador', 'Amanda_Amorim.png'),
(6, 9252, 'fernanda.silva@cliente.com', 'Fernanda', 'Silva', 'Suprimentos', 'Operador', 'Fernanda_Silva.png'),
(7, 5945, 'carla.pereira@cliente.com', 'Carla', 'Pereira', 'Suprimentos', 'Almoxarife', 'Carla_Pereira.png'),
(8, 4879, 'pedro.matos@cliente.com', 'Pedro', 'Matos', 'Suprimentos', 'Almoxarife', 'Pedro_Matos.png'),
(9, 1827, 'nathalia.garcia@cliente.com', 'Nathalia', 'Garcia', 'Materiais', 'Transportador', 'Nathalia_Garcia.png'),
(10, 1318, 'leonardo.lima@cliente.com', 'Leonardo', 'Lima', 'Materiais', 'Transportador', 'Leonardo_Lima.png'),
(11, 3564, 'giulia.scarppa@cliente.com', 'Giulia', 'Scarppa', 'Materiais', 'Manutenção', 'Giulia_Scarppa.png'),
(12, 9178, 'michael.pereira@cliente.com', 'Michael', 'Pereira', 'Materiais', 'Manutenção', 'Michael_Pereira.png'),
(13, 6870, 'natan.franco@cliente.com', 'Natan', 'Franco', 'Materiais', 'Operador', 'Natan_Franco.png'),
(14, 5723, 'otávio.costa@cliente.com', 'Otávio', 'Costa', 'Financeiro', 'Analista', 'Otavio_Costa.png'),
(15, 1996, 'thales.ferreira@cliente.com', 'Thales', 'Ferreira', 'Carga', 'Transportador', 'Thales_Ferreira.png'),
(16, 2049, 'anna.alves@cliente.com', 'Anna', 'Alves', 'Carga', 'Transportador', 'Anna_Alves.png'),
(17, 1694, 'alvaro.souza@cliente.com', 'Alvaro', 'Souza', 'Suprimentos', 'Analista', 'Alvaro_Souza.png'),
(18, 8120, 'marcela.santos@cliente.com', 'Marcela', 'Santos', 'Logistica', 'Analista', 'Marcela_Santos.png'),
(19, 2710, 'ana.oliveira@cliente.com', 'Ana', 'Oliveira', 'Carga', 'Transportador', 'Ana_Oliveira.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `usuario` int(11) DEFAULT NULL,
  `remetente` int(11) DEFAULT NULL,
  `reacao` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `pontos` int(11) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `reactions`
--

INSERT INTO `reactions` (`id`, `usuario`, `remetente`, `reacao`, `pontos`, `comentario`) VALUES
(9, 13, 5, 0, 0, 'asdasdasd'),
(11, 13, 5, 1, 1, 'sadsad'),
(12, 13, 7, 0, 5, 'asdasd'),
(13, 13, 9, 0, 10, 'asdasd'),
(14, 13, 10, 0, 0, 'asd'),
(15, 13, 10, 0, 0, 'asdad'),
(16, 13, 10, 0, 0, 'asdad'),
(17, 13, 2, 1, 10, 'asdas'),
(18, 1, 13, 1, 5, 'asdad');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
