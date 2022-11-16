<?php

namespace App\Database;

use \PDO;
use PDOException;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);
// $ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class Database
{

	const HOST = "localhost";
	const NAME = "tech_solutions";
	const DB_USER = "root";
	const DB_PS = "";

	private $table;

	private $connection;

	public function __construct($table = null)
	{
		$this->table = $table;
		$this->SetConnection();
	}

	private function SetConnection()
	{
		try {
			$this->connection = new PDO("mysql:host=localhost;dbname=tech_solutions;", "root", "");
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $erro) {
			die("Error" . $erro->getMessage());
		}
	}

	// metodos responsavel por executar a query do banco de dados
	public function Execute($query, $params = [])
	{
		try {
			$statement = $this->connection->prepare($query);
			$statement->execute($params);
			return $statement;
		} catch (PDOException $ex) {
			die('ERROR : ' . $ex->getMessage());
		}
	}

	public function insert($data)
	{
		$fields = array_keys($data);
		$binds = array_pad([], count($data), '?');

		$query = 'INSERT INTO tech_solutions.' . $this->table . ' (' . implode(',', $fields) . ') values (' . implode(',', $binds) . ')';

		// echo print_r($query);
		// executa o insert;
		$this->Execute($query, array_values($data));

		return $this->connection->lastInsertId();
	}

	public function select($where = null, $order = null, $limit = null, $fields = '*')
	{
		// dados da query;
		$where = strlen($where) ? ' WHERE ' . $where : '';
		$order = strlen($order) ? ' ORDER BY ' . $order : '';
		$limit = strlen($limit) ? ' LIMIT ' . $limit : '';

		$query = 'SELECT ' . $fields . ' FROM tech_solutions.' . $this->table  . $where . $order . $limit;

		// echo $query;
		// die();
		return $this->Execute($query);
	}

	public function update($where, $values)
	{
		//dados da query
		$fields = array_keys($values);

		$query = "UPDATE tech_solutions." . $this->table . " SET " . implode('=?,', $fields) . "=? WHERE  " . $where;

		$this->Execute($query, array_values($values));
		return true;
	}

	public function delete($where)
	{
		$query = "DELETE FROM tech_solutions." . $this->table . " WHERE " . $where;

		$this->Execute($query);

		return true;
	}

	public function join($id)
	{
		// $fields = ""

		$query = "SELECT vendedores.nome_completo,
		vendedores.email,vendedores.pais FROM `vendedores` join `produtos` on `produtos`.`id_vendedor` = `vendedores`.`id` where `produtos`.`id` = $id";

		// echo $query;
		// die();
		return $this->Execute($query);
	}

	public function joinCategoria($id)
	{
		// $fields = ""

		$query = "SELECT Categorias.nome,Categorias.id FROM `Produtos` join `Categorias` on `Categorias`.`id` = `Produtos`.`id_categoria` where `produtos`.`id` = $id";

		// echo $query;
		// die();
		return $this->Execute($query);
	}

	public function pegarComentarios($id_produto)
	{
		$query = "SELECT `Comentarios`.`criado_em`, `Comentarios`.`conteudo`, `Usuarios`.`nome_completo` ";
		$query .= " FROM " .  $this->table . " JOIN Produtos ON Produtos.id = Comentarios.id_produto JOIN Usuarios ON Usuarios.id = Comentarios.id_usuario WHERE Produtos.id = $id_produto";
		// echo $query;
		// die();
		return $this->Execute($query);
	}

	public function pegarTodasAsImagensProduto($id_produto)
	{
		$query = "SELECT Imagens.id, Imagens.caminho, Imagens.id_produto from Imagens JOIN Produtos on Produtos.id = Imagens.id_produto WHERE Produtos.id = $id_produto";
		return $this->Execute($query);
	}

	public function produtosVendedor($id_vendedor)
	{
		$query = "SELECT Produtos.id, Vendedores.nome_completo , Produtos.nome, Produtos.preco, Produtos.likes, Produtos.status ,Imagens.caminho
		FROM Produtos JOIN Imagens ON Produtos.id = Imagens.id_produto JOIN Vendedores ON Produtos.id_vendedor = Vendedores.id WHERE Produtos.id_vendedor = $id_vendedor GROUP BY Imagens.id_produto";

		return $this->Execute($query);
	}

	public function pegarProdutos()
	{
		$query = "SELECT Produtos.id, Vendedores.nome_completo , Produtos.nome, Produtos.preco, Produtos.likes, Imagens.caminho FROM Produtos JOIN Imagens ON Produtos.id = Imagens.id_produto JOIN Vendedores ON Produtos.id_vendedor = Vendedores.id GROUP BY Imagens.id_produto;";

		return $this->Execute($query);
	}

	public function PegarUnicoProduto($id_produto)
	{
		$query = "SELECT Produtos.id, Vendedores.nome_completo , Produtos.nome, Produtos.preco, Produtos.likes, Imagens.caminho
		FROM Produtos JOIN Imagens ON Produtos.id = Imagens.id_produto JOIN Vendedores ON Produtos.id_vendedor = Vendedores.id WHERE Produtos.id = $id_produto GROUP BY Imagens.id_produto;";

		return $this->Execute($query);
	}
}
