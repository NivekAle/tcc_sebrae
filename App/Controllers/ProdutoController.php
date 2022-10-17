<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\Produto;

require('A:\php\tech_solution.com.br\vendor\autoload.php');

class ProdutoController
{

	public static function NovoProduto($novo_produto)
	{
		$produto = new Produto;
		$produto->nome = $novo_produto["produto_nome"];
		$produto->descricao =  $novo_produto["produto_descricao"];
		$produto->preco =  $novo_produto["produto_preco"];
		$produto->vendedor_id =  $novo_produto["vendedor_id"];

		$produto->Cadastrar();
		// var_dump($produto);
		// die();
	}


}

ProdutoController::NovoProduto($_POST["novo_produto"]);
