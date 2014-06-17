drop database if exists `bibliotecaetec`;
create database `bibliotecaetec`;
use `bibliotecaetec`;

-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 04/06/2014 às 19:22
-- Versão do servidor: 5.5.37-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `bibliotecaetec`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alugar`
--

CREATE TABLE IF NOT EXISTS `alugar` (
  `alg_id` int(11) NOT NULL,
  `alg_lvo` int(11) NOT NULL,
  `alg_usr` int(11) NOT NULL,
  `alg_entrega` varchar(255) NOT NULL,
  `alg_status` int(1) NOT NULL,
  PRIMARY KEY (`alg_id`),
  KEY `alu_user` (`alg_usr`),
  KEY `alu_liv` (`alg_lvo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `alugar`
--

INSERT INTO `alugar` (`alg_id`, `alg_lvo`, `alg_usr`, `alg_entrega`, `alg_status`) VALUES
(168532545, 18, 3, '16/06/2014', 1),
(256051409, 19, 2, '16/06/2014', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `avalicomenta`
--

CREATE TABLE IF NOT EXISTS `avalicomenta` (
  `avl_id` int(11) NOT NULL AUTO_INCREMENT,
  `avl_usr` int(11) NOT NULL,
  `avl_lvo` int(11) NOT NULL,
  `avl_avaliacao` int(1) NOT NULL,
  `avl_comentario` text NOT NULL,
  PRIMARY KEY (`avl_id`),
  KEY `av_usr` (`avl_usr`),
  KEY `avli_livro` (`avl_lvo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Fazendo dump de dados para tabela `avalicomenta`
--

INSERT INTO `avalicomenta` (`avl_id`, `avl_usr`, `avl_lvo`, `avl_avaliacao`, `avl_comentario`) VALUES
(8, 1, 18, 5, 'Em perfeito estado!'),
(9, 1, 28, 3, 'Alguns Rabiscos e dobraduras '),
(10, 1, 27, 4, 'Falta o CD-ROM'),
(11, 1, 26, 1, 'Capa danificada');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `ctg_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctg_name` varchar(255) NOT NULL,
  `ctg_click` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ctg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Fazendo dump de dados para tabela `categorias`
--

INSERT INTO `categorias` (`ctg_id`, `ctg_name`, `ctg_click`) VALUES
(1, 'Informatica', 1),
(2, 'Literatura', 0),
(3, 'Nacional', 0),
(4, 'Internacional', 0),
(5, 'Religiao', 0),
(6, 'Auto-Estima', 0),
(7, 'Historia', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estante`
--

CREATE TABLE IF NOT EXISTS `estante` (
  `ett_id` int(11) NOT NULL AUTO_INCREMENT,
  `ett_titulo` varchar(255) NOT NULL,
  PRIMARY KEY (`ett_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `estante`
--

INSERT INTO `estante` (`ett_id`, `ett_titulo`) VALUES
(1, 'Livros em geral'),
(2, 'Literatura'),
(3, 'Informatica'),
(4, 'Administracao'),
(5, 'TCC');

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE IF NOT EXISTS `historico` (
  `hst_id` int(11) NOT NULL AUTO_INCREMENT,
  `hst_login` int(11) NOT NULL,
  `hst_desc` varchar(255) NOT NULL,
  `hst_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE IF NOT EXISTS `livro` (
  `lvo_id` int(11) NOT NULL AUTO_INCREMENT,
  `lvo_titulo` varchar(255) NOT NULL,
  `lvo_autor` varchar(255) NOT NULL,
  `lvo_editora` varchar(255) NOT NULL,
  `lvo_disp` int(1) NOT NULL,
  `lvo_des` text NOT NULL,
  `lvo_img` varchar(255) NOT NULL DEFAULT 'padrao.jpg',
  `lvo_estante` int(11) NOT NULL,
  PRIMARY KEY (`lvo_id`),
  KEY `est_liv` (`lvo_estante`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Fazendo dump de dados para tabela `livro`
--

INSERT INTO `livro` (`lvo_id`, `lvo_titulo`, `lvo_autor`, `lvo_editora`, `lvo_disp`, `lvo_des`, `lvo_img`, `lvo_estante`) VALUES
(17, '1808', 'Laurentino Gomes', 'Planeta', 1, 'O livro 1808, de Laurentino Gomes, procura resgatar e contar de forma acessível a história da corte lusitana no Brasil e tentar devolver seus protagonistas à dimensão mais correta possível dos papéis que desempenharam duzentos anos atrás.', 'Livro-1808.jpg', 1),
(18, 'O Mundo de Sofia', 'Jostein Gaarder', 'Companhia das letras', 0, 'O livro O Mundo de Sofia, de Jostein Gaarder, conta a história de Sofia Amudsen, uma adolescente às vésperas de completar 15 anos, que leva uma vida aparentemente normal, até que um fato curioso começou a tirar o seu sossego: cartas misteriosas, com algumas perguntas estranhas, começaram a aparecer em sua casa.', 'Livro-O-Mundo-Sofia.jpg', 1),
(19, 'Capitaes da Areia', 'Jorge Amado', 'Companhia de Bolso', 0, 'Capitães da Areia é um romance de autoria do escritor brasileiro Jorge Amado, publicado em 1937. O livro retrata a vida de um grupo de menores abandonados, chamados de "Capitães da Areia", ambientado na cidade de Salvador dos anos 30', 'jorge.png', 1),
(20, 'O Guarani', 'Jose de Alencar', 'Companhia Editorial Nacional', 1, '.', 'guarani.png', 2),
(21, 'Vidas Secas', 'Graciliano Ramos', 'Record', 1, '.', 'graciliano.png', 2),
(22, 'A Cidade e as Serras', 'Eca de Queiros', 'Martin Claret', 1, '.', 'cidades.png', 2),
(23, 'Harry Potter: Prisioneiro de Azkaban', 'J. R. J Rowling', 'Rocco', 1, '.', 'padrao.jpg', 2),
(24, 'A Revolucao dos Bichos', 'George Orwell', 'Companhia dasLetras', 1, '.', 'revolucao.png', 2),
(25, 'Harry Potter: e a Camara Secreta', 'J. K. Rowling', 'Rocco', 1, '.', 'hcamara.png', 2),
(26, 'Harry Potter: e a Pedra Filosofal', 'J. K. Rowling', 'Rocco', 1, '.', 'hfilosofal.png', 2),
(27, 'Informatica', 'CPS', 'Centro Paula Souza', 1, '.', 'info.png', 3),
(28, 'Gestao Ambienteal e Responsabilidade Social Corporativa', 'Takeshy Tachizawa', 'Atlas', 1, '.', 'gestao.png', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `lvo_ctg`
--

CREATE TABLE IF NOT EXISTS `lvo_ctg` (
  `lc_id` int(11) NOT NULL AUTO_INCREMENT,
  `lc_livro` int(11) NOT NULL,
  `lc_cat` int(11) NOT NULL,
  PRIMARY KEY (`lc_id`),
  KEY `lvoctg_liv` (`lc_livro`),
  KEY `lvoctg_cat` (`lc_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE IF NOT EXISTS `mensagens` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_usr_r` int(11) NOT NULL,
  `msg_usr_m` int(11) NOT NULL,
  `msg_mensagem` text NOT NULL,
  `msg_titulo` varchar(255) NOT NULL,
  `msg_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`msg_id`),
  KEY `men_user` (`msg_usr_r`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ped_alu`
--

CREATE TABLE IF NOT EXISTS `ped_alu` (
  `pal_id` int(11) NOT NULL AUTO_INCREMENT,
  `pal_usr` int(11) NOT NULL,
  `pal_lvo` int(11) NOT NULL,
  `pal_status` int(1) NOT NULL,
  PRIMARY KEY (`pal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sugestoes`
--

CREATE TABLE IF NOT EXISTS `sugestoes` (
  `sgt_id` int(11) NOT NULL AUTO_INCREMENT,
  `sgt_nome` varchar(255) NOT NULL,
  `sgt_email` varchar(255) NOT NULL,
  `sgt_oinf` varchar(255) NOT NULL,
  `sgt_text` text NOT NULL,
  `sgt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sgt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_nick` varchar(255) NOT NULL,
  `usr_tipo` int(1) NOT NULL,
  `email_alunos` varchar(255) NOT NULL,
  `usr_nome` varchar(255) NOT NULL,
  `usr_senha` varchar(12) NOT NULL,
  `usr_sala` varchar(255) NOT NULL,
  `usr_matricula` varchar(30) NOT NULL,
  `usr_tel` varchar(30) NOT NULL,
  `usr_rg` varchar(20) NOT NULL,
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `unico` (`usr_nick`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='usr_tipo: 0 = aluno, 1=bibliotecaria' AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`usr_id`, `usr_nick`, `usr_tipo`, `email_alunos`, `usr_nome`, `usr_senha`, `usr_sala`, `usr_matricula`, `usr_tel`, `usr_rg`) VALUES
(1, 'wsilverio', 2, 'wellington.silverio@etec.sp.gov.br', 'Wellington', '123456', 'II 3', '8912983721987', '19 9 8818181', '545454545'),
(2, 'admin', 2, 'admin@admin.com', 'Administrador', 'admin123', '0', '0', '(00) 0 0000-0000', '00.000.000-0'),
(3, 'aluno', 1, 'aluno@aluno.com', 'Aluno 1', 'aluno', 'Informatica para Internet 2013', '000000000', '(00) 0 0000-0000', '00.000.000-0'),
(4, 'etec', 1, 'etec@etec.sp.gov.br', 'ETEC', '123', 'Geral', '000000', '(00) 0 0000-0000', '00.000.000-0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
