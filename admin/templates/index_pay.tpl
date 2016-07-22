<{include file="header.tpl" title=GTrade}>

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
					<{foreach from=$arrCny item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.payer}></div>
						<div class="col"><{$value.payname}></div>
						<div class="col"><{$value.paymoney}></div>
						<div class="col"><a href="<{str_replace("../../","/",$value.picUrl)}>" target="_blank"><img src="<{str_replace("../../","/",$value.picUrl)}>" width="120" height="24"></a></div>
						<div class="col"><{date("Y-m-d",$value.paytime)}></div>
						<div class="col">
						<{if $value.paystatus==1}>
							<button type="button" data-id="<{$value.id}>">审核</button>
						<{elseif $value.paystatus==2}>
							<a class="exam">已审核</a>
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
					<{foreach from=$arrGc item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.payer}></div>
						<div class="col"><{$value.paymoney}></div>
						<div class="col"><{$value.transfer}></div>
						<div class="col"><{date('Y-m-d H:i:s',$value.paytime)}></div>
						<div class="col">
						<{if $value.paystatus==1}>
						<span style="color:#ff0000;">充值不成功</span>
						<{elseif $value.paystatus==2}>
						充值成功
						<{/if}>
						</div>
					</li>
					<{/foreach}>
					<!--data list-->
				</ul>
			</div>
		</div>
	</div>
</div>
<!--参数设置面板-->
<{include file="footer.tpl"}>
