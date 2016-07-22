<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//隐藏自定义工具栏
	$PageOfficeCtrl->setCustomToolbar(false);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>js 合并Word中的单元格</title>

    <script type="text/javascript">
//        // 向右合并一个单元格
//        function mergeCellRight() {
//            var docObj = document.getElementById("PageOfficeCtrl1").Document;
//            docObj.Tables(1).Cell(1, 1).Select();   // 选择单元格（1，1）
//            docObj.Application.Selection.MoveRight(1, 1, 1); // 向右选择一个单元格
//            docObj.Application.Selection.Cells.Merge(); // 合并
//        }
//        
//        // 向下合并一个单元格
//        function mergeCellDown() {
//            var docObj = document.getElementById("PageOfficeCtrl1").Document;
//            docObj.Tables(1).Cell(2, 2).Select();   // 选择单元格（2，2）
//            docObj.Application.Selection.MoveDown(5, 1, 1); // 向下移动1个单元格
//            docObj.Application.Selection.Cells.Merge(); // 合并
//        }

        // 向右合并一个单元格
        function mergeCellRight() {
            var mac = "Function myfunc()" + " \r\n"
                    + "ActiveDocument.Tables(1).Cell(1, 1).Select " + " \r\n" // 选择单元格（1，1）
                    + "Application.Selection.MoveRight 1, 1, 1 " + " \r\n"    // 向右选择一个单元格
                    + "Application.Selection.Cells.Merge " + " \r\n"          // 合并
                    + "End Function " + " \r\n";
            document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", mac);
        }

        // 向下合并一个单元格
        function mergeCellDown() {
            var mac = "Function myfunc()" + " \r\n"
                    + "ActiveDocument.Tables(1).Cell(2, 2).Select " + " \r\n"// 选择单元格（2，2）
                    + "Application.Selection.MoveDown 5, 1, 1 " + " \r\n"    // 向下移动1个单元格
                    + "Application.Selection.Cells.Merge " + " \r\n"         // 合并
                    + "End Function " + " \r\n";
            document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", mac);
        }
    </script>

</head>
<body>
    <form id="form1">
    <div style="font-size:12px; line-height:20px; border-bottom:dotted 1px #ccc;border-top:dotted 1px #ccc; padding:5px;">
    关键代码：点右键，选择“查看源文件”，看js函数<span style="background-color:Yellow;">mergeCellRight()和mergeCellDown()</span>
    </div>
    <div style=" font-size:small">
        <input id="Button1" type="button" value="向右合并一个单元格" onclick="mergeCellRight()"/>&nbsp;&nbsp;
        <input id="Button2" type="button" value="向下合并一个单元格" onclick="mergeCellDown()" /><br />
    </div>
    <div style="width: 1200px; height: 700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
