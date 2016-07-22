<!DOCTYPE html>
<html lang="en">
<head>
<title><{$title}></title>
<link href="../../plugins/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href="../../style/common.css" rel="stylesheet">
<link href="../css/admin.css" rel="stylesheet">
<script src="../../js/jquery-1.11.3.min.js"></script>
<script src="../js/common.js"></script>
</head>
<body>

<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color" onclick="javascript:location.href='addarticle.php';">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;文章发表</li>
	</ul>
</div>
<!--面包屑导航-->

<div class="wrapper-panel">
	<div class="main">
		<form name="form" id="form" method="post" action="addarticle.save.php">
		<input type="hidden" id="cat_thumb" name="cat_thumb">
		<div id="thead" class="thead">
			<span class="cur">基本选项</span>
			<span class="nocur">高级设置</span>
			<span>栏目内容</span>
		</div>
		<!--div layer 1-->
		<div class="divLayer">
			<div>
				<label>栏目属性：</label><input type="radio" value="0" name="isonepage">多页&nbsp;<input type="radio" value="1" name="isonepage">单页
			</div>
			<div>
				<label>栏目名称：</label><input type="text" name="typename" id="typename" size="40" placeholder="栏目名称">
			</div>
		</div>
		<!--div layer 2-->
		<div class="artDiv none">
			<textarea id="kind_editor" name="content" style="width:800px; height:400px; visibility:hidden;">文章内容</textarea>
		</div>
		<!--div layer 3-->
		<div class="divLayer none">
			<iframe src="upfile2/upfile.php" marginwidth="0" marginheight="0" frameborder="0" height="30" width="100%" scrolling="no" style="margin-top:20px;"></iframe>
			<div id="thumbs_area"></div>
		</div>
		<!--div layer 4-->
		<div class="divLayer none">
			<textarea id="kind_editor2" name="wap_content" style="width:800px; height:400px; visibility:hidden;">wap文章内容</textarea>
		</div>
		<!--div layer 5-->
		<div class="divLayer none">
		其他选项
		</div>
		<input type="submit" value="提交" name="submit" class="btn mg20">
		</form>
	</div>
</div>

<script src="../../plugins/layer/layer.js"></script>
<script src="../../js/common.js"></script>
<script src="../../plugins/bootstrap-3.3.4/js/bootstrap.min.js"></script>

</body>
</html>