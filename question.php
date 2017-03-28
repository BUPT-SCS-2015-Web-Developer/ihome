<?php 

    session_start();
    if(!array_key_exists('school_id', $_SESSION))
        echo "<script>alert('请先登录!');window.close();</script>";

    include "API/db_config.php";
    $db = new mysqli($db_host,$db_user,$db_password,$db_database);
    if (!$db) exit("加载问题详情时遇到数据库错误.");
    
    $db->query("set names 'utf8'");

    if(array_key_exists('id', $_REQUEST))
        $id = htmlspecialchars($_REQUEST['id']);
    else
        exit("没有收到数据!");

    $sql_query = "SELECT * FROM `ihome_question` WHERE  `id` = '".$id."'";
    $result = $db->query($sql_query);
    if($result->num_rows == 0){
        exit("该问题可能已经被删除!");
    }
    $res = array('status' => 'success','data' => array('is_praise'=>'','is_follow'=>'','comment' => array()));
    foreach ($result as $row => $value) {
        $res['data'] += $value;
        if($res['data']['is_anonymous']=='1')
        {
            $res['data']['create_user'] = '0';
            $res['data']['create_user_name'] = '匿名用户';
        }
    }

    $sql_query = "SELECT `user_id`, `user_name`, `content`, `is_anonymous`, `floor`, `reply_floor`, `create_time` FROM `ihome_comment` WHERE  `question_id` = '".$id."' and `status` = '1' ORDER BY `floor`";

    $result = $db->query($sql_query);
    if($result->num_rows != 0) 
    foreach ($result as $row => $value) {
        if($value['is_anonymous']==1)
        {
            $value['user_id'] = '0';
            $value['user_name'] = '匿名用户';
        }
        $res['data']['comment'][] = $value;
    }   
        $result->close(); 
    
    


    $sql_query = "SELECT * FROM `ihome_praise`
    WHERE `question_id` = '".$id."' and
    `user_id` = '".$_SESSION['school_id']."' and
    `type` = 'praise' and
    `status` = '1'";
    $result = $db->query($sql_query);
    if($result->num_rows != 0)
        $res['data']['is_praise'] = '1';
    else {
        $res['data']['is_praise'] = '0';
    }

    $sql_query = "SELECT * FROM `ihome_praise`
    WHERE `question_id` = '".$id."' and
    `user_id` = '".$_SESSION['school_id']."' and
    `type` = 'follow' and
    `status` = '1'";
    $result = $db->query($sql_query);
    if($result->num_rows != 0)
        $res['data']['is_follow'] = '1';
    else {
        $res['data']['is_follow'] = '0';
    }

    echo "<script>window.id = ".$id."</script>";
    $type = $res['data']['type']==1 ? "生活服务" : "问题反馈";
    $praiseToggle = $res['data']['is_praise'] == 1 ? "已" : "";
    $followToggle = $res['data']['is_follow'] == 1 ? "已" : "";
?>


<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title><?php echo $res['data']['subject'];?> - <?php echo $type; ?> 北邮易班</title>
    <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/ques.css" type="text/css" rel="stylesheet" />
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

    <div class="quesBox container white box">
        <h4><?php echo $res['data']['subject'];?></h4>
        <p id="infoBox"><span id="quesUser"><?php echo $type; ?>&nbsp;&nbsp;<?php echo $res['data']['create_user_name'];?></span>&nbsp;&nbsp;于&nbsp;&nbsp;<span id="quesTime"><?php echo $res['data']['create_time'];?></span></p>
        <hr>
        <pre><?php echo $res['data']['content'];?></pre>
        <button class="btn waves-effect waves-light left" id="praiseBtn"><span class="btnToggle"><?php echo $praiseToggle;?></span>赞&nbsp;<span id="praiseNum"><?php echo $res['data']['hot']; ?></span>
            <i class="material-icons right">thumb_up</i>
        </button>
        &nbsp;
        <button class="btn waves-effect waves-light blue-dar" id="followBtn"><span class="btnToggle"><?php echo $followToggle;?></span>关注
            <i class="material-icons right">visibility</i>
        </button>
    </div>
    
    <div class="newBox container white box">
        <div class="input-field">
            <textarea id="comment" class="materialize-textarea" data-length="500" length="500" maxlength="500"></textarea>
            <label for="comment">请输入评论</label>
        </div>
        
        <button class="btn waves-effect waves-light left" id="submitBtn">提交
            <i class="material-icons right">send</i>
        </button>
        <p id="anonymousBox">
            <input type="checkbox" class="filled-in" id="anonymous" checked="checked" />
            <label class="tooltipped"  data-position="bottom" data-delay="50" data-tooltip="若不匿名，评论处将显示您的易班昵称" for="anonymous">匿名</label>
        </p>
    </div>
    
    <div class="commentBox container white box">
        <h5>评论列表</h5>
        <hr>
    <?php 
    if (is_array($res['data']['comment']) && count($res['data']['comment'])>0)
        foreach($res['data']['comment'] as $row => $value) {
            ?>
        <div class="comment" data-floor="<?php echo $value['floor']; ?>">
            <span class="commentName"><?php echo $value['user_name']; ?></span>
            <span class="commentFloor right"><?php echo $value['floor']; ?>L <a href="#" class="commentResponse">回复</a></span>
            <p><?php echo $value['content']; ?></p>
        </div>    
        <?php } else { ?>
        <p>暂无评论!</p>
        <?php } ?>
    </div>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="assets/js/materialize.js"></script>
    <script src="assets/js/timeago.min.js"></script>
    
    <script src="assets/js/ques.js"></script>
    <script>
        qSettings.id = <?php echo $id; ?>;
        qSettings.is_praise = <?php echo $res['data']['is_praise']; ?>;
        qSettings.is_follow = <?php echo $res['data']['is_follow']; ?>;
    </script>
</body>

</html>