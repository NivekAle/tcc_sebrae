<?php

namespace App;

use App\Core\Base;
use App\Helpers\Session;
use App\Models\Categoria;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

Session::VerificarSessao();

$todas_categorias = Categoria::PegarTodasCategorias();

if (empty($_GET["search"]) || $_GET["search"] == "search") {
	header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/busca.css">
	<title>Pesquisa | Innovament</title>
</head>

<body>

	<!-- Verificando se é um usuario ou um vendedor -->
	<?php property_exists($_SESSION["sessao_usuario"], "cnpj") ? require_once("../partials/navbar-vendedor.php") : require_once("../partials/navbar.php");  ?>

	<main>
		<!-- Buscar pro categoria -->
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

		<section class="busca">
			<div class="container">
				<h4>
					Buscando por <?php echo $_GET["search"]; ?>
				</h4>
				<div class="row">
					<!-- <div class="col-lg-12 mb-3">
						<button class="c-btn c-btn__primary" id="btn-aplicar-filtros">
							Aplicar Filtros
						</button>
					</div> -->
					<!-- <div class="col-lg-4">
						<div class="box-filtro">
							<h5>Tecnologias</h5>
							<form id="filtro-preco">
								<ul>
									<li>
										<input type="checkbox" name="bootstrap" data-group="input-filtrar-produto" id="tecnologia-1">
										<label for="tecnologia-1">Bootstrap</label>
									</li>
									<li>
										<input type="checkbox" name="reactjs" data-group="input-filtrar-produto" id="tecnologia-2">
										<label for="tecnologia-2">React JS</label>
									</li>
									<li>
										<input type="checkbox" name="angularjs" data-group="input-filtrar-produto" id="tecnologia-3">
										<label for="tecnologia-3">Angular JS</label>
									</li>
									<li>
										<input type="checkbox" name="php" data-group="input-filtrar-produto" id="tecnologia-4">
										<label for="tecnologia-4">PHP</label>
									</li>
									<li>
										<input type="checkbox" name="wordpress" data-group="input-filtrar-produto" id="tecnologia-5">
										<label for="tecnologia-5">Wordpress</label>
									</li>
								</ul>
							</form>
						</div>
					</div> -->
					<div class="col-lg-12">
						<div class="status-busca"></div>
						<div class="filtragens">
							<div class="box-min">

							</div>
						</div>
						<div class="row" id="resultado"></div>
					</div>
				</div>
			</div>
		</section>

	</main>


	<?php require_once("../partials/assets.php"); ?>
	<script type="module" src="<?php echo Base::$url_scripts . "carrinho.js" ?>"></script>
	<script type="module" src="<?php echo Base::$url_scripts . "busca.js" ?>"></script>
</body>

</html>