import { Toast } from "./Toast.js";

$("#btn-like-produto").click(function () {
	InserirLike();
});


function InserirLike() {
	var query = location.search.slice(1);
	var partes = query.split('&');
	var data = {};
	partes.forEach(function (parte) {
		var chaveValor = parte.split('=');
		var chave = chaveValor[0];
		var valor = chaveValor[1];
		data[chave] = valor;
	});

	$.ajax({
		type: "GET",
		url: `http://localhost/tcc/app/Controllers/ProdutoController.php?like_for=${data.id}`,
		dataType: "JSON",
		success: function (response) {
			console.log(response);
			if (parseInt(response.status)) {
				$("#total-likes").empty();
				$("#total-likes").html(`
					<i class="fas fa-heart"></i>
					<strong>${response.data.body.total_likes}</strong>
					`
				);
			} else {
				Toast(response.data.mensagem);
			}
		}
	});

}

