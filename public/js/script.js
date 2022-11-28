$(".navbar__dropdown-button").click(function () {
	$(".navbar__dropdown").toggleClass("active");
});


// pesquisa
$("#frm-pesquisa").submit(function (e) {
	e.preventDefault();
	console.log(this["pesquisa"].value);
	window.location.href = `http://localhost/tcc/app/Views/Produtos/busca.php?search=${this["pesquisa"].value}`;
	//
});

