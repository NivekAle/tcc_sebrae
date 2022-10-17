<?php

namespace App\Models;

require('A:\php\tech_solution.com.br\vendor\autoload.php');

abstract class Pessoa
{
	public $id;
	public $nome;
	public $sobrenome;
	public $email;
	public $senha;
	public $endereco;
	public $telefone;
	public $data_nascimento;
	public $criado_em;
}
