<?php


namespace App\Controllers;

use App\Core\Base;
use App\Database\Database;
use App\DTO\ProdutosDTO;
use App\Helpers\Session;
use App\Helpers\Upload;
use App\Models\Imagem;
use App\Models\Produto;
use App\Models\AtributosProdutos;
use Exception;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class ProdutoController
{

	public static function AtivarProduto($id_produto_ativado)
	{
		if (!empty($id_produto_ativado)) {
			(new Database("produtos"))->update(
				"id = $id_produto_ativado",
				[
					"status" => 1
				]
			);
			session_start();
			Base::Response("Produto ativado com sucesso", ["id" => $_SESSION["sessao_usuario"]->id], 1);
		} else {
			Base::Response("Não é possivel ativar o produto no momento, tente novamente mais tarde", null, 1);
		}
	}

	public static function RemoverProduto($id_produto_remover)
	{
		if (!empty($id_produto_remover)) {
			# code...
			(new Database("produtos"))->update(
				" id = '$id_produto_remover'",
				[
					"status" => 0
				]
			);
			session_start();
			Base::Response("Produto desativado com sucesso", ["id" => $_SESSION["sessao_usuario"]->id], 1);
		} else {
			Base::Response("Houve um erro ao desativar o produto, tente novamente mais tarde", null, 0);
		}
	}

	public static function EditarProduto($produto)
	{
		try {
			if (!empty($produto)) {
				$produto_db = ProdutosDTO::PegarProduto($produto["id"]);
				$produto_db->nome = $produto["nome"];
				$produto_db->descricao = $produto["descricao"];
				$produto_db->preco = $produto["preco"];
				$produto_db->id_categoria = $produto["categoria"];
				$produto_db->EditarProdutoDB($produto["id"]);

				Base::Response("Produto editado com sucesso, redirecionando...", null, 1);
			} else {
				throw new Exception("Houve um erro ao editar este produto, tente novamente mais tarde.", 1);
			}
		} catch (Exception $error) {
			Base::Response($error->getMessage(), null, 0);
		}
	}

	public static function AdicionarProduto($novo_produto)
	{
		try {
			$atributos_parser = json_decode($novo_produto["atributos"], true);
			if (empty($atributos_parser)) {
				Base::Response("É necessário pelo menos 1 atributo.", null, 0);
				return;
			}
			$atributos = array_chunk(json_decode($novo_produto["atributos"]), 2);

			$produto = new Produto();
			$produto->nome = $novo_produto["nome"];
			$produto->descricao = $novo_produto["descricao"];
			$produto->preco = $novo_produto["preco"];
			$produto->id_categoria = $novo_produto["categoria"];
			$produto->id_vendedor = $novo_produto["vendedor"];

			$produto->Cadastrar();
			for ($i = 0; $i < count($atributos); $i++) {
				$atributo_db = new AtributosProdutos();

				$atributo_db->nome = $atributos[$i][0];
				$atributo_db->valor = $atributos[$i][1];
				$atributo_db->id_produto = $produto->id;
				$atributo_db->Cadastrar();
			}

			$imagens_produto = Imagem::PegarImagemProduto($produto->id);

			if (!empty($imagens_produto)) {
				self::RemoverProduto($produto->id);
			}

			echo json_encode(
				[
					"data" => [
						"produto" => [
							"id" => $produto->id
						]
					]
				]
			);
		} catch (Exception $error) {
			Base::Response($error->getMessage(), null, 0);
		}
	}

	public static function PegarProduto($id_produto)
	{
		$db_produto = Produto::PegarProduto($id_produto);
		$imagens = Imagem::PegarImagemProduto($id_produto);
		$atributos = AtributosProdutos::PegarAtributos($id_produto);
		if (!empty($db_produto)) {
			Base::Response("", ["Produto" => [
				"informacoes" => $db_produto,
				"imagens" => $imagens,
				"atributos" => $atributos
			]], 1);
		} else {
			Base::Response("Houve um erro ao carregar o produto, tente novamente mais tarde", null, 0);
		}
	}

	public static function JsonTodosProduto($param)
	{
		if ($param) {
			$produtos = ProdutosDTO::PegarTodosProdutos();
			Base::Response("Carregando produtos", $produtos, 1);
		} else {
			Base::Response("Houve um erro ao carregar os produtos, tente novamente mais tarde", null, 0);
		}
	}

	public static function PegarProdutosComLimite($nome_categoria)
	{
		$produtos = ProdutosDTO::ProdutosLimite($nome_categoria, true);

		Base::Response("ada", $produtos, 1);
	}

	public static function AdicionarImagemProduto($id_produto)
	{
		$targetDir = "../../public/uploads/";
		$tipos_aceitos = array('jpg', 'png', 'jpeg');

		$files_names = array_filter($_FILES["produto-imagem"]["name"]);

		// print_r($files_names);
		// die();

		if (!empty($files_names)) {
			foreach ($_FILES["produto-imagem"]["name"] as $key => $value) {
				// caminho do arquivo;
				$destination_path = getcwd() . DIRECTORY_SEPARATOR;
				$file_name = basename($_FILES["produto-imagem"]["name"][$key]);
				$targetFilePath =  $targetDir . $file_name;

				// checando tipo do arquivo
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
				if (in_array($fileType, $tipos_aceitos)) {
					// movendo o arquivo pro servidor
					if (move_uploaded_file($_FILES["produto-imagem"]["tmp_name"][$key], $targetFilePath)) {
						// inserção da imagem no Banco de Dados;
						$imagemDB = new Imagem();
						$imagemDB->caminho = $file_name;
						$imagemDB->id_produto = $id_produto;
						$imagemDB->Adicionar();
						$imagens_produto = Imagem::PegarImagemProduto($imagemDB->id_produto);
						if (empty($imagens_produto)) {
							// self::AtivarProduto();
							(new Database("produtos"))->update(
								"id = $imagemDB->id_produto",
								[
									"status" => 0
								]
							);
						}
						header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
					}
				} else {
					header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
					Base::Response("Insira uma imagem", null, 1);
				}
			}
		}
	}

	public static function Like($id_produto)
	{
		if (!empty($id_produto)) {
			$produto = Produto::PegarProduto($id_produto);
			(new Database("produtos"))->update(
				"id = '$id_produto' ",
				[
					"likes" => $produto->likes + 1
				]
			);
			Base::Response("", ["total_likes" => $produto->likes + 1], 1);
		} else {
			Base::Response("Não é possivel executar esta ação no momento, tente novamente mais tarde.", null, 0);
		}
	}
}

