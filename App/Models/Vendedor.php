<?php

namespace App\Models;

use App\Database\Database;
use PDO;

require('d:/projects/php/tcc/vendor/autoload.php');

class Vendedor
{
	// 29/10/22
	public $id;
	public $nome_completo;
	public $email;
	public $senha;
	public $cpf;
	public $cnpj;
	public $cidade;
	public $pais;
	public $estado;
	public $criado_em;

  // verificar credenciais do vendedor;
	public static function VerificarLogin($email, $senha)
	{
		return (new Database('vendedores'))->select("email = '$email' and senha = '$senha'")->fetchObject(self::class);
	}


	// pegar dados do vendedor apartir do id_produto
	public static function PegarVendedor($produto_id)
	{
		return (new Database('vendedores'))->join($produto_id)->fetchObject(self::class);
	}
}
