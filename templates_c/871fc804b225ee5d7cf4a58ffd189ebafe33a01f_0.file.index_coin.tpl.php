<?php
/* Smarty version 3.1.29, created on 2016-05-25 19:30:13
  from "E:\webProject\gjx-coin.com\web\templates\index_coin.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57458cc5844717_49624946',
  'file_dependency' => 
  array (
    '871fc804b225ee5d7cf4a58ffd189ebafe33a01f' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\templates\\index_coin.tpl',
      1 => 1460713021,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_57458cc5844717_49624946 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "../plugins/smarty/configs/test.conf", "setup", 0);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GTrade'), 0, false);
?>

<link href="../../plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;提现地址</li>
	</ul>
</div>
<!--面包屑导航-->
<!--充值面板-->
<div class="coin">
	<ul id="myCoin" class="nav">
		<li><a href="#cny" data-toggle="tab">CNY</a></li>
		<li><a href="#btc" data-toggle="tab">BTC</a></li>
		<li><a href="#ltc" data-toggle="tab">LTC</a></li>
		<li><a href="#gc" data-toggle="tab">GC</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="notice">
			<span class="red-color">提现须知:</span>
		</div>
		<!--cny tab-->
		<div class="tab-pane in active" id="cny">
			<div class="tab-form">
				<span class="form_title">银行卡地址</span>
				<input type="hidden" id="cointype" value="4">
				<input type="text" name="cny_addname" id="addname" class="form-control input" placeholder="请输入您的姓名">
				<p class="red-color">*银行卡账户名必须与您的实名认证姓名一致</p>
				<input type="text" name="cny_card" id="addcard" class="form-control input" placeholder="请输入您的银行卡号">
				<input type="text" name="cny_bank" id="addbank" class="form-control input" placeholder="请输入您的开户银行">
				<input type="text" name="cny_bankaddress" id="addbankaddress" class="form-control input" placeholder="请输入您的开户银行地址">
				<input type="text" name="memo" id="memo" class="form-control input" placeholder="备注">
				<button type="button" class="btn btn_submit btn_coin">提交</button>
			</div>
			<div class="coin-record ">
				<div class="title">提现地址</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">姓名</div>
						<div class="col">银行卡号</div>
						<div class="col">开户银行</div>
						<div class="col">开户银行地址</div>
						<div class="col">备注</div>
						<div class="col">操作</div>
					</li>
					<?php
$_from = $_smarty_tpl->tpl_vars['cny']->value;
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
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['cny_addname'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['cny_card'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['cny_bank'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['cny_bankaddress'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['memo'];?>
</div>
						<div class="col"><button type="button" class="btn btn_coin_del" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">删除</button></div>
					</li>
					<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
				</ul>
			</div>
		</div>
		<!--btc tab-->
		<div class="tab-pane" id="btc">

		</div>
		<!--ltc tab-->
		<div class="tab-pane" id="ltc">
			
		</div>
		<!--gc tab-->
		<div class="tab-pane" id="gc">

		</div>
	</div>		
</div>

<?php echo '<script'; ?>
>
$(function(){
	$("#myCoin li:eq(0) a").tab("show");
})
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
