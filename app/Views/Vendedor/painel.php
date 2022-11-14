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


		<section class="vendedor-painel">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<?php require("../partials/vendedor-actions.php"); ?>
					</div>
					<div class="col-lg-9">
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
												<?php echo $produto->nome ?>
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
		</section>

	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="http://localhost/tcc/public/js/painel.js"></script>
</body>

</html>