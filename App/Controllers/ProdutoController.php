<?php

namespace App\Controllers;

use App\Database\Database;
use App\Helpers\Upload;
use App\Models\Imagem;
use App\Models\Produto;
use Exception;

require("d:/projects/php/tcc/vendor/autoload.php");

class ProdutoController
{

	public static function AtivarProduto($id_produto_ativado)
	{
		(new Database("produtos"))->update(
			"id = $id_produto_ativado",
			[
				"status" => 1
			]
		);
	}

	public static function RemoverProduto($id_produto_remover)
	{
		(new Database("produtos"))->update(
			"id = $id_produto_remover",
			[
				"status" => 0
			]
		);
	}

	public static function EditarProduto($id_produto)
	{
	}

	public static function AdicionarProduto($novo_produto)
	{
		$produto = new Produto();
		$produto->nome = $novo_produto["nome"];
		$produto->descricao = $novo_produto["descricao"];
		$produto->preco = $novo_produto["preco"];
		$produto->id_categoria = $novo_produto["categoria"];
		$produto->id_vendedor = $novo_produto["vendedor"];

		$produto->Cadastrar();

		$imagens_produto = Imagem::PegarImagemProduto($produto->id);

		if (empty($imagens_produto)) {
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
	}

	public static function JsonPegarProduto($id_produto)
	{
		$db_produto = Produto::PegarProduto($id_produto);
		echo json_encode($db_produto, true);
	}

	public static function AdicionarImagemProduto($id_produto)
	{
		$targetDir = "../../public/uploads/";
		$tipos_aceitos = array('jpg', 'png', 'jpeg');

		$files_names = array_filter($_FILES["produto-imagem"]["name"]);

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
						if (!empty($imagens_produto)) {
							self::AtivarProduto($imagemDB->id_produto);
						}
						header("Location: http://localhost/tcc/app/Views/Produtos/");
						exit;
					} else {
						echo "erro ao mover o arquivo";
					}
				} else {
					echo "erro arrauy vazio";
				}
			}
		}
	}
}

switch ($_POST) {
	case isset($_POST["remover-produto"]):
		ProdutoController::RemoverProduto($_POST["remover-produto"]);
		break;
	case isset($_POST["editar-produto"]):
		ProdutoController::EditarProduto($_POST["editar-produto"]);
		break;
	case isset($_POST["novo-produto"]):
		ProdutoController::AdicionarProduto($_POST["novo-produto"]);
		break;
	case isset($_GET["pegar-produto"]):
		ProdutoController::JsonPegarProduto($_GET["id_produto"]);
		break;
	case isset($_FILES["produto-imagem"]):
		ProdutoController::AdicionarImagemProduto($_POST["produto-id"]);
		break;
		// default:
		// 	header("Location: http://localhost/tcc/");
		// 	break;
}
