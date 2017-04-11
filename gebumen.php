<?php
    session_start();
    $_SESSION['school_id'] = '2015211314';
    $_SESSION['yiban_id'] = '456';
    $_SESSION['type'] = 'admin';
    $_SESSION['name'] = '管理员的昵称';
 ?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>问题反馈页 - 爱沙河 - 北邮易班</title>
    <link href="assets/css/admin_and_me.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <header>
        <nav class="white" role="navigation">
            <div class="nav-wrapper container hide-on-med-and-down">
                <a href="index.php" class="brand-logo">爱沙河</a>
                <ul class="right">
                </ul>
            </div>

        </nav>
    </header>

        <div class="quesBox container">

        <div class="row">
        <div class="col s12 sethere">
          <div class="card white cardtoclone" id="acard">
          </div>
          </div>
        </div>

      </div>


    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="assets/js/materialize.min.js"></script>
      <script type="text/javascript">
      $(document).ready(function(){

        var errormsg = {};
            errormsg['error'] = "xxx时遇到数据库错误.";
            errormsg['login first']="请先登录!";
            errormsg['failed']="该条目可能已经被删除!";
            errormsg['parameter error']="参数错误";
        
        var alertStatus = function(type) {
                if (type=="success") return true;
                try {
                    Materialize.toast(errormsg[type],4000);
                } catch(e) {
                    Materialize.toast("加载问题详情时遇到未知错误",3000);
                }
                return false;
            }

       $.post("api/adminlist.php",{
        //adminlist
        },function(text_str){
            var text = text_str;
            if (alertStatus(text['status'])){
                var qldata=text['data'];
                //var l=qldata.data.length;
                //alert(l);
                //toggleStatus("下拉加载更多...");
                //if (l<10) {
                    //if (l==0) Materialize.toast("没有查询到数据!",3000);
                    //toggleStatus("没有更多了.");
                    //qSettings.full = true;
                //}
                for (var a in qldata){
                    var qussum=qldata[a]['content'];
                    var qusid=qldata[a]['id'];

                    var aclone=$(".cardtoclone:first").clone(true);
                    var aaclone=$(aclone).attr("id","cardtoclone"+qusid);
                    var aaa=$(aaclone).html("<div class=\"card-content white-text\"><span class=\"card-title\"><a href=\"question.php?id="+qusid+"\" class=\"\">"+qussum+"</a></span><p>"+qussum+"</p></div><div class=\"card-action\"><a href=\"#modal"+qusid+"\" onclick=\"showmodal("+qusid+")\">回复</a><div id=\"modal"+qusid+"\" class=\"modal\"><div class=\"modal-content\"><h4></h4><div class=\"row\"><form class=\"col s12\"><div class=\"row\"><div class=\"input-field col s12\"><textarea id=\"textarea"+qusid+"\" class=\"materialize-textarea\"></textarea><label for=\"textarea1\">请在此输入回复内容</label></div></div></form></div></div><div class=\"modal-footer\"><a href=\"#!\"  type=\"submit\"  name=\"action\" onclick=\"hidemodal("+qusid+")\"  class=\" modal-action modal-close waves-effect waves-green btn-flat\">提交</a></div></div>");
                  //  console.log(aaa);
                    $(".sethere").append(aaa);
                }         
                //qSettings.start = 10;
                //qSettings.prevSettings = sSettings;
                //qSettings.prevSettings.start0 = 10;
            } else {
                //toggleStatus("加载失败，请重新搜索.");          
            }

            $('.modal').modal();
            $('select').material_select();
        });
    });

  function showmodal(b){
    //$b=b;
    $('#modal'+b).modal('open');
  }
   function hidemodal(b){
    var q=$('#textarea'+b).val();
        Materialize.toast('回复成功！', 3000, 'rounded');
    //$b=b;
    $('#modal'+b).modal('close');
    $.post("reply.php",{id:b,reply:q},function(){});
  }
    function todelete(b){
    //$b=b;
    $('#cardtoclone'+b).hide("slow");
    //$.post("delete.php",{id:b},function(){});
  }
          $(function(){
         $(".button-collapse").sideNav(); 
      });
  </script>

    
</body>
</html>