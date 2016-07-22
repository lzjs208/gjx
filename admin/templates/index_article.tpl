<{include file="header.tpl" title=GTrade}>

<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;文章管理</li>
	</ul>
</div>
<!--面包屑导航-->
<div class="wrapper-panel">
	<div class="art_search">
		<form name="form" id="form" method="post" action="index.php">
		<div>
			<label>文章查询：</label>
			<input type="text" class="art_input form-control" name="keyword" id="keyword">
			<input type="submit" class="btn" id="btn_search" value="查询" style="width:5%;">
		</div>
		</form>
	</div>
	<div class="art_manage">
		<div class="title">文章管理</div>
		<ul class="list-panel">
			<li class="rowl row_title">
				<div class="col">选择</div>
				<div class="col">编号</div>
				<div class="col">标题</div>
				<div class="col">栏目</div>
				<div class="col">审核</div>
				<div class="col">发表日期</div>
				<div class="col">排序</div>
				<div class="col">点击</div>
				<div class="col">操作</div>
				<div class="col">操作</div>
			</li>
			<!--data list-->
			<{foreach from=$artlist item=value}>
			<li class="rowl row_list">
				<div class="col"><input name="arcID" data-id="<{$value.id}>" class="np" type="checkbox" ></div>
				<div class="col"><{$value.id}></div>
				<div class="col">
					<a href="../../news/content.php?id=<{$value.id}>" target="_blank"><{$value.title|truncate:30}></a>
					<{if $value.titlepic!=""}>
					<i>[图]</i>
					<{/if}>
					<{if $value.tuijian==1}>
					<i>[荐]</i>
					<{/if}>
				</div>
				<div class="col">公告栏</div>
				<div class="col">
				<{if $value.isexam==0}>
				<button class="exam">未审核</button>
				<{elseif $value.isexam==1}>
				<button class="exam">已审核</button>
				<{/if}>
				</div>
				<div class="col"><{date('Y-m-d H:i:s',$value.pubdate)}></div>
				<div class="col"><input type="text" class="order" value="<{$value.artorder}>"></div>
				<div class="col"><{$value.click}></div>
				<div class="col"><button class="opera" onclick="editArc(<{$value.id}>);">编辑</button></div>
				<div class="col"><button class="opera" onclick="delArc(<{$value.id}>);">删除</button></div>
			</li>
			<{/foreach}>
			<!--data list-->
			<!--pager-->
			<{$pager}>
			<!--pager-->
		</ul>
	</div>
</div>

<script src="js/article.js"></script>

<{include file="footer.tpl"}>