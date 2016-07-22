<?php
require "../../include/config.php";

if(!isset($_SESSION["id"]) || $_SESSION["id"] ==""){
	$html = false;
}else{
	$html = "<h4>".$_SESSION["username"]."</h4>";
	$html .= "<div class='form-input form-logined'>";
	$html .= "<p><a href='member/'>提现</a></p>";
	$html .= "<p><a href='member/'>充值</a></p>";
	$html .= "<p><a href='member/'>交易</a></p>";
	$html .= "<p><a href='member/login/logout.php'>退出</a></p>";
	$html .= "<span class='blank'></span>";
	$html .= "<div class='sigin-line'></div>";
	$html .= "<div class='sigin-tips'><img src='images/ico-money.png' width='23' height='22'>GX-Coin 安全防护，多重验证保护交易安全 </div>";
	$html .= "</div>";
}

echo $html;
?>