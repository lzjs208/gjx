<?php
	$id = $_REQUEST["id"];
	$lz = "张三批阅";//流转   
    $fileName="";//文件名称
    $filePath="";
    $status="";//当前流程     
	
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
    
    //***************************卓正PageOffice组件的使用********************************
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$PageOfficeCtrl->setCustomToolbar(false);
	$PageOfficeCtrl->setSaveFilePage("savefile.php");
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$filePath, $OpenMode->docNormalEdit, "张三");//此行必须			  							  
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
            <li><a target="_blank" href="http://www.zhuozhengsoft.com">卓正网站</a></li>
            <li><a target="_blank" href="http://www.zhuozhengsoft.com/poask/index.asp">客户问吧</a></li>
            <li><a href="#">在线帮助</a></li>
            <li><a target="_blank" href="http://www.zhuozhengsoft.com/contact-us.html">联系我们</a></li>
        </ul>
    </div>
    <div id="content">
        <div id="textcontent" style="width: 1000px; height: 800px;">
            <div class="flow4">
                <a href="index.php">
                    <img alt="返回" src="images/return.gif" border="0" />文件列表</a> <span style="width: 100px;">
                    </span><strong>文档名称：</strong> <span style="color: Red;">
                        <span><?php echo $fileName;?></span></span> <span style="width: 100px;">
                        </span><strong>当前流程：</strong> 
                <?php
                	if (strcasecmp($status,"在线编辑")==0){
                ?>         
                        <span style="color: Red;">
                            <span><?php echo $status;?></span></span> <span style="width: 100px;">
                            </span>&nbsp;&nbsp;<strong>流转：</strong>
                <img alt="流转" src="images/arrow2.gif" border="0" />&nbsp;&nbsp;&nbsp;
                <a href="javascript:Lz(<?php echo $id;?>)"><span><?php echo $lz;?></span></a>
                <?php
                	}
                	else{
                ?>
                 	<span style="color: Red;">已流转到“<?php echo $status;?>”，当前是“修改无痕迹模式”打开文件的效果。</span>
                 <?php
                 	}
                 ?>
            </div>
            <!--**************   卓正 PageOffice组件 ************************-->
            <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
        </div>
    </div>
    <div id="footer">
        <hr width="1000" />
        <div>
            Copyright (c) 2012 北京卓正志远软件有限公司</div>
    </div>
    </form>
</body>
</html>
