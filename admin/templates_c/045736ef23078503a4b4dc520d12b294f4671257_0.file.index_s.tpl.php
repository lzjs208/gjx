<?php
/* Smarty version 3.1.29, created on 2016-06-21 09:01:52
  from "E:\webProject\gjx-coin.com\web\admin\templates\index_s.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_576892006f1710_23132449',
  'file_dependency' => 
  array (
    '045736ef23078503a4b4dc520d12b294f4671257' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\admin\\templates\\index_s.tpl',
      1 => 1466180420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_576892006f1710_23132449 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GTrade'), 0, false);
?>


<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;会员管理</li>
	</ul>
</div>
<!--面包屑导航-->
<!--会员管理面板-->
<div class="wrapper-panel">
	<div class="title">会员管理</div>
	<ul class="list-panel list-member">
		<li class="rowl row_title">
			<div class="col">会员编号</div>
			<div class="col">用户名</div>
			<div class="col">注册时间</div>
			<div class="col">可否登陆</div>
			<div class="col">可用CNY</div>
			<div class="col">冻结CNY</div>
			<div class="col">可用GC</div>
			<div class="col">冻结GC</div>
			<div class="col">登陆密码</div>
			<div class="col">安全密码</div>
		</li>
		<?php
$_from = $_smarty_tpl->tpl_vars['member']->value;
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
		<li class="rowl row_list" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
</div>
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['manname'];?>
</div>
			<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['addTime']);?>
</div>
			<div class="col">
				<?php if ($_smarty_tpl->tpl_vars['value']->value['isallow'] == 0) {?>
				<button type="button" class="btn enable">允许</button>
				<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['isallow'] == 1) {?>
				<button type="button" class="btn disable">禁止</button>
				<?php }?>
			</div>
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['kycny'];?>
</div>
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['buycny'];?>
</div>
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['kyjf'];?>
</div>
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['buyjf'];?>
</div>
			<div class="col">
				<button type="button" data-toggle="modal" data-target="#pass" class="btn-pass">重置密码</button>
			</div>
			<div class="col">
				<button type="button" data-toggle="modal" data-target="#safepass" class="btn-safepass">重置安全密码</button>
			</div>
		</li>
		<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
		<?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

	</ul>
</div>
<!--会员管理面板-->
<!--重置密码-->
<div class="mask modal fade" id="pass" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="mask-main">
		<div class="mask-head">重置登录密码<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
		<form class="form-horizontal">
		<div class="form-group">
			<input type="hidden" class="memId" value="">
			<input type="password" class="form-control input-sm mask-input" id="pass" placeholder="请输入新密码">
			<input type="password" class="form-control input-sm mask-input" id="pass2" placeholder="请确认新的密码">
			<button type="button" class="btn-select btn-submit">确认</div>
		</div>
		</form>
		</div>
	</div>
</div>
<!--重置密码-->
<!--重置安全密码-->
<div class="mask modal fade" id="safepass" role="diaglog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="mask-main">
		<div class="mask-head">重置安全密码<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
		<form class="form-horizontal">
		<div class="form-group">
			<input type="hidden" class="memId" value="">
			<input type="password" class="form-control input-sm mask-input" id="safepass" placeholder="请输入新密码">
			<input type="password" class="form-control input-sm mask-input" id="safepass2" placeholder="请确认新的密码">
			<button type="button" class="btn-select btn-submit">确认</div>
		</div>
		</form>
		</div>
	</div>
</div>
<!--重置安全密码-->
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
	var _mask = $(".mask").height();
	var _h = _mask * 0.15;
	$(".mask").css("margin-top",-parseInt((_mask+_h)/2) + "px");
	
	$(".list-member>li>div>.btn-pass, .list-member>li>div>.btn-safepass").bind("click",function(){
		var _memId = $(this).parent().parent("li").attr("data-id");
		$(".mask .memId").val(_memId);
	})
})
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
