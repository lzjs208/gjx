<?php
/* Smarty version 3.1.29, created on 2016-06-25 18:34:14
  from "E:\webProject\gjx-coin.com\web\templates\index_article.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_576e5e26ef7891_22416987',
  'file_dependency' => 
  array (
    'c8cd1cc0d4b21a9ffef1d81feefd9ad103911f49' => 
    array (
      0 => 'E:\\webProject\\gjx-coin.com\\web\\templates\\index_article.tpl',
      1 => 1466850852,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_576e5e26ef7891_22416987 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1, user-scalable=no">
    <link rel="stylesheet" href="plugins/bootstrap-3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/common.css">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/list.css">
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
    <div class="news_left">
        <div class="slider" id="slider">
            <ul>
            <?php
$_from = $_smarty_tpl->tpl_vars['piclist']->value;
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
                <li style="background:url(<?php echo $_smarty_tpl->tpl_vars['value']->value['titlepic'];?>
) no-repeat center;"></li>
            <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_local_item;
}
if ($__foreach_value_0_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved_item;
}
?>
            </ul>
        </div>
        <ul class="news_list">
            <?php
$_from = $_smarty_tpl->tpl_vars['artlist']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_1_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['value']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$__foreach_value_1_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
            <?php if ($_smarty_tpl->tpl_vars['value']->value['jumpurl'] != '') {?>
            <li>
                <h4><a href="<?php echo $_smarty_tpl->tpl_vars['value']->value['jumpurl'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</a></h4>
                <a href="<?php echo $_smarty_tpl->tpl_vars['value']->value['jumpurl'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['value']->value['titlepic'];?>
"></a>
                <?php echo $_smarty_tpl->tpl_vars['value']->value['sortContent'];?>
<span><?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['value']->value['pubdate']);?>
</span>
            </li>
            <?php } else { ?>
            <li>
                <h4><a href="content.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</a></h4>
                <?php if ($_smarty_tpl->tpl_vars['value']->value['titlepic'] != '') {?>
                <a href="content.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['value']->value['titlepic'];?>
"></a>
                <?php }?>
                <div class="text">
                <?php echo $_smarty_tpl->tpl_vars['value']->value['sortContent'];?>
<span><?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['value']->value['pubdate']);?>
</span>
                </div>
            </li>
            <?php }?>
        <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_1_saved_local_item;
}
if ($__foreach_value_1_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_1_saved_item;
}
?>
        </ul>
    </div>
    <div class="news_right">

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
<?php echo '<script'; ?>
 src="../js/unslider/unslider.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $("#slider").unslider({
        arrows: false,
        fluid: true,
        dots: true
    });
<?php echo '</script'; ?>
>

</body>
</html><?php }
}
