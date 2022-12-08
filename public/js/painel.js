import { formatarPreco } from "./carrinho.js";
import { Toast } from "./Toast.js";

function CardDropdown(id) {
	const card = document.querySelector(`#produto-${id}`);
	const dropdown = card.querySelector(".produto-card__dropdown");
	dropdown.classList.toggle("drop");
}


// Filtros
$("#btn-filtrar-produtos-vendedor").on("click", function () {
	if ($("#filtrar-pro-preco").val() != "") {
		var produtos_parsed = JSON.parse(localStorage.getItem("produtos"));
		switch ($("#filtrar-pro-preco").val()) {
			case "asc":
				produtos_parsed.sort(
					(a, b) => {
						return a.preco - b.preco
					}
				);
				$("#produtos").empty();
				InserirProdutosHTML(produtos_parsed);
				break;
			case "desc":
				produtos_parsed.sort(
					(a, b) => {
						return b.preco - a.preco
					}
				);
				$("#produtos").empty();
				InserirProdutosHTML(produtos_parsed);
				break;
			case "desativados":
				var produtos_desativados = produtos_parsed.filter((element) => element.status != 1);
				$("#produtos").empty();
				InserirProdutosHTML(produtos_desativados);
				break;
			case "ativados":
				var produtos_ativados = produtos_parsed.filter((element) => element.status == 1);
				$("#produtos").empty();
				InserirProdutosHTML(produtos_ativados);
				break;
			case "null":
				$("#produtos").empty();
				InserirProdutosHTML(produtos_parsed);
				break;
		}
	}
})


export function PegarProdutosVendedor(session_id) {
	console.log("lasodlas");
	$.ajax({
		type: `GET`,
		url: `http://localhost/tcc/app/Controllers/PainelController.php?list_by=${session_id}`,
		dataType: "json",
		success: function ({ data: { body }, status }) {
			if (status) {
				$("#produtos").empty();
				InserirProdutosHTML(body);
				localStorage.removeItem("produtos");
				localStorage.setItem("produtos", JSON.stringify(body));
			} else {
				Toast("Não foi possivel carregar os produtos, tente novamente mais tarde.");
			}
		}
	});
}

const VerificarStatusProduto = (status) => {
	if (status == 0) {
		return `
		<div class="produto-card__status"><i class="fas fa-exclamation-circle"></i><span class="info">Este produto esta desativado.</span></div>
		`;
	}
	return "";
}

const VerificarImagemProduto = (caminho, title) => {
	if (caminho) {
		return `<img class="produto-card__image" src="http://localhost/tcc/public/uploads/${caminho}" alt="${title}">`;
	} else {
		return `<img class="produto-card__image" src="http://localhost/tcc/public/images/not-image.jpg" alt="Imagem não encontrado" style="object-fit: cover; object-position: -20px;">`;
	}
}

function InserirProdutosHTML(produtos) {
	produtos.forEach((produto, index) => {
		var tag_card = `
		<div className="col-lg-12">
			<div class="produto-card produto-card__row" id="produto-${produto.id}">
				<div class="produto-card__header">
					${VerificarImagemProduto(produto.caminho, produto.nome)}
				</div>
				<div class="produto-card__body">
					<span>
						<h6 class="produto-card__title">
							<a href="http://localhost/tcc/app/Views//Produtos/produto.php?id=${produto.id}">${produto.nome}</a>
						</h6>
						<p>
							${formatarPreco(produto.preco)}
						</p>
					</span>
					${VerificarStatusProduto(produto.status)}
				</div>
				<div class="produto-card__footer">
					<button id="btn-produto-card" data-unique="${produto.id}">
						<i class="fas fa-ellipsis-v"></i>
					</button>
				</div>
				<div class="produto-card__dropdown">
					<ul>
						<li>
							<a href="http://localhost/tcc/app/Views/Vendedor/editar.php?id=${produto.id}">Editar</a>
						</li>
						${verificarProdutoStatus(produto.status, produto.id)}

					</ul>
				</div>
			</div>
		</div>
		`;
		$("#produtos").append(tag_card);
	});
}

// verificar se o produto esta desativado
const verificarProdutoStatus = (status, id) => {
	// <li>
	// 						<a href="#desativar" id="btn-desativar-produto">Desativar</a>
	// 					</li>
	if (parseInt(status)) {
		return `
		<li>
			<a href="#desativar" data-id="${id}" id="btn-desativar-produto">Desativar</a>
		</li>
		`;
	} else {
		return `
		<li>
			<a href="#ativar" data-id="${id}" id="btn-ativar-produto">Ativar</a>
		</li>
		`;
	}
};

$(document).on("click", "#btn-produto-card", function () {
	const card = document.querySelector(`#produto-${$(this).attr("data-unique")}`);
	const dropdown = card.querySelector(".produto-card__dropdown");
	dropdown.classList.toggle("drop");
});


// * Modal remover
// abrir modal
$(document).on("click", "#btn-desativar-produto", function (e) {
	$("#modal-desativar-produto").show();
	$("#input-desativar-produto").val($(this).attr("data-id"));
});

// cancelar modal
$("#btn-modal-fechar-desativar-produto").click(function (e) {
	$("#modal-desativar-produto").hide();
});


// confirma que vai desativar
$("#btn-modal-confirmar-desativar-produto").click(function (e) {
	DesativarProduto($("#input-desativar-produto").val());
});

// Desativar Produto
function DesativarProduto(id_produto) {
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/ProdutoController.php?remover=${id_produto}`,
		dataType: "JSON",
		success: function (response) {
			$("#modal-desativar-produto").hide();
			if (parseInt(response.status)) {
				Toast(response.data.mensagem);
				PegarProdutosVendedor(response.data.body.id);
			} else {
				Toast(response.data.mensagem);
			}
		}
	});
}

// ativar Produto
$(document).on("click", "#btn-ativar-produto", function (e) {
	console.log(this);
	e.preventDefault();
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/ProdutoController.php?ativar=${$(this).attr("data-id")}`,
		dataType: "JSON",
		success: function (response) {
			$("#modal-desativar-produto").hide();
			if (parseInt(response.status)) {
				Toast(response.data.mensagem);
				PegarProdutosVendedor(response.data.body.id);
			} else {
				Toast(response.data.mensagem);
			}
		}
	});
});
