<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
	登录页面
</title></head>
<body>
    <form id="form1"  action="SetDataRegAndSeal.php" method="post"> 
    <div style="width:400px; height:100px; margin:50px auto;text-align:center;">
        <h1>“汇签单”效果演示</h1>
        <div style=" font-size:12px;"><span style=" color:Red;">演示：</span>不同的用户登录后，在文档中不同区域可以输入意见和盖章。<br />（印章用户名：登录名，密码：123456）</div>
    </div>
    
    <div style=" font-size:12px; margin:20px auto; border:solid 1px blue; width:400px; height:200px; text-align:center;">
    <br /><br />
    <div>请选择登录用户：</div><br /><br />
    <select name="userName">
        <option selected="selected" value="zhangsan">张三</option>
        <option  value="lisi">李四</option>
        <option  value="wangwu">王五</option>
    </select><br /><br />
    <input type="submit"  value="登录" /><br /><br />
    
    </div>
    </form>
</body>

</html>

