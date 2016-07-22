<{include file="header.tpl" title=GTrade}>

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
			<span><{$rmb}></span>
		</li>
		<li class="freeze">
			<div class="frmb"></div>
			<div class="lock"></div>
			<p>冻结人民币余额</p>
			<span><{$lockrmb}></span>
		</li>
		<li class="free">
			<div class="btc"></div>
			<p>可用比特币余额</p>
			<span><{$btc}></span>
		</li>
		<li class="freeze">
			<div class="fbtc"></div>
			<div class="lock"></div>
			<p>冻结比特币余额</p>
			<span><{$lockbtc}></span>
		</li>
		<li class="free">
			<div class="ltc"></div>
			<p>可用莱特币余额</p>
			<span><{$ltc}></span>
		</li>
		<li class="freeze">
			<div class="fltc"></div>
			<div class="lock"></div>
			<p>冻结莱特币余额</p>
			<span><{$lockltc}></span>
		</li>
		<li class="free">
			<div class="gc"></div>
			<p>可用天合G值余额</p>
			<span><{$gc}></span>
		</li>
		<li class="freeze">
			<div class="fgc"></div>
			<div class="lock"></div>
			<p>冻结天合G值余额</p>
			<span><{$lockgc}></span>
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
<{include file="footer.tpl"}>
