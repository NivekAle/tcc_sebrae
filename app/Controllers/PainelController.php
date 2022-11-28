<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\Produto;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class PainelController
{

	public static function Filtros($array_filtros)
	{
		$db = (new Database())->Filtragem($array_filtros);
	}
}

if (!empty($_POST)) {
	switch ($_POST) {
		case isset($_POST["filtros_selecionados"]):
			PainelController::Filtros($_POST["filtros_selecionados"]);
			break;
		default:
			header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
			exit;
			break;
	}
}
