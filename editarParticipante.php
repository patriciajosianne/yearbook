<?php
require_once("./authSession.php");
require_once("./bd/conexao.php");

try
{		
	if(count($_POST) != 8){
		header("Location:./erroEdicao.php");
		die();
	}
	//se existem os parâmetros...
	else{
		$nomeCompleto = utf8_decode(htmlspecialchars($_POST['nomeCompleto']));
		$email = utf8_decode(htmlspecialchars($_POST['email']));
		$desricao = utf8_decode(htmlspecialchars($_POST['descricao']));
		$estado = utf8_decode(htmlspecialchars($_POST['estado']));
		$cidade = utf8_decode(htmlspecialchars($_POST['cidade']));
		$login = utf8_decode(htmlspecialchars($_SESSION['nomeUsuario']));
		$senha = utf8_decode(htmlspecialchars($_POST['password']));
		$senhaConf = utf8_decode(htmlspecialchars($_POST['passwordConf']));
		
		if(($senha != '') || ($senhaConf != '')){
			if(($senha != $senhaConf) || (strlen($senha) < 4) || (strlen($senha) > 8)){
				header("Location:./erroAlteracaoSenha.php");
				die();
			}
		}
		
		$foto = '';
		if($_FILES['foto']['size'] != 0){
			$permissoes = array("gif", "jpeg", "jpg", "png", "image/gif", "image/jpeg", "image/jpg", "image/png");  //strings de tipos e extensoes validas
			$temp = explode(".", basename($_FILES["foto"]["name"]));
			$extensao = end($temp);

			if ((!((in_array($extensao, $permissoes)) && 
				(in_array($_FILES["foto"]["type"], $permissoes)) && 
				($_FILES["foto"]["size"] < $_POST["MAX_FILE_SIZE"]))) || ($_FILES["foto"]["error"] > 0)){
					header("Location:./erroAlteracaoFoto.php");
					die();
			}
			
			
			//move a foto para o local correto
			$caminhoUpload = "img/";  
						  
			if(!file_exists ( $caminhoUpload ))
				mkdir($caminhoUpload, 0700);  //permissoes de escrita, leitura e execucao
			
			$extensao = pathinfo(basename($_FILES["foto"]["name"]))['extension'];
			$pathCompleto = $caminhoUpload.$login.'.'.$extensao;
			
			if(!move_uploaded_file($_FILES["foto"]["tmp_name"], $pathCompleto)){
				header("Location:./erroAlteracaoFoto.php");
				die();
			}	
			
			//Verificando se já existe participante com este login
			$conexao = conn_mysql();
			$SQLSelect = 'SELECT arquivoFoto FROM participantes WHERE login=?';
			$operacao = $conexao->prepare($SQLSelect);					  
					
			$pesquisar = $operacao->execute(array($login));
			$arquivoFoto = $operacao->fetch();
			$conexao = null;

			if($arquivoFoto['arquivoFoto'] != $pathCompleto){
				unlink($arquivoFoto['arquivoFoto']);
			}
			
			$foto = $pathCompleto;
		}
		
		$conexao = conn_mysql();
		// cria instrução SQL parametrizada
		$SQLUpdate = 'UPDATE participantes SET nomeCompleto=?, email=?, descricao=?, cidade=?';
		
		if($senha != ''){
			$SQLUpdate = $SQLUpdate.', senha=MD5(?)';
		}
		
		if($foto != ''){
			$SQLUpdate = $SQLUpdate.', arquivoFoto=?';
		}
		
		$SQLUpdate = $SQLUpdate.' WHERE login=?';
					  
		$operacao = $conexao->prepare($SQLUpdate);

		if(($foto == '') && ($senha == '')){		
			$atualizacao = $operacao->execute(array($nomeCompleto, $email, $desricao, $cidade, $login));
		}else if(($foto == '') && ($senha != '')){		
			$atualizacao = $operacao->execute(array($nomeCompleto, $email, $desricao, $cidade, $senha, $login));
		}else if(($foto != '') && ($senha == '')){		
			$atualizacao = $operacao->execute(array($nomeCompleto, $email, $desricao, $cidade, $foto, $login));
		}else if(($foto != '') && ($senha != '')){		
			$atualizacao = $operacao->execute(array($nomeCompleto, $email, $desricao, $cidade, $senha, $foto, $login));
		} 	
		
		$conexao = null;
		if ($atualizacao){
			 header("Location: ./paginaPrincipal.php");
		}
		else {
			echo "<h1>Erro na operação.</h1>\n";
				$arr = $operacao->errorInfo();		//mensagem de erro retornada pelo SGBD
				echo "<p>".$arr[2]."</p>";			//deve ser melhor tratado em um caso real
			    echo "<p><a href=\"./paginaPrincipal.php\">Retornar</a></p>\n";
		}
    }
}
catch (PDOException $e)
{
    // caso ocorra uma exceção, exibe na tela
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}

?>
