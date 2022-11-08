<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\Comentarios;
use App\Models\Produto;

require("d:/projects/php/tcc/vendor/autoload.php");

class ComentarioContrller
{

	public static function PublicarComentario($novo_comentario)
	{
		$db = new Database("comentarios");
		$db->insert(
			[
				"conteudo" => $novo_comentario["conteudo"],
				"id_produto" => $novo_comentario["id_produto"],
				"id_usuario" => $novo_comentario["id_usuario"],
			]
		);
	}
}

ComentarioContrller::PublicarComentario($_POST["novo-comentario"]);
