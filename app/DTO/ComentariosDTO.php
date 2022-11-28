<?php

namespace App\DTO;

use App\Database\Database;
use PDO;

class ComentariosDTO {

	public $id_produto;
	public $criado_em;
	public $conteudo;
	public $nome_completo;

	public static function Get($id_produto)
	{
		return (new Database('comentarios'))->pegarComentarios($id_produto)->fetchAll(PDO::FETCH_CLASS, self::class);
	}
}
