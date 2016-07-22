<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$doc->getTemplate()->defineDataRegion("Name", "[ ���� ]");
	$doc->getTemplate()->defineDataRegion("Address", "[ ��ַ ]");
	$doc->getTemplate()->defineDataRegion("Tel", "[ �绰 ]");
	$doc->getTemplate()->defineDataRegion("Phone", "[ �ֻ� ]");
	$doc->getTemplate()->defineDataRegion("Sex", "[ �Ա� ]");
	$doc->getTemplate()->defineDataRegion("Age", "[ ���� ]");
	$doc->getTemplate()->defineDataRegion("Email", "[ ���� ]");
	$doc->getTemplate()->defineDataRegion("QQNo", "[ QQ�� ]");
	$doc->getTemplate()->defineDataRegion("MSNNo", "[ MSN�� ]");

	$PageOfficeCtrl->addCustomToolButton("����", "Save()", 1);
	$PageOfficeCtrl->addCustomToolButton("������������", "ShowDefineDataRegions()", 3);

	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");

	$themeType = new  Java("com.zhuozhengsoft.pageoffice.ThemeType");
	$borderStyleType = new  Java("com.zhuozhengsoft.pageoffice.BorderStyleType");
	$PageOfficeCtrl->setTheme($themeType->Office2007);
	$PageOfficeCtrl->setBorderStyle($borderStyleType->BorderThin);
	
	$PageOfficeCtrl->setWriter($doc);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "zhangsan");//���б���
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>�༭ģ������������</title>
	<script type="text/javascript">
        //��ȡ��̨��ӵ���ǩ�����ַ���
        function getBkNames() {
            var bkNames = document.getElementById("PageOfficeCtrl1").DataRegionList.DefineNames;
            return bkNames;
        }

        //��ȡ��̨��ӵ���ǩ�ı��ַ���
        function getBkConts() {
            var bkConts = document.getElementById("PageOfficeCtrl1").DataRegionList.DefineCaptions;
            return bkConts;
        }

        //��λ��ǩ
        function locateBK(bkName) {
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            drlist.GetDataRegionByName(bkName).Locate();
            document.getElementById("PageOfficeCtrl1").Activate();
            window.focus();
        }

        //�����ǩ
        function addBookMark(param) {
            var tmpArr = param.split("=");
            var bkName = tmpArr[0];
            var content = tmpArr[1];
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            drlist.Refresh();
            try {
                document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Collapse(0);
                drlist.Add(bkName, content);
                return "true";
            } catch (e) {
                return "false";
            }
        }
        //ɾ����ǩ
        function delBookMark(bkName) {
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            try {
                drlist.Delete(bkName);
                return "true";
            } catch (e) {
                return "false";
            }
        }

        //������ǰWord���Ѵ��ڵ���ǩ����
        function checkBkNames() {
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            drlist.Refresh();
            var bkName = "";
            var bkNames = "";
            for (var i = 0; i < drlist.Count; i++) {
                bkName = drlist.Item(i).Name;
                bkNames += bkName.substr(3) + ",";
            }
            return bkNames.substr(0, bkNames.length - 1);
        }

        //������ǰWord���Ѵ��ڵ���ǩ�ı�
        function checkBkConts() {
            var drlist = document.getElementById("PageOfficeCtrl1").DataRegionList;
            drlist.Refresh();
            var bkCont = "";
            var bkConts = "";
            for (var i = 0; i < drlist.Count; i++) {
                bkCont = drlist.Item(i).Value;
                bkConts += bkCont + ",";
            }
            return bkConts.substr(0, bkConts.length - 1);
        }
    </script>
    
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
        function ShowDefineDataRegions() {
            document.getElementById("PageOfficeCtrl1").ShowHtmlModelessDialog("DataRegionDlg.htm", "parameter=xx", "left=300px;top=390px;width=520px;height=410px;frame:no;");

        }

    </script>
   

</head>
<body>
    <form action="">
    <div style="width: 1000px; height: 800px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>