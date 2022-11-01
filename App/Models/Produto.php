<?php

namespace App\Models;

use App\Database\Database;
use PDO;

require('d:/projects/php/tcc/vendor/autoload.php');

class Produto
{
	// public $id;
	// public $nome;
	// public $descricao;
	// public $preco;
	// public $likes;
	// public $ativo;
	// public $avaliacao;
	// public $id_vendedor;
	// public $criado_em;

	public $id;
	public $nome;
	public $descricao;
	public $preco;
	public $likes;
	public $status;
	public $criado_em;
	public $id_vendedor;
	public $id_categoria;

	public static function PegarProdutos($where = null, $order = null, $limit = null)
	{
		return (new Database('produtos'))->select("status = 1", $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
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

	// pegar um unico produto
	public static function PegarProduto($produto_url_id)
	{
		return (new Database('produtos'))->select("id = $produto_url_id")->fetchObject(self::class);
	}


	// pegar um unico vendedor pelo i
	public static function PegarProdutosVendedor($id_vendedor)
	{
		return (new Database('produtos'))->select("id_vendedor = $id_vendedor")->fetchAll(PDO::FETCH_CLASS, self::class);
	}
}
