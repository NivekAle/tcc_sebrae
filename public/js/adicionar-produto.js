import { Toast } from "./Toast.js";

$("#produto-preco").mask("000.000.000.000.000,00", { reverse: true });

const formatarPrecoDatabase = (preco) => preco.replace(/\./, "").replace(/\,/, ".");

var atributos = [];



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

			$.ajax({
				type: "POST",
				url: "http://localhost/tcc/app/Controllers/ProdutoController.php",
				data: {
					"novo-produto": {
						"id": $("#produto-id_vendedor").val(),
						"nome": $("#produto-nome").val(),
						"descricao": $("#produto-descricao").val(),
						"preco": formatarPrecoDatabase($("#produto-preco").val()),
						"categoria": $("#produto-categoria").val(),
						"vendedor": $("#produto-vendedor").val(),
						"atributos": () => {
							var atributos = [];
							var all_attr = document.querySelectorAll("td[data-attr='']");
							if (all_attr.length > 0) {
								for (let i = 0; i < all_attr.length; i++) {
									var contact_str = "";
									if (all_attr[i].getAttribute("data-nome")) {
										contact_str += all_attr[i].textContent;
									} else if (all_attr[i].getAttribute("data-valor")) {
										contact_str += all_attr[i].textContent;
									}
									atributos.push(contact_str);
								}
								return JSON.stringify(atributos);
							} else {
								Toast("Adicione pelo menos 1 atributos para este produto.");
							}
						}
					}
				},
				success: function (response) {
					$("body").append("<div class='loading'><div class='lds-ring'><div></div><div></div><div></div><div></div></div></div>");
					const responseParse = JSON.parse(response);
					setTimeout(() => {
						$("body .loading").remove("");
						window.location.href = `http://localhost/tcc/app/Views/Produtos/imagens.php?id=${responseParse.data.produto.id}`;
					}, 1000);
				}
			});
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

// adicionando atributos no produto
$("#btn-adicionar-atributo").click(function (event) {
	var nome = $("#produto-atributo-nome").val();
	var valor = $("#produto-atributo-valor").val();

	if (nome != "" && valor != "") {
		var tag_table = `
		<tr>
			<td data-attr="" data-nome="${nome}">${nome}</td>
			<td data-attr="" data-valor="${valor}">${valor}</td>
		</tr>
		`;
		$("#table-atributos tbody").append(tag_table);
	}

});


function PegarAtributos() {
	var atributos = [];
	$(document).on("load", "td[data-attr='']", function () {

	});
}
