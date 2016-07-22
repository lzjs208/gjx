$(function(){
	$("#form-signin button").click(function(){
		var _user = $("#admUsername").val();
		var _pass = $("#admPassword").val();
		var _code = $("#verifyCode").val();
		var _data = {
			u: _user,
			p: _pass,
			c: _code,
			rnd: new Date()
		}
		$.ajax({
			type:"post",
			url:"login/checkadmin.php",
			dateType:"text",
			async:false,
			data:_data,
			success:function(msg){
				switch(Number(msg)){
					case 1:
						layer.msg("登陆成功，跳转中...",{icon:1});
						setTimeout(function(){
							location.href = "../admin/index.php";
						},1500)
						break;
					case 2:
						layer.msg("信息填写不完整",{icon:2});
						break;
					case 3:
						layer.msg("验证码不正确",{icon:2});
						break;
					case 4:
						layer.msg("用户名或密码不正确",{icon:2});
						break;
					case 5:
						layer.msg("该账号被禁用",{icon:2});
						break;
				}
			}
		})
	})
})