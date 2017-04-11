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
  <title>我的反馈 - 爱沙河 - 北邮易班</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="assets/css/admin_and_me.css" type="text/css" rel="stylesheet" />
  <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <!--<link href=".css" type="text/css" rel="stylesheet" />-->
 </head>
 <body>
  <?php include("header.php"); ?>

    <div class="row">
      <div class="quesBox container">
    <ul class="tabs">
      <li class="tab col s3"><a href="#test1">已解决</a></li>
      <li class="tab col s3"><a class="active" href="#test2">未解决</a></li>
    </ul>
    <div id="test1" class="col s12">

        <div class="row">
        <div class="col s12 sethere1">
          <div class="card white acardtoclone" id="acard">
          </div>
          </div>

      </div>
    </div>
    <div id="test2" class="col s12">

        <div class="row">
        <div class="col s12 sethere2">
          <div class="card white bcardtoclone" id="bcard">
          </div>
          </div>
      </div>
      </div>
    </div>
</div>

  <!--  Scripts-->
  <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="assets/js/materialize.min.js"></script>
  <!--<script src="assets/js/index.js"></script>-->

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
            search:'',
            type:'2',
            sortby:'',
            start:''
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
                    var quspro=qldata[a]['progress'];
                    var type=qldata[a]['listType'];

                    if(type=="solved"){

                    var aclone=$(".acardtoclone:first").clone(true);
                    var aaclone=$(aclone).attr("id","acardtoclone"+qusid);
                    var aaa=$(aaclone).html("<div class=\"card-content white-text\"><span class=\"card-title\"><a href=\"question.php?id="+qusid+"\" class=\"\">"+qussum+"</a></span><p>"+qussum+"</p></div><div class=\"card-action\"><a href=\"#\" onclick=\"minus_answered_question("+qusid+")\">删除</a><a href=\"#modal"+qusid+"\" onclick=\"showmodel("+qusid+")\" id=\"comment"+qusid+"\">去评价</a><div id=\"modal"+qusid+"\" class=\"modal\"><div class=\"modal-content\"><h4></h4><div class=\"row\"><form class=\"col s12\"><div class=\"row\"><div class=\"input-field col s12\"><select id=\"attitude"+qusid+"\"> <option value=\"\" disabled selected>请选择</option><option value=\"1\">1</option><option value=\"2\">2</option><option value=\"3\">3</option><option value=\"4\">4</option><option value=\"5\">5</option></select><label>服务态度</label></div><div class=\"input-field col s12\"><select id=\"result"+qusid+"\"><option value=\"\" disabled selected>请选择</option><option value=\"1\">1</option><option value=\"2\">2</option><option value=\"3\">3</option><option value=\"4\">4</option><option value=\"5\">5</option></select><label>处理结果</label></div><div class=\"input-field col s12\"><select id=\"efficiency"+qusid+"\"><option value=\"\" disabled selected>请选择</option><option value=\"1\">1</option><option value=\"2\">2</option><option value=\"3\">3</option><option value=\"4\">4</option><option value=\"5\">5</option></select><label>办理效率</label></div><div class=\"input-field col s12\"><select id=\"all_in_all"+qusid+"\"><option value=\"\" disabled selected>请选择</option><option value=\"1\">1</option><option value=\"2\">2</option><option value=\"3\">3</option><option value=\"4\">4</option><option value=\"5\">5</option></select><label>总体满意度</label></div><div class=\"input-field col s12\"><textarea id=\"description"+qusid+"\" class=\"materialize-textarea\"></textarea><label for=\"textarea1\">文字评价</label></div></div></form></div></div><div class=\"modal-footer\"><a href=\"#!\"  type=\"submit\"  name=\"action\" onclick=\"hidemodel("+qusid+")\"  class=\" modal-action modal-close waves-effect waves-green btn-flat\">提交</a></div></div>");
                  //  console.log(aaa);
                    $(".sethere1").append(aaa);}
                    
                    else if(type=="unsolved"){

                    var bclone=$(".bcardtoclone:first").clone(true);
                    var bbclone=$(bclone).attr("id","bcardtoclone"+qusid);
                    var bbb=$(bbclone).html("<div class=\"card-content white-text\"><span class=\"card-title\"><a href=\"question.php?id="+qusid+"\" class=\"\">"+qussum+"</a></span><p>"+qussum+"</p></div><div class=\"card-action\"><a>"+quspro+"<a><a onclick=\"minus_notanswer_question("+qusid+")\">删除</a><a onclick=\"toast("+qusid+")\" >催办</a><div> ");
                  //  console.log(aaa);
                    $(".sethere2").append(bbb);}
                }         
                //qSettings.start = 10;
                //qSettings.prevSettings = sSettings;
                //qSettings.prevSettings.start0 = 10;
            } else {
                //toggleStatus("加载失败，请重新搜索.");          
            }

  $('.modal').modal();
  $('.tooltipped').tooltip({delay: 50});
    $('select').material_select();
        });

 
  });

  function toast(b){
    Materialize.toast('催办成功！请耐心等待哟~~~', 3000, 'rounded');
    $.post("api/urge.php",{id:b},function(){});

  }

  function showmodel(b){
    $b=b;
    $('#modal'+b).modal('open');
  }
   function hidemodel(b){
    //调试用
    /*var q1=$("#attitude").val();
    var q2=$("#result").val();
    var q3=$("#efficiency").val();
    var q4=$("#all_in_all").val();
    var q5=$("#description").val();
    alert(q1+q2+q3+q4+q5);*/

    //向后端发数据，正式用
    $.post("api/appraise.php",
  { 
    id:b,
    attitude:$("#attitude"+b).val(),
    result:$("#result"+b).val(),
    efficiency:$("#efficiency"+b).val(),
    all_in_all:$("#all_in_all"+b).val(),
    description:$("#description"+b).val()
  },function(){});
    Materialize.toast('提交成功！感谢您的评价~~~', 3000, 'rounded');
    $b=b;
    $('#modal'+b).modal('close');
    $('#comment'+b).removeAttr("onclick");
    $('#comment'+b).removeAttr("href");
    $('#comment'+b).html("已评价");
  }
  </script>

  <script>
   function minus_answered_question(a){
    $a=a;
    $('#acardtoclone'+a).hide("slow");
    $.post("api/deletequestion.php",{id:a},function(){});
   }

    function minus_notanswer_question(a){
    $a=a;
    $('#bcardtoclone'+a).hide("slow");
    $.post("api/deletequestion.php",{id:a},function(){});
   }
      $(function(){
         $(".button-collapse").sideNav(); 
      });
 </script>
  </body>
</html>