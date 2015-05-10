<?php	
	include_once('bd/conexao.php');
	
	$id_estado = htmlspecialchars($_POST['id_estado']);
	
	
	try{
		$conexao = conn_mysql();
		$SQLSelect = 'SELECT * FROM cidades where idEstado = ? order by nomeCidade';
		$operacao = $conexao->prepare($SQLSelect);					  
		$pesquisar = $operacao->execute(array($id_estado));
		$cidades = $operacao->fetchAll();
		$conexao = null;
		
	}catch (PDOException $e){
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
	}
	
	$cidades_json = json_encode($cidades);
	echo $cidades_json;
?>