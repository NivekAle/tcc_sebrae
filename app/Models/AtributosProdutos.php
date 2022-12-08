<?php

namespace App\Models;

use App\Database\Database;
use PDO;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class AtributosProdutos
{
	public $id;
	public $nome;
	public $valor;
	public $criado_em;
	public $id_produto;


	public function Cadastrar()
	{
		$db = new Database("atributos_produtos");
		$this->id = $db->insert(
			[
				"nome" => $this->nome,
				"valor" => $this->valor,
				"id_produto" => $this->id_produto
			]
		);
		return $this;
	}

	public function VerificarDuplicidade($nome_attr)
	{
		return (new Database("atributos_produtos"))->select(" nome = '$nome_attr' ")->fetchObject(self::class);
	}

	public static function PegarAtributos($id_produto) {
		return (new Database("atributos_produtos"))->select(" id_produto = '$id_produto' ")->fetchAll(PDO::FETCH_CLASS, self::class);
	}
}
