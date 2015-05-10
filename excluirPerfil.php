<?php
require_once("./authSession.php");
require_once("./bd/conexao.php");
	
	$login = utf8_decode(htmlspecialchars($_SESSION['nomeUsuario']));
	
	try{
		//Pegando diretório da foto e excluindo-a
		$conexao = conn_mysql();
		$SQLSelect = 'SELECT arquivoFoto FROM participantes WHERE login=?';
		$operacao = $conexao->prepare($SQLSelect);					  
				
		$pesquisar = $operacao->execute(array($login));
		$arquivoFoto = $operacao->fetch();
		$conexao = null;	
		
		unlink($arquivoFoto['arquivoFoto']);
		
		
		//Apagando usuário do banco de dados
		$conexao = conn_mysql();
		$SQLDelete = 'DELETE FROM participantes WHERE login=?';
		$operacao = $conexao->prepare($SQLDelete);
		$inserir = $operacao->execute(array($login));
		$conexao = null;
		
	
		$_SESSION = array();  //Limpa o vetor de sessão

		// Se queremos terminar a própria sessão, precisamos matar o cookie com o session_ID
		if (ini_get("session.use_cookies")) {					//verifica se a sessão usa cookies
			$params = session_get_cookie_params();				//carrega todos os parâmetros do cookie da sessão
			setcookie(session_name(), '', time() - 42000,		//configura um cookie exatamente igual para 42000seg (700h) atrás
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		
			setcookie('loginAutomatico', '', time() - 42000);
			setcookie('loginParticipante', '', time() - 42000);
		
		}
		session_destroy();		// Destruímos a sessão em si
		
		if ($inserir){
			 header("Location: ./index.php");
		}
		else {
			echo "<h1>Erro na operação.</h1>\n";
				$arr = utf8_decode($operacao->errorInfo());		//mensagem de erro retornada pelo SGBD
				echo "<p>$arr[2]</p>";							//deve ser melhor tratado em um caso real
			    echo "<p><a href=\"./mainPage.php\">Retornar</a></p>\n";
		}
		
	}catch (PDOException $e){
		// caso ocorra uma exceção, exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
	}
?>