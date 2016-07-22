$(document).ready(function(){

  $("#form").submit(function(){
    var _title = $("#title").val();
    var _catId = $("#catId").val();

    if(_title==""){
      layer.msg("文章标题不能为空！",{icon:5});
      return false;
    }
    if(_catId==0){
      layer.msg("请选择文章所在栏目！",{icon:5});
      return false;
    }

    $("#thumbs").val(getthumbs());

    return true;
  })

  function getthumbs(){
    var _thumbs = $("#thumbs_area > div").size();
    var pics = "";
    if(_thumbs > 0){
      imgs = $("#thumbs_area div").each(function(index,ele){
        var imgUrl = $(ele).children("img").attr("src");
        var imgTitle = $(ele).children("input[type=text]").val();
        imgUrl = imgUrl.replace(/\.\.\//g,"");
        imgUrl = imgUrl.replace("../../../","/");
        pics += imgUrl + "|" + imgTitle + ",";
      })

    }

    return pics;
  }
  //文件上传
  $("#btn_upfile").click(function(){
    var _titlepic = $("#file").val();
    if(_titlepic==""){
      layer.msg("请先选择要上传的图片！",{icon:2});
    }else{
      var _url = "upload.php";
      var _data = {
        file: _titlepic,
        rnd: new Date()
      }
      $.ajax({
        type:"post",
        url:_url,
        async:false,
        data:_data,
        dataType:"text",
        success:function(data){
          //alert(data);
        }
      })//--ajax end
    }
  })//--click end

})

function delArc(objId){
  if(confirm("确定要删除该文章吗？")){
    var _arcId = objId;
    var _url = "delarticle.php";

    $.get(_url,{arcId:_arcId, rnd:new Date()},function(msg){
      alert(msg);
      if(Number(msg)==1){
        layer.msg("删除成功！",{icon:1});
        location.reload();
      }else if(Number(msg)==0){
        layer.msg("删除不成功！",{icon:2});
        location.reload();
      }
    });
  }

}

function editArc(objId){
  var _arcId = objId
  var _url = "editarticle.php";
  location.href = _url + "?id=" + _arcId;
}