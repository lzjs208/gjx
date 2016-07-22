<?php
/* Smarty version 3.1.29, created on 2016-07-15 18:02:06
  from "E:\webProject\gjx-coin.com\web\admin\templates\editarticle.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5788b49e85e9f1_60787873',
  'file_dependency' => 
  array (
    'a77c1d9add2f602320b35ffcff6581ab83eb0164' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\admin\\templates\\editarticle.tpl',
      1 => 1468576924,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5788b49e85e9f1_60787873 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link href="../../plugins/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href="../../style/common.css" rel="stylesheet">
<link href="../css/admin.css" rel="stylesheet">
<link href="css/article.css" rel="stylesheet" type="text/css">
<link href="../../plugins/kindeditor/themes/default/default.css" rel="stylesheet" type="text/css">
<?php echo '<script'; ?>
 src="../../js/jquery-1.11.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../plugins/kindeditor/kindeditor-min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../plugins/kindeditor/lang/zh_CN.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/article.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="upfile2/js/up.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>
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
		<input type="hidden" id="arcId" name="arcId" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['id'];?>
">
		<input type="hidden" id="thumbs" name="thumbs" size="100" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['thumbs'];?>
">
		<input type="hidden" id="titlepic" name="titlepic" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['titlepic'];?>
">
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
				<label>文章标题：</label><input type="text" name="title" id="title" class="art_in" size="80" placeholder="文章标题" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['title'];?>
">&nbsp;
				<label>简短标题：</label><input type="text" name="shorttit" id="shorttit" class="art_in" size="40" placeholder="简短标题" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['shorttit'];?>
">
			</div>
			<div>
				<label>文章跳转：</label><input type="text" name="jumpurl" id="jumpurl" class="art_in" size="60" placeholder="如果文章有跳转请输入URL" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['jumpurl'];?>
">&nbsp;
				<label>是否推荐：</label><input type="radio" name="tuijian" value="0" <?php if ($_smarty_tpl->tpl_vars['result']->value['tuijian'] == 0) {?> checked <?php }?>  >&nbsp;不推荐&nbsp;<input type="radio" name="tuijian" value="1" <?php if ($_smarty_tpl->tpl_vars['result']->value['tuijian'] == 1) {?> checked <?php }?> >&nbsp;推荐
			</div>
			<div>
				<label>标题图片：</label>
				<iframe src="upfile/upfile.php" marginheight="0" marginwidth="0" frameborder="0" height="30" width="80%" scrolling="no"></iframe>
			</div>
			<div>
				<label>关 键 词 ：</label><input type="text" name="keyword" id="keyword" class="art_in" size="50" placeholder="多个关键词请用“,”分开" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['keywords'];?>
">&nbsp;
				<label>发布日期：</label><input type="text" class="art_in form_datetime" value="<?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['result']->value['pubdate']);?>
" readonly name="pubdate" id="pubdate" size="30" placeholder="请选择文章发表日期">
			</div>
			<div>
				<label>所属栏目：</label><select id="catId" name="catId" class="art_in"><option value="0">请选择栏目</option><option value="1">公告栏</option></select>&nbsp;
				<label>文章模板：</label><input type="text" class="art_in" name="tplfile" id="tplfile" value="article.tpl">
			</div>
			<div>
				<label>文章作者：</label><input type="text" name="editor" id="editor" class="art_in" size="20" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['editor'];?>
">
				<label>文章来源：</label><input type="text" name="source" id="source" class="art_in" size="40" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['source'];?>
">
			</div>
			<div>
				<label style="vertical-align: top;">文章简介：</label>
				<textarea cols="100" rows="6" name="sortContent" id="sortContent" class="art_in"><?php echo $_smarty_tpl->tpl_vars['result']->value['sortContent'];?>
</textarea>
			</div>

		</div>
		<!--div layer 2-->
		<div class="artDiv none">
			<textarea id="kind_editor" name="content" style="width:800px; height:400px; visibility:hidden;"><?php echo $_smarty_tpl->tpl_vars['result']->value['content'];?>
</textarea>
		</div>
		<!--div layer 3-->
		<div class="artDiv none">
			<iframe src="upfile2/upfile.php" marginwidth="0" marginheight="0" frameborder="0" height="30" width="100%" scrolling="no" style="margin-top:20px;"></iframe>
			<div id="thumbs_area"></div>
		</div>
		<!--div layer 4-->
		<div class="artDiv none">
			<textarea id="kind_editor2" name="wap_content" style="width:800px; height:400px; visibility:hidden;"><?php echo $_smarty_tpl->tpl_vars['result']->value['wapcontent'];?>
</textarea>
		</div>
		<!--div layer 5-->
		<div class="artDiv none">
		其他选项
		</div>
		<input type="submit" value="提交" name="submit" class="btn mg20">
		</form>
	</div>
</div>

<?php echo '<script'; ?>
>
$(function(){
  $('.form_datetime').datetimepicker({
	  format: 'yyyy-mm-dd hh:ii:ss',
	  language: 'zh-CN',
	  todayBtn: true,
	  pickerPosition: "bottom-left",
	  autoclose: true
  });
})
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../plugins/datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../plugins/datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="../../plugins/layer/layer.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../plugins/bootstrap-3.3.4/js/bootstrap.min.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
