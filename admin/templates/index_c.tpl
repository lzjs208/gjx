<{include file="header.tpl" title=GTrade}>

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
					<{foreach from=$arrCny item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col">
						<{if $value.cashtype==1}>
						BTC
						<{elseif $value.cashtype==2}>
						LTC
						<{elseif $value.cashtype==3}>
						GC
						<{elseif $value.cashtype==4}>
						CNY
						<{/if}>
						</div>
						<div class="col"><{$value.casher}></div>
						<div class="col"><{date("Y-m-d H:i:s",$value.cashtime)}></div>
						<div class="col"><{$value.cashmoney}></div>
						<div class="col">
						<{if $value.cashstatus==1}>
							<span style="color:#c83012;">待审核</span>
						<{elseif $value.cashstatus==2}>
							已审核
						<{/if}>
						</div>
						<div class="col">
						<{if $value.cashstatus==1}>
							<button type="button" data-id="<{$value.id}>" class="btn btn_exam">审核</button>
						<{elseif $value.cashstatus==2}>
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
<{include file="footer.tpl"}>
