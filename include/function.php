<?php 
function fstring($str){
	$str = strtolower($str);
	$pattern = "/[^a-z0-9]{6,16}$/i";
	$str = preg_replace($pattern, "", $str);
	$str = str_replace("and", "", $str);
	$str = str_replace("execute", "", $str);
	$str = str_replace("update", "", $str);
	$str = str_replace("count", "", $str);
	$str = str_replace("chr", "", $str);
	$str = str_replace("mid", "", $str);
	$str = str_replace("master", "", $str);
	$str = str_replace("truncate", "", $str);
	$str = str_replace("char", "", $str);
	$str = str_replace("declare", "", $str);
	$str = str_replace("select", "", $str);
	$str = str_replace("create", "", $str);
	$str = str_replace("delete", "", $str);
	$str = str_replace("insert", "", $str);
	$str = str_replace("'","", $str);
	$str = str_replace('"',"",$str);
	$str = str_replace(' ',"",$str);
	$str = htmlspecialchars($str);
// 	$str = substr($str, 0, 12);

	return $str;
}

function cn_fstring($str){
	if(isset($str)){
		$str = str_replace("and", "", $str);
		$str = str_replace("execute", "", $str);
		$str = str_replace("update", "", $str);
		$str = str_replace("count", "", $str);
		$str = str_replace("chr", "", $str);
		$str = str_replace("mid", "", $str);
		$str = str_replace("master", "", $str);
		$str = str_replace("truncate", "", $str);
		$str = str_replace("char", "", $str);
		$str = str_replace("declare", "", $str);
		$str = str_replace("select", "", $str);
		$str = str_replace("create", "", $str);
		$str = str_replace("delete", "", $str);
		$str = str_replace("insert", "", $str);
		$str = str_replace("'","", $str);
		$str = str_replace('"',"",$str);
		$str = htmlspecialchars($str);
	}
	return $str;
}

function string_replace($str,$len){
	if(strlen($str)>0){
		$str = str_replace(".","",$str);
		$str = str_replace("/","",$str);
		$str = substr($str, 0, $len);
	}
	return $str;
}

function general_num($length = 6){
	$min = pow( 10, ($length - 1) );
	$max = pow( 10, $length ) -1;
	return mt_rand($min,$max);
}

function showPop($meg){
	echo "<script>alert('.$meg.'); history.back();</script>";
	exit;
}

function backUrl($meg, $url){
	echo "<script>alert('.$meg.'); location.href='$url';</script>";
	exit;
}

function validateEmail($str){
	if(isset($str)){
		$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
		if(preg_match($pattern, $str)){
			return true;
		}else{
			return false;
		}
	}
}

function format_float($num){
	if(is_numeric($num)){
		if(strpos($num, ".")){
			$num = explode(".", $num);
			$nums = $num[0].".".$num[1];
			return floatval($nums);
		}
		return floatval($num);
	}else{
		return false;
	}
}

function show_back($meg){
	$html = '';
	$html .= "<!DOCTYPE html><html lang='en'>";
	$html .= "<head><meta http-equiv='content-type' charset='utf-8'>";
	$html .= "<link href='../../style/common.css' style='text/css' rel='stylesheet'>";
	$html .= "<link href='../css/admin.css' style='text/css' rel='stylesheet'>";
	$html .= "<script>setTimeout(function(){history.back()},3000);</script>";
	$html .= "</head>";
	$html .= "<body>";
	$html .= "<div class='crumbs'>";
	$html .= "<span class='blue-color'>当前位置：</span>";
	$html .= "<ul>";
	$html .= "<li><a href='javascript:void(0);' class='blue-color'>首页&nbsp;&nbsp;&gt;</a></li>";
	$html .= "<li>&nbsp;&nbsp;文章发表</li>";
	$html .= "</ul>";
	$html .= "</div>";
	$html .= "<div class='tipCenter'>";
	$html .= "<div class='head'>提示信息</div>";
	$html .= "<div class='info'>".$meg."</div>";
	$html .= "<a href='javascript:history.back();'>如果您的浏览器没有自动跳转，请点击这里</a>";
	$html .= "</div>";
	$html .= "</body>";
	$html .= "</html>";
	echo $html;
}

function show_backUrl($meg, $url){
	$html = '';
	$html .= "<!DOCTYPE html><html lang='en'>";
	$html .= "<head><meta http-equiv='content-type' charset='utf-8'>";
	$html .= "<link href='../../style/common.css' style='text/css' rel='stylesheet'>";
	$html .= "<link href='../css/admin.css' style='text/css' rel='stylesheet'>";
	$html .= "<script>setTimeout(function(){window.location.href='".$url."'},300000);</script>";
	$html .= "</head>";
	$html .= "<body>";
	$html .= "<div class='crumbs'>";
	$html .= "<span class='blue-color'>当前位置：</span>";
	$html .= "<ul>";
	$html .= "<li><a href='javascript:void(0);' class='blue-color'>首页&nbsp;&nbsp;&gt;</a></li>";
	$html .= "<li>&nbsp;&nbsp;文章发表</li>";
	$html .= "</ul>";
	$html .= "</div>";
	$html .= "<div class='tipCenter'>";
	$html .= "<div class='head'>提示信息</div>";
	$html .= "<div class='info'>".$meg."</div>";
	$html .= "<a href='javascript:void(0);' onclick=javascript:window.location.href='".$url."';>如果您的浏览器没有自动跳转，请点击这里</a>";
	$html .= "</div>";
	$html .= "</body>";
	$html .= "</html>";
	echo $html;
}

?>