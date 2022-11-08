<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php require_once("./app/Views/partials/head.php") ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/index.css">
	<title>Document</title>
</head>

<body class="">

	<main>
		<div class="initializing">
			<div class="container">
				<div class="selecionar-login">
					<h3>
						Bem-vindo!
					</h3>
					<p>
						Escolha uma das opções para fazer login.
					</p>
					<!-- <p>
						Entrar como :
					</p> -->
				</div>
				<div class="selecionar-login__opcoes">
					<div class="row">
						<div class="col-lg-6">
							<a class="selecionar-login__opcao" href="http://localhost/tcc/app/Views/usuario/login.php">
								<img width="100" src="http://localhost/tcc/public/images/vendedor-imagem.svg" alt="">
								<p>Usuário</p>
							</a>
						</div>
						<div class="col-lg-6">
							<a class="selecionar-login__opcao" href="http://localhost/tcc/app/Views/vendedor/login.php">
								<img width="100" src="http://localhost/tcc/public/images/usuario-imagem.svg" alt="">
								<p>Vendedor</p>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

</body>

</html>