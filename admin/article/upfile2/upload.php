<style>
body{margin:0; padding:0; font-size:12px;}
</style>
<script src='../../../js/jquery-1.11.3.min.js'></script>
<script>
function fill_thumbs(val){
  parent.$('#thumbs_area').append(val);
}
function goBack(){
  window.location.href = 'upfile.php';
}
</script>

<?php
//包含一个文件上传类中的上传类
include '../../../include/fileUpload.class.php';

$up = new fileupload;
//设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
$up -> set('path', '../../../files/uploadfiles/');
$up -> set('maxsize', 2000000000);
$up -> set('allowtype', array('gif', 'png', 'jpg', 'jpeg'));
$up -> set('israndname', true);

//使用对象中的upload方法， 就可以上传文件， 方法需要传一个上传表单的名子 pic, 如果成功返回true, 失败返回false
if($up -> upload('file')) {
  //获取上传后文件名子
  $fileUrl = $up -> getFilePath().$up -> getFileName();
  $fileName = $up -> getOriginal();
  echo "<label>标题图片：</label>";
  echo "<a href='javascript:void(0);' onclick='goBack();'>继续上传</a>";
  echo "<script>fill_thumbs('<div><span onclick=_delpic(this);><img src=../images/close.gif></span><img src=".$fileUrl." width=100 height=75 onclick=window.open(".$fileUrl.");><input type=text name=txt value=".$fileName."></div>');</script>";
} else {
  //获取上传失败以后的错误提示
  echo $up->getErrorMsg();
  echo "<a href='javascrpt:void(0);' onclick='javascript:history.back();'>返回</a>";
}

?>
