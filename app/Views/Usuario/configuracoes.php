<?php

namespace App;

use App\Core\Base;
use App\Helpers\Session;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

Session::VerificarSessao();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="<?php echo Base::$url_styles  . "configuracoes.css" ?>">
	<title>Editar Perfil</title>
</head>

<body>
	<!-- Verificando se é um usuario ou um vendedor -->
	<?php property_exists($_SESSION["sessao_usuario"], "cnpj") ? require_once("../partials/navbar-vendedor.php") : require_once("../partials/navbar.php");  ?>

	<main>
		<div class="hero">
			<div class="container">
				<div class="hero-content">
					<h1>Edite Seu Perfil</h1>
					<p>
						Tome cuidado ao editar seus dados, as modificações feitas a seguir são irreversíveis
					</p>
				</div>
			</div>
		</div>

		<section class="dados-usuario">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">

					</div>
					<div class="col-lg-8">
						<div class="dados-usuario__inputs">
							<form id="form-edit-usuario">
								<input type="hidden" name="usuario-id" id="usuario-id" value="<?php echo $_SESSION["sessao_usuario"]->id ?>">
								<div class="row">
									<div class="col-lg-12">
										<label for="">Nome Completo</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input value="<?php echo $_SESSION["sessao_usuario"]->nome_completo ?>" type="text" class="" name="usuario-nome" id="usuario-nome">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">CPF</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input value="<?php echo $_SESSION["sessao_usuario"]->cpf ?>" type="text" name="usuario-cpf" id="usuario-cpf">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">Data de Nascimento</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input value="<?php echo $_SESSION["sessao_usuario"]->data_nascimento ?>" type="date" name="usuario-data_nascimento" id="usuario-data_nascimento">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">Email</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input value="<?php echo $_SESSION["sessao_usuario"]->email ?>" type="text" name="usuario-email" id="usuario-email">
											</div>
										</span>
									</div>
									<div class="col-lg-6">
										<label for="">Telefone</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input value="<?php echo $_SESSION["sessao_usuario"]->telefone ?>" type="text" name="usuario-telefone" id="usuario-telefone">
											</div>
										</span>
									</div>
									<div class="col-lg-4">
										<label for="">Cidade</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input value="<?php echo $_SESSION["sessao_usuario"]->cidade ?>" type="text" name="usuario-cidade" id="usuario-cidade">
											</div>
										</span>
									</div>
									<div class="col-lg-4">
										<label for="">Estado</label>
										<span class="c-input">
											<div class="c-input__entry">
												<input value="<?php echo $_SESSION["sessao_usuario"]->estado ?>" type="text" name="usuario-estado" id="usuario-estado">
											</div>
										</span>
									</div>
									<div class="col-lg-4">
										<label for="">País</label>
										<select name="usuario-pais" id="usuario-pais" class="c-input__entry">
											<option selected="selected" value="">Selecionar o Pais</option>
											<?php foreach (Base::$paises as $index => $pais) { ?>
												<option value="<?= $pais; ?>">
													<?= $pais; ?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<button class="c-btn c-btn__primary">
									Salvar Alterações
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="<?php echo Base::$url_scripts . "configuracoes.js" ?>"></script>
</body>

</html>