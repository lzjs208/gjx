<?php
	$user= $_REQUEST["user"];
	$id = $_REQUEST["id"];
	$lz = "";
    
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
	
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$PageOfficeCtrl->setCustomMenuCaption("自定义菜单");
    $PageOfficeCtrl->addCustomMenuItem("显示痕迹", "ShowRevisions", false);
    $PageOfficeCtrl->addCustomMenuItem("隐藏痕迹", "HiddenRevisions", false);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("显示标题", "ShowTitle", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("领导圈阅", "StartHandDraw", true);
    $PageOfficeCtrl->addCustomMenuItem("-", "", false);
    $PageOfficeCtrl->addCustomMenuItem("分层显示手写批注", "ShowHandDrawDispBar", true);

    $PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
    $PageOfficeCtrl->addCustomToolButton("显示痕迹", "ShowRevisions", 5);
    $PageOfficeCtrl->addCustomToolButton("隐藏痕迹", "HiddenRevisions", 5);
    $PageOfficeCtrl->addCustomToolButton("领导圈阅", "StartHandDraw", 3);
    $PageOfficeCtrl->addCustomToolButton("插入键盘批注", "StartRemark", 3);
    $PageOfficeCtrl->addCustomToolButton("分层显示手写批注", "ShowHandDrawDispBar", 7);
    $PageOfficeCtrl->addCustomToolButton("全屏/还原", "IsFullScreen", 4);
			
	$PageOfficeCtrl->setSaveFilePage("savefile.php");

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$filePath, $OpenMode->docRevisionOnly, $userName);//此行必须																  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title></title>
    <link href="images/csstg.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    //流程跳转
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
					if(strcasecmp($status ,"张三批阅")==0 && strcasecmp($user,"ZhangSan")==0 ){
                ?>           
                        <span style="color: Red;">
                            <span><?php echo $status;?></span></span> <span style="width: 100px;">
                            </span>&nbsp;&nbsp;<strong>流转：</strong>
                <img alt="流转" src="images/arrow2.gif" border="0" />&nbsp;&nbsp;&nbsp;
                	<a href="javascript:Lz(<?php echo $id;?>,0)"><span style="color: Red;">李四批阅</span></a>
                <?php
					}else if (strcasecmp($status ,"李四批阅")==0 && strcasecmp($user,"LiSi")==0 ){
                ?>
	                <span style="color: Red;">
	                            <span><?php echo $status;?></span></span> <span style="width: 100px;">
	                            </span>&nbsp;&nbsp;<strong>流转：</strong>
	                <img alt="流转" src="images/arrow2.gif" border="0" />&nbsp;&nbsp;&nbsp;
                	<a href="javascript:Lz(<?php echo $id;?>,1)"><span style="color: Red;">文员清稿</span></a>
                <?php	
					}else{
                ?>
                	<span style="color: Red;">
	                            <span>已流转到“<?php echo $status;?>”，当前是“强制留痕模式”打开文件的效果。</span>
	                            </span> 

                <?php
					}
                ?>
                <span style="color: Red;"></span>
            </div>
            <!--**************   卓正 PageOffice组件 ************************-->
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }

        //显示痕迹
        function ShowRevisions() {
            document.getElementById("PageOfficeCtrl1").ShowRevisions = true;
        }

        //隐藏痕迹
        function HiddenRevisions() {
            document.getElementById("PageOfficeCtrl1").ShowRevisions = false;
        }
        
        //领导圈阅签字
        function StartHandDraw() {
            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenWidth(5);
            document.getElementById("PageOfficeCtrl1").HandDraw.Start();
        }
		// 插入键盘批注
        function StartRemark() {
            var appObj = document.getElementById("PageOfficeCtrl1").WordInsertComment();

        }	
        //分层显示手写批注
        function ShowHandDrawDispBar() {
            document.getElementById("PageOfficeCtrl1").HandDraw.ShowLayerBar(); ;
        }

        //全屏/还原
        function IsFullScreen() {
            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
        }

        //显示标题
        function ShowTitle() {
            document.getElementById("PageOfficeCtrl1").Alert("该菜单的标题是：" + document.getElementById("PageOfficeCtrl1").Caption);
        }

  
    </script>
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
