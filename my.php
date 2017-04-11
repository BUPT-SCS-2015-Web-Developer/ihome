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
  <title>个人主页 - 爱沙河 - 北邮易班</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" >
  <link href="assets/css/admin_and_me.css" type="text/css" rel="stylesheet" />
  <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <!--<link href=".css" type="text/css" rel="stylesheet" />-->
 </head>
 <body>
  <?php include("header.php"); ?>
  <main>

    <div class="row container">
       <div class="carousel">
    <a class="carousel-item c_one" onclick="c_one_click()"><h4>系统通知</h4></a>
    <a class="carousel-item c_two" onclick="c_two_click()"><h4>我的提问</h4></a>
    <a class="carousel-item c_three" onclick="c_three_click()"><h4>我的反馈</h4></a>
    <a class="carousel-item c_four" onclick="c_four_click()"><h4>我的关注</h4></a>
  </div>
  </div>


  </main>

  <!--  Scripts-->
  <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="assets/js/materialize.min.js"></script>

  <script type="text/javascript">
      $(document).ready(function(){
          $(".button-collapse").sideNav();
      $('.carousel').carousel({padding: 100});
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
