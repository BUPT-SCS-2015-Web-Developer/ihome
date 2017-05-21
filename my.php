<?php
include_once "API/head.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>个人主页 - 爱沙河 - 北邮易班</title>
  <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" > -->
  <link href="assets/css/admin_and_me.css" type="text/css" rel="stylesheet"/>
  <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="assets/css/materialize_font.css" rel="stylesheet"/>
  <!--<link href=".css" type="text/css" rel="stylesheet" />-->
</head>
<body>
<?php include("header.php"); ?>
<main>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <div class="card white">
          <table class="centered">
            <tbody>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td><a class="waves-effect waves-light btn-large blue-grey lighten-2" href="mymessage.php">系统通知</a></td>
              <td><a class="waves-effect waves-light btn-large blue-grey lighten-3" href="myquestion.php">我的提问</a></td>
            </tr>
            <tr>
              <td><a class="waves-effect waves-light btn-large blue-grey lighten-4" href="mycomplain.php">我的反馈</a></td>
              <td><a class="waves-effect waves-light btn-large blue-grey lighten-5" href="myattention.php">我的关注</a></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>

<!--  Scripts-->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/materialize.min.js"></script>

</body>
</html>
