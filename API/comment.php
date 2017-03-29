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

    if(array_key_exists('id', $_REQUEST))
        $question_id = htmlspecialchars($_REQUEST['id']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('content', $_REQUEST))
        $content = htmlspecialchars($_REQUEST['content']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('reply_floor', $_REQUEST))
        $reply_floor = htmlspecialchars($_REQUEST['reply_floor']);
    else
        $reply_floor = 0;

    if(array_key_exists('is_anonymous', $_REQUEST))
        $is_anonymous = htmlspecialchars($_REQUEST['is_anonymous']);
    else
        $is_anonymous = 0;

    $sql_query = "SELECT * FROM `ihome_comment` WHERE `question_id` = '".$question_id."'";
    $result = $db->query($sql_query);
    $floor = 0;

    if($result == True)
    {
        {
            foreach ($result as $row) {
                if($floor < $row['floor'])
                    $floor = $row['floor'];
            }
        }
        $result->close();
    }
    $floor = $floor + 1;

    $sql_query = "INSERT INTO `ihome_comment` SET ".
        "`question_id` = '".$question_id."', ".
        "`user_id` = '".$user_id."', ".
        "`user_name` = '".$_SESSION['name']."', ".
        "`content` = '".$content."', ".
        "`is_anonymous` = '".$is_anonymous."', ".
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
