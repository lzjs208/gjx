<?php
	$flg= $_REQUEST["flg"];
	$id = $_REQUEST["id"];
	$lz = "��ʽ����";    
    $fileName="";//�ļ�����
    $filePath="";
    $status="";//��ǰ����     
    $userName="";
	
    if(strcasecmp($user,"ZhangSan")==0) $userName = "����";
    if(strcasecmp($user,"LiSi")==0) $userName = "����";
    
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
	
	//*****************************׿��PageOffice�����ʹ��***********************************
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
			
	$PageOfficeCtrl->setCustomMenuCaption("�Զ���˵�");
    $PageOfficeCtrl->addCustomMenuItem("��ʾ�ۼ�", "ShowRevisions", true);
    $PageOfficeCtrl->addCustomMenuItem("���غۼ�", "HiddenRevisions", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("��ʾ����", "ShowTitle", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("�쵼ǩ��", "InsertHandSign", true);
    $PageOfficeCtrl->addCustomMenuItem("����ӡ��", "InsertSeal", true);
    $PageOfficeCtrl->addCustomMenuItem("���������޶�", "AcceptAllRevisions", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("�ֲ���ʾ��д��ע", "ShowHandDrawDispBar", true);

    $PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
    $PageOfficeCtrl->addCustomToolButton("���ΪMHT", "SaveAsMHT", 0);
    $PageOfficeCtrl->addCustomToolButton("��ʾ/���غۼ�", "Show_HidRevisions", 5);
    $PageOfficeCtrl->addCustomToolButton("����ӡ��/ǩ��", "InsertSeal", 2);
    $PageOfficeCtrl->addCustomToolButton("�쵼ǩ��", "InsertHandSign", 3);
    $PageOfficeCtrl->addCustomToolButton("���������޶�", "AcceptAllRevisions", 5);
    $PageOfficeCtrl->addCustomToolButton("�ֲ���ʾ��д��ע", "ShowHandDrawDispBar", 7);
    $PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
				
	$PageOfficeCtrl->setSaveFilePage("savefile.php");

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$filePath, $OpenMode->docAdmin, "������");//���б���	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title></title>
    <link href="images/csstg.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    	function Lz(id){
    		location.href=encodeURI("index.php?id="+id+"&flg=zsfw");
    	}
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
                <a href="index.php">
                    <img alt="����" src="images/return.gif" border="0" />�ļ��б�</a> <span style="width: 100px;">
                    </span><strong>�ĵ����ƣ�</strong> <span style="color: Red;">
                        <span><?php echo $fileName;?></span></span> <span style="width: 100px;">
                        </span><strong>��ǰ���̣�</strong> 
                <?php 
                	if (strcasecmp($status,"��Ա���")==0){
                ?>        
                        <span style="color: Red;">
                            <span><?php echo $status;?></span></span> <span style="width: 100px;">
                            </span>&nbsp;&nbsp;<strong>��ת��</strong>
                <img alt="��ת" src="images/arrow2.gif" border="0" />&nbsp;&nbsp;&nbsp;
                <a href="javascript:Lz(<?php echo $id;?>)"><span><?php echo $lz;?></span></a>
                <?php
                	}
                	else{
                ?>
                 	<span style="color: Red;">����ת����<?php echo $status;?>������ǰ�ǡ��˸�ģʽ�����ļ���Ч����</span>
                <?php
                 	}
                ?>
            </div>
            <!--**************   ׿�� PageOffice��� ************************-->
    <script type="text/javascript">

        // $ = function(id) { return (typeof (id) == 'object') ? id : document.getElementById(id); };
        //        function Save() {
        //            $("PageOfficeCtrl1").WebSave();
        //        }

        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }

        function ShowRevisions() {
            document.getElementById("PageOfficeCtrl1").ShowRevisions = true;
        }
        function HiddenRevisions() {
            document.getElementById("PageOfficeCtrl1").ShowRevisions = false;
        }
        function Show_HidRevisions() {
            document.getElementById("PageOfficeCtrl1").ShowRevisions = !document.getElementById("PageOfficeCtrl1").ShowRevisions;
        }

        //�쵼Ȧ��ǩ��
        function StartHandDraw() {
            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenWidth(5);
            document.getElementById("PageOfficeCtrl1").HandDraw.Start();
        }

        //���������޶�
        function AcceptAllRevisions() {
            document.getElementById("PageOfficeCtrl1").AcceptAllRevisions();
        }

        //�ֲ���ʾ��д��ע
        function ShowHandDrawDispBar() {
            document.getElementById("PageOfficeCtrl1").HandDraw.ShowLayerBar();
        }

        //ȫ��/��ԭ
        function IsFullScreen() {
            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
        }

        //��ʾ�˵�
        function ShowTitle() {
            document.getElementById("PageOfficeCtrl1").Alert("�ò˵��ı����ǣ�" + document.getElementById("PageOfficeCtrl1").Caption);
        }

        //�������ӡ��
        function InsertSeal() {
            //alert("��ʹ�ô��û���ӡ�²���\r\n�û�������־ \r\n��ʼ���룺111111");

            var zoomseal = document.getElementById("PageOfficeCtrl1").ZoomSeal;
            if (zoomseal != null)
                zoomseal.AddSeal();


        }
        // ǩ��
        function InsertHandSign() {
            //alert("��ʹ�ô��û�����\r\n�û�������־ \r\n��ʼ���룺111111");

            var zoomseal = document.getElementById("PageOfficeCtrl1").ZoomSeal;
            if (zoomseal != null)
                zoomseal.AddHandSign();
        }

        //�ĵ����ΪMHT����������web������
        function SaveAsMHT() {
            document.getElementById("PageOfficeCtrl1").WebSaveAsMHT();
            window.open("htmldoc.php?type=word&id=<?php echo $id;?>");
        }
      
    </script>
		<div style="font-weight:bold; font-size:14px;"> ���Ը��¹��ܣ��û�����<span style=" color:Red">��־</span> ���룺<span style=" color:Red">111111</span></div>
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
