<?php

namespace App\Controllers;

use App\Core\Base;
use App\Helpers\Session;
use App\Models\Usuario;
use App\Models\Vendedor;
use Exception;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class LoginController
{

	// public $session = new Session;

	// public Usuario $usuario;

	public static function EntrarUsuario($usuario_login)
	{
		if (self::VerificarForm($usuario_login)) {

			$usuario = $usuario_login;
			$usuario_encontrado =  Usuario::VerificarLogin($usuario["email"], $usuario["senha"]);

			if (!empty($usuario_encontrado)) {
				Session::CriarSessao($usuario_encontrado);
				echo json_encode(
					[
						"usuario" => [
							"nome" => $usuario_encontrado->nome_completo,
							"email" => $usuario_encontrado->email,
							"cpf" => $usuario_encontrado->cpf,
						],
						"data" => [
							"permissao" => true,
						]
					],
					true
				);
			} else {
				Base::Response("login ou senha incorretos!", null, 0);
			}
		} else {
			Base::Response("Houve um erro ao fazer login, tente novamente mais tarde.", null, 0);
		}
	}

	public static function EntrarVendedor($vendedor_login)
	{
		if (self::VerificarForm($vendedor_login)) {

			$vendedor = $vendedor_login;
			$vendedor_encontrado =  Vendedor::VerificarLogin($vendedor["email"], $vendedor["senha"]);

			if (!empty($vendedor_encontrado)) {
				Session::CriarSessao($vendedor_encontrado);
				echo json_encode(
					[
						"vendedor" => [
							"nome" => $vendedor_encontrado->nome_completo,
							"email" => $vendedor_encontrado->email,
							"cpf" => $vendedor_encontrado->cpf,
							"cnpj" => $vendedor_encontrado->cnpj,
						],
						"data" => [
							"permissao" => true,
						]
					],
					true
				);
			} else {
				Base::Response("login ou senha incorretos!", null, 0);
			}
		} else {
			Base::Response("Houve um erro ao fazer login, tente novamente mais tarde.", null, 0);
		}
	}


	private static function VerificarForm($data)
	{
		if (!empty($data["email"]) or $data["senha"] or !is_array($data)) {
			return true;
		} else {
			return false;
		}
	}
}

// verificando as requisicoes [POST]


switch ($_POST) {
	case isset($_POST["login_usuario"]):
		LoginController::EntrarUsuario($_POST["login_usuario"]);
		break;
	case isset($_POST["login_vendedor"]):
		LoginController::EntrarVendedor($_POST["login_vendedor"]);
		break;
	default:
		header("Location: http://localhost/tcc/");
		break;
}
