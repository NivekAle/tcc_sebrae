<?php

namespace App\DTO;

use App\Database\Database;
use PDO;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class ProdutosDTO
{


	public $id;
	public $nome_completo; // vendedor nome
	public $nome; // produto nome
	public $preco; // produto preco
	public $likes; // produto likes
	public $caminho; // imagem caminho

	public static function PegarTodosProdutos()
	{
		return (new Database("produtos"))->pegarProdutos()->fetchAll(PDO::FETCH_CLASS, self::class);
	}

	public static function ProdutosVendedor($id_vendedor)
	{
		return (new Database("produtos"))->produtosVendedor($id_vendedor)->fetchAll(PDO::FETCH_CLASS, self::class);
	}

	public static function PegarProduto($id_produto) {
		return (new Database("produtos"))->PegarUnicoProduto($id_produto)->fetchObject(self::class);
	}
}
