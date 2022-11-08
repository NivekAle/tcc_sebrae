$("#produto-preco").mask("000.000.000.000.000,00", { reverse: true });

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
		submitHandler: function (e) {
			e.preventDefault();
			console.log(this);
		}
	}
);