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
							<a href="<?= "http://localhost/tcc/app/Views/Categorias/index.php?search_cat=" . $value->id ?>"><?= $value->nome ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

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
							<div class="row align-items-center">
								<div class="col-lg-4">
									<button class="c-btn c-btn__secondary c-btn__secondary--outline" type="button" id="btn-todas-imagens">
										<i class="far fa-images"></i>
										Screenshots
									</button>
									<?php if (!property_exists($_SESSION["sessao_usuario"], "cnpj")) { ?>
										<button class="c-btn c-btn__secondary c-btn__secondary--outline" type="button" id="btn-like-produto">
											<i class="far fa-heart"></i>
											Like
										</button>
									<?php } ?>
								</div>
								<div class="col-lg-8 text-end">
									<p class="m-0 text-danger" id="total-likes">
										<i class="fas fa-heart"></i>
										<strong><?php echo $produto->likes; ?></strong>
									</p>
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
							</h5>
							<div class="comentarios-section__form">
								<div class="row">
									<?php if (!property_exists($_SESSION["sessao_usuario"], "cnpj")) { ?>
										<div class="col-lg-6">
											<button type="button" class="c-btn" id="btn-novo-comentario">
												<i class="fas fa-comment"></i>
												&nbsp;
												Adicionar comentario
											</button>
										</div>
									<?php } ?>
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
								</div>

								<div class="produto-detalhes-importantes my-3">
									<table class="produto-atributos">
										<tbody>
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
	<script type="module" src="<?php echo Base::$url_scripts . "likes.js" ?>"></script>

</body>

</html>