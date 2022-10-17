<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Models\Usuario;
use App\Models\Vendedor;
use Exception;

require('A:\php\tech_solution.com.br\vendor\autoload.php');

class LoginController
{

	// public $session = new Session;

	// private $usuario = [];

	public static function Entrar($usuario_login)
	{
		if (self::VerificarForm($usuario_login)) {
			$usuario = $usuario_login;
			$usuario_encontrado = Usuario::VerificarLogin($usuario["email"], $usuario["senha"]);


			if (!empty($usuario_encontrado)) {
				Session::CriarSessao($usuario_encontrado);

				echo json_encode(
					[
						"usuario" => [
							"nome" => $usuario_encontrado->nome,
							"sobrenome" => $usuario_encontrado->sobrenome,
							"email" => $usuario_encontrado->email,
							// "telefone" => $usuario_encontrado->telefone,
							// "cnpj" => $usuario_encontrado->cnpj
						],
						"data" => [
							"permissao" => true,
						]
					],
					true
				);
			} else {
				$vendedor_encontrado = Vendedor::VerificarLogin($usuario["email"], $usuario["senha"]);
				Session::CriarSessao($vendedor_encontrado);

				// retorna os dados do vendedor
				echo json_encode(
					[
						"usuario" => [
							"nome" => $vendedor_encontrado->nome,
							"sobrenome" => $vendedor_encontrado->sobrenome,
							"email" => $vendedor_encontrado->email,
							"telefone" => $vendedor_encontrado->telefone,
							"cnpj" => $vendedor_encontrado->cnpj
						],
						"data" => [
							"permissao" => true,
						]
					],
					true
				);
			}
		} else {
			throw new Exception("erro ao entrar no login");
			exit();
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

LoginController::Entrar($_POST["login"]);
