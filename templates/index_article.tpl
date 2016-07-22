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
            <{foreach from=$piclist item=value}>
                <li style="background:url(<{$value.titlepic}>) no-repeat center;"></li>
            <{/foreach}>
            </ul>
        </div>
        <ul class="news_list">
            <{foreach from=$artlist item=value}>
            <{if $value.jumpurl!=''}>
            <li>
                <h4><a href="<{$value.jumpurl}>" target="_blank"><{$value.title}></a></h4>
                <a href="<{$value.jumpurl}>" target="_blank"><img src="<{$value.titlepic}>"></a>
                <{$value.sortContent}><span><{date('Y-m-d',$value.pubdate)}></span>
            </li>
            <{else}>
            <li>
                <h4><a href="content.php?id=<{$value.id}>" target="_blank"><{$value.title}></a></h4>
                <{if $value.titlepic!=''}>
                <a href="content.php?id=<{$value.id}>" target="_blank"><img src="<{$value.titlepic}>"></a>
                <{/if}>
                <div class="text">
                <{$value.sortContent}><span><{date('Y-m-d',$value.pubdate)}></span>
                </div>
            </li>
            <{/if}>
        <{/foreach}>
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

<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../plugins/layer/layer.js"></script>
<script src="../js/common.js"></script>
<script src="../plugins/bootstrap-3.3.4/js/bootstrap.min.js"></script>
<script src="../js/unslider/unslider.min.js"></script>
<script>
    $("#slider").unslider({
        arrows: false,
        fluid: true,
        dots: true
    });
</script>

</body>
</html>