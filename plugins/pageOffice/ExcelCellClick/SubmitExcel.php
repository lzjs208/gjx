<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	$PageOfficeCtrl->setCaption("简单的给Excel赋值");	
	$sheet = $workbook->openSheet("Sheet1");//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
	//定义table对象，设置table对象的设置范围
	$table = $sheet->openTable("B4:D8");
	//设置table对象的提交名称，以便保存页面获取提交的数据
	$table->setSubmitName("Info");

	// 设置响应单元格点击事件的js function
    $PageOfficeCtrl->setJsFunction_OnExcelCellClick("OnCellClick()");
    
	$PageOfficeCtrl->setWriter($workbook);
	
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
	//设置保存页面
	$PageOfficeCtrl->setSaveDataPage("SaveData.php");

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsSubmitForm, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>响应Excel单元格点击事件</title>
		<script type="text/javascript">
			function Save() {
				document.getElementById("PageOfficeCtrl1").WebSave();
			}
			
			function OnCellClick(Celladdress, value, left, bottom) {
		            var i = 0;
		            while (i<5) {//表格第一列的5个单元格都弹出选择对话框
		                if (Celladdress == "$B$" + (4 + i)) {
		                    var strRet = document.getElementById("PageOfficeCtrl1").ShowHtmlModalDialog("select.php", "", "left=" + left + "px;top=" + bottom + "px;width=320px;height=230px;frame=no;");
		                    if (strRet != "") {
		                        return (strRet);
		                    }
		                    else {
		                        if ((value == undefined) || (value == ""))
		                            return " ";
		                        else
		                            return value;
		                    }
		                }
		                i++;
		            }
		        }
		</script>
	</head>
	<body>
		<form id="form1">
			演示：点击Excel单元格弹出自定义对话框的效果。请看实现下面表格中的“部门名称”只能选择的效果。<br /><br />
			<div style="width: auto; height: 700px;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
