<?php
session_start();
	
	require_once("./bd/conexao.php");
		
      if(isset($_POST["login"])){		//existe um login enviado via POST (formulário)
            $log = utf8_encode(htmlspecialchars($_POST["login"]));
            $senha = utf8_encode(htmlspecialchars($_POST["passwd"]));
			if(isset($_POST["lembrarLogin"]))
				$lembrar = utf8_encode(htmlspecialchars($_POST["lembrarLogin"]));
			else 
			    $lembrar="";
         
      }
      elseif(isset($_COOKIE["loginAutomatico"])){ 	//existe um cookie com nome senha --> login automático
            $log = utf8_encode(htmlspecialchars($_COOKIE["loginParticipante"]));
            $senha = utf8_encode(htmlspecialchars($_COOKIE["loginAutomatico"]));
		   }
        else{
	  	       header("Location:./erroLogin.php");
               die();
		}         
 try{
		$conexao = conn_mysql();
		$SQLSelect = 'SELECT * FROM participantes WHERE senha=MD5(?) AND login=?';
		$operacao = $conexao->prepare($SQLSelect);					  
				
		$pesquisar = $operacao->execute(array($senha, $log));
		$resultados = $operacao->fetchAll();
		$conexao = null;
		
		
		// se há zero ou mais de um resultado, login inválido.
		if (count($resultados)!=1){	
			header("Location:./erroLogin.php");
            die();
		}   
		else{ // se há um resultado, login confirmado.
			setcookie("loginParticipante", $log, time()+60*60*24*90); //guarda o login por 90 dias a partir de agora
			if(!empty($lembrar)){
 			    setcookie("loginAutomatico", $senha, time()+60*60*24*90); //guarda a senha por 90 dias a partir de agora	
			}
		   $_SESSION['auth']=true;
		   $_SESSION['nomeCompleto'] = $resultados[0]['nomeCompleto'];
		   $_SESSION['nomeUsuario'] = $log;
		   header("Location: ./paginaPrincipal.php");
		   die();
		}
	} //try
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
	}
?>