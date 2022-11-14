<?php

namespace App;

use App\Helpers\Session;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

Session::RemoverSessao();
