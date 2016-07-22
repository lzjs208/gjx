$(function(){
	$(".args_btn").click(function(){
		var _val = $(this).parent().find(".args_val").val();
		var _arg = $(this).parent().find(".args_type").val();
		var _data = {
			arg: _arg,
			val: _val,
			rnd: new Date()
		}
		$.ajax({
			type: "post",
			url: "../argument/setargs.php",
			async: false,
			data: _data,
			dataType: "text",
			success: function(msg){
				if(Number(msg)==1){
					layer.msg("汇率格式不正确！",{icon:2});
					return false;
				}else if(Number(msg)==2){
					layer.msg("参数设置成功！",{icon:1});	
					setTimeout(function(){
						location.reload();
					},1000);
				}
			}
		});
	});//--#cny click end
	
	$(".args_record .row_list button").click(function(){
		var _this = $(this);
		var _id = _this.attr("data-id");
		url = "../argument/delargs.php";
		$.get(url,{id:_id, rnd: new Date()}, function(data){
			if(Number(data)==1){
				layer.msg("删除不成功！",{icon:2});
				return false;
			}else if(Number(data)==2){
				_this.attr("disabled",true);
				layer.msg("删除成功！",{icon:1});
				setTimeout(function(){
					location.reload();
				},1000);
			}
		});
	});
	
	$(".pay_record .row_list button").click(function(){
		var _this = $(this);
		var _id = _this.attr("data-id");
		url = "../pay/payexam.php";
		$.ajax({
			type: "get",
			url: url,
			async: false,
			data: {id:_id},
			dataType: "text",
			success: function(msg){
				switch(Number(msg)){
					case 1:
						layer.msg("参数错误！",{icon:2});
						break;
					case 2:
						_this.attr("disabled",true);
						layer.msg("审核成功！",{icon:1});
						setTimeout(function(){
							location.reload();
						},1000);
				}//--switch end
			}
		})//--ajax end

	})//--click end
	
	$(".cash_list .btn_exam").click(function(){
		var _this = $(this);
		var _id = _this.attr("data-id");
		url = "../cash/cashexam.php";
		$.ajax({
			type: "get",
			async: false,
			url: url,
			data: {id:_id},
			dataType: "text",
			success: function(msg){
				switch(Number(msg)){
					case 1:
						layer.msg("无效的参数，审核未通过",{icon:2});
						break;
					case 2:
						_this.attr("disabled",true);
						layer.msg("提现审核通过！",{icon:1});
						setTimeout(function(){
							location.reload();
						},1000);
						break;
				}//--switch end
			}
		})//--ajax end

	})//--click end
	
	$(".list-member > li > div > .btn").click(function(){
		var _this = $(this);
		var _id = _this.parent().parent("li").attr("data-id");
		url = "../salesman/isallow.php";
		$.get(url,{id:_id, rnd: new Date()},function(data){
			if(Number(data)==1){
				_this.attr("disabled",true);
				layer.msg("设置成功！",{icon:1});
				setTimeout(function(){
					location.reload();
				},1000);
			}else if(Number(data)==0){
				layer.msg("参数错误！",{icon:2});
				return false;
			}
		})
	})
	
	$("#pass .btn-submit").click(function(){
		var _this = $(this);
		var _id = _this.siblings(".memId").val();
		var _pass = _this.siblings("#pass").val();
		var _pass2 = _this.siblings("#pass2").val();
		
		url = "../salesman/setpass.php";
		$.post(url,{id:_id, pass:_pass, pass2:_pass2, rnd: new Date()},function(data){
			switch(Number(data)){
				case 1:
					_this.attr("disabled",true);
					layer.msg("重置密码成功！",{icon:1});
					setTimeout(function(){
						location.reload();
					},1000)
					break;
				case 2:
					layer.msg("密码不能为空！",{icon:2});
					break;
				case 3:
					layer.msg("密码和确认密码不相同！",{icon:2});
					break;
			}//--switch end
		})//--post end
	})//--click end
	
	$("#safepass .btn-submit").click(function(){
		var _this = $(this);
		var _id = _this.siblings(".memId").val();
		var _safepass = _this.siblings("#safepass").val();
		var _safepass2 = _this.siblings("#safepass2").val();
		url = "../salesman/setsafepass.php";
		$.post(url,{id:_id, safepass:_safepass, safepass2:_safepass2, rnd: new Date()},function(data){
			switch(Number(data)){
				case 1:
					_this.attr("disabled",true);
					layer.msg("重置安全密码成功！",{icon:1});
					setTimeout(function(){
						location.reload();
					},1000)
					break;
				case 2:
					layer.msg("安全密码或参数不能为空！",{icon:2});
					break;
				case 3:
					layer.msg("新密码和确认密码不相同！",{icon:2});
					break;
			}//--switch end
		})//--post end
	})//--click end
	
	$("#admpass button").click(function(){
		var _this = $(this);
		var _id = _this.siblings("#memId").val();
		var _pass = _this.siblings("#pass").val();
		var _pass2 = _this.siblings("#pass2").val();
		url = "../manager/setpass.php";
		$.post(url,{id:_id, pass:_pass, pass2:_pass2},function(data){
			switch(Number(data)){
				case 1:
					_this.attr("disabled",true);
					layer.msg("密码重置成功！",{icon:1});
					setTimeout(function(){
						location.reload();
					},1000);
					break;
				case 2:
					layer.msg("密码或参数不能为空！",{icon:5});
					break;
				case 3:
					layer.msg("新密码和确认密码不同！",{icon:5});
					break;
			}//--switch end
		})
		
	})

	var _span = $("#thead span");

	_span.bind("click",function(){
		var curIndex = _span.index(this);
		_span.each(function(index,ele){
			if(curIndex == index){
				$(ele).addClass("cur");
				$(ele).next().addClass("nocur");
				var _div = $(".artDiv");
				_div.hide();
				_div.eq(curIndex).show();
			}else{
				$(ele).removeClass("cur");
				$(ele).next().removeClass("nocur");
			}
		})
	})

})