<{include file="header.tpl" title=GTrade}>
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
				<div class="red-color">可用提现余额：<{$kycny}>，单日提现总计不超过<{$cash_amount}>元，提手续费为提现金额的<span id="arg_cost"><{$cash_cost}></span>%，周六周日不能提现</span></div>
			</div>
			<div class="cash_form tab-form" style="width:35%;margin-top:10px;">
				<input type="hidden" value="<{$email}>" disabled="disabled" id="email">
				<input type="hidden" value="<{$kycny}>" disabled="disabled" id="kycny">
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
					<{foreach from=$cnylist item=value}>
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
							<div class="col"><{date('Y-m-d H:i:s',$value.cashtime)}></div>
							<div class="col"><{$value.cashbank}></div>
							<div class="col"><{$value.cashmoney}></div>
							<div class="col"><{$value.cashcost}></div>
							<div class="col">
							<{if $value.cashstatus==1}>
							<span style="color:#c83012;">审核中</span>
							<{elseif $value.cashstatus==2}>
							已审核
							<{/if}>
							</div>
						</li>
					<{/foreach}>
				</ul>
			</div>
		</div>
		<!--btc tab-->
		<div class="tab-pane" id="btc">
			<div class="notice">
				<span class="red-color">单日提现总计不超过<{$cash_amount}>元,周六周日不能提现,今日提现限额:<{$cash_btc}></span>
			</div>
		</div>
		<!--ltc tab-->
		<div class="tab-pane" id="ltc">
			<div class="notice">
				<span class="red-color">单日提现总计不超过<{$cash_amount}>元,周六周日不能提现,今日提现限额:<{$cash_ltc}></span>
			</div>
		</div>
		<!--gc tab-->
		<div class="tab-pane" id="gc">
			<div class="notice">
				<span class="red-color">单日提现总计不超过<{$cash_amount}>元,周六周日不能提现,今日提现限额:<{$cash_gc}></span>
			</div>
		</div>
	</div>		
</div>

<script>
$(function(){
	$("#myCash li:eq(0) a").tab("show");
	var url = "../cash/get.coinaddr.php";
	$.get(url,{id:4},function(data){
		$(".cny_select").html(data);
	})//--ajax end
})
</script>

<{include file="footer.tpl"}>
