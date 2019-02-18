-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Fev-2019 às 14:14
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `cantina-sistema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `id_caixa` int(11) NOT NULL,
  `dataCaixa` date NOT NULL,
  `valor` float NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caixa`
--

INSERT INTO `caixa` (`id_caixa`, `dataCaixa`, `valor`, `id_usuario`) VALUES
(1, '2019-02-02', 220, 24),
(2, '2019-02-06', 328, 8),
(3, '2019-02-04', 80, 8),
(4, '2019-02-05', 63, 8),
(5, '2019-02-07', 293, 8),
(6, '2019-02-08', 145, 8),
(7, '2019-02-09', 163, 8),
(8, '2019-02-11', 213, 8),
(9, '2019-02-12', 314, 8),
(10, '2019-02-13', 127, 8),
(11, '2019-02-14', 262, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cantinas`
--

CREATE TABLE `cantinas` (
  `id_cantina` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sede` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cantinas`
--

INSERT INTO `cantinas` (`id_cantina`, `nome`, `sede`) VALUES
(1, 'Futuro VIP - Madureira', 'Antigo Electra (Av. Ministro Edgard Romero, 415)'),
(2, 'Cantina 2', 'Teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nomeCargo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nomeCargo`) VALUES
(1, 'Gerente'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome_categoria` varchar(100) NOT NULL,
  `dataCaptura` date NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `id_usuario`, `nome_categoria`, `dataCaptura`, `ativo`) VALUES
(8, 8, 'Salgados', '2019-01-20', 1),
(9, 8, 'Bebidas', '2019-01-20', 1),
(10, 8, 'Doces', '2019-01-23', 1),
(11, 8, 'Biscoitos', '2019-01-30', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `setor` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `obs` text,
  `ativo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_usuario`, `nome`, `setor`, `email`, `telefone`, `cpf`, `obs`, `ativo`) VALUES
(1, 6, 'Aluno', '-', '-', '-', '-', '', 0),
(4, 6, 'Paula Fernandes', 'Aluno', 'paula@hotmail.com', '(21) 22222-2222', '111.111.111-11', '-', 1),
(6, 8, 'Amanda Marte', 'Cadastro', 'amandavsmarte@gmail.com', '(21) 99999-9999', '155.684.987-76', '-', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE `compras` (
  `id_compras` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` float NOT NULL,
  `dataCompra` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `compras`
--

INSERT INTO `compras` (`id_compras`, `id_produto`, `id_fornecedor`, `quantidade`, `preco`, `dataCompra`, `id_usuario`, `ativo`) VALUES
(20, 10, 6, 3, 70.17, '2019-01-29', 8, 1),
(21, 10, 6, 1, 23.39, '2019-01-29', 8, 1),
(22, 11, 6, 3, 19.47, '2019-01-29', 8, 1),
(23, 4, 7, 2, 23.98, '2019-01-29', 8, 1),
(24, 12, 7, 1, 16.99, '2019-01-29', 8, 1),
(25, 13, 7, 1, 12.5, '2019-01-29', 8, 1),
(26, 14, 7, 1, 6.2, '2019-01-29', 8, 1),
(27, 15, 7, 1, 10.7, '2019-01-29', 8, 1),
(28, 16, 8, 1, 25.98, '2019-01-29', 8, 1),
(29, 17, 8, 1, 2.9, '2019-01-29', 8, 1),
(30, 18, 8, 1, 15.98, '2019-01-29', 8, 1),
(31, 19, 9, 1, 10.78, '2019-01-29', 8, 1),
(32, 20, 9, 1, 11.78, '2019-01-29', 8, 1),
(35, 23, 9, 3, 4.17, '2019-01-29', 8, 1),
(36, 24, 9, 4, 5, '2019-01-29', 8, 1),
(38, 25, 9, 1, 3.15, '2019-01-29', 8, 1),
(39, 21, 9, 1, 19.98, '2019-01-29', 8, 1),
(40, 22, 9, 1, 3.15, '2019-01-29', 8, 1),
(41, 26, 9, 1, 10.48, '2019-01-29', 8, 1),
(42, 27, 9, 1, 4.48, '2019-01-29', 8, 1),
(43, 28, 9, 1, 6.19, '2019-01-29', 8, 1),
(44, 29, 9, 1, 16.9, '2019-01-29', 8, 1),
(45, 31, 9, 1, 16.9, '2019-01-29', 8, 1),
(46, 30, 9, 1, 11.98, '2019-01-29', 8, 1),
(47, 32, 9, 1, 15.48, '2019-01-29', 8, 1),
(48, 33, 9, 1, 11.98, '2019-01-29', 8, 1),
(49, 34, 9, 3, 3.84, '2019-01-29', 8, 1),
(50, 36, 9, 3, 3.84, '2019-01-29', 8, 1),
(51, 39, 9, 2, 2.76, '2019-01-29', 8, 1),
(52, 38, 9, 2, 2.76, '2019-01-29', 8, 1),
(53, 42, 9, 2, 2.76, '2019-01-29', 8, 1),
(54, 37, 9, 2, 2.76, '2019-01-29', 8, 1),
(55, 40, 9, 1, 16.98, '2019-01-29', 8, 1),
(56, 41, 9, 1, 2.69, '2019-01-29', 8, 1),
(57, 59, 9, 2, 2.68, '2019-01-29', 8, 1),
(58, 57, 9, 2, 2.68, '2019-01-29', 8, 1),
(59, 58, 1, 2, 2.68, '2019-01-29', 8, 1),
(60, 43, 5, 3, 70.5, '2019-01-31', 8, 1),
(61, 44, 5, 2, 37, '2019-01-31', 8, 1),
(62, 45, 5, 2, 37, '2019-01-31', 8, 1),
(63, 46, 5, 6, 111, '2019-01-31', 8, 1),
(64, 47, 5, 1, 18.5, '2019-01-31', 8, 1),
(65, 48, 5, 1, 18.5, '2019-01-31', 8, 1),
(66, 49, 5, 5, 92.5, '2019-01-31', 8, 1),
(67, 50, 5, 1, 18.5, '2019-01-31', 8, 1),
(68, 51, 5, 1, 18.5, '2019-01-31', 8, 1),
(69, 52, 5, 2, 37, '2019-01-31', 8, 1),
(70, 53, 5, 2, 37, '2019-01-31', 8, 1),
(71, 54, 5, 1, 18.5, '2019-01-31', 8, 1),
(72, 55, 5, 1, 18.5, '2019-01-31', 8, 1),
(73, 56, 5, 1, 19, '2019-01-31', 8, 1),
(74, 60, 11, 9, 13.5, '2019-02-01', 8, 1),
(75, 62, 11, 8, 12, '2019-02-01', 8, 1),
(76, 61, 11, 2, 3, '2019-02-01', 8, 1),
(77, 63, 12, 12, 23.88, '2019-02-02', 24, 1),
(78, 64, 12, 6, 13.14, '2019-02-02', 24, 1),
(79, 65, 12, 12, 29.88, '2019-02-02', 24, 1),
(80, 66, 12, 24, 66.36, '2019-02-02', 24, 1),
(81, 67, 12, 12, 5.98, '2019-02-02', 24, 1),
(82, 10, 6, 1, 23.39, '2019-02-06', 8, 1),
(83, 9, 6, 2, 46.78, '2019-02-06', 8, 1),
(84, 68, 6, 1, 23.39, '2019-02-06', 8, 1),
(85, 43, 5, 2, 47, '2019-02-02', 8, 1),
(86, 44, 5, 2, 37, '2019-02-02', 8, 1),
(87, 45, 5, 2, 37, '2019-02-02', 8, 1),
(88, 46, 5, 4, 74, '2019-02-02', 8, 1),
(89, 47, 5, 1, 18.5, '2019-02-02', 8, 1),
(90, 48, 5, 1, 18.5, '2019-02-02', 8, 1),
(91, 49, 5, 4, 74, '2019-02-02', 8, 1),
(92, 51, 5, 1, 18.5, '2019-02-02', 8, 1),
(93, 53, 5, 1, 18.5, '2019-02-02', 8, 1),
(94, 52, 5, 1, 18.5, '2019-02-02', 8, 1),
(95, 56, 5, 1, 18.5, '2019-02-02', 8, 1),
(96, 69, 5, 1, 18.5, '2019-02-02', 8, 1),
(97, 13, 7, 1, 12.5, '2019-02-06', 8, 1),
(98, 39, 7, 6, 7.8, '2019-02-06', 8, 1),
(99, 43, 5, 1, 23.5, '2019-02-07', 8, 1),
(100, 49, 5, 5, 92.5, '2019-02-07', 8, 1),
(101, 46, 5, 4, 74, '2019-02-07', 8, 1),
(102, 47, 5, 2, 37, '2019-02-07', 8, 1),
(103, 48, 5, 2, 37, '2019-02-07', 8, 1),
(104, 44, 1, 2, 37, '2019-02-07', 8, 1),
(105, 45, 5, 2, 37, '2019-02-07', 8, 1),
(106, 54, 5, 1, 18.5, '2019-02-07', 8, 1),
(107, 53, 5, 1, 18.5, '2019-02-07', 8, 1),
(108, 22, 7, 3, 2.55, '2019-02-07', 8, 1),
(109, 21, 7, 1, 12, '2019-02-07', 8, 1),
(110, 9, 6, 1, 23.4, '2019-02-12', 8, 1),
(111, 68, 6, 1, 23.39, '2019-02-14', 8, 1),
(112, 9, 6, 1, 23.39, '2019-02-14', 8, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fiado`
--

CREATE TABLE `fiado` (
  `id_fiado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `dataVenda` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fiado`
--

INSERT INTO `fiado` (`id_fiado`, `id_cliente`, `id_produto`, `quantidade`, `id_funcionario`, `dataVenda`) VALUES
(8, 6, 5, 1, 8, '2019-01-21'),
(9, 6, 4, 1, 8, '2019-01-22'),
(10, 4, 5, 3, 8, '2019-01-22'),
(11, 4, 6, 2, 8, '2019-01-25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fiado_produto`
--

CREATE TABLE `fiado_produto` (
  `id_fiado` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `obs` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id_fornecedor`, `id_usuario`, `nome`, `endereco`, `email`, `telefone`, `obs`, `ativo`) VALUES
(1, 8, 'Big 2000', 'R. Conselheiro GalvÃ£o, 46', '-', '(00) 00000-0000', '-', 1),
(5, 8, 'Danilo', '-', '-', '(21) 98565-0855', 'Salgado assado', 1),
(6, 8, 'DepÃ³sito Guaracamp', 'Em frente ao Big 2000', '-', '(00) 00000-0000', '-', 1),
(7, 8, 'Mega Doces', 'R. Conselheiro GalvÃ£o, 58', '-', '(21) 02451-9621', '-', 1),
(8, 8, 'Xapic', 'R. Conselheiro GalvÃ£o, 144', '-', '(21) 02451-9471', '-', 1),
(9, 8, 'New Look ComÃ©rcio de Alimentos Eirelli', 'R. Conselheiro GalvÃ£o, 194', '-', '(00) 00000-0000', '-', 1),
(10, 8, 'K 218-220', 'R. Conselheiro GalvÃ£o, 96', '-', '(21) 03355-8788', '-', 1),
(11, 8, 'DanÃºbia', '-', '-', '(00) 00000-0000', '-', 1),
(12, 24, 'Prezunic', 'Recreio', '-', '(00) 00000-0000', '-', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gastos_extras`
--

CREATE TABLE `gastos_extras` (
  `id_gasto` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `valor` float NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `dataGasto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `gastos_extras`
--

INSERT INTO `gastos_extras` (`id_gasto`, `descricao`, `valor`, `id_usuario`, `dataGasto`) VALUES
(1, 'AlmoÃ§o', 50.46, 8, '2019-01-29'),
(2, 'SachÃª Catchup', 8.5, 8, '2019-01-29'),
(3, 'SachÃª AÃ§Ãºcar', 11.95, 8, '2019-01-29'),
(4, 'Caneca leite', 4, 8, '2019-01-29'),
(5, 'Agua mineral 1,5 ml', 3.18, 24, '2019-02-02'),
(6, 'Papel toalha ', 5.99, 24, '2019-02-02'),
(7, 'Tomada ventilador', 3.9, 24, '2019-02-02'),
(8, 'Contact', 3.5, 24, '2019-02-02'),
(9, 'Produtos para aÃ§ai', 69.66, 24, '2019-02-02'),
(10, 'Produtos cafÃ©', 61.14, 24, '2019-02-02'),
(11, 'Organizador', 20, 8, '2019-02-06'),
(12, 'Chaves', 18, 8, '2019-02-09'),
(13, 'Garfo', 2, 8, '2019-02-09'),
(14, 'Bica da torneira', 3, 8, '2019-02-09'),
(15, 'Cortador de pizza', 7, 8, '2019-02-09'),
(16, 'Pratos e copos', 10.9, 8, '2019-02-09'),
(17, 'Suco', 2.7, 8, '2019-02-09'),
(18, 'Queijo e presunto', 15.32, 8, '2019-02-09'),
(19, 'AlmoÃ§os', 56, 8, '2019-02-09'),
(20, 'Passagens', 52, 8, '2019-02-08'),
(21, 'Fechadura', 42.97, 8, '2019-02-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `id_imagem` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `dataUpload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` float NOT NULL,
  `dataCaptura` date NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `id_categoria`, `id_usuario`, `nome`, `quantidade`, `preco`, `dataCaptura`, `ativo`) VALUES
(4, 9, 8, 'Coca Cola Lata 310ml', 2, 5, '2019-01-20', 1),
(5, 9, 8, 'Fanta Uva', 0, 5.6, '2019-01-20', 0),
(6, 9, 8, 'Fanta Laranja Mini', 0, 2.5, '2019-01-23', 0),
(9, 9, 8, 'Guaracamp Natural 285ml', 4, 1.5, '2019-01-30', 1),
(10, 9, 8, 'Guaracamp MaracujÃ¡ 285ml', 5, 1.5, '2019-01-30', 1),
(11, 9, 8, 'Ãgua s/ GÃ¡s 510ml', 3, 2, '2019-01-30', 1),
(12, 10, 8, 'Trident HortelÃ£', 1, 2, '2019-01-30', 1),
(13, 9, 8, 'Ãgua c/ GÃ¡s 510ml', 2, 3, '2019-01-30', 1),
(14, 10, 8, 'Bananada', 1, 0.3, '2019-01-30', 1),
(15, 10, 8, 'Hersheys Ao Leite', 1, 1.5, '2019-01-30', 1),
(16, 10, 8, 'Chokito', 1, 2, '2019-01-30', 1),
(17, 10, 8, 'Poosh Tutti Frutti', 1, 0.25, '2019-01-30', 1),
(18, 10, 8, 'PaÃ§oca', 1, 0.5, '2019-01-30', 1),
(19, 10, 8, 'Barra Cereal Banana/Aveia', 1, 1.5, '2019-01-30', 1),
(20, 11, 8, 'Cookies Chocolate', 1, 2, '2019-01-30', 1),
(21, 10, 8, 'Amendoim', 4, 0.8, '2019-01-30', 1),
(22, 9, 8, 'Suco Sufresh MaracujÃ¡ 200ml', 4, 2.5, '2019-01-30', 1),
(23, 9, 8, 'Ãgua de Coco 200ml', 3, 3, '2019-01-30', 1),
(24, 9, 8, 'Toddynho', 4, 3, '2019-01-30', 1),
(25, 9, 8, 'Suco Sufresh Laranja 200ml  ', 1, 2.5, '2019-01-30', 1),
(26, 10, 8, 'Doce de Amendoim', 1, 1.5, '2019-01-30', 1),
(27, 10, 8, 'Bala MaÃ§Ã£ Verde', 1, 0.15, '2019-01-30', 1),
(28, 10, 8, 'Pirulito 7Belo', 1, 0.4, '2019-01-30', 1),
(29, 10, 8, 'Mentos DUO Black', 1, 2, '2019-01-30', 1),
(30, 10, 8, 'Halls Extra Forte', 1, 1.5, '2019-01-30', 1),
(31, 10, 8, 'Mentos Mint Perfetti', 1, 2, '2019-01-30', 1),
(32, 10, 8, 'Frutella Morango', 1, 2, '2019-01-30', 1),
(33, 10, 8, 'Halls Menta', 1, 1.5, '2019-01-30', 1),
(34, 11, 8, 'Pipoca Natural Pq', 3, 3, '2019-01-30', 1),
(35, 11, 8, 'Torcida Churrasco 80gr', 0, 2.5, '2019-01-30', 0),
(36, 11, 8, 'Pipoca Manteiga Pq', 3, 3, '2019-01-30', 1),
(37, 11, 8, 'Torcida Pizza 80gr', 2, 2.5, '2019-01-30', 1),
(38, 11, 8, 'Torcida Churrasco 80gr', 2, 2.5, '2019-01-30', 1),
(39, 11, 8, 'Torcida Bacom 80gr', 8, 2.5, '2019-01-30', 1),
(40, 10, 8, 'Trident Canela', 1, 2, '2019-01-30', 1),
(41, 11, 8, 'Clube Social', 1, 1, '2019-01-30', 1),
(42, 11, 8, 'Torcida Queijo 80gr', 2, 2.5, '2019-01-30', 1),
(43, 8, 8, 'PÃ£o de Queijo', 6, 2.5, '2019-01-31', 1),
(44, 8, 8, 'X-Burger c/ Cheddar', 6, 4, '2019-01-31', 1),
(45, 8, 8, 'X-Burger s/ Cheddar', 6, 4, '2019-01-31', 1),
(46, 8, 8, 'Bauru Misto', 14, 4, '2019-01-31', 1),
(47, 8, 8, 'Bauru Hot-dog', 4, 4, '2019-01-31', 1),
(48, 8, 8, 'Italiano de Frango', 4, 4, '2019-01-31', 1),
(49, 8, 8, 'Croissant de Presunto c/ Queijo', 14, 4, '2019-01-31', 1),
(50, 8, 8, 'Croissant de Frango', 1, 4, '2019-01-31', 1),
(51, 8, 8, 'Croissant de Chocolate', 2, 4, '2019-01-31', 1),
(52, 8, 8, 'Mistinho de Presunto', 3, 4, '2019-01-31', 1),
(53, 8, 8, 'Folhado de Presunto', 4, 4, '2019-01-31', 1),
(54, 8, 8, 'Folhado de 4 Queijos', 2, 4, '2019-01-31', 1),
(55, 8, 8, 'Pizza Folhada de Calabresa', 1, 4, '2019-01-31', 1),
(56, 8, 8, 'Croissant Integral', 2, 4, '2019-01-31', 1),
(57, 11, 8, 'Eqlibri Presunto', 2, 2.5, '2019-01-31', 1),
(58, 11, 8, 'Eqlibri Queijo Suave', 2, 2.5, '2019-01-31', 1),
(59, 11, 8, 'Eqlibri Cottage', 2, 2.5, '2019-01-31', 1),
(60, 10, 8, 'Bombom Coco', 9, 2.5, '2019-02-01', 1),
(61, 10, 8, 'Bombom PaÃ§oca', 2, 2.5, '2019-02-01', 1),
(62, 10, 8, 'Bombom MaracujÃ¡', 8, 2.5, '2019-02-01', 1),
(63, 9, 24, 'Pepsi 350ml', 12, 5, '2019-02-02', 1),
(64, 9, 24, 'Fanta laranja 350ml', 6, 5, '2019-02-02', 1),
(65, 9, 24, 'Guarana Antarctica 350ml', 12, 5, '2019-02-02', 1),
(66, 9, 24, 'Coca cola 350 ml', 24, 5, '2019-02-02', 1),
(67, 9, 24, 'Coca Cola Zero 350ml', 12, 5, '2019-02-02', 1),
(68, 9, 8, 'Guaracamp AÃ§aÃ­', 2, 1.5, '2019-02-07', 1),
(69, 8, 8, 'Pizza Brotinho Calabresa', 1, 4, '2019-02-07', 1),
(70, 9, 8, 'Tron', 0, 2.5, '2019-02-07', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `dataCaptura` date NOT NULL,
  `cantina` int(11) NOT NULL,
  `cargo` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `user`, `email`, `senha`, `dataCaptura`, `cantina`, `cargo`, `ativo`) VALUES
(8, 'Renan Pereira', 'admin', 'admin', 'b510a85d869880a85d341b8cddc57a1c19acd3a9', '2019-01-16', 1, 1, 1),
(24, 'Anadia', 'anadia', 'anadia', 'd34eb04bd5fc4c50d78fe84fb7526cc2567efaf6', '2019-02-02', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id_venda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `preco` float NOT NULL,
  `dataCompra` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id_caixa`),
  ADD KEY `usuario_fk` (`id_usuario`);

--
-- Indexes for table `cantinas`
--
ALTER TABLE `cantinas`
  ADD PRIMARY KEY (`id_cantina`);

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compras`),
  ADD KEY `id_fk_forncedor` (`id_fornecedor`),
  ADD KEY `id_fk_usuario` (`id_usuario`),
  ADD KEY `fk_id_produto` (`id_produto`);

--
-- Indexes for table `fiado`
--
ALTER TABLE `fiado`
  ADD PRIMARY KEY (`id_fiado`),
  ADD KEY `fk_cliente` (`id_cliente`),
  ADD KEY `fk_funcionario` (`id_funcionario`),
  ADD KEY `id_fk_produto` (`id_produto`);

--
-- Indexes for table `fiado_produto`
--
ALTER TABLE `fiado_produto`
  ADD KEY `fk_fiado` (`id_fiado`),
  ADD KEY `fk_produto` (`id_produto`);

--
-- Indexes for table `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Indexes for table `gastos_extras`
--
ALTER TABLE `gastos_extras`
  ADD PRIMARY KEY (`id_gasto`),
  ADD KEY `fk_usuario_gastos` (`id_usuario`);

--
-- Indexes for table `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id_imagem`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_categoria` (`id_categoria`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cantina` (`cantina`),
  ADD KEY `fk_cargo` (`cargo`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id_venda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id_caixa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cantinas`
--
ALTER TABLE `cantinas`
  MODIFY `id_cantina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `fiado`
--
ALTER TABLE `fiado`
  MODIFY `id_fiado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gastos_extras`
--
ALTER TABLE `gastos_extras`
  MODIFY `id_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id_imagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `caixa`
--
ALTER TABLE `caixa`
  ADD CONSTRAINT `usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`),
  ADD CONSTRAINT `id_fk_forncedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id_fornecedor`),
  ADD CONSTRAINT `id_fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `fiado`
--
ALTER TABLE `fiado`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `fk_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `id_fk_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);

--
-- Limitadores para a tabela `fiado_produto`
--
ALTER TABLE `fiado_produto`
  ADD CONSTRAINT `fk_fiado` FOREIGN KEY (`id_fiado`) REFERENCES `fiado` (`id_fiado`),
  ADD CONSTRAINT `fk_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);

--
-- Limitadores para a tabela `gastos_extras`
--
ALTER TABLE `gastos_extras`
  ADD CONSTRAINT `fk_usuario_gastos` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_cantina` FOREIGN KEY (`cantina`) REFERENCES `cantinas` (`id_cantina`),
  ADD CONSTRAINT `fk_cargo` FOREIGN KEY (`cargo`) REFERENCES `cargos` (`id_cargo`);
COMMIT;
