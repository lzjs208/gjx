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
	$PageOfficeCtrl->addCustomToolButton("�ڵ�ǰ��괦��js���볬����","addHyperLink",5);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>��ʾ���ڵ�ǰ��괦��js���볬����</title>
    <style>
        html,body{height:100%; }
        .main{height:700px; width:auto; }
    </style>
</head>
<body>
    <script type="text/javascript">
//    function  addHyperLink()
//    {
//        var docObj = document.getElementById("PageOfficeCtrl1").Document;
//        docObj.Application.ActiveWindow.View.ShowFieldCodes = false; //��Ҫ����������ʽ��ʾ������
//	    docObj.Hyperlinks.Add(docObj.Application.Selection.Range, "http://www.zhuozhengsoft.com/", "", "", "׿��");
//	}

    function  addHyperLink()
    {
        var text = "׿��־Զ";
        var url = "http://www.zhuozhengsoft.com/";
        
        var mac = "Function myfunc()" + " \r\n"
                    + "  Application.ActiveWindow.View.ShowFieldCodes = False " + " \r\n"
                    + "  ActiveDocument.Hyperlinks.Add Anchor:=Selection.Range, Address:= _" + " \r\n"
                    + "   \"" + url + "\", SubAddress:=\"\", ScreenTip:=\"\", _ " + " \r\n" 
                    + "   TextToDisplay:=\""+text+"\" " + " \r\n" 
                    + "End Function " + " \r\n";
        document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", mac);
	}    
    </script>
    <div style="font-size:12px; line-height:20px; border-bottom:dotted 1px #ccc;border-top:dotted 1px #ccc; padding:5px;">
     <span style="color:red;">����˵����</span>��λword�ļ��еĹ�굽����볬���ӵ�λ�ã�Ȼ��㡰���볬������ť��<br />
   
    �ؼ����룺���Ҽ���ѡ�񡰲鿴Դ�ļ�������js����<span style="background-color:Yellow;">addHyperLink()</span></div><br />
    <form id="form1" style="height:100%;">
    <div class="main">
    <!--**************   PageOffice �ͻ��˴��뿪ʼ    ************************-->
		<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?> 
    <!--**************   PageOffice �ͻ��˴������    ************************-->
    </div>
    </form>
</body>
</html>
