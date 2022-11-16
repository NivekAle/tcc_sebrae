

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
		url: `http://localhost/tcc/app/Controllers/ProdutoController.php?key_produto=${data.id}`,
		// data: "data",
		dataType: "JSON",
		success: function (response) {
			const { Produto } = response;
			// console.log(response);
			InserirImagens(Produto.imagens);
		}
	});

}
PegarProduto();


function InserirImagens($produtos_imagens) {
	// console.log($produtos_imagens);
	var $imagem_main = $produtos_imagens.slice(0);

	// imagem principal
	if ($imagem_main[0].caminho) {
		$("#produto-imagem-main").prop("src", `http://localhost/tcc/public/uploads/${$imagem_main[0].caminho}`);
	} else {
		$(".produto-image").html("este produto não contem imagem.")
	}

	if ($produtos_imagens.length > 0) {
		var $imagens_min = $produtos_imagens.slice(1);

		// inserindo imagens secundarias;
		$imagens_min.forEach(imagem => {
			var element = `
		<div class="col-lg-3">
		<a href="#">
		<img src='http://localhost/tcc/public/uploads/${imagem.caminho}' width='100%'/>
		</a>
		</div>
		`;
			$("#produto-imagens-min").append(element);
		});
	} else {
		$("#produto-imagens-min").append(`<p>Este produto não contem mais imagens.</p>`);
	}
}