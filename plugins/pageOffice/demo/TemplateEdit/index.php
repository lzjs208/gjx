<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
		<title>�ĵ�������ʾʾ��</title>
		<script type="text/javascript">

		    function doFileMaker() {
		        showGif();
			    document.getElementById("iframe1").src = "FileMaker.php";
			}
			function showGif() {
			    document.getElementById("loadGif").style.visibility = "";
			}	
			function hideGif() {
			    document.getElementById("loadGif").style.visibility = "hidden";
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
					PageOffice ��䡰�û��Զ���Wordģ�桱��̬�����ļ�
				</h2>
				<h3 class="fs-12">
					��ʾ˵��:
				</h3>
				
				<p>
					Ϊ���ô��������������ʾû��ʹ�����ݿ⣬�����ļ�ʱ����ģ����������ȫ���ǳ�����
				</p>
				
			</div>
			
			<div class="zz-talbeBox mc">
				<h2 class="fs-12">
					��ʾ�б�
				</h2>
				<div style=" text-align:right; height:40px; vertical-align:middle;">
				    <img src="images/arrow.gif"  style=" vertical-align:middle;" /><a href="Template.php" target="_blank"><span style=" color:blue;">�û��༭Wordģ��</span></a>&nbsp;&nbsp;&nbsp;
				</div>
				<table class="zz-talbe">
					<thead>
						<tr >		
							<th width="30%" style="text-align:center;">
								��ʾЧ��
							</th>
							<th width="10%" style="text-align:center;">
							    ����ҳ��
							</th>
							<th width="60%" style="text-align:center;">
								������˵��
							</th>
							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-align:center;">����ģʽ��̬�����ļ���Ч��</td>
							<td style="text-align:center;">Word.php</td>
							<td style="text-align:left;">
								<a href="Word.php?type=1" target="_blank"><span style=" color:blue;">�༭ģʽ����</span></a>
								&nbsp;&nbsp;&nbsp;
								<a href="Word.php?type=2" target="_blank"><span style=" color:blue;">ֻ��ģʽ����</span></a>
								&nbsp;&nbsp;&nbsp;
								<a href="Word.php?type=3" target="_blank"><span style=" color:blue;">�ύģʽ(ʵ�ֱ�¼���ֲ��༭)</span></a>
							</td>
						</tr>
						<tr>
							<td style="text-align:center;">FileMaker��̬�����ļ���Ч��</td>
							<td style="text-align:center;">FileMaker.php</td>
							<td style="text-align:left; ">
							    
								<a href="javascript:void(0);" onclick="doFileMaker();" ><span style=" color:blue;">�����ļ����浽��̨������</span></a> 
								<span id="loadGif" style=" visibility:hidden;"><img src="images/loading4.gif"  style=" width:60px;  vertical-align:middle;" /></span>
								<p style=" text-align:left; color:#666;">
								    ʵ���ڿͻ��˲���ʾPageOffice���������£���̬������ݵ�Wordģ�棬�����ļ��Զ����浽�������ϡ�������ʾ���ɵ��ļ�������docĿ¼�£��ļ���Ϊ��filemaker.doc��
								</p>
								
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		<div style="width: 1px; height: 0px; overflow: hidden;">
            <iframe id="iframe1" name="iframe1" src=""></iframe>
        </div>
		<!--content end-->
		<!--footer-->
		
		<!--footer end-->
	</body>
</html>