<?php

namespace App\Helpers;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

class Upload
{
	// somente o nome, sem a extensao;
	private $nome;

	// extensao
	private $extensao;

	// tipo do arquivo
	private $type;

	private $nome_temporario;

	private $error;

	private $size;

	public function __construct($file)
	{
		$this->type = $file["type"];
		$this->nome_temporario = $file["tmp_name"];
		$this->error = $file["error"];
		$this->size = $file["size"];

		// echo '<pre>';
		// print_r($this);
		// echo '<pre>';
		// die();

		for ($i = 0; $i < count($file["name"]); $i++) {
			$info = pathinfo($file["name"][$i]);
			$this->nome = $info["filename"];
			$this->extensao = $info["extension"];
		}
	}

	public function uploadImage($dir)
	{
		// verificar erro
		if ($this->error != 0) return false;

		$path = $dir . "/" . $this->getBaseName();
		echo 'camiho completro<pre>';
		print_r($path);
		echo '<pre>';
		die();

		return true;
	}

	public function getBaseName()
	{
		$extension = strlen($this->extensao) ? '.' . $this->extensao : "";
		return $this->nome . $extension;
	}
}
