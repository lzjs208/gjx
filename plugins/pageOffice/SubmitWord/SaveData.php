<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б��� 
	java_set_file_encoding("GBK");
	
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordreader.WordDocumentPHP");
	$doc->load(file_get_contents("php://input"));
	//��ȡ�ύ����ֵ
	$dataUserName = $doc->openDataRegion("PO_userName");
	$dataDeptName = $doc->openDataRegion("PO_deptName");
	$content = "";
	$content .= "��˾���ƣ�".$doc->getFormField("txtCompany");
	$content .= "<br/>Ա��������".$dataUserName->getValue();
	$content .= "<br/>�������ƣ�".$dataDeptName->getValue();

	$doc->showPage(500, 400);
	echo $doc->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title></title>
	</head>
	<body>
		<form id="form1">
			<div style="border: solid 1px gray;">
				<div class="errTopArea"
					style="text-align: left; border-bottom: solid 1px gray;">
					[��ʾ���⣺����һ��������Ա���Զ���ĶԻ���]
				</div>
				<div class="errTxtArea" style="height: 150px; text-align: left">
					<b class="txt_title">
						<div style="color: #FF0000;">
							�ύ����Ϣ���£�
						</div> <?php echo $content;?> </b>
				</div>
				<div class="errBtmArea" style="text-align: center;">
					<input type="button" class="btnFn" value=" �ر� "
						onclick="window.opener=null;window.open('','_self');window.close();" />
				</div>
			</div>
		</form>
	</body>
</html>