if (!empty($_POST)) {
	switch ($_POST) {
		case isset($_POST["editar-produto"]):
			ProdutoController::EditarProduto($_POST["editar-produto"]);
			break;
		case isset($_POST["novo-produto"]):
			ProdutoController::AdicionarProduto($_POST["novo-produto"]);
			break;
		case isset($_FILES["produto-imagem"]):
			ProdutoController::AdicionarImagemProduto($_POST["produto-id"]);
			break;
			// default:
			// 	header("Location: http://localhost/tcc/");
			// 	break;
	}
} else {
	switch ($_GET) {
			// pegar unico produto e retorar json
		case isset($_GET["list"]):
			ProdutoController::JsonTodosProduto($_GET["list"]);
			break;
		case isset($_GET["id"]):
			ProdutoController::PegarProduto($_GET["id"]);
			break;
		case isset($_GET["cat_limit"]):
			ProdutoController::PegarProdutosComLimite($_GET["cat_limit"]);
			break;
		case isset($_GET["remover"]):
			ProdutoController::RemoverProduto($_GET["remover"]);
			break;
		case isset($_GET["ativar"]):
			ProdutoController::AtivarProduto($_GET["ativar"]);
			break;
		case isset($_GET["like_for"]):
			ProdutoController::Like($_GET["like_for"]);
			break;
		default:
			header("Location: http://localhost/tcc/");
			break;
	}
}
