<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8">
<script src="../../../js/jquery-1.11.3.min.js"></script>
<script src="js/up.js"></script>
<style type="text/css">
body{margin:0; padding:0; font-size:12px; font-family:"microsoft yahei",Tahoma,Helvetica,Arial,"\5b8b\4f53",sans-serif; color:#333;}
</style>
<title>文件上传</title>
</head>
<body>
<form name="form" id="form" enctype="multipart/form-data" method="post" action="upload.php">
  <input type="file" name="file" id="file" style="display:inline-block;">
  <input type="submit" id="btn_upfile" class="btn_upfile" value="上传">
</form>
<script>
var pic = parent.document.getElementById('titlepic').value;
if(pic != ''){
  document.getElementById('form').style.display = 'none';
  createHtml(pic);
}

function createHtml(obj){
  _attrVal = "_delpic('" + obj +"')";
  var node = document.createElement('a');
  var node2 = document.createElement('a');
  node.setAttribute('href','javascript:void(0);');
  node.setAttribute('onclick',_attrVal);
  node2.setAttribute('href',obj);
  node2.setAttribute('target','_blank');
  var textnode = document.createTextNode('重新上传');
  var textnode2 = document.createTextNode('查看图片');
  node.appendChild(textnode);
  node2.appendChild(textnode2);
  document.body.appendChild(node);
  document.body.appendChild(node2);
}
</script>
</body>
</html>