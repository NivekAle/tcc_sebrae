<?php

namespace App\Controllers;

use App\Core\Base;
use App\Database\Database;
use App\Helpers\Session;
use App\Models\Usuario;
use Exception;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class UsuarioController
{

	public static function Cadastrar($novo_usuario)
	{
		try {
			$condicao_email_iguais = " email = '" . $novo_usuario["email"] . "'";
			$condicao_telefone_iguais = " telefone = '" . $novo_usuario["telefone"] . "'";
			$email_existente = (new Database("Usuarios"))->select($condicao_email_iguais)->fetchObject(Usuario::class);
			$telefone_existente = (new Database("Usuarios"))->select($condicao_telefone_iguais)->fetchObject(Usuario::class);

			if ($email_existente) {
				Base::Response("Atenção, o email já está registrado!", null, 0);
				exit;
			} else if ($telefone_existente) {
				Base::Response("Atenção, o telefone já está registrado!", null, 0);
				exit;
			} else {

				$usuario = new Usuario;

				$usuario->nome_completo = $novo_usuario["nome"];
				$usuario->cpf = $novo_usuario["cpf"];
				$usuario->data_nascimento = $novo_usuario["data_nascimento"];
				$usuario->email = $novo_usuario["email"];
				$usuario->telefone = $novo_usuario["telefone"];
				$usuario->cidade = $novo_usuario["cidade"];
				$usuario->estado = $novo_usuario["estado"];
				$usuario->pais = $novo_usuario["pais"];
				$usuario->senha = $novo_usuario["senha"];

				$usuario->Cadastrar();

				if ($usuario instanceof Usuario) {
					// Session::CriarSessao($usuario);
					Base::Response("Cadastro realizado com sucesso.!", null, 1);
				} else {
					Base::Response("Atenção, Houve um erro ao fazer o cadastro, tente novamente mais tarde.", null, 0);
				}
			}
		} catch (Exception $th) {
			Base::Response("Atenção, Houve um erro ao fazer o cadastro, tente novamente mais tarde.", null, 0);
		}
	}

	public static function Editar($usuario_editado)
	{
		try {

			if (!empty($usuario_editado)) {
				$usuario_db = new Usuario();

				$usuario_db->id = $usuario_editado["id"];
				$usuario_db->nome_completo = $usuario_editado["nome"];
				$usuario_db->cpf = $usuario_editado["cpf"];
				$usuario_db->data_nascimento = $usuario_editado["data_nascimento"];
				$usuario_db->email = $usuario_editado["email"];
				$usuario_db->telefone = $usuario_editado["telefone"];
				$usuario_db->cidade = $usuario_editado["cidade"];
				$usuario_db->estado = $usuario_editado["estado"];
				$usuario_db->pais = $usuario_editado["pais"];

				if ($usuario_db->Editar()) {
					Base::Response("Atenção, alterações salvar com sucesso, desloge para ver as alterações", null, 0);
				}
			} else {
				throw new Exception("Erro ao salvar as alterações, tente novamente mais tarde");
			}
		} catch (Exception $error) {
			Base::Response($error->getMessage(), null, 0);
		}
	}
}


switch ($_POST) {
	case isset($_POST["usuario-cadastro"]):
		UsuarioController::Cadastrar($_POST["usuario-cadastro"]);
		break;
	case isset($_POST["usuario-editado"]):
		UsuarioController::Editar($_POST["usuario-editado"]);
		break;
	default:
		header("Location: http://localhost/tcc/");
		break;
}
