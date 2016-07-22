<?php
/* Smarty version 3.1.29, created on 2016-05-26 09:03:09
  from "E:\webProject\gjx-coin.com\web\templates\index_c.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57464b4d8869c5_43022932',
  'file_dependency' => 
  array (
    '071796cb7873f41903fea8f5b642e5f0812fd781' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\templates\\index_c.tpl',
      1 => 1464224587,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_57464b4d8869c5_43022932 ($_smarty_tpl) {
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
		<li>&nbsp;&nbsp;提现</li>
	</ul>
</div>
<!--面包屑导航-->
<!--充值面板-->
<div class="cash">
	<ul id="myCash" class="nav">
		<li><a href="#cny" data-toggle="tab">CNY</a></li>
		<li><a href="#btc" data-toggle="tab">BTC</a></li>
		<li><a href="#ltc" data-toggle="tab">LTC</a></li>
		<li><a href="#gc" data-toggle="tab">GC</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<!--cny tab-->
		<div class="tab-pane in active" id="cny">
			<div class="notice">
				<div class="red-color">可用提现余额：<?php echo $_smarty_tpl->tpl_vars['kycny']->value;?>
，单日提现总计不超过<?php echo $_smarty_tpl->tpl_vars['cash_amount']->value;?>
元，提手续费为提现金额的<span id="arg_cost"><?php echo $_smarty_tpl->tpl_vars['cash_cost']->value;?>
</span>%，周六周日不能提现</span></div>
			</div>
			<div class="cash_form tab-form" style="width:35%;margin-top:10px;">
				<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" disabled="disabled" id="email">
				<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['kycny']->value;?>
" disabled="disabled" id="kycny">
				<div class="cny_select">
					<select id="bank_sel"><option value="0">请选择一个银行卡</option></select>
				</div>
				<input type="text" name="money" id="cnyamount" class="form-control input" placeholder="金额">
				提现手续费：<span id="cny_cost"></span>
				<div class="code">
					<input type="text" id="code" class="form-control mask-input input-b">
					<button type="button" id="emailcode">获取验证码</button>
				</div>
				<button type="button" class="btn btn_submit btn_cash">提交</button>
			</div>
			<div class="cash_record">
				<div class="title">提现记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">提现编号</div>
						<div class="col">提现类型</div>
						<div class="col">提现时间</div>
						<div class="col">提现账户</div>
						<div class="col">提现金额</div>
						<div class="col">提现手续费</div>
						<div class="col">提现状态</div>
					</li>
					<?php
$_from = $_smarty_tpl->tpl_vars['cnylist']->value;
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
							<div class="col"><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['value']->value['cashtime']);?>
</div>
							<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['cashbank'];?>
</div>
							<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['cashmoney'];?>
</div>
							<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['cashcost'];?>
</div>
							<div class="col">
							<?php if ($_smarty_tpl->tpl_vars['value']->value['cashstatus'] == 1) {?>
							<span style="color:#c83012;">审核中</span>
							<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['cashstatus'] == 2) {?>
							已审核
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
				</ul>
			</div>
		</div>
		<!--btc tab-->
		<div class="tab-pane" id="btc">
			<div class="notice">
				<span class="red-color">单日提现总计不超过<?php echo $_smarty_tpl->tpl_vars['cash_amount']->value;?>
元,周六周日不能提现,今日提现限额:<?php echo $_smarty_tpl->tpl_vars['cash_btc']->value;?>
</span>
			</div>
		</div>
		<!--ltc tab-->
		<div class="tab-pane" id="ltc">
			<div class="notice">
				<span class="red-color">单日提现总计不超过<?php echo $_smarty_tpl->tpl_vars['cash_amount']->value;?>
元,周六周日不能提现,今日提现限额:<?php echo $_smarty_tpl->tpl_vars['cash_ltc']->value;?>
</span>
			</div>
		</div>
		<!--gc tab-->
		<div class="tab-pane" id="gc">
			<div class="notice">
				<span class="red-color">单日提现总计不超过<?php echo $_smarty_tpl->tpl_vars['cash_amount']->value;?>
元,周六周日不能提现,今日提现限额:<?php echo $_smarty_tpl->tpl_vars['cash_gc']->value;?>
</span>
			</div>
		</div>
	</div>		
</div>

<?php echo '<script'; ?>
>
$(function(){
	$("#myCash li:eq(0) a").tab("show");
	var url = "../cash/get.coinaddr.php";
	$.get(url,{id:4},function(data){
		$(".cny_select").html(data);
	})//--ajax end
})
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
