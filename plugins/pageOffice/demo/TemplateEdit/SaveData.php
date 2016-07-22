<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	java_set_file_encoding("GBK");
	
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordreader.WordDocumentPHP");
	$doc->load(file_get_contents("php://input"));
	//获取提交的数值
    try{
        $poName = $doc->openDataRegion("PO_Name");
        echo "后台获取 PO_Name的值：".$poName->getValue();
    }
    catch(Exception $e){
        print "客户端提交的数据区域中没有包含名称为 PO_Name 的数据区域。";
    }

	$doc->showPage(400, 300);
	echo $doc->close();
?>
