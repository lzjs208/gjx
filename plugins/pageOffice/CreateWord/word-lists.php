
<?php
	if(isset($_REQUEST["op"]) && !empty($_REQUEST["op"])){
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("doc/demo_creword.mdb");
		$conn->Open($connstr);  
	   
		$query = "select Max(ID) from word";
		$result = $conn->Execute($query);  
		$newID = 1;
		if(!$result->EOF)
		{
			$newID = (int)($result->Fields(0)->value) + 1;
			//echo "id===".$newID;
		}
		
        $fileName = "aabb".$newID.".doc";
        $FileSubject = "请输入文档主题";
		$getFile = $_REQUEST["FileSubject"];
		if (isset($getFile) && !empty($getFile) && strlen(trim($getFile))>0){
			$FileSubject = $getFile;
		}
		date_default_timezone_set("Asia/Shanghai");//设置时区
		$strsql = "Insert into word(ID,FileName,Subject,SubmitTime) values("
			.$newID
			.",'"
			.$fileName
			."','"
			.$FileSubject
			."','"
			.date("Y-m-d h:i:sa")."')";	
		$result = $conn->Execute($strsql);
            
        //拷贝文件
		$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
		$oldPath=$filepath."\\doc\\template.doc";
		$newPath=$filepath."\\doc\\".$fileName;
		$flg = copy($oldPath, $newPath);
		if(!$flg){
			echo "文件拷贝出错";
		}
		
		header("Location:word-lists.php"); 
	} 	


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>新建文件</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        function onColor(td) {
            td.style.backgroundColor = '#D7FFEE';
        }
        function offColor(td) {
            td.style.backgroundColor = '';
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


    </script>

</head>
<body style=" text-align:center;">
    <!--header-->
    <div class="zz-headBox br-5 clearfix" >
        <div class="zz-head mc">
            <!--logo-->
            <div class="logo fl">
                <a href="http://www.zhuozhengsoft.com/" target="_blank">
                    <img src="../images/logo.png" alt="" /></a></div>
            <!--logo end-->
            <ul class="head-rightUl fr">
                <li><a href="http://www.zhuozhengsoft.com" target="_blank">卓正网站</a></li>
                <li><a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">客户问吧</a></li>
                <li class="bor-0"><a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">联系我们</a></li>
            </ul>
        </div>
    </div>
    <!--header end-->
    <!--content-->
    <div class="zz-content mc clearfix pd-28">
        <div class="demo mc">
            <h2 class="fs-16">
                PageOffice 两种创建新文档的方式</h2>
        </div>
        <div class="demo mc" style="text-align:left;">
            <h3 class="fs-12">
                新建文件</h3>
            <form id="form1" method="post" action="word-lists.php?op=create">
            <table class="text" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td style="font-size: 9pt" align="left">
                        方法1：通过复制文件创建新文件
                    </td>
                    <td align="center">
                        <input name="FileSubject" id="FileSubject" type="text" onfocus="getFocus()" onblur="lostFocus()"
                            class="boder" style="width: 180px;" value="请输入文档主题" />
                    </td>
                    <td style="width: 221px;">
                        &nbsp;
                        <input type="submit" value="创建文件" style=" width:86px;"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        方法2：利用属性WebCreateNew创建新文件&nbsp;&nbsp;
                    </td>
                    <td>
                        &nbsp;<a href="CreateWord.php" target="_blank"style=" color:Blue; text-decoration:underline;">新建文件</a>
                        </td>
                    <td style="width: 221px;">
                        &nbsp;&nbsp;
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <div class="zz-talbeBox mc">
            <h2 class="fs-12">
                文档列表</h2>
            <table class="zz-talbe">
                <thead>
                    <tr>
                        <th width="22%">
                            文档名称
                        </th>
                        <th width="10%">
                            创建日期
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
				$conn = new com("ADODB.Connection");
				$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("doc/demo_creword.mdb");
				$conn->Open($connstr);  
			   
				$query = "select * from word order by id desc";
				$rs = $conn->Execute($query);  

				$fileName="";
				$subject="";
				$submitTime="";
				while(!$rs->EOF){	
					$fileName = $rs->Fields["FileName"]->value;
					$subject = $rs->Fields["Subject"]->value;
					$submitTime = $rs->Fields["SubmitTime"]->value;
				?>
					<tr onmouseover='onColor(this)' onmouseout='offColor(this)'>
					<td>
								<a
									href='OpenWord.php?filename=<?php echo $fileName;?>&subject=<?php echo $subject;?>'><?php echo $subject;?></a>
							</td>
				<?php
					if(isset($submitTime) && !empty($submitTime) && strlen(trim($submitTime))>0){
				?>
					<td><?php echo $submitTime;?></td>
				<?php 
					}else{
				?>
					<td>&nbsp;</td>
				<?php
					}
				?>
					</tr>
				<?php
					$rs->MoveNext();
				}
				?>
                </tbody>
            </table>
        </div>
    </div>
    <!--content end-->
    <!--footer-->
    <div class="login-footer clearfix">
        Copyright &copy 2012 北京卓正志远软件有限公司</div>
    <!--footer end-->
</body>
</html>