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
  <title>北邮ihome个人页面 - 北邮易班</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" >
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
      <h2 class="header">个人中心</h2>
       <div class="carousel">
    <a class="carousel-item c_one" onclick="c_one_click()"><h4>系统通知</h4></a>
    <a class="carousel-item c_two" onclick="c_two_click()"><h4>我的提问</h4></a>
    <a class="carousel-item c_three" onclick="c_three_click()"><h4>我的投诉</h4></a>
    <a class="carousel-item c_four" onclick="c_four_click()"><h4>我的关注</h4></a>
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
  <script src="assets/js/new_materialize.min.js"></script>

  <script type="text/javascript">
      $(document).ready(function(){
      $('.carousel').carousel({padding: 100});
      $('.parallax').parallax();
    });

      var flag=0;
      var count1=0;
      var count2=0;
      var count3=0;
      var count4=0;
      function c_one_click(){
        if (flag==0){
          flag=1;
          self.location.href="mymessage.php"
        } 
        else if(flag==1){
          if (count1==0){
            count1=1;
          }
          else if(count1==1){
            self.location.href="mymessage.php"
            count1=0;
          }
        }
      }
      function c_two_click(){
        if (count2==0){
          count2=1;
        }
        else if(count2==1){
          self.location.href="myquestion.php"
          count2=0;
        }
      }
      function c_three_click(){
        if (count3==0){
          count3=1;
        }
        else if(count3==1){
          self.location.href="mycomplain.php"
          count3=0;
        }
      }
      function c_four_click(){
        if (count4==0){
          count4=1;
        }
        else if(count4==1){
          self.location.href="myattention.php"
          count4=0;
        }
      }
  </script>

 </body>
</html>
