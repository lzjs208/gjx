<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须

    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//隐藏工具栏
	$PageOfficeCtrl->setCustomToolbar(false);

	$PageOfficeCtrl->setJsFunction_BeforeDocumentSaved("BeforeDocumentSaved()");

	//设置保存页面
	$PageOfficeCtrl->setSaveFilePage("SaveNewFile.php");
	
	$PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加	
	$documentVersion = new Java("com.zhuozhengsoft.pageoffice.DocumentVersion");
	//新建Word文件，webCreateNew方法中的两个参数分别指代“操作人”和“新建Word文档的版本号”
	$PageOfficeCtrl->webCreateNew("张佚名",$documentVersion->Word2003);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title></title>
		<link href="../images/csstg.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		        function Save() {
		            document.getElementById("PageOfficeCtrl1").WebSave();
		            if(document.getElementById("PageOfficeCtrl1").CustomSaveResult=="ok"){
			            alert('保存成功！');
			            location.href = "word-lists.php";
		            }else{
		            	alert('保存失败！');
		            }
		        }
		
		        function Cancel() {
		            window.close();
		        }
		
		        function getFocus() {
		            var str = document.getElementById("FileSubject").value;
		            if (str == "请输入文档主题") {
		                document.getElementById("FileSubject").value = "";
		            }
		        }
		        function lostFocus() {
		            var str = document.getElementById("FileSubject").value;
		            if (str.length <= 0) {
		                document.getElementById("FileSubject").value = "请输入文档主题";
		            }
		        }
				function BeforeDocumentSaved() {
					var str = document.getElementById("FileSubject").value;
					if (str.length <= 0) {
						document.getElementById("PageOfficeCtrl1").Alert("请输入文档主题");
						return false
					}
					else
						return true;
				}
		    </script>
	</head>
	<body>
		<form id="form2" action="CreateWord.aspx">
			<div id="header">
				<div style="float: left; margin-left: 20px;">
					<img src="../images/logo.jpg" height="30" />
				</div>
				<ul>
					<li>
						<a href="#">卓正网站</a>
					</li>
					<li>
						<a href="#">客户问吧</a>
					</li>
					<li>
						<a href="#">在线帮助</a>
					</li>
					<li>
						<a href="#">联系我们</a>
					</li>
				</ul>
			</div>
			<div id="content">
				<div id="textcontent" style="width: 1000px; height: 800px;">
					<div class="flow4">
						<span style="width: 100px;"> &nbsp; </span>
					</div>
					<div>
						文档主题：
						<input name="FileSubject" id="FileSubject" type="text"
							onfocus="getFocus()" onblur="lostFocus()" class="boder"
							style="width: 180px;" value="请输入文档主题" />
						<input type="button" onclick="Save()" value="保存" />
						<input type="button" onclick="Cancel()" value="取消" />
					</div>
					<div>
						&nbsp;
					</div>
					<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
				</div>
			</div>
			<div id="footer">
				<hr width="1000px;" />
				<div>
					Copyright (c) 2012 北京卓正志远软件有限公司
				</div>
			</div>
		</form>
	</body>
</html>
