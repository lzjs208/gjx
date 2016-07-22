<?php
require "../../include/config.php";

if(!isset($_SESSION["id"]) || $_SESSION["id"] == ""){
	echo "<script>top.location.href='../../';</script>";
	exit;
}

?>