<?php
	$id = $_REQUEST["id"];
	$flg = $_REQUEST["flg"];
	$lz = "��ʽ����";   
    $fileName="";//�ļ�����
    $filePath="";
    $status="";//��ǰ����  

	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	   
	$query = "select * from word where id=".$id;
	$rs = $conn->Execute($query); 		

	if(!$rs->EOF){
		$filePath=$rs->Fields["FileName"]->value;
		$fileName=$rs->Fields["Subject"]->value;
		$status=$rs->Fields["Status"]->value;
	}	
	//*****************************׿��PageOffice�����ʹ��****************************
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$PageOfficeCtrl->setCaption($fileName);
	$PageOfficeCtrl->addCustomToolButton("��浽����", "ShowDialog(0)", 5);
    $PageOfficeCtrl->addCustomToolButton("ҳ������", "ShowDialog(1)", 0);
    $PageOfficeCtrl->addCustomToolButton("��ӡ", "ShowDialog(2)", 6);
    $PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
			
	$PageOfficeCtrl->setMenubar(false);
	$PageOfficeCtrl->setOfficeToolbars(false);
	
	$PageOfficeCtrl->setSaveFilePage("savefile.php");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$filePath, $OpenMode->docReadOnly, "����");//���б���								  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title></title>
    <link href="images/csstg.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">

    </script>
</head>
<body> 
    <form id="form2">
    <div id="header">
        <div style="float: left; margin-left: 20px;">
            <img src="images/logo.jpg" height="30" /></div>
        <ul>
            <li><a target="_blank" href="http://www.zhuozhengsoft.com">׿����վ</a></li>
            <li><a target="_blank" href="http://www.zhuozhengsoft.com/poask/index.asp">�ͻ��ʰ�</a></li>
            <li><a href="#">���߰���</a></li>
            <li><a target="_blank" href="http://www.zhuozhengsoft.com/contact-us.html">��ϵ����</a></li>
        </ul>
    </div>
    <div id="content">
        <div id="textcontent" style="width: 1000px; height: 800px;">
            <div class="flow4">
                <a href="index.jsp">
                    <img alt="����" src="images/return.gif" border="0" />�ļ��б�</a> <span style="width: 100px;">
                    </span><strong>�ĵ����ƣ�</strong> <span style="color: Red;">
                        <span><?php echo $fileName;?></span></span> <span style="width: 100px;">
                        </span><strong>��ǰ���̣�</strong> 
                <?php 
                	if (status.equals("��ʽ����")){
                ?> 
                        <span style="color: Red;">
                            <span><?php echo $status;?></span></span> <span style="width: 100px;"></span>
                <?php 
                	}
                	else{
                ?>     
                <span style="color: Red;">����ת����<?php echo $status;?>������ǰ�ǡ�ֻ��ģʽ�����ļ���Ч����</span>
                <?php
                 	}
                ?>      
          
            </div>
            <!--**************   ׿�� PageOffice��� ************************-->
    <script language="javascript">
        function ShowDialog(index) {
            if (index == 0) document.getElementById("PageOfficeCtrl1").ShowDialog(2);
            if (index == 1) document.getElementById("PageOfficeCtrl1").ShowDialog(5);
            if (index == 2) document.getElementById("PageOfficeCtrl1").ShowDialog(4);
        }
    
    //ȫ��/��ԭ
        function IsFullScreen() {
            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
        }
    </script>
             <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
        </div>
    </div>
    <div id="footer">
        <hr width="1000" />
        <div>
            Copyright (c) 2012 ����׿��־Զ������޹�˾</div>
    </div>
    </form>
</body>
</html>
