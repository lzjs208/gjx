$(document).ready(function(){
	
	$("#form-signin").submit(function(){
		_user		= $("#inputUsername").val();
		_pass		= $("#inputPassword").val();
		_verify	= $("#verifyCode").val();
	
		_data = {
			u: _user,
			p: _pass,
			c: _verify,
			rnd: new Date()
		}
		$.ajax({
			type:"post",
			url:"member/login/checklogin.php",
			async:false,
			dataType:"text",
			data:_data,
			success:function(msg){
				switch(Number(msg)){
					case 2:
						layer.msg("信息填写不完整！", {	icon: 2	});
						break;
					case 3:
						layer.msg("验证码不正确！", {	 icon: 2 });
						break;
					case 4:
						layer.msg("用户名或密码不正确！", { icon: 2 });
						break;
					case 5:
						layer.msg("用户被禁用，请与管理员联系！", { icon: 2 });
						break;
					case 1:
						layer.msg("登陆成功，跳转中...", { icon: 1 });
						setTimeout(function(){
							location.href = "../member/";
						},1000);
						break;
				}
			}
		});
		
		return false;
		
	});//--submit end

	$.ajax({
		url:"member/login/check.session.php",
		dateType:"text",
		async:false,
		success:function(msg){
			if(msg){
				$("#form-signin").html(msg);
			}
		}
	});
	
})

function GetCookies(cookname){
	var cookieValue = "";
	var search = cookname + "=";
	if(document.cookie.length > 0){ 
    	offset = document.cookie.indexOf(search);
		if (offset != -1){ 
      		offset += search.length;
      		end = document.cookie.indexOf(";", offset);
      		if (end == -1) end = document.cookie.length;
      		cookieValue = unescape(document.cookie.substring(offset, end));
   		}
  }
  return cookieValue;
}