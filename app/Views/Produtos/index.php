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
<html lang="pt-br">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/produtos.css">
	<title>Document</title>
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
							<a href="<?= "http://localhost/tcc/app/Views/Produtos/index.php?cat=" . $value->id ?>"><?= $value->nome ?></a>
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
									<li class="breadcrumb__item breadcrumb__item--current">
										<i class="fas fa-home"></i>
										Produtos
									</li>
								</ul>
							</div>
						</div>

					</div>
				</div>
			</div>
		</header> -->
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
					<!-- <php foreach ($todos_produtos as $index => $produto) { ?>
						<div class="col-lg-3">
							<div class="produto-card">
								<div class="produto-card__header">
									<img class="produto-card__image" src="<php echo Base::$url_imagens . $produto->caminho; ?>" alt="<php echo $produto->nome; ?>">
								</div>
								<div class="produto-card__body">
									<h6 class="produto-card__title">
										<a href="<php echo "http://localhost/tcc/app/Views/Produtos/produto.php?id=" . $produto->id; ?>"><php echo $produto->nome; ?></a>
									</h6>
									<p class="produto-card__by">
										por
										<strong>
											<php $dados_vendedores =  Vendedor::PegarVendedor($produto->id); ?>
											<a href="<php echo "http://localhost/tcc/app/Views/Produtos/index.php?produtos_de=" . $dados_vendedores->id; ?>" title="Mais de <php echo $dados_vendedores->nome_completo;  ?>"><php echo $dados_vendedores->nome_completo; ?></a>

										</strong>
									</p>
									<div class="produto-card__likes">
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half-alt"></i>
										<i class="far fa-star"></i>
										<php echo $produto->likes; ?>
									</div>
								</div>
								<div class="produto-card__footer">
									<p class="produto-card__price">
										R$ <php echo number_format($produto->preco, 2, ",", "."); ?>
									</p>
									<a class="w-100 c-btn c-btn__secondary c-btn__secondary--outline d-block" href="<php echo Base::$url_views . "/Produtos/produto.php?id=" . $produto->id; ?>">
										Ver mais
									</a>
								</div>
							</div>
						</div>
					<php } ?> -->
				</div>
			</div>
		</section>
	</main>


	<?php require_once("../partials/assets.php"); ?>
	<!-- <script type="module" src="<php echo Base::$url_scripts . "Toast.js" ?>"></script> -->
	<script type="module" src="<?php echo Base::$url_scripts . "produtos.js" ?>"></script>

</body>

</html>