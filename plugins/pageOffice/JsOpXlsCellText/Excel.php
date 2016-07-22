<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//添加自定义按钮
	//$PageOfficeCtrl->addCustomToolButton("保存","Save",1);
	//设置保存页面
	//$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "张佚名");//此行必须
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>js获取和设置Excel文件中单元格的值</title>
</head>
<body>
    <script type="text/javascript">
        function setCellValue(sheet, cell, value) {
            var sMac = "function myfunc()" + "\r\n"
                        + "Application.Sheets(\"" + sheet + "\").Range(\"" + cell + "\").Value = \"" + value + "\" \r\n"
                        + "End function";
            return document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", sMac);
        }
        function getCellValue(sheet, cell) {
            var sMac = "function myfunc()" + "\r\n"
                        + "myfunc = Application.Sheets(\"" + sheet + "\").Range(\"" + cell + "\").Text \r\n"
                        + "End function";
            return document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", sMac);
        }
        function Button1_onclick() {
            document.getElementById("PageOfficeCtrl1").Alert(getCellValue("Sheet1", "B4"));
        }
        function Button2_onclick() {
            setCellValue("Sheet1", "C4", "100");
        }
    </script>
    <div style="font-size:12px; line-height:20px; border-bottom:dotted 1px #ccc;border-top:dotted 1px #ccc; padding:5px;">
     <span style="color:red;">操作说明：</span>请点击按钮。
        <input id="Button1" type="button" value="获取Sheet1中B4单元格的值" onclick="return Button1_onclick()" />
        <input id="Button2" type="button" value="设置Sheet1中C4单元格的值为：100" onclick="return Button2_onclick()" />
     <br />
   
    关键代码：点右键，选择“查看源文件”，看js函数<span style="background-color:Yellow;">getCellValue(sheet, cell)&nbsp;&nbsp; setCellValue(sheet, cell, value)</span></div><br />
    
    <form id="form1">
    <div style=" width:100%; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>


