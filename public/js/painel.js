function CardDropdown(id) {
	const card = document.querySelector(`#produto-${id}`);
	const dropdown = card.querySelector(".produto-card__dropdown");
	dropdown.classList.toggle("drop");
}


// Filtros

// -> somente produtos desativados
$("#btn-filtrar-produtos-vendedor").on("click", function () {

	var filtros_selecionados = [];

	$('select[data-group="filtros-produtos"]').each(function (indexInArray, valueOfElement) {
		if (!valueOfElement.value == "") {
			filtros_selecionados.push(valueOfElement.value);
		}
	});


	$.ajax({
		type: "POST",
		url: "http://localhost/tcc/app/Controllers/PainelController.php",
		data: { "filtros_selecionados": filtros_selecionados },
		dataType: "json",
		success: function (response) {
			console.log(response);
		}
	});
})