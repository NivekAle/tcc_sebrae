<?php

namespace App\Core;

require('d:/projects/php/tcc/vendor/autoload.php');

class Base
{

	public static function IsSeller()
	{
		if (!property_exists($_SESSION["sessao_usuario"], "cnpj")) {
			header("Location: http://localhost/tcc/app/Views/Produto/index.php");
			exit;
		}
	}


	// * @param String status -> 0 = erro, 1 = sucesso
	public static function Response(string $message, string $status)
	{
		echo json_encode(
			[
				"data" => [
					"mensagem" => $message,
				],
				"status" => $status
			]
		);
		exit;
	}
}
