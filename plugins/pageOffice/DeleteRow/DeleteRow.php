<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	$PageOfficeCtrl->addCustomToolButton("ɾ����","DeleteRow()",1);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/deleteWord.doc", $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>ɾ�����������</title>

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
		<!-- ***************************PageOffice����ͻ���Js����******************************** -->
	<script type="text/javascript">
    //ɾ��word����й��������
//        function DeleteRow() {
//            var appObj = document.getElementById("PageOfficeCtrl1").Document.Application;

//            appObj.Selection.HomeKey(10);
//            appObj.Selection.EndKey(10, true);
//            appObj.Selection.Cells.Delete(2);
//            appObj.Selection.TypeBackspace();
        //        }
        //ɾ��word����й�������У�����������¾���ʹ��
        function DeleteRow() {
            var mac = "Function myfunc()" + " \r\n"
                    + "Application.Selection.HomeKey Unit:=wdLine " + " \r\n"
                    + "Application.Selection.EndKey Unit:=wdLine, Extend:=true " + " \r\n"
                    + "Application.Selection.Cells.Delete ShiftCells:=wdDeleteCellsEntireRow " + " \r\n" 
                    + "Application.Selection.TypeBackspace " + " \r\n" 
                    + "End Function " + " \r\n";
            document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", mac);
        } 
	</script>
		<div style="width:auto; height:700px; ">
		<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
		
	</body>
</html>
