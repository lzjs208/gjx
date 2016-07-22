<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("加盖印章", "InsertSeal()", 2);
    $PageOfficeCtrl->addCustomToolButton("签字", "AddHandSign()", 3);
    $PageOfficeCtrl->addCustomToolButton("验证印章", "VerifySeal()", 5);
    $PageOfficeCtrl->addCustomToolButton("修改密码", "ChangePsw()", 0);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>插入印章</title>
    
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">    
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
	<meta http-equiv="description" content="This is my page">
	<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->

  </head>
  
  <body>
  <div style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc;
        padding: 5px;">
        <span style="color: red;">操作说明：</span>点“插入印章”按钮即可，插入印章时的用户名为：李志，密码默认为：111111。<br />
        关键代码：点右键，选择“查看源文件”，看js函数<span style="background-color: Yellow;">InsertSeal()</span>
        <p>点击 <a href="http://<?php echo $ip;?>:8080/JavaBridge/adminseal.do">电子印章简易管理平台</a> 添加、删除印章。管理员:admin 密码:111111</p>
    </div>
    <br />
   <div style=" width:auto; height:700px;">
   <!-- *********************************PageOffice组件的使用************************************ -->
   <script type="text/javascript">
            function InsertSeal() {
                try {
                    document.getElementById("PageOfficeCtrl1").ZoomSeal.AddSeal();
                }
                catch (e) { }
            }
            function AddHandSign() {
                document.getElementById("PageOfficeCtrl1").ZoomSeal.AddHandSign();
            }
            function VerifySeal() {
                document.getElementById("PageOfficeCtrl1").ZoomSeal.VerifySeal();
            }
            function ChangePsw() {
                document.getElementById("PageOfficeCtrl1").ZoomSeal.ShowSettingsBox();
            }
    </script>
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
     <!-- *********************************PageOffice组件的使用************************************ -->
    </div>
  </body>
</html>
