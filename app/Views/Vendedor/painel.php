<?php

namespace App;

use App\Models\Categoria;
use App\Models\Produto;
use App\Helpers\Session;

require('d:/projects/php/tcc/vendor/autoload.php');
Session::VerificarSessao();

$todos_produtos_vendedor = Produto::PegarProdutosVendedor($_SESSION["sessao_usuario"]->id);

// echo '<pre>' . print_r($todos_produtos_vendedor) . '<pre>';
// exit();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="http://localhost/tcc/public/css/painel.css">
	<title>Login | </title>
</head>

<body class="">

	<!-- Verificando se é um usuario ou um vendedor -->
	<?php if (property_exists($_SESSION["sessao_usuario"], "cnpj")) {
		require_once("../partials/navbar-vendedor.php");
	} else {
		require_once("../partials/navbar.php");
	}
	?>

	<main>

		<section class="vendedor-painel">
			<div class="container">
				<div class="row">
					<?php foreach ($todos_produtos_vendedor as $key => $produto) { ?>
						<div class="col-lg-12">
							<div class="produto-card produto-card__row my-2" id="produto-<?= $produto->id; ?>">
								<div class="produto-card__header">
									<!-- <img src="" alt="dasomdas"> -->
									<div class="produto-card__image"></div>
								</div>
								<div class="produto-card__body">
									<h6 class="produto-card__title">
										<?php echo $produto->nome ?>
									</h6>
									<p>
										R$ <?php echo number_format($produto->preco, 2, ",", ".") ?>
									</p>
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
		</section>

	</main>

	<?php require_once("../partials/assets.php"); ?>
	<script src="http://localhost/tcc/public/js/painel.js"></script>
</body>

</html>