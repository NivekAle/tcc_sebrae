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
	$comentarios = Comentarios::PegarComentariosProduto($_GET["id"]);
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
										<?php echo $produto->nome; ?>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6 text-end">
							<form id="frm-pesquisa">
								<span>
									<input type="text" placeholder="categoria, nome de produto">
									<button>
										<i class="fas fa-search"></i>
									</button>
								</span>
							</form>
						</div>
					</div>
				</div>
			</div>
		</header>

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
							<div class="row my-2" id="produto-imagens-min">
								<!-- <a href="" >
										<img src="" alt="" id="produto-imagem-min" width="100%" loading="lazy">
									</a> -->
							</div>
						</div>
						<!-- <php foreach ($imagens as $key => $imagem) { ?>
							<img class="produto-imagem" width="100%" src="<php echo Base::$url_imagens . $imagem->caminho ?>" alt="">
						<php } ?> -->
						<hr>
						<div class="produto-box">
							<h5>Descrição</h5>
							<p>
								<?php echo $produto->descricao; ?>
							</p>
						</div>
						<!--  Comentarios deste produto -->
						<section class="comentarios-section">
							<h5 class="text-center">
								<?php echo count($comentarios) ?> Comentários para este produto
							</h5>
							<div class="comentarios-section__form">
								<div class="row">
									<?php if (!property_exists($_SESSION["sessao_usuario"], "cnpj")) { ?>
										<div class="col-lg-6">
											<button type="button" class="c-btn c-btn__secondary" id="btn-novo-comentario">
												<i class="fas fa-comment"></i>
												Adicionar Comentário
											</button>
										</div>
									<?php }; ?>
									<!-- <div class="col-lg-6">
										<select name="filtar-comentarios" id="filtar-comentarios">
											<option value="1">Mais relevantes</option>
											<option value="2">Menos relevantes</option>
										</select>
									</div> -->
								</div>
							</div>
							<div class="comentarios-section__content">
								<?php require_once("../partials/comentarios.php"); ?>
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
								<!-- href="<php echo Base::$url_views . "Carrinho/carrinho.php"; ?>" -->
									<button class="w-100 c-btn c-btn__primary" id="btn-adicionar-carrinho" data-produto="<?php echo $produto->id; ?>">
										<i class="fas fa-cart-plus"></i>
										&nbsp;
										Adicionar ao Carrinho
									</button>
									<!-- <a class="produto-comprar-action" href="<php echo Base::$url_views . "Produto/compra.php"; ?>">
									Comprar
								</a> -->
								</div>
								<hr>
								<h6>dados ficticios -----------></h6>
								<div class="produto-detalhes-importantes">
									<p>Temas disponiveis</p>
									<ul>
										<li>Dark</li>
										<li>Light</li>
										<li>Red + Blue</li>
									</ul>
									<ul>
								</div>
								<div class="produto-detalhes-importantes__tecnologias">
									<p>Tecnologias usadas</p>
									<ul>
										<li>React JS</li>
										<li>PHP</li>
										<li>HTML</li>
										<li>CSS</li>
									</ul>
									<ul>
								</div>
								<ul>
									<li>repositorio : </li>
									<li>ultima atualzicao : </li>
									<li>publicado em : </li>
									<li>layout : responsive</li>
								</ul>
								<div class="produto__tags">
									<span class="c-tag">
										<a href="#">Dashboard</a>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</main>

	<?php require_once("../partials/toast.php"); ?>
	<?php require_once("../Comentarios/modal.php"); ?>

	<?php require_once("../partials/assets.php"); ?>
	<script type="module" src="<?php echo Base::$url_scripts . "produto.js" ?>"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "carrinho.js" ?>"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "Toast.js" ?>"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "comentarios.js" ?>"></script>

</body>

</html>