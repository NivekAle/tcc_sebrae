<?php

namespace App\DTO;

use App\Database\Database;
use PDO;

require('d:/projects/php/tcc/vendor/autoload.php');

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
}
