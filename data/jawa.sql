-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 04/06/2013 às 00h35min
-- Versão do Servidor: 5.5.22
-- Versão do PHP: 5.3.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `jawa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cli_cli_cliente`
--

CREATE TABLE IF NOT EXISTS `cli_cli_cliente` (
  `cli_10_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_30_nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `cli_35_desc` text COLLATE utf8_bin NOT NULL,
  `cli_30_foto` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cli_12_active` int(1) NOT NULL,
  PRIMARY KEY (`cli_10_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `cli_cli_cliente`
--

INSERT INTO `cli_cli_cliente` (`cli_10_id`, `cli_30_nome`, `cli_35_desc`, `cli_30_foto`, `cli_12_active`) VALUES
(2, 'Quup Sistemas Online', 'Quup Sistemas Online', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_cat_categoria`
--

CREATE TABLE IF NOT EXISTS `doc_cat_categoria` (
  `cat_10_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_10_parent` int(11) NOT NULL,
  `cat_30_nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `cat_30_image` varchar(255) COLLATE utf8_bin NOT NULL,
  `cat_12_active` int(11) NOT NULL,
  PRIMARY KEY (`cat_10_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `doc_cat_categoria`
--

INSERT INTO `doc_cat_categoria` (`cat_10_id`, `cat_10_parent`, `cat_30_nome`, `cat_30_image`, `cat_12_active`) VALUES
(2, 0, 'Pessoa Física', '', 1),
(3, 2, 'Comprovante de residência', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_doc_document`
--

CREATE TABLE IF NOT EXISTS `doc_doc_document` (
  `doc_10_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_10_id` int(11) NOT NULL,
  `cat_10_id` int(11) NOT NULL,
  `doc_30_path` varchar(255) COLLATE utf8_bin NOT NULL,
  `doc_30_nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `doc_12_active` int(1) NOT NULL,
  PRIMARY KEY (`doc_10_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `doc_doc_document`
--

INSERT INTO `doc_doc_document` (`doc_10_id`, `cli_10_id`, `cat_10_id`, `doc_30_path`, `doc_30_nome`, `doc_12_active`) VALUES
(2, 2, 0, 'app/upload/2/516365c8da11e-1365468616.doc', 'Comprovante de residência', 1),
(4, 2, 2, 'app/upload/2/5163670767d2c-1365468935.doc', 'Contrato Social', 1),
(5, 2, 3, 'app/upload/2/516368d81118f-1365469400.png', 'Cobrança', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usr_grp_group`
--

CREATE TABLE IF NOT EXISTS `usr_grp_group` (
  `grp_10_id` int(11) NOT NULL AUTO_INCREMENT,
  `grp_30_nome` varchar(255) CHARACTER SET latin1 NOT NULL,
  `grp_12_active` int(1) NOT NULL,
  PRIMARY KEY (`grp_10_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `usr_grp_group`
--

INSERT INTO `usr_grp_group` (`grp_10_id`, `grp_30_nome`, `grp_12_active`) VALUES
(1, 'Financeiro', 1),
(2, 'Cobrança', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usr_usr_user`
--

CREATE TABLE IF NOT EXISTS `usr_usr_user` (
  `usr_10_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_10_group` int(11) NOT NULL,
  `usr_12_type` int(2) NOT NULL,
  `usr_30_nome` varchar(255) NOT NULL,
  `usr_30_username` varchar(70) NOT NULL,
  `usr_30_password` varchar(255) NOT NULL,
  `usr_30_email` varchar(255) NOT NULL,
  `usr_12_active` int(2) NOT NULL,
  PRIMARY KEY (`usr_10_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usr_usr_user`
--

INSERT INTO `usr_usr_user` (`usr_10_id`, `usr_10_group`, `usr_12_type`, `usr_30_nome`, `usr_30_username`, `usr_30_password`, `usr_30_email`, `usr_12_active`) VALUES
(1, 0, 1, 'Administrador', 'admin', 'MjEyMzJmMjk3YTU3YTVhNzQzODk0YTBlNGE4MDFmYzM=', 'andre.simoes@quup.com.br', 1),
(2, 0, 1, 'Giovanna Godoy', 'giovanna', 'NzlkMmQ4MTJiZjY3NzI4NzM4MmI2ODEwNjIzN2I1ZWU=', 'godoy1996@hotmail.com', 1),
(3, 1, 2, 'Lilian Deptula', 'lilian', 'NTVlYzJlMmYyMDZhMzlmMGFlZTZlNmEwZjM1YjRlYjc=', 'lilian@gmail.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
