<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$doc->getTemplate()->defineDataRegion("Name", "[ 姓名 ]");
	$doc->getTemplate()->defineDataRegion("Address", "[ 地址 ]");
	$doc->getTemplate()->defineDataRegion("Tel", "[ 电话 ]");
	$doc->getTemplate()->defineDataRegion("Phone", "[ 手机 ]");
	$doc->getTemplate()->defineDataRegion("Sex", "[ 性别 ]");
	$doc->getTemplate()->defineDataRegion("Age", "[ 年龄 ]");
	$doc->getTemplate()->defineDataRegion("Email", "[ 邮箱 ]");
	$doc->getTemplate()->defineDataRegion("QQNo", "[ QQ号 ]");
	$doc->getTemplate()->defineDataRegion("MSNNo", "[ MSN号 ]");

	$PageOfficeCtrl->addCustomToolButton("保存", "Save()", 1);
	$PageOfficeCtrl->addCustomToolButton("定义数据区域", "ShowDefineDataRegions()", 3);

	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");

	$themeType = new  Java("com.zhuozhengsoft.pageoffice.ThemeType");
	$borderStyleType = new  Java("com.zhuozhengsoft.pageoffice.BorderStyleType");
	$PageOfficeCtrl->setTheme($themeType->Office2007);
	$PageOfficeCtrl->setBorderStyle($borderStyleType->BorderThin);
	
	$PageOfficeCtrl->setWriter($doc);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "zhangsan");//此行必须
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>编辑模版中数据区域</title>
	<script type="text/javascript">
        //获取后台添加的书签名称字符串
        function getBkNames() {
            var bkNames = document.getElementById("PageOfficeCtrl1").DataRegionList.DefineNames;
            return bkNames;
        }

        //获取后台添加的书签文本字符串
        function getBkConts() {
            var bkConts = document.getElementById("PageOfficeCtrl1").DataRegionList.DefineCaptions;
            return bkConts;
        }

        //定位书签
        function locateBK(bkName) {
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            drlist.GetDataRegionByName(bkName).Locate();
            document.getElementById("PageOfficeCtrl1").Activate();
            window.focus();
        }

        //添加书签
        function addBookMark(param) {
            var tmpArr = param.split("=");
            var bkName = tmpArr[0];
            var content = tmpArr[1];
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            drlist.Refresh();
            try {
                document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Collapse(0);
                drlist.Add(bkName, content);
                return "true";
            } catch (e) {
                return "false";
            }
        }
        //删除书签
        function delBookMark(bkName) {
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            try {
                drlist.Delete(bkName);
                return "true";
            } catch (e) {
                return "false";
            }
        }

        //遍历当前Word中已存在的书签名称
        function checkBkNames() {
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            drlist.Refresh();
            var bkName = "";
            var bkNames = "";
            for (var i = 0; i < drlist.Count; i++) {
                bkName = drlist.Item(i).Name;
                bkNames += bkName.substr(3) + ",";
            }
            return bkNames.substr(0, bkNames.length - 1);
        }

        //遍历当前Word中已存在的书签文本
        function checkBkConts() {
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            drlist.Refresh();
            var bkCont = "";
            var bkConts = "";
            for (var i = 0; i < drlist.Count; i++) {
                bkCont = drlist.Item(i).Value;
                bkConts += bkCont + ",";
            }
            return bkConts.substr(0, bkConts.length - 1);
        }
    </script>
    
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
        function ShowDefineDataRegions() {
            document.getElementById("PageOfficeCtrl1").ShowHtmlModelessDialog("DataRegionDlg.htm", "parameter=xx", "left=300px;top=390px;width=520px;height=410px;frame:no;");

        }

    </script>
   

</head>
<body>
    <form action="">
    <div style="width: 1000px; height: 800px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>