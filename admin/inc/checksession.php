<?php
require "../inc/config.php";

 if(!isset($_SESSION["admid"]) || $_SESSION["admid"] == ""){
 	echo "<script>top.location.href='../../admin';</script>";
 	exit;
 }

?>