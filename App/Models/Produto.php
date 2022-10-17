<?php

namespace App\Models;

use App\Database\Database;
use PDO;

require('A:\php\tech_solution.com.br\vendor\autoload.php');

class Produto
{
	public $id;
	public $nome;
	public $descricao;
	public $vendedor_id;
	public $preco;
	public $likes;
	public $em_estoque;
	public $criado_em;

	public static function PegarProdutos($where = null, $order = null, $limit = null)
	{
		return (new Database('produtos'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
	}

	public function Cadastrar()
	{
		$db = new Database('produtos');
		$db->insert(
			[
				"nome" => $this->nome,
				"descricao" => $this->descricao,
				"preco" => $this->preco,
				"vendedor_id" => $this->vendedor_id,
			]
		);
	}

	public static function PegarProduto($produto_url_id) {
		return (new Database('produtos'))->select("id = $produto_url_id")->fetchObject(self::class);
	}
}
