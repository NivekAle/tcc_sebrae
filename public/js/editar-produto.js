import { Toast } from "./Toast.js";

$("#produto-preco").mask("000.000.000.000.000,00", { reverse: true });

const formatarPrecoDatabase = (preco) => preco.replace(/\./, "").replace(/\,/, ".");

$("#form-editar-produto").validate(
	{
		rules: {
			"produto-nome": {
				required: true,
			},
			"produto-preco": {
				required: true,
			},
			"produto-descricao": {
				required: true,
			},
			"produto-categoria": {
				required: true,
			},
		},
		messages: {
			"produto-nome": {
				required: "Este campo é obrigatório.",
			},
			"produto-preco": {
				required: "Este campo é obrigatório.",
			},
			"produto-descricao": {
				required: "Este campo é obrigatório.",
			},
			"produto-categoria": {
				required: "Este campo é obrigatório.",
			},
		},
		submitHandler: function (form) {
			$.ajax({
				type: "POST",
				url: "http://localhost/tcc/app/Controllers/ProdutoController.php",
				data: {
					"editar-produto": {
						"id": $("#produto-id").val(),
						"nome": $("#produto-nome").val(),
						"descricao": $("#produto-descricao").val(),
						"preco": formatarPrecoDatabase($("#produto-preco").val()),
						"categoria": $("#produto-categoria").val(),
					}
				},
				success: function (response) {
					var data_json = JSON.parse(response);
					if (data_json.status == 0) {
						Toast(data_json.data.mensagem);
					} else {
						Toast(data_json.data.mensagem);
						setTimeout(() => {
							window.location.href = "http://localhost/tcc/app/Views/Vendedor/painel.php";
						}, 2000);
					}
				}
			});
		}
	}
);