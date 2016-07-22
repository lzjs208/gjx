$(function(){
	
	var _uid		= $("#userid").val();

	$("#setsafe button").click(function(){
		var _pass		= $("#password").val();
		var _pass2	= $("#password1").val();
	
		if(_pass=="" || _pass.length < 6){layer.msg("新密码输入不正确！",{icon:2}); return false;}
		if(_pass!=_pass2){layer.msg("新密码与确定密码不同！",{icon:2}); return false;}
		
		var _data = {
			id: _uid,
			pass: _pass,
			pass2: _pass2,
			rnd: new Date()
		}
		$.ajax({
			type: "post",
			url: "../safety/setsafe.php",
			async: false,
			dataType: "text",
			data: _data,
			success: function(msg){
				switch(Number(msg)){
					case 1:
						layer.msg("新密码未输入！",{icon:2});
						break;
					case 2:
						layer.msg("新密码和确认密码不相同！",{icon:2});
						break;
					case 3:
						layer.msg("安全密码设置成功！",{icon:1});
						setTimeout(function(){
							location.reload();	
						},1500);
						break;
				}//--switch end
			}//--success end
		});//--ajax end
		
	});//--setsafe end
	
	$("#setphone #phonecode").click(function(){
		_email = $("#setphone #email").val();
		sendSMScode(_email);
		layer.msg("邮箱验证码发送成功，60秒有效",{icon:1});
	});
	
	$("#setemail #phonecode").click(function(){
		_email = $("#setemail #oldemail").val();
		sendSMScode(_email);
		layer.msg("邮箱验证码发送成功，60秒有效",{icon:1});
	});
	
	$("#setpws #phonecode").click(function(){
		_email = $("#setpws #email").val();
		sendSMScode(_email);
		layer.msg("邮箱验证码发送成功，60秒有效",{icon:1});
	});
	
	$("#setphone .btn-select").click(function(){
		var _code = $("#VerificationCode").val();
		var _phone = $("#phone").val();
		if(_code==""||_phone==""){layer.msg("信息填写不完整！",{icon:2}); return false;}
		var _data = {
			id:_uid,
			c: _code,
			p: _phone,
			rnd: new Date()
		}
		$.ajax({
			type:"post",
			url:"../safety/setphone.php",
			async:false,
			data:_data,
			dataType:"text",
			success:function(msg){
				switch(Number(msg)){
					case 1:
						layer.msg("验证码输入不正确！",{icon:2});
						break;
					case 2:
						layer.msg("手机号输入不正确！",{icon:2});
						break;
					case 3:
						layer.msg("手机号码修改成功！",{icon:1});
						setTimeout(function(){
							location.reload();
						},1500);
						break;
				}
			}
			
		});
	});//--setphone end

	$("#setemail .btn-select").click(function(){
		var _this = $(this);
		var _code = _this.parent().find("#VerificationCode").val();
		var _email = _this.parent().find("#newemail").val();

		if(_code==""||_email==""){ layer.msg("信息填写不完整！",{icon:2}); return false;}
		var _data = {
			id:_uid,
			c: _code,
			e: _email,
			rnd: new Date()
		}
		
		$.ajax({
			type:"post",
			url:"../safety/setmail.php",
			dateType:"text",
			data:_data,
			async:false,
			success:function(msg){
				alert(msg);
				switch(Number(msg)){
					case 1:
						layer.msg("验证码输入不正确！",{icon:2});
						break;
					case 2:
						layer.msg("邮箱输入不正确！",{icon:2});
						break;
					case 3:
						_this.attr("disabled",true);
						layer.msg("安全邮箱修改成功！",{icon:1});
						setTimeout(function(){
							location.reload();
						},1500);
						break;									
				}
			}
		});
		
	});//--setemail end

	$("#setpws .btn-select").click(function(){
		var _this = $(this);
		var _code = _this.parent().find("#VerificationCode").val();
		var _pass = _this.parent().find("#password").val();
		var _pass2 = _this.parent().find("#password1").val();
		
		var _data = {
			id:_uid,
			c:_code,
			pass:_pass,
			pass2:_pass2,
			rnd:new Date()
		}
		$.ajax({
			type:"post",
			url:"../safety/setpass.php",
			async:false,
			dataType:"text",
			data:_data,
			success:function(msg){
				alert(msg);
				switch(Number(msg)){
					case 1:
						layer.msg("验证码输入不正确！",{icon:2});
						break;
					case 2:
						layer.msg("请填写新密码！",{icon:2});
						break;
					case 3:
						layer.msg("新密码和确认密码不相同！",{icon:2});
						break;
					case 4:
						_this.attr("disabled",true);
						layer.msg("登录密码修改成功！",{icon:1});
						setTimeout(function(){
							location.reload();
						},1500);
						break;		
				}
			}
		});
		
	});//--safety js
	

	$(".trade-sell #sell_cny").click(function(){
		var _this = $(this);
		var _cnyprice = $("#CNY #sellprice").val();
		var _cnynum = $("#CNY #sellnum").val();
		var _kycny = $("#kycny").val();
		var _url = "../trade/sellgo.php";
		var _data = {
			p: _cnyprice,
			n: _cnynum,
			cny: _kycny,
			rnd: new Date()
		}
		$.ajax({
			type: "post",
			url: _url,
			async: false,
			dateType: "text",
			data: _data,
			success: function(msg){
				if(Number(msg)==1){
					layer.msg("信息填写不完整或格式不正确 !",{icon:2});
					return false;
				}else if(Number(msg)==2){
					layer.msg("卖出数量不正确或者卖出数量不能超过可用积分！",{icon:2});
					return false;
				}else if(Number(msg)==3){
					layer.msg("超出今日可交易GC余额，请重新输入数量！",{icon:2});
					return false;
				}
				else if(msg=="failure"){
					layer.msg("卖单提交不成功！",{icon:2});
					return false;
				}
				else if(msg=="success"){
					_this.attr("disabled",true);
					layer.msg("提交成功！",{icon:1});
					setTimeout(function(){
						location.reload();
					},500);
				}
			}
		});//-ajax end
		
	});//--sell_cny end
	
	$("#sellnum, #sellprice").bind("keyup",function(){
		var _cnyprice = $("#CNY #sellprice").val();
		var _num = $("#sellnum").val();
		var _sellmoney = parseFloat(_cnyprice * _num);
		$("#sellmoney").val(format_number(_sellmoney,8));
	});
	
	$(".row_list div .btn_buy").click(function(){
		var _this = $(this);
		var _id = _this.attr("data-id");
		var _url = "../trade/buyorder.php";
		var _data = {
			id: _id,
			rnd: new Date
		}
		
		$.ajax({
			type: "get",
			url: _url,
			async: false,
			data: _data,
			dateType: "text",
			success: function(msg){
				switch(Number(msg)){
					case 1:
						_this.attr("disabled",true);
						layer.msg("定单已成交！",{icon:6});
						setTimeout(function(){
							location.reload();
						},1000);
						break;
					case 2:
						layer.msg("参数不正确！",{icon:2});
						break;
					case 3:
						layer.msg("会员不能购买自己的委托单！",{icon:2});
						break;
					case 4:
						layer.msg("可用余额不足，请充值后再购买！",{icon:5});
						break;
					case 5:
						layer.msg("已超出今日可交易GC余额，请重新购买！",{icon:5});
						break;
				}
				
			}
			
		});//--ajax end
		
	});
	
	$(".current ul li div .btn_cancel").click(function(){
		var _this = $(this);
		var _id = _this.attr("data-id");
		var _url = "../trade/sellcancel.php";
		$.get(_url,{ id: _id },function(data){
			if(Number(data)==1){
				layer.msg("参数不正确！",{icon:2});
				return false;
			}else if(Number(data)==2){
				_this.attr("disabled",true);
				layer.msg("委托单已撤消！",{icon:1});
				setTimeout(function(){
					location.reload();
				},500);
			}
		});
	});//--btn_cancel end
	
	$("#uploadForm").submit(function(){
		
		var _payname		= $("#payname").val();
		var _payamount	= $("#payamount").val();
		var _paytime		= $("#paytime").val();
		var _memo				= $("#memo").val();
		var _pic				= $("#pic").val();
		
		if(_payname == "" || _payamount == "" || _paytime == ""){
			layer.msg("信息填写不完整！",{icon:2});
			return false;
		}
		if(!isMoney(_payamount)){
			layer.msg("汇款金额格式不正确！",{icon:2});
			return false;
		}
		if(_pic == ""){
			layer.msg("请选择上传的文件！",{icon:2});
			return false;
		}
		$(this).find(".btn_upload").attr("disabled",true);	
		return true;
	});//--uploadForm end
	
	$("#cnyamount").bind("keyup",function(){
		var _this = $(this).val();
		var _cost = $("#arg_cost").html();
		$("#cny_cost").html(_this * (_cost/100));
	})
	
	$(".coin #cny .btn_coin").click(function(){

		var _this = $(this);
		var _addname	= $("#addname").val();
		var _addcard	= $("#addcard").val();
		var _addbank	= $("#addbank").val();
		var _bankaddr	= $("#addbankaddress").val();
		var _cointype	= $("#cointype").val();
		var _memo			= $("#memo").val();
		var _data = {
			name:	_addname,
			card:	_addcard,
			bank: _addbank,
			addr: _bankaddr,
			ctype: _cointype,
			memo: _memo,
			rnd:  new Date()
		} 
		$.ajax({
			type:"post",
			url:"../coin/coinsave.php",
			async:false,
			dateType:"text",
			data:_data,
			success:function(msg){
				if(Number(msg)==1){
					layer.msg("信息填写不完整！",{icon:2});
					return false;
				}else if(Number(msg)==2){
					_this.attr("disabled",true);
					layer.msg("提交成功！",{icon:1});
					setTimeout(function(){
						location.reload();
					},1000);
				}
			}
		});
		
	});//--btn_coin end
	
	$(".coin-record .row_list .btn_coin_del").click(function(){
		var _this = $(this);
		var _id = _this.attr("data-id");
		var _url = "../coin/coindel.php";
		$.get(_url,{id: _id},function(data){
			if(data=="failure"){
				layer.msg("删除失败！",{icon:2});
				return false;
			}else if(data=="success"){
				_this.attr("disabled",true);
				layer.msg("删除成功!",{icon:1});
				setTimeout(function(){
					location.reload();
				},500);
			}
		});
	});
	

	$(".cash #emailcode").click(function(){
		_email = $(".cash #email").val();
		sendSMScode(_email);
		layer.msg("邮箱验证码发送成功，60秒有效",{icon:1});
	});
	
	$("#cny .btn_cash").click(function(){
		var _this = $(this);
		var _cardtxt = $("#bank_sel").find("option:selected").text();
		var _cardval = $("#bank_sel").val();
		var _cashamount = $("#cnyamount").val();
		var _code = $("#code").val();
		var _kycny = $("#kycny").val();
		
		if(_cardval=="" || !isMoney(_cashamount)){
			layer.msg("信息填写不完整，或格式不正确！",{icon:2});
			return false;
		}
		
		var _data = {
			txt: _cardtxt,
			val: _cardval,
			cny: _kycny,
			amount: _cashamount,
			code: _code,
			ctype: 4,
			rnd: new Date()
		}
		$.ajax({
			type:"POST",
			url:"../cash/cashsave.php",
			async:false,
			dateType:"text",
			data:_data,
			success:function(msg){
				alert(msg);
				switch(Number(msg)){
					case 1:
						layer.msg("信息输入不完整！",{icon:2});
						break;
					case 2:
						layer.msg("验证码输入错误!",{icon:2});
						break;
					case 3:
						layer.msg("余额不足，请重新输入！",{icon:2});
						break;
					case 4:
						layer.msg("提现金额不能大于今日提现限额！",{icon:2});
						break;
					case 5:
						_this.attr("disabled",true);
						layer.msg("提交成功，请等待管理员审核！",{icon:1});
						setTimeout(function(){
							location.reload();
						},1000);
						break;
					case 0:
						layer.msg("未知的错误，请与管理员联系！",{icon:2});
						break;
				}
			}
		});
	});
	
});//--function End

function sendSMScode(_email){
	_url = "../../include/getSMScode.php";
	$.get(_url,{ email: _email },function(data){
		if(data=="success"){
			layer.msg("验证码发送成功，60秒内有效",{icon:1});
		}else if(data=="failure"){
			layer.msg("验证码发送失败，请重新发送",{icon:2});
			return false;
		}
	});//--ajax end
}

function cnyTab(){
	$("#cny").css("display","block");
	$("#btc").css("display","none");
	$("#ltc").css("display","none");
	$("#gc").css("display","none");
}
function btcTab(){
	$("#cny").css("display","none");
	$("#btc").css("display","block");
	$("#ltc").css("display","none");
	$("#gc").css("display","none");
}
function ltcTab(){
	$("#cny").css("display","none");
	$("#btc").css("display","none");
	$("#ltc").css("display","block");
	$("#gc").css("display","none");
}
function gcTab(){
	$("#cny").css("display","none");
	$("#btc").css("display","none");
	$("#ltc").css("display","none");
	$("#gc").css("display","block");
}