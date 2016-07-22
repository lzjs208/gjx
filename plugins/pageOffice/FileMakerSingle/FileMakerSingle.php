<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $FileMakerCtrl = new Java("com.zhuozhengsoft.pageoffice.FileMakerCtrlPHP");//此行必须
    $FileMakerCtrl->setServerPage("http://localhost:8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	//禁用右击事件
	$doc->setDisableWindowRightClick(true);
	//给数据区域赋值，即把数据填充到模板中相应的位置
	$doc->openDataRegion("PO_company")->setValue("北京卓正志远软件有限公司");
	$FileMakerCtrl->setSaveFilePage("SaveMaker.php");
	$FileMakerCtrl->setWriter($doc);
	$FileMakerCtrl->setJsFunction_OnProgressComplete("OnProgressComplete()");
	$FileMakerCtrl->setFileTitle("newfilename.doc");
	$DocumentOpenType = new Java("com.zhuozhengsoft.pageoffice.DocumentOpenType");
	$FileMakerCtrl->fillDocument("doc/template.doc", $DocumentOpenType->Word);
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>My JSP 'FileMaker.jsp' starting page</title>

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
		<div>
			<!--**************   卓正 PageOffice 客户端代码开始    ************************-->

			<script language="javascript" type="text/javascript">
	function OnProgressComplete() {
		window.parent.myFunc(); //调用父页面的js函数
	}
</script>
			<!--**************   卓正 PageOffice 客户端代码结束    ************************-->
			<?php echo $FileMakerCtrl->getDocumentView("FileMakerCtrl1") ?>

		</div>

	</body>
</html>
