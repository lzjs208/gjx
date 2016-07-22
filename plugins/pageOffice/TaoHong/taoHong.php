<?php

	$fileName = "";
	$mbName = "";
	
	if(isset($_REQUEST["mb"])){
		$mbName = $_REQUEST["mb"];
	}

	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	
	$PageOfficeCtrl->setCustomToolbar(false);//隐藏自定义工具栏
	$PageOfficeCtrl->setSaveFilePage("savefile.PHP");//设置保存页面
	
	if ( isset($mbName) && !empty($mbName) && strlen(trim($mbName))>0 )  {
		// 选择模板后执行套红
		
		// 复制模板，命名为正式发文的文件名：zhengshi.doc
		$fileName = "zhengshi.doc";
		$templateName = $_REQUEST["mb"];
		$path=realpath(dirname($_SERVER["SCRIPT_FILENAME"]))."\\doc\\";
		$templatePath = $path.$templateName;
		$newfilePath = $path.$fileName;
		copy($templatePath, $newfilePath); 

		// 填充数据和正文内容到“zhengshi.doc”
		$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
		$copies = $doc->openDataRegion("PO_Copies");
		$copies->setValue("6");
		$docNum = $doc->openDataRegion("PO_DocNum");
		$docNum->setValue("001");
		$issueDate = $doc->openDataRegion("PO_IssueDate");
		$issueDate->setValue("2013-5-30");
		$issueDept = $doc->openDataRegion("PO_IssueDept");
		$issueDept->setValue("开发部");
		$sTextS = $doc->openDataRegion("PO_STextS");
		$sTextS->setValue("[word]doc/test.doc[/word]");
		$sTitle = $doc->openDataRegion("PO_sTitle");
		$sTitle->setValue("北京某公司文件");
		$topicWords = $doc->openDataRegion("PO_TopicWords");
		$topicWords->setValue("Pageoffice、 套红");
		$PageOfficeCtrl->setWriter($doc);
		
	} else {
		//首次加载时，加载正文内容：test.doc
		$fileName = "test.doc";
		
	}
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title></title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
	//初始加载模板列表
	function load() {
		if (getQueryString("mb") != null)
			document.getElementById("templateName").value = getQueryString("mb");
	}

	//获取url参数 
	function getQueryString(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
		var r = window.location.search.substr(1).match(reg);
		if (r != null)
			return unescape(r[2]);
		else
			return null;
	}

	//套红
	function taoHong() {
		var mb = document.getElementById("templateName").value;
		document.getElementById("form1").action = "taoHong.php?mb=" + mb;

		document.forms[0].submit();
	}

	//保存并关闭
	function saveAndClose() {
		document.getElementById("PageOfficeCtrl1").WebSave();
		location.href = "index.php";
	}
</script>
	</head>
	<body onload="load();" >
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
					<a href="index.php"> <img alt="返回" src="images/return.gif"
							border="0" />文件列表</a>
					<span style="width: 100px;"> </span><strong>文档主题：</strong>
					<span style="color: Red;">测试文件</span>
					<form method="post" id="form1">
						<strong>模板列表：</strong>
						<span style="color: Red;"> <select name="templateName"
								id="templateName" style='width: 240px;'>
								<option value='temp2008.doc' selected="selected">
									模板一
								</option>
								<option value='temp2009.doc'>
									模板二
								</option>
								<option value='temp2010.doc'>
									模板三
								</option>
							</select> </span>
						<span style="color: Red;"><input type="button" value="一键套红"
								onclick="taoHong()"/> </span>
						<span style="color: Red;"><input type="button" value="保存关闭"
								onclick="saveAndClose()"/> </span>
					</form>
				</div>
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
