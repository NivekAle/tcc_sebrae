import { formatarPreco } from "./carrinho.js";

// const formatarPreco = (preco) => (new Intl.NumberFormat('pt-BR', {
// 	style: 'currency',
// 	currency: 'BRL'
// }).format(preco));

function Busca() {
	var query = location.search.slice(1);
	var partes = query.split('&');
	var data = {};
	partes.forEach(function (parte) {
		var chaveValor = parte.split('=');
		var chave = chaveValor[0];
		var valor = chaveValor[1];
		data[chave] = valor;
	});

	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/BuscaController.php?search=${data.search}`,
		dataType: "json",
		success: function (response) {
			console.log(response);

			if (response.data.hasOwnProperty("body") && response.data.body) {
				response.data.body.forEach(item => {
					var tag_li = `
				<div class="col-lg-4">
				<div class="produto-card">
						<div class="produto-card__header">
							<img class="produto-card__image" src="http://localhost/tcc/public/uploads/${item.caminho}" alt="${item.nome}">
						</div>
						<div class="produto-card__body">
							<h6 class="produto-card__title">
								<a href="http://localhost/tcc/app/Views/Produtos/produto.php?id=${item.id}">${item.nome}</a>
							</h6>
							<p class="produto-card__by">
								por
								<strong>
								<a href="http://localhost/tcc/app/Views/Produtos/index.php?produtos_de=" title="Vendido por ${item.nome_completo}">${item.nome_completo}</a>
								</strong>
							</p>
							<div class="produto-card__likes">
								<i class="fas fa-star"></i>
								<i class="fas fa-star-half-alt"></i>
								<i class="far fa-star"></i>
								0									</div>
						</div>
						<div class="produto-card__footer">
							<p class="produto-card__price">
								${formatarPreco(item.preco)}
								</p>
							<a class="w-100 c-btn c-btn__secondary c-btn__secondary--outline d-block" href="http://localhost/tcc/app/Views//Produtos/produto.php?id=${item.id}">
								Ver mais
							</a>
						</div>
					</div>
				</div>
				`;
					$(".status-busca").html(`Foram encontrados ${response.data.body.length} resultados.`);
					$("#resultado").append(tag_li);
				});
			} else {
				var erro_not_found = `
				<div class="search-not-found">
					<div class="search-not-found__content">
					<img class="search-not-found__image" src="http://localhost/tcc/public/images/304.svg" alt="Nenhum produto foi encontrado com ${data.search}">
					<p>Nenhum produto corresponde a  "<strong>${response.data.mensagem}</strong>"</p>
					</div>
				</div>
				`;
				$("#resultado").append(erro_not_found);
			}
		}
	});
}
Busca();
