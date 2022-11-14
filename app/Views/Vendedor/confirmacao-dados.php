<?php

namespace App;

use App\Core\Base;
use App\Models\Vendedor;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);


if (!empty($_GET["conta"]) and !empty($_GET["data"])) {
	$vendedor = Vendedor::PegarSomenteVendedor($_GET["conta"]);
} else {
	header("Location: http://localhost/tcc/app/");
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="<?php echo Base::$url_styles . "/confirmacao.css" ?>">
	<title>Confirmar Dados | Innovament</title>
</head>

<body>
	<main>

		<div class="app">
			<div class="container">
				<div class="app__content">
					<div class="app__block">

						<div class="app__header">
							<img src="<?php echo Base::$url_imagens . "../images/logo.png" ?>" alt="Logo da Innovament">
						</div>
						<div class="app__body">
							<h3>Bem vindo(a), <?= $vendedor->nome_completo; ?></h3>
							<p>
								Este é o ultimo passo.
							</p>
							<p>
								Por favor, selecione qual dado deseja registrar.
							</p>

							<div class="opcoes">
								<ul>
									<li class="opcao-1">
										<input type="radio" id="opcao-cpf" name="opcao-cod">
										<label for="opcao-cpf">CPF</label>
									</li>
									<li class="opcao-2">
										<input type="radio" id="opcao-cnpj" name="opcao-cod">
										<label for="opcao-cnpj">CNPJ</label>
									</li>
								</ul>
							</div>

							<form id="frm-confirmar-dado" class="">
								<span class="c-input">
									<label class="c-input__label" for="data-unique"></label>
									<div class="c-input__entry">
										<!-- <i class="fas fa-key c-input__icon"></i> -->
										<input type="text" name="cpf" id="data-unique">
									</div>
								</span>
								<button class="c-btn c-btn__primary">Salvar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php require("../partials/assets.php"); ?>

	<script>
		$(document).ready(function() {});


		$(document).ready(function() {
			$("#opcao-cpf").click(function() {
				$("#data-unique").val("");
				$("#frm-confirmar-dado").prop("class", "active");
				$("#data-unique").prop("name", "vendedor-cpf");
				$("#data-unique").prop("placeholder", "000.000.000-00");
				$("#data-unique").mask("000.000.000-00");
				$("label[for='data-unique'").empty();
				$("label[for='data-unique'").html("CPF")
			});

			$("#opcao-cnpj").click(function() {
				$("#data-unique").val("");
				$("#data-unique").prop("name", "vendedor-cnpj");
				$("#data-unique").prop("placeholder", "00.000.00/0000-00");
				$("#data-unique").mask("00.000.00/0000-00");
				$("label[for='data-unique'").empty();
				$("label[for='data-unique'").html("CNPJ")
				$("#frm-confirmar-dado").prop("class", "active");
			})
		});

		$("#frm-confirmar-dado").validate({
			rules: {
				'vendedor-cpf': {
					required: true
				},
				'vendedor-cnpj': {
					required: true
				}
			},
			messages : {
				'vendedor-cpf': {
					required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
				},
				'vendedor-cnpj': {
					required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
				}

			}
		});
	</script>
</body>

</html>