<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Power Software</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/meucss.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </head>
  <body>

    <div class="container-fluid">
		<div class="row">
		<div class="col-md-12"  id="titulo">
		<h1>Power Software</h1>
		</div>
	</div>
	<div class="row">
	</div>
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" href="index.php">Power Software</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="index.php">Home</a>
						</li>
						
								<li>
									<a href="download.php">Download</a>
								</li>
								<li>
									<a href="materias.php">Matérias</a>
								</li>
								
								<li>
									<a href="forum.php">Fórum</a>
								</li>
								
								<li class="divider">
								</li>
								<li>
							<?php
							session_start();
				if(isset($_SESSION['email'])){
						echo("<p></p>");
					}else{
						echo("<a href='cadastro.php'>Cadastro</a>");
						}
						?>
								</li>
							</ul>
						
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Busca">
						</div> 
						<button type="submit" class="btn btn-default">
							Pesquisar
						</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<?php		
									
									if(isset($_SESSION['senha'])== TRUE){
										
										if($_SESSION['user_type']==1){
											echo("<a href='tela_user_adm.php'>User</a>");
										
										}else{
										echo("<a href='tela_user.php'>User</a>");
									}
									}else{
										echo("<a href='login.php'>Login</a>");
									}
									
									?>
								</li>
								<li>
								<?php
									if(isset($_SESSION['email']) == TRUE){
										echo("<a href='logout.php'>Sair</a>");
									}
								?>
						</li>
				</div>	
			</nav>
			
			<div class="jumbotron" id="texto">
				<h2>
					Perguntas
				</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
			<div class="jumbotron">
				<h4>
					Perguntas
				</h4>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec molestie neque quis augue vehicula, at aliquam ante.
				</p>
					<div class="post-content">
						<img src="img/redes.jpg">
					</div>
				<p>
					<a class="btn" href="materias.php">Mais detalhes »</a>
				</p>
			</div>
		</div>
		<div class="col-md-8">
			
				<?php
				require_once("conexao.php");
					
					$consultaPergunta = mysqli_query($conexao, "SELECT * FROM pergunta WHERE id_pergunta = '".$_GET['id_pergunta']."'");
					if (!$consultaPergunta) {
						$erro = mysqli_error($conexao);
						//header("location:erro.php?erro=$erro");
						echo("$erro");
					}
					else 
					{   
						while ($row = mysqli_fetch_array($consultaPergunta, MYSQL_ASSOC)){
							$sqlUser = mysqli_query($conexao, 'SELECT * FROM user WHERE id_user = '.$row["id_user_fk"]);
							while ($rowUser = mysqli_fetch_array($sqlUser, MYSQL_ASSOC))
							{
								echo("<div class='jumbotron'>");
								echo ("<p>Pergunta de ".$rowUser["nome"]."</p> <br> <p>".$row['conteudo_pergunta']."</p>");
								$sqlRespostas = mysqli_query($conexao, 'SELECT id_resposta, conteudo_resposta, id_user_fk, nome FROM resposta, user WHERE id_user_fk = id_user AND id_pergunta_fk = '.$row["id_pergunta"]);
								while ($rowResposta = mysqli_fetch_array($sqlRespostas, MYSQL_ASSOC))
								{
									echo("<hr>");
									echo("resposta de ".$rowResposta['nome']."<br>".$rowResposta['conteudo_resposta']);
									echo("<hr>");
								}
								echo("<div class='fir'>
								<form action='processar_resposta.php' id='enviarResposta' method='post'>
								<h4 class='f'>Digite sua resposta abaixo para ser publicada:</h4></br>
								<textarea name='res' rows='3' cols='40' form='enviarResposta'></textarea></br>
								<input type='hidden' name='user_id' value='".$row["id_user_fk"]."'>
								<input type='hidden' name='pergunta_id' value='".$row["id_pergunta"]."'>
								<input type='submit' class='btn btn-default'/>
								</form></br>
								</div>");
								echo("</div>");
							}
						}
					}
				?>
				
		</div>
		<div class="col-md-2">
			<div class="jumbotron">
				<h4>
					Propaganda
				</h4>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec molestie neque quis augue vehicula, at aliquam ante.
				</p>
				<div class="post-content">
						<img src="img/17.jpg">
				</div>
				<p>
					<a class="btn" href="materias.php">Mais detalhes »</a>
				</p>
		</div>
	</div>
</div>

  </body>
</html>
