<?php
	$id = $_REQUEST["id"];
	$lz = "��������";//��ת   
    $fileName="";//�ļ�����
    $filePath="";
    $status="";//��ǰ����     
	
    if(isset($id) && !empty($id) && strlen(trim($id))>0){
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

		$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
		if(!file_exists($filepath."\\doc\\".$filePath)){
			$fileName="";
			$status="";
			$lz="";
		}
									
    }else{
		header("Location:index.php");
    }  
    
    //***************************׿��PageOffice�����ʹ��********************************
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$PageOfficeCtrl->setCustomToolbar(false);
	$PageOfficeCtrl->setSaveFilePage("savefile.php");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$filePath, $OpenMode->docNormalEdit, "����");//���б���			  							  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="images/csstg.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    function Lz(id) {
    	location.href=encodeURI("index.php?id="+id+"&flg=zspy");
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
                	if (strcasecmp($status,"���߱༭")==0){
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
                 	<span style="color: Red;">����ת����<?php echo $status;?>������ǰ�ǡ��޸��޺ۼ�ģʽ�����ļ���Ч����</span>
                 <?php
                 	}
                 ?>
            </div>
            <!--**************   ׿�� PageOffice��� ************************-->
            <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
        </div>
    </div>
    <div id="footer">
        <hr width="1000" />
        <div>
            Copyright (c) 2012 ����׿��־Զ�������޹�˾</div>
    </div>
    </form>
</body>
</html>