<?php

namespace App\Database;

use \PDO;
use PDOException;

require('A:\php\school\vendor\autoload.php');

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

		// echo print_r(array_values($data));
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
		$query = "SELECT vendedores.nome,
		vendedores.sobrenome,
		vendedores.email,
			vendedores.telefone FROM `vendedores` join `produtos` on `produtos`.`vendedor_id` = `vendedores`.`id` where `produtos`.`id` = $id";
		return $this->Execute($query);
	}
}
