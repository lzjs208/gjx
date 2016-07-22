<?php
	$flg= $_REQUEST["flg"];
	$id = $_REQUEST["id"];
	$lz = "正式发文";    
    $fileName="";//文件名称
    $filePath="";
    $status="";//当前流程     
    $userName="";
	
    if(strcasecmp($user,"ZhangSan")==0) $userName = "张三";
    if(strcasecmp($user,"LiSi")==0) $userName = "李四";
    
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
	
	//*****************************卓正PageOffice组件的使用***********************************
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
			
	$PageOfficeCtrl->setCustomMenuCaption("自定义菜单");
    $PageOfficeCtrl->addCustomMenuItem("显示痕迹", "ShowRevisions", true);
    $PageOfficeCtrl->addCustomMenuItem("隐藏痕迹", "HiddenRevisions", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("显示标题", "ShowTitle", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("领导签批", "InsertHandSign", true);
    $PageOfficeCtrl->addCustomMenuItem("插入印章", "InsertSeal", true);
    $PageOfficeCtrl->addCustomMenuItem("接受所有修订", "AcceptAllRevisions", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("分层显示手写批注", "ShowHandDrawDispBar", true);

    $PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
    $PageOfficeCtrl->addCustomToolButton("另存为MHT", "SaveAsMHT", 0);
    $PageOfficeCtrl->addCustomToolButton("显示/隐藏痕迹", "Show_HidRevisions", 5);
    $PageOfficeCtrl->addCustomToolButton("插入印章/签名", "InsertSeal", 2);
    $PageOfficeCtrl->addCustomToolButton("领导签批", "InsertHandSign", 3);
    $PageOfficeCtrl->addCustomToolButton("接受所有修订", "AcceptAllRevisions", 5);
    $PageOfficeCtrl->addCustomToolButton("分层显示手写批注", "ShowHandDrawDispBar", 7);
    $PageOfficeCtrl->addCustomToolButton("全屏/还原", "IsFullScreen", 4);
				
	$PageOfficeCtrl->setSaveFilePage("savefile.php");

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$filePath, $OpenMode->docAdmin, "张佚名");//此行必须	
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
                	if (strcasecmp($status,"文员清稿")==0){
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
                 	<span style="color: Red;">已流转到“<?php echo $status;?>”，当前是“核稿模式”打开文件的效果。</span>
                <?php
                 	}
                ?>
            </div>
            <!--**************   卓正 PageOffice组件 ************************-->
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

        //领导圈阅签字
        function StartHandDraw() {
            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenWidth(5);
            document.getElementById("PageOfficeCtrl1").HandDraw.Start();
        }

        //接受所有修订
        function AcceptAllRevisions() {
            document.getElementById("PageOfficeCtrl1").AcceptAllRevisions();
        }

        //分层显示手写批注
        function ShowHandDrawDispBar() {
            document.getElementById("PageOfficeCtrl1").HandDraw.ShowLayerBar();
        }

        //全屏/还原
        function IsFullScreen() {
            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
        }

        //显示菜单
        function ShowTitle() {
            document.getElementById("PageOfficeCtrl1").Alert("该菜单的标题是：" + document.getElementById("PageOfficeCtrl1").Caption);
        }

        //插入电子印章
        function InsertSeal() {
            //alert("请使用此用户的印章测试\r\n用户名：李志 \r\n初始密码：111111");

            var zoomseal = document.getElementById("PageOfficeCtrl1").ZoomSeal;
            if (zoomseal != null)
                zoomseal.AddSeal();


        }
        // 签批
        function InsertHandSign() {
            //alert("请使用此用户测试\r\n用户名：李志 \r\n初始密码：111111");

            var zoomseal = document.getElementById("PageOfficeCtrl1").ZoomSeal;
            if (zoomseal != null)
                zoomseal.AddHandSign();
        }

        //文档另存为MHT，并发布到web服务器
        function SaveAsMHT() {
            document.getElementById("PageOfficeCtrl1").WebSaveAsMHT();
            window.open("htmldoc.php?type=word&id=<?php echo $id;?>");
        }
      
    </script>
		<div style="font-weight:bold; font-size:14px;"> 测试盖章功能，用户名：<span style=" color:Red">李志</span> 密码：<span style=" color:Red">111111</span></div>
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
