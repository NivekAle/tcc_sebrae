<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/login-vendedor.css">
	<title>Login | </title>
</head>

<body class="">

	<main>
		<section class="login">
			<div class="login-content">
				<h3>Login</h3>
				<p>
					Insira sua credencias cadastradas como <strong>vendedor</strong>.
				</p>
				<p>
					<a href="http://localhost/tcc/app/Views/Usuario/login.php">Sou usuário.</a>
				</p>
				<form id="frm-login-vendedor" method="POST">
					<span class="c-input">
						<label class="c-input__label" for="vendedor-email">Email</label>
						<div class="c-input__entry">
							<i class="fas fa-at c-input__icon"></i>
							<input type="email" name="vendedor-email" id="vendedor-email" placeholder="@gmailcom">
						</div>
					</span>
					<span class="c-input">
						<label class="c-input__label" for="vendedor-email">Senha</label>
						<div class="c-input__entry">
							<i class="fas fa-key c-input__icon"></i>
							<input type="password" name="vendedor-senha" id="vendedor-senha" placeholder="*****">
						</div>
					</span>
					<p>
						<a href="http://localhost/tcc/app/Views/Vendedor/recuperar-senha.php">Esqueceu a senha?</a>
					</p>
					<div class="my-3">
						<button class="c-btn c-btn__primary">Entrar</button>
					</div>
				</form>
				<div class="text-center">
					<p>Ou</p>
					<p>
						Não tem uma conta?
						<a href="http://localhost/tcc/app/Views/Vendedor/cadastro.php">
							Cadastre-se
						</a>
					</p>
				</div>
				<div class="ef-quadrado"></div>
			</div>
		</section>
	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="http://localhost/tcc/public/js/login-vendedor.js"></script>
</body>

</html>