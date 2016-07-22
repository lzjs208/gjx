<?php
/* Smarty version 3.1.29, created on 2016-06-24 18:08:36
  from "E:\webProject\gjx-coin.com\web\templates\content.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_576d06a461c485_73570046',
  'file_dependency' => 
  array (
    'cbab903ae703c4c926070f7a05c00d6c66e14607' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\templates\\content.tpl',
      1 => 1466762915,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_576d06a461c485_73570046 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'E:\\webProject\\gjx-coin.com\\web\\plugins\\smarty\\libs\\plugins\\modifier.truncate.php';
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
    <div class="header-tips">您好，欢迎来到天合积分交易平台！&nbsp;<a href="register.html">[注册]</a><a href="#">[登陆]</a></div>
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
            <li><a href="./">新闻中心</a></li>
            <li><a href="help">帮助中心</a></li>
        </ul>
    </div>
</div>

<div class="container">
    <div class="news_body">
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['result']->value['title'];?>
</div>
        <div class="attr">来源：<?php echo $_smarty_tpl->tpl_vars['result']->value['source'];?>
<span class="r">日期：<?php echo date("Y-m-d h:i:s",$_smarty_tpl->tpl_vars['result']->value['pubdate']);?>
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
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value['title'],14);?>
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

<div id="footer">
    <div class="container">
        <div class="link">
            <img src="../images/link01.png"><img src="../images/link02.png"><img src="../images/link03.png">
        </div>
        <p class="text-muted">
            CreditEase © 2016-2018 GX-Life Coin<br>
            Email：tianheb@vip.163.com
        </p>
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
