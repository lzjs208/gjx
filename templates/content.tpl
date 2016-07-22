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
        <div class="title"><{$result.title}></div>
        <div class="attr">来源：<{$result.source}><span class="r">日期：<{date("Y-m-d h:i:s",$result.pubdate)}>&nbsp;阅读：<{$result.click}></span></div>
        <div class="art_content">
            <{$result.content}>
        </div>
    </div>
    <div class="news_hot">
        <div class="m_hd"><span class="head">热门文章</span></div>
        <ul class="artlist">
            <{foreach from=$arrlist item=value}>
                <li><a href="content.php?id=<{$value.id}>"><{$value.title|truncate:14}></a></li>
            <{/foreach}>
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

<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../plugins/layer/layer.js"></script>
<script src="../js/common.js"></script>
<script src="../plugins/bootstrap-3.3.4/js/bootstrap.min.js"></script>

</body>
</html>
