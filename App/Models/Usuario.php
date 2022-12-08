<?php

namespace App\Models;

use App\Database\Database;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class Usuario
{
	public $id;
	public $nome_completo;
	public $email;
	public $senha;
	public $cpf;
	public $data_nascimento;
	public $cidade;
	public $estado;
	public $pais;
	public $telefone;
	public $criado_em;

	public static function VerificarLogin($email, $senha)
	{
		return (new Database('usuarios'))->select("email = '$email' and senha = '$senha'")->fetchObject(self::class);
	}

	public function Cadastrar()
	{
		$db = new Database('Usuarios');
		$this->id = $db->insert(
			[
				"nome_completo" => $this->nome_completo,
				"email" => $this->email,
				"senha" => $this->senha,
				"cpf" => $this->cpf,
				"data_nascimento" => $this->data_nascimento,
				"cidade" => $this->cidade,
				"estado" => $this->estado,
				"pais" => $this->pais,
				"telefone" => $this->telefone,
			]
		);
		return $this;
	}

	public function Editar()
	{
		return (new Database('Usuarios'))->update(" id = '" . $this->id . "'",
			[
				"nome_completo" => $this->nome_completo,
				"email" => $this->email,
				"senha" => $this->senha,
				"cpf" => $this->cpf,
				"data_nascimento" => $this->data_nascimento,
				"cidade" => $this->cidade,
				"estado" => $this->estado,
				"pais" => $this->pais,
				"telefone" => $this->telefone,
			]
		);
	}
}

// ERRO : nao reconhece o campo estado.