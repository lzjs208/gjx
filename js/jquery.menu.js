$(document).ready(function(){

	$("#left > .menu-item, #left > .menu-item > ul > li").bind("click",menuItem);
	$(".menu-logout").click(function(){
		var url = "../member/login/logout.php";
		$.get(url,{rnd:new Date()},function(){
			layer.msg("退出成功",{icon:1});
			setTimeout(function(){
				location.href = "../";
			},1000);
		})
	})
	
	$("#left > div").bind("click",function(){
		var _this = $(this);
		var _ul = $("> ul", _this);
		if(_ul){
			var _li = $("> li", _ul).size();
			if(Number(_li) > 0 && _ul.css("display")=="none"){
				_ul.slideDown(500);
				$("> em",_this).addClass("ext");
			}else if(_ul.css("display")=="block"){
				_ul.slideUp(500);
				$("> em", _this).removeClass("ext");
			}
		}

	})

})

function menuItem(){
	$(".menu-item").removeClass("menu-item-active");
	$(this).addClass("menu-item-active");
	var _url = $(this).attr("href");
	$("#iframepage").attr("src",_url);
}