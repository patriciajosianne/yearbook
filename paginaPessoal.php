<?php
	require_once("./authSession.php");
	require_once("./bd/conexao.php");
	include_once("templates/cabecalho.html");
?>
        
        <section id="listaAlunos" style="margin:5em;">
			<?php
				$user = htmlspecialchars($_GET['user']);
				
				try{
					$conexao = conn_mysql();
					$SQLSelect = 'SELECT p.arquivoFoto, p.nomeCompleto, p.email, p.descricao, c.nomeCidade  FROM participantes p inner join cidades c on p.cidade = c.idCidade where login = ?';
	
					$operacao = $conexao->prepare($SQLSelect);
					$pesquisar = $operacao->execute(array($user));							
					$participante = $operacao->fetch();
					
					$conexao = null;				
				}catch (PDOException $e){
					echo "Erro!: " . $e->getMessage() . "<br>";
					die();
				}
				
				echo "<div class='starter-template'><h3 class='sub-header'> Dados Pessoais de ".$participante['nomeCompleto']."</h3></div>";
				echo " <figure><img src=".$participante['arquivoFoto']." alt=".$participante['nomeCompleto']." title=".$participante['nomeCompleto']." width='240' height='320'/></figure>";
				echo "<div id='dadosAluno'><dl><dt>Nome:</dt><dd class='nome'>".$participante['nomeCompleto']."</dd>";
				echo "<dt>E-mail:</dt><dd>".$participante['email']."</dd>";
				echo "<dt>Cidade:</dt><dd>".$participante['nomeCidade']."</dd>";
				echo " <dt>Descrição:</dt><dd>".$participante['descricao']."</dd> </dl></div>";
			?>
			<p><a href="paginaPrincipal.php" class="voltar">Voltar</a></p>
        </section>
		
<?php
	include_once("templates/rodape.html");
?>