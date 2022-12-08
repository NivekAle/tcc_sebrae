<?php

namespace App\Controllers;

use App\Core\Base;
use App\Database\Database;
use App\DTO\ProdutosDTO;
use App\Models\Produto;
use Exception;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class PainelController
{

	public static function ProdutosVendedor($id_vendedor)
	{
		try {
			$todos_produtos_vendedor = ProdutosDTO::ProdutosVendedor($id_vendedor);

			if (!empty($todos_produtos_vendedor)) {
				Base::Response("", $todos_produtos_vendedor, 1);
			} else {
				throw new Exception('Não foi possivel carregar os produtos.');
			}
		} catch (Exception $error) {
			Base::Response($error->getMessage(), null, 0);
		}
	}
}

if (!empty($_POST)) {
	switch ($_POST) {
		default:
			header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
			exit;
			break;
	}
} else {
	switch ($_GET) {
		case isset($_GET["list_by"]):
			PainelController::ProdutosVendedor($_GET["list_by"]);
			break;
	}
}
