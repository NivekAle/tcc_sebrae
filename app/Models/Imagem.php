<?php

namespace App\Models;

use App\Database\Database;
use PDO;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class Imagem
{
	public int $id;
	public string $caminho;
	public $id_produto;
	public $criado_em;

	public function Adicionar()
	{
		$db = new Database('imagens');
		$this->id = $db->insert(
			[
				"caminho" => $this->caminho,
				"id_produto" => $this->id_produto,
			]
		);
		return $this;
	}

	// public static function PegarTodasImagens()
	// {
	// 	return (new Database('imagens'))->select(null, null, null)->fetchAll(PDO::FETCH_CLASS, self::class);
	// }

	public static function PegarImagemProduto($id_produto)
	{
		return (new Database('imagens'))->pegarTodasAsImagensProduto($id_produto)->fetchAll(PDO::FETCH_CLASS, self::class);
	}
}
