<header class="header-nav">
	<div class="container">
		<nav class="navbar">
			<a href="http://localhost/tcc/app/Views/Produtos/index.php" class="navbar__logo">
				<img src="http://localhost/tcc/public/images/logo.png" alt="" width="200px">
			</a>
			<div class="navbar__content">
				<!-- <ul class="navbar__list">
					<li class="navbar__item">
						<a href="http://localhost/tcc/app/Views/Produtos/index.php" class="navbar__link">Produtos</a>
					</li>
					<li class="navbar__item">
						<a href="http://localhost/tcc/app/Views/Categorias/index.php" class="navbar__link">Categorias <i class="fas fa-angle-down"></i></a>
					</li>
				</ul> -->
				<div class="navbar__box">
					<form id="frm-pesquisa">
						<span>
							<input type="text" placeholder="categoria, nome de produto" name="pesquisa" required>
							<button>
								<i class="fas fa-search"></i>
							</button>
						</span>
					</form>
					<div class="navbar__controller">
						<a href="http://localhost/tcc/app/Views/Carrinho/carrinho.php" class="navbar__cart">
							<i class="fas fa-shopping-cart"></i>
							<?php if (isset($_SESSION['carrinho'])) { ?>
								<p class="count-pedidos"><?php echo count($_SESSION['carrinho']) ?></p>
							<?php } ?>
						</a>
						<button class="navbar__dropdown-button">
							<img src="http://localhost/tcc/public/images/avatar-user-r.png" alt="">
						</button>
						<ul class="navbar__dropdown">
							<!-- <li>
								<a href="http://localhost/tcc/app/Views/Usuario/configuracoes.php">Configurações</a>
							</li> -->
							<li>
							</li>
							<li>
								<a href="http://localhost/tcc/sair.php">
									<i class="fas fa-sign-out-alt"></i>
									Sair
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</div>
</header>