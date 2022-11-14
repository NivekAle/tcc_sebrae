<?php

namespace App;

use App\Core\Base;
use App\Core\Breadcrumb;
use App\Helpers\Session;
use App\Models\Categoria;

require($_SERVER['DOCUMENT_ROOT'] . 'tcc/vendor/autoload.php');

Session::VerificarSessao();
Base::IsSeller();

$todas_categorias = Categoria::PegarTodasCategorias();

// echo $_SERVER['DOCUMENT_ROOT'] ."<br>";
// echo __DIR__ . "<br>";
// echo __FILE__;
// die();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/adicionar-produto.css">
	<title>Adicionar Produto</title>
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
									<li class="breadcrumb__item breadcrumb__item--current">
										<i class="fas fa-angle-right"></i>
										Adicionar Produto
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

		<?php require("../partials/vendedor-actions.php"); ?>

		<section class="adicionar-produto">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<h2>
							Adicionar um Produto
						</h2>
						<div class="breadcrumb-form">
							<ul>
								<li>Dados do Produto</li>
								<li>Imagens do Produto</li>
							</ul>
						</div>
						<form id="frm-adicionar-produto">
							<input type="text" name="produto-vendedor" id="produto-vendedor" value="<?php echo $_SESSION["sessao_usuario"]->id; ?>">
							<span class="c-input">
								<label class="c-input__label" for="produto-nome">Nome</label>
								<div class="c-input__entry">
									<i class="fas fa-tag"></i>
									<input type="text" name="produto-nome" id="produto-nome">
								</div>
							</span>
							<span class="c-input">
								<label class="c-input__label" for="produto-preco">Preço</label>
								<div class="c-input__entry">
									<i class="fas fa-money-bill-wave"></i>
									<input type="text" name="produto-preco" id="produto-preco">
								</div>
							</span>
							<select name="id_categoria" id="produto-categoria">
								<?php foreach ($todas_categorias as $key => $item) { ?>
									<option value="<?php echo $key + 1; ?>">
										<?php echo $item->nome; ?>
									</option>
								<?php } ?>
							</select>
							<!-- <span class="">
						<p>
							<i class="fas fa-tags"></i>
							Tags
						</p>
						<ul class="">
							<li>
								<label class="" for="produto-preco">Escola</label>
								<input type="checkbox" name="" id="" checked>
							</li>
							<li>
								<label class="" for="produto-preco">Arquivos</label>
								<input type="checkbox" name="" id="" checked>
							</li>
						</ul>
						<button class="c-btn c-btn__secondary c-btn__secondary--outline">
							Adicionar Tag
						</button>
					</span> -->
							<span class="c-input">
								<!-- <p class="" for="produto-preco">Descrição</p> -->
								<div class="c-input__entry">
									<textarea class="c-input c-input__secondary" name="produto-descricao" id="produto-descricao" cols="70" rows="5"></textarea>
								</div>
							</span>
							<div class="my-3">
								<button class="c-btn c-btn__primary" type="submit">
									Adicionar
								</button>
							</div>
						</form>
					</div>
					<!-- Previa do card -->
					<div class="col-lg-4">
						<h5>Prévia</h5>
						<div class="produto-card produto-card__preview">
							<div class="produto-card__header">
								<div class="produto-card__image"></div>
							</div>
							<div class="produto-card__body">
								<h6 class="produto-card__title">
									<output id="output-produto-title" for="produto-nome"></output>
								</h6>
								<p class="produto-card__by">
									por
									<strong>
										<a href="http://localhost/tcc/app/Views/Produtos/index.php?produtos_de=" title="Mais de thiago bruno flores condori">
											<?php echo $_SESSION["sessao_usuario"]->nome_completo; ?>
										</a>
									</strong>
								</p>
								<p class="produto-card__price">
									R$
									<output id="output-produto-preco" for="produto-preco"></output>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="http://localhost/tcc/public/js/adicionar-produto.js"></script>

</body>

</html>