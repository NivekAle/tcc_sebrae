<?php

namespace App;

use App\Core\Base;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="<?php echo Base::$url_styles . "cadastro-vendedor.css" ?>">
	<title>Cadastro | Innovament</title>
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
							<h3>
								Registre-se
							</h3>
							<p>
								cadastre-se e compre sistemas que vão ajudar o avançar no crescimento da sua empresa ou serviço!
							</p>
							<a href="http://localhost/tcc/">Voltar ao Início</a>
							<hr>
							<form id="frm-cadastro-vendedor">
								<div class="row">
									<div class="col-lg-12">
										<label for="">Nome Completo</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" class="" name="vendedor-nome" id="vendedor-nome">
											</div>
										</span>
									</div>
									<!-- <div class="col-lg-6">
										<label for="">CNPJ</label>
										<span class="c-input">
											<div class="c-input__entry">
												<i class="fas fa-lock" style="display: none;" id="cnpj-no-active"></i>
												<input type="text" name="vendedor-cnpj" id="vendedor-cnpj">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">CPF</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="vendedor-cpf" id="vendedor-cpf">
												<i class="fas fa-lock" style="display: none;" id="cpf-no-active"></i>
											</div>
										</span>
									</div> -->
									<div class="col-lg-6">
										<p class="mb-2">
											Selecione qual a melhor opção para você.
										</p>
										<ul class="lista-identificador">
											<li>
												<input type="radio" id="seleciona-cpf" name="selecionar-dado-unico" checked>
												<label for="seleciona-cpf">CPF</label>
											</li>
											<li>
												<input type="radio" id="seleciona-cnpj" name="selecionar-dado-unico">
												<label for="seleciona-cnpj">CNPJ</label>
											</li>
										</ul>
									</div>
									<div class="col-lg-6" id="box-indetificador" style="opacity: 0;">
										<label for="" id="vendedor-identificador">CPF</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="vendedor-cpf" id="" data-js="render-option">
											</div>
										</span>
									</div>
									<div class="col-lg-12">
										<label for="">Email</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="vendedor-email" id="vendedor-email">
											</div>
										</span>
									</div>
									<div class="col-lg-4">
										<label for="">Cidade</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="vendedor-cidade" id="vendedor-cidade">
											</div>
										</span>
									</div>
									<div class="col-lg-4">
										<label for="">Estado</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="text" name="vendedor-estado" id="vendedor-estado">
											</div>
										</span>
									</div>
									<div class="col-lg-4">
										<label for="">Pais</label>
										<select name="vendedor-pais" id="vendedor-pais" class="c-input__entry">
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
												<input type="password" name="vendedor-senha" id="vendedor-senha">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">Confirmar Senha</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input type="password" name="vendedor-senha_confirma" id="vendedor-senha_confirma">
											</div>
										</span>
									</div>
								</div>
								<div class="my-1">
									<input type="checkbox" id="toggle-password">
									<label for="toggle-password">Mostrar Senha</label>
								</div>
								<div class="my-2 d-flex justify-content-between align-items-center">
									<a href="<?php echo Base::$url_views . "Vendedor/login.php" ?>">
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
	<script type="module" src="<?php echo Base::$url_scripts . "cadastro-vendedor.js" ?>"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "Toast.js" ?>"></script>

</body>

</html>