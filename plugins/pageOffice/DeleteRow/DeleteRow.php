<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	$PageOfficeCtrl->addCustomToolButton("删除行","DeleteRow()",1);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/deleteWord.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>删除光标所在行</title>

		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
		<meta http-equiv="description" content="This is my page">
		<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->

	</head>

	<body>
		<!-- ***************************PageOffice组件客户端Js代码******************************** -->
	<script type="text/javascript">
    //删除word表格中光标所在行
//        function DeleteRow() {
//            var appObj = document.getElementById("PageOfficeCtrl1").Document.Application;

//            appObj.Selection.HomeKey(10);
//            appObj.Selection.EndKey(10, true);
//            appObj.Selection.Cells.Delete(2);
//            appObj.Selection.TypeBackspace();
        //        }
        //删除word表格中光标所在行，各种浏览器下均可使用
        function DeleteRow() {
            var mac = "Function myfunc()" + " \r\n"
                    + "Application.Selection.HomeKey Unit:=wdLine " + " \r\n"
                    + "Application.Selection.EndKey Unit:=wdLine, Extend:=true " + " \r\n"
                    + "Application.Selection.Cells.Delete ShiftCells:=wdDeleteCellsEntireRow " + " \r\n" 
                    + "Application.Selection.TypeBackspace " + " \r\n" 
                    + "End Function " + " \r\n";
            document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", mac);
        } 
	</script>
		<div style="width:auto; height:700px; ">
		<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
		
	</body>
</html>
