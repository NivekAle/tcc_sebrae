<header>
	<div class="container">
		<navbar class="navbar">
			<a href="http://localhost/tech_solution.com.br/App/Views/Produto/" class="navbar__logo">Logo</a>
			<ul class="navbar__list">
				<li class="navbar__item">
					<a href="http://localhost/tech_solution.com.br/App/Views/Produto/" class="navbar__link">Produtos</a>
				</li>
				<li class="navbar__item">
					<a href="" class="navbar__link">Contato</a>
				</li>
				<li class="navbar__item">
					<a href="#" class="navbar__link">Empresa</a>
				</li>
				<li class="navbar__item">
					<a href="http://localhost/tech_solution.com.br/App/Views/Produto/painel.php" class="navbar__link">Painel</a>
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
		</navbar>
	</div>
</header>