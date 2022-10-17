$("#frmLogin").validate(
	{
		rules: {
			login_email: {
				required: true
			},
			login_senha: {
				required: true
			}
		},
		messages: {
			login_email: {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`,
				email: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Insira um email válido.</span>`,
			},
			login_senha: {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`
			}
		},
		submitHandler: function (form) {
			$.ajax({
				type: "POST",
				url: "http://localhost/tech_solution.com.br/App/Controllers/LoginController.php",
				data: {
					login: {
						"email": $("#login_email").val(),
						"senha": $("#login_senha").val(),
					}
				},
				dataType: "json",
				success: function (response) {
					if (response.data.permissao) {
						window.location.href = "http://localhost/tech_solution.com.br/App/Views/Produto/index.php";
					}
				}
			});
		}
	}
)