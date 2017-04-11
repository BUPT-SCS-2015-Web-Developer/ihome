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
  <title>我的关注 - 爱沙河 - 北邮易班</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="assets/css/admin_and_me.css" type="text/css" rel="stylesheet" />
  <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <!--<link href=".css" type="text/css" rel="stylesheet" />-->
 </head>
 <body>
  <?php include("header.php"); ?>
    <div class="container">
        <h5><i class="material-icons right">visibility</i>我关注的问题</h5>
      </div>
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
  <script src="assets/js/materialize.min.js"></script>
  <!--<script src="assets/js/index.js"></script>-->
  <script type="text/javascript">
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
             $.post("api/followlist.php",{
              //followlist
            search:'',
            type:'',
            sortby:'',
            start:''
        },function(text_str){
            var text = text_str;
            if (alertStatus(text['status'])){
                var qldata=text['data'];
                for (var a in qldata){
                    var qussub=qldata[a]['subject'];
                    var qussum=qldata[a]['content'];
                    var qusid=qldata[a]['id'];

                    var aclone=$(".cardtoclone:first").clone(true);
                    var aaclone=$(aclone).attr("id","cardtoclone"+qusid);
                    var aaa=$(aaclone).html("<div class=\"card-content white-text\"><span class=\"card-title\"><a href=\"question.php?id="+qusid+"\" class=\"\">"+qussub+"</a></span><p>"+qussum+"</p></div><div id=\"heart"+qusid+"\" class=\"card-action\"><a onclick=\"minus_guanzhu("+qusid+")\"><img src=\"assets/img/ic_thanked.png\" alt=\"取消关注\"></a></div>");
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
      
      $(function(){
         $(".button-collapse").sideNav(); 
      });
  </script>

 <script type="text/javascript">
   function minus_guanzhu(a){
    $a=a;
    $('#heart'+a).html("<a onclick=\"add_guanzhu("+a+")\"><img src=\"assets/img/ic_thank.png\" alt=\"关注\"></a>");
    $.post("API/praise.php",{id:a,type:"follow"},function(){});
   }
    function add_guanzhu(a){
    $a=a;
    $('#heart'+a).html("<a onclick=\"minus_guanzhu("+a+")\"><img src=\"assets/img/ic_thanked.png\" alt=\"取消关注\"></a>");
    $.post("API/praise.php",{id:a,type:"follow"},function(){});
   }
 </script> 
</body>
</html>

