<?php

use App\Core\Base;
use App\Helpers\Session;
use App\Models\Produto;

require('d:/projects/php/tcc/vendor/autoload.php');

Session::VerificarSessao();
Base::IsSeller();
if (!empty($_GET["id"])) {
	$produto = Produto::PegarProduto($_GET["id"]);
} else {
	header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="<?php echo (new Base)::$url_styles . "imagens.css"; ?>">
	<title>Adicionar imagens</title>
</head>

<body>

	<?php property_exists($_SESSION["sessao_usuario"], "cnpj") ? require_once("../partials/navbar-vendedor.php") : require_once("../partials/navbar.php");  ?>

	<main>
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
										Painel
									</li>
									<li class="breadcrumb__item breadcrumb__item--current">
										<i class="fas fa-angle-right"></i>
										Adicionar Imagem do produto
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

		<section class="adicionar-imagem">
			<div class="container">
				<h2>Adicionando imagens para <?php echo $produto->nome; ?> </h2>
				<p>
					É importante que <strong>todos os seus produtos</strong> tenham uma imagem, caso você não as insira, o produto não terá uma boa visibilidade.
				</p>
				<div class="drag-component">
					<form id="frm-imagem-produto" method="POST" enctype="multipart/form-data" action="http://localhost/tcc/app/Controllers/ProdutoController.php">
						<input type="number" value="<?php echo $produto->id; ?>" name="produto-id">
						<span class="c-input">
							<input type="file" class="c-input c-input__secondary" name="produto-imagem[]" multiple>
						</span>
						<div class="my-3">
							<button type="submit" class="c-btn c-btn__secondary">Enviar</button>
						</div>
					</form>
				</div>
			</div>
		</section>
	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="http://localhost/tcc/public/js/imagem.js"></script>
</body>

</html>