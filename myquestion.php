<?php
session_start();
//include "assets/API/header_api_session.php";
?>



<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>我的提问 - 爱沙河 - 北邮易班</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="assets/css/admin_and_me.css" type="text/css" rel="stylesheet" />
  <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <!--<link href=".css" type="text/css" rel="stylesheet" />-->
 </head>
 <body>
  <?php include("header.php"); ?>
       <div class="quesBox container">

        <div class="row">
        <div class="col s12 sethere">
          <div class="card white cardtoclone" id="acard">
          </div>
          </div>
        </div>

      </div>
         <div class="fixed-action-btn horizontal click-to-toggle" id="caozuobutton">
    <a class="btn-floating btn-large blue-grey lighten-3" onclick="showcaozuo()">操作</a>
  </div>

  <!--  Scripts-->
  <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="assets/js/new_materialize.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    //$('.modal-trigger').leanModal({
    //dismissible: true, // 点击模态框外部则关闭模态框
    //opacity: .5, // 背景透明度
    //in_duration: 300, // 切入时间
   // out_duration: 200, // 切出时间

      //});
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
       $.post("API/mylist.php",{
        //mylist
           text:"",
           type:"1",
           sortby:"",
           start:""
        },function(text_str){
            var text = text_str;
            if (alertStatus(text['status'])){
                var qldata=text['data'];
                var l=0;
                for(var a in qldata){l++;}
                //alert(l);
                //toggleStatus("下拉加载更多...");
                //if (l<10) {
                if (l==0) $(".sethere").append("<div class=\"card white\"><div class=\"card-content white-text\"><span class=\"card-title\"></span><p>没有查询到信息！</p></div></div>");
                    //toggleStatus("没有更多了.");
                    //qSettings.full = true;
                //}
                else{
                    for (var a in qldata){
                        var qussub=qldata[a]['subject'];
                        var qussum=qldata[a]['content'];
                        var qusid=qldata[a]['id'];

                        var aclone=$(".cardtoclone:first").clone(true);
                        var aaclone=$(aclone).attr("id","cardtoclone"+qusid);
                        var aaa=$(aaclone).html("<div class=\"card-content white-text\"><span class=\"card-title\"><a href=\"question.php?id="+qusid+"\" class=\"\">"+qussub+"</a></span><p>"+qussum+"</p></div><div class=\"card-action\"><a onclick=\"minus_answered_question("+qusid+")\">删除</a><div>");
                      //  console.log(aaa);
                        $(".sethere").append(aaa);
                    }
                }
                //qSettings.start = 10;
                //qSettings.prevSettings = sSettings;
                //qSettings.prevSettings.start0 = 10;
            } else {
                //toggleStatus("加载失败，请重新搜索.");
            }
            $('.card-action').hide();
        });
  });

   function minus_answered_question(a){
    $a=a;
    $('#cardtoclone'+a).hide("slow");
    $.post("API/deletequestion.php",{id:a},function(){});
   }
$(function(){
         $(".button-collapse").sideNav();
      });
 </script>
  <script type="text/javascript">
function showcaozuo(){
  $('.card-action').show("slow");
  $('#caozuobutton').html("<a class=\"btn-floating btn-large blue-grey lighten-3\" onclick=\"hidecaozuo()\">恢复</a>")
}
function hidecaozuo(){
  $('.card-action').hide("slow");
  $('#caozuobutton').html("<a class=\"btn-floating btn-large blue-grey lighten-3\" onclick=\"showcaozuo()\">操作</a>")
}
 </script>
  </body>

</html>
