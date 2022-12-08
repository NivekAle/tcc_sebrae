<?php

namespace App;

use App\Core\Base;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

?>
<!DOCTYPE html>


<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/login-vendedor.css">
	<title>Login | Innovament </title>
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
						Insira sua credências cadastradas como <strong>vendedor</strong>.
					</p>
					<form id="frm-login-vendedor" method="POST">
						<span class="c-input">
							<label class="c-input__label" for="vendedor-email">Email</label>
							<div class="c-input__entry">
								<input type="email" name="vendedor-email" id="vendedor-email" placeholder="exemplo@gmail.com">
							</div>
						</span>
						<span class="c-input">
							<label class="c-input__label" for="vendedor-email">Senha</label>
							<div class="c-input__entry">
								<input type="password" name="vendedor-senha" id="vendedor-senha" placeholder="*****">
								<i class="far fa-eye" id="btn-toggle-password"></i>
							</div>
						</span>
						<p>
							<a href="http://localhost/tcc/app/Views/Vendedor/recuperar-senha.php">Esqueceu a senha?</a>
						</p>
						<div class="my-3">
							<button class="w-100 c-btn c-btn__primary" id="btn-login">Entrar</button>
						</div>
					</form>
					<div class="text-center">
						<p>Ou</p>
						<p class="m-0">
							Não tem uma conta?
							<a href="http://localhost/tcc/app/Views/Vendedor/cadastro.php">
								Cadastre-se
							</a>
						</p>
						<a href="http://localhost/tcc/">Voltar ao Início</a>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php require_once("../partials/toast.php"); ?>

	<?php require_once("../partials/assets.php"); ?>
	<script type="module" src="http://localhost/tcc/public/js/login-vendedor.js"></script>
	<script type="module" src="http://localhost/tcc/public/js/Toast.js"></script>
</body>

</html>