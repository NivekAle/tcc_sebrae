<?php

namespace App;

use App\Models\Produto;
use App\Helpers\Session;

require('A:\php\tech_solution.com.br\vendor\autoload.php');

Session::VerificarSessao();
$todos_produtos = Produto::PegarProdutos();
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://localhost/tech_solution.com.br/public/css/all.min.css">
	<link rel="stylesheet" href="http://localhost/tech_solution.com.br/public/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://localhost/tech_solution.com.br/public/css/produtos.css">
	<title>Produtos</title>
</head>

<body>
	<?php if (property_exists($_SESSION["sessao_usuario"], "vendedor")) { ?>
		<?php require("../partials/navbar-vendedor.php") ?>
	<?php } else { ?>
		<?php require("../partials/navbar.php") ?>
	<?php } ?>

	<main class="produto">

		<div class="produto-banner">
			<div class="container">
				<h1>Produtos</h1>
				<p>Aqui você encontra os melhores softwares para uso seu trabalho <strong>freelancer</strong> ou <strong>empresa</strong></p>
				<div class="breadcrumb">
					<ul class="breadcrumb__labels">
						<li class="breadcrumb__item now"><i class="fas fa-home"></i> Produtos </li>
						<!-- <li class="breadcrumb__item breadcrumb__item-now">Produtos</li> -->
					</ul>
				</div>
			</div>

		</div>

		<div class="container">
			<div class="produtos-lista">
				<div class="row">
					<?php foreach ($todos_produtos as $key => $produto) { ?>
						<div class="col-md-3 col-sm-12">
							<div class="produto-card">
								<div class="produto-card__header">
									<!-- <img src="<php echo "http://localhost/tech_solution.com.br/App/Views/Produto/produto.php?id=" . "$produto->id" ?>" alt="<= $produto->nome ?>" class="produto-card__image"> -->
									<div class="produto-card__image"></div>
								</div>
								<div class="produto-card__body">
									<h5 class="produto-card__title"><?php echo $produto->nome ?></h5>
									<p class="produto-card__description"><?php echo $produto->descricao ?></p>
									<p class="produto-card__like"><i class="far fa-thumbs-up"></i> <?php echo $produto->likes ?></p>
								</div>
								<div class="produto-card__footer">
									<p class="produto-card__price">R$ <?php echo $produto->preco ?></p>
									<a class="produto-card__link" href="<?php echo "http://localhost/tech_solution.com.br/App/Views/Produto/produto.php?id=" . "$produto->id" ?>">ver mais</a>
								</div>
							</div>
						</div>
					<?php }
					?>
				</div>
			</div>
		</div>
	</main>

	<script src="http://localhost/tech_solution.com.br/public/js/jquery-3.6.1.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/jquery.validate.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/additional-methods.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/jquery.mask.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/produto.js"></script>

</body>

</html>