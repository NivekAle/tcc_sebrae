<?php

namespace App;

use App\Core\Base;
use App\Models\Categoria;
use App\Models\Produto;
use App\Helpers\Session;
use App\Models\Vendedor;
use App\Models\Comentarios;
use App\Models\Imagem;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

Session::VerificarSessao();

$todas_categorias = Categoria::PegarTodasCategorias();
// Base::IsSeller();

// $todos_produtos = Produto::PegarProdutos();


if (!empty($_GET["id"])) {
	$produto = Produto::PegarProduto($_GET["id"]);
	$vendedor = Vendedor::PegarVendedor($_GET["id"]);
	// $comentarios = Comentarios::PegarComentariosProduto($_GET["id"]);
	$imagens = Imagem::PegarImagemProduto($_GET["id"]);

	if ($produto == null and $vendedor) {
		header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
		exit;
	}
} else {
	header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
	exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/produto.css">
	<title><?php echo $produto->nome ?> | Innovament</title>
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

		<!--
			<header class="header-page">
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
											<php echo $produto->nome; ?>
										</li>
									</ul>
								</div>
							</div>

						</div>
					</div>
				</div>
			</header>
	-->

		<section class="produto">
			<div class="container">
				<h3 class="produto-title">
					<?php echo $produto->nome; ?>
				</h3>
				<p>vendido por <strong> <?php echo $vendedor->nome_completo; ?></strong></p>
				<div class="row">
					<div class="col-lg-8">
						<div class="produto-image">
							<img src="" alt="" id="produto-imagem-main" width="100%" loading="lazy">
						</div>
						<div class="row my-2" id="produto-imagens-actions">
							<div class="row">
								<div class="col-lg-4">
									<button class="c-btn c-btn__secondary c-btn__secondary--outline" type="button" id="btn-todas-imagens">
										<i class="far fa-images"></i>
										Screenshots
									</button>
								</div>
							</div>
						</div>
						<hr>
						<div class="produto-box">
							<h5>Descrição</h5>
							<p>
								<?php echo $produto->descricao; ?>
							</p>
						</div>
						<!--  Comentarios deste produto -->
						<section class="comentarios-section">
							<h5 class="text-center" id="produto-total-comentario">
								<!-- <php echo count($comentarios) ?> Comentários para este produto -->
							</h5>
							<div class="comentarios-section__form">
								<div class="row">
									<?php if (!property_exists($_SESSION["sessao_usuario"], "cnpj")) { ?>
										<div class="col-lg-6">
											<button type="button" class="c-btn c-btn__secondary c-btn__secondary--outline" id="btn-novo-comentario">
												<i class="fas fa-comment"></i>
												<!-- Fazer um Comentário -->
											</button>
										</div>
									<?php }; ?>
								</div>
							</div>
							<div class="comentarios-section__content">
								<?php require_once("../partials/comentarios.php"); ?>
							</div>
							<div class="comentarios-section__action">
								<button class="c-btn c-btn__primary c-btn__primary--outline" id="btn-todos-comentarios">Ver mais</button>
							</div>
						</section>
					</div>
					<div class="col-lg-4">
						<div id="sidebar-fixed">
							<div class="produto__details">
								<h4>
									<span>
										R$
									</span>
									<?php echo number_format($produto->preco, 2, ",", "."); ?>
								</h4>
								<div class="produto-actions">
									<?php if (!property_exists($_SESSION["sessao_usuario"], "cnpj")) { ?>
										<button class="w-100 c-btn c-btn__primary" id="btn-adicionar-carrinho" data-produto="<?php echo $produto->id; ?>">
											<i class="fas fa-cart-plus"></i>
											&nbsp;
											Adicionar ao Carrinho
										</button>
									<?php }; ?>
									<!-- href="<php echo Base::$url_views . "Carrinho/carrinho.php"; ?>" -->
									<!-- <a class="produto-comprar-action" href="<php echo Base::$url_views . "Produto/compra.php"; ?>">
									Comprar
								</a> -->
								</div>
								<!-- <h6>dados ficticios </h6> -->
								<div class="produto-detalhes-importantes">
									<table class="">
										<tbody>
											<tr>
												<td>Last Update</td>
												<td>
													<time class="updated" datetime="2022-09-18T17:09:01+10:00">
														18 September 2022
													</time>
												</td>
											</tr>
											<tr>
												<td>Published</td>
												<td>
													<span>
														24 January 2022
													</span>
												</td>
											</tr>

											<tr>
												<td>High Resolution</td>
												<td>
													<span>Yes</span>
												</td>
											</tr>
											<tr>
												<td>Compatible Browsers</td>
												<td>
													<a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/compatible-browsers/firefox">Firefox</a>, <a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/compatible-browsers/safari">Safari</a>, <a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/compatible-browsers/opera">Opera</a>, <a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/compatible-browsers/chrome">Chrome</a>, <a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/compatible-browsers/edge">Edge</a>
												</td>
											</tr>
											<tr>
												<td>Compatible With</td>
												<td>
													<a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/compatible-with/bootstrap%204.x">Bootstrap 4.x</a>
												</td>
											</tr>
											<tr>
												<td>ThemeForest Files Included</td>
												<td>
													<a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/themeforest-files-included/html%20files">HTML Files</a>, <a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/themeforest-files-included/css%20files">CSS Files</a>, <a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/themeforest-files-included/sass%20files">Sass Files</a>, <a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/themeforest-files-included/scss%20files">SCSS Files</a>, <a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/themeforest-files-included/js%20files">JS Files</a>
												</td>
											</tr>
											<tr>
												<td>Columns</td>
												<td>
													<span>2</span>
												</td>
											</tr>
											<tr>
												<td>Documentation</td>
												<td>
													<a rel="nofollow" class="js-item-sidebar-meta-attributes" href="/attributes/documentation/well%20documented">Well Documented</a>
												</td>
											</tr>
											<tr>
												<td>Layout</td>
												<td>
													<span>Responsive</span>
												</td>
											</tr>
											<tr>
												<td>Tags</td>
												<td><span class="meta-attributes__attr-tags">
														<a title="admin" rel="nofollow" href="/search/admin">admin</a>, <a title="admin dashboard" rel="nofollow" href="/search/admin dashboard">admin dashboard</a>, <a title="admin template" rel="nofollow" href="/search/admin template">admin template</a>, <a title="bootstrap" rel="nofollow" href="/search/bootstrap">bootstrap</a>, <a title="bootstrap 5" rel="nofollow" href="/search/bootstrap 5">bootstrap 5</a>, <a title="dark mode" rel="nofollow" href="/search/dark mode">dark mode</a>, <a title="laravel" rel="nofollow" href="/search/laravel">laravel</a>, <a title="laravel dashabord" rel="nofollow" href="/search/laravel dashabord">laravel dashabord</a>, <a title="laravel vue" rel="nofollow" href="/search/laravel vue">laravel vue</a>, <a title="vue" rel="nofollow" href="/search/vue">vue</a>, <a title="vue 3" rel="nofollow" href="/search/vue 3">vue 3</a>, <a title="vue admin" rel="nofollow" href="/search/vue admin">vue admin</a>, <a title="vue dashboard" rel="nofollow" href="/search/vue dashboard">vue dashboard</a>, <a title="vue3" rel="nofollow" href="/search/vue3">vue3</a>, <a title="vuejs" rel="nofollow" href="/search/vuejs">vuejs</a>
													</span></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</main>

	<div class="carrosel">
		<div class="carrosel__content">
			<button id="btn-carrosel-anterior"><i class="fas fa-chevron-left"></i></button>
			<div class="carrosel__image">
				<img src="" alt="" id="carrosel-imagem-atual">
			</div>
			<button id="btn-carrosel-proximo"><i class="fas fa-chevron-right"></i></button>
		</div>
	</div>

	<?php require_once("../partials/toast.php"); ?>
	<?php require_once("../Comentarios/modal.php"); ?>
	<?php require_once("../Comentarios/todos.php"); ?>

	<?php require_once("../partials/assets.php"); ?>
	<script type="module" src="<?php echo Base::$url_scripts . "produto.js" ?>"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "carrinho.js" ?>"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "Toast.js" ?>"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "comentarios.js" ?>"></script>

</body>

</html>