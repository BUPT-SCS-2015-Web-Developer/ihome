<?php
    /*session_start();
  if(!isset($_SESSION['id'])){
    exit('非法访问！');
  }
  else{
    $user=$_SESSION['id'];
  }*/
?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>系统通知 - 爱沙河 - 北邮易班</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="assets/css/admin_and_me.css" type="text/css" rel="stylesheet" />
  <link href="assets/css/new_materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <!--<link href=".css" type="text/css" rel="stylesheet" />-->
 </head>
 <body>
  <header>
        <nav class="white" role="navigation">
            <div class="nav-wrapper container hide-on-med-and-down">
                <a href="index.php" class="brand-logo">北邮iHome</a>
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

  <!--  Scripts-->
  <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="assets/js/new_materialize.js"></script>
  <!--<script src="assets/js/index.js"></script>-->

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

           $.post("api/followalert.php",{
            //followalert
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
                    var qussum=qldata[a]['subject'];
                    var qusid=qldata[a]['id'];

                    var aclone=$(".cardtoclone:first").clone(true);
                    var aaclone=$(aclone).attr("id","cardtoclone"+qusid);
                    var aaa=$(aaclone).html("<div class=\"card-content white-text\"><span class=\"card-title\"><a href=\"question.php?id="+qusid+"\" class=\"\">您关注的问题有新动态，点击查看！</a></span><p>"+qussum+"</p></div><div class=\"card-action\"><a onclick=\"minus_xiaoxi("+qusid+")\">删除</a><div>");
                  //  console.log(aaa);
                    $(".sethere").append(aaa);
                }         
                //qSettings.start = 10;
                //qSettings.prevSettings = sSettings;
                //qSettings.prevSettings.start0 = 10;
            } else {
                //toggleStatus("加载失败，请重新搜索.");          
            }
        });
      
  })
 
   function minus_xiaoxi(a){
    $a=a;
    $('#cardtoclone'+a).hide("slow");
    $.post("API/haveread.php",{id:a},function(){});
   }
 </script>
</body>
</html>
