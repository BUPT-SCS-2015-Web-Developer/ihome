<?php
    /*session_start();
  if(!isset($_SESSION['id'])){
    exit('非法访问！');
  }
  else{
    $user=$_SESSION['id'];
  }*/
  $con = mysqli_connect('localhost', 'root', 'jmy5zhentan5') or die ("不能连接数据库:");
  mysqli_select_db($con,'yiban');
?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>北邮ihome我的投诉 - 北邮易班</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="assets/css/new_materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <!--<link href=".css" type="text/css" rel="stylesheet" />-->
 </head>
 <body>
  <header>

  </header>
  <main>
      <div class="parallax-container">
    <div class="parallax"><img src="assets/img/1.JPG"></div>
  </div>
  <div class="section white">
    <div class="row container">
      <h2 class="header">我的投诉</h2>
          <div class="container">
    <div class="row">
    <div class="col s12">
    <ul class="tabs">
      <li class="tab col s3"><a href="#test1">已解决</a></li>
      <li class="tab col s3"><a class="active" href="#test2">未解决</a></li>
    </ul>
    </div>
    <div id="test1" class="col s12">
          <table>
      <thead>
        <tr>
          <th data-field="id"><a href="personalindex.php" class="waves-effect waves-teal btn-flat">返回</a></th>
          <th data-field="id"><a href="" class=""></a></th>
          <th data-field="id" id="twobutton1"><a onclick="showminus1()" class="waves-effect waves-teal btn-flat">编辑</a></th>
        </tr>
      </thead>

      <tbody>
<?php
    mysqli_query($con,"set names 'utf8'");
  $result = mysqli_query($con,"SELECT * FROM `iHome_question`");
  $num_result = mysqli_num_rows($result);
  for ($i=0;$i<$num_result;$i++) {
    $row = mysqli_fetch_row($result);
    if ($row[1]=='2'){
        ?> 
        <tr class="hoverable" id="minus_answered_question_<?php echo $i?>">
          <td><a href="" class="">问题<?php echo $i?>巴拉巴拉巴拉</a></td><td id="comment<?php echo $i?>"><a href="#model<?php echo $i?>" onclick="showmodel(<?php echo $i?>)" class="waves-effect waves-teal btn-flat modal-trigger">去评价</a>
            <div id="modal<?php echo $i?>" class="modal">
            <div class="modal-content">
             <h4>带评价的问题是啥放在这里</h4>
             <div class="row">
              <form class="col s12">
               <div class="row">
                <div class="input-field col s12">
                <select id="attitude">
                 <option value="" disabled selected>请选择</option>
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                </select>
               <label>服务态度</label>
             </div>
            <div class="input-field col s12">
                <select id="result">
                 <option value="" disabled selected>请选择</option>
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                </select>
               <label>处理结果</label>
             </div>
             <div class="input-field col s12">
                <select id="efficiency">
                 <option value="" disabled selected>请选择</option>
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                </select>
               <label>办理效率</label>
             </div>
             <div class="input-field col s12">
                <select id="all_in_all">
                 <option value="" disabled selected>请选择</option>
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                </select>
               <label>总体满意度</label>
             </div>
                <div class="input-field col s12">
                 <textarea id="description" class="materialize-textarea"></textarea>
                  <label for="textarea1">文字评价</label>
                </div>
              </div>
             </form>
           </div>
            </div>
            <div class="modal-footer">
              <a href="#!"  type="submit"  name="action" onclick="hidemodel(<?php echo $i?>)"  class=" modal-action modal-close waves-effect waves-green btn-flat">提交</a>
             </div>
           </div>
        </td>
          <td><a onclick="minus_answered_question(<?php echo $i?>)"><img src="assets/img/icon_minus_alt.png" class="minus1"></a></td>       
        </tr>
    
<?php   
        }
      }
?> 
  </tbody>
    </table>
    </div>
    <div id="test2" class="col s12">
            <table>
      <thead>
        <tr>
          <th data-field="id"><a href="personalindex.php" class="waves-effect waves-teal btn-flat">返回</a></th>
          <th data-field="id"><a href="" class=""></a></th>
          <th data-field="id"><a href="" class=""></a></th>
          <th data-field="id" id="twobutton2"><a onclick="showminus2()" class="waves-effect waves-teal btn-flat">编辑</a></th>
        </tr>
      </thead>

      <tbody>
<?php
    mysqli_query($con,"set names 'utf8'");
  $result = mysqli_query($con,"SELECT * FROM `iHome_praise` WHERE type='guanzhu'");
  $num_result = mysqli_num_rows($result);
  for ($i=0;$i<$num_result;$i++) {
    $row = mysqli_fetch_row($result);
        ?> 
        <tr class="hoverable" id="minus_notanswer_question_<?php echo $i?>">
          <td><a href="" class="">问题<?php echo $i?>巴拉巴拉巴拉</a></td>
          <td>审核中</td>
          <td><a onclick="toast(<?php echo $i?>)" class="waves-effect waves-teal btn-flat modal-trigger">催办</a></td>
          <td><a onclick="minus_notanswer_question(<?php echo $i?>)"><img src="assets/img/icon_minus_alt.png" class="minus2"></a></td>                  
        </tr>
<?php   
        }
?> 
      </tbody>
    </table>
    </div>
  </div>
    </div>
    </div>
  </div>
  <div class="parallax-container">
    <div class="parallax"><img src="assets/img/2.JPG"></div>
  </div>
  </main>
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
  $('.parallax').parallax();
  $('.modal').modal();
  $('.tooltipped').tooltip({delay: 50});
    $('select').material_select();
  });

  function toast(b){
    Materialize.toast('催办成功！请耐心等待哟~~~', 3000, 'rounded');
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
    /*$.post(".php",
  { 
    questionid：
    attitude:$("#attitude").val()
    result:$("#result").val()
    efficiency:$("#efficiency").val()
    all_in_all:$("#all_in_all").val()
    description:$("#description").val()
  });*/
    Materialize.toast('提交成功！感谢您的评价~~~', 3000, 'rounded');
    $b=b;
    $('#modal'+b).modal('close');
    $('#comment'+b).html("<a class=\"waves-effect waves-teal btn-flat disabled\">已评价</a>");
  }
  </script>

    <script type="text/javascript">
  $(document).ready(function(){
      $('.minus2').hide();
  })


  function showminus2(){
    $('.minus2').show();
    $('#twobutton2').html("<a onclick=\"hideminus2()\" class=\"waves-effect waves-teal btn-flat\">完成</a>");
  }

    function hideminus2(){
    $('.minus2').hide();
    $('#twobutton2').html("<a onclick=\"showminus2()\" class=\"waves-effect waves-teal btn-flat\">编辑</a>");
  }

 </script>
     <script type="text/javascript">
  $(document).ready(function(){
      $('.minus1').hide();
  })


  function showminus1(){
    $('.minus1').show();
    $('#twobutton1').html("<a onclick=\"hideminus1()\" class=\"waves-effect waves-teal btn-flat\">完成</a>");
  }

    function hideminus1(){
    $('.minus1').hide();
    $('#twobutton1').html("<a onclick=\"showminus1()\" class=\"waves-effect waves-teal btn-flat\">编辑</a>");
  }

 </script>
  <script>
   function minus_answered_question(a){
    $a=a;
    $('#minus_answered_question_'+a).hide();
   }

    function minus_notanswer_question(a){
    $a=a;
    $('#minus_notanswer_question_'+a).hide();
   }
 </script>
  </body>
</html>