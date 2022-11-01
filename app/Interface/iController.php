<?php

interface iController
{
	public function Response();
	public function Require();
	public function Console(string $descricao, int $status);
}

class Controller implements iController
{
	public function Response()
	{
	}
	public function Require()
	{
	}

	public function Console(string $descricao, int $status = 1)
	{
	}
}
