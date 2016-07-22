<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$doc->getTemplate()->defineDataTag("{ �׷� }");
	$doc->getTemplate()->defineDataTag("{ �ҷ� }");
	$doc->getTemplate()->defineDataTag("{ ������ }");
	$doc->getTemplate()->defineDataTag("�� ��ͬ���� ��");
	$doc->getTemplate()->defineDataTag("�� ��ͬ��� ��");
	
	$PageOfficeCtrl->addCustomToolButton("����", "Save()", 1);
    $PageOfficeCtrl->addCustomToolButton("�������ݱ�ǩ", "ShowDefineDataTags()", 20);

    $PageOfficeCtrl->setSaveFilePage("SaveFile.php");

	$themeType = new Java("com.zhuozhengsoft.pageoffice.ThemeType");
    $PageOfficeCtrl->setTheme($themeType->Office2007);
	$borderStyleType = new Java("com.zhuozhengsoft.pageoffice.BorderStyleType");
    $PageOfficeCtrl->setBorderStyle($borderStyleType->BorderThin);
	
    $PageOfficeCtrl->setWriter($doc);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>�༭ģ�������ݱ�ǩ</title>
	<script type="text/javascript">
        //��ȡ��̨�����Tag �ַ���
        function getTagNames() {
            var tagNames = document.getElementById("PageOfficeCtrl1").DefineTagNames;
            return tagNames;
        }
        
        //��λTag
        function locateTag(tagName) {
            
            var appSlt = document.getElementById("PageOfficeCtrl1").Document.Application.Selection;
            var bFind = false;
            //appSlt.HomeKey(6);
            appSlt.Find.ClearFormatting();
            appSlt.Find.Replacement.ClearFormatting();

            bFind = appSlt.Find.Execute(tagName);
            if (!bFind) {
                document.getElementById("PageOfficeCtrl1").Alert("���������ĵ�ĩβ��");
                appSlt.HomeKey(6);
            }
            window.focus();

        }

        //���Tag
        function addTag(tagName) {
            try {
                var tmpRange = document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Range;
                tmpRange.Text = tagName;
                tmpRange.Select();
                return "true";
            } catch (e) {
                return "false";
            }
        }
        
        //ɾ��Tag
        function delTag(tagName) {
            var tmpRange = document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Range;
            
            if (tagName == tmpRange.Text) {
                tmpRange.Text = "";
                return "true";
            }
            else
                return "false";

        }
   
    </script>
    
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
        function ShowDefineDataTags() {
            document.getElementById("PageOfficeCtrl1").ShowHtmlModelessDialog("DataTagDlg.htm", "parameter=xx", "left=300px;top=390px;width=430px;height=410px;frame:no;");

        }

    </script>
   

</head>
<body>
    <form action="">
    <div style="width: auto; height: 600px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>