<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//���ô򿪵�Word�ĵ�������
	$themeType = new Java("com.zhuozhengsoft.pageoffice.ThemeType");//���б���
	$PageOfficeCtrl->setTheme($themeType->Office2007);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>��ʾ���޸�Word�ĵ���������ʽ</title>
    <style>
        html, body
        {
            height: 100%;
        }
        .main
        {
            height: 100%;
        }
    </style>
</head>
<body>
    <form id="form1">
    <div style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc;
        padding: 5px;">
        ��������Htmlҳ�����PageOfficeCtrl�ؼ������ں�̨����PageOfficeCtrl��Theme����<br />
        �ؼ����룺<span style="background-color:Yellow;">$PageOfficeCtrl->setTheme($themeType->Office2007);//$PageOfficeCtrlΪPageOfficeCtrl����$themeTypeΪThemeType����ThemeTypeΪö������</span>
    </div>
    <div style="height: 600px; width: auto;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
