<?php
/* Smarty version 3.1.29, created on 2016-05-20 16:40:09
  from "E:\webProject\gjx-coin.com\web\admin\templates\index_pay.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_573ecd69c1bf74_82620970',
  'file_dependency' => 
  array (
    '94239a2bcabb2224857c149e62fd9b457749cf40' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\admin\\templates\\index_pay.tpl',
      1 => 1463733608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_573ecd69c1bf74_82620970 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "../../plugins/smarty/configs/test.conf", "setup", 0);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GTrade'), 0, false);
?>


<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;充值审核</li>
	</ul>
</div>
<!--面包屑导航-->
<!--充值审核面板-->
<div class="wrapper-panel">
	<ul id="args-panel" class="nav nav-tab">
		<li class="active"><a href="#cny" data-toggle="tab" aria-expanded="true">CNY充值记录</a></li>
		<li><a href="#btc" data-toggle="tab" aria-expanded="true">BTC充值记录</a></li>
		<li><a href="#ltc" data-toggle="tab" aria-expanded="true">LTC充值记录</a></li>
		<li><a href="#gc" data-toggle="tab" aria-expanded="true">GC充值记录</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane active" id="cny">
			<div class="pay_record tab_list">
				<div class="title">CNY充值记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">汇款编号</div>
						<div class="col">用户名</div>
						<div class="col">汇款人姓名</div>
						<div class="col">汇款金额</div>
						<div class="col">汇款凭证</div>
						<div class="col">汇款日期</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['arrCny']->value;
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
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['payer'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['payname'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['paymoney'];?>
</div>
						<div class="col"><a href="<?php echo str_replace("../../","/",$_smarty_tpl->tpl_vars['value']->value['picUrl']);?>
" target="_blank"><img src="<?php echo str_replace("../../","/",$_smarty_tpl->tpl_vars['value']->value['picUrl']);?>
" width="120" height="24"></a></div>
						<div class="col"><?php echo date("Y-m-d",$_smarty_tpl->tpl_vars['value']->value['paytime']);?>
</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['paystatus'] == 1) {?>
							<button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">审核</button>
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['paystatus'] == 2) {?>
							<a class="exam">已审核</a>
						<?php }?>
						</div>
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
			<div class="pay_record">
				<div class="title">BTC充值记录</div>
				
			</div>
		</div>
		<div class="tab-pane" id="ltc">
			<div class="pay_record">
				<div class="title">LTC充值记录</div>
				
			</div>
		</div>
		<div class="tab-pane" id="gc">
			<div class="pay_record tab-data">
				<div class="title">GC充值记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">充值编号</div>
						<div class="col">用户名</div>
						<div class="col">充值金额</div>
						<div class="col">充值人</div>
						<div class="col">充值日期</div>
						<div class="col">状态</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['arrGc']->value;
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
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['payer'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['paymoney'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['transfer'];?>
</div>
						<div class="col"><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['value']->value['paytime']);?>
</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['paystatus'] == 1) {?>
						<span style="color:#ff0000;">充值不成功</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['paystatus'] == 2) {?>
						充值成功
						<?php }?>
						</div>
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
	</div>
</div>
<!--参数设置面板-->
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
