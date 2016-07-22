<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	$sheet = $workbook->openSheet("Sheet1");//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	$tableA = $sheet->openTable("C4:D6");
    $tableB = $sheet->openTable("C7:D9");

    $tableA->setSubmitName("tableA");
    $tableB->setSubmitName("tableB");
		
		
    //���ݵ�¼�û���������������ɱ༭��
    $strInfo = "";
    $userName = $_REQUEST["userName"];    
    //A���ž����¼��
    if (strcasecmp($userName, "zhangsan")==0)
    {
        $strInfo = "A���ž�������ֻ�ܱ༭A���ŵĲ�Ʒ����";
        $tableA->setReadOnly(false);
        $tableB->setReadOnly(true);
    }
    //B���ž����¼��
    else
    {
        $strInfo = "B���ž�������ֻ�ܱ༭B���ŵĲ�Ʒ����";
        $tableA->setReadOnly(true);
        $tableB->setReadOnly(false);
    }
	
	$PageOfficeCtrl->setWriter($workbook);
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
	$PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
	//���ñ���ҳ
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");//�����ļ�
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);

    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsSubmitForm, $userName);//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title></title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>


		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">
				<div class="flow4">
					<a href="Default.php"> ���ص�¼ҳ</a>
					<strong>��ǰ�û���</strong>
					<span style="color: Red;"><?php echo $strInfo;?></span>
				</div>

				<script type="text/javascript">
	                //����ҳ��
	                function Save() {
	                    document.getElementById("PageOfficeCtrl1").WebSave();
	                }
	
	            </script>

				<!--**************   ׿�� PageOffice��� ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>


	</body>
</html>