<?php 
	$url=realpath(dirname($_SERVER["SCRIPT_FILENAME"]))."\\doc\\";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>����word�ļ�</title>

    <script type="text/javascript">
        window.myFunc = function() {
            document.getElementById("aDiv").style.display = "";
            //alert('ת����ϣ�');
        };

        //ת�����
        function ConvertFiles() {
            //ҳ����ˢ��
            document.getElementById("iframe1").src = "FileMakerSingle.php";
        }
    </script>

</head>
<body>
    <form id="form1">
    <div style="text-align: center;">
        <br />
        <span style="color: Red; font-size: 12px;">��ʾ����������䵽ģ����������ʽ��word�ļ����������İ�ť����ת��</span><br />
        <input id="Button1" type="button" value="ת��Word�ļ�" onclick="ConvertFiles()" />
        <div id="aDiv" style="display: none; color: Red; font-size: 12px;">
            <span>ת����ɣ���������ĵ�ַ�д��ļ���Ϊ��maker.doc����Word�ļ����鿴ת����Ч����<?php echo $url;?></span>
        </div>
    </div>
    <div style="width: 1px; height: 1px; overflow: hidden;">
        <iframe id="iframe1" name="iframe1" src=""></iframe>
    </div>
    </form>
</body>
</html>