<?php
	require_once("./authSession.php");
	require_once("./bd/conexao.php");
	include_once("templates/cabecalho.html");
?>
	<section>
		<div class="container">
			</br>
			<div class="starter-template">
				<h3 class="sub-header">Seja bem vindo(a) <?PHP echo $_SESSION['nomeCompleto'];?></h3>    
			</div>
			<div class="container">
				<?php				
					$user = htmlspecialchars($_SESSION['nomeUsuario']);
					
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
					
					echo " <figure><img src=".$participante['arquivoFoto']." alt=".$participante['nomeCompleto']." title=".$participante['nomeCompleto']." width='240' height='320'/></figure>";
					echo "<div id='dadosAluno'><dl><dt>Nome:</dt><dd class='nome'>".$participante['nomeCompleto']."</dd>";
					echo "<dt>E-mail:</dt><dd>".$participante['email']."</dd>";
					echo "<dt>Cidade:</dt><dd>".$participante['nomeCidade']."</dd>";
					echo " <dt>Descrição:</dt><dd>".$participante['descricao']."</dd> </dl></div>";
				?>
			</div>
			<div class="starter-template">
				<h3 class="sub-header">Participantes do Yearbook</h3>    
			</div>
			<form class="navbar-form " role="form" method="post" action="./paginaPrincipal.php">
				<div class="form-group">
					Filtrar: <input type="text" placeholder="Nome" name="filtro" class="form-control">
				</div>
				
				<button type="submit" class="btn btn-sm btn-default">Filtrar</button>
			</form>
			
			<section id="listaAlunos">
				<ul>
					<?php
						try{
							$conexao = conn_mysql();
							$SQLSelect = 'SELECT login, nomeCompleto, arquivoFoto FROM participantes where nomeCompleto like ? order by nomeCompleto';
							
							$filtro = isset($_POST['filtro']) ? htmlspecialchars($_POST['filtro']) : '';
							
							$operacao = $conexao->prepare($SQLSelect);
							$pesquisar = $operacao->execute(array('%'.$filtro.'%'));							
							$participantes = $operacao->fetchAll();
							$conexao = null;							
							
						}catch (PDOException $e){
							echo "Erro!: " . $e->getMessage() . "<br>";
							die();
						}
						if(count($participantes) > 0){
							foreach($participantes as $participante){
								echo "\n<li><a href='paginaPessoal.php?user=".$participante['login']."'><figure>";
								echo "<img src=".$participante['arquivoFoto']." alt=".$participante['nomeCompleto']." title=".$participante['nomeCompleto']."/>";
								echo "<figcaption>".$participante['nomeCompleto']."</figcaption></figure></a></li>";
							}
						}else{
							echo "Não existem participantes cadastrados.";
						}					
					?>
				</ul>
			</section>
		</div>
	</section>
<?php
	include_once("templates/rodape.html");
?>