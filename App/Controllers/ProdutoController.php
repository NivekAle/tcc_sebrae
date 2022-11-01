<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\Produto;

require("d:/projects/php/tcc/vendor/autoload.php");

class ProdutoController
{

	public static function RemoverProduto($id_produto_remover)
	{
		(new Database("produtos"))->update(
			"id = $id_produto_remover",
			[
				"status" => 0
			]
		);
	}
}

switch ($_POST) {
	case isset($_POST["remover-produto"]):
		ProdutoController::RemoverProduto($_POST["remover-produto"]);
		break;
	default:
		header("Location: http://localhost/tcc/");
		break;
}
