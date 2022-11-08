<?php

namespace App\Models;

use App\Database\Database;
use App\Models\Usuario;
use PDO;

require('d:/projects/php/tcc/vendor/autoload.php');

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
