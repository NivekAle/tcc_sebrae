<?php

namespace App;

use App\Core\Base;
use App\DTO\ProdutosDTO;
use App\Models\Produto;
use App\Helpers\Session;
use App\Models\Imagem;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

Session::VerificarSessao();
Base::IsSeller();

$todos_produtos_vendedor = ProdutosDTO::ProdutosVendedor($_SESSION["sessao_usuario"]->id);

// $todas_imagens = Imagem::PegarTodasImagens();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/painel.css">
	<title>Login | </title>
</head>

<body>

	<!-- Verificando se é um usuario ou um vendedor -->
	<?php property_exists($_SESSION["sessao_usuario"], "cnpj") ? require_once("../partials/navbar-vendedor.php") : require_once("../partials/navbar.php");  ?>

	<main>
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
										Painel
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
					<h1>Painel do Vendedor</h1>
					<p>
						Aqui você consegue adicionar, editar e desativar produtos. Estatísticas de suas vendas.
					</p>
					<p>Visualizando todos os seus produtos.</p>
				</div>
			</div>
		</div>

		<section class="vendedor-painel">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<?php require("../partials/vendedor-actions.php"); ?>
						<div class="my-3">
							<p class="m-0">Preço</p>
							<select data-group="filtros-produtos" name="filtrar-pro-preco" id="filtrar-pro-preco" class="c-input__entry">
								<option value="">Selecione o filtro</option>
								<option value="desc">Preço decrescente</option>
								<option value="asc">Preço crescente</option>
							</select>
							<button class="c-btn c-btn__secondary" id="btn-filtrar-produtos-vendedor">
								Aplicar
							</button>
						</div>
					</div>
					<div class="col-lg-9">
						<!-- <div class="row">
							<div class="col-lg-12 mb-3">
								<div class="row align-items-end">
									<div class="col-lg-2">
										<p class="m-0"><strong>Filtros </strong></p>
									</div>
									<div class="col-lg-3">
										<p class="m-0">Data</p>
										<select data-group="filtros-produtos" name="filtrar-pro-data" id="filtrar-pro-data" class="c-input__entry">
											<option value="">Selecione o filtro</option>
											<option value="desc">Decrescente</option>
											<option value="asc">Crescente</option>
										</select>
									</div>
									 <div class="col-lg-4">
										<input type="checkbox" name="produtos-desativados" id="cb-produtos-desativados">
										<label for="cb-produtos-desativados">Somente Desativados</label>
									</div>
								</div>
							</div>
						</div> -->
						<div class="row">
							<?php foreach ($todos_produtos_vendedor as $key => $produto) { ?>
								<div class="col-lg-12">
									<div class="produto-card produto-card__row" id="produto-<?= $produto->id; ?>">
										<div class="produto-card__header">
											<!-- <div class="produto-card__image"></div> -->
											<img class="produto-card__image" src="<?php echo Base::$url_imagens . $produto->caminho; ?>" alt="">
										</div>
										<div class="produto-card__body">
											<span>
												<h6 class="produto-card__title">
													<a href="<?php echo Base::$url_views . "/Produtos/produto.php?id=" .  $produto->id ?>"><?php echo $produto->nome ?></a>
												</h6>
												<p>
													R$ <?php echo number_format($produto->preco, 2, ",", ".") ?>
												</p>
											</span>
											<?php
											echo !$produto->status ? '<div class="produto-card__status"><i class="fas fa-exclamation-circle"></i><span class="info">Este produto esta desativado.</span></div>' : "";
											?>
										</div>
										<div class="produto-card__footer">
											<button id="btn-produto-card" onclick="CardDropdown(<?php echo $produto->id  ?>);">
												<i class="fas fa-ellipsis-v"></i>
											</button>
										</div>
										<div class="produto-card__dropdown">
											<ul>
												<li>
													<a href="<?php echo "http://localhost/tcc/app/Views/Vendedor/editar.php?id=" . $produto->id ?>">Editar</a>
												</li>
												<li>
													<a href="<?php echo "http://localhost/tcc/app/Views/Vendedor/remover.php?id=" . $produto->id ?>">Desativar</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>

	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="http://localhost/tcc/public/js/painel.js"></script>
</body>

</html>