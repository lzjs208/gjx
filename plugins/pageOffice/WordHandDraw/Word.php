<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����","Save()",1);
	$PageOfficeCtrl->addCustomToolButton("��ʼ��д", "StartHandDraw()", 5);
	$PageOfficeCtrl->addCustomToolButton("�����߿�", "SetPenWidth()", 5);
	$PageOfficeCtrl->addCustomToolButton("������ɫ", "SetPenColor()", 5);
	$PageOfficeCtrl->addCustomToolButton("���ñ���", "SetPenType()", 5);
	$PageOfficeCtrl->addCustomToolButton("��������", "SetPenZoom()", 5);
	$PageOfficeCtrl->addCustomToolButton("������д��", "GetHandDrawList()", 6);

	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>��д��ע�ӿ���ʾ</title>

		<script language="JavaScript">
		//����
		function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
        //��ʼ��д
        function StartHandDraw() {
            document.getElementById("PageOfficeCtrl1").HandDraw.Start();
        }
        //�����߿�
        function SetPenWidth() {
            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenWidth(5);
        }
        //������ɫ
        function SetPenColor() {

            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenColor(5292104);
        }
        //���ñ���
        function SetPenType() {

            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenType(1);
        }
        //��������
        function SetPenZoom() {

            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenZoom(50);
        }
        //�������һ����д
        function UndoHandDraw() {

            document.getElementById("PageOfficeCtrl1").HandDraw.Undo();
        }
        //�˳���д
        function ExitHandDraw() {

            document.getElementById("PageOfficeCtrl1").HandDraw.Exit();
        }
        //������д����
        function GetHandDrawList() {

            var handDrawList = null;
            var handDraw = null;
            handDrawList = document.getElementById("PageOfficeCtrl1").HandDraw;
            handDrawList.Refresh();
            document.getElementById("PageOfficeCtrl1").Alert("���ĵ����� " + handDrawList.Count + " ����д��ʾ��");
            var i = 0; //������0��ʼ
            for (i = 0; i < handDrawList.Count; i++) {
                handDraw = handDrawList.Item(i);
                handDraw.Locate();
                document.getElementById("PageOfficeCtrl1").Alert("��" + handDraw.PageNumber + "ҳ" + ", " + handDraw.UserName + ", " + handDraw.DateTime);
            }
        }
    </script>

	</head>
	<body>
		<div
			style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc; padding: 5px;">
			<span style="color: red;">����˵����</span>������ǰ�����߿���ɫ�����͡����ŵȣ����ȵ���Զ��幤�����ϵ���Ӧ��ť��Ȼ��������ʼ��д����ť������δ�ر���д������ʱ���㡰�������һ����д����ť���ɳ������һ�ε���д��������˳���д����ť�����˳���д�����ɵ㡰�����߿�����������ɫ���Ȱ�ť����д��ע����ɫ���߿�Ƚ����ٴ����á�
			<br />
			�ؼ����룺���Ҽ���ѡ�񡰲鿴Դ�ļ�������js����
			<br />
			<input id="Button3" type="button" value="�����߿�"
				onclick="SetPenWidth()" />
			<input id="Button4" type="button" onclick="SetPenColor()"
				value="������ɫ" />
			<input id="Button1" type="button" value="�������һ����д"
				onclick="UndoHandDraw()" />
			<input id="Button2" type="button" onclick="ExitHandDraw()"
				value="�˳���д" />
			<span style="background-color: Yellow;"></span>
		</div>
		<br />
		<form id="form1">
			<div style="height: 700px; width: auto;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
