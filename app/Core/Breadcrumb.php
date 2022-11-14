<?php

namespace App\Core;

use App\Core\Base;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);
// include_once("../Core/Base.php");

class Breadcrumb
{
	public static function  Generate($d)
	{
		$links = array_keys($d);
		$titles = array_values($d);

		$html = "<ul class='breadcrumb'>";
		$html .= "<li><a href='" . (new Base)::$url_views ."'>Home</a></li>";
		for ($i = 0; $i < count($d); $i++) {
			$html .= "<li><a href='";
			$html .= (new Base)::$url_views . $d[$i]["link"];
			$html .= "'>" . $d[$i]["title"] . "</a></li>";
		}
		$html .= "</ul>";
		return $html;
	}
}

//  echo Breadcrumb::Generate(
// 	[
// 		[
// 			"title" => "Produtos",
// 			"link" => "Produtos/index.php"
// 		],
// 		[
// 			"title" => "Painel",
// 			"link" => "painel"
// 		],
// 		[
// 			"title" => "dasdas",
// 			"link" => "/painel"
// 		]
// 	]
// );
