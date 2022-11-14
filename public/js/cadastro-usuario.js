$("#frm-cadastro-usuario").validate(
	{
		rules: {
			"usuario-nome": {
				required: true,
			},
			"usuario-cpf": {
				required: true,
			},
			"usuario-data_nascimento": {
				required: true,
			},
			"usuario-email": {
				required: true,
			},
			"usuario-telefone": {
				required: true,
			},
			"usuario-cidade": {
				required: true,
			},
			"usuario-Estado": {
				required: true,
			},
			"usuario-pais": {
				required: true,
			},
			"usuario-senha": {
				required: true,
			},
		},
		messages: {
			"usuario-nome": {
				required: "Este campo é obrigatório."
			},
			"usuario-cpf": {
				required: "Este campo é obrigatório."
			},
			"usuario-data_nascimento": {
				required: "Este campo é obrigatório."
			},
			"usuario-email": {
				required: "Este campo é obrigatório."
			},
			"usuario-telefone": {
				required: "Este campo é obrigatório."
			},
			"usuario-cidade": {
				required: "Este campo é obrigatório."
			},
			"usuario-Estado": {
				required: "Este campo é obrigatório."
			},
			"usuario-pais": {
				required: "Este campo é obrigatório."
			},
			"usuario-senha": {
				required: "Este campo é obrigatório."
			},
		},
		submitHandler: function (form) {
			$.ajax({
				type: "POST",
				url: "http://localhost/tcc/app/Controllers/UsuarioController.php",
				data: {
					"usuario-cadastro": {
						"nome": $("#usuario-nome").val(),
						"cpf": $("#usuario-cpf").val(),
						"data_nascimento": $("#usuario-data_nascimento").val(),
						"email": $("#usuario-email").val(),
						"telefone": $("#usuario-telefone").val(),
						"cidade": $("#usuario-cidade").val(),
						"estado": $("#usuario-estado").val(),
						"pais": $("#usuario-pais").val(),
						"senha": $("#usuario-senha").val(),
					}
				},
				dataType: "JSON",
				success: function (response) {
					if (response.status == 0) {
						ToastAlert(response.data.mensagem);
					} else {
						ToastAlert(response.data.mensagem);
						setTimeout(() => {
							window.location.href = "http://localhost/tcc/app/Views/Produtos/index.php";
						}, 1000);
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
	div.classList.add("alert", `${$mensagem == 0 ? "alert-danger" : "alert-success"}`, "d-flex", "flex-column", "justify-content-center", "gap-2");
	div.setAttribute("id", `${$mensagem == 0 ? "login-user-error-alert" : "login-user-success-alert"}`);
	icon.classList.add("fas", "fa-info-circle");
	mensagem.classList.add("m-0");
	const content = document.createElement("div");
	content.classList.add("d-flex", "flex-row", "align-items-center", "justify-content-center", "gap-2");
	content.append(icon);
	content.append(mensagem);
	div.append(content);
	mensagem.innerText = $mensagem;
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
	document.body.appendChild(div);
	// if (document.body.querySelector("#login-user-error-alert") == null) {

	// }
	// else {
	// 	const exist_element = document.getElementById("login-user-error-alert");
	// 	document.getElementById("body").removeChild(exist_element);
	// 	document.body.appendChild(div);
	// }
}