<?php
		//��ת	
		$flg= $_REQUEST["flg"];
		$id = $_REQUEST["id"];	
		$action = $_REQUEST["action"];
		
    	if(isset($flg) && !empty($flg) && strlen(trim($flg))>0 && isset($id) && !empty($id) && strlen(trim($id))>0){
			$conn = new com("ADODB.Connection");
			$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
			$conn->Open($connstr); 
			$status = "";//�ļ���ת״̬
			if(strcasecmp($flg,"zspy")==0)
				$status = "��������";
			else if(strcasecmp($flg,"lspy")==0)
				$status = "��������";
			else if(strcasecmp($flg,"wyqg")==0)
				$status = "��Ա���";
			else 
				$status = "��ʽ����";
			$query = "Update word set Status = '".$status."' where id=".$id;
			$conn->Execute($query); 
   		}   		
   		//�½��ļ�		
   		else if(isset($action) && !empty($action) && strlen(trim($action))>0){
			$conn = new com("ADODB.Connection");
			$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
			$conn->Open($connstr); 
			$query = "select Max(ID) from word";
			$rs = $conn->Execute($query); 		
			
            $newID = 1;
            if (!$rs->EOF)
            {
                $newID = (int)($rs->Fields(0)->value) +1;
            }

            $fileName = "aabb" . $newID . ".doc";
            $FileSubject = "�������ĵ�����";
            $getFile=$_REQUEST["FileSubject"];
			if (isset($getFile) && !empty($getFile) && strlen(trim($getFile))>0){
				$FileSubject = $getFile;
			}			
			date_default_timezone_set("Asia/Shanghai");//����ʱ��
			//echo "id:".$newID."==fileName".$fileName."==FileSubject".$FileSubject."==date".date("Y-m-d h:i:sa")."==status.���߱༭";
			
			$strsql = "Insert into word(ID,FileName,Subject,SubmitTime,Status) values(" . $newID
                . ",'" . $fileName . "','" . $FileSubject . "','" . date("Y-m-d h:i:sa") . "','���߱༭')";
            $conn->Execute($strsql);
            
            //�����ļ�
			$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
			$oldPath=$filepath."\\doc\\".$_REQUEST["TemplateName"];
			$newPath=$filepath."\\doc\\".$fileName;
			copy($oldPath, $newPath);

  			header("Location:word2.php?id=" . $newID);
   		} 	
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
		<title>������ʾʾ��</title>
		<script type="text/javascript">
			function onColor(dd){
				dd.style.backgroundColor = "#D7FFEE";
			}
			function offColor(dd){
				dd.style.backgroundColor="";
			}
			function getFocus(){
				var str=document.getElementById("FileSubject").value;
				if(str=="�������ĵ�����"){
					document.getElementById("FileSubject").value="";
				}
			}
			function lostFocus(){
				var str=document.getElementById("FileSubject").value;
					if(str.length<=0){
						document.getElementById("FileSubject").value="�������ĵ�����";
					}
			}												
		</script>
	</head>
	<body>
		<!--header-->
		<div class="zz-headBox br-5 clearfix">
			<div class="zz-head mc">
				<!--logo-->
				<div class="logo fl">
					<a href="#"> <img src="images/logo.png" alt="" /> </a>
				</div>
				<!--logo end-->
				<ul class="head-rightUl fr">
					<li><a href="http://www.zhuozhengsoft.com" target="_blank">׿����վ</a></li>
                <li><a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">�ͻ��ʰ�</a></li>
                <li class="bor-0"><a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">��ϵ����</a></li>
				</ul>
			</div>
		</div>
		<!--header end-->
		<!--content-->
		<div class="zz-content mc clearfix pd-28">
			<div class="demo mc">
				<h2 class="fs-16">
					PageOffice ���ĵ���ת�е�Ӧ��
				</h2>
				<h3 class="fs-12">
					��ʾ˵��:
				</h3>
				
				<p>
					��ʾ������ӡ�¹���ʱ�����Ե�� <a href="http://localhost:8080/JavaBridge/loginseal.do" target="_blank" style=" text-decoration:underline;">����ӡ�¼��׹���ƽ̨</a> ��ӡ�ɾ��ӡ�¡�����Ա:<span style=" color:Red;">admin</span> ����:<span style=" color:Red;">111111</span>
				</p>
				
				
			</div>
			<div class="demo mc">
				<h3 class="fs-12">
					�½��ļ�
				</h3>
				<form id="form1" action="index.php?action=create" method="post">
					<table class="text" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td style="font-size: 9pt" align="left">
								<select name="TemplateName" style='width: 240px;'>
									<option value='redhead00.doc' selected="selected">
										-- �հ�ģ�� --
									</option>
									<option value='redhead01.doc'>
										��˾����ģ��
									</option>
									<option value='redhead02.doc'>
										������ͷ�ļ�ģ��
									</option>
								</select>
							</td>							
							<td align="center">
								<input name="FileSubject" id="FileSubject" type="text" onfocus="getFocus()"
									onblur="lostFocus()" class="boder" style="width: 180px;"
									value="�������ĵ�����" />
							</td>
							<td style="width: 221px;">
								&nbsp;
								<input type="image" style="width: 92px;" id="imgBtn"
									src="images/newword.gif" alt="" />

							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="zz-talbeBox mc">
				<h2 class="fs-12">
					�ĵ��б�
				</h2>
				<table class="zz-talbe">
					<thead>
						<tr>
							<th width="7%">
								����
							</th>
							<th width="22%">
								�ĵ�����
							</th>
							<th width="13%">
								��������
							</th>
							<th width="10%">
								�޺�ģʽ
							</th>
							<th width="19%">
								����ģʽ
							</th>
							<th width="10%">
								�˸�
							</th>
							<th width="10%">
								ֻ��
							</th>
							<th width="8%">
								MHT
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$conn = new com("ADODB.Connection");
							$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
							$conn->Open($connstr);	   
							$id = $_REQUEST["ID"];
							$query = "select * from word order by id desc";
							$rs = $conn->Execute($query); 
							while (!$rs->EOF) {
								$str0 = $rs->Fields["ID"]->value;
								if (isset($str0) && !empty($str0) && strlen(trim($str0))>0) {
						?>				
						<tr onmouseover='onColor(this);' onmouseout='offColor(this);'>
							<td>
								<img src='images/office-1.jpg' />
							</td>
							<td><?php echo $rs->Fields["Subject"]->value;?></td>
							<?php
								//��ʾʱ��
								$str3 = $rs->Fields["SubmitTime"]->value;
								if (isset($str3) && !empty($str3) && strlen(trim($str3))>0) {
							?>
							<td><?php date_default_timezone_set("Asia/Shanghai"); echo date("Y-m-d", strtotime($str3));?></td>
							<?php
								} else {
							?>
							<td>
								&nbsp;
							</td>
							<?php
								}
								$str5 = $rs->Fields["Status"]->value;
								if (isset($str5) && !empty($str5) && strlen(trim($str5))>0)  {
									$n = 0;
									if (strcasecmp($str5,"���߱༭")==0)
										$n = 1;
									else if (strcasecmp($str5,"��������")==0)
										$n = 2;
									else if (strcasecmp($str5,"��������")==0)
										$n = 3;
									else if (strcasecmp($str5,"��Ա���")==0)
										$n = 4;
									else if (strcasecmp($str5,"��ʽ����")==0)
										$n = 5;

									switch ($n) {
										case 0:
										case 1 :
							?><td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span
									style='color: Blue;'>���߱༭</span> </a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=����">�������� </a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi">��������</a> ��
								<a href="word1.php?id=<?php echo $str0;?>">��Ա���</a> ��
								<a href="word3.php?id=<?php echo $str0;?>">��ʽ����</a>
							</td>
							<?php
											break;
										case 2 :
							?>
							<td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span style=' color:Green;'>���߱༭</span></a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=ZhangSan"><span
									style='color: Blue;'>��������</span> </a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi">��������</a> ��	
								<a href="word1.php?id=<?php echo $str0;?>">��Ա���</a> ��
								<a href="word3.php?id=<?php echo $str0;?>">��ʽ����</a>
							</td>
							<?php
											break;
										case 3 :
							?><td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span style=' color:Green;'>���߱༭</span></a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=ZhangSan"><span style=' color:Green;'>��������</span> </a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi"><span
									style='color: Blue;'>��������</span> </a> ��
								<a href="word1.php?id=<?php echo $str0;?>">��Ա���</a> ��
								<a href="word3.php?id=<?php echo $str0;?>">��ʽ����</a>
							</td>
							<?php
											break;
										case 4 :
							?>
							<td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span style=' color:Green;'>���߱༭</span></a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=ZhangSan"><span style=' color:Green;'>�������� </span></a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi"><span style=' color:Green;'>��������</span></a> ��
								<a href="word1.php?id=<?php echo $str0;?>"><span
									style='color: Blue;'>��Ա���</span> </a> ��
								<a href="word3.php?id=<?php echo $str0;?>">��ʽ����</a>
							</td>
							<?php
											break;
										case 5 :
							?><td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span style=' color:Green;'>���߱༭</span></a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=ZhangSan"><span style=' color:Green;'>�������� </span></a> ��
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi"><span style=' color:Green;'>��������</span></a> ��
								<a href="word1.php?id=<?php echo $str0;?>"><span style=' color:Green;'>��Ա���</span></a> ��
								<a href="word3.php?id=<?php echo $str0;?>"><span
									style='color: Blue;'>��ʽ���� </span> </a>
							</td>
							<?php
										break;
									}
								} else {
							?>

							<td colspan=4>
								<a href='###'><span style='color: Blue;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
								</a>
								<a href=''>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
								<a href=''>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
								<a href=''>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
							</td>
							<?php
								}
							?>
							<td>
							<?php  
								$str4 = $rs->Fields["HtmlFile"]->value;
								if (isset($str4) && !empty($str4) && strlen(trim($str4))>0) { 
							?>
									<a style="color:blue;" target="_blank" href="doc/<?php echo $str4;?>">MHT</a>
							<?php
								}
								else{
							?>
									MHT
							<?php 
								}
							?>
							</td>
						</tr>
						<?php
								}
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
			Copyright copy 2012 ����׿��־Զ������޹�˾
		</div>
		<!--footer end-->
	</body>
</html>
