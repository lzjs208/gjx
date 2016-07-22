$(document).ready(function(){
	$("#getSMScode").click(function(){
		_email = $("#email").val();
		if(_email==""){ layer.msg("邮箱地址不能为空！",{icon:2}); $("#email").focus();	 return false;}
		
		$.get(
			"../include/getSMScode.php",{
			email: _email,
			},function(data){
				if(data=="success"){
					layer.msg("验证码发送成功，60秒内有效",{icon:1});
				}else if(data=="failure"){
					layer.msg("验证码发送失败，请重新发送！！",{icon:2});
					return false;
				}
			}
		)//--ajax end
		
	})//--click end
	
	$("#regForm").submit(function(){

		var _user		= $("#username").val();
		var _pass		= $("#pass").val();
		var _pass2	= $("#pass2").val();
		var _email	= $("#email").val();
		var _phone	= $("#phone").val();
		var _code		= $("#code").val();
		
		var _data = {
			u : escape(_user),
			pass : _pass,
			pass2 : _pass2,
			e : _email,
			p	: _phone,
			c : _code,
			rnd : new Date()
		}
		
		$.ajax({
			type: "post",
			url: "member/login/validateReg.php",
			async: false,
			dataType: "text",
			data: _data,
			success: function(msg){
//				alert(msg);
				switch (Number(msg)) {
					case 1:
					layer.msg("信息填写不完整！", {	icon: 2	});
					break;
					case 2:
					layer.msg("登陆密码和确认密码不一致！", {	 icon: 2 });
					break;
					case 3:
					layer.msg("验证码输入错误！", { icon: 2 });
					break;
					case 4:
					layer.msg("该用户名已被注册！",{ icon: 2 });
					break;
					case 5:
					layer.msg("注册成功！",{ icon: 1 });
					setTimeout(function(){
						window.location.href = 'index.html';
					},1000)
					break;
				}//--switch end
				
			}//--success end
			
		})//--ajax end
		
		return false;
		
	})//--click end
	
})
