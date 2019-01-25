-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Jan-2019 às 18:52
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
(9, 8, 'Refrigerantes', '2019-01-20', 1),
(10, 8, 'Doces', '2019-01-23', 1);

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
(1, 8, 'Big 2000', 'ss', 'gfdgdf', 'dgfdfg', 'dgdfg', 1);

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
(4, 9, 8, 'Coca Cola', 45, 5.6, '2019-01-20', 1),
(5, 9, 8, 'Fanta Uva', 26, 5.6, '2019-01-20', 1),
(6, 9, 8, 'Fanta Laranja Mini', 58, 2.5, '2019-01-23', 1);

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
(16, 'asd', 'asd', 'asd', 'f10e2821bbbea527ea02200352313bc059445190', '2019-01-18', 1, 1, 0),
(22, '123', '123', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2019-01-19', 1, 1, 0),
(23, '123', '123', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2019-01-19', 1, 1, 0);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fiado`
--
ALTER TABLE `fiado`
  MODIFY `id_fiado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id_imagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
