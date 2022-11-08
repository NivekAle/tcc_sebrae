<?php

namespace App\Core;

require('d:/projects/php/tcc/vendor/autoload.php');

class Base
{

	public static $base_url = "http://localhost/tcc/app/";
	public static $url_imagens = "http://localhost/tcc/public/uploads/";
	// public static $url_controllers;
	public static $url_views = "http://localhost/tcc/app/Views/";
	public static $url_styles = "http://localhost/tcc/public/css/";

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
