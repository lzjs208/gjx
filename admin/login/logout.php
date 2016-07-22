<?php
include "../inc/config.php";

unset($_SESSION["admid"]);
unset($_SESSION["admuser"]);

session_destroy();

header("Location:/admin");

?>