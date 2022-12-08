<?php

namespace App\Controllers;

use App\Core\Base;
use App\Models\Imagem;
use App\Models\Produto;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class CarrinhoController
{

	private static $carrinho = [];

	public static function Adicionar($id_produto)
	{

		session_start();
		// * pegar as props do produto
		$produto_selecionado = Produto::PegarProduto($id_produto);
		$imagens = Imagem::PegarImagemProduto($id_produto);

		//* verificando se o produto existe
		if (!empty($produto_selecionado)) {
			//* vericando se o produto ja existe no carinho
			if (isset($_SESSION["carrinho"][$id_produto])) {
				// $_SESSION["carrinho"][$id_produto]["quantidade"]++;
				Base::Response("Este produto já está no seu carrinho.", null, 0);
			} else {
				$_SESSION["carrinho"][$id_produto] = array(
					"id_produto" => $produto_selecionado->id,
					"nome_produto" => $produto_selecionado->nome,
					"preco_produto" => $produto_selecionado->preco,
					"imagens" => $imagens
					// "quantidade" => 1,
				);
				Base::Response("Produto foi adicionado no seu carrinho!", null, 1);
			}
		} else {
			Base::Response("Não foi possível adicionar o produto ao carrinho, tente novamente mais tarde.", null, 0);
		}

		// * Ao concluir o carrinho enviar para a compra;
	}

	// Pegar o carrinho
	public static function Consultar($id_usuario)
	{

		session_start();
		// echo json_encode($_SESSION["carrinho"],true);
		if (!empty($_SESSION["carrinho"])) {
			// echo json_encode(self::$carrinho, true);
			Base::Response("", $_SESSION["carrinho"], true);
			return;
		}
		// echo json_encode(self::$carrinho, true);
		Base::Response("", self::$carrinho, true);
		exit;
	}


	public static function LimparCarrinho($status)
	{
		session_start();
		unset($_SESSION["carrinho"]);
		Base::Response("Carrinho limpado com sucesso", null, 0);
		exit;
	}

	public static function RemoverProduto($id_produto)
	{
		session_start();
		try {
			unset($_SESSION["carrinho"][$id_produto]);
			Base::Response("", null, 1);
		} catch (\Throwable $th) {
			Base::Response("Houve um erro ao remover este produto.", null, 0);
			// throw $th;
		}
	}
}

switch ($_GET) {
	case isset($_GET["add_carrinho"]):
		CarrinhoController::Adicionar($_GET["add_carrinho"]);
		break;
	case isset($_GET["items"]):
		CarrinhoController::Consultar($_GET["items"]);
		break;
	case isset($_GET["clear"]):
		CarrinhoController::LimparCarrinho($_GET["clear"]);
		break;
	case isset($_GET["remover_produto"]):
		CarrinhoController::RemoverProduto($_GET["remover_produto"]);
		break;
}
