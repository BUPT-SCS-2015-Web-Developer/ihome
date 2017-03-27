<?php 



?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>新问题 - 北邮iHome</title>
    <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/new.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/materialize_font.css" rel="stylesheet" />
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

    <div class="formBox container white box">
        <p>请选择问题类型:</p>
        <p>
            <input class="with-gap" name="quesType" type="radio" id="test2" value="1" checked/>
            <label for="test2">生活服务&nbsp;</label>
            <input class="with-gap" name="quesType" type="radio" id="test3" value="2"  />
            <label for="test3">问题反馈&nbsp;</label>
        </p>
        <div class="tips">
            <p>生活服务类问题是开放的问题，其他同学可以查看和回复;</p>
            <p>问题反馈类问题将提交给管委会，并由管委会指派给相关组织处理，你将收到问题处理的进度通知。</p>
        </div>
        <br>
        <hr>
        <br>
        <div class="input-field">
            <input placeholder="标题请尽量包含问题的主要信息 " id="quesSubject" type="text" data-length="30" length="30" maxlength="30">
            <label for="icon_prefix2">问题标题*</label>
        </div>
        <div class="input-field">
            <textarea placeholder="请输入问题详情" id="quesContent" class="materialize-textarea" data-length="500" length="500" maxlength="500"></textarea>
            <label for="textarea1">问题详情</label>
        </div>
        <p>
            <input type="checkbox" class="filled-in" id="quesAnonymous" checked="checked" />
            <label for="quesAnonymous">匿名</label>
        </p>
        <p class="showBox">
            <input type="checkbox" class="filled-in" id="quesPublic"/>
            <label for="quesPublic">公开</label>
        </p>
        <div class="tips showBox">
            <p>若公开，其他同学能够在主页搜索到您的反馈，否则只有管理员和管委会可以查看。</p>
        </div>
        <button class="btn waves-effect waves-light blue-grey darken-2" id="submitBtn">提交
            <i class="material-icons right">send</i>
        </button>
        <div id="moreBox">
            <p>问题提交成功！你可以<a href="index.php">返回主页</a>或<a id="morelink" href="#">查看该问题详情</a></p>
        </div>
    </div>
    
  
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="assets/js/materialize.js"></script>
    <script src="assets/js/new.js"></script>
</body>

</html>