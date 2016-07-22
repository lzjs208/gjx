<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $FileMakerCtrl = new Java("com.zhuozhengsoft.pageoffice.FileMakerCtrlPHP");//此行必须
    $FileMakerCtrl->setServerPage("http://localhost:8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$doc->setEnableAllDataRegionsEditing(true); // 此属性可以设置在提交模式（docSubmitForm）下，所有的数据区域可以编辑
    $doc->openDataRegion("Name")->setValue("王五");        
    $doc->openDataRegion("Address")->setValue("北京市丰台区南四环西路xxx号");  
    $doc->openDataRegion("Tel")->setValue("010-88882222");  
    $doc->openDataRegion("Phone")->setValue("13822225555");  
    $doc->openDataRegion("Sex")->setValue("男");  
    $doc->openDataRegion("Age")->setValue("21");  

    $doc->openDataTag("{ 甲方公司名称 }")->setValue("微软中国总部"); 
    $doc->openDataTag("{ 乙方公司名称 }")->setValue( "北京幻想科技公司"); 
    $doc->openDataTag("【 合同日期 】")->setValue("2014年08月01日"); 
    $doc->openDataTag("【 合同编号 】")->setValue("201408010001");	
	
	$FileMakerCtrl->setSaveFilePage("SaveFile.php");
	$FileMakerCtrl->setWriter($doc);
	$FileMakerCtrl->setJsFunction_OnProgressComplete("OnProgressComplete()");
	$FileMakerCtrl->setFileTitle("newfilename.doc");
	$DocumentOpenType = new Java("com.zhuozhengsoft.pageoffice.DocumentOpenType");
	$FileMakerCtrl->fillDocumentAs("doc/test.doc", $DocumentOpenType->Word, "filemaker.doc");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title></title>
	 <script type="text/javascript">
        function OnProgressComplete() {
            window.parent.hideGif();// 隐藏Default页中的loading图片
            document.getElementById("FileMakerCtrl1").Alert("文件生成完毕。\r\n 请打开 doc 文件夹，查看生成的filemaker.doc文件。");
        }

    </script>

</head>
<body>
    <form action="">
    <div>
        <?php echo $FileMakerCtrl->getDocumentView("FileMakerCtrl1") ?>
    </div>
    </form>
</body>
</html>