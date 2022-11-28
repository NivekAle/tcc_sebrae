<?php

namespace App\Controllers;

use App\Core\Base;
use App\Database\Database;
use App\DTO\ComentariosDTO;
use App\Models\Comentarios;
use App\Models\Produto;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class ComentarioContrller
{

	public static function PegarComentarios($id_produto)
	{
		$comentarios = ComentariosDTO::Get($id_produto);

		Base::Response("", $comentarios, 1);
	}

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

		Base::Response("Publicado com sucesso", null, 1);
	}
}

if (!empty($_POST)) {
	switch ($_POST) {
		case isset($_POST["novo-comentario"]):
			ComentarioContrller::PublicarComentario($_POST["novo-comentario"]);
			break;
	}
} else {
	switch ($_GET) {
		case isset($_GET["get_id"]):
			ComentarioContrller::PegarComentarios($_GET["get_id"]);
			break;
	}
}
