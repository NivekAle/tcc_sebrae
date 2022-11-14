<?php

namespace App\Controllers;

use App\Core\Base;
use App\Database;
use App\Helpers\Session;
use App\Models\Vendedor;
use Exception;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class VendedorController
{

	public static function Cadastro($novo_vendedor)
	{

		try {
			$email_encontrado = Vendedor::VerificarEmailExistente("email = '" . $novo_vendedor["email"] . "'");
			$vendedor = new Vendedor;

			if (array_key_exists("cpf", $novo_vendedor)) {
				$cpf_encontrado = Vendedor::VerificarEmailExistente("cpf = '" . $novo_vendedor["cpf"] . "'");
				if (!empty($cpf_encontrado)) {
					Base::Response("O CPF inserido ja foi cadastrado.", null, 0);
					exit;
				} else {
					$vendedor->cpf = $novo_vendedor["cpf"];
				}
			} else if (array_key_exists("cnpj", $novo_vendedor)) {
				$cnpj_encontrado = Vendedor::VerificarEmailExistente("cnpj = '" . $novo_vendedor["cnpj"] . "'");
				if (!empty($cnpj_encontrado)) {
					Base::Response("O CNPJ inserido ja foi cadastrado.", null, 0);
					exit;
				} else {
					$vendedor->cnpj = $novo_vendedor["cnpj"];
				}
			}
			if ($email_encontrado or !empty($email_encontrado)) {
				Base::Response("O email informado já foi cadastrado", null, 0);
				exit;
			} else {
				$vendedor->nome_completo = $novo_vendedor["nome"];
				$vendedor->email = $novo_vendedor["email"];
				$vendedor->cidade = $novo_vendedor["cidade"];
				$vendedor->estado = $novo_vendedor["estado"];
				$vendedor->pais = $novo_vendedor["pais"];
				$vendedor->senha = $novo_vendedor["senha"];
				// cpf e cnpj inseridos la em cima

				$vendedor->Inserir();
				Base::Response("", null, 1);
			}
		} catch (Exception $th) {
			Base::Response("Erro ao realizar o cadastro, por favor tente novamnte mais tarde", null, 0);
			exit;
			// throw $th;
		}
	}
}

switch ($_POST) {
	case isset($_POST["novo-vendedor"]):
		VendedorController::Cadastro($_POST["novo-vendedor"]);
		break;
	default:
		header("Location: http://localhost/tcc/");
		break;
}
