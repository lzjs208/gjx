<!DOCTYPE html>
<html lang="en">
<head>
<title><{$title}></title>
<link href="../../plugins/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href="../../style/common.css" rel="stylesheet">
<link href="../css/admin.css" rel="stylesheet">
<link href="css/article.css" rel="stylesheet" type="text/css">
<link href="../../plugins/kindeditor/themes/default/default.css" rel="stylesheet" type="text/css">
<script src="../../js/jquery-1.11.3.min.js"></script>
<script src="../../plugins/kindeditor/kindeditor-min.js"></script>
<script src="../../plugins/kindeditor/lang/zh_CN.js"></script>
<script src="js/article.js"></script>
<script src="upfile2/js/up.js"></script>
<script>
var editor, editor2;
KindEditor.ready(function(K){
	editor = K.create('textarea[id="kind_editor"]',{
			allowFileManager: true
	});
//	var text = editor.text();
	editor2 = K.create('textarea[id="kind_editor2"]',{
			allowFileManager: true
	});
});
</script>
</head>
<body>

<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color" onclick="javascript:location.href='addarticle.php';">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;文章编辑</li>
	</ul>
</div>
<!--面包屑导航-->

<div class="wrapper-panel">
	<div class="main_art">
		<form name="form" id="form" method="post" action="editarticle.save.php">
		<input type="hidden" id="arcId" name="arcId" value="<{$result.id}>">
		<input type="hidden" id="thumbs" name="thumbs" size="100" value="<{$result.thumbs}>">
		<input type="hidden" id="titlepic" name="titlepic" value="<{$result.titlepic}>">
		<div id="arthead" class="arthead">
			<span class="cur">常规信息</span>
			<span class="nocur">文章内容</span>
			<span>缩略图上传</span>
			<span>wap内容</span>
			<span>其他选项</span>
		</div>
		<!--div layer 1-->
		<div class="artDiv">
			<div>
				<label>文章标题：</label><input type="text" name="title" id="title" class="art_in" size="80" placeholder="文章标题" value="<{$result.title}>">&nbsp;
				<label>简短标题：</label><input type="text" name="shorttit" id="shorttit" class="art_in" size="40" placeholder="简短标题" value="<{$result.shorttit}>">
			</div>
			<div>
				<label>文章跳转：</label><input type="text" name="jumpurl" id="jumpurl" class="art_in" size="60" placeholder="如果文章有跳转请输入URL" value="<{$result.jumpurl}>">&nbsp;
				<label>是否推荐：</label><input type="radio" name="tuijian" value="0" <{if $result.tuijian==0}> checked <{/if}>  >&nbsp;不推荐&nbsp;<input type="radio" name="tuijian" value="1" <{if $result.tuijian==1}> checked <{/if}> >&nbsp;推荐
			</div>
			<div>
				<label>标题图片：</label>
				<iframe src="upfile/upfile.php" marginheight="0" marginwidth="0" frameborder="0" height="30" width="80%" scrolling="no"></iframe>
			</div>
			<div>
				<label>关 键 词 ：</label><input type="text" name="keyword" id="keyword" class="art_in" size="50" placeholder="多个关键词请用“,”分开" value="<{$result.keywords}>">&nbsp;
				<label>发布日期：</label><input type="text" class="art_in form_datetime" value="<{date('Y-m-d H:i:s',$result.pubdate)}>" readonly name="pubdate" id="pubdate" size="30" placeholder="请选择文章发表日期">
			</div>
			<div>
				<label>所属栏目：</label><select id="catId" name="catId" class="art_in"><option value="0">请选择栏目</option><option value="1">公告栏</option></select>&nbsp;
				<label>文章模板：</label><input type="text" class="art_in" name="tplfile" id="tplfile" value="article.tpl">
			</div>
			<div>
				<label>文章作者：</label><input type="text" name="editor" id="editor" class="art_in" size="20" value="<{$result.editor}>">
				<label>文章来源：</label><input type="text" name="source" id="source" class="art_in" size="40" value="<{$result.source}>">
			</div>
			<div>
				<label style="vertical-align: top;">文章简介：</label>
				<textarea cols="100" rows="6" name="sortContent" id="sortContent" class="art_in"><{$result.sortContent}></textarea>
			</div>

		</div>
		<!--div layer 2-->
		<div class="artDiv none">
			<textarea id="kind_editor" name="content" style="width:800px; height:400px; visibility:hidden;"><{$result.content}></textarea>
		</div>
		<!--div layer 3-->
		<div class="artDiv none">
			<iframe src="upfile2/upfile.php" marginwidth="0" marginheight="0" frameborder="0" height="30" width="100%" scrolling="no" style="margin-top:20px;"></iframe>
			<div id="thumbs_area"></div>
		</div>
		<!--div layer 4-->
		<div class="artDiv none">
			<textarea id="kind_editor2" name="wap_content" style="width:800px; height:400px; visibility:hidden;"><{$result.wapcontent}></textarea>
		</div>
		<!--div layer 5-->
		<div class="artDiv none">
		其他选项
		</div>
		<input type="submit" value="提交" name="submit" class="btn mg20">
		</form>
	</div>
</div>

<script>
$(function(){
  $('.form_datetime').datetimepicker({
	  format: 'yyyy-mm-dd hh:ii:ss',
	  language: 'zh-CN',
	  todayBtn: true,
	  pickerPosition: "bottom-left",
	  autoclose: true
  });
})
</script>
<script type="text/javascript" src="../../plugins/datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../plugins/datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>

<script src="../../plugins/layer/layer.js"></script>
<script src="../../js/common.js"></script>
<script src="../../plugins/bootstrap-3.3.4/js/bootstrap.min.js"></script>

</body>
</html>