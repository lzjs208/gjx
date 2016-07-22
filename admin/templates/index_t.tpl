<{include file="header.tpl" title=GTrade}>

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
					<{foreach from=$cnyTrade item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.seller}></div>
						<div class="col"><{date("Y-m-d H:i:s",$value.selltime)}></div>
						<div class="col">
						<{if $value.tradetype==1}>
							CNY/GC
						<{elseif $value.tradetype=2}>
							BTC/GC
						<{elseif $value.tradetype=3}>
							LTC/GC
						<{/if}>
						</div>
						<div class="col"><{$value.sellprice}></div>
						<div class="col"><{$value.sellnum}></div>
						<div class="col"><{$value.sellmoney}></div>
						<div class="col">
						<{if $value.buyer==""}>
						未成交
						<{else}>
						<{$value.buyer}>
						<{/if}>
						</div>
						<div class="col">
						<{if $value.tradetime==''}>
						未成交
						<{else}>
						<{date("Y-m-d H:i:s",$value.tradetime)}>
						<{/if}>
						</div>
						<div class="col">
						<{if $value.isstatus==0}>
						未成交
						<{elseif $value.isstatus==1}>
						<span style='color:#CC0000;'>已成交</span>
						<{/if}>
						</div>
					</li>
					<{/foreach}>
					<!--data list-->
					<{$pager}>
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

<script>
$(function(){
	$("#myTrade li:eq(0) a").tab("show");
})
</script>
<{include file="footer.tpl"}>
