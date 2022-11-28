<?php

namespace App\Controllers;

use App\Core\Base;
use App\Database\Database;
use App\Models\Imagem;
use App\Models\Produto;
use Exception;
use PDO;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class BuscaController
{

	public static function Buscar($query)
	{
		try {
			if (!empty($query)) {
				$database = (new Database)->QueryBusca($query)->fetchAll(PDO::FETCH_ASSOC);

				if (!empty($database)) {
					$mensagem = "Foram encontrados " . count($database) . " para $query";
					// $redirect_link = "Location: http://localhost/tcc/app/Views/Produtos/busca.php?search=$query";
					// header($redirect_link);
					Base::Response($mensagem, $database, 1);
				} else {
					// throw new Exception();
					Base::Response($query, null, 0);
				}
			} else {
				header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
				exit;
			}
		} catch (\Throwable $th) {
			throw new Exception($th);
		}
	}

	public static function Filtros($array_filtros)
	{
		Base::Response("os dados ai", $array_filtros, 1);
	}
}

if (!empty($_GET)) {

	switch ($_GET) {
		case isset($_GET["search"]):
			BuscaController::Buscar($_GET["search"]);
			break;
		default:
			header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
			exit;
			break;
	}
} else {
	switch ($_POST) {
		case isset($_POST["filtros"]):
			BuscaController::Filtros($_POST["filtros"]);
			break;
	}
}
