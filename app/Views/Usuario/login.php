<?php

namespace App;

use App\Core\Base;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

?>

<!DOCTYPE html>


<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="<?php echo Base::$url_styles . "login-usuario.css" ?>">
	<title>Login | Innovament</title>
</head>

<body class="">

	<main>
		<section class="login">
			<div class="login-content">
				<div class="logo-wrapper">
					<img src="<?php echo Base::$url_imagens . "../images/logo.png"; ?>" alt="" width="100px">
				</div>
				<div class="login-body">
					<h3>Login</h3>
					<p>
						Insira sua credencias cadastradas como <strong>usuário</strong>.
					</p>
					<form id="frm-login-usuario" method="POST">
						<span class="c-input">
							<label class="c-input__label" for="usuario-email">Email</label>
							<div class="c-input__entry">
								<!-- <i class="fas fa-at c-input__icon"></i> -->
								<input type="email" name="usuario-email" id="usuario-email" placeholder="exemplo@gmail.com">
							</div>
						</span>
						<span class="c-input">
							<label class="c-input__label" for="usuario-email">Senha</label>
							<div class="c-input__entry">
								<input type="password" name="usuario-senha" id="usuario-senha" placeholder="*****">
								<i class="far fa-eye" id="btn-toggle-password"></i>
							</div>
						</span>
						<p>
							<a href="http://localhost/tcc/app/Views/Usuario/recuperar-senha.php">Esqueceu a senha?</a>
						</p>
						<div class="my-3">
							<button class="w-100 c-btn c-btn__primary" id="btn-login">Entrar</button>
						</div>
					</form>
					<div class="text-center">
						<p>Ou</p>
						<p class="m-0">
							Não tem uma conta?
							<a href="http://localhost/tcc/app/Views/Usuario/cadastro.php">
								Cadastre-se
							</a>
						</p>
						<a href="http://localhost/tcc/">Voltar ao Início</a>
					</div>
				</div>
			</div>
		</section>
	</main>

	<!-- Toast
	<div class="Toast">
		<div class="Toast-content">
			<i class="fas fa-info-circle"></i>
			<div class="Toast-message">
				<span>Atenção</span>
				<p class="Toast-text">
				</p>
			</div>
		</div>
		<i class="fas fa-times" id="btn-close-toast"></i>
		<div class="Toast-progress"></div>
	</div> -->
	<?php require_once("../partials/toast.php"); ?>

	<?php require_once("../partials/assets.php"); ?>
	<script type="module" src="http://localhost/tcc/public/js/login-usuario.js"></script>
	<script type="module" src="http://localhost/tcc/public/js/Toast.js"></script>
</body>

</html>