<?php
/* Smarty version 3.1.29, created on 2016-07-13 17:03:10
  from "E:\webProject\gjx-coin.com\web\admin\templates\index_article.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_578603ce4e0cb7_24748746',
  'file_dependency' => 
  array (
    'e83c087bd2fc605da70cba3d747caaeb72913d24' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\admin\\templates\\index_article.tpl',
      1 => 1468400588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_578603ce4e0cb7_24748746 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'E:\\webProject\\gjx-coin.com\\web\\plugins\\smarty\\libs\\plugins\\modifier.truncate.php';
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GTrade'), 0, false);
?>


<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;文章管理</li>
	</ul>
</div>
<!--面包屑导航-->
<div class="wrapper-panel">
	<div class="art_search">
		<form name="form" id="form" method="post" action="index.php">
		<div>
			<label>文章查询：</label>
			<input type="text" class="art_input form-control" name="keyword" id="keyword">
			<input type="submit" class="btn" id="btn_search" value="查询" style="width:5%;">
		</div>
		</form>
	</div>
	<div class="art_manage">
		<div class="title">文章管理</div>
		<ul class="list-panel">
			<li class="rowl row_title">
				<div class="col">选择</div>
				<div class="col">编号</div>
				<div class="col">标题</div>
				<div class="col">栏目</div>
				<div class="col">审核</div>
				<div class="col">发表日期</div>
				<div class="col">排序</div>
				<div class="col">点击</div>
				<div class="col">操作</div>
				<div class="col">操作</div>
			</li>
			<!--data list-->
			<?php
$_from = $_smarty_tpl->tpl_vars['artlist']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_0_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$__foreach_value_0_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
			<li class="rowl row_list">
				<div class="col"><input name="arcID" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="np" type="checkbox" ></div>
				<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
</div>
				<div class="col">
					<a href="../../news/content.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" target="_blank"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value['title'],30);?>
</a>
					<?php if ($_smarty_tpl->tpl_vars['value']->value['titlepic'] != '') {?>
					<i>[图]</i>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['value']->value['tuijian'] == 1) {?>
					<i>[荐]</i>
					<?php }?>
				</div>
				<div class="col">公告栏</div>
				<div class="col">
				<?php if ($_smarty_tpl->tpl_vars['value']->value['isexam'] == 0) {?>
				<button class="exam">未审核</button>
				<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['isexam'] == 1) {?>
				<button class="exam">已审核</button>
				<?php }?>
				</div>
				<div class="col"><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['value']->value['pubdate']);?>
</div>
				<div class="col"><input type="text" class="order" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['artorder'];?>
"></div>
				<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['click'];?>
</div>
				<div class="col"><button class="opera" onclick="editArc(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);">编辑</button></div>
				<div class="col"><button class="opera" onclick="delArc(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);">删除</button></div>
			</li>
			<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
			<!--data list-->
			<!--pager-->
			<?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

			<!--pager-->
		</ul>
	</div>
</div>

<?php echo '<script'; ?>
 src="js/article.js"><?php echo '</script'; ?>
>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
