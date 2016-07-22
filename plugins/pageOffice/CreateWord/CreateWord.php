<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���

    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//���ع�����
	$PageOfficeCtrl->setCustomToolbar(false);

	$PageOfficeCtrl->setJsFunction_BeforeDocumentSaved("BeforeDocumentSaved()");

	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveFilePage("SaveNewFile.php");
	
	$PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���	
	$documentVersion = new Java("com.zhuozhengsoft.pageoffice.DocumentVersion");
	//�½�Word�ļ���webCreateNew�����е����������ֱ�ָ���������ˡ��͡��½�Word�ĵ��İ汾�š�
	$PageOfficeCtrl->webCreateNew("������",$documentVersion->Word2003);
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
			            alert('����ɹ���');
			            location.href = "word-lists.php";
		            }else{
		            	alert('����ʧ�ܣ�');
		            }
		        }
		
		        function Cancel() {
		            window.close();
		        }
		
		        function getFocus() {
		            var str = document.getElementById("FileSubject").value;
		            if (str == "�������ĵ�����") {
		                document.getElementById("FileSubject").value = "";
		            }
		        }
		        function lostFocus() {
		            var str = document.getElementById("FileSubject").value;
		            if (str.length <= 0) {
		                document.getElementById("FileSubject").value = "�������ĵ�����";
		            }
		        }
				function BeforeDocumentSaved() {
					var str = document.getElementById("FileSubject").value;
					if (str.length <= 0) {
						document.getElementById("PageOfficeCtrl1").Alert("�������ĵ�����");
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
						<a href="#">׿����վ</a>
					</li>
					<li>
						<a href="#">�ͻ��ʰ�</a>
					</li>
					<li>
						<a href="#">���߰���</a>
					</li>
					<li>
						<a href="#">��ϵ����</a>
					</li>
				</ul>
			</div>
			<div id="content">
				<div id="textcontent" style="width: 1000px; height: 800px;">
					<div class="flow4">
						<span style="width: 100px;"> &nbsp; </span>
					</div>
					<div>
						�ĵ����⣺
						<input name="FileSubject" id="FileSubject" type="text"
							onfocus="getFocus()" onblur="lostFocus()" class="boder"
							style="width: 180px;" value="�������ĵ�����" />
						<input type="button" onclick="Save()" value="����" />
						<input type="button" onclick="Cancel()" value="ȡ��" />
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
					Copyright (c) 2012 ����׿��־Զ������޹�˾
				</div>
			</div>
		</form>
	</body>
</html>
