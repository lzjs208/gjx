<?php
	$user= $_REQUEST["user"];
	$id = $_REQUEST["id"];
	$lz = "";
    
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
	
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$PageOfficeCtrl->setCustomMenuCaption("�Զ���˵�");
    $PageOfficeCtrl->addCustomMenuItem("��ʾ�ۼ�", "ShowRevisions", false);
    $PageOfficeCtrl->addCustomMenuItem("���غۼ�", "HiddenRevisions", false);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("��ʾ����", "ShowTitle", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("�쵼Ȧ��", "StartHandDraw", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("�ֲ���ʾ��д��ע", "ShowHandDrawDispBar", true);

    $PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
    $PageOfficeCtrl->addCustomToolButton("��ʾ�ۼ�", "ShowRevisions", 5);
    $PageOfficeCtrl->addCustomToolButton("���غۼ�", "HiddenRevisions", 5);
    $PageOfficeCtrl->addCustomToolButton("�쵼Ȧ��", "StartHandDraw", 3);
    $PageOfficeCtrl->addCustomToolButton("���������ע", "StartRemark", 3);
    $PageOfficeCtrl->addCustomToolButton("�ֲ���ʾ��д��ע", "ShowHandDrawDispBar", 7);
    $PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
			
	$PageOfficeCtrl->setSaveFilePage("savefile.php");

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$filePath, $OpenMode->docRevisionOnly, $userName);//���б���																  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title></title>
    <link href="images/csstg.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    //������ת
    function Lz(id,flag) {
    	if(flag==0){
    		location.href=encodeURI("index.php?id="+id+"&flg=lspy");
    	}
    	else 
    		location.href=encodeURI("index.php?id="+id+"&flg=wyqg");	
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
					if(strcasecmp($status ,"��������")==0 && strcasecmp($user,"ZhangSan")==0 ){
                ?>           
                        <span style="color: Red;">
                            <span><?php echo $status;?></span></span> <span style="width: 100px;">
                            </span>&nbsp;&nbsp;<strong>��ת��</strong>
                <img alt="��ת" src="images/arrow2.gif" border="0" />&nbsp;&nbsp;&nbsp;
                	<a href="javascript:Lz(<?php echo $id;?>,0)"><span style="color: Red;">��������</span></a>
                <?php
					}else if (strcasecmp($status ,"��������")==0 && strcasecmp($user,"LiSi")==0 ){
                ?>
	                <span style="color: Red;">
	                            <span><?php echo $status;?></span></span> <span style="width: 100px;">
	                            </span>&nbsp;&nbsp;<strong>��ת��</strong>
	                <img alt="��ת" src="images/arrow2.gif" border="0" />&nbsp;&nbsp;&nbsp;
                	<a href="javascript:Lz(<?php echo $id;?>,1)"><span style="color: Red;">��Ա���</span></a>
                <?php	
					}else{
                ?>
                	<span style="color: Red;">
	                            <span>����ת����<?php echo $status;?>������ǰ�ǡ�ǿ������ģʽ�����ļ���Ч����</span>
	                            </span> 

                <?php
					}
                ?>
                <span style="color: Red;"></span>
            </div>
            <!--**************   ׿�� PageOffice��� ************************-->
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }

        //��ʾ�ۼ�
        function ShowRevisions() {
            document.getElementById("PageOfficeCtrl1").ShowRevisions = true;
        }

        //���غۼ�
        function HiddenRevisions() {
            document.getElementById("PageOfficeCtrl1").ShowRevisions = false;
        }
        
        //�쵼Ȧ��ǩ��
        function StartHandDraw() {
            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenWidth(5);
            document.getElementById("PageOfficeCtrl1").HandDraw.Start();
        }
		// ���������ע
        function StartRemark() {
            var appObj = document.getElementById("PageOfficeCtrl1").WordInsertComment();

        }	
        //�ֲ���ʾ��д��ע
        function ShowHandDrawDispBar() {
            document.getElementById("PageOfficeCtrl1").HandDraw.ShowLayerBar(); ;
        }

        //ȫ��/��ԭ
        function IsFullScreen() {
            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
        }

        //��ʾ����
        function ShowTitle() {
            document.getElementById("PageOfficeCtrl1").Alert("�ò˵��ı����ǣ�" + document.getElementById("PageOfficeCtrl1").Caption);
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
