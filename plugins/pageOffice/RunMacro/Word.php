<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��

	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//�����Զ��幤����
	$PageOfficeCtrl->setCustomToolbar(false);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>ִ�к�����</title>

    <script language="javascript" type="text/javascript">
// <!CDATA[

        function Button1_onclick() {
            document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", document.getElementById("textarea1").value);
        }

// ]]>
    </script>
</head>
<body>
    <form id="form1">
    <div style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc;
        padding: 5px;">
        ע�⣺<span style="background-color: Yellow;">ִ�С�ִ�к�myfunc����ť֮ǰ�������ú�MS Word�Ĺ���ִ�к���������á�
        <br />���ò������£���һ��Word�ĵ���������ļ�������ѡ������������ġ����������������á����������á�����ѡ�ϡ����ζ�VBA���̶���ģ�͵ķ��ʣ�V����</span>
    </div>
    <textarea id="textarea1" name="textarea1" style=" height:87px; width:486px;" rows="" cols="" >
sub myfunc()  
    msgbox "123" 
end sub
    </textarea>
    <input id="Button1" type="button" value="ִ�к�myfunc" onclick="return Button1_onclick()" />
    <div style=" height:800px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>

