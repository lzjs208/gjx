<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量

	$dataReg = $doc->openDataRegion("PO_deptName");
	$color = new Java("java.awt.Color");
	$dataReg->getShading()->setBackgroundPatternColor($color->pink);
	//$dataReg->setEditing(true);
    $PageOfficeCtrl->setWriter($doc);
	
	//设置服务器页面
	$PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
	$PageOfficeCtrl->setJsFunction_OnWordDataRegionClick("OnWordDataRegionClick()");
	$PageOfficeCtrl->setOfficeToolbars(false);
	$PageOfficeCtrl->setCaption("为方便用户知道哪些地方可以编辑，所以设置了数据区域的背景色");
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");

    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>响应数据区域点击</title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

		
		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">
				<script type="text/javascript">
	//***********************************PageOffice组件调用的js函数**************************************
	//保存页面
	function Save() {
		document.getElementById("PageOfficeCtrl1").WebSave();
	}

	//全屏/还原
	function IsFullScreen() {
		document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
	}

	function OnWordDataRegionClick(Name, Value, Left, Bottom) {
		
        if (Name == "PO_deptName") {
            var strRet = document.getElementById("PageOfficeCtrl1").ShowHtmlModalDialog("HTMLPage.htm", Value, "left=" + Left + "px;top=" + Bottom + "px;width=400px;height=300px;frame=no;");
            if (strRet != "") {
                return (strRet);
            }
            else {
                if ((Value == undefined) || (Value == ""))
                    return " ";
                else
                    return Value;
            }
        }
    }

	//***********************************PageOffice组件调用的js函数**************************************
</script>

				<!--**************   卓正 PageOffice组件 ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>


	</body>
</html>
