-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-Maio-2014 às 22:30
-- Versão do servidor: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `daw_yearbook`
--

USE `daw_yearbook`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE IF NOT EXISTS `cidades` (
  `idCidade` int(11) NOT NULL AUTO_INCREMENT,
  `idEstado` int(11) NOT NULL,
  `nomeCidade` varchar(70) NOT NULL,
  PRIMARY KEY (`idCidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`idCidade`, `idEstado`, `nomeCidade`) VALUES
(1, 13, 'Montes Claros'),
(2, 13, 'Machado'),
(3, 8, 'Colatina'),
(4, 8, 'Cachoeiro de Itapemirim'),
(5, 13, 'Sao Gotardo'),
(6, 13, 'Teofilo Otoni'),
(7, 25, 'Sao Bernardo do Campo'),
(8, 24, 'Florianopolis'),
(9, 13, 'Governador Valadares'),
(10, 13, 'Araxa'),
(11, 13, 'Itauna'),
(12, 13, 'Cataguases'),
(13, 19, 'Rio de Janeiro'),
(14, 12, ' Campo Grande'),
(15, 13, 'Entre Rios de Minas'),
(16, 13, 'Belo Horizonte'),
(17, 3, 'Macapa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `sigaEstado` char(2) NOT NULL,
  `nomeEstado` varchar(50) NOT NULL,
  PRIMARY KEY (`idEstado`),
  UNIQUE KEY `sigaEstado` (`sigaEstado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`idEstado`, `sigaEstado`, `nomeEstado`) VALUES
(1, 'AC', 'Acre'),
(2, 'AL', 'Alagoas'),
(3, 'AP', 'Amapá'),
(4, 'AM', 'Amazonas'),
(5, 'BA', 'Bahia'),
(6, 'CE', 'Ceará'),
(7, 'DF', 'Distrito Federal'),
(8, 'ES', 'Espírito Santo'),
(9, 'GO', 'Goiás'),
(10, 'MA', 'Maranhão'),
(11, 'MT', 'Mato Grosso'),
(12, 'MS', 'Mato Grosso do Sul'),
(13, 'MG', 'Minas Gerais'),
(14, 'PA', 'Pará'),
(15, 'PB', 'Paraíba'),
(16, 'PR', 'Paraná'),
(17, 'PE', 'Pernambuco'),
(18, 'PI', 'Piauí'),
(19, 'RJ', 'Rio de Janeiro'),
(20, 'RN', 'Rio Grande do Norte'),
(21, 'RS', 'Rio Grande do Sul'),
(22, 'RO', 'Rondônia'),
(23, 'RR', 'Roraima'),
(24, 'SC', 'Santa Catarina'),
(25, 'SP', 'São Paulo'),
(26, 'SE', 'Sergipe'),
(27, 'TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `participantes`
--

CREATE TABLE IF NOT EXISTS `participantes` (
  `login` varchar(20) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nomeCompleto` varchar(50) NOT NULL,
  `arquivoFoto` varchar(50) NOT NULL,
  `cidade` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `participantes`
--

INSERT INTO `participantes` (`login`, `senha`, `nomeCompleto`, `arquivoFoto`, `cidade`, `email`, `descricao`) VALUES
('amaury', 'a306bcac257001c1da4d9f332b8404d4', 'Amaury Gonçalves', 'img/amaury.jpg', 6, 'baugoncalves@gmail.com', 'Sou formado em Sistemas de Informação pela Faculdade Doctum. Meu início de desenvolvimento em web começou em agosto de 2011, em uma empresa que desenvolvia sites e sistemas em JavaScript, CSS, HTML, PHP e SGBD Mysql.\r\n\r\nGosto de assistir filmes, seriados e animes.'),
('andre', '19984dcaea13176bbb694f62ba6b5b35', 'André Simonelli', 'img/andre.jpg', 7, 'andresimonelli@gmail.com', 'Cursando Pós-Graduação em Desenvolvimento de Aplicações Web pela Pontifícia Universidade Católica (PUC-MG). Graduado em Design Digital pela Universidade Anhembi Morumbi - UAM (2010) e Tecnólogo em Projeto e Produção de Internet pela Universidade Anhembi Morumbi -UAM (2006). Atualmente atua como professor titular no Grupo de Formação Profissional ALLNET e professor autônomo no Serviço Nacional de Aprendizagem Comercial (SENAC-SP).'),
('anselmo', 'c49e5b9606b2f82f9b2010a18aea2c40', 'Anselmo Maciel Nunes', 'img/anselmo.jpg', 8, 'anselmomaciel@gmail.com', 'Graduado em Ciência da Computação pela UNISUL-SC em 1999. Analista de Sistemas do Tribunal de Justiça de Santa Catarina desde 2003. Além da paixão pela minha família, tento incansavelmente aprender a tocar guitarra.'),
('daniel', 'aa47f8215c6f30a0dcdb2a36a9f4168e', 'Daniel Oliveiros Almeida de Araújo', 'img/daniel.jpg', 9, 'DanO.A.Araujo@gmail.com', 'Formado em Ciência da Computação pela Universidade Vale do Rio Doce em 2011. Tenho como hobbies leitura, quebra-cabeças lógicos, assistir séries e filmes e escrever.'),
('daniela', '07a88e756847244f3496f63f473d6085', 'Daniela Gondim', 'img/daniela.jpg', 10, 'daniela.gondim2012@gmail.com', 'Sou formada em Sistemas de Informação pela Universidade de Uberaba e trabalho a 2 anos como Analista de Sistemas no setor de desenvolvimento.'),
('daniels', '7cd068f5aeb8deff0ec5a97d4bd82ccc', 'Daniel Severo Estrázulas', 'img/daniels.png', 8, 'daniel.estrazulas@gmail.com', 'Formado em ciências da computação pela FURB e atualmente na profissão de Analista de Sistemas no Instituto Federal de Santa Catarina. Meus hobbies são praticar Karatê e andar de bike. Já trabalhei como avaliador de aplicativos PAF-ECF e desenvolvimento Mobile. '),
('douglas', '3b16dc694c38d04f7d7451cc37d3c654', 'Douglas José Antunes Moreira', 'img/douglas.jpg', 11, 'doug*****@g****.com', 'Bacharel em Ciência da Computação, atua no desenvolvimento de aplicações web tendo como principal ferramenta php, kohana, jasper reports e jquery. Gosta de artes marciais, xadrez e eletrônica.'),
('edesio', '4b171cf1eca7699b89ee2eeecf3dd15e', 'Edésio Pereira de Souza', 'img/edesio.png', 12, 'edesiopsd@gmail.com', 'Sou formado em Ciência da Computação. Pratico futebol e ciclismo. Como hobbie, gosto de ler, jogar xadrez,  ver filmes/séries e desenhar.'),
('edson', 'cd4fbce046c46f107e45ae0ddd0db7d3', 'Edson Pinheiro de Figueiredo', 'img/edson.jpg', 13, 'edsonfigue@gmail.com', 'Sou professor de matemática da rede pública desde que me formei. Formado em Licenciatura em Matemática pela UFRJ em 2010. Cursei mestrado profissional em matemática na PUC-Rio de 2012 a 2013, mas não terminei. Minha experiência em informática foi os 2 anos em que atuei como professor de Informática para concursos públicos em cursos preparatórios. Sei pouco de web, ou melhor, quase nada. Escolhi este curso para justamente preencher esta lacuna. Gosto de ouvir música, ir a praia, viajar, e cozinhar. Sou casado e tenho um filho de 4 anos, que sempre quer brincar nas horas que tento estudar. Estou com grandes espectativas nesta especialização.'),
('elizangela', '0294470d5d4631335dd59d7d23ff7451', 'Elizangela Mattos Faria da Silva', 'img/elizangela.jpg', 14, ' email.elizangela@gmail.com', 'Formada em Análise de Sistemas pela Universidade Federal de MS, trabalho como coordenadora de informática em uma escola particular (Colégio Alexander Fleming). Sou apaixonada por boa música, livros e filmes. '),
('fernanda', 'b98a5a57d055dbabf959dcd6f36509ef', 'Fernanda Ramos de Carvalho', 'img/fernanda.jpg', 2, 'nandaramoscarvalho@hotmail.com', 'Formada em Ciência da Computação pela Universidade José do Rosário Vellano. Trabalho na área administrativa. Gosto muito de leitura, filmes e uma boa música.'),
('fernando', 'cebdd715d4ecaafee8f147c2e85e0754', 'Fernando Henrique Resende Campos', 'img/fernando.jpg', 15, 'fernandohrcampos@yahoo.com.br', 'Formado em Sistemas de Informação, atualmente trabalhando como supervisor de tecnologia da informação em uma instituição financeira. Amante da tecnologia e grande entusiasta com a ciência.'),
('francisco', 'f87e388d33364d9b1cba549175106da8', 'Francisco José de Sousa Junqueira', 'img/francisco.jpg', 16, 'francisco.l530175@gmail.com ', 'Minha formação inicial é licenciatura em matemática UFSJ e UNIG, matemática computacional (incompleto) UFMG, especialização em engenharia de software UFLA.\r\n\r\nTrabalho atualmente como professor na rede pública. Meu interesse principal nesse curso é acadêmico mesmo, em vista de um possível mestrado futuramente (informática na educação). \r\n\r\n#aprendizagem, #matemática, #programação #política #corridas'),
('gabriel', '647431b5ca55b04fdf3c2fce31ef1915', 'Gabriel Zago Marino', 'img/gabriel.jpg', 3, 'gabrielzmarino@gmail.com', 'Formado em Análise e Desenvolvimento de Sistemas pelo Centro Universitário do Espírito Santo (UNESC). Analista e desenvolvedor de sistemas em web, desktop, criação de websites, blogs, dentre outros. Trabalho com as linguagens: PHP, HTML, HTML5, JavaScript, Ajax, CSS e CSS3. Trabalho também com auditorias e melhorias em soluções de Segurança, Tecnologia da Informação e Infra-estrutura. Atuei em processos como Perito em Computação Forense. Possuo certificação Microsoft - MLSS Lite, além dos cursos MCP 2165B/2147B. Curso de Perito em Computação Forense, Curso em Gerenciamento de Sites em WordPress, dentre outros. Gosto de futebol, correr e sair com os amigos.'),
('jessica', 'aae039d6aa239cfc121357a825210fa3', 'Jéssica Cristiane F. Viana', 'img/jessica.jpg', 17, 'cristianne_jessica@hotmail.com', 'Formada em Sistemas para Internet no ano 2013, trabalho como professora de Ferramentas de Design para Web e bolsista na Universidade Federal, escolhi essa especialidade para  aprofundar meus conhecimentos e aprender mais sobre as novas tecnologias para web.'),
('joao', 'dccd96c256bc7dd39bae41a405f25e43', 'João Paulo da Silva C. Martinez', 'img/joao.jpg', 4, 'jp@amperstudio.com.br', 'Sou mineiro, mas acabei me mudando para o ES ainda muito jovem. Sempre gostei de tecnologia e descobrir como algo funciona. (até hoje me pego desmontando alguma coisa, e para monta de volta sempre sobram algumas coisinhas kkk). Sou bacharel em sistemas de informação, fundei junto com um amigo uma empresa de  soluções web, que tem dado muito certo.Amo muito o que eu faço e sinto a necessidade de continuar aprendendo.\r\n\r\nComo Hobbie, sou aspirante a desenhista, um bom rock e livros me deixam em paz. =) '),
('joaoa', '13f5fd6e213f6251ac009a6871472192', 'João Augusto Lima Ferreira', 'img/joaoa.jpg', 16, 'joaoaugusto@gmail.com', 'Possuo vivência em análise e desenvolvimento de sistemas, tenho proficiência em data warehouse, fiz cursos oficiais nas ferramentas Business Objects (OLAP) e Power Center (ETL). Também tenho vivência e formação oficial no banco de dados Oracle, além disso, sou certificado no sistema operacional Linux. Venho desenvolvendo aplicativos para WEB desde 2003, já utilizei as linguagens: PHP, Javascript, .Net, C#, Java, Ajax, Xajax. Já passei por micro empresas de desenvolvimento até grandes fábricas de software como IBM. Tenho interesse em engenharia de software, modelos de ciclo de vida de software, arquitetura de sistemas e Linux.'),
('patriciajosianne', '81dc9bdb52d04dc20036dbd8313ed055', 'Patrícia Josianne Silva Mascarenhas', 'img/patriciajosianne.png', 1, 'patriciajosianne@gmail.com', 'Fomada em Sistemas de Informação pela Faculdade Santo Agostinho. Trabalho com o desenvolvimento web há mais de 3 anos, atualmente trabalho com a linguagem Java utilizando frameworks como hibernate, spring e JSF.'),
('paulo', 'dd41cb18c930753cbecf993f828603dc', 'Paulo Gustavo Lopes Cândido', 'img/paulo.png', 5, 'pitelosy@gmail.com', 'Bacharel em Sistemas de Informação pela UFV-CRP (2012) e Gerente de Projetos da Realtec Sistemas (2009).');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
