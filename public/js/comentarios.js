// Fechar o modal
$("#btn-fechar-comentario-modal").click(function () {
	$(".modal-novo-comentario").fadeOut();
	setTimeout(() => $(".modal-novo-comentario").removeClass("open"), 300);
});

// abre o modal
$("#btn-novo-comentario").click(function () {
	$(".modal-novo-comentario").toggleClass("open");
});


// publicar comentário - fazer depois
$("#btn-novo-comentario__confirmar").on("click", function () {
	$.ajax({
		type: "POST",
		url: "http://localhost/tcc/app/Controllers/ComentarioController.php",
		data: {
			"novo-comentario": {
				conteudo: $("#comentario-conteudo").val(),
				id_produto: $("#comentario-id_produto").val(),
				id_usuario: $("#comentario-id_usuario").val(),
			}
		},
		dataType: "json",
		success: function (response) {
			$("#comentario-conteudo").val("");
			PegarComentarios();
			$(".modal-novo-comentario").removeClass("open");
			return false;
		},
	});
});

// pegando parametro da url
// var query = location.search.slice(1);
// 	var partes = query.split('&');
// 	var data = {};
// 	partes.forEach(function (parte) {
// 		var chaveValor = parte.split('=');
// 		var chave = chaveValor[0];
// 		var valor = chaveValor[1];
// 		data[chave] = valor;
// 	});


// * Pegar Comentarios
function PegarComentarios() {
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
		url: `http://localhost/tcc/app/Controllers/ComentarioController.php?get_id=${data.id}`,
		dataType: "JSON",
		success: function (response) {
			// console.log("chegando aqui");
			InserirComentarios(response.data.body);
		}
	});
}
PegarComentarios();


function InserirComentarios(array_comentarios) {
	$(".comentarios-section__content").empty();
	if (array_comentarios) {
		$("#produto-total-comentario").html(`${array_comentarios.length} Comentários para este produto`);
		if (array_comentarios.length >= 3) {
			for (let i = 0; i < 3; i++) {
				var tag_card = `
				<div class="comentario-card">
					<div class="comentario-card__header">
						<div class="comentario-card__user">
						<img src="http://localhost/tcc/public/images/avatar-user-r.png" alt="" width="30px">
						<h6 class="comentario-card__title">
						${array_comentarios[i]?.nome_completo}
						</h6>
						</div>
						<p class="comentario-card__created">
						${new Date(array_comentarios[i]?.criado_em).toLocaleDateString()}
						</p>
						<!-- <div class="comentarios-card__likes"></div> -->
						</div>
						<div class="comentario-card__body">
						<p>
						${array_comentarios[i]?.conteudo}
					</p>
					</div>
				</div>
				`;

				$(".comentarios-section__content").append(tag_card);
				$("#btn-todos-comentarios").css("display", "block");
			}
		} else if (array_comentarios.length <= 2) {
			for (let i = 0; i <= 2; i++) {
				var tag_card = `
				<div class="comentario-card">
					<div class="comentario-card__header">
						<div class="comentario-card__user">
							<img src="http://localhost/tcc/public/images/avatar-user-r.png" alt="" width="30px">
							<h6 class="comentario-card__title">
							${array_comentarios[0]?.nome_completo}
							</h6>
						</div>
						<p class="comentario-card__created">
						${new Date(array_comentarios[0]?.criado_em).toLocaleDateString()}
						</p>
						<!-- <div class="comentarios-card__likes"></div> -->
					</div>
					<div class="comentario-card__body">
						<p>
						${array_comentarios[0]?.conteudo}
						</p>
					</div>
				</div>
			`;
			}
			$(".comentarios-section__content").append(tag_card);
		}
		$("#btn-todos-comentarios").css("display", "block");
	}
	else {
		$(".comentarios-section__content").html(`<p class="text-center">Nenhum comentário foi encontrado.</p>`);
		$("#btn-todos-comentarios").css("display", "none");
	}
}


// ver todos os comentarios
$("#btn-todos-comentarios").click(function () {
	$(".modal-comentarios").toggleClass("open");

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
		url: `http://localhost/tcc/app/Controllers/ComentarioController.php?get_id=${data.id}`,
		dataType: "JSON",
		success: function (response) {
			if (response.data.body.length > 0) {
				$(".modal-comentarios__header h5").html(`${response.data.body.length} comentários.`);
				$(".modal-comentarios__body").empty();
				response.data.body.forEach(comentario => {
					var tag_card = `
						<div class="comentario-card">
							<div class="comentario-card__header">
								<div class="comentario-card__user">
									<img src="http://localhost/tcc/public/images/avatar-user-r.png" alt="" width="30px">
									<h6 class="comentario-card__title">
									${comentario.nome_completo}
									</h6>
								</div>
								<p class="comentario-card__created">
								${new Date(comentario.criado_em).toLocaleDateString()}
								</p>
								<!-- <div class="comentarios-card__likes"></div> -->
							</div>
							<div class="comentario-card__body">
								<p>
								${comentario.conteudo}
								</p>
							</div>
						</div>
				`;
					$(".modal-comentarios__body").append(tag_card);
				});
			}
		}
	});
});

$("#btn-fechar-todos-comentarios-modal").click(function () {
	$(".modal-comentarios").removeClass("open");
});