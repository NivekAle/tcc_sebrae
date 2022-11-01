<?php

namespace App;

use App\Models\Categoria;
use App\Models\Produto;
use App\Helpers\Session;
use App\Models\Vendedor;

require('d:/projects/php/tcc/vendor/autoload.php');

Session::VerificarSessao();
// $todos_produtos = Produto::PegarProdutos();
$todas_categorias = Categoria::PegarTodasCategorias();

if (!empty($_GET["id"])) {
	$produto = Produto::PegarProduto($_GET["id"]);
	$vendedor = Vendedor::PegarVendedor($_GET["id"]);
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
<html lang="pt-br">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/produto.css">
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
		<!-- <div class="hero">
			<div class="container">
				<div class="hero-content">
					<h1>Projetos & Templates</h1>
					<p>
						foram encontrados <php echo count($todos_produtos); ?> resutlado. Escolha um para visualizar.
					</p>
				</div>
			</div>
		</div> -->

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

		<!-- <div class="breadcrumb">
			<div class="container">
				<ul>
					<li>Home</li>
				</ul>
			</div>
		</div> -->

		<section class="produto">
			<div class="container">
				<h2 class="produto-title">
					<?php echo $produto->nome; ?>
				</h2>
				<div class="row">
					<div class="col-lg-8">
						<div class="produto__image"></div>
					</div>
					<div class="col-lg-8">
						<h3>
							<?php echo $vendedor->nome_completo; ?>
						</h3>
					</div>
					<div class="col-lg-4">
						<div class="produto__details">
							<h4>
								<span>
									R$
								</span>
								<?php echo number_format($produto->preco, 2, ",", "."); ?>
							</h4>
							dados ficticios ----------->
							<div class="">
								<p>Temas disponiveis</p>
								<ul>
									<li>Dark</li>
									<li>Light</li>
									<li>Red + Blue</li>
								</ul>
								<ul>
							</div>
							<div class="">
								<p>Tecnologias usadas</p>
								<ul>
									<li>React JS</li>
									<li>PHP</li>
									<li>HTML</li>
									<li>CSS</li>
								</ul>
								<ul>
							</div>
							<ul>
								<li>repositorio : </li>
								<li>ultima atualzicao : </li>
								<li>publicado em : </li>
								<li>layout : responsive</li>
							</ul>
							<div class="produto__tags">
								<span class="c-tag">
									<a href="#">Dashboard</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</main>


</body>

</html>