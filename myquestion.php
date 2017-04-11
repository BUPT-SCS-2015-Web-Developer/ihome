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
  <title>我的提问 - 爱沙河 - 北邮易班</title>
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
  <footer class="page-footer grey">
   <div class="container">
    <div class="row">
     <div class="col l4 offset-l2 s12">
      <h5 class="white-text">Links</h5>
      <ul>
       <li><a class="grey-text text-lighten-3" href="#!">使用说明</a></li>
       <li><a class="grey-text text-lighten-3" href="#!">使用条款</a></li>
       <li><a class="grey-text text-lighten-3" href="#!">意见反馈</a></li>
      </ul>
     </div>
    </div>
   </div>
   <div class="footer-copyright">
    <div class="container">
      Copyright&copy; 北邮易班学生发展中心
     <a class="grey-text text-lighten-3" href="http://buptyiban.org/">BUPTYiban</a>
    </div>
   </div>
  </footer>
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
       $.post("api/mylist.php",{
        //mylist
           text:"",
           type:"1",
           sortby:"",
           start:""
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
                    var aaa=$(aaclone).html("<div class=\"card-content white-text\"><span class=\"card-title\"><a href=\"question.php?id="+qusid+"\" class=\"\">"+qussum+"</a></span><p>"+qussum+"</p></div><div class=\"card-action\"><a onclick=\"minus_answered_question("+qusid+")\">删除</a><div>");
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
  });

   function minus_answered_question(a){
    $a=a;
    $('#cardtoclone'+a).hide("slow");
    $.post("deletequestion.php",{id:a},function(){});
   }

 </script>
  </body>

</html>