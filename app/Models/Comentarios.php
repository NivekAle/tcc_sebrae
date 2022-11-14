<?php

namespace App\Models;

use App\Database\Database;
use App\Models\Usuario;
use PDO;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class Comentarios
{
	public $id;
	public $conteudo;
	public $criado_em;
	public $id_produto;
	public $id_usuario;

	public static function PegarComentariosProduto($id_produto)
	{
		return (new Database('comentarios'))->pegarComentarios($id_produto)->fetchAll();
	}
}
