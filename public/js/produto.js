

// pegar produto
function PegarProduto() {
	var query = location.search.slice(1);
	var partes = query.split('&');
	var data = {};
	partes.forEach(function (parte) {
		var chaveValor = parte.split('=');
		var chave = chaveValor[0];
		var valor = chaveValor[1];
		data[chave] = valor;
	});
	// passando o id do produto
	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/ProdutoController.php?id=${data.id}`,
		// data: "data",
		dataType: "JSON",
		success: function (response) {
			const { data: { body: { Produto } } } = response;
			console.log(response);
			InserirImagens(Produto.imagens);
		}
	});
}
PegarProduto();


function InserirImagens($produtos_imagens) {
	console.log($produtos_imagens);
	var $imagem_main = $produtos_imagens.slice(0);

	// imagem principal
	if ($imagem_main[0].caminho) {
		$("#produto-imagem-main").prop("src", `http://localhost/tcc/public/uploads/${$imagem_main[0].caminho}`);
	} else {
		$(".produto-image").html("este produto não contem imagem.");
	}

	if ($produtos_imagens.length >= 1) {
		// var $imagens_min = $produtos_imagens.slice(1);
		CarroselImage($produtos_imagens);

	} else {
		$("#produto-imagens-min").append(`<p>Este produto não contem mais imagens.</p>`);
	}
}

// inserindo as imagens no html
function CarroselImage(array_imagens) {
	// console.log(array_imagens);
	var index = 0;
	$("#carrosel-imagem-atual").prop("src", `http://localhost/tcc/public/uploads/${array_imagens[index].caminho}`);
	$("#carrosel-count").html(`${index}/${array_imagens.length}`);

	// proximo
	$("#btn-carrosel-proximo").click(function () {
		index++;
		document.querySelector("#carrosel-imagem-atual").animate([
			{ transform: 'translateX(-100px)' },
			{ opacity: '0.3' },
			{ opacity: '1' }
		], {
			duration: 200,
		})

		if (index > array_imagens.length - 1) {
			index = 0;
			$("#carrosel-imagem-atual").prop("src", `http://localhost/tcc/public/uploads/${array_imagens[index].caminho}`);
			$("#carrosel-count").html(`${index}/${array_imagens.length}`);
			// beatyImageFile.src = array_imagens[0];
		} else {
			$("#carrosel-count").html(`${index}/${array_imagens.length}`);
			$("#carrosel-imagem-atual").prop("src", `http://localhost/tcc/public/uploads/${array_imagens[index].caminho}`);
		}
	});

	// anterior
	$("#btn-carrosel-anterior").click(function () {
		index--;
		document.querySelector("#carrosel-imagem-atual").animate([
			{ transform: 'translateX(100px)' },
			{ opacity: '0.3' },
			{ opacity: '1' }
		], {
			duration: 200,
		})
		if (index < 0) {
			index = array_imagens.length - 1;
			$("#carrosel-imagem-atual").prop("src", `http://localhost/tcc/public/uploads/${array_imagens[index].caminho}`);
			$("#carrosel-count").html(`${index}/${array_imagens.length}`);
		} else {
			$("#carrosel-count").html(`${index}/${array_imagens.length}`);
			$("#carrosel-imagem-atual").prop("src", `http://localhost/tcc/public/uploads/${array_imagens[index].caminho}`);
		}
	});

	// fecha o modal
	$(".carrosel").click(function (e) {

		if (e.target.className == "carrosel__content") {
			$(".carrosel").css("pointer-events", "none");
			document.querySelector(".carrosel").animate(
				[
					{ opacity: '1' },
					{ opacity: '0.3' },
				], 300)
			setTimeout(() => {
				$(".carrosel").removeClass("show");
				$(".carrosel").css("pointer-events", "initial");
			}, 300);
		}
	});
}


// verificar se o produto tem mais imagens
// Ver todas imagens do produto
$("#btn-todas-imagens").click(function () {
	$(".carrosel").toggleClass("show");
});