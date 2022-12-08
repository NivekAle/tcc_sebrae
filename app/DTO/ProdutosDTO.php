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
	public $descricao; // produto descrição
	public $preco; // produto preco
	public $likes; // produto likes
	public $id_categoria; // categoria
	public $caminho; // imagem caminho

	// usar na home
	public static function PegarTodosProdutos()
	{
		return (new Database("produtos"))->pegarProdutos()->fetchAll(PDO::FETCH_CLASS, self::class);
	}

	public static function ProdutosVendedor($id_vendedor)
	{
		return (new Database("produtos"))->produtosVendedor($id_vendedor)->fetchAll(PDO::FETCH_CLASS, self::class);
	}

	public static function PegarProduto($id_produto)
	{
		return (new Database("produtos"))->PegarUnicoProduto($id_produto)->fetchObject(self::class);
	}

	public static function PegarProdutosPorCategoria($nome_categoria)
	{
		return (new Database("categoria"))->ProdutosPorCategoria($nome_categoria)->fetchAll(PDO::FETCH_CLASS, self::class);
	}

	// usar no swiper
	public static function ProdutosLimite($nome_categoria, $limit)
	{
		return (new Database("produtos"))->QueryFiltrarPorCategoria($nome_categoria, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
	}

	public function EditarProdutoDB($id_produto)
	{
		return (new Database("produtos"))->update(
			" id = '$id_produto' ",
			[
				"nome" => $this->nome,
				"descricao" => $this->descricao,
				"preco" => $this->preco,
				"id_categoria" => $this->id_categoria,
			]
		);
	}
}
