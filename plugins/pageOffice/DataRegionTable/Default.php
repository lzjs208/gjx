<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$color = new Java("java.awt.Color");
	//����������
    $dTable = $doc->openDataRegion("PO_table");
    //������������ɱ༭��
    $dTable->setEditing(true);

	//�����������еı��OpenTable(index)�����е�indexΪword�ĵ��б����±꣬��1��ʼ
	$table1 = $doc->openDataRegion("PO_Table")->openTable(1);
	//���ñ��߿���ʽ
	$table1->getBorder()->setLineColor($color->green);
	$wdLineWidth = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdLineWidth");
    $table1->getBorder()->setLineWidth($wdLineWidth->wdLineWidth050pt);
    // ���ñ�ͷ��Ԫ���ı�����
	$wdParagraphAlignment = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdParagraphAlignment");
    $table1->openCellRC(1, 2)->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
    $table1->openCellRC(1, 3)->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
    $table1->openCellRC(2, 1)->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
    $table1->openCellRC(3, 1)->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);

    // ����ͷ��Ԫ��ֵ
    $table1->openCellRC(1, 2)->setValue("��Ʒ1");
    $table1->openCellRC(1, 3)->setValue("��Ʒ2");
    $table1->openCellRC(2, 1)->setValue("A����");
    $table1->openCellRC(3, 1)->setValue("B����");
        
    $PageOfficeCtrl->setWriter($doc);

    //����Զ��尴ť
    $PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
    $PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
        
    //���ñ���ҳ
    $PageOfficeCtrl->setSaveDataPage("SaveData.php");	
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>���������ύ���</title>
    <link href="images/csstg.css" rel="stylesheet" type="text/css" />
</head>
<body>
   

    <div id="content">
        <div id="textcontent" style="width: 1000px; height: 800px;">
      

            <script type="text/javascript">
                //����ҳ��
                function Save() {
                    document.getElementById("PageOfficeCtrl1").WebSave();
                }

                //ȫ��/��ԭ
                function IsFullScreen() {
                    document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
                }

            </script>

            <!--**************   ׿�� PageOffice��� ************************-->
            <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
        </div>
    </div>

</body>
</html>
