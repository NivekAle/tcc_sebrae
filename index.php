<?php


namespace App;

use App\Core\Base;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

?>

<!DOCTYPE html>


<head>
	<?php require_once("./app/Views/partials/head.php") ?>
	<link rel="stylesheet" href="<?php echo Base::$url_styles . "index.css" ?>">
	<title>Innovament</title>
</head>

<body>

	<main>
		<section class="app">
			<div class="container">
				<header class="app__header">
					<img src="<?php echo Base::$url_imagens . "../images/logo.png" ?>" alt="">
				</header>
				<div class="app__body">
					<h4>Diga-nos qual é a sua situação</h4>
					<ul class="app__options">
						<li>
							<a href="<?php echo Base::$url_views . "Usuario/login.php" ?>">
								<span>
									<img src="<?php echo Base::$url_imagens . "../images/avatar-user-r.png" ?>" alt="">
									&nbsp;
									Sou um usuário comum
								</span>
								<i class="fas fa-chevron-right"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo Base::$url_views . "Vendedor/login.php" ?>">
								<span>
									<img src="<?php echo Base::$url_imagens . "../images/avatar-vendedor-r.png" ?>" alt="">
									&nbsp;
									Você tem uma empresa ou é um vendedor
								</span>
								<i class="fas fa-chevron-right"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo Base::$url_views . "Usuario/cadastro.php" ?>">
								<span>
									<img src="<?php echo Base::$url_imagens . "../images/avatar-user-r.png" ?>" alt="">
									&nbsp;
									Criar uma conta como usuário comum
								</span>
								<i class="fas fa-chevron-right"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo Base::$url_views . "Vendedor/cadastro.php" ?>">
								<span>
									<img src="<?php echo Base::$url_imagens . "../images/avatar-vendedor-r.png" ?>" alt="">
									&nbsp;
									Criar uma conta como vendedor
								</span>
								<i class="fas fa-chevron-right"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</section>
	</main>

</body>

</html>