<!--
index标题缩减 自动补全 防恶意搜索
1、index.php 

-->


<?php 



?>

<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>北邮iHome - 北邮易班</title>
    <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/index.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/materialize_font.css" rel="stylesheet" />
    <!--<link href="assets/css/dropload.css" rel="stylesheet" />-->
    <style>
    </style>
</head>

<body>
    <header>
        <nav class="white" role="navigation">
            <div class="nav-wrapper container hide-on-med-and-down">
                <a href="index.php" class="brand-logo">北邮iHome</a>
                <ul class="right">
                  <!--
              <?php 
              if ($_SESSION['type'] === "admin"){
                echo "<li><a href='admin.php'>后台管理</a></li>";
              } 
              ?> -->
                    
                    <li><a href="my.php">个人中心</a></li>
                </ul>
            </div>
            <div class="nav-wrapper hide-on-large-only">
                <a href="index.php" class="brand-logo">北邮iHome</a>
                <ul class="left">
                    <li><a href="my.php"><img id="user" class="circle" src="assets/img/user.png" /></a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="searchBox container white box">
        <div class="row a1">
        <div class="col s11">
        <div class="input-field">
            <input placeholder="关键词尽量简洁，如宿舍，选课，空调等。 " id="searchBox" type="text" data-length="10">
            <label for="icon_prefix2">输入你想查询的内容</label>
        </div>
        <p>
            <input class="with-gap" name="searchType" type="radio" id="test1" value="" checked/>
            <label for="test1">全部&nbsp;</label>
            <input class="with-gap" name="searchType" type="radio" id="test2" value="1" />
            <label for="test2">生活服务&nbsp;</label>
            <input class="with-gap" name="searchType" type="radio" id="test3" value="2"  />
            <label for="test3">问题反馈&nbsp;</label>
        </p>
        </div>
        <div class="col s1 center">
        <a id="searchImage" class="btn-floating btn-large waves-effect waves-light blue-grey darken-2 pulse"><i class="material-icons">search</i></a>
         </div>
        </div>
    </div>
    
    <div class="quesBox container box white">
        <div id="quesHeader">
            <div id="typeBox">
                <p><a class="type active" id="typeAll" href="#" data-val="">全部问题</a><a class="type" id="typeAll" href="#" data-val="1">生活服务</a><a class="type" id="typeAll" href="#" data-val="2">问题反馈</a></p>
                <div id="sortBox">
                    <a href="#" class="active sortRecommended sort" data-val="recommended"><i class="material-icons dp48">thumb_up</i></a>
                    <a href="#" class="sortTime sort" data-val="time"><i class="material-icons dp48">query_builder</i></a>
                    <a href="#" class="sortHot sort" data-val="hot"><i class="material-icons dp48">star</i></a>
                </div>
            </div>
        </div>
        <div id="mainQuesBox"></div>
        <div id="moreBox">
            <p id="moreText">下拉加载更多...</p>
        </div>
    
    </div>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="assets/js/materialize.js"></script>
    <script src="assets/js/timeago.min.js"></script>
    <!--
    <script src="assets/js/dropload.min.js"></script>
    -->
    <script src="assets/js/index.js"></script>
</body>

</html>