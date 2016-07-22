<?php
include "../../include/config.php";

// session_unset();
unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_SESSION["manlevel"]);
session_destroy();

header("Location:/");
?>