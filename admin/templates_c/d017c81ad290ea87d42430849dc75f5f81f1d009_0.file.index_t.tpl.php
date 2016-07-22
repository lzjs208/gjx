<?php
/* Smarty version 3.1.29, created on 2016-05-26 17:21:01
  from "E:\webProject\gjx-coin.com\web\admin\templates\index_t.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5746bffdc3fa01_26199788',
  'file_dependency' => 
  array (
    'd017c81ad290ea87d42430849dc75f5f81f1d009' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\admin\\templates\\index_t.tpl',
      1 => 1464254460,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5746bffdc3fa01_26199788 ($_smarty_tpl) {
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
<!--交易面板-->
<div class="wrapper-panel trade-panel">
	<ul id="myTrade" class="nav nav-tab">
		<li class="active"><a href="index.php?argtype=1#cny" data-toggle="tab" aria-expanded="true">CNY/GC交易</a></li>
		<li><a href="index.php?argtype=2#btc" data-toggle="tab" aria-expanded="true">BTC/GC交易</a></li>
		<li><a href="index.php?argtype=3#ltc" data-toggle="tab" aria-expanded="true">LTC/GC交易</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane active" id="cny">
			<div class="trade_record">
				<div class="title">CNY/GC委托</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">委托人</div>
						<div class="col">委托时间</div>
						<div class="col">委托类型</div>
						<div class="col">委托价格</div>
						<div class="col">委托数量</div>
						<div class="col">委托金额</div>
						<div class="col">购买人</div>
						<div class="col">交易时间</div>
						<div class="col">状态</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['cnyTrade']->value;
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
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['seller'];?>
</div>
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['selltime']);?>
</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['tradetype'] == 1) {?>
							CNY/GC
						<?php } else { if (!isset($_smarty_tpl->tpl_vars['value']) || !is_array($_smarty_tpl->tpl_vars['value']->value)) $_smarty_tpl->smarty->ext->_var->createLocalArrayVariable($_smarty_tpl, 'value');
if ($_smarty_tpl->tpl_vars['value']->value['tradetype'] = 2) {?>
							BTC/GC
						<?php } else { if (!isset($_smarty_tpl->tpl_vars['value']) || !is_array($_smarty_tpl->tpl_vars['value']->value)) $_smarty_tpl->smarty->ext->_var->createLocalArrayVariable($_smarty_tpl, 'value');
if ($_smarty_tpl->tpl_vars['value']->value['tradetype'] = 3) {?>
							LTC/GC
						<?php }}}?>
						</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellprice'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellnum'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellmoney'];?>
</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['buyer'] == '') {?>
						未成交
						<?php } else { ?>
						<?php echo $_smarty_tpl->tpl_vars['value']->value['buyer'];?>

						<?php }?>
						</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['tradetime'] == '') {?>
						未成交
						<?php } else { ?>
						<?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['tradetime']);?>

						<?php }?>
						</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['isstatus'] == 0) {?>
						未成交
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['isstatus'] == 1) {?>
						<span style='color:#CC0000;'>已成交</span>
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
			<div class="trade_record">
				<div class="title">BTC参数设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">委托时间</div>
						<div class="col">委托类型</div>
						<div class="col">委托价格</div>
						<div class="col">委托数量</div>
						<div class="col">委托金额</div>
						<div class="col">购买人</div>
						<div class="col">状态</div>
					</li>
					<!--data list-->

					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="ltc">
			<div class="trade_record">
				<div class="title">LTC参数设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">委托时间</div>
						<div class="col">委托类型</div>
						<div class="col">委托价格</div>
						<div class="col">委托数量</div>
						<div class="col">委托金额</div>
						<div class="col">购买人</div>
						<div class="col">状态</div>
					</li>
					<!--data list-->

					<!--data list-->
				</ul>
			</div>
		</div>
	</div>
</div>
<!--交易面板-->

<?php echo '<script'; ?>
>
$(function(){
	$("#myTrade li:eq(0) a").tab("show");
})
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
