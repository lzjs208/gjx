<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$color = new Java("java.awt.Color");
	//打开数据区域
    $dTable = $doc->openDataRegion("PO_table");
    //设置数据区域可编辑性
    $dTable->setEditing(true);

	//打开数据区域中的表格，OpenTable(index)方法中的index为word文档中表格的下标，从1开始
	$table1 = $doc->openDataRegion("PO_Table")->openTable(1);
	//设置表格边框样式
	$table1->getBorder()->setLineColor($color->green);
	$wdLineWidth = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdLineWidth");
    $table1->getBorder()->setLineWidth($wdLineWidth->wdLineWidth050pt);
    // 设置表头单元格文本居中
	$wdParagraphAlignment = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdParagraphAlignment");
    $table1->openCellRC(1, 2)->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
    $table1->openCellRC(1, 3)->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
    $table1->openCellRC(2, 1)->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
    $table1->openCellRC(3, 1)->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);

    // 给表头单元格赋值
    $table1->openCellRC(1, 2)->setValue("产品1");
    $table1->openCellRC(1, 3)->setValue("产品2");
    $table1->openCellRC(2, 1)->setValue("A部门");
    $table1->openCellRC(3, 1)->setValue("B部门");
        
    $PageOfficeCtrl->setWriter($doc);

    //添加自定义按钮
    $PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
    $PageOfficeCtrl->addCustomToolButton("全屏/还原", "IsFullScreen", 4);
        
    //设置保存页
    $PageOfficeCtrl->setSaveDataPage("SaveData.php");	
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>数据区域提交表格</title>
    <link href="images/csstg.css" rel="stylesheet" type="text/css" />
</head>
<body>
   

    <div id="content">
        <div id="textcontent" style="width: 1000px; height: 800px;">
      

            <script type="text/javascript">
                //保存页面
                function Save() {
                    document.getElementById("PageOfficeCtrl1").WebSave();
                }

                //全屏/还原
                function IsFullScreen() {
                    document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
                }

            </script>

            <!--**************   卓正 PageOffice组件 ************************-->
            <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
        </div>
    </div>

</body>
</html>
