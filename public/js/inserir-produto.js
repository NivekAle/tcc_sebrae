$("#produto-preco").mask("000.000.000.000.000,00", { reverse: true });

$("#frmInserirProduto").validate(
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
			}
		},
		submitHandler: function (form) {
			var objForm = new FormData();
			objForm.append("nome", $("#produto-nome").val())
			objForm.append("descricao", $("#produto-descricao").val())
			objForm.append("preco", $("#produto-preco").val())
			objForm.append("imagem", $("#produto-imagem").prop("files")[0])
			$.ajax({
				type: "POST",
				url: "http://localhost/tcc/app/Controllers/ProdutoController.php",
				//data: {
				// novo_produto: {
				// 	"nome": $("#produto-nome").val(),
				// 	"descricao": $("#produto-descricao").val(),
				// 	"preco": $("#produto-preco").val(),
				// 	"produtoimagem": $("#produto-imagem").prop("files")[0]
				// }
				//},
				data: objForm,
				contentType: false,
				processData: false,
				success: function (response) {
					console.log(response);
				}
			});
		}
	}
)

// const inputImage = document.getElementById("produto-imagem");
// inputImage.onchange = (event) => {
// 	var output = document.getElementById("image-file-preview");
// 	output.src = URL.createObjectURL(event.target.files[0]);
// 	output.classList.replace("d-none", "d-block")
// 	output.onload = function () {
// 		// console.log(this.height);
// 		// console.log(this.width / 2);
// 		// var formatedHeight = this.width / 6;
// 		// var formatedWidth = this.width / 6;
// 		// output.setAttribute("height", formatedHeight);
// 		// output.setAttribute("width", formatedWidth);
// 		URL.revokeObjectURL(output.src);
// 	}
// }