<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//����Զ��尴ť
	//$PageOfficeCtrl->addCustomToolButton("����","Save",1);
	//���ñ���ҳ��
	//$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "������");//���б���
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>js��ȡ������Excel�ļ��е�Ԫ���ֵ</title>
</head>
<body>
    <script type="text/javascript">
        function setCellValue(sheet, cell, value) {
            var sMac = "function myfunc()" + "\r\n"
                        + "Application.Sheets(\"" + sheet + "\").Range(\"" + cell + "\").Value = \"" + value + "\" \r\n"
                        + "End function";
            return document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", sMac);
        }
        function getCellValue(sheet, cell) {
            var sMac = "function myfunc()" + "\r\n"
                        + "myfunc = Application.Sheets(\"" + sheet + "\").Range(\"" + cell + "\").Text \r\n"
                        + "End function";
            return document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", sMac);
        }
        function Button1_onclick() {
            document.getElementById("PageOfficeCtrl1").Alert(getCellValue("Sheet1", "B4"));
        }
        function Button2_onclick() {
            setCellValue("Sheet1", "C4", "100");
        }
    </script>
    <div style="font-size:12px; line-height:20px; border-bottom:dotted 1px #ccc;border-top:dotted 1px #ccc; padding:5px;">
     <span style="color:red;">����˵����</span>������ť��
        <input id="Button1" type="button" value="��ȡSheet1��B4��Ԫ���ֵ" onclick="return Button1_onclick()" />
        <input id="Button2" type="button" value="����Sheet1��C4��Ԫ���ֵΪ��100" onclick="return Button2_onclick()" />
     <br />
   
    �ؼ����룺���Ҽ���ѡ�񡰲鿴Դ�ļ�������js����<span style="background-color:Yellow;">getCellValue(sheet, cell)&nbsp;&nbsp; setCellValue(sheet, cell, value)</span></div><br />
    
    <form id="form1">
    <div style=" width:100%; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>


