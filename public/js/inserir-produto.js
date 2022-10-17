// $("#frmInserirProduto").validate(
// 	{
// 		rules: {
// 			produto_nome: {
// 				required: true
// 			},
// 			produto_descricao: {
// 				required: true
// 			},
// 			produto_preco: {
// 				required: true
// 			}
// 		},
// 		messages: {
// 			produto_nome: {
// 				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`,
// 			},
// 			produto_descricao: {
// 				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`
// 			},
// 			produto_preco: {
// 				required: `<i class="fas fa-exclamation-triangle"></i><span class="login-error">Este campo é obrigatório. Por favor preencha.</span>`
// 			}
// 		},
// 		submitHandler: function (form) {
// 			$.ajax({
// 				type: "POST",
// 				url: "http://localhost/tech_solution.com.br/App/Controllers/ProdutoController.php",
// 				data: {
// 					novo_produto: {
// 						"produto_nome": $("#produto_nome").val(),
// 						"produto_descricao": $("#produto_descricao").val(),
// 						"produto_preco": $("#produto_preco").val(),
// 					}
// 				},
// 				dataType: "json",
// 				success: function (response) {
// 					console.log(response);
// 				}
// 			});
// 		}
// 	}
// )