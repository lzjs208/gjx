<?php
	$userName = $_REQUEST["userName"];
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	$color = new Java("java.awt.Color");
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	
	//打开数据区域
	$d1 = $doc->openDataRegion("PO_1");
	$d2 = $doc->openDataRegion("PO_2");
	$d3 = $doc->openDataRegion("PO_3");
	
	//设置文本样式
	$d1->getFont()->setColor($color->GREEN);
	$d2->getFont()->setColor($color->black);
	$d3->getFont()->setColor($color->magenta);

	//根据登录用户名设置数据区域可编辑性
	//张三登录后
	if (strcasecmp($userName, "zhangsan")==0) {
		$userName = "张三";
		$d1->setEditing(true);
		$d2->setEditing(false);
		$d3->setEditing(false);
	}
	//李四登录后
	else if(strcasecmp($userName, "lisi")==0){
		$userName = "李四";
		$d1->setEditing(false);
		$d2->setEditing(true);
		$d3->setEditing(false);
	}
	//王五登录后
	else{
		$userName = "王五";
		$d1->setEditing(false);
		$d2->setEditing(false);
		$d3->setEditing(true);
	}
	
    $PageOfficeCtrl->setWriter($doc);
	
	$PageOfficeCtrl->setOfficeToolbars(false);

	//添加自定义按钮
    $PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
    $PageOfficeCtrl->addCustomToolButton("-", "", 0);
    $PageOfficeCtrl->addCustomToolButton("盖章方式一", "AddSeal", 2);
    $PageOfficeCtrl->addCustomToolButton("盖章方式二", "AddSeal2", 2);
    $PageOfficeCtrl->addCustomToolButton("-","",0);
    $PageOfficeCtrl->addCustomToolButton("签字方式一", "AddSign", 3);
    $PageOfficeCtrl->addCustomToolButton("签字方式二", "AddSign2", 3);
    $PageOfficeCtrl->addCustomToolButton("-", "", 0);
    $PageOfficeCtrl->addCustomToolButton("全屏/还原", "IsFullScreen", 4);
	
	//设置保存页
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, $userName);//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title></title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

		<div id="header">
			<div style="float: left; margin-left: 20px;">
				<img src="images/logo.jpg" height="30" />
			</div>
			<ul>
				<li>
					<a target="_blank" href="http://www.zhuozhengsoft.com">卓正网站</a>
				</li>
				<li>
					<a target="_blank"
						href="http://www.zhuozhengsoft.com/poask/index.asp">客户问吧</a>
				</li>
				<li>
					<a href="#">在线帮助</a>
				</li>
				<li>
					<a target="_blank"
						href="http://www.zhuozhengsoft.com/contact-us.html">联系我们</a>
				</li>
			</ul>
		</div>
		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">
				<div class="flow4">
					<a href="Default.php"> <img alt="返回" src="images/return.gif"
							border="0" />返回登录页</a>
					<strong>当前用户：</strong>
					<span style="color: Red;"><?php echo $userName;?></span>
					<strong>印章密码：</strong>
					<span style="color: red;">123456</span>
					<br /><br />
					<span style="color: Red; font-size:12px;">“盖章方式一”：</span>需要输入印章用户名和密码才可以盖章<br />
					<span style="color: Red;font-size:12px;">“盖章方式二”：</span>不需要输入印章用户名和密码<br />
					<span style="color: Red; font-size:12px;">“签字方式一”：</span>需要输入用户名和密码才可以签字<br />
					<span style="color: Red;font-size:12px;">“签字方式二”：</span>不需要输入用户名和密码<br />
				</div>

				<script type="text/javascript">
				//保存页面
                function Save() {
                    document.getElementById("PageOfficeCtrl1").WebSave();
                }

                //添加印章
                function AddSeal() {
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddSeal("", "");
                }
                //无需输入用户名和密码，添加印章
                function AddSeal2() {
                    var user = "<?php echo $userName;?>";
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddSeal(user, "");
                }
                //签字
                function AddSign() {
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddHandSign("", "");
                }
                //无需输入用户名和密码，签字
                function AddSign2() {
                    var user = "<?php echo $userName;?>";
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddHandSign(user, "");
                }
                //全屏/还原
                function IsFullScreen() {
                    document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
                }
				</script>

				<!--**************   卓正 PageOffice组件 ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>
		<div id="footer">
			<hr width="1000" />
			<div>
				Copyright (c) 2012 北京卓正志远软件有限公司
			</div>
		</div>

	</body>
</html>

