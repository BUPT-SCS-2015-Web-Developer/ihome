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
  <title>北邮ihome我的关注 - 北邮易班</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href=".css" type="text/css" rel="stylesheet" />
 </head>
 <body>
  <header>

  </header>
  <main>
    <div class="container">
    <div class="row">
    <div class="col s12">
    <ul class="tabs">
      <li class="tab col s3"><a href="#test1">提问</a></li>
      <li class="tab col s3"><a class="active" href="#test2">投诉</a></li>
    </ul>
    </div>
    <div id="test1" class="col s12">
<?php
    mysqli_query($con,"set names 'utf8'");
  $result = mysqli_query($con,"SELECT * FROM `iHome_question` WHERE type='1' ");
  $num_result = mysqli_num_rows($result);
  for ($i=0;$i<$num_result;$i++) {
    $row = mysqli_fetch_row($result);
        ?> 
       <div class="card">
     <div class="card-image waves-effect waves-block waves-light">
     </div>
     <div class="card-content">
       <span class="card-title activator grey-text text-darken-4"><?php echo $row[2] ?><i
       class="mdi-navigation-more-vert right"></i></span>
       <p><a href="#">This is a link</a></p>
     </div>
     <div class="card-reveal">
       <span class="card-title grey-text text-darken-4">返回<i class="mdi-navigation-close right"></i></span>
      <table>
      <tbody>
        <tr>
          <td>姓名</td>
          <td>Eclair</td>
        </tr>
        <tr>
          <td>负责部门</td>
          <td>Jellybean</td>
        </tr>
        <tr>
          <td>部门意见</td>
          <td>Lollipop</td>
        </tr>
        <tr>
          <td>星级评价</td>
          <td>Lollipop</td>
        </tr>
        <tr>
          <td>文字评价</td>
          <td>Lollipop</td>
        </tr>
      </tbody>
    </table>
     </div>
   </div>  
<?php   
        }
?> 
   </div>

       <div id="test2" class="col s12">
<?php
    mysqli_query($con,"set names 'utf8'");
  $result = mysqli_query($con,"SELECT * FROM `iHome_question` WHERE type='2' ");
  $num_result = mysqli_num_rows($result);
  for ($i=0;$i<$num_result;$i++) {
    $row = mysqli_fetch_row($result);
        ?> 
       <div class="card">
     <div class="card-image waves-effect waves-block waves-light">
     </div>
     <div class="card-content">
       <span class="card-title activator grey-text text-darken-4"><?php echo $row[2] ?><i
       class="mdi-navigation-more-vert right"></i></span>
       <p><a href="#">This is a link</a></p>
     </div>
     <div class="card-reveal">
       <span class="card-title grey-text text-darken-4">返回<i class="mdi-navigation-close right"></i></span>
      <table>
      <tbody>
        <tr>
          <td>姓名</td>
          <td>Eclair</td>
        </tr>
        <tr>
          <td>负责部门</td>
          <td>Jellybean</td>
        </tr>
        <tr>
          <td>部门意见</td>
          <td>Lollipop</td>
        </tr>
        <tr>
          <td>星级评价</td>
          <td>Lollipop</td>
        </tr>
        <tr>
          <td>文字评价</td>
          <td>Lollipop</td>
        </tr>
      </tbody>
    </table>
     </div>
   </div> 
<?php   
        }
?>  
   </div>

    </div>
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
  <script src="assets/js/materialize.js"></script>
  <script src="assets/js/index.js"></script>
 </body>
</html>

