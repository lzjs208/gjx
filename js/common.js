function format_number(num,len){
	if(num){
		if(num.toString().indexOf(".") > 0){
			var tmpNum = num.toString().split(".");
			return tmpNum[0] + "." + tmpNum[1].substring(0,len);
		}else{
			return num;	
		}
	}
}

function isMoney(val){	//只能数字
	var _re =  /^[0-9]+.?[0-9]*$/;
		if(_re.test(val)){
			return true;/*返回错误为false,即无错误*/
		} else{
			return false;/* 有错误发生,返回错误为true */
		}
}

