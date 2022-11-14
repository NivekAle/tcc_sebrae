<?php

namespace App\Models;

use App\Database\Database;
use PDO;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class Categoria
{
	public $id;
	public $nome;

	public static function PegarTodasCategorias($where = null, $order = null, $limit = null)
	{
		return (new Database('categorias'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
	}

	public static function PegarCategoria($id_produto)
	{
		return (new Database('categorias'))->joinCategoria($id_produto)->fetchObject(self::class);
	}
}
