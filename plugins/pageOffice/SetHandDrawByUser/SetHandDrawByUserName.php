<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$userName=$_REQUEST["userName"];

    if (strcasecmp($userName,"zhangsan")==0) $userName = "张三";
    if (strcasecmp($userName,"lisi")==0) $userName = "李四";
    if (strcasecmp($userName,"wangwu")==0) $userName = "王五";
	$PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
	$PageOfficeCtrl->addCustomToolButton("领导圈阅", "StartHandDraw", 3);
	$PageOfficeCtrl->addCustomToolButton("全屏/还原", "IsFullScreen", 4);
    $PageOfficeCtrl->setJsFunction_AfterDocumentOpened("ShowByUserName");
    $PageOfficeCtrl->setSaveFilePage("SaveFile.php");
		
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, $userName);//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title></title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">
				<div class="flow4">
					<a href="Default.php"> 返回登录页</a>
					<span style=""> </span><strong>当前用户：</strong>
					<span style="color: Red;"><?php echo $userName;?></span>
				</div>

				<script type="text/javascript">
	                //保存页面
	                function Save() {
	                    document.getElementById("PageOfficeCtrl1").WebSave();
	                }
	
	                //领导圈阅签字
	                function StartHandDraw() {
	                    document.getElementById("PageOfficeCtrl1").HandDraw.Start();
	                }
	                
	                /*
	                //分层显示手写批注
	                function ShowHandDrawDispBar() {
	                    document.getElementById("PageOfficeCtrl1").HandDraw.ShowLayerBar(); ;
	                }*/
	
	                //全屏/还原
	                function IsFullScreen() {
	                    document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
	                }
	
	                //显示/隐藏用户的手写批注
	                function ShowByUserName() {
	                    var userName = "<?php echo $userName;?>"; //从后台获取登录用户名
	                    document.getElementById("PageOfficeCtrl1").HandDraw.ShowByUserName(null, false); // 隐藏所有的手写
	                    document.getElementById("PageOfficeCtrl1").HandDraw.ShowByUserName(userName); // 显示Tom的手写，第二个参数为true时可省略
	                }
	
	            </script>

				<!--**************   卓正 PageOffice组件 ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>

	</body>
</html>