<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����

	$dataReg = $doc->openDataRegion("PO_deptName");
	$color = new Java("java.awt.Color");
	$dataReg->getShading()->setBackgroundPatternColor($color->pink);
	//$dataReg->setEditing(true);
    $PageOfficeCtrl->setWriter($doc);
	
	//���÷�����ҳ��
	$PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
	$PageOfficeCtrl->setJsFunction_OnWordDataRegionClick("OnWordDataRegionClick()");
	$PageOfficeCtrl->setOfficeToolbars(false);
	$PageOfficeCtrl->setCaption("Ϊ�����û�֪����Щ�ط����Ա༭��������������������ı���ɫ");
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");

    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>��Ӧ����������</title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

		
		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">
				<script type="text/javascript">
	//***********************************PageOffice������õ�js����**************************************
	//����ҳ��
	function Save() {
		document.getElementById("PageOfficeCtrl1").WebSave();
	}

	//ȫ��/��ԭ
	function IsFullScreen() {
		document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
	}

	function OnWordDataRegionClick(Name, Value, Left, Bottom) {
		
        if (Name == "PO_deptName") {
            var strRet = document.getElementById("PageOfficeCtrl1").ShowHtmlModalDialog("HTMLPage.htm", Value, "left=" + Left + "px;top=" + Bottom + "px;width=400px;height=300px;frame=no;");
            if (strRet != "") {
                return (strRet);
            }
            else {
                if ((Value == undefined) || (Value == ""))
                    return " ";
                else
                    return Value;
            }
        }
    }

	//***********************************PageOffice������õ�js����**************************************
</script>

				<!--**************   ׿�� PageOffice��� ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>


	</body>
</html>
