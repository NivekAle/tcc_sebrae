<?php

namespace App;

use App\Core\Base;
use App\Core\Breadcrumb;
use App\Helpers\Session;
use App\Models\Categoria;
use App\Models\Imagem;

require($_SERVER['DOCUMENT_ROOT'] . 'tcc/vendor/autoload.php');

Session::VerificarSessao();
Base::IsSeller();

$todas_categorias = Categoria::PegarTodasCategorias();

?>

<!DOCTYPE html>


<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/adicionar-produto.css">
	<title>Adicionar Produto</title>
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
									<li class="breadcrumb__item breadcrumb__item--current">
										<i class="fas fa-angle-right"></i>
										Adicionar Produto
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
					<h1>Adicionar Produto</h1>
					<p>
						Insira os dados do software/template e depois as imagens.
					</p>
					<ul>
						<li data-bread="active">Dados do Produto <i class="fas fa-angle-right"></i></li>
						<li>Imagens do Produto</li>
					</ul>
				</div>
			</div>
		</div>

		<section class="adicionar-produto">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<?php require("../partials/vendedor-actions.php"); ?>
					</div>
					<div class="col-lg-9">
						<div class="row">
							<div class="col-lg-6">
								<h5>Dados do Produto</h5>
								<form id="frm-adicionar-produto">
									<input type="hidden" name="produto-vendedor" id="produto-vendedor" value="<?php echo $_SESSION["sessao_usuario"]->id; ?>">
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
									<div class="my-3">
										<p class="mb-2">Categorias</p>
										<select name="id_categoria" id="produto-categoria" class="c-input__entry">
											<?php foreach ($todas_categorias as $key => $item) { ?>
												<option value="<?php echo $key + 1; ?>">
													<?php echo $item->nome; ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<div class="my-3 atributos-produto">
										<h5>
											<i class="fas fa-layer-group"></i>
											Atributos
										</h5>
										<div class="row">
											<div class="col-lg-6">
												<span class="c-input">
													<label class="c-input__label" for="produto-atributo-nome">Nome</label>
													<div class="c-input__entry">
														<input type="text" id="produto-atributo-nome">
													</div>
												</span>
											</div>
											<div class="col-lg-6">
												<span class="c-input">
													<label class="c-input__label" for="produto-atributo-valor">Valor</label>
													<div class="c-input__entry">
														<input type="text" id="produto-atributo-valor">
													</div>
												</span>
											</div>
										</div>
										<button class="c-btn c-btn__secondary c-btn__secondary--outline" id="btn-adicionar-atributo" type="button">Adicionar</button>
									</div>
									<label for="produto-descricao" class="c-input__label">Descrição</label>
									<span class="c-input">
										<textarea class="c-input__entry" name="produto-descricao" id="produto-descricao" cols="70" rows="5"></textarea>
									</span>
									<div class="my-3">
										<button class="c-btn c-btn__primary" type="submit">
											Próximo
										</button>
									</div>
								</form>
							</div>
							<div class="col-lg-6">
								<h5>Prévia</h5>
								<div class="produto-card produto-card__preview" style="width: 255px;">
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
								<h5>Atributos</h5>
								<div class="preview-atributos">
									<table id="table-atributos">
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

	<?php require_once("../partials/toast.php"); ?>

	<?php require_once("../partials/assets.php"); ?>
	<script type="module" src="http://localhost/tcc/public/js/adicionar-produto.js"></script>

</body>

</html>