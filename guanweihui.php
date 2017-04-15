<?php
session_start();
//include "assets/API/header_api_session.php";
?>


<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>管委会操作平台 - 爱沙河 - 北邮易班</title>
        <link href="assets/css/admin_and_me.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" />
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

    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="assets/js/materialize.min.js"></script>
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
       $.post("API/classify.php",{
        //classify
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
                        var qussum=qldata[a]['content'];
                        var qussub=qldata[a]['subject'];
                        var qusid=qldata[a]['id'];

                        var aclone=$(".cardtoclone:first").clone(true);
                        var aaclone=$(aclone).attr("id","cardtoclone"+qusid);
                        var aaa=$(aaclone).html("<div class=\"card-content white-text\"><span class=\"card-title\"><a href=\"question.php?id="+qusid+"\" class=\"\">"+qussub+"</a></span><p>"+qussum+"</p></div><div class=\"card-action\"><a href=\"#\" onclick=\"todelete("+qusid+")\">删除</a><a href=\"#modal"+qusid+"\" onclick=\"showmodal("+qusid+")\">分配任务</a><div id=\"modal"+qusid+"\" class=\"modal\"><div class=\"modal-content\"><h4></h4><div class=\"row\"><form class=\"col s12\"><div class=\"row\"><div class=\"input-field col s12\"><select id=\"department"+qusid+"\"><option value=\"\" disabled selected>请选择</option><option value=\"1\">学生事务部</option><option value=\"2\">教务部</option><option value=\"3\">安全保卫部</option><option value=\"4\">后勤保障部</option><option value=\"5\">宣传部</option><option value=\"6\">医务室</option><option value=\"7\">图书馆</option><option value=\"8\">管委会</option></select><label>选择分发至</label></div></div></form></div></div><div class=\"modal-footer\"><a href=\"#!\"  type=\"submit\"  name=\"action\" onclick=\"hidemodal("+qusid+")\"  class=\" modal-action modal-close waves-effect waves-green btn-flat\">提交</a><a class=\" modal-action modal-close waves-effect waves-green btn-flat\"onclick=\"$('#modal"+qusid+"').modal('close');\">关闭</a></div></div>");
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

            $('.modal').modal();
            $('select').material_select();
            $('.card-action').hide();
        });
    });

  function showmodal(b){
    //$b=b;
    $('#modal'+b).modal('open');
  }
   function hidemodal(b){
    var q=$('#department'+b).val();
    if (q=='1')
        var d="学生事务部";
    else if (q=='2')
        var d="教务部";
    else if (q=='3')
        var d="安全保卫部";
    else if (q=='4')
        var d="后勤保障部";
    else if (q=='5')
        var d="宣传部";
    else if (q=='6')
        var d="医务室";
    else if (q=='7')
        var d="图书馆";
    else if (q=='8')
        var d="管委会";
    else
        Materialize.toast('未完成~~~', 3000, 'rounded');
    if (q=='1'||q=='2'||q=='3'||q=='4'||q=='5'||q=='6'||q=='7'||q=='8'){
        Materialize.toast('提交成功！任务已分发至'+d+'~~~', 3000, 'rounded');
       $('#cardtoclone'+b).hide("slow");}
    $('#modal'+b).modal('close');

    $.post("API/setProcessor.php",{id:b,processor:d},function(){});
  }
    function todelete(b){
    //$b=b;
    $('#cardtoclone'+b).hide("slow");
    $.post("API/deletequestion.php",{id:b},function(){});
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
