<{include file="header.tpl" title=GTrade}>

<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;会员管理</li>
	</ul>
</div>
<!--面包屑导航-->
<!--会员管理面板-->
<div class="wrapper-panel">
	<div class="title">会员管理</div>
	<ul class="list-panel list-member">
		<li class="rowl row_title">
			<div class="col">会员编号</div>
			<div class="col">用户名</div>
			<div class="col">注册时间</div>
			<div class="col">可否登陆</div>
			<div class="col">可用CNY</div>
			<div class="col">冻结CNY</div>
			<div class="col">可用GC</div>
			<div class="col">冻结GC</div>
			<div class="col">登陆密码</div>
			<div class="col">安全密码</div>
		</li>
		<{foreach from=$member item=value}>
		<li class="rowl row_list" data-id="<{$value.id}>">
			<div class="col"><{$value.id}></div>
			<div class="col"><{$value.manname}></div>
			<div class="col"><{date("Y-m-d H:i:s",$value.addTime)}></div>
			<div class="col">
				<{if $value.isallow==0}>
				<button type="button" class="btn enable">允许</button>
				<{elseif $value.isallow==1}>
				<button type="button" class="btn disable">禁止</button>
				<{/if}>
			</div>
			<div class="col"><{$value.kycny}></div>
			<div class="col"><{$value.buycny}></div>
			<div class="col"><{$value.kyjf}></div>
			<div class="col"><{$value.buyjf}></div>
			<div class="col">
				<button type="button" data-toggle="modal" data-target="#pass" class="btn-pass">重置密码</button>
			</div>
			<div class="col">
				<button type="button" data-toggle="modal" data-target="#safepass" class="btn-safepass">重置安全密码</button>
			</div>
		</li>
		<{/foreach}>
		<{$pager}>
	</ul>
</div>
<!--会员管理面板-->
<!--重置密码-->
<div class="mask modal fade" id="pass" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="mask-main">
		<div class="mask-head">重置登录密码<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
		<form class="form-horizontal">
		<div class="form-group">
			<input type="hidden" class="memId" value="">
			<input type="password" class="form-control input-sm mask-input" id="pass" placeholder="请输入新密码">
			<input type="password" class="form-control input-sm mask-input" id="pass2" placeholder="请确认新的密码">
			<button type="button" class="btn-select btn-submit">确认</div>
		</div>
		</form>
		</div>
	</div>
</div>
<!--重置密码-->
<!--重置安全密码-->
<div class="mask modal fade" id="safepass" role="diaglog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="mask-main">
		<div class="mask-head">重置安全密码<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
		<form class="form-horizontal">
		<div class="form-group">
			<input type="hidden" class="memId" value="">
			<input type="password" class="form-control input-sm mask-input" id="safepass" placeholder="请输入新密码">
			<input type="password" class="form-control input-sm mask-input" id="safepass2" placeholder="请确认新的密码">
			<button type="button" class="btn-select btn-submit">确认</div>
		</div>
		</form>
		</div>
	</div>
</div>
<!--重置安全密码-->
<script type="text/javascript">
$(function(){
	var _mask = $(".mask").height();
	var _h = _mask * 0.15;
	$(".mask").css("margin-top",-parseInt((_mask+_h)/2) + "px");
	
	$(".list-member>li>div>.btn-pass, .list-member>li>div>.btn-safepass").bind("click",function(){
		var _memId = $(this).parent().parent("li").attr("data-id");
		$(".mask .memId").val(_memId);
	})
})
</script>
<{include file="footer.tpl"}>