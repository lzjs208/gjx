<?php
/* Smarty version 3.1.29, created on 2016-05-18 11:19:46
  from "E:\webProject\gjx-coin.com\web\admin\templates\index_c.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_573bdf52e49664_40385894',
  'file_dependency' => 
  array (
    'afbb64bb09f3c5854c18700047438152df6f255b' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\admin\\templates\\index_c.tpl',
      1 => 1463540420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_573bdf52e49664_40385894 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "../../plugins/smarty/configs/test.conf", "setup", 0);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GTrade'), 0, false);
?>


<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;提现审核</li>
	</ul>
</div>
<!--面包屑导航-->
<!--提现审核面板-->
<div class="wrapper-panel">
	<ul id="args-panel" class="nav nav-tab">
		<li class="active"><a href="#cny" data-toggle="tab" aria-expanded="true">CNY</a></li>
		<li><a href="#btc" data-toggle="tab" aria-expanded="true">BTC</a></li>
		<li><a href="#ltc" data-toggle="tab" aria-expanded="true">LTC</a></li>
		<li><a href="#gc" data-toggle="tab" aria-expanded="true">GC</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane active" id="cny">
			<div class="cash_list tab_list">
				<div class="title">CNY提现申请</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">提现编号</div>
						<div class="col">提现类型</div>
						<div class="col">申请人</div>
						<div class="col">申请时间</div>
						<div class="col">提现金额</div>
						<div class="col">提现状态</div>
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
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['cashtype'] == 1) {?>
						BTC
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['cashtype'] == 2) {?>
						LTC
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['cashtype'] == 3) {?>
						GC
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['cashtype'] == 4) {?>
						CNY
						<?php }?>
						</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['casher'];?>
</div>
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['cashtime']);?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['cashmoney'];?>
</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['cashstatus'] == 1) {?>
							<span style="color:#c83012;">待审核</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['cashstatus'] == 2) {?>
							已审核
						<?php }?>
						</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['cashstatus'] == 1) {?>
							<button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn_exam">审核</button>
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['cashstatus'] == 2) {?>
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
				<div class="title">BTC提现申请</div>
				
			</div>
		</div>
		<div class="tab-pane" id="ltc">
			<div class="pay_record">
				<div class="title">LTC提现申请</div>
				
			</div>
		</div>
		<div class="tab-pane" id="gc">
			<div class="pay_record">
				<div class="title">GC提现申请</div>
				
			</div>
		</div>
	</div>
</div>
<!--参数设置面板-->
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
