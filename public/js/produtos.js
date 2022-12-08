import { formatarPreco } from "./carrinho.js";
// import  from './swiper.js';


(function () {

})();

function teste() {
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/ProdutoController.php?list=1`,
		dataType: "json",
		success: function (response) {
			console.log(response);
			if (response.status) {
				CarregarProdutos(response.data.body)
			}
			return false;
		}
	});
}
teste();

function CarregarProdutos(array_produtos) {
	array_produtos.forEach(produto => {
		var tag_card = `
		<div class="col-lg-3">
			${CriarCard(produto)}
		</div>
		`;

		$("#lista-produtos").append(tag_card);
	});
}


function CarregarSwiper(nome_categoria, component) {
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/ProdutoController.php?cat_limit=${nome_categoria}`,
		dataType: "JSON",
		success: function (response) {
			console.log(response);
			if (response.status != 0) {
				InserirNoSwiper(component, response.data.body);
			}
		}
	});
}
CarregarSwiper("Corporate", ".swiper-componente-gestao");

function InserirNoSwiper(inserir_em, dados) {
	var swiper = new Swiper(inserir_em, {
		slidesPerView: 4,
		slidesPerGroup: 3,
		spaceBetween: 30,
		// centeredSlides: true,
		// loop: true,
		// loopFillGroupWithBlank: true,
		autoplay: {
			disableOnInteraction: true
		},
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		}
	});
	dados.forEach((produto, i) => {
		swiper.appendSlide(`
		<div class="swiper-slide">
		${CriarCard(produto)}
		</div>
		`);
	});
}


export function CriarCard(produto) {
	return `
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
			<div class="produto-card__likes text-danger" style="font-size: 12px;">
				<i class="fas fa-heart"></i>
				<strong>${produto.likes}</strong>
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
`;
}