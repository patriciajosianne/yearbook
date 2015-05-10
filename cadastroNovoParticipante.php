<?php
	require_once("./bd/conexao.php");
	include_once("templates/cabecalho_login.html");

	try
	{
		$origem = basename($_SERVER['HTTP_REFERER']);
		if((count($_POST) != 9) && ($origem != 'cadastroParticipante.php')){
			header("Location:./acessoNegado.php");
			die();
		}else{			
			$nomeCompleto = utf8_decode(htmlspecialchars($_POST['nomeCompleto']));
			$email = utf8_decode(htmlspecialchars($_POST['email']));
			$desricao = utf8_decode(htmlspecialchars($_POST['descricao']));
			$estado = utf8_decode(htmlspecialchars($_POST['estado']));
			$cidade = utf8_decode(htmlspecialchars($_POST['cidade']));
			$login = utf8_decode(htmlspecialchars($_POST['login']));
			$senha = utf8_decode(htmlspecialchars($_POST['password']));
			$senhaConf = utf8_decode(htmlspecialchars($_POST['passwordConf']));

			if(($senha != $senhaConf) || (strlen($senha) < 4) || (strlen($senha) > 8)){
				header("Location:./erroCadastroSenha.php");
				die();
			}
			
			//Verificando se já existe participante com este login
			$conexao = conn_mysql();
			$SQLSelect = 'SELECT * FROM participantes WHERE login=?';
			$operacao = $conexao->prepare($SQLSelect);					  
					
			$pesquisar = $operacao->execute(array($login));
			$resultados = $operacao->fetchAll();
			$conexao = null;
			
			//Se existir um ou mais resultados é porque já existe participante com este login
			if (count($resultados) > 0){	
				header("Location:./erroCadastroLogin.php");
				die();
			}   
					
			$permissoes = array("gif", "jpeg", "jpg", "png", "image/gif", "image/jpeg", "image/jpg", "image/png");  //strings de tipos e extensoes validas
			$temp = explode(".", basename($_FILES["foto"]["name"]));
			$extensao = end($temp);

			if ((!((in_array($extensao, $permissoes)) && 
				(in_array($_FILES["foto"]["type"], $permissoes)) && 
				($_FILES["foto"]["size"] < $_POST["MAX_FILE_SIZE"]))) || ($_FILES["foto"]["error"] > 0)){
					header("Location:./erroCadastroFoto.php");
					die();
			}
			
			
			//move a foto para o local correto
			$caminhoUpload = "img/";  
			  
			if(!file_exists ( $caminhoUpload ))
				mkdir($caminhoUpload, 0700);  //permissoes de escrita, leitura e execucao
			
			$extensao = pathinfo(basename($_FILES["foto"]["name"]))['extension'];
			$pathCompleto = $caminhoUpload.$login.'.'.$extensao;
			if(!move_uploaded_file($_FILES["foto"]["tmp_name"], $pathCompleto)){
				header("Location:./erroCadastroFoto.php");
				die();
			}			
			$foto = $pathCompleto;
			
			$SQLInsert = 'INSERT INTO participantes (nomeCompleto, email, descricao, arquivoFoto, cidade, login, senha) VALUES (?,?,?,?,?,?,MD5(?))';
			
			$conexao = conn_mysql();			
			$operacao = $conexao->prepare($SQLInsert);					  
			$inserir = $operacao->execute(array($nomeCompleto, $email, $desricao, $foto, $cidade, $login, $senha));
			$conexao = null;
			if ($inserir){
				 echo "<h1>Cadastro efetuado com sucesso.</h1>\n";
				 echo "<p class=\"lead\"><a href=\"./index.php\">Página principal</a></p>\n";
			}
			else {
				echo "<h1>Erro na operação.</h1>\n";
					$arr = $operacao->errorInfo();		
					$erro = utf8_decode($arr[2]);
					echo "<p>$erro</p>";							
					echo "<p><a href=\"./cadastroParticipante.php\">Retornar</a></p>\n";
			}
		}
	} catch (PDOException $e){
		// caso ocorra uma exceção, exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
	}

	include_once("templates/rodape_login.html");

?>
