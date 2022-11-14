<?php

namespace App\Helpers;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

interface iSession
{
	public static function CriarSessao($dados_usuario);
	public static function RemoverSessao();
	public static function VerificarSessao();
	public static function BuscarSessao($id_usuario);
}

class Session
{
	public static function CriarSessao($dados_usuario)
	{
		session_start();
		$_SESSION["sessao_usuario"] = $dados_usuario; // Model Usuario/Vendedor

		// cria um prop para o objeto Vendedor, para futuramente verificar depois;
		// if (property_exists($dados_usuario, "cnpj")) {
		// 	$_SESSION["sessao_usuario"]->vendedor = true;
		// }
	}

	public static function RemoverSessao()
	{
		session_start();
		session_destroy();
		header("Location: http://localhost/tcc/");
		exit();
	}

	public static function VerificarSessao()
	{
		session_start();
		if (empty($_SESSION["sessao_usuario"])) {
			header("Location: http://localhost/tcc/");
			exit();
		}
	}

	public static function BloquearLoginComSessao()
	{
		session_start();
		if (!empty($_SESSION["sessao_usuario"])) {
			header("Location: http://localhost/tcc/app/Views/Produtos/index.php");
			exit();
		}
		
	}
}
