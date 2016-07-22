<?php
/* Smarty version 3.1.29, created on 2016-05-27 12:30:29
  from "E:\webProject\gjx-coin.com\web\templates\index_t.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5747cd65130fd0_75879582',
  'file_dependency' => 
  array (
    'dfae2fee4daf204482ff2ec18a2a9236a4df305d' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\templates\\index_t.tpl',
      1 => 1464323393,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5747cd65130fd0_75879582 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "../plugins/smarty/configs/test.conf", "setup", 0);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GTrade'), 0, false);
?>


<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;交易中心</li>
	</ul>
</div>
<!--面包屑导航-->

<!--交易面板-->
<div class="trade">
	<ul id="myTrade" class="nav">
		<li><a href="#CNY" data-toggle="tab">CNY/GC交易</a></li>
		<li><a href="#BTC" data-toggle="tab">BTC/GC交易</a></li>
		<li><a href="#LTC" data-toggle="tab">LTC/GC交易</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane in active" id="CNY">
			<!--卖出-->
			<div class="trade-sell">
				<div class="trade-sell-title">
					<span>可用：<?php echo $_smarty_tpl->tpl_vars['kygc']->value;?>
&nbsp;GC</span>
					<p>今日可交易GC余额：<?php echo $_smarty_tpl->tpl_vars['leftGC']->value;?>
</p>
				</div>
				<div class="trade-sell-input">
					<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['kycny']->value;?>
" id="kycny">
					<input type="text" class="form-control" id="sellprice" value="<?php echo $_smarty_tpl->tpl_vars['argcny']->value;?>
" placeholder="卖出价CNY/GC">
				</div>
				<div class="trade-sell-line">
					<span class="trade-black-line"></span>
					<span class="line-hollow" id="sell" style="z-index: 100; left: 0px;"></span>
					<span class="line-solid"></span>
					<span class="line-solid"></span>
					<span class="line-solid"></span>
					<span class="line-solid"></span>
					<span class="line-solid"></span>
				</div>
				<div class="trade-sell-input">
					<input type="text" class="form-control" value="" id="sellnum" placeholder="卖出数量">
				</div>
				<div class="trade-sell-input">
					<input type="text" class="form-control" readonly="readonly" id="sellmoney" placeholder="总价">
				</div>
				<button type="button" class="btn sell-btn" id="sell_cny">卖</button>
			</div>
			<!--购买-->
			<div class="trade-buy">
				<span class="trade-buy-title">可用CNY：<b><?php echo $_smarty_tpl->tpl_vars['kycny']->value;?>
</b></span>
				<div class="trade-buy-content">
					<ul>
						<li class="row_title">
							<div class="col">出售人</div>
							<div class="col">出售价格</div>
							<div class="col">出售数量</div>
							<div class="col">出售金额</div>
							<div class="col">出售日期</div>
							<div class="col">状态</div>
							<div class="col">操作</div>
						</li>
						<!--data list-->
						<?php
$_from = $_smarty_tpl->tpl_vars['sellist']->value;
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
							<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['seller'];?>
</div>
							<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellprice'];?>
</div>
							<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellnum'];?>
</div>
							<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellmoney'];?>
</div>
							<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['selltime']);?>
</div>
							<div class="col">
								<?php if ($_smarty_tpl->tpl_vars['value']->value['isstatus'] == 0) {?>
								未成交
								<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['isstatus'] == 1) {?>
								已成交
								<?php }?>
							</div>
							<div class="col"><button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn_buy">买</button></div>
						</li>
						<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
						<!--data list-->
					</ul>
				</div>
			</div>
			<div class="cls" style="height:1px; overflow:hidden; background:#d6d6d6;"></div>
			<!-- 当前委托 -->
			<div class="current">
				<div class="trade_title">
					当前委托
				</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">委托时间</div>
						<div class="col">委托类型</div>
						<div class="col">委托价格</div>
						<div class="col">委托数量</div>
						<div class="col">成交数量</div>
						<div class="col">委托金额</div>
						<div class="col">状态</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['mysell']->value;
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
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['selltime']);?>
</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['tradetype'] == 1) {?>
						CNY/GC
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['tradetype'] == 2) {?>
						BTC/GC
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['tradetype'] == 3) {?>
						LTC/GC
						<?php }?>
						</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellprice'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellnum'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['buynum'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellmoney'];?>
</div>
						<div class="col">
							<?php if ($_smarty_tpl->tpl_vars['value']->value['isstatus'] == 0) {?>
							未成交
							<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['isstatus'] == 1) {?>
							已成交
							<?php }?>
						</div>
						<div class="col"><button type="button" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn_cancel">撤消</button>
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
			<!-- 当前委托 -->
			<!-- 成交记录 -->
			<div class="trade-record">
				<div class="trade_title">
					成交记录
				</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">成交时间</div>
						<div class="col">成交类型</div>
						<div class="col">成交价格</div>
						<div class="col">成交数量</div>
						<div class="col">成交金额</div>
					</li>
					<!--data list-->
					<?php
$_from = $_smarty_tpl->tpl_vars['record']->value;
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
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['tradetime']);?>
</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['tradetype'] == 1) {?>
						CNY/GC
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['tradetype'] == 2) {?>
						BTC/GC
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['tradetype'] == 3) {?>
						LTC/GC
						<?php }?>
						</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['sellprice'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['buynum'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['buymoney'];?>
</div>
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
			<!-- 成交记录 -->
		</div>
		<div class="tab-pane" id="BTC">
			BTC交易
		</div>
		<div class="tab-pane" id="LTC">
			LTC交易
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
}
}
