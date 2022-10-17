<?php

namespace App;

use App\Models\Produto;
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
	<link rel="stylesheet" href="http://localhost/tech_solution.com.br/public/css/painel.css">
	<title>Painel do Vendedor</title>
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
						<li class="breadcrumb__item now"><i class="fas fa-home"></i> Painel</li>
					</ul>
				</div>
			</div>

			<section class="painel">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-12">
							<a href="http://localhost/tech_solution.com.br/App/Views/Produto/inserir.php" class="box-servico">
								<i class="fas fa-box"></i>
								<h5 class="box-servico__title">Adicionar Produto</h5>
							</a>
						</div>
						<div class="col-md-4 col-sm-12">
							<a href="http://localhost/tech_solution.com.br/App/Views/Produto/remover.php" class="box-servico">
								<i class="fas fa-box"></i>
								<h5 class="box-servico__title">Remover Produto</h5>
							</a>
						</div>
						<div class="col-md-4 col-sm-12">
							<a href="http://localhost/tech_solution.com.br/App/Views/Produto/editar.php" class="box-servico">
								<i class="fas fa-box"></i>
								<h5 class="box-servico__title">Editar Produto</h5>
							</a>
						</div>
						<div class="col-md-4 col-sm-12">
							<a href="http://localhost/tech_solution.com.br/App/Views/Produto/todos-produtos.php" class="box-servico">
								<i class="fas fa-box"></i>
								<h5 class="box-servico__title">Visualizar Produtos</h5>
							</a>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>

</body>

</html>