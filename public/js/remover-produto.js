$.ajax({
	type: "POST",
	url: "http://localhost/tcc/app/Controllers/ProdutoController.php",
	data: { "remover-produto" : $("#produto-id").val() },
	dataType: "dataType",
	success: function (response) {

	}
});