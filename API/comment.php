<?php
    header('Content-type:text/json');
    session_start();
    if(!array_key_exists('school_id', $_SESSION))
        exit(json_encode(array('status'=>'login first')));
    $user_id = $_SESSION['school_id'];
    //这里验证身份
    //include "iapp.php";
    include "db_config.php";
    $db = new mysqli($db_host,$db_user,$db_password,$db_database);
    if (!$db)
    {
      exit(json_encode(array('status'=>'error')));
    }
    $db->query("set names 'utf8'");

    if(array_key_exists('id', $_GET))
        $question_id = addslashes($_GET['id']);
    elseif (array_key_exists('id', $_POST))
        $question_id = addslashes($_POST['id']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('content', $_GET))
        $content = addslashes($_GET['content']);
    elseif (array_key_exists('content', $_POST))
        $content = addslashes($_POST['content']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('reply_floor', $_GET))
        $reply_floor = addslashes($_GET['reply_floor']);
    elseif (array_key_exists('reply_floor', $_POST))
        $reply_floor = addslashes($_POST['reply_floor']);
    else
        $reply_floor = 0;

    $sql_query = "SELECT * FROM `ihome_comment` WHERE `question_id` = '".$question_id."'";
    $result = $db->query($sql_query);
    $floor = 0;

    foreach ($result as $row) {
        if($floor < $row['floor'])
            $floor = $row['floor'];
    }
    $floor = $floor + 1;
    $result->close();

    $sql_query = "INSERT INTO `ihome_comment` SET ".
        "`question_id` = '".$question_id."', ".
        "`user_id` = '".$user_id."', ".
        "`content` = '".$content."', ".
        "`create_time` = now(), ".
        "`floor` = '".$floor."', ".
        "`reply_floor` = '".$reply_floor."', ".
        "`status` = '1'";
    $result = $db->query($sql_query);

    $sql_update = "UPDATE `ihome_praise` SET
        `is_read` = '0' WHERE `question_id` = '".$question_id."'";
    $action = $db->query($sql_update);

    if($result == True)
    {
        echo(json_encode(array('status' => 'success')));
    }
    else {
        echo(json_encode(array('status' => 'error')));
    }
 ?>
