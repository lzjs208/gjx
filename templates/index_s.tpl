<{include file="header.tpl" title=GTrade}>

<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;安全中心</li>
	</ul>
</div>
<!--面包屑导航-->
<div class="safead">
	<p><{$user}>，你的帐户等级高</p>
	<p>交易系统实时保护你的账户安全</p>
</div>
<div class="prot">
	<div class="protect">
		你已设置<span>3</span>个保护项，剩余<span>1</span>个保护项未设置
	</div>
	<ul>
		<li>
			<div class="safepass"><em></em>安全密码</div>
			<div class="set">
				<{$safepass}>
				<p>下单交易时需要安全密码验证</p>
			</div>
			<div class="modi"><{$safem}></div>
		</li>
		<li>
			<div class="phone"><em></em>手机号码</div>
			<div class="set">
				<{$phone}>
				<p>提现和修改时需要手机短信验证码</p>
			</div>
			<div class="modi"><{$phonem}></div>
		</li>
		<li>
			<div class="email"><em></em>安全邮箱</div>
			<div class="set">
				<{$email}>
				<p>修改资料时需要用到邮箱验证码</p>
			</div>
			<div class="modi"><{$emailm}></div>
		</li>
		<li>
			<div class="loginpass"><em></em>登录密码</div>
			<div class="set">
				<{$pass}>
				<p>登录时需要的登录密码</p>
			</div>
			<div class="modi"><{$passm}></div>
		</li>
	</ul>
</div>
<input type="hidden" name="userid" id="userid" value="<{$userid}>">
<!--设置安全密码-->
<div class="mask modal fade" id="setsafe" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="mask-main">
		<div class="mask-head">安全密码设置<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
		<form class="form-horizontal">
		<div class="form-group">
			<input type="password" name="password" class="form-control input-sm mask-input" id="password" placeholder="请输入新密码">
			<input type="password" name="password1" class="form-control input-sm mask-input" id="password1" placeholder="请确认新的密码">
			<button type="button" class="btn-select">确认添加</div>
		</div>
		</form>
		</div>
	</div>
</div>
<!--修改手机号码-->
<div class="mask modal fade" id="setphone" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="mask-main">
		<div class="mask-head">修改手机号码<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
		<form class="form-horizontal">
		<div class="form-group">
			<div class="code">
				<input type="text" readonly="true" id="email" class="mask-input input-b" value="<{$myemail}>">
			</div>
			<button type="button" id="phonecode">获取验证码</button>
			<input type="text" name="VerificationCode" class="form-control input-sm mask-input" id="VerificationCode" placeholder="请输入验证码">
			<input type="text" name="phone" class="form-control input-sm mask-input" id="phone" placeholder="请输入新的手机号码">
			<button type="button" class="btn-select">确认修改</div>
		</div>
		</form>
		</div>
	</div>
</div>
<!--修改安全邮箱-->
<div class="mask modal fade" id="setemail" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="mask-main">
		<div class="mask-head">修改安全邮箱<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
		<form class="form-horizontal">
		<div class="form-group">
			<div class="code">
				<input type="text" readonly="true" id="oldemail" class="mask-input input-b" value="<{$myemail}>">
			</div>
			<button type="button" id="phonecode">获取验证码</button>
			<input type="text" name="VerificationCode" class="form-control input-sm mask-input" id="VerificationCode" placeholder="请输入验证码">
			<input type="text" name="newemail" class="form-control input-sm mask-input" id="newemail" placeholder="请输入新的邮箱">
			<button type="button" class="btn-select">确认修改</div>
		</div>
		</form>
		</div>
	</div>
</div>
<!--修改登录密码-->
<div class="mask modal fade mask-setpws" id="setpws" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="mask-main">
		<div class="mask-head">修改登录密码<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
		<form class="form-horizontal">
		<div class="form-group">
			<input type="password" name="password" id="password" class="mask-input" placeholder="请输入新的密码">
			<input type="password" name="password1" id="password1" class="mask-input" placeholder="请确认新的密码">
			<div class="code">
				<input type="text" readonly="true" id="email" class="mask-input input-b" value="<{$myemail}>">
			</div>
			<button type="button" id="phonecode">获取验证码</button>
			<input type="text" name="VerificationCode" class="form-control input-sm mask-input" id="VerificationCode" placeholder="请输入验证码">
			<button type="button" class="btn-select">确认修改</div>
		</div>
		</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	var _mask = $(".mask").height();
	var _h = _mask * 0.15;
	$(".mask").css("margin-top",-parseInt((_mask+_h)/2) + "px");
})
</script>
<{include file="footer.tpl"}>
