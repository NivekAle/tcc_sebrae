<?php

namespace App;

use App\Core\Base;

require($_SERVER['DOCUMENT_ROOT'] . 'tcc/vendor/autoload.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php require_once("../partials/head.php"); ?>
	<link rel="stylesheet" href="<?php echo Base::$url_styles . "cadastro-usuario.css" ?>">
	<title>Cadastro</title>
</head>

<body>

	<main>

		<section class="cadastro-usuario">
			<div class="cadastro-usuario__content">
				<div class="row">
					<div class="col-lg-4">
						<h3>
							Cadastro
						</h3>
						<h4>
							Por favor, inscreva-se para continuar!
						</h4>
						<p>

						</p>
					</div>
					<div class="col-lg-8">
						<h5>
							Registre-se para acessar InnovaTech
						</h5>
						<p>
							lorem ipsum, texto ficticio
						</p>
						<hr>
						<form id="frm-cadastro-usuario">
							<div class="row">
								<div class="col-lg-12">
									<label for="">Nome Completo</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" class="" name="usuario-nome" id="usuario-nome">
										</div>
									</span>
								</div>
								<div class="col-lg-6">
									<label for="">CPF</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" name="usuario-cpf" id="usuario-cpf">
										</div>
									</span>
								</div>
								<div class="col-lg-6">
									<label for="">Data de Nascimento</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" name="usuario-data_nascimento" id="usuario-data_nascimento">
										</div>
									</span>
								</div>
								<div class="col-lg-6">
									<label for="">Email</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" name="usuario-email" id="usuario-email">
										</div>
									</span>
								</div>
								<div class="col-lg-6">
									<label for="">Telefone</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" name="usuario-telefone" id="usuario-telefone">
										</div>
									</span>
								</div>
								<div class="col-lg-4">
									<label for="">Cidade</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" name="usuario-cidade" id="usuario-cidade">
										</div>
									</span>
								</div>
								<div class="col-lg-4">
									<label for="">Estado</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" name="usuario-Estado" id="usuario-Estado">
										</div>
									</span>
								</div>
								<div class="col-lg-4">
									<label for="">País</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" name="usuario-pais" id="usuario-pais">
										</div>
									</span>
								</div>
								<div class="col-lg-6">
									<label for="">Senha</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" name="usuario-senha" id="usuario-senha">
										</div>
									</span>
								</div>
								<div class="col-lg-6">
									<label for="">Confirmar Senha</label>
									<span class="c-input">
										<div class="c-input__entry">
											<input type="text" id="usuario-confirmar-senha">
										</div>
									</span>
								</div>
							</div>
							<div class="my-3 d-flex justify-content-between align-items-center">
								<a href="<?php echo Base::$url_views . "Usuario/login.php" ?>">
									<i class="fas fa-angle-left"></i>
									Já tenho cadastro
								</a>
								<button class="c-btn c-btn__secondary">Cadastrar-se</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

	</main>

</body>

</html>