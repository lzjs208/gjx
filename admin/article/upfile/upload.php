<style>
body{margin:0; padding:0; font-size:12px;}
</style>
<script src="../../../js/jquery-1.11.3.min.js"></script>
<script src="js/up.js"></script>
<?php
//包含一个文件上传类中的上传类
include "../../../include/fileUpload.class.php";

$up = new fileupload;
//设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
$up -> set("path", "../../../files/uploadfiles/titlepic/");
$up -> set("maxsize", 2000000000);
$up -> set("allowtype", array("gif", "png", "jpg", "jpeg"));
$up -> set("israndname", true);

//使用对象中的upload方法， 就可以上传文件， 方法需要传一个上传表单的名子 pic, 如果成功返回true, 失败返回false
if($up -> upload("file")) {
  //获取上传后文件名子
  $fileUrl = $up -> getFilePath().$up -> getFileName();
//  echo "<label>标题图片：</label>";
  echo "上传成功&nbsp;";
  echo "<script>parent.document.getElementById('titlepic').value = '".$fileUrl."';</script>";
  echo "<a href='javascript:void(0);' onclick=_delpic('".$fileUrl."');>重新上传</a>&nbsp;";
  echo "<a href='$fileUrl' target='_blank'>查看图片</a>";
} else {
  //获取上传失败以后的错误提示
  echo $up->getErrorMsg();
  echo "<a href='javascrpt:void(0);' onclick='javascript:history.back();'>返回</a>";
}

?>