<?php
/* Smarty version 3.1.29, created on 2016-05-25 16:40:12
  from "E:\webProject\gjx-coin.com\web\templates\index_p.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574564ece46b43_42309775',
  'file_dependency' => 
  array (
    '1d6d292c3e1c325f7d0097443b3433caa409ce80' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\templates\\index_p.tpl',
      1 => 1460451840,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_574564ece46b43_42309775 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "../plugins/smarty/configs/test.conf", "setup", 0);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GTrade'), 0, false);
?>


<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;个人中心</li>
	</ul>
</div>
<!--面包屑导航-->
<!--当前余额-->
<div class="currency">
	<ul>
		<li class="free">
			<div class="rmb"></div>
			<p>可用人民币余额</p>
			<span><?php echo $_smarty_tpl->tpl_vars['rmb']->value;?>
</span>
		</li>
		<li class="freeze">
			<div class="frmb"></div>
			<div class="lock"></div>
			<p>冻结人民币余额</p>
			<span><?php echo $_smarty_tpl->tpl_vars['lockrmb']->value;?>
</span>
		</li>
		<li class="free">
			<div class="btc"></div>
			<p>可用比特币余额</p>
			<span><?php echo $_smarty_tpl->tpl_vars['btc']->value;?>
</span>
		</li>
		<li class="freeze">
			<div class="fbtc"></div>
			<div class="lock"></div>
			<p>冻结比特币余额</p>
			<span><?php echo $_smarty_tpl->tpl_vars['lockbtc']->value;?>
</span>
		</li>
		<li class="free">
			<div class="ltc"></div>
			<p>可用莱特币余额</p>
			<span><?php echo $_smarty_tpl->tpl_vars['ltc']->value;?>
</span>
		</li>
		<li class="freeze">
			<div class="fltc"></div>
			<div class="lock"></div>
			<p>冻结莱特币余额</p>
			<span><?php echo $_smarty_tpl->tpl_vars['lockltc']->value;?>
</span>
		</li>
		<li class="free">
			<div class="gc"></div>
			<p>可用天合G值余额</p>
			<span><?php echo $_smarty_tpl->tpl_vars['gc']->value;?>
</span>
		</li>
		<li class="freeze">
			<div class="fgc"></div>
			<div class="lock"></div>
			<p>冻结天合G值余额</p>
			<span><?php echo $_smarty_tpl->tpl_vars['lockgc']->value;?>
</span>
		</li>
	</ul>
</div>
<!--当前余额-->
<!--委托记录-->
<div class="notes">
	<div class="lab">委托记录（最近10条）</div>
	<ul>
		<li>
					<div>委托ID</div>
					<div>委托类型</div>
					<div>委托数量</div>
					<div>委托价格</div>
					<div>委托金额</div>
					<div>成交数量</div>
					<div>未成交数量</div>
					<div>状态</div>
					<div>操作</div>
		</li>
	</ul>
</div>
<!--委托记录-->
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
