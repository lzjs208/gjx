<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("保存", "Save()", 1);
	$PageOfficeCtrl->addCustomToolButton("另存为PDF文件", "SaveAsPDF()", 1);
	//设置保存页面
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	$fileName = "template.doc";
	$pdfName = substr($fileName, 0, strlen($fileName) - 4).".pdf";

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->docNormalEdit, "张佚名");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Word文件转换成PDF格式</title>
		<script type="text/javascript">
        //保存
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }

        //另存为PDF文件
        function SaveAsPDF() {
            document.getElementById("PageOfficeCtrl1").WebSaveAsPDF();
            window.open("OpenPDF.php?fileName=<?php echo $pdfName;?>");
        }
    </script>
	</head>
	<body>
		<form id="form1">
			<div style="width: auto; height: 700px;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>

