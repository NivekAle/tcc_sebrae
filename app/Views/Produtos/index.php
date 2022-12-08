<?php

namespace App;

use App\Core\Base;
use App\Database\Database;
use App\DTO\ProdutosDTO;
use App\Models\Categoria;
use App\Models\Produto;
use App\Helpers\Session;
use App\Models\Imagem;
use App\Models\Vendedor;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

Session::VerificarSessao();
// $todos_produtos = Produto::PegarProdutos();
$todos_produtos = ProdutosDTO::PegarTodosProdutos();

$todas_categorias = Categoria::PegarTodasCategorias();

// $todas_imagens = Imagem::PegarTodasImagens();
?>


<!DOCTYPE html>


<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/produtos.css">
	<title>Innovament</title>
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

		<div class="hero">
			<div class="container">
				<div class="hero-content">
					<h1>Projetos & Templates</h1>
					<p>
						Escolha um para visualizar.
					</p>
				</div>
			</div>
		</div>

		<section class="todos-produtos">
			<div class="container">
				<div class="row" id="lista-produtos">
				</div>
			</div>
		</section>

		<!-- <section class="section-category">
			<div class="container position-relative">
				<h4>Gestão</h4>
		<div class="swiper swiper-componente-gestao">
			<div class="swiper-wrapper">

			</div>
			<div class="swiper-pagination"></div>
		</div>
		<div class="swiper-controller">
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
		</div>
		</section> -->

	</main>



	<?php require_once("../partials/assets.php"); ?>
	<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "produtos.js" ?>"></script>
</body>

</html>