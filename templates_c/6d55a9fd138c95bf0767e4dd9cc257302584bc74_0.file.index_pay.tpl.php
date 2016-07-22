<?php
/* Smarty version 3.1.29, created on 2016-05-25 16:42:26
  from "E:\webProject\gjx-coin.com\web\templates\index_pay.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5745657202b217_68607864',
  'file_dependency' => 
  array (
    '6d55a9fd138c95bf0767e4dd9cc257302584bc74' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\templates\\index_pay.tpl',
      1 => 1463557824,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5745657202b217_68607864 ($_smarty_tpl) {
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
		<li>&nbsp;&nbsp;充值</li>
	</ul>
</div>
<!--面包屑导航-->
<!--充值面板-->
<div class="pay">
	<ul id="myPay" class="nav">
		<li><a href="#cny" data-toggle="tab">CNY</a></li>
		<li><a href="#btc" data-toggle="tab">BTC</a></li>
		<li><a href="#ltc" data-toggle="tab">LTC</a></li>
		<li><a href="#gc" data-toggle="tab">GC</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="notice">
			<span class="red-color">充值须知:</span>
		</div>
		<!--cny tab-->
		<div class="tab-pane in active" id="cny">
			<div class="tab-form">
				<form name="uploadForm" id="uploadForm" method="post" enctype="multipart/form-data" action="upload.php">
				<span class="form_title">转账汇款充值</span>
				<input type="text" class="form-control input" name="payname" id="payname" placeholder="请输入打款人姓名">
				<input type="text" class="form-control input" name="payamount" id="payamount" placeholder="请输入汇款金额">
				<input type="text" class="form-control form_datetime1 input" readonly="readonly" name="paytime" id="paytime" placeholder="请选择汇款时间">
				<textarea name="memo" id="memo" class="textarea" placeholder="请输入打款说明"></textarea>
				<div>
					<input type="hidden" value="20000000000" name="MAX_FILE_SIZE">
					<input type="text" onclick="$('#file').click()" readonly="read-only" class="form-control input" placeholder="请选择上传大款凭证" style="display:inline-block; width: 80%;">
					<input type="file" id="pic" name="pic" class="input form-control" placeholder="请选择上传大款凭证" style="display:none;">
          <a href="javascript:$('#pic').click()" class="full-button">选择文件</a>
				</div>
				<input type="submit" name="submit" class="btn btn_submit btn_upload" value="提交">
				</form>
			</div>
			<div class="pay_record tab-record">
				<div class="title">转账汇款充值记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">汇款编号</div>
						<div class="col">汇款人姓名</div>
						<div class="col">汇款金额</div>
						<div class="col">汇款凭证</div>
						<div class="col">汇款日期</div>
						<div class="col">最后更新时间</div>
						<div class="col">审核状态</div>
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
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['payname'];?>
</div>
						<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['paymoney'];?>
</div>
						<div class="col"><a href="<?php echo str_replace("../../","/",$_smarty_tpl->tpl_vars['value']->value['picUrl']);?>
" target="_blank"><img src="<?php echo str_replace("../../","/",$_smarty_tpl->tpl_vars['value']->value['picUrl']);?>
" width="120" height="24"></a></div>
						<div class="col"><?php echo date("Y-m-d",$_smarty_tpl->tpl_vars['value']->value['paytime']);?>
</div>
						<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['addtime']);?>
</div>
						<div class="col">
						<?php if ($_smarty_tpl->tpl_vars['value']->value['paystatus'] == 1) {?>
						<span style="color:#ff0000;">审核中</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['paystatus'] == 2) {?>
						审核成功
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
				</ul>
			</div>
		</div>
		<!--btc tab-->
		<div class="tab-pane" id="btc">
			<span class="tit">BTC充值地址</span>
			<div class="tab-input"><input class="input form-control" type="text" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['btcaddr']->value;?>
"></div>
		</div>
		<!--ltc tab-->
		<div class="tab-pane" id="ltc">
			<span class="tit">LTC充值地址</span>
			<div class="tab-input"><input class="input form-control" type="text" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['ltcaddr']->value;?>
"></div>
		</div>
		<!--gc tab-->
		<div class="tab-pane" id="gc">
			<span class="tit">GC充值地址</span>
			<div class="tab-input"><input class="input form-control" type="text" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['gcaddr']->value;?>
"></div>
			<!--data list-->
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
				</ul>
			</div>	
		</div>
	</div>		
</div>

<?php echo '<script'; ?>
>
$(function(){
	$("#myPay li:eq(0) a").tab("show");
	$(".form_datetime1").datetimepicker({minView: "month", format: 'yyyy-mm-dd', language: 'zh-CN', autoclose: true});
})
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../plugins/datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../../plugins/datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"><?php echo '</script'; ?>
>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
