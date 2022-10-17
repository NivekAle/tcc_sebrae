<?php

require('A:\php\tech_solution.com.br\vendor\autoload.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="public/css/all.min.css">
	<link rel="stylesheet" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/index.css">
	<link rel="stylesheet" href="public/css/login.css">
	<title>Login | Tech Solution</title>
</head>

<body>
	<main>
		<section class="login-section">
			<div class="container">
				<div class="form">
					<div class="form__head">
						<h1>Login</h1>
						<p>
							Insira suas credencias.
						</p>
					</div>
					<div class="form__body">
						<form id="frmLogin" method="POST">
							<div class="form-group">
								<label for="login_email">Email</label>
								<span class="component-input">
									<input class="component-input__entry" type="email" name="login_email" id="login_email" placeholder="@examplo.com">
								</span>
							</div>
							<div class="form-group">
								<label for="login_senha">Senha</label>
								<span class="component-input">
									<input class="component-input__entry" type="password" name="login_senha" id="login_senha" placeholder="Insira sua senha aqui.">
								</span>
							</div>
							<div class="form-group">
								<a href="/recuperar-senha">Esqueceu sua senha?</a>
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Entrar</button>
							</div>
						</form>
						<div class="form__footer">
							<p>Ou</p>
							<a href="/cadatro">Cadastre-se</a>
						</div>
					</div>
					<div class="efffect-quadrado"></div>
				</div>
			</div>
		</section>
	</main>

	<script src="public/js/jquery-3.6.1.min.js"></script>
	<script src="public/js/jquery.validate.min.js"></script>
	<script src="public/js/additional-methods.min.js"></script>
	<script src="public/js/jquery.mask.min.js"></script>
	<script src="public/js/login.js"></script>

</body>

</html>