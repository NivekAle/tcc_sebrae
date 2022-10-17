<?php

namespace App\Models;

use App\Database\Database;
use App\Models\Pessoa;
use PDO;

require('A:\php\tech_solution.com.br\vendor\autoload.php');

class Vendedor
{
	public $id;
	public $nome;
	public $sobrenome;
	public $email;
	public $senha;
	public $endereco;
	public $telefone;
	public $data_nascimento;
	public $criado_em;
	public $cnpj;
	public $descricao;
	public $cidade;
	public $pais;
	public $estado;

	public static function VerificarLogin($email, $senha)
	{
		return (new Database('vendedores'))->select("email = '$email' and senha = '$senha'")->fetchObject(self::class);
	}

	public static function PegarVendedor($produto_id)
	{
		return (new Database('vendedores'))->join($produto_id)->fetchObject(self::class);
	}
}
