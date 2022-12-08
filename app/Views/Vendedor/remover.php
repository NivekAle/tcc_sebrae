<?php

namespace App;

use App\Models\Categoria;
use App\Models\Produto;
use App\Helpers\Session;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);
Session::VerificarSessao();

$todas_categorias = Categoria::PegarTodasCategorias();

if (!empty($_GET["id"])) {
	$produto = Produto::PegarProduto($_GET["id"]);
	// $vendedor = Vendedor::PegarVendedor($_GET["id"]);
	$categoria = Categoria::PegarCategoria($_GET["id"]);
	// echo print_r($categoria);
	// die();
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


<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/editar-produto.css">
	<title>Remover | </title>
</head>

<body class="">

	<!-- Verificando se é um usuario ou um vendedor -->
	<?php property_exists($_SESSION["sessao_usuario"], "cnpj") ? require_once("../partials/navbar-vendedor.php") : require_once("../partials/navbar.php");  ?>

	<main>

		<div class="todas-categorias bg-light">
			<div class="container">
				<div class="row py-3">
					<?php foreach ($todas_categorias as $key => $value) { ?>
						<div class="col-lg-2">
							<p class="text-center m-0">
								<a href="<?= "http://localhost/tcc/app/Views/Produtos/index.php?cat=" . $value->id ?>"><?= $value->nome ?></a>
							</p>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<section class="editar-produto">
			<div class="container">
				<h2>
					<?php echo $produto->nome; ?>
				</h2>
				<form id="form-remover-produto">
					<input type="number" name="produto-id" id="produto-id" value="<?php echo $produto->id; ?>">
					<span class="c-input">
						<label class="c-input__label" for="produto-nome">Nome</label>
						<div class="c-input__entry">
							<i class="fas fa-tag"></i>
							<input readonly type="text" name="produto-nome" id="produto-nome" value="<?php echo $produto->nome; ?>">
						</div>
					</span>
					<span class="c-input">
						<label class="c-input__label" for="produto-preco">Preço</label>
						<div class="c-input__entry">
							<i class="fas fa-money-bill-wave"></i>
							<input readonly type="text" name="produto-preco" id="produto-preco" value="<?php echo $produto->preco; ?>">
						</div>
					</span>
					<span class="c-input">
						<label class="c-input__label" for="produto-preco">Categoria</label>
						<div class="c-input__entry">
							<i class="fas fa-hashtag"></i>
							<input readonly type="text" name="produto-preco" id="produto-preco" value="<?php echo  $categoria->nome;  ?>">
						</div>
					</span>
					<span class="">
						<p>
							<i class="fas fa-tags"></i>
							Tags
						</p>
						<ul class="">
							<li>
								<label class="" for="produto-preco">Escola</label>
								<input readonly type="checkbox" name="" id="" checked>
							</li>
							<li>
								<label class="" for="produto-preco">Arquivos</label>
								<input readonly type="checkbox" name="" id="" checked>
							</li>
						</ul>
						<button class="c-btn c-btn__secondary c-btn__secondary--outline">
							Adicionar Tag
						</button>
					</span>
					<span class="c-input">
						<i class="fas fa-font"></i>
						<p class="" for="produto-preco">Descrição</p>
						<div class="w-100">
							<textarea name="produto-descricao" id="produto-descricao" cols="70" rows="5"><?php echo $produto->descricao; ?></textarea>
						</div>
					</span>


					<div class="editar-produto__imagens">
						<h5>
							Imagens do Produto
						</h5>
						<hr>
						<div class="row">
							<?php for ($i = 0; $i <= 4; $i++) { ?>
								<div class="col-lg-3">
									<img src="" alt="doasmodmas">
								</div>
							<?php } ?>
						</div>
						<button class="c-btn c-btn__secondary c-btn__secondary--outline">
							Adicionar Imagens
						</button>
					</div>
					<div class="my-3 d-flex flex-row align-items-center gap-3">
						<button class="c-btn c-btn__secondary">
							Desativar
						</button>
						<button class="c-btn c-btn__secondary c-btn__secondary--outline">
							Cancelar
						</button>
					</div>
				</form>
			</div>
		</section>

	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="http://localhost/tcc/public/js/remover-produto.js"></script>
</body>

</html>