$("#form-edit-usuario").validate(
	{
		rules: {
			"usuario-nome": {
				required: true,
			},
			"usuario-cpf": {
				required: true,
				maxlength: 11,
				minlength: 11,
			},
			"usuario-data_nascimento": {
				required: true,
			},
			"usuario-email": {
				required: true,
				email: true,
			},
			"usuario-telefone": {
				required: true,
			},
			"usuario-cidade": {
				required: true,
			},
			"usuario-estado": {
				required: true,
			},
			"usuario-pais": {
				required: true,
			},
			// "usuario-senha": {
			// 	required: true,
			// 	maxlength: 20,
			// 	minlength: 8
			// },
			// "usuario-confirmar-senha": {
			// 	required: true,
			// 	equalTo: "#usuario-senha",
			// 	maxlength: 20,
			// 	minlength: 8
			// },
		},
		messages: {
			"usuario-nome": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"usuario-cpf": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
				maxlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Digitos incorretos.</span>`,
				minlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Digitos incorretos.</span>`,
			},
			"usuario-data_nascimento": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"usuario-email": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
				email: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Email inválido.</span>`
			},
			"usuario-telefone": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"usuario-cidade": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"usuario-estado": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			"usuario-pais": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`
			},
			// "usuario-senha": {
			// 	required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
			// 	maxlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">A senha deve conter no máximo 20 caractéres.</span>`,
			// 	minlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">A senha deve conter no mínimo 8 caractéres.</span>`,
			// },
			// "usuario-confirmar-senha": {
			// 	required: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Este campo é obrigatório.</span>`,
			// 	equalTo: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">As senhas não são iguais.</span>`,
			// 	maxlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Digitos incorretos.</span>`,
			// 	minlength: `<i class="fas fa-exclamation-triangle"></i><span class="input-error">Digitos incorretos.</span>`,
			// },
		},
		submitHandler: function (form) {
			var data_formatada = new Date($("#usuario-data_nascimento").val()).toISOString().slice(0, 19).replace('T', ' ');
			$.ajax({
				type: "POST",
				url: "http://localhost/tcc/app/Controllers/UsuarioController.php",
				data: {
					"usuario-editado": {
						"id": $("#usuario-id").val(),
						"nome": $("#usuario-nome").val(),
						"cpf": $("#usuario-cpf").val(),
						"data_nascimento": $("#usuario-data_nascimento").val(),
						"email": $("#usuario-email").val(),
						"telefone": $("#usuario-telefone").val().trim(),
						"cidade": $("#usuario-cidade").val(),
						"estado": $("#usuario-estado").val(),
						"pais": $("#usuario-pais").val(),
					}
				},
				dataType: "JSON",
				success: function (response) {
					console.log(response);
					// if (response.status == 0) {
					// 	Toast(response.data.mensagem);
					// } else {
					// 	Toast(response.data.mensagem);
					// 	setTimeout(() => {
					// 		window.location.href = "http://localhost/tcc/app/Views/Usuario/login.php";
					// 	}, 2000);
					// }
				}
			});
		}
	}
);