<?php
/* Smarty version 3.1.29, created on 2016-06-21 00:32:29
  from "D:\appSrv\gjx-coin\web\templates\content.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57681a9dcd2401_82442470',
  'file_dependency' => 
  array (
    '596dd6a0cef25885b82b1ec9a3f7d62ca71f597a' => 
    array (
      0 => 'D:\\appSrv\\gjx-coin\\web\\templates\\content.tpl',
      1 => 1466440329,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57681a9dcd2401_82442470 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1, user-scalable=no">
    <link rel="stylesheet" href="plugins/bootstrap-3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/common.css">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/article.css">
    <title>天合G分交易平台</title>
</head>
<body>

<div class="header">
    <div class="header-tips">您好，欢迎来到天合积分交易平台！&nbsp;<a href="register.html">[注册]</a>&nbsp;<a href="#">[登陆]</a></div>
</div>

<div class="navbar navbar-default narvar-fixed-top">
    <div class="navbar-lwrap">
        <a href="/" class="logo"><img src="../images/logo.jpg" width="227" height="85"></a>
        <ul class="navbar-menu">
            <li><a href="/">首页</a></li>
            <li><a href="member">交易中心</a></li>
            <li><a href="member">个人中心</a></li>
            <li><a href="javascript:void(0);">行情中心</a></li>
            <li><a href="about">关于我们</a></li>
            <li><a href="news">新闻中心</a></li>
            <li><a href="help">帮助中心</a></li>
        </ul>
    </div>
</div>

<div class="container">
    <div class="news_body">
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['result']->value['title'];?>
</div>
        <div class="attr">来源：<?php echo $_smarty_tpl->tpl_vars['result']->value['source'];?>
<span class="r">日期：<?php echo date("Y-m-d h:i;s",$_smarty_tpl->tpl_vars['result']->value['pubdate']);?>
&nbsp;阅读：<?php echo $_smarty_tpl->tpl_vars['result']->value['click'];?>
</span></div>
        <div class="art_content">
            <?php echo $_smarty_tpl->tpl_vars['result']->value['content'];?>

        </div>
    </div>
    <div class="news_hot">
        <div class="m_hd"><span class="head">热门文章</span></div>
        <ul class="artlist">
            <?php
$_from = $_smarty_tpl->tpl_vars['arrlist']->value;
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
                <li><a href="content.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</a></li>
            <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
        </ul>
    </div>
</div>

<?php echo '<script'; ?>
 src="../js/jquery-1.11.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../plugins/layer/layer.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../plugins/bootstrap-3.3.4/js/bootstrap.min.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
