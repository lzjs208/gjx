<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("�Ӹ�ӡ��", "InsertSeal()", 2);
    $PageOfficeCtrl->addCustomToolButton("ǩ��", "AddHandSign()", 3);
    $PageOfficeCtrl->addCustomToolButton("��֤ӡ��", "VerifySeal()", 5);
    $PageOfficeCtrl->addCustomToolButton("�޸�����", "ChangePsw()", 0);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>����ӡ��</title>
    
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
  <div style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc;
        padding: 5px;">
        <span style="color: red;">����˵����</span>�㡰����ӡ�¡���ť���ɣ�����ӡ��ʱ���û���Ϊ����־������Ĭ��Ϊ��111111��<br />
        �ؼ����룺���Ҽ���ѡ�񡰲鿴Դ�ļ�������js����<span style="background-color: Yellow;">InsertSeal()</span>
        <p>��� <a href="http://<?php echo $ip;?>:8080/JavaBridge/adminseal.do">����ӡ�¼��׹���ƽ̨</a> ��ӡ�ɾ��ӡ�¡�����Ա:admin ����:111111</p>
    </div>
    <br />
   <div style=" width:auto; height:700px;">
   <!-- *********************************PageOffice�����ʹ��************************************ -->
   <script type="text/javascript">
            function InsertSeal() {
                try {
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddSeal();
                }
                catch (e) { }
            }
            function AddHandSign() {
                document.getElementById("PageOfficeCtrl1").ZoomSeal.AddHandSign();
            }
            function VerifySeal() {
                document.getElementById("PageOfficeCtrl1").ZoomSeal.VerifySeal();
            }
            function ChangePsw() {
                document.getElementById("PageOfficeCtrl1").ZoomSeal.ShowSettingsBox();
            }
    </script>
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
     <!-- *********************************PageOffice�����ʹ��************************************ -->
    </div>
  </body>
</html>
