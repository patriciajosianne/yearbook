<?php
	require_once("./bd/conexao.php");
	if(isset($_COOKIE['loginAutomatico'])){
	   header("Location: ./verificarLogin.php");
	}
	else if(isset($_COOKIE['loginParticipante']))
		$nomeUser = $_COOKIE['loginParticipante'];
		else $nomeUser="";

	include_once("templates/cabecalho_login.html");
?>		        
        <section id="sectionLogin">
			<div class="container">
				<div class="starter-template">
					<p><b>Aqui você encontra todos os colegas e conhece um pouco melhor cada um deles. Faça já seu <a href="./cadastroParticipante.php">cadastro</a>.</b></p>
					<form class="form-signin" role="form" method="post" action="./verificarLogin.php">
						<h3 class="form-signin-heading">Acesso ao Yearbook</h3>
						<input type="text" class="form-control" placeholder="Login" name="login" value="<?php echo $nomeUser?>"required autofocus>
						<input type="password" class="form-control" placeholder="Senha" name="passwd" required>
						<label>
						  <input type="checkbox"  name="lembrarLogin" value="loginAutomatico"> Permanecer conectado
						</label>
						<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
						<br>
						<button class="btn btn-lg btn-success btn-block" type="button" onclick="javascript:window.location.href='./cadastroParticipante.php'">Cadastrar-se</button>
					</form>
				</div>
				<p><b>Participantes cadastrados:</b></p>
				<div class="row">
					<?php
						try{
							$conexao = conn_mysql();
							$SQLSelect = 'SELECT login, nomeCompleto, arquivoFoto FROM participantes order by nomeCompleto';
							$operacao = $conexao->prepare($SQLSelect);					  
							$pesquisar = $operacao->execute();
							$participantes = $operacao->fetchAll();
							$conexao = null;							
							
						}catch (PDOException $e){
							echo "Erro!: " . $e->getMessage() . "<br>";
							die();
						}
						if(count($participantes) > 0){
							foreach($participantes as $participante){
								echo "\n<div class='col-sm-5 col-md-1'>";
								echo "<a href='paginaPessoal.php?user=".utf8_encode($participante['login'])."' class='thumbnail miniaturas'>";
								echo "<img src=".utf8_encode($participante['arquivoFoto'])." alt=".utf8_encode($participante['nomeCompleto'])." title=".utf8_encode($participante['nomeCompleto'])."/>";
								echo "</a>";
								echo "</div>";
							}
						}else{
							echo "Não existem participantes cadastrados.";
						}					
					?>
				</div>
			</div>
        </section>
		
<?php
	include_once("templates/rodape_login.html");
?>