import { Toast } from './Toast.js'

// criar o vendedor primeiro depois inserir o cpf ou cnpj
$("#frm-cadastro-vendedor").validate(
	{
		rules: {
			"vendedor-nome": {
				required: true,
			},
			"vendedor-email": {
				required: true,
			},
			"vendedor-cidade": {
				required: true,
			},
			"vendedor-estado": {
				required: true,
			},
			"vendedor-pais": {
				required: true,
			},
			"vendedor-senha": {
				required: true,
				maxlength: 20,
				minlength: 8
			},
			"vendedor-senha_confirma": {
				required: true,
				equalTo: "#vendedor-senha"
			},
			"vendedor-cpf": {
				require: false,
				maxlength: 11,
				minlength: 11,
			},
			"vendedor-cnpj": {
				require: false,
				maxlength: 14,
				minlength: 14,
			},
		},
		messages: {
			"vendedor-nome": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"vendedor-cpf": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
				maxlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Digitos incorretos.</span>`,
				minlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Digitos incorretos.</span>`,
			},
			"vendedor-cnpj": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
				maxlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Digitos incorretos.</span>`,
				minlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Digitos incorretos.</span>`,
			},
			"vendedor-email": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"vendedor-estado": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"vendedor-cidade": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"vendedor-pais": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"vendedor-senha": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
				maxlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">A senha deve conter no máximo 20 caractéres.</span>`,
				minlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">A senha deve conter no mínimo 8 caractéres.</span>`,
			},
			"vendedor-senha_confirma": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
				equalTo: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">As senhas não são iguais.</span>`
			},
		},
		submitHandler: function (form) {
			$.ajax({
				type: "POST",
				url: "http://localhost/tcc/app/Controllers/VendedorController.php",
				data: {
					"novo-vendedor": {
						"nome": $("#vendedor-nome").val(),
						"email": $("#vendedor-email").val(),
						"cidade": $("#vendedor-cidade").val(),
						"estado": $("#vendedor-estado").val(),
						"pais": $("#vendedor-pais").val(),
						"senha": $("#vendedor-senha").val(),
						"cpf": $("#vendedor-cpf").val() != "" ? $("#vendedor-cpf").val() : "",
						"cnpj": $("#vendedor-cnpj").val() != "" ? $("#vendedor-cnpj").val() : ""
					}
				},
				dataType: "JSON",
				success: function (response) {
					console.log(response);
					if (response.status == 0) {
						Toast(response.data.mensagem, 2000);
					} else {
						Toast("Cadastro realizado com sucesso, aguarde alguns instantes.", 2000);
						setTimeout(() => {
							window.location.href = `http://localhost/tcc/app/Views/Vendedor/login.php`;
						}, 2500);
					}
				}
			});
		}
	}
);

$(document).ready(function () {
	$("#seleciona-cpf").change(function () {
		$("label[id='vendedor-identificador']").html("CPF");
		$("input[data-js='render-option'").prop("name", "vendedor-cpf");
		$("input[data-js='render-option'").prop("id", "vendedor-cpf");
		$("input[data-js='render-option'").prop("required", "true");
		$("input[data-js='render-option'").val("");
		// $("input[data-js='render-option'").prop("maxlength", "11");
		$("#box-indetificador").css("opacity", "1");
		// $("#vendedor-cnpj-error").css("opacity", "0");
		$("#vendedor-cnpj-error").remove();
		$("#vendedor-cpf").mask("00000000000");
	});

	$("#seleciona-cnpj").change(function () {
		$("label[id='vendedor-identificador']").html("CNPJ");
		$("input[data-js='render-option'").prop("name", "vendedor-cnpj");
		$("input[data-js='render-option'").prop("id", "vendedor-cnpj");
		$("input[data-js='render-option'").prop("required", "true");
		// $("input[data-js='render-option'").prop("maxlength", "14");
		$("input[data-js='render-option'").val("");
		$("#box-indetificador").css("opacity", "1");
		// $("#vendedor-cpf-error").css("opacity", "0");
		$("#vendedor-cpf-error").remove();
		$("#vendedor-cnpj").mask("00000000000000");
	});

	if ($("#seleciona-cpf").is(":checked")) {
		$("label[id='vendedor-identificador']").html("CPF");
		$("input[data-js='render-option'").prop("name", "vendedor-cpf");
		$("input[data-js='render-option'").prop("id", "vendedor-cpf");
		$("input[data-js='render-option'").prop("required", "true");
		$("input[data-js='render-option'").val("");
		// $("input[data-js='render-option'").prop("maxlength", "11");
		$("#box-indetificador").css("opacity", "1");
		$("#vendedor-cnpj-error").remove();
		$("#vendedor-cpf").mask("00000000000");
	}
});

// mostrar senha
$("#toggle-password").on("change", function () {
	var state = ($(this).is(':checked') ? 'text' : 'password');
	$("#vendedor-senha").prop("type", state);
	$("#vendedor-senha_confirma").prop("type", state);
});