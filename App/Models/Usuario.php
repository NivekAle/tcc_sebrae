<?php

namespace App\Models;

use App\Database\Database;

require('A:\php\tech_solution.com.br\vendor\autoload.php');

class Usuario
{

	public $id;
	public $nome;
	public $sobrenome;
	public $email;
	public $senha;
	public $endereco;
	public $data_nascimento;
	public $criado_em;

	public static function VerificarLogin($email, $senha)
	{
		return (new Database('usuarios'))->select("email = '$email' and senha = '$senha'")->fetchObject(self::class);
	}
}
