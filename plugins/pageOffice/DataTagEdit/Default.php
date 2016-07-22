<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$doc->getTemplate()->defineDataTag("{ 甲方 }");
	$doc->getTemplate()->defineDataTag("{ 乙方 }");
	$doc->getTemplate()->defineDataTag("{ 担保人 }");
	$doc->getTemplate()->defineDataTag("【 合同日期 】");
	$doc->getTemplate()->defineDataTag("【 合同编号 】");
	
	$PageOfficeCtrl->addCustomToolButton("保存", "Save()", 1);
    $PageOfficeCtrl->addCustomToolButton("定义数据标签", "ShowDefineDataTags()", 20);

    $PageOfficeCtrl->setSaveFilePage("SaveFile.php");

	$themeType = new Java("com.zhuozhengsoft.pageoffice.ThemeType");
    $PageOfficeCtrl->setTheme($themeType->Office2007);
	$borderStyleType = new Java("com.zhuozhengsoft.pageoffice.BorderStyleType");
    $PageOfficeCtrl->setBorderStyle($borderStyleType->BorderThin);
	
    $PageOfficeCtrl->setWriter($doc);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>编辑模版中数据标签</title>
	<script type="text/javascript">
        //获取后台定义的Tag 字符串
        function getTagNames() {
            var tagNames = document.getElementById("PageOfficeCtrl1").DefineTagNames;
            return tagNames;
        }
        
        //定位Tag
        function locateTag(tagName) {
            
            var appSlt = document.getElementById("PageOfficeCtrl1").Document.Application.Selection;
            var bFind = false;
            //appSlt.HomeKey(6);
            appSlt.Find.ClearFormatting();
            appSlt.Find.Replacement.ClearFormatting();

            bFind = appSlt.Find.Execute(tagName);
            if (!bFind) {
                document.getElementById("PageOfficeCtrl1").Alert("已搜索到文档末尾。");
                appSlt.HomeKey(6);
            }
            window.focus();

        }

        //添加Tag
        function addTag(tagName) {
            try {
                var tmpRange = document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Range;
                tmpRange.Text = tagName;
                tmpRange.Select();
                return "true";
            } catch (e) {
                return "false";
            }
        }
        
        //删除Tag
        function delTag(tagName) {
            var tmpRange = document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Range;
            
            if (tagName == tmpRange.Text) {
                tmpRange.Text = "";
                return "true";
            }
            else
                return "false";

        }
   
    </script>
    
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
        function ShowDefineDataTags() {
            document.getElementById("PageOfficeCtrl1").ShowHtmlModelessDialog("DataTagDlg.htm", "parameter=xx", "left=300px;top=390px;width=430px;height=410px;frame:no;");

        }

    </script>
   

</head>
<body>
    <form action="">
    <div style="width: auto; height: 600px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>