<?php 
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	
	$sID = $_REQUEST["id"];
	$fileName = "";
	if ( !isset($sID) || empty($sID) || strlen(trim($sID))==0) {
		echo "<script>alert('为获得文件ID号！');location.href='index.php'</script>";
	}

	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);  
   
	$query = "select * from excel where id = " . $sID;
	$rs = $conn->Execute($query);  
	
	if (!$rs->EOF) {
		$fileName = $rs->Fields["FileName"]->value;
	}

	$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
	$file = new Java("java.io.File", $filepath."\\doc\\".$fileName);
	if ( java_values($file->exists()) > 0) {
	
	}else{
		echo "<script>alert('该文件不存在！');location.href='index.php'</script>";
	} 
			
	//******************************卓正PageOffice组件的使用*******************************	
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	$workbook->setDisableSheetDoubleClick(true);//禁止双击单元格
	$workbook->setDisableSheetRightClick(true);//禁止右击单元格
	$PageOfficeCtrl->setWriter($workbook);
	
	$PageOfficeCtrl->setSaveFilePage("savefile.php?id=".$sID);
	
	//添加自定义工具栏
	$PageOfficeCtrl->addCustomToolButton("另存为","saveAs()",1);
	$PageOfficeCtrl->addCustomToolButton("打印设置","setPrint()",6);
	$PageOfficeCtrl->addCustomToolButton("全屏/还原","setFullScreen()",4);
		
	$PageOfficeCtrl->setMenubar(false);//隐藏自定义菜单栏
	$PageOfficeCtrl->setOfficeToolbars(false);//隐藏Office工具栏

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->xlsReadOnly, "somebody");//此行必须
	
	//************************PageOffice组件的使用*****************************
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!--[if lte IE 6]>
<script type="text/javascript" src="js/belatedPNG.js"></script>
<script type="text/javascript">
  DD_belatedPNG.fix('.png_bg,.png_bg a:hover,img,li');
</script>
<![endif]-->
		<title>只读打开文件</title>
		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
	</head>
	<body>
		<!--header-->
		<div class="zz-headBox clearfix">
			<div class="zz-head mc">
				<!--logo-->
				<div class="logo fl">
					<a href="#"><img src="images/logo.png" alt="" />
					</a>
				</div>
				<!--logo end-->
				<ul class="head-rightUl fr">
					<li>
						<a href="http://www.zhuozhengsoft.com" target="_blank">卓正网站</a>
					</li>
					<li>
						<a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">客户问吧</a>
					</li>
					<li class="bor-0">
						<a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">联系我们</a>
					</li>
				</ul>
			</div>
		</div>
		<!--header end-->
		<!--a title-->
		<div class=" topTitle">
			<ul>
				<li class="pd-left">
					<a href="index.php" style="color: White;"><font>返回文件列表</font>
					</a>
				</li>
				<li>
					<font>当前模式：</font>在线编辑
				</li>
				<li>
					<font>当前系统日期：</font><?php date_default_timezone_set("Asia/Shanghai"); echo date("Y-m-d");?>
				</li>
			</ul>
		</div>
		<!--content-->
		<div class="zz-content mc clearfix pd-28">
			<form id="form1">
				<div style="height: 700px;">
					<!-- *************************PageOffice组件的使用************************************ -->
					<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
					<script type="text/javascript">
					
					    function saveAs() {
				            document.getElementById("PageOfficeCtrl1").ShowDialog(2);
				        }
				        function setPrint() {
				            document.getElementById("PageOfficeCtrl1").ShowDialog(5);
				        }
				        function setFullScreen() {
				            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
				        }
			
			    	</script>
			    <!-- *************************PageOffice组件的使用************************************ -->
				</div>
			</form>
		</div>
		<!--content end-->
		<!--footer-->
		<div class="login-footer clearfix">
			Copyright copy 2013 北京卓正志远软件有限公司
		</div>
		<!--footer end-->
	</body>
</html>
