<?php

namespace App;

use App\Core\Base;
use App\Helpers\Session;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

Session::BloquearLoginComSessao();

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="<?php echo Base::$url_styles . "cadastro-usuario.css" ?>">
	<title>Cadastro</title>
</head>

<body>

	<main>
		<section class="cadastro-usuario">
			<div class="cadastro-usuario__content">
				<div class="row">
					<div class="col-lg-4" style="padding-right: 0px;">
						<div class="cadastro-content">
							<h4>
								Os melhores softwares para empresas e pequenos negócios.
							</h4>
							<img src="<?= Base::$url_imagens . "../images/1.png" ?>" alt="" width="100%">
						</div>
					</div>
					<div class="col-lg-8" style="padding-left: 0px;">
						<div class="form-content">
							<!-- <img src="<= Base::$url_imagens . "../images/logo.png" ?>" alt=""> -->
							<h3>
								Registre-se
							</h3>
							<p>
								cadastre-se e compre sistemas que vão ajudar o avançar no crescimento da sua empresa ou serviço!
							</p>
							<a href="http://localhost/tcc/">Voltar ao Início</a>
							<hr>
							<form id="frm-cadastro-usuario" method="POST">
								<div class="row">
									<div class="col-lg-12">
										<label for="">Nome Completo</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" class="" name="usuario-nome" id="usuario-nome">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">CPF</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="usuario-cpf" id="usuario-cpf">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">Data de Nascimento</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="date" name="usuario-data_nascimento" id="usuario-data_nascimento">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">Email</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="usuario-email" id="usuario-email">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="usuario-telefone">Telefone</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="usuario-telefone" id="usuario-telefone">
											</div>
										</span>
									</div>
									<div class="col-lg-4">
										<label for="">Cidade</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="usuario-cidade" id="usuario-cidade">
											</div>
										</span>
									</div>
									<div class="col-lg-4">
										<label for="">Estado</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="usuario-estado" id="usuario-estado">
											</div>
										</span>
									</div>
									<!-- <div class="col-lg-4">
										<label for="">País</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="usuario-pais" id="usuario-pais">
											</div>
										</span>
									</div> -->
									<div class="col-lg-4">
										<label for="">Pais</label>
										<select name="usuario-pais" id="usuario-pais" class="c-input__entry">
											<option selected="selected" value="">Selecionar o Pais</option>
											<?php foreach (Base::$paises as $index => $pais) { ?>
												<option value="<?= $pais; ?>">
													<?= $pais; ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-lg-6">
										<label for="">Senha</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="password" name="usuario-senha" id="usuario-senha">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">Confirmar Senha</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="password" name="usuario-confirmar-senha" id="usuario-confirmar-senha">
											</div>
										</span>
									</div>
								</div>
								<div class="my-1">
									<input type="checkbox" id="toggle-password">
									<label for="toggle-password">Mostrar Senha</label>
								</div>
								<div class="my-2 d-flex justify-content-between align-items-center">
									<a href="<?php echo Base::$url_views . "Usuario/login.php" ?>" class="link">
										<i class="fas fa-angle-left"></i>
										Já tenho cadastro
									</a>
									<button class="c-btn c-btn__primary" type="submit">Cadastrar-se</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

	</main>

	<?php require_once("../partials/toast.php"); ?>

	<?php require_once("../partials/assets.php"); ?>
	<script type="module" src="<?php echo Base::$url_scripts . "cadastro-usuario.js" ?>"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "Toast.js" ?>"></script>

</body>

</html>