<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("保存","Save()",1);
	$PageOfficeCtrl->addCustomToolButton("开始手写", "StartHandDraw()", 5);
	$PageOfficeCtrl->addCustomToolButton("设置线宽", "SetPenWidth()", 5);
	$PageOfficeCtrl->addCustomToolButton("设置颜色", "SetPenColor()", 5);
	$PageOfficeCtrl->addCustomToolButton("设置笔型", "SetPenType()", 5);
	$PageOfficeCtrl->addCustomToolButton("设置缩放", "SetPenZoom()", 5);
	$PageOfficeCtrl->addCustomToolButton("访问手写集", "GetHandDrawList()", 6);

	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>手写批注接口演示</title>

		<script language="JavaScript">
		//保存
		function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
        //开始手写
        function StartHandDraw() {
            document.getElementById("PageOfficeCtrl1").HandDraw.Start();
        }
        //设置线宽
        function SetPenWidth() {
            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenWidth(5);
        }
        //设置颜色
        function SetPenColor() {

            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenColor(5292104);
        }
        //设置笔型
        function SetPenType() {

            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenType(1);
        }
        //设置缩放
        function SetPenZoom() {

            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenZoom(50);
        }
        //撤销最近一次手写
        function UndoHandDraw() {

            document.getElementById("PageOfficeCtrl1").HandDraw.Undo();
        }
        //退出手写
        function ExitHandDraw() {

            document.getElementById("PageOfficeCtrl1").HandDraw.Exit();
        }
        //访问手写集合
        function GetHandDrawList() {

            var handDrawList = null;
            var handDraw = null;
            handDrawList = document.getElementById("PageOfficeCtrl1").HandDraw;
            handDrawList.Refresh();
            document.getElementById("PageOfficeCtrl1").Alert("本文档共有 " + handDrawList.Count + " 个手写批示。");
            var i = 0; //索引从0开始
            for (i = 0; i < handDrawList.Count; i++) {
                handDraw = handDrawList.Item(i);
                handDraw.Locate();
                document.getElementById("PageOfficeCtrl1").Alert("第" + handDraw.PageNumber + "页" + ", " + handDraw.UserName + ", " + handDraw.DateTime);
            }
        }
    </script>

	</head>
	<body>
		<div
			style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc; padding: 5px;">
			<span style="color: red;">操作说明：</span>若想提前设置线宽、颜色、笔型、缩放等，可先点击自定义工具栏上的相应按钮，然后点击“开始手写”按钮。在尚未关闭手写工具栏时，点“撤销最近一次手写”按钮，可撤销最近一次的手写；点击“退出手写”按钮，可退出手写；还可点“设置线宽”、“设置颜色”等按钮对手写批注的颜色、线宽等进行再次设置。
			<br />
			关键代码：点右键，选择“查看源文件”，看js函数
			<br />
			<input id="Button3" type="button" value="设置线宽"
				onclick="SetPenWidth()" />
			<input id="Button4" type="button" onclick="SetPenColor()"
				value="设置颜色" />
			<input id="Button1" type="button" value="撤销最近一次手写"
				onclick="UndoHandDraw()" />
			<input id="Button2" type="button" onclick="ExitHandDraw()"
				value="退出手写" />
			<span style="background-color: Yellow;"></span>
		</div>
		<br />
		<form id="form1">
			<div style="height: 700px; width: auto;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
