<?php
	$userName = $_REQUEST["userName"];
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	$color = new Java("java.awt.Color");
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	
	//����������
	$d1 = $doc->openDataRegion("PO_1");
	$d2 = $doc->openDataRegion("PO_2");
	$d3 = $doc->openDataRegion("PO_3");
	
	//�����ı���ʽ
	$d1->getFont()->setColor($color->GREEN);
	$d2->getFont()->setColor($color->black);
	$d3->getFont()->setColor($color->magenta);

	//���ݵ�¼�û���������������ɱ༭��
	//������¼��
	if (strcasecmp($userName, "zhangsan")==0) {
		$userName = "����";
		$d1->setEditing(true);
		$d2->setEditing(false);
		$d3->setEditing(false);
	}
	//���ĵ�¼��
	else if(strcasecmp($userName, "lisi")==0){
		$userName = "����";
		$d1->setEditing(false);
		$d2->setEditing(true);
		$d3->setEditing(false);
	}
	//�����¼��
	else{
		$userName = "����";
		$d1->setEditing(false);
		$d2->setEditing(false);
		$d3->setEditing(true);
	}
	
    $PageOfficeCtrl->setWriter($doc);
	
	$PageOfficeCtrl->setOfficeToolbars(false);

	//����Զ��尴ť
    $PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
    $PageOfficeCtrl->addCustomToolButton("-", "", 0);
    $PageOfficeCtrl->addCustomToolButton("���·�ʽһ", "AddSeal", 2);
    $PageOfficeCtrl->addCustomToolButton("���·�ʽ��", "AddSeal2", 2);
    $PageOfficeCtrl->addCustomToolButton("-","",0);
    $PageOfficeCtrl->addCustomToolButton("ǩ�ַ�ʽһ", "AddSign", 3);
    $PageOfficeCtrl->addCustomToolButton("ǩ�ַ�ʽ��", "AddSign2", 3);
    $PageOfficeCtrl->addCustomToolButton("-", "", 0);
    $PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
	
	//���ñ���ҳ
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, $userName);//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title></title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

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
					<a href="Default.php"> <img alt="����" src="images/return.gif"
							border="0" />���ص�¼ҳ</a>
					<strong>��ǰ�û���</strong>
					<span style="color: Red;"><?php echo $userName;?></span>
					<strong>ӡ�����룺</strong>
					<span style="color: red;">123456</span>
					<br /><br />
					<span style="color: Red; font-size:12px;">�����·�ʽһ����</span>��Ҫ����ӡ���û���������ſ��Ը���<br />
					<span style="color: Red;font-size:12px;">�����·�ʽ������</span>����Ҫ����ӡ���û���������<br />
					<span style="color: Red; font-size:12px;">��ǩ�ַ�ʽһ����</span>��Ҫ�����û���������ſ���ǩ��<br />
					<span style="color: Red;font-size:12px;">��ǩ�ַ�ʽ������</span>����Ҫ�����û���������<br />
				</div>

				<script type="text/javascript">
				//����ҳ��
                function Save() {
                    document.getElementById("PageOfficeCtrl1").WebSave();
                }

                //���ӡ��
                function AddSeal() {
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddSeal("", "");
                }
                //���������û��������룬���ӡ��
                function AddSeal2() {
                    var user = "<?php echo $userName;?>";
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddSeal(user, "");
                }
                //ǩ��
                function AddSign() {
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddHandSign("", "");
                }
                //���������û��������룬ǩ��
                function AddSign2() {
                    var user = "<?php echo $userName;?>";
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddHandSign(user, "");
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
		<div id="footer">
			<hr width="1000" />
			<div>
				Copyright (c) 2012 ����׿��־Զ������޹�˾
			</div>
		</div>

	</body>
</html>

