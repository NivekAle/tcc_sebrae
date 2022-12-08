<?php

use App\Core\Base;

$ROOT_DIR =  $_SERVER["DOCUMENT_ROOT"] . "tcc/vendor/autoload.php";

require($ROOT_DIR);

?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo Base::$url_imagens . "../images/favicon.min.png" ?>">
<link rel="stylesheet" href="<?php echo Base::$url_styles . "all.min.css" ?>">
<link rel="stylesheet" href="<?php echo Base::$url_styles . "bootstrap.min.css" ?>">
<link rel="stylesheet" href="<?php echo Base::$url_styles . "style.css" ?>">
<link rel="stylesheet" href="<?php echo Base::$url_styles . "swiper-bundle.css" ?>">