<?php

namespace App\Controllers;

use App\Core\Base;
use App\Database\Database;
use App\DTO\ProdutosDTO;
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
		try {
			$atributos_parser = json_decode($novo_produto["atributos"], true);
			if (empty($atributos_parser)) {
				Base::Response("É necessário pelo menos 1 atributo.", null, 0);
				return;
			}
			$atributos = array_chunk(json_decode($novo_produto["atributos"]), 2);
			// TODO : adicionar dados ao bd, são 2 arrays Array 👇
			// Array(	[0] => Array ([0] => nome 1 ,[1] => valor 1))

			$produto = new Produto();
			$produto->nome = $novo_produto["nome"];
			$produto->descricao = $novo_produto["descricao"];
			$produto->preco = $novo_produto["preco"];
			$produto->id_categoria = $novo_produto["categoria"];
			$produto->id_vendedor = $novo_produto["vendedor"];

			$produto->Cadastrar();

			for ($i = 0; $i < count($atributos); $i++) {
				$atributo_db = new AtributosProdutos();
				$attr_duplicado = (new AtributosProdutos())->VerificarDuplicidade($atributos[$i][0]);
				if ($attr_duplicado) {
					throw new Exception('Os nomes dos atributos não podem ser iguais.');
				} else {
					$atributo_db->nome = $atributos[$i][0];
					$atributo_db->valor = $atributos[$i][1];
					$atributo_db->id_produto = $produto->id;
					$atributo_db->Cadastrar();
				}
			}
			
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
		} catch (Exception $error) {
			Base::Response($error->getMessage(), null, 0);
		}
	}

	public static function PegarProduto($id_produto)
	{
		$db_produto = Produto::PegarProduto($id_produto);
		$imagens = Imagem::PegarImagemProduto($id_produto);
		if (!empty($db_produto)) {
			Base::Response("", ["Produto" => [
				"informacoes" => $db_produto,
				"imagens" => $imagens
			]], 1);
		} else {
			Base::Response("Houve um erro ao carregar o produto, tente novamente mais tarde", null, 0);
		}
	}

	public static function JsonTodosProduto($param)
	{
		// $db_produto = Produto::PegarProduto($id_produto);
		// $imagens = Imagem::PegarImagemProduto($id_produto);
		if ($param) {
			$list_produtos = ProdutosDTO::PegarTodosProdutos();
			Base::Response("Carregando Imagens", $list_produtos, 1);
			return;
		} else {
			Base::Response("Houve um erro ao carregar os produtos, tente novamente mais tarde", null, 0);
		}
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

// echo '<pre>';
// print_r($_POST);
// echo '<pre>';
// die();

if (!empty($_POST)) {
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
		default:
			header("Location: http://localhost/tcc/");
			break;
	}
}
