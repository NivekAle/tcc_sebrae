$("#frm-login-vendedor").validate(
	{
		rules: {
			"vendedor-email": {
				required: true
			},
			"vendedor-senha": {
				required: true
			}
		},
		messages: {
			"vendedor-email": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`,
				email: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Insira um email válido.</span>`,
			},
			"vendedor-senha": {
				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`
			}
		},
		submitHandler: function (form) {
			$.ajax({
				type: "POST",
				url: "http://localhost/tcc/app/Controllers/LoginController.php",
				data: {
					login_vendedor: {
						"email": $("#vendedor-email").val(),
						"senha": $("#vendedor-senha").val(),
					}
				},
				dataType: "json",
				success: function (response) {
					if (response.data.permissao) {
						window.location.href = "http://localhost/tcc/app/Views/Produtos/index.php";
					}
					else if (response.status == 0) {
						ToastAlert(response.data.mensagem);
					}
				}
			});
		}
	}
);

function ToastAlert($mensagem) {
	const div = document.createElement("div");
	const icon = document.createElement("i");
	const mensagem = document.createElement("p");
	div.classList.add("alert", "alert-danger", "d-flex", "flex-column", "justify-content-center", "gap-2");
	div.setAttribute("id", "login-user-error-alert");
	icon.classList.add("fas", "fa-info-circle");
	mensagem.classList.add("m-0");
	const content = document.createElement("div");
	content.classList.add("d-flex", "flex-row", "align-items-center", "justify-content-center", "gap-2");
	content.append(icon);
	content.append(mensagem);
	div.append(content);
	mensagem.innerText = $mensagem;
	if (document.body.querySelector("#login-user-error-alert") == null) {
		document.body.appendChild(div);
		div.animate(
			[
				{
					transform: "translateZ(-1400px)",
					opacity: "0"
				},
				{
					transform: "translateZ(0)",
					opacity: "1"
				}
			], {
			duration: 200
		});
		setTimeout(() => {
			const exist_element = document.getElementById("login-user-error-alert");
			document.getElementById("body").removeChild(exist_element);
		}, 3000);
	}
	else {
		const exist_element = document.getElementById("login-user-error-alert");
		document.getElementById("body").removeChild(exist_element);
		document.body.appendChild(div);
	}
}