<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����","Save",1);
	$PageOfficeCtrl->setJsFunction_AfterDocumentOpened("AfterDocumentOpened()"); 
	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "������");//�༭ģʽ��word�ĵ������б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>��򵥵Ĵ򿪱���Word�ļ�</title>
</head>
<body>
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
    </script>
    <script type="text/javascript">
        function AfterDocumentOpened() {
            document.getElementById("Text1").value = document.getElementById("PageOfficeCtrl1").DataRegionList.GetDataRegionByName("PO_Title").Value;
        }

        function setTitleText() {
            document.getElementById("PageOfficeCtrl1").DataRegionList.GetDataRegionByName("PO_Title").Value = document.getElementById("Text1").value;
        }
    </script>
<p style=" text-indent:10px;" >
        PageOffice 3.0��2.0�汾�Ļ�����������ȫ�µ��ļ��򿪷�ʽ��PageOfficeLink ��ʽ�����˷�ʽ�ṩ�˸�����������������Խ��������
        </p>
        <p style=" text-indent:10px;" >
        <span style=" font-weight:bold;"> PageOfficeLink �����POL</span>����׿����˾ΪPageOffice���ߴ��ĵ���ҳ��ר�ſ��������ⳬ���ӣ�
        </p>
        <p style=" text-indent:10px;" >
       
            ������ĵ������ӵĴ���д����&lt;a href=&quot;Word.php?id=12&quot;&gt;ĳĳ��˾����-12&lt;a&gt;</p>
        <p style=" text-indent:10px;" >
            POL���ĵ������ӵĴ���д����
       &lt;a href=&quot;<span style=" background-color:#D2E9FF;">&lt;?php echo $pageOfficeLink->openWindow(null, &quot;</span>http://localhost/Samples/PageOfficeLink/Word.php?id=12<span style=" background-color:#D2E9FF;">&quot;,&quot;width=800px;height=800px;&quot;); ?&gt;</span>&quot;&gt;
     
            ĳĳ��˾����-12&lt;a&gt;
            &nbsp;</p>
	�ĵ����⣺<input id="Text1" type="text" size="50"      />
	<input type="button" value="�޸�" onclick="setTitleText();" />
    <form id="form1" >
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
