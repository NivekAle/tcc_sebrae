<?php

use App\Core\Base;
use App\Helpers\Session;
use App\Models\Imagem;
use App\Models\Produto;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

Session::VerificarSessao();
Base::IsSeller();
if (empty($_GET["id"])) {
	header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
	exit;
} else {
	$produto = Produto::PegarProduto($_GET["id"]);
	if (empty($_GET["id"])) {
		header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
	} else {
		$verificando_imagens = Imagem::PegarImagemProduto($_GET["id"]);
		if (!empty($verificando_imagens)) {
			header("Location: http://localhost/tcc/app/Views/Vendedor/painel.php");
		}
	}
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
		<div class="hero">
			<div class="container">
				<div class="hero-content">
					<h1>Adicionando imagens </h1>
					<p>
						É importante que <strong>todos os seus produtos</strong> tenham uma imagem, caso você não as insira, o produto não será publicado e aparecerá como desativado até que você insira imagens.
					</p>
					<ul>
						<li>Dados do Produto <i class="fas fa-angle-right"></i></li>
						<li data-bread="active">Imagens do Produto</li>
					</ul>
				</div>
			</div>
		</div>

		<section class="adicionar-imagem">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<?php require("../partials/vendedor-actions.php"); ?>
					</div>
					<div class="col-lg-9">
						<form id="frm-imagem-produto" method="POST" enctype="multipart/form-data" action="http://localhost/tcc/app/Controllers/ProdutoController.php">
							<input type="hidden" value="<?php echo $produto->id; ?>" name="produto-id">
							<span class="c-input">
								<input type="file" class="c-input c-input__secondary" name="produto-imagem[]" multiple>
							</span>
							<div class="my-3">
								<button type="submit" class="c-btn c-btn__secondary">Enviar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="http://localhost/tcc/public/js/imagem.js"></script>
</body>

</html>