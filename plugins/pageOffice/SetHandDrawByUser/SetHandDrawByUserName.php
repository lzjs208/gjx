<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$userName=$_REQUEST["userName"];

    if (strcasecmp($userName,"zhangsan")==0) $userName = "����";
    if (strcasecmp($userName,"lisi")==0) $userName = "����";
    if (strcasecmp($userName,"wangwu")==0) $userName = "����";
	$PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
	$PageOfficeCtrl->addCustomToolButton("�쵼Ȧ��", "StartHandDraw", 3);
	$PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
    $PageOfficeCtrl->setJsFunction_AfterDocumentOpened("ShowByUserName");
    $PageOfficeCtrl->setSaveFilePage("SaveFile.php");
		
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, $userName);//���б���
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
					<span style=""> </span><strong>��ǰ�û���</strong>
					<span style="color: Red;"><?php echo $userName;?></span>
				</div>

				<script type="text/javascript">
	                //����ҳ��
	                function Save() {
	                    document.getElementById("PageOfficeCtrl1").WebSave();
	                }
	
	                //�쵼Ȧ��ǩ��
	                function StartHandDraw() {
	                    document.getElementById("PageOfficeCtrl1").HandDraw.Start();
	                }
	                
	                /*
	                //�ֲ���ʾ��д��ע
	                function ShowHandDrawDispBar() {
	                    document.getElementById("PageOfficeCtrl1").HandDraw.ShowLayerBar(); ;
	                }*/
	
	                //ȫ��/��ԭ
	                function IsFullScreen() {
	                    document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
	                }
	
	                //��ʾ/�����û�����д��ע
	                function ShowByUserName() {
	                    var userName = "<?php echo $userName;?>"; //�Ӻ�̨��ȡ��¼�û���
	                    document.getElementById("PageOfficeCtrl1").HandDraw.ShowByUserName(null, false); // �������е���д
	                    document.getElementById("PageOfficeCtrl1").HandDraw.ShowByUserName(userName); // ��ʾTom����д���ڶ�������Ϊtrueʱ��ʡ��
	                }
	
	            </script>

				<!--**************   ׿�� PageOffice��� ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>

	</body>
</html>