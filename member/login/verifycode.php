<?php
include "../../include/config.php";
include "../../include/validateCode.class.php";

$code = new ValidateCode(89, 36, 4);
$font = "../../include/font/".mt_rand(1, 6).".ttf";
$code->showImage($font);
$_SESSION["code"] = $code->getCheckCode();

?>