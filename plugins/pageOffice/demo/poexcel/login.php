<?php

	$userName = $_REQUEST["TextUserName"];
	$pw = $_REQUEST["TextPassword"];
	$tz = $_REQUEST["tz"];

	if (isset($tz) && !empty($tz) && strlen(trim($tz))>0 ){
		if(strcasecmp($tz, "false")==0){
			echo "sssssss";
			echo "name".$userName."==".$pw."**";
			if(isset($userName) && !empty($userName) && (strcasecmp($userName, "admin") == 0) && isset($pw) && !empty($pw) && (strcasecmp($pw, "123") == 0)){
				echo "11111";
				session_start();
				// store session data
				$_SESSION['UserName'] = "admin";
				header("Location:OrderList.php");
			}
			else{
				echo "<script > alert('�û������������".$tz." ');</script>";
			}
		}
	}
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>PageOffice���۹���ϵͳ��¼</title>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <meta content="PageOffice����OFFICE�����΢��OFFICE�ؼ�" name="description"/>
    <meta content="PageOffice,����OFFICE�ؼ�,�ۼ�����,ǿ�ƺۼ�����,ȫ����ע,��д��ע,OFFICE�ĵ�,����ӡ��,��дǩ��,word����,����,��������,���߱༭,���߱���,�칫�Զ���,OA,����ǩ��,����ǩ��,�ֹ���ע,��ӡԤ��"
        name="keywords"/>
    <meta name="vs_defaultClientScript" content="JavaScript"/>
    <meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5"/>
    <link rel="stylesheet" href="images/css(2).css" type="text/css"></link>
    <link rel="stylesheet" href="images/csstg2.css" type="text/css"></link>
    <style type="text/css">
        <!
        -- .style3
        {
            font-size: 16px;
        }
        #footer
        {
            padding: 10px 0;
            color: #28333c;
        }
        -- ></style>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" style="margin: 0; padding: 0;">
    <div id="header">
        <div style="float: left; margin-left: 20px;">
            <img src="images/logo.jpg" height="30" /></div>
        <div>
            <ul style=" list-style-type:none;">
                <li><a target="_blank" href="http://www.zhuozhengsoft.com">׿����վ</a></li>
                <li><a target="_blank" href="http://www.zhuozhengsoft.com/poask/index.asp">�ͻ��ʰ�</a></li>
                <li><a href="#">���߰���</a></li>
                <li><a target="_blank" href="http://www.zhuozhengsoft.com/contact-us.html">��ϵ����</a></li>
            </ul>
        </div>
    </div>
    <form id="formData" action="login.php?tz=false" method="post" >
    <table cellspacing="0" cellpadding="0" width="760" border="0" Height="1" bgcolor="#ffffff"
        align="center">
        <tr>
            <td>
                <table cellspacing="0" cellpadding="0" width="100%" border="0">
                    <tbody>
                        <tr>
                            <td valign="top">
                            </td>
                        </tr>
                        <tr valign="top" align="center" height="120">
                            <td height="38" valign="middle">
                                <h1 class="font2 style3">
                                    ����ϵͳʾ��</h1>
                            </td>
                        </tr>
                        <tr valign="top" align="right">
                            <td height="38" valign="middle">
                                <a href="login.asp"></a>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td width="100%" height="150">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tbody>
                                        <tr valign="top">
                                            <td width="1">
                                                &nbsp;
                                            </td>
                                            <td>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="12" background="images/img_f_14.gif">
                                                            <img src="images/img_f_13.gif" width="12" height="29" />
                                                        </td>
                                                        <td width="150" background="images/img_f_14.gif" class="font3">
                                                            <font color="#FFFFFF">ϵͳ��¼</font>
                                                        </td>
                                                        <td width="12" align="left" background="images/img_f_16.gif">
                                                            <img src="images/img_f_15.gif" width="8" height="29" />
                                                        </td>
                                                        <td align="right" valign="bottom" background="images/img_f_16.gif">
                                                            &nbsp;
                                                        </td>
                                                        <td width="67" align="right" valign="bottom" background="images/img_f_16.gif">
                                                            <img src="images/img_f_39.gif" name="Image2521" width="67" height="29" border="0"
                                                                id="Image2521" />
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table width="100%" height="140" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="1" bgcolor="E2E2E2">
                                                        </td>
                                                        <td width="5">
                                                            &nbsp;
                                                        </td>
                                                        <td valign="top">
                                                            <table width="100%" height="140" border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="100%" valign="top" colspan="2">
                                                                        <table class="text" cellspacing="0" cellpadding="4" width="95%" border="0" align="center">
                                                                            <tr>
                                                                                <td colspan="2" height="10">
                                                                                    <p>
                                                                                        &nbsp;</p>
                                                                                    <p>
                                                                                        &nbsp;</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="right" width="40%">
                                                                                    <strong>�û�����</strong>
                                                                                </td>
                                                                                <td width="60%">
                                                                                    <input name="TextUserName" type="text" id="TextUserName" class="boder" style="width: 150px;"
                                                                                        value="admin" />
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="right" height="27">
                                                                                    <strong>��&nbsp; �룺</strong>
                                                                                </td>
                                                                                <td>
                                                                                    <input name="TextPassword" type="password" id="TextPassword" class="boder" style="width: 150px;"
                                                                                        value="123" />
                                                                                    ������Ĭ��123�� �������룩
                                                                                </td>
                                                                            </tr>
                                                                            <tr align="center">
                                                                                <td colspan="2">
                                                                                    <input type="image" name="ImgBtnLogin" id="ImgBtnLogin" src="images/index2_31.gif"
                                                                                        alt="" border="0" />
                                                                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="index.htm"><img height="26" alt="" src="images/index2_33.gif"
                                                                                        width="64" border="0" /></a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="380">
                                                                    </td>
                                                                    <td>
                                                                        <a href="functions.htm"></a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td width="5">
                                                            &nbsp;
                                                        </td>
                                                        <td width="1" bgcolor="E2E2E2">
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <img src="images/img_f_22.gif" width="100%" height="9" />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <div id="footer" style="margin-top: 100px;">
        <hr width="1000" />
        <div>
            ����׿��־Զ������޹�˾ (c) 2011-2013
        </div>
    </div>
    </form>
</body>
</html>