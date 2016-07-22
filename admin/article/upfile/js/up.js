function _delpic(furl){
  var url = "del.php";
  parent.document.getElementById('titlepic').value = '';
  $.ajax({
    url:url,
    type:"get",
    data:{
      fileUrl:furl,
      rnd:new Date()
    },
    dataType:"text",
    success:function(msg){
      if(msg=='ok'){
        window.location.href = 'upfile.php';
      }else if(msg=='error'){
        alert('文件不存在！');
        return false;
      }
    }
  });
}