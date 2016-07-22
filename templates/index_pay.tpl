<{include file="header.tpl" title=GTrade}>
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
					<{foreach from=$arrCny item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.payname}></div>
						<div class="col"><{$value.paymoney}></div>
						<div class="col"><a href="<{str_replace("../../","/",$value.picUrl)}>" target="_blank"><img src="<{str_replace("../../","/",$value.picUrl)}>" width="120" height="24"></a></div>
						<div class="col"><{date("Y-m-d",$value.paytime)}></div>
						<div class="col"><{date("Y-m-d H:i:s",$value.addtime)}></div>
						<div class="col">
						<{if $value.paystatus==1}>
						<span style="color:#ff0000;">审核中</span>
						<{elseif $value.paystatus==2}>
						审核成功
						<{/if}>
						</div>
					</li>
					<{/foreach}>
					<!--data list-->
				</ul>
			</div>
		</div>
		<!--btc tab-->
		<div class="tab-pane" id="btc">
			<span class="tit">BTC充值地址</span>
			<div class="tab-input"><input class="input form-control" type="text" readonly="readonly" value="<{$btcaddr}>"></div>
		</div>
		<!--ltc tab-->
		<div class="tab-pane" id="ltc">
			<span class="tit">LTC充值地址</span>
			<div class="tab-input"><input class="input form-control" type="text" readonly="readonly" value="<{$ltcaddr}>"></div>
		</div>
		<!--gc tab-->
		<div class="tab-pane" id="gc">
			<span class="tit">GC充值地址</span>
			<div class="tab-input"><input class="input form-control" type="text" readonly="readonly" value="<{$gcaddr}>"></div>
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
				</ul>
			</div>	
		</div>
	</div>		
</div>

<script>
$(function(){
	$("#myPay li:eq(0) a").tab("show");
	$(".form_datetime1").datetimepicker({minView: "month", format: 'yyyy-mm-dd', language: 'zh-CN', autoclose: true});
})
</script>
<script type="text/javascript" src="../../plugins/datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../plugins/datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<{include file="footer.tpl"}>
