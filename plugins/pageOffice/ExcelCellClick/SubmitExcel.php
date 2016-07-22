<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	$PageOfficeCtrl->setCaption("�򵥵ĸ�Excel��ֵ");	
	$sheet = $workbook->openSheet("Sheet1");//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	//����table��������table��������÷�Χ
	$table = $sheet->openTable("B4:D8");
	//����table������ύ���ƣ��Ա㱣��ҳ���ȡ�ύ������
	$table->setSubmitName("Info");

	// ������Ӧ��Ԫ�����¼���js function
    $PageOfficeCtrl->setJsFunction_OnExcelCellClick("OnCellClick()");
    
	$PageOfficeCtrl->setWriter($workbook);
	
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveDataPage("SaveData.php");

	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsSubmitForm, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>��ӦExcel��Ԫ�����¼�</title>
		<script type="text/javascript">
			function Save() {
				document.getElementById("PageOfficeCtrl1").WebSave();
			}
			
			function OnCellClick(Celladdress, value, left, bottom) {
		            var i = 0;
		            while (i<5) {//����һ�е�5����Ԫ�񶼵���ѡ��Ի���
		                if (Celladdress == "$B$" + (4 + i)) {
		                    var strRet = document.getElementById("PageOfficeCtrl1").ShowHtmlModalDialog("select.php", "", "left=" + left + "px;top=" + bottom + "px;width=320px;height=230px;frame=no;");
		                    if (strRet != "") {
		                        return (strRet);
		                    }
		                    else {
		                        if ((value == undefined) || (value == ""))
		                            return " ";
		                        else
		                            return value;
		                    }
		                }
		                i++;
		            }
		        }
		</script>
	</head>
	<body>
		<form id="form1">
			��ʾ�����Excel��Ԫ�񵯳��Զ���Ի����Ч�����뿴ʵ���������еġ��������ơ�ֻ��ѡ���Ч����<br /><br />
			<div style="width: auto; height: 700px;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
