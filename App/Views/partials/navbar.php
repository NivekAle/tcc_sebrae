<header class="header">
	<div class="container">
		<nav class="navbar">
			<a href="" class="navbar__logo">Tech Solutions</a>
			<ul class="navbar__list">
				<li class="navbar__item">
					<a href="http://localhost/tech_solution.com.br/App/Views/Produto/" class="navbar__link">Produtos</a>
				</li>
			</ul>
			<div class="navbar__controller">
				<button class="navbar__dropdown-button">
					<?php echo $_SESSION["sessao_usuario"]->nome; ?>
					<i class="fas fa-chevron-down"></i>
				</button>
				<ul class="navbar__dropdown">
					<li>
						<a href="http://localhost/tech_solution.com.br/App/Views/Produto/configurações.php">Configurações</a>
					</li>
					<li>
						<a href="http://localhost/tech_solution.com.br/sair.php">Sair</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>