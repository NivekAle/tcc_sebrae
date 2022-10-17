<?php

use App\Helpers\Session;
use App\Models\Produto;
use App\Models\Vendedor;

require('A:\php\tech_solution.com.br\vendor\autoload.php');

$produto_url_id = $_GET["id"];

$produto = Produto::PegarProduto($produto_url_id);

if (!$produto instanceof Produto) {
	header("Location: http://localhost/tech_solution.com.br/App/Views/Produto/");
	exit;
}

Session::VerificarSessao();


// pegadand dados do vendedor
$vendedor = Vendedor::PegarVendedor($produto_url_id);

if (!$vendedor instanceof Vendedor) {
	header("Location: http://localhost/tech_solution.com.br/App/Views/Produto/");
	exit;
}


// var_dump($vendedor);
// die();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://localhost/tech_solution.com.br/public/css/all.min.css">
	<link rel="stylesheet" href="http://localhost/tech_solution.com.br/public/css/bootstrap.min.css">
	<title>Title do produto</title>
</head>

<body>
	<?php if (property_exists($_SESSION["sessao_usuario"], "vendedor")) { ?>
		<?php require("../partials/navbar-vendedor.php") ?>
	<?php } else { ?>
		<?php require("../partials/navbar.php") ?>
	<?php } ?>

	<main class="produto-unico">

		<div class="breadcrumb">
			<ul class="breadcrumb__labels">
				<li class="breadcrumb__item now"><i class="fas fa-home"></i> Produtos </li>
				<li class="breadcrumb__item breadcrumb__item-now"> <?= $produto->nome ?> </li>
			</ul>
		</div>

		<div class="container">
			<h2>
				<?= $produto->nome ?>
			</h2>
			<div class="row">
				<div class="col-lg-8">
					<div class="produto-imagem bg-secondary w-100 h-100"></div>
				</div>
				<div class="col-lg-4">
					<h3>
						<?= $produto->nome ?>
					</h3>
					<p>
						<?= $produto->descricao ?>
					</p>
					<div class="produto-preco">
						<p><strong>Preço</strong></p>
						<p>R$ <?php echo number_format($produto->preco, 2, ",", ".") ?></p>
					</div>
					<button>Comprar</button>
				</div>
			</div>
			<div class="row">
				<div class="produto-footer">
					<p>Images meramente ilustrativas.</p>
					<p>vendido por : <strong><?= $vendedor->nome . " " . $vendedor->sobrenome ?></strong></p>
				</div>
			</div>
		</div>

	</main>

	<script src="http://localhost/tech_solution.com.br/public/js/jquery-3.6.1.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/jquery.validate.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/additional-methods.min.js"></script>
	<script src="http://localhost/tech_solution.com.br/public/js/jquery.mask.min.js"></script>
</body>

</html>