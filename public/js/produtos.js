import { formatarPreco } from "./carrinho.js";
import { Toast } from "./Toast.js";

(function () {
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/ProdutoController.php?list=1`,
		dataType: "json",
		success: function (response) {
			console.log(response);
			if (response.status) {
				CarregarProdutos(response.data.body)
			} else {
				Toast
			}
		}
	});
})();


function CarregarProdutos(array_produtos) {
	array_produtos.forEach(produto => {
		var tag_card = `
		<div class="col-lg-3">
			<div class="produto-card">
				<div class="produto-card__header">
					<img class="produto-card__image" src="http://localhost/tcc/public/uploads/${produto.caminho}" alt="${produto.nome}">
				</div>
				<div class="produto-card__body">
					<h6 class="produto-card__title">
						<a href="http://localhost/tcc/app/Views/Produtos/produto.php?id=${produto.id}">${produto.nome}</a>
					</h6>
					<p class="produto-card__by">
						por
						<strong>
							<a href="http://localhost/tcc/app/Views/Produtos/index.php?produtos_de=${produto.nome_completo}" title="Mais de ${produto.nome_completo}">${produto.nome_completo}</a>
						</strong>
					</p>
					<div class="produto-card__likes">
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
						<i class="far fa-star"></i>
						${produto.likes}
					</div>
				</div>
				<div class="produto-card__footer">
					<p class="produto-card__price">
						${formatarPreco(produto.preco)}
					</p>
					<a class="w-100 c-btn c-btn__secondary c-btn__secondary--outline d-block" href="http://localhost/tcc/app/Views/Produtos/produto.php?id=${produto.id}">
						Ver mais
					</a>
				</div>
			</div>
		</div>
		`;

		$("#lista-produtos").append(tag_card);
	});
}