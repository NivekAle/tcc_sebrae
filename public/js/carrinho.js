import { Toast } from './Toast.js';

// formtar preco
export const formatarPreco = (preco) => (new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(preco));

// adicionando ao carrinho
$("#btn-adicionar-carrinho").click(function (e) {
	var $id_produto = $(this).attr("data-produto");
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/CarrinhoController.php?add_carrinho=${$id_produto}`,
		dataType: "JSON",
		success: function (response) {
			// console.log(response);
			if (response.status == 0) {
				Toast(response.data.mensagem);
			} else {
				Toast("O Produto foi adicionado no carrinho");
				setTimeout(() => {
					window.location.reload();
				}, 1000);
			}
		}
	});
});

$("#btn-sincronizar-carrinho").click(function () {
	$("#renderizar-produtos").empty();
	PegarCarrinho();
});


// Carregar produtos
function PegarCarrinho() {
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/CarrinhoController.php?items=1`,
		dataType: "JSON",
		success: function (response) {
			const { data: { body }, status } = response;
			if (response.data.hasOwnProperty("body")) {
				InserirProdutos(body);

			} else {
				$("#renderizar-produtos").css("height", "100%");
				$("#renderizar-produtos").html(`<div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center"><p class="text-muted">Carrinho vazio.</p>.</div>`);
			}
		}
	});

}
PegarCarrinho();


function InserirProdutos(body) {
	// console.log(body);
	$("#renderizar-produtos").empty();
	var array_produtos = [];
	var imagens = [];
	var preco_total = [];
	array_produtos = Object.entries(body).map((valor, i) => valor.slice(1)[0]);
	if (array_produtos == [] || array_produtos.length >= 0) {
		// $(selector).attr(attributeName, value);
		array_produtos.forEach(item => {
			var tag_card = `
			<div class="carrinho-card">
				<div class="carrinho-card__main">
					<div class="carrinho-card__header">
						<div class="carrinho-card__image">
						<img src="http://localhost/tcc/public/uploads/${item.imagens[0].caminho}" >
						</div>
					</div>
					<div class="carrinho-card__body">
						<h6 class="carrinho-card__title">
							<a href="http://localhost/tcc/app/Views/Produtos/produto.php?id=${item.id_produto}">
							${item.nome_produto}
							</a>
						</h6>
						<p class="carrinho-card__preco">${formatarPreco(item.preco_produto)}</p>
					</div>
					</div>
					<div class="carrinho-card__controller">
						<i class="fas fa-times" data-produto="${item.id_produto}" id="btn-remover-produto"></i>
					</div>
			</div>
			`;
			$("#renderizar-produtos").append(tag_card);
			// total do produto
			preco_total.push(item.preco_produto)
			CarrinhoTotal(preco_total);

		});
	}
	else {
		$("#renderizar-produtos").css("height", "100%");
		$("#renderizar-produtos").html(`<div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center"><i class="far fa-sad-tear fs-2"></i><p>Nenhum produto adicionado ao carrinho</p>.</div>`);
	}
}


// Limpar o carrinho
$("#btn-limpar-carrinho").click(function () {
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/CarrinhoController.php?clear=1`,
		dataType: "JSON",
		success: function (response) {
			$("#renderizar-produtos").empty();
			$(".carrinho__total").html("");
			$("i[data-count-cart]").attr("data-count-cart", "0");
			PegarCarrinho();
		}
	});
});


// remover um produto
$(document).on("click", "#btn-remover-produto", function () {
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/CarrinhoController.php?remover_produto=${$(this).attr("data-produto")}`,
		dataType: "json",
		success: function (response) {
			if (response.status) {
				PegarCarrinho();
			} else {
				Toast(response.data.mensagem);
			}
		}
	});
});

function CarrinhoTotal(precos_produtos) {
	var total = precos_produtos.map((preco) => parseInt(preco)).reduce((acumulador, elementoAtual) => acumulador + elementoAtual);
	$(".carrinho__total").html(formatarPreco(total));
}