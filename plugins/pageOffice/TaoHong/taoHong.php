<?php

	$fileName = "";
	$mbName = "";
	
	if(isset($_REQUEST["mb"])){
		$mbName = $_REQUEST["mb"];
	}

	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	
	$PageOfficeCtrl->setCustomToolbar(false);//�����Զ��幤����
	$PageOfficeCtrl->setSaveFilePage("savefile.PHP");//���ñ���ҳ��
	
	if ( isset($mbName) && !empty($mbName) && strlen(trim($mbName))>0 )  {
		// ѡ��ģ���ִ���׺�
		
		// ����ģ�壬����Ϊ��ʽ���ĵ��ļ�����zhengshi.doc
		$fileName = "zhengshi.doc";
		$templateName = $_REQUEST["mb"];
		$path=realpath(dirname($_SERVER["SCRIPT_FILENAME"]))."\\doc\\";
		$templatePath = $path.$templateName;
		$newfilePath = $path.$fileName;
		copy($templatePath, $newfilePath); 

		// ������ݺ��������ݵ���zhengshi.doc��
		$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
		$copies = $doc->openDataRegion("PO_Copies");
		$copies->setValue("6");
		$docNum = $doc->openDataRegion("PO_DocNum");
		$docNum->setValue("001");
		$issueDate = $doc->openDataRegion("PO_IssueDate");
		$issueDate->setValue("2013-5-30");
		$issueDept = $doc->openDataRegion("PO_IssueDept");
		$issueDept->setValue("������");
		$sTextS = $doc->openDataRegion("PO_STextS");
		$sTextS->setValue("[word]doc/test.doc[/word]");
		$sTitle = $doc->openDataRegion("PO_sTitle");
		$sTitle->setValue("����ĳ��˾�ļ�");
		$topicWords = $doc->openDataRegion("PO_TopicWords");
		$topicWords->setValue("Pageoffice�� �׺�");
		$PageOfficeCtrl->setWriter($doc);
		
	} else {
		//�״μ���ʱ�������������ݣ�test.doc
		$fileName = "test.doc";
		
	}
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title></title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
	//��ʼ����ģ���б�
	function load() {
		if (getQueryString("mb") != null)
			document.getElementById("templateName").value = getQueryString("mb");
	}

	//��ȡurl���� 
	function getQueryString(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
		var r = window.location.search.substr(1).match(reg);
		if (r != null)
			return unescape(r[2]);
		else
			return null;
	}

	//�׺�
	function taoHong() {
		var mb = document.getElementById("templateName").value;
		document.getElementById("form1").action = "taoHong.php?mb=" + mb;

		document.forms[0].submit();
	}

	//���沢�ر�
	function saveAndClose() {
		document.getElementById("PageOfficeCtrl1").WebSave();
		location.href = "index.php";
	}
</script>
	</head>
	<body onload="load();" >
		<div id="header">
			<div style="float: left; margin-left: 20px;">
				<img src="images/logo.jpg" height="30" />
			</div>
			<ul>
				<li>
					<a target="_blank" href="http://www.zhuozhengsoft.com">׿����վ</a>
				</li>
				<li>
					<a target="_blank"
						href="http://www.zhuozhengsoft.com/poask/index.asp">�ͻ��ʰ�</a>
				</li>
				<li>
					<a href="#">���߰���</a>
				</li>
				<li>
					<a target="_blank"
						href="http://www.zhuozhengsoft.com/contact-us.html">��ϵ����</a>
				</li>
			</ul>
		</div>
		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">
				<div class="flow4">
					<a href="index.php"> <img alt="����" src="images/return.gif"
							border="0" />�ļ��б�</a>
					<span style="width: 100px;"> </span><strong>�ĵ����⣺</strong>
					<span style="color: Red;">�����ļ�</span>
					<form method="post" id="form1">
						<strong>ģ���б�</strong>
						<span style="color: Red;"> <select name="templateName"
								id="templateName" style='width: 240px;'>
								<option value='temp2008.doc' selected="selected">
									ģ��һ
								</option>
								<option value='temp2009.doc'>
									ģ���
								</option>
								<option value='temp2010.doc'>
									ģ����
								</option>
							</select> </span>
						<span style="color: Red;"><input type="button" value="һ���׺�"
								onclick="taoHong()"/> </span>
						<span style="color: Red;"><input type="button" value="����ر�"
								onclick="saveAndClose()"/> </span>
					</form>
				</div>
				<!--**************   ׿�� PageOffice��� ************************-->

				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>
		<div id="footer">
			<hr width="1000" />
			<div>
				Copyright (c) 2012 ����׿��־Զ������޹�˾
			</div>
		</div>

	</body>
</html>
