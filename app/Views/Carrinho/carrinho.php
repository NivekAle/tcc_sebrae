<?php

namespace App;

use App\Core\Base;
use App\Helpers\Session;
use App\Models\Categoria;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

Session::VerificarSessao();

// variaveis
$todas_categorias = Categoria::PegarTodasCategorias();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="<?php echo Base::$url_styles . "carrinho.css" ?>">
	<title>Meu Carrinho | Innovament</title>
</head>

<body>
	<!-- Verificando se é um usuario ou um vendedor -->
	<?php property_exists($_SESSION["sessao_usuario"], "cnpj") ? require_once("../partials/navbar-vendedor.php") : require_once("../partials/navbar.php");  ?>
	<main>

		<div class="todas-categorias bg-light">
			<div class="container">
				<div class="row">
					<div class="categorias-row">
						<?php foreach ($todas_categorias as $key => $value) { ?>
							<a href="<?= "http://localhost/tcc/app/Views/Categorias/index.php?search_cat=" . $value->id ?>"><?= $value->nome ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<!-- <header class="header-page">
			<div class="strip">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="breadcrumb">
								<ul class="breadcrumb__list">
									<li class="breadcrumb__item">
										<i class="fas fa-home"></i>
									</li>
									<li class="breadcrumb__item breadcrumb__item--current">
										<i class="fas fa-angle-right"></i>
										Carrinho
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header> -->

		<section class="carrinho">
			<div class="container">
				<header class="carrinho__header">
					<h3 class="m-0">Meu Carrinho</h3>
					<div class="gap-3">
						<button id="btn-sincronizar-carrinho" class="c-btn  c-btn__secondary c-btn__secondary--outline">
							Atualizar carrinho
						</button>
						<button id="btn-limpar-carrinho" class="c-btn c-btn__neutral">
							Limpar carrinho
						</button>
					</div>
				</header>
				<div class="carrinho__body">
					<div class="row">
						<div class="col-lg-8">
							<section class="carrinho__lista">
								<!-- <div class="carrinho_produtos"> -->
								<div id="renderizar-produtos">
									<!-- <h5>Nenhum produto adicionado</h5> -->
								</div>
								<!-- Carregar os produtos que o usuario selecionou -->
								<!-- </div> -->
							</section>
						</div>
						<div class="col-lg-4">
							<aside class="carrinho__calculos">
								<p>Total do seu carrinho</p>
								<!-- <span>dados ficticios</span> -->
								<strong class="carrinho__total"></strong>
								<hr>
								<button class="w-100 c-btn c-btn__primary">
									Próximo
								</button>
								<!--<hr>
							<h4>Resumo do Pedido</h4>
							<ul class="carrinho__todos__items">
								<li>1</li>
								<li>2</li>
								<li>3</li>
							</ul> -->
							</aside>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php require_once("../partials/toast.php"); ?>

	<?php require_once("../partials/assets.php"); ?>
	<!-- <script type="module" src="http://localhost/tcc/public/js/produto.js"></script> -->
	<script type="module" src="http://localhost/tcc/public/js/carrinho.js"></script>

</body>

</html>