<?php
/* Smarty version 3.1.29, created on 2016-05-23 00:37:14
  from "D:\appSrv\gjx-coin\web\admin\templates\index_a.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5741e03ad05790_00336287',
  'file_dependency' => 
  array (
    '56e53ead19184f4683fb06addc8d8e9c911545f4' => 
    array (
      0 => 'D:\\appSrv\\gjx-coin\\web\\admin\\templates\\index_a.tpl',
      1 => 1463935031,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5741e03ad05790_00336287 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "../../plugins/smarty/configs/test.conf", "setup", 0);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GTrade'), 0, false);
?>


<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;参数设置</li>
	</ul>
</div>
<!--面包屑导航-->
<!--参数设置面板-->
<div class="wrapper-panel arg-panel">
	<ul id="args-panel" class="nav nav-tab">
		<li class="active"><a href="#cny" data-toggle="tab" aria-expanded="true">CNY汇率设置</a></li>
		<li><a href="#btc" data-toggle="tab" aria-expanded="true">BTC汇率设置</a></li>
		<li><a href="#ltc" data-toggle="tab" aria-expanded="true">LTC汇率设置</a></li>
		<li><a href="#upcash" data-toggle="tab" aria-expanded="true">单日提现GC</a></li>
		<li><a href="#upamount" data-toggle="tab" aria-expanded="true">提现总额</a></li>
		<li><a href="#cost" data-toggle="tab" aria-expanded="true">提现手续费</a></li>
		<li><a href="#gc" data-toggle="tab" aria-expanded="true">交易GC总额</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane active" id="cny">
			<span class="arg_set">CNY汇率设置</span><input type="hidden" class="args_type" value="cny"><input type="text" name="args_cny" class="form-control args_val" placeholder="CNY汇率设置"><button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">CNY参数设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">利率</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
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
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['val'];?>
</div>
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['times']);?>
</div>
						<div class="col"><button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">删除</button></div>
					</li>
					<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
					<!--data list-->
					<?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

				</ul>
			</div>
		</div>
		<div class="tab-pane" id="btc">
			<span class="arg_set">BTC汇率设置</span><input type="hidden" class="args_type" value="btc"><input type="text" name="args_btc" class="form-control args_val" placeholder="BTC汇率设置"><button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">BTC参数设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">利率</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['btc']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_1_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$__foreach_value_1_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
					<li class="rowl row_list">
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['val'];?>
</div>
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['times']);?>
</div>
						<div class="col"><button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">删除</button></div>
					</li>
					<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_1_saved_local_item;
}
if ($__foreach_value_1_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_1_saved_item;
}
?>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="ltc">
			<span class="arg_set">LTC汇率设置</span><input type="hidden" class="args_type" value="ltc"><input type="text" name="args_ltc" class="form-control args_val" placeholder="LTC汇率设置"><button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">LTC参数设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">利率</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['ltc']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_2_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$__foreach_value_2_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
					<li class="rowl row_list">
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['val'];?>
</div>
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['times']);?>
</div>
						<div class="col"><button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">删除</button></div>
					</li>
					<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_2_saved_local_item;
}
if ($__foreach_value_2_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_2_saved_item;
}
?>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="upcash">
			<span class="arg_set">提现设置</span><input type="hidden" class="args_type" value="up"><input type="text" name="args_up" class="form-control args_val" placeholder="单日提现GC"><button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">提现设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">金额</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['up']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_3_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$__foreach_value_3_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
					<li class="rowl row_list">
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['val'];?>
</div>
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['times']);?>
</div>
						<div class="col"><button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">删除</button></div>
					</li>
					<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_3_saved_local_item;
}
if ($__foreach_value_3_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_3_saved_item;
}
?>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="upamount">
			<span class="arg_set">单日提现总额</span><input type="hidden" class="args_type" value="amount"><input type="text" name="args_amount" class="form-control args_val" placeholder="单日提现总额">元<button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">提现设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">金额</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['amount']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_4_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$__foreach_value_4_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
					<li class="rowl row_list">
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['val2'];?>
</div>
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['times']);?>
</div>
						<div class="col"><button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">删除</button></div>
					</li>
					<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_4_saved_local_item;
}
if ($__foreach_value_4_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_4_saved_item;
}
?>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="cost">
			<span class="arg_set">提现手续费</span><input type="hidden" class="args_type" value="cost"><input type="text" name="args_cost" class="form-control args_val" placeholder="提现手续费"> %<button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">提现设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">手续费</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['cost']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_5_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$__foreach_value_5_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
					<li class="rowl row_list">
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['val2'];?>
</div>
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['times']);?>
</div>
						<div class="col"><button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">删除</button></div>
					</li>
					<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_5_saved_local_item;
}
if ($__foreach_value_5_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_5_saved_item;
}
?>
					<!--data list-->
				</ul>
			</div>
		</div>
	</div>
</div>
<!--参数设置面板-->
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
