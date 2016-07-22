<{include file="header.tpl" title=GTrade}>
<link href="../../plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;提现地址</li>
	</ul>
</div>
<!--面包屑导航-->
<!--充值面板-->
<div class="coin">
	<ul id="myCoin" class="nav">
		<li><a href="#cny" data-toggle="tab">CNY</a></li>
		<li><a href="#btc" data-toggle="tab">BTC</a></li>
		<li><a href="#ltc" data-toggle="tab">LTC</a></li>
		<li><a href="#gc" data-toggle="tab">GC</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="notice">
			<span class="red-color">提现须知:</span>
		</div>
		<!--cny tab-->
		<div class="tab-pane in active" id="cny">
			<div class="tab-form">
				<span class="form_title">银行卡地址</span>
				<input type="hidden" id="cointype" value="4">
				<input type="text" name="cny_addname" id="addname" class="form-control input" placeholder="请输入您的姓名">
				<p class="red-color">*银行卡账户名必须与您的实名认证姓名一致</p>
				<input type="text" name="cny_card" id="addcard" class="form-control input" placeholder="请输入您的银行卡号">
				<input type="text" name="cny_bank" id="addbank" class="form-control input" placeholder="请输入您的开户银行">
				<input type="text" name="cny_bankaddress" id="addbankaddress" class="form-control input" placeholder="请输入您的开户银行地址">
				<input type="text" name="memo" id="memo" class="form-control input" placeholder="备注">
				<button type="button" class="btn btn_submit btn_coin">提交</button>
			</div>
			<div class="coin-record ">
				<div class="title">提现地址</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">姓名</div>
						<div class="col">银行卡号</div>
						<div class="col">开户银行</div>
						<div class="col">开户银行地址</div>
						<div class="col">备注</div>
						<div class="col">操作</div>
					</li>
					<{foreach from=$cny item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.cny_addname}></div>
						<div class="col"><{$value.cny_card}></div>
						<div class="col"><{$value.cny_bank}></div>
						<div class="col"><{$value.cny_bankaddress}></div>
						<div class="col"><{$value.memo}></div>
						<div class="col"><button type="button" class="btn btn_coin_del" data-id="<{$value.id}>">删除</button></div>
					</li>
					<{/foreach}>
				</ul>
			</div>
		</div>
		<!--btc tab-->
		<div class="tab-pane" id="btc">

		</div>
		<!--ltc tab-->
		<div class="tab-pane" id="ltc">
			
		</div>
		<!--gc tab-->
		<div class="tab-pane" id="gc">

		</div>
	</div>		
</div>

<script>
$(function(){
	$("#myCoin li:eq(0) a").tab("show");
})
</script>

<{include file="footer.tpl"}>
