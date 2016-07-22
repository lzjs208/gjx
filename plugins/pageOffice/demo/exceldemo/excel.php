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
	
	$PageOfficeCtrl->setSaveFilePage("savefile.php?id=".$sID);
	
	//添加自定义菜单栏
	$PageOfficeCtrl->setCustomMenuCaption("自定义菜单");
	$PageOfficeCtrl->addCustomMenuItem("显示标题","CustomMenuItem1_Click()",true);
	$PageOfficeCtrl->addCustomMenuItem("领导圈阅","CustomMenuItem2_Click()",true);
		
	//添加自定义工具栏
	$PageOfficeCtrl->addCustomToolButton("保存","CustomToolBar_Save()",1);
	$PageOfficeCtrl->addCustomToolButton("另存为","CustomToolBar_SaveAs()",1);
	$PageOfficeCtrl->addCustomToolButton("插入印章","CustomToolBar_InsertSeal()",2);
	$PageOfficeCtrl->addCustomToolButton("领导圈阅","CustomToolBar_HandDraw()",3);
	$PageOfficeCtrl->addCustomToolButton("全屏/还原","CustomToolBar_FullScreen()",4);   

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->xlsNormalEdit, "somebody");//此行必须
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>在线编辑文件</title>
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
		    	<li class="pd-left"><a href="index.php" style="color:White;"><font >返回文件列表</font></a></li>
		        <li><font>当前模式：</font>在线编辑</li>
		        <li><font>当前系统日期：</font><?php date_default_timezone_set("Asia/Shanghai"); echo date("Y-m-d");?></li>
		    </ul>
		</div>
		<!--content-->
		<div class="zz-content mc clearfix pd-28">
			<span style="color:Red;">请使用此用户（用户名：李志  初始密码：111111）测试盖章功能</span>
			<form id="form1">
				<div style="height: 700px;">
					<!-- *************************PageOffice组件的使用************************************ -->
					<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
					<script type="text/javascript">

					    function CustomMenuItem1_Click() {
					        alert("该菜单的标题是：" + document.getElementById("PageOfficeCtrl1").Caption);
					    };
					    
					    function CustomMenuItem2_Click() {
					        document.getElementById("PageOfficeCtrl1").HandDraw.Start();
					    };
					
					    function CustomToolBar_Save() {
					        document.getElementById("PageOfficeCtrl1").WebSave();
					        //alert("保存成功！\n这里可以显示开发人员自定义的保存成功信息。");
					    }
					    
					    function CustomToolBar_SaveAs() {
					        document.getElementById("PageOfficeCtrl1").ShowDialog(2);
					    }
						
						function CustomToolBar_InsertSeal() {
							//alert("请使用此用户的印章测试\r\n用户名：李志 \r\n初始密码：111111");
        						
							try{
	        						document.getElementById("PageOfficeCtrl1").ZoomSeal.AddSeal();
							}catch(e){ }
						}
						
						function CustomToolBar_HandDraw() {
							document.getElementById("PageOfficeCtrl1").HandDraw.Start();
						}
						
						function CustomToolBar_FullScreen() {
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
