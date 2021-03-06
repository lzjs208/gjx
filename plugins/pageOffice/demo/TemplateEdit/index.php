<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
		<title>文档生成演示示例</title>
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
					PageOffice 填充“用户自定义Word模版”动态生成文件
				</h2>
				<h3 class="fs-12">
					演示说明:
				</h3>
				
				<p>
					为了让代码简单清晰，此演示没有使用数据库，生成文件时，对模版填充的数据全部是常量。
				</p>
				
			</div>
			
			<div class="zz-talbeBox mc">
				<h2 class="fs-12">
					演示列表
				</h2>
				<div style=" text-align:right; height:40px; vertical-align:middle;">
				    <img src="images/arrow.gif"  style=" vertical-align:middle;" /><a href="Template.php" target="_blank"><span style=" color:blue;">用户编辑Word模版</span></a>&nbsp;&nbsp;&nbsp;
				</div>
				<table class="zz-talbe">
					<thead>
						<tr >		
							<th width="30%" style="text-align:center;">
								演示效果
							</th>
							<th width="10%" style="text-align:center;">
							    代码页面
							</th>
							<th width="60%" style="text-align:center;">
								操作及说明
							</th>
							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-align:center;">三种模式动态生成文件的效果</td>
							<td style="text-align:center;">Word.php</td>
							<td style="text-align:left;">
								<a href="Word.php?type=1" target="_blank"><span style=" color:blue;">编辑模式生成</span></a>
								&nbsp;&nbsp;&nbsp;
								<a href="Word.php?type=2" target="_blank"><span style=" color:blue;">只读模式生成</span></a>
								&nbsp;&nbsp;&nbsp;
								<a href="Word.php?type=3" target="_blank"><span style=" color:blue;">提交模式(实现表单录入或局部编辑)</span></a>
							</td>
						</tr>
						<tr>
							<td style="text-align:center;">FileMaker动态生成文件的效果</td>
							<td style="text-align:center;">FileMaker.php</td>
							<td style="text-align:left; ">
							    
								<a href="javascript:void(0);" onclick="doFileMaker();" ><span style=" color:blue;">生成文件保存到后台服务器</span></a> 
								<span id="loadGif" style=" visibility:hidden;"><img src="images/loading4.gif"  style=" width:60px;  vertical-align:middle;" /></span>
								<p style=" text-align:left; color:#666;">
								    实现在客户端不显示PageOffice界面的情况下，动态填充数据到Word模版，生成文件自动保存到服务器上。（此演示生成的文件保存在doc目录下，文件名为：filemaker.doc）
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