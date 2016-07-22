function _delpic(obj){
  if(obj){
    if(confirm('确认要删除该图片吗？')) {
      var _url = 'upfile2/del.php';
      var _imgUrl = $(obj).siblings('img').attr('src');
      if (_imgUrl) {
        $.get(_url, {fileUrl: _imgUrl, rnd: new Date()}, function (data) {
          if(Number(data)==1){
            $(obj).parent('div').remove();
          }else{
            alert('文件删除失败');
          }
        });
      }
    }
  }
}//删除缩略图