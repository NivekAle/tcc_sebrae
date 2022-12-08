<?php

namespace App;

use App\Core\Base;
use App\DTO\ProdutosDTO;
use App\Helpers\Session;
use App\Models\Categoria;
use App\Models\Produto;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";


require($ROOT_DIR);
Session::VerificarSessao();
if (!empty($_GET["search_cat"])) {
	$todas_categorias = Categoria::PegarTodasCategorias();

	$categoria_atual = Categoria::PegarCategoria($_GET["search_cat"]);
	$produtos = ProdutosDTO::PegarProdutosPorCategoria($_GET["search_cat"]);
} else {
	header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
	exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="<?php echo Base::$url_styles . "categorias.css" ?>">
	<title></title>
</head>

<body>

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
					<h1>
						<?php echo $categoria_atual->nome; ?>
					</h1>
					<p>
						Escolha um para visualizar.
					</p>
				</div>
			</div>
		</div>

		<div class="filtrar-categorias">
			<div class="container">
				<div class="row">
					<?php if (!empty($produtos)) { ?>
						<?php foreach ($produtos as $key => $produto) { ?>
							<div class="col-lg-3">
								<div class="produto-card">
									<div class="produto-card__header">
										<img class="produto-card__image" src="<?php echo Base::$url_imagens . $produto->caminho; ?>" alt="<?php echo $produto->nome; ?>">
									</div>
									<div class="produto-card__body">
										<h6 class="produto-card__title">
											<a href="<?php echo Base::$url_views . "Produtos/produto.php?id=" . $produto->id; ?>">
												<?php echo $produto->nome; ?>
											</a>
										</h6>
										<p class="produto-card__by">
											por
											<strong>
												<?php echo $produto->nome_completo; ?>
											</strong>
										</p>
										<div class="produto-card__likes">
											<i class="fas fa-star"></i>
											<i class="fas fa-star-half-alt"></i>
											<i class="far fa-star"></i>
											<?php echo $produto->likes; ?>
										</div>
									</div>
									<div class="produto-card__footer">
										<p class="produto-card__price">
											R$ <?php echo number_format($produto->preco, 2, ",", ".") ?>
										</p>
										<a class="w-100 c-btn c-btn__secondary c-btn__secondary--outline d-block" href="http://localhost/tcc/app/Views/Produtos/produto.php?id=<?php echo $produto->id; ?>">
											Ver mais
										</a>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } else { ?>
						<div class="search-not-found">
							<div class="search-not-found__content">
								<img class="search-not-found__image" src="http://localhost/tcc/public/images/304.svg" alt="Nenhum produto foi encontrado com 1">

							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

	</main>

	<?php require_once("../partials/assets.php"); ?>

</body>

</html>