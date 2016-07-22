<{include file="header.tpl" title=GTrade}>

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
					<span>可用：<{$kygc}>&nbsp;GC</span>
					<p>今日可交易GC余额：<{$leftGC}></p>
				</div>
				<div class="trade-sell-input">
					<input type="hidden" value="<{$kycny}>" id="kycny">
					<input type="text" class="form-control" id="sellprice" value="<{$argcny}>" placeholder="卖出价CNY/GC">
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
				<span class="trade-buy-title">可用CNY：<b><{$kycny}></b></span>
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
						<{foreach from=$sellist item=value}>
						<li class="rowl row_list">
							<div class="col"><{$value.seller}></div>
							<div class="col"><{$value.sellprice}></div>
							<div class="col"><{$value.sellnum}></div>
							<div class="col"><{$value.sellmoney}></div>
							<div class="col"><{date("Y-m-d H:i:s",$value.selltime)}></div>
							<div class="col">
								<{if $value.isstatus == 0}>
								未成交
								<{elseif $value.isstatus == 1}>
								已成交
								<{/if}>
							</div>
							<div class="col"><button type="button" data-id="<{$value.id}>" class="btn btn_buy">买</button></div>
						</li>
						<{/foreach}>
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
					<{foreach from=$mysell item=value}>
					<li class="rowl row_list">
						<div class="col"><{date("Y-m-d H:i:s",$value.selltime)}></div>
						<div class="col">
						<{if $value.tradetype == 1}>
						CNY/GC
						<{elseif $value.tradetype == 2}>
						BTC/GC
						<{elseif $value.tradetype == 3}>
						LTC/GC
						<{/if}>
						</div>
						<div class="col"><{$value.sellprice}></div>
						<div class="col"><{$value.sellnum}></div>
						<div class="col"><{$value.buynum}></div>
						<div class="col"><{$value.sellmoney}></div>
						<div class="col">
							<{if $value.isstatus == 0}>
							未成交
							<{elseif $value.isstatus == 1}>
							已成交
							<{/if}>
						</div>
						<div class="col"><button type="button" data-id="<{$value.id}>" class="btn btn_cancel">撤消</button>
					</li>
					<{/foreach}>
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
					<{foreach from=$record item=value}>
					<li class="rowl row_list">
						<div class="col"><{date("Y-m-d H:i:s",$value.tradetime)}></div>
						<div class="col">
						<{if $value.tradetype == 1}>
						CNY/GC
						<{elseif $value.tradetype == 2}>
						BTC/GC
						<{elseif $value.tradetype == 3}>
						LTC/GC
						<{/if}>
						</div>
						<div class="col"><{$value.sellprice}></div>
						<div class="col"><{$value.buynum}></div>
						<div class="col"><{$value.buymoney}></div>
					</li>
					<{/foreach}>
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

<script>
$(function(){
	$("#myTrade li:eq(0) a").tab("show");
})
</script>
<{include file="footer.tpl"}>