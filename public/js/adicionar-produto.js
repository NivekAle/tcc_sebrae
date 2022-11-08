$("#produto-preco").mask("000.000.000.000.000,00", { reverse: true });

$("#frm-adicionar-produto").validate(
	{
		rules: {
			"produto-nome": {
				required: true
			},
			"produto-descricao": {
				required: true
			},
			"produto-preco": {
				required: true
			},
			"produto-categoria": {
				required: true
			}
		},
		messages: {
			"produto-nome": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`,
			},
			"produto-descricao": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`
			},
			"produto-preco": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`
			},
			"produto-categoria": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`
			}
		},
		submitHandler: function (form) {
			// var objForm = new FormData();
			// objForm.append("nome", $("#produto-nome").val())
			// objForm.append("descricao", $("#produto-descricao").val())
			// objForm.append("preco", $("#produto-preco").val())
			// objForm.append("imagem", $("#produto-imagem").prop("files")[0])
			$.ajax({
				type: "POST",
				url: "http://localhost/tcc/app/Controllers/ProdutoController.php",
				data: {
					"novo-produto": {
						"id": $("#produto-id_vendedor").val(),
						"nome": $("#produto-nome").val(),
						"descricao": $("#produto-descricao").val(),
						"preco": $("#produto-preco").val(),
						"categoria": $("#produto-categoria").val(),
						"vendedor": $("#produto-vendedor").val(),
					}
				},
				success: function (response) {
					$("body").append("<div class='loading'><div class='lds-ring'><div></div><div></div><div></div><div></div></div></div>");
					const responseParse = JSON.parse(response);
					setTimeout(() => {
						$("body .loading").remove("");
						window.location.href = `http://localhost/tcc/app/Views/Produtos/imagens.php?id=${responseParse.data.produto.id}`;
					}, 1000);
					// pegarIdProdutoAdicionado();
				}
			});
			// TODO : redirecionar o usuario para a parte de inserção de imagens do produto
		}
	}
);

$("#produto-nome").on('input', function (event) {
	$("#output-produto-title").val(event.target.value.split('').join(''));
	$("#output-produto-title").css("width", "91%");
	$("#output-produto-title").css("text-overflow", "ellipsis");
	$("#output-produto-title").css("overflow", "hidden");
});

$("#produto-preco").on('input', function (event) {

	$("#output-produto-preco").val(event.target.value.split('').join(''));
});


// pegando o ID do produto criado recentemento para adicionar imagens nele;
