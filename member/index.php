<?php
require "../include/config.php";
require "../include/mysql.class.php";

$args = getArgs();

$argCny = "0.00000000"; $argBtc = "0.00000000"; $argLtc = "0.00000000"; $argGc = "0.00000000";

foreach($args as $v){
	if($v->argtype==1){
		$argCny = $v->val;
	}else if($v->argtype==2){
		$argBtc = $v->val;
	}else if($v->argtype==3){
		$argLtc = $v->val;
	}else if($v->argtype==4){
		$argGc = $v->val;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1, user-scalable=no">
<link rel="stylesheet" href="../plugins/bootstrap-3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="../style/common.css">
<link rel="stylesheet" href="css/common.css">
<title>天合G值交易中心</title>
</head>
<body>

<div class="wrap" id="container">
	<!--left start-->
	<div class="left" id="left">
		<div class="logo">
			<!--<img src="images/logo_02.png">-->
			<span>天合积分交易中心</span>
		</div>
		<div class="man_main">
			<img src="images/yonghutoux_03.png">
			<div>
    	  <p><?php echo $_SESSION["username"] ?></p>
      	<p>Level<?php echo $_SESSION["manlevel"] ?></p>
			</div>
		</div>
		<div class="menu-item menu-item-active" href="personal/" aria-controls="sour" role="tab" data-toggle="tab" target="iframepage"><span class="p">个人中心</span><em></em></div>
		<div class="menu-item" href="safety" aria-controls="sour" role="tab" data-toggle="tab" target="iframepage"><span class="s">安全中心</span><em></em></div>
		<div class="menu-item" href="trade" aria-controls="sour" role="tab" data-toggle="tab" target="iframepage"><span class="t">交易</span><em></em></div>
		<div class="menu-item" href="cash" aria-controls="sour" role="tab" data-toggle="tab" target="iframepage"><span class="c">提现</span><em></em></div>
		<div class="menu-item" href="pay" aria-controls="sour" role="tab" data-toggle="tab" target="iframepage"><span class="r">充值</span><em></em></div>
		<div class="menu-item" href="coin" aria-controls="sour" role="tab" data-toggle="tab" target="iframepage"><span class="a">提现地址</span><em></em></div>
		<div class="menu-item" href="javascript:void(0);" onclick="location.href='../index.html';" aria-controls="sour" role="tab" data-toggle="tab"><span class="h">返回首页</span><em></em></div>
		<div class="menu-item menu-logout" href="javascript:void(0);" aria-controls="sour" role="tab" data-toggle="tab" target="iframepage"><span class="e">退出</span><em></em></div>
	</div>
	<!--left end-->
	<!--right start-->
	<div class="right" style="width:calc(100% - 230px); height:100%;">
		<div class="rate-panel">
			<div>CNY：
				<i class="rise"></i>
				<span class="color-rise"><?php echo $argCny ?>&nbsp;&nbsp;&nbsp;7.11%</span>
			</div>		
			<div>BTC：
				<i class="rise"></i>
				<span class="color-rise"><?php echo $argBtc ?>&nbsp;&nbsp;&nbsp;7.11%</span>
			</div>	
			<div>LTC：
				<i class="rise"></i>
				<span class="color-rise"><?php echo $argLtc ?>&nbsp;&nbsp;&nbsp;7.11%</span>
			</div>
		</div>
		<div id="right" class="right-main">
			<iframe class="iframe-right" src="personal/index.php" width="100%" height="100%" marginheight="0" marginwidth="0" frameborder="0" scrolling="yes" id="iframepage" name="iframepage"></iframe>
		</div>
	</div>
	<!--right end-->
</div>

<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../plugins/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<script src="../plugins/layer/layer.js"></script>
<script src="../js/jquery.menu.js"></script>
</body>
</html>