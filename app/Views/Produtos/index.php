<?php

namespace App;

use App\Models\Categoria;
use App\Models\Produto;
use App\Helpers\Session;
use App\Models\Vendedor;

require('d:/projects/php/tcc/vendor/autoload.php');

Session::VerificarSessao();
$todos_produtos = Produto::PegarProdutos();
$todas_categorias = Categoria::PegarTodasCategorias();


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/produtos.css">
	<title>Document</title>
</head>

<body>

	<!-- Verificando se é um usuario ou um vendedor -->
	<?php if (property_exists($_SESSION["sessao_usuario"], "cnpj")) {
		require_once("../partials/navbar-vendedor.php");
	} else {
		require_once("../partials/navbar.php");
	}
	?>

	<main>
		<div class="hero">
			<div class="container">
				<div class="hero-content">
					<h1>Projetos & Templates</h1>
					<p>
						<!-- foram encontrados <php echo count($todos_produtos); ?> resutlado. Escolha um para visualizar. -->
					</p>
				</div>
			</div>
		</div>

		<div class="c-pesquisa">
			<div class="container">

			</div>
		</div>

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

		<section class="todos-produtos">
			<div class="container">
				<div class="row my-5">
					<?php foreach ($todos_produtos as $index => $produto) { ?>
						<div class="col-lg-3">
							<div class="produto-card produto-card__column">
								<div class="produto-card__header">
									<div class="produto-card__image"></div>
								</div>
								<div class="produto-card__body">
									<h6 class="produto-card__title">
										<a href="<?php echo "http://localhost/tcc/app/Views/Produtos/produto.php?id=" . $produto->id; ?>"><?php echo $produto->nome; ?></a>
									</h6>
									<p class="produto-card__by">
										por
										<strong>
											<?php $dados_vendedores =  Vendedor::PegarVendedor($produto->id); ?>
											<a href="<?php echo "http://localhost/tcc/app/Views/Produtos/index.php?produtos_de=" . $dados_vendedores->id; ?>" title="Mais de <?php echo $dados_vendedores->nome_completo;  ?>"><?php echo $dados_vendedores->nome_completo; ?></a>

										</strong>
									</p>
									<p class="produto-card__price">
										R$ <?php echo number_format($produto->preco, 2, ",", "."); ?>
									</p>
								</div>
								<div class="produto-card__footer">
									<div class="produto-card__likes">
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half-alt"></i>
										<i class="far fa-star"></i>
										<?php echo $produto->likes; ?>
									</div>
									<a href="<?= "http://localhost/tcc/app/Views/Produtos/carrinho.php?add_cart=" . $produto->id ?>" class="produto-card__cart">
										<i class="fas fa-shopping-cart"></i>
										&#x2800;
										Adicionar ao Carrinho
									</a>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
	</main>


</body>

</html>