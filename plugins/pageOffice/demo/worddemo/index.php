<?php
		//流转	
		$flg= $_REQUEST["flg"];
		$id = $_REQUEST["id"];	
		$action = $_REQUEST["action"];
		
    	if(isset($flg) && !empty($flg) && strlen(trim($flg))>0 && isset($id) && !empty($id) && strlen(trim($id))>0){
			$conn = new com("ADODB.Connection");
			$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
			$conn->Open($connstr); 
			$status = "";//文件流转状态
			if(strcasecmp($flg,"zspy")==0)
				$status = "张三批阅";
			else if(strcasecmp($flg,"lspy")==0)
				$status = "李四批阅";
			else if(strcasecmp($flg,"wyqg")==0)
				$status = "文员清稿";
			else 
				$status = "正式发文";
			$query = "Update word set Status = '".$status."' where id=".$id;
			$conn->Execute($query); 
   		}   		
   		//新建文件		
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
            $FileSubject = "请输入文档主题";
            $getFile=$_REQUEST["FileSubject"];
			if (isset($getFile) && !empty($getFile) && strlen(trim($getFile))>0){
				$FileSubject = $getFile;
			}			
			date_default_timezone_set("Asia/Shanghai");//设置时区
			//echo "id:".$newID."==fileName".$fileName."==FileSubject".$FileSubject."==date".date("Y-m-d h:i:sa")."==status.在线编辑";
			
			$strsql = "Insert into word(ID,FileName,Subject,SubmitTime,Status) values(" . $newID
                . ",'" . $fileName . "','" . $FileSubject . "','" . date("Y-m-d h:i:sa") . "','在线编辑')";
            $conn->Execute($strsql);
            
            //拷贝文件
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
		<title>在线演示示例</title>
		<script type="text/javascript">
			function onColor(dd){
				dd.style.backgroundColor = "#D7FFEE";
			}
			function offColor(dd){
				dd.style.backgroundColor="";
			}
			function getFocus(){
				var str=document.getElementById("FileSubject").value;
				if(str=="请输入文档主题"){
					document.getElementById("FileSubject").value="";
				}
			}
			function lostFocus(){
				var str=document.getElementById("FileSubject").value;
					if(str.length<=0){
						document.getElementById("FileSubject").value="请输入文档主题";
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
					PageOffice 在文档流转中的应用
				</h2>
				<h3 class="fs-12">
					演示说明:
				</h3>
				
				<p>
					提示：测试印章功能时，可以点击 <a href="http://localhost:8080/JavaBridge/loginseal.do" target="_blank" style=" text-decoration:underline;">电子印章简易管理平台</a> 添加、删除印章。管理员:<span style=" color:Red;">admin</span> 密码:<span style=" color:Red;">111111</span>
				</p>
				
				
			</div>
			<div class="demo mc">
				<h3 class="fs-12">
					新建文件
				</h3>
				<form id="form1" action="index.php?action=create" method="post">
					<table class="text" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td style="font-size: 9pt" align="left">
								<select name="TemplateName" style='width: 240px;'>
									<option value='redhead00.doc' selected="selected">
										-- 空白模板 --
									</option>
									<option value='redhead01.doc'>
										公司公文模板
									</option>
									<option value='redhead02.doc'>
										政府红头文件模板
									</option>
								</select>
							</td>							
							<td align="center">
								<input name="FileSubject" id="FileSubject" type="text" onfocus="getFocus()"
									onblur="lostFocus()" class="boder" style="width: 180px;"
									value="请输入文档主题" />
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
					文档列表
				</h2>
				<table class="zz-talbe">
					<thead>
						<tr>
							<th width="7%">
								类型
							</th>
							<th width="22%">
								文档名称
							</th>
							<th width="13%">
								创建日期
							</th>
							<th width="10%">
								无痕模式
							</th>
							<th width="19%">
								留痕模式
							</th>
							<th width="10%">
								核稿
							</th>
							<th width="10%">
								只读
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
								//显示时间
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
									if (strcasecmp($str5,"在线编辑")==0)
										$n = 1;
									else if (strcasecmp($str5,"张三批阅")==0)
										$n = 2;
									else if (strcasecmp($str5,"李四批阅")==0)
										$n = 3;
									else if (strcasecmp($str5,"文员清稿")==0)
										$n = 4;
									else if (strcasecmp($str5,"正式发文")==0)
										$n = 5;

									switch ($n) {
										case 0:
										case 1 :
							?><td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span
									style='color: Blue;'>在线编辑</span> </a> →
								<a href="word.php?id=<?php echo $str0;?>&user=张三">张三批阅 </a> →
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi">李四批阅</a> →
								<a href="word1.php?id=<?php echo $str0;?>">文员清稿</a> →
								<a href="word3.php?id=<?php echo $str0;?>">正式发文</a>
							</td>
							<?php
											break;
										case 2 :
							?>
							<td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span style=' color:Green;'>在线编辑</span></a> →
								<a href="word.php?id=<?php echo $str0;?>&user=ZhangSan"><span
									style='color: Blue;'>张三批阅</span> </a> →
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi">李四批阅</a> →	
								<a href="word1.php?id=<?php echo $str0;?>">文员清稿</a> →
								<a href="word3.php?id=<?php echo $str0;?>">正式发文</a>
							</td>
							<?php
											break;
										case 3 :
							?><td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span style=' color:Green;'>在线编辑</span></a> →
								<a href="word.php?id=<?php echo $str0;?>&user=ZhangSan"><span style=' color:Green;'>张三批阅</span> </a> →
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi"><span
									style='color: Blue;'>李四批阅</span> </a> →
								<a href="word1.php?id=<?php echo $str0;?>">文员清稿</a> →
								<a href="word3.php?id=<?php echo $str0;?>">正式发文</a>
							</td>
							<?php
											break;
										case 4 :
							?>
							<td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span style=' color:Green;'>在线编辑</span></a> →
								<a href="word.php?id=<?php echo $str0;?>&user=ZhangSan"><span style=' color:Green;'>张三批阅 </span></a> →
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi"><span style=' color:Green;'>李四批阅</span></a> →
								<a href="word1.php?id=<?php echo $str0;?>"><span
									style='color: Blue;'>文员清稿</span> </a> →
								<a href="word3.php?id=<?php echo $str0;?>">正式发文</a>
							</td>
							<?php
											break;
										case 5 :
							?><td colspan=4>
								<a href="word2.php?id=<?php echo $str0;?>"><span style=' color:Green;'>在线编辑</span></a> →
								<a href="word.php?id=<?php echo $str0;?>&user=ZhangSan"><span style=' color:Green;'>张三批阅 </span></a> →
								<a href="word.php?id=<?php echo $str0;?>&user=LiSi"><span style=' color:Green;'>李四批阅</span></a> →
								<a href="word1.php?id=<?php echo $str0;?>"><span style=' color:Green;'>文员清稿</span></a> →
								<a href="word3.php?id=<?php echo $str0;?>"><span
									style='color: Blue;'>正式发文 </span> </a>
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
			Copyright copy 2012 北京卓正志远软件有限公司
		</div>
		<!--footer end-->
	</body>
</html>
