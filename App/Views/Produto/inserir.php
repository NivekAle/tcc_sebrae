<?php

// namespace App;

use App\Helpers\Session;

require('A:\php\tech_solution.com.br\vendor\autoload.php');
Session::VerificarSessao();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://localhost/tech_solution.com.br/public/css/all.min.css">
	<link rel="stylesheet" href="http://localhost/tech_solution.com.br/public/css/bootstrap.min.css">
	<title>Document</title>
</head>

<body>
	<?php if (property_exists($_SESSION["sessao_usuario"], "vendedor")) { ?>
		<?php require("../partials/navbar-vendedor.php") ?>
	<?php } else { ?>
		<?php require("../partials/navbar.php") ?>
	<?php } ?>

	<main>
		<div class="produto-banner">
			<div class="container">
				<h1>Painel do produto</h1>
				<p>
					Aqui você consegue publicar um produto, remover editar ou visualizar os dados completos.
					Oque deseja fazer agora?
				</p>
				<div class="breadcrumb">
					<ul class="breadcrumb__labels">
						<li class="breadcrumb__item now">
							<a href="http://localhost/tech_solution.com.br/App/Views/Produto/painel.php">
								<i class="fas fa-home"></i> Painel <i class="fas fa-chevron-right"></i>
							</a>
						</li>
						<li class="breadcrumb__item now">Inserir Produto</li>
					</ul>
				</div>
			</div>

			<section class="inserir-produto">
				<div class="container">

					<div class="frm-produto">
						<div class="frm-produto-header">
							<h3>Insira um Produto</h3>
							<p>
								Preencha os campos correspondentes para criar um produto.
							</p>
						</div>
						<form class="frm-produto-form" id="frmInserirProduto">
							<div class="form-group">
								<label for="produto_nome">Nome</label>
								<span class="component-input">
									<input class="component-input__entry" type="text" name="produto_nome" id="produto_nome" placeholder="Produto Titulo">
								</span>
							</div>
							<div class="form-group">
								<label for="produto_descricao">Descrição</label>
								<span class="component-input">
									<textarea class="component-input__entry" name="produto_descricao" id="produto_descricao" placeholder="Descrição"></textarea>
								</span>
							</div>
							<div class="form-group">
								<label for="produto_preco">Preço</label>
								<span class="component-input">
									<input class="component-input__entry" type="number" name="produto_preco" id="produto_preco" placeholder="R$ 00,00"></input>
								</span>
							</div>
							<div class="form-group">
								<button>Criar Produto</button>
							</div>
						</form>
					</div>

				</div>
			</section>
		</div>
	</main>


	<script src="http://localhost/tech_solution.com.br/public/js/jquery-3.6.1.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/jquery.validate.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/additional-methods.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/jquery.mask.min.js"></script>
	<!-- <script src="http://localhost/tech_solution.com.br/public/js/inserir-produto.js"></script> -->

	<script>
		$("#frmInserirProduto").validate({
			rules: {
				produto_nome: {
					required: true
				},
				produto_descricao: {
					required: true
				},
				produto_preco: {
					required: true
				}
			},
			messages: {
				produto_nome: {
					required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`,
				},
				produto_descricao: {
					required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`
				},
				produto_preco: {
					required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`
				}
			},
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "http://localhost/tech_solution.com.br/App/Controllers/ProdutoController.php",
					data: {
						novo_produto: {
							"produto_nome": $("#produto_nome").val(),
							"produto_descricao": $("#produto_descricao").val(),
							"produto_preco": $("#produto_preco").val(),
							"vendedor_id": <?php echo $_SESSION["sessao_usuario"]->id; ?>,
						}
					},
					dataType: "json",
					success: function(response) {
						console.log(response);
					}
				});
			}
		})
	</script>
</body>

</html>