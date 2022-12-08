<header class="header-nav">
	<div class="container">
		<navbar class="navbar">
			<a href="http://localhost/tcc/app/Views/Produtos/index.php" class="navbar__logo">
				<img src="http://localhost/tcc/public/images/logo.png" alt="" width="200px">
			</a>
			<div class="navbar__content">
				<!-- <ul class="navbar__list">
					<li class="navbar__item">
						<a href="http://localhost/tcc/app/Views/Produtos/index.php" class="navbar__link">Produtos</a>
					</li>
					<li class="navbar__item">
						<a href="" class="navbar__link">Contato</a>
					</li>
					<li class="navbar__item">
						<a href="#" class="navbar__link">Empresa</a>
					</li>
					<li class="navbar__item">
						<a href="http://localhost/tcc/app/Views/Vendedor/painel.php" class="navbar__link">Painel</a>
					</li>
				</ul> -->
				<div class="navbar__controller">
					<?php echo !property_exists($_SESSION["sessao_usuario"], "cnpj") ? '<a href="http://localhost/tcc/app/Views/Carrinho/carrinho.php" class="navbar__cart">
						<i class="fas fa-shopping-cart"></i>
					</a>' : ''; ?>
					<form id="frm-pesquisa">
						<span>
							<input type="text" placeholder="categoria, nome de produto" name="pesquisa" required>
							<button>
								<i class="fas fa-search"></i>
							</button>
						</span>
					</form>
					<button class="navbar__dropdown-button">
						<img src="http://localhost/tcc/public/images/avatar-vendedor-r.png" alt="">
						<!-- <i class="fas fa-chevron-down"></i> -->
					</button>
					<ul class="navbar__dropdown">
						<li class="navbar__item">
							<a href="http://localhost/tcc/app/Views/Vendedor/painel.php">
								<i class="fas fa-layer-group"></i>
								Painel
							</a>
						</li>
						<!-- <li>
							<a href="http://localhost/tcc/app/Views/Produtos/configurações.php">
								<i class="fas fa-sliders-h"></i>
								Configurações
							</a>
						</li> -->
						<li>
							<a href="http://localhost/tcc/sair.php">
								<i class="fas fa-sign-out-alt"></i>
								Sair
							</a>
						</li>
					</ul>
				</div>
			</div>
		</navbar>
	</div>
</header>