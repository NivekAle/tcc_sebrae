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
$("#btn-novo-comentario__confirmar").click(function () {
	$(".modal-novo-comentario").removeClass("open");
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
		dataType: "JSON",
		success: function (response) {
		}
	});
});
