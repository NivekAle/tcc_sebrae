<?php

namespace App\Models;

use App\Database\Database;
use PDO;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

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

	public static function PegarSomenteVendedor($id_vendedor) {
		return (new Database('vendedores'))->select("id = '$id_vendedor'")->fetchObject(self::class);
	}

	// pegar dados do vendedor apartir do id_produto
	public static function PegarVendedor($produto_id)
	{
		return (new Database('vendedores'))->join($produto_id)->fetchObject(self::class);
	}

	// Inserir novo vendedor
	public function Inserir()
	{
		$db = new Database('vendedores');
		$this->id = $db->insert(
			[
				"nome_completo" => $this->nome_completo,
				"email" => $this->email,
				"cidade" => $this->cidade,
				"estado" => $this->estado,
				"pais" => $this->pais,
				"senha" => $this->senha,
				"cpf" => $this->cpf,
				"cnpj" => $this->cnpj,
			]
		);
		return $this;
	}

	public static function VerificarEmailExistente($email)
	{
		return (new Database('vendedores'))->select("$email")->fetchObject(self::class);
	}
}
