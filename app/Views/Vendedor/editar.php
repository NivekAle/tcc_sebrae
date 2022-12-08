<?php

namespace App;

use App\Core\Base;
use App\Models\Categoria;
use App\Models\Imagem;
use App\DTO\ProdutosDTO;
use App\Helpers\Session;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);
Session::VerificarSessao();

$todas_categorias = Categoria::PegarTodasCategorias();

if (!empty($_GET["id"])) {
	$produto = ProdutosDTO::PegarProduto($_GET["id"]);
	if ($produto == null) {
		header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
		exit;
	}
} else {
	header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
	exit;
}
?>
<!DOCTYPE html>


<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/editar-produto.css">
	<title>Editar Produto | Innovament</title>
</head>

<body class="">

	<!-- Verificando se é um usuario ou um vendedor -->
	<?php property_exists($_SESSION["sessao_usuario"], "cnpj") ? require_once("../partials/navbar-vendedor.php") : require_once("../partials/navbar.php");  ?>

	<main>

		<div class="hero">
			<div class="container">
				<div class="hero-content">
					<h1>Editar Produto</h1>
					<p>
						Edite os dados do software/template e depois as imagens.
					</p>
					<ul>
						<li data-bread="active">Dados do Produto</li>
					</ul>
				</div>
			</div>
		</div>

		<section class="editar-produto">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<?php require("../partials/vendedor-actions.php"); ?>
					</div>
					<div class="col-lg-9">
						<h2>
							<?php echo $produto->nome; ?>
						</h2>
						<form id="form-editar-produto" method="POST">
							<input type="hidden" name="produto-id" id="produto-id" value="<?php echo $produto->id; ?>">
							<span class="c-input">
								<label class="c-input__label" for="produto-nome">Nome</label>
								<div class="c-input__entry">
									<i class="fas fa-tag"></i>
									<input type="text" name="produto-nome" id="produto-nome" value="<?php echo $produto->nome; ?>">
								</div>
							</span>
							<span class="c-input">
								<label class="c-input__label" for="produto-preco">Preço</label>
								<div class="c-input__entry">
									<i class="fas fa-money-bill-wave"></i>
									<input type="text" name="produto-preco" id="produto-preco" value="<?php echo $produto->preco; ?>">
								</div>
							</span>
							<div class="my-3">
								<p class="mb-2">Categorias</p>
								<select name="produto-categoria" id="produto-categoria" class="c-input__entry">
									<?php foreach ($todas_categorias as $key => $item) { ?>
										<option value="<?php echo $key + 1; ?>">
											<?php echo $item->nome; ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="my-2">
								<label for="produto-descricao" class="c-input__label">Descrição</label>
								<span class="c-input">
									<textarea class="c-input__entry" name="produto-descricao" id="produto-descricao" cols="70" rows="5">
									<?php echo $produto->descricao ?>
									</textarea>
								</span>
							</div>
							<div class="my-3">
								<button class="c-btn c-btn__primary">
									Salvar
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php require_once("../partials/toast.php"); ?>

	<?php require_once("../partials/assets.php"); ?>
	<script type="module" src="<?php echo Base::$url_scripts . "editar-produto.js" ?>"></script>
</body>

</html>
<!-- TODO : editar produtos, tela vendas e em andamento para vendedores -->