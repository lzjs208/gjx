<?php
/* Smarty version 3.1.29, created on 2016-05-22 13:08:18
  from "D:\appSrv\gjx-coin\web\admin\templates\index_m.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57413ec2c14067_19734426',
  'file_dependency' => 
  array (
    'dff4e3b4ef7841719516c5c383d992f87921d770' => 
    array (
      0 => 'D:\\appSrv\\gjx-coin\\web\\admin\\templates\\index_m.tpl',
      1 => 1463577468,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_57413ec2c14067_19734426 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "../../plugins/smarty/configs/test.conf", "setup", 0);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GTrade'), 0, false);
?>


<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;会员管理</li>
	</ul>
</div>
<!--面包屑导航-->
<!--工具导航-->
<div class="tools">
	<div class="btn-group">
		<button class="btn dark" data-toggle="modal" data-target="#addAdmin" id="btnAdd">添加</button>
	</div>
</div>
<!--工具导航-->
<!--管理员管理面板-->
<div class="wrapper-panel">
	<div class="title">管理员管理</div>
	<ul class="list-panel list-admin">
		<li class="rowl row_title">
			<div class="col">管理员编号</div>
			<div class="col">登陆名</div>
			<div class="col">登陆时间</div>
			<div class="col">是否登陆</div>
			<div class="col">真实姓名</div>
			<div class="col">登陆IP</div>
			<div class="col">重置密码</div>
			<div class="col">删除</div>
		</li>
		<!--data list-->
		<?php
$_from = $_smarty_tpl->tpl_vars['admin']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_0_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$__foreach_value_0_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
		<li class="rowl row_list" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
</div>
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['username'];?>
</div>
			<div class="col"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['value']->value['logintime']);?>
</div>
			<div class="col">
				<?php if ($_smarty_tpl->tpl_vars['value']->value['isallow'] == 0) {?>
				<button type="button" class="btn_allow enable">允许</button>
				<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['isallow'] == 1) {?>
				<button type="button" class="btn_allow disable">禁止</button>
				<?php }?>
			</div>
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['realname'];?>
</div>
			<div class="col"><?php echo $_smarty_tpl->tpl_vars['value']->value['loginIP'];?>
</div>
			<div class="col">
				<button type="button" data-toggle="modal" data-target="#admpass" class="respass">重置密码</button>
			</div>
			<div class="col">
				<button class="delete">删除</button>
			</div>
		</li>
		<?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
		<!--data list-->
		<?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

	</ul>
</div>
<!--管理员管理面板-->
<!--添加管理员-->
<div class="mask modal fade" id="addAdmin" style="margin-top:-185px;max-height:56%;">
	<div class="mask-main">
		<div class="mask-head">添加管理员<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
			<form class="form-horizontal">
			<div class="form-group">
				<input type="text" name="admuser" class="form-control input-sm mask-input" id="admuser" placeholder="请输入登陆名">
				<input type="password" name="pass" class="form-control input-sm mask-input" id="pass" placeholder="请输入登陆密码">
				<input type="password" name="repass" class="form-control input-sm mask-input" id="repass" placeholder="密码确认">
				<input type="text" name="realname" class="form-control input-sm mask-input" id="realname" placeholder="真实姓名">
				<button type="button" class="btn-select">添加</div>
			</div>
			</form>
		</div>
	</div>
</div>
<!--添加管理员-->
<!--重置密码-->
<div class="mask modal fade" id="admpass" role="dialog" style="margin-top:-130px;">
	<div class="mask-main">
		<div class="mask-head">密码设置<i class="mask-close" data-dismiss="modal" aria-label="Close">x</i></div>
		<div class="mask-content">
			<form class="form-horizontal">
			<div class="form-group">
				<input type="hidden" id="memId">
				<input type="password" class="form-control input-sm mask-input" id="pass" placeholder="请输入新密码">
				<input type="password" class="form-control input-sm mask-input" id="pass2" placeholder="请确认新的密码">
				<button type="button" class="btn-select">确认修改</div>
			</div>
			</form>
		</div>
	</div>
</div>
<!--重置密码-->
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
	$('.list-admin .btn_allow').click(function(){
		var _id = $(this).parent().parent().attr('data-id');
		url = '../manager/isallow.php';
		$.get(url,{id:_id},function(data){
			if(Number(data)==1){
				layer.msg('设置成功！',{icon:1});
				setTimeout(function(){
					location.reload();
				},1000);
			}else if(Number(data)==2){
				layer.msg('该会员处于登陆状态，不允许修改！',{icon:2});
				return false;
			}
		})
	})
	
	$("#addAdmin button").click(function(){
		var _user			= $("#admuser").val();
		var _pass			= $("#pass").val();
		var _pass2		= $("#repass").val();
		var _realname = $("#realname").val();
		if(_pass != _pass2){
			layer.msg("登陆密码和确认密码不相同！",{icon:5});
			return false;
		}
		var _url = "../manager/add.admin.php";
		var _data = {
			u: _user,
			p: _pass,
			name: _realname,
			rnd: new Date()
		}
		$.ajax({
			type:"post",
			async: false,
			url: _url,
			data: _data,
			dataType:"text",
			success:function(msg){
				switch(Number(msg)){
					case 1:
						layer.msg("添加成功!",{icon:1});
						setTimeout(function(){
							location.reload();
						},1000);
						break;
					case 2:
						layer.msg("用户名或密码不能为空！",{icon:5});
						break;
					case 3:
						layer.msg("登录名有重复，请重新输入",{icon:5});
						$("#admuser").focus();
						break;
				}//--switch end
			}//--success end
		})//--ajax end
		 
	})//--addAdmin end
	
	$(".list-admin .respass").click(function(){
		var _id = $(this).parent().parent("li").attr("data-id");
		$("#admpass #memId").val(_id);
	})
	
})
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
