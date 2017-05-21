<?php
include_once "API/head.php";
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>爱沙河 - 北邮易班</title>
  <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet"/>
  <link href="assets/css/index.css" type="text/css" rel="stylesheet"/>
  <link href="assets/css/materialize_font.css" rel="stylesheet"/>
  <!--<link href="assets/css/dropload.css" rel="stylesheet" />-->
  <style>
  </style>
</head>

<body>
<?php include "header.php"; ?>


<div class="searchBox container white box">
  <div class="row a1">
    <div class="col l11 m10 s9">
      <div class="col s12 input-field">
        <input placeholder="关键词尽量简洁" id="searchBox" type="text" data-length="10">
        <label for="searchBox">输入你想查询的内容</label>
      </div>
      <div class="col s12">
        <p>
          <input class="with-gap" name="searchType" type="radio" id="test1" value="" checked/>
          <label for="test1">全部</label>
          <input class="with-gap" name="searchType" type="radio" id="test2" value="1"/>
          <label for="test2">生活服务</label>
          <input class="with-gap" name="searchType" type="radio" id="test3" value="2"/>
          <label for="test3">问题反馈</label>
        </p>
      </div>
    </div>
    <div class="col l1 m2 s3 center">
      <a id="searchImage" class="btn-floating btn-large waves-effect waves-light blue-grey darken-2 pulse">
        <i class="material-icons">search</i></a>
    </div>
  </div>
</div>

<div class="quesBox container box white">
  <div id="quesHeader">
    <div id="typeBox">
      <p><a class="type active" id="typeAll" href="#" data-val="">全部问题</a>
        <a class="type" id="typeAll" href="#" data-val="1">生活服务</a>
        <a class="type" id="typeAll" href="#" data-val="2">问题反馈</a>
      </p>
      <div class="sortBox hide-on-small-only">
        <a href="#" class="active sortRecommended sort" data-val="recommended">
          <i class="material-icons dp48">thumb_up</i></a>
        <a href="#" class="sortTime sort" data-val="time"><i class="material-icons dp48">query_builder</i></a>
        <a href="#" class="sortHot sort" data-val="hot"><i class="material-icons dp48">star</i></a>
      </div>
      <div class="sortBox hide-on-med-and-up sortBox2">
        <a href="#" class="active sortRecommended sort" data-val="recommended"><i
              class="material-icons dp48">thumb_up</i></a>
        <a href="#" class="sortTime sort" data-val="time"><i class="material-icons dp48">query_builder</i></a>
        <a href="#" class="sortHot sort" data-val="hot"><i class="material-icons dp48">star</i></a>
      </div>
      <p class="hide-on-large-only"><br></p>
    </div>
  </div>
  <div id="mainQuesBox"></div>
  <div id="moreBox">
    <p id="moreText">下拉加载更多...</p>
  </div>

</div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/materialize.js"></script>
<script src="assets/js/timeago.min.js"></script>
<!--
<script src="assets/js/dropload.min.js"></script>
-->
<script>
    window.hotSubject = {};
    <?php


    ?>
</script>
<script src="assets/js/index.js"></script>
</body>

</html>
