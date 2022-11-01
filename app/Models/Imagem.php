<?php

namespace App\Models;

use App\Database\Database;
use PDO;

require('d:/projects/php/tcc/vendor/autoload.php');

class Imagem
{
	public int $id;
	public string $caminho;
	public int $id_produto;
	public $criado_em;
}
