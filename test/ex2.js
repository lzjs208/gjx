// JavaScript Document
//请在谷歌浏览器中运行
var newTodo=document.getElementById("newTodo");
var ul = document.getElementById("todo-list");
var li=document.getElementsByTagName("li");
var main=document.getElementById("main");
var foot= document.getElementById("footer");
var code_Values = document.getElementsByTagName("input");
var toggleAll=document.getElementById("toggle-all");
var divCount=document.getElementById("todo-count");
var clearTh=document.getElementById("clear-completed");
var span=document.getElementsByTagName("span");
/*==========================绑定事件==================================*/
newTodo.addEventListener("keydown",addTodo,false);
clearTh.addEventListener("click",delTodo,false);
toggleAll.addEventListener("click",toggle,false);
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
window.onload=function()
{
	var storageArr=JSON.parse(localStorage.getItem("ulStroage"));
	var localToggle=localStorage.getItem("toggleAll");
	
	if(storageArr.length>0){
		toggleAll.checked=localToggle;
		for(var i=0;i<storageArr.length;i++)
		{
			addLi(storageArr[i].checked,storageArr[i].txt);	
		}
		coutCountInfor()
	}
}
function addTodo()//回车事件
{//添加要做的事情
	if(event.keyCode==13)
	{
		if(this.value=='')
		{
			return false;	
		}
		if(this.value!=""||this.value!="What needs to be done?")
		{
			main.style.display="block";
			txt=newTodo.value;
			addLi("",txt);
			coutCountInfor();
		} 
		storage();
	}
}
function publicDelEffect(li)//删除效果公共函数（文字变灰<s></s>）
{
	var li=li;
	var span_Array =li.getElementsByTagName("span");
	if(li.childNodes[0].checked)
	{
		var txt=span_Array[0].innerHTML;
		span_Array[0].innerHTML="<s>"+txt+"</s>";
	}
	else
	{
		span_Array[0].innerHTML=span_Array[0].innerText.replace("<s>","").replace("</s>","");
	}
}

function delEffect(evt)//点击单个按钮的删除效果（文字变灰）
{//删除效果
	var e =evt || window.event;
	var o =window.event?e.srcElement:e.target;
	var li=o.parentNode;
	publicDelEffect(li);
	storage();
}
function toggle(event)
{//全选或全不选;删除效果（文字变灰）
	var li=document.getElementsByTagName("li");
	for(var i=0;i<li.length;i++)
	{
		li[i].children[0].checked = ( toggleAll.checked ) ? true:false;
		publicDelEffect(li[i]);
	}
	coutCountInfor();
	storage();
}

function delTodo(event)
{//将选中的项删除，遍历检查,按右下角按钮引发
	var ul = document.getElementById('todo-list');
	for(var i = ul.children.length - 1; i >= 0; i--)
	{  
		var checkbox = ul.children[i].children[0];
		if(checkbox.checked)
		{ 
			ul.removeChild(ul.children[i]);
		} 
	} 
	coutCountInfor();
	storage();
}



function delOneitem(evt)
{//删除按钮，删除某一项
	var e =evt || window.event;
	var o =window.event?e.srcElement:e.target;
	var li=o.parentNode;
	var liId=document.getElementById(li.id);
	o.parentNode.parentNode.removeChild(o.parentNode);
	coutCountInfor();
	storage();
}
	
	
function recount(evt)
{//选中某一项，重新计数
	var e =evt || window.event;
	var o =window.event?e.srcElement:e.target;
	coutCountInfor();
	storage();
}
	
	
function numFalse()//计算未选中的个数
{
	var numFalse=0;
	var ul = document.getElementById('todo-list');
	for(var i=0;i<ul.children.length;i++)
	{
		if(ul.children[i].children[0].type == "checkbox")
		{
			if(!ul.children[i].children[0].checked)
			{
				numFalse++;	
			}
		}
	}
	return numFalse;
}
function dbclickSpan(evt)//双击编辑功能，有待进一步完善
{
	var e =evt || window.event;
	var o =window.event?e.srcElement:e.target;
	//alert(this.outerHTML);
	this.previousSibling.style.display="none";
	this.nextSibling.style.display="none";
	this.style.display="none";
	var li1=this.parentNode;
	var input=document.createElement("input");
	input.className="edit";
	input.type="text";
	input.value=o.innerHTML;
	input.style.display="block";
	//changecss("none");
	li1.replaceChild(input,li1.childNodes[1]);
	input.addEventListener("blur",function(evt){
		var e =evt || window.event;
		var o =window.event?e.srcElement:e.target;//input
		var span2=document.createElement("span");
		li1.replaceChild(span2,o);
		
		if(li1.firstChild.type == "checkbox" && li1.firstChild.checked)
		{
			span2.innerHTML="<s>"+o.value+"</s>";
		}
		else
		{
			span2.innerHTML=o.value;
		}
		//span2.innerHTML=o.value;
		
		li1.firstChild.style.display="";
		li1.childNodes[1].style.display="";
		li1.lastChild.style.display="";
		//changecss("block");
		},false);
}	

function storage()//localStorage用于客户端存储
{//将ul的键值对存储在localStorage中
	localStorage.clear();
	var storageArr=[];
	for(var i=0;i<ul.children.length;i++)
	{
		var obj={}
		if(ul.children[i].children[0].type == "checkbox")
		{
			obj.checked=ul.children[i].children[0].checked;
			obj.txt=ul.children[i].getElementsByTagName("span")[0].innerText;
			storageArr.push(obj);
		}
	}
	localStorage.setItem("ulStroage", JSON.stringify(storageArr));
	if(toggleAll.checked == true)
	{
		localStorage.setItem("toggleAll","checked");
	}
	else
	{
		localStorage.setItem("toggleAll","");
	}
	
	
}

function addLi(checkedValue,spanValue)
{
	var li=document.createElement("li");
	li.className="li";
	var check=document.createElement("input");
	check.name="check";
	check.type="checkbox";
	check.className="check";
	var span=document.createElement("span");
	if(checkedValue==true)
		{
			check.checked="checked";
			span.innerHTML="<s>"+spanValue+"</s>";;
		}
		else
		{
			span.innerHTML=spanValue;
		}
	var destroy=document.createElement("img");
	destroy.className="destroy";
	li.appendChild(check);
	li.appendChild(span);
	li.appendChild(destroy);
	ul.appendChild(li);
	if(ul.children.length>0)
	{
		foot.style.display="block";
	}
	else
	{
		foot.style.display="none";
	}
	/*=======================li内部元素的绑定事件=====================*/
	destroy.addEventListener("click",delOneitem,false);
	check.addEventListener("click",recount,false);
	check.addEventListener("click",delEffect,false);
	span.addEventListener("dblclick",dbclickSpan,false);
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
}

function coutCountInfor(){
	divCount.innerHTML="还剩<span>"+numFalse()+"</span>件没有完成";
	
	}

window.onunload=function()
{
	
	for(var i=0;i<li.lenght;i++)
	{
		li[i].children[2].removeEventListener("click",delOneitem,false);
		li[i].chidren[0].removeEventListener("click",recount,false);
		li[i].child[0].removeEventListener("click",delEffect,false);
		li[i].child[1].removeEventListener("dblclick",dbclickSpan,false);
	}
}


