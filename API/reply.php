<?php
    header('Content-type:text/json');
    session_start();
    include "db_config.php";
    $db = new mysqli($db_host,$db_user,$db_password,$db_database);
    if (!$db)
    {
      exit(json_encode(array('status'=>'error')));
    }
    $db->query("set names 'utf8'");
    $flag = True;

    if(!array_key_exists('school_id', $_SESSION))
        exit(json_encode(array('status'=>'login first')));
    $school_id = $_SESSION['school_id'];

    if(array_key_exists('id', $_REQUEST))
        $question_id = htmlspecialchars($_REQUEST['id']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('reply', $_REQUEST))
        $reply = htmlspecialchars($_REQUEST['reply']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    $sql_query = "SELECT * FROM `ihome_question` WHERE `id` = '".$question_id."'";
    $result = $db->query($sql_query);
    if($result == False)
        exit(json_encode(array('status'=>'error')));

    foreach ($result as $key => $value) {
        if(!($value['processor']==$_SESSION['type']||$_SESSION['type']=='admin'))
            exit(json_encode(array('status'=>'error')));
    }

    $sql_update = "UPDATE `ihome_question` SET
        `is_reply` = '1', `reply` = '".$reply."', `reply_id` = '".$_SESSION['school_id']."' WHERE
        `id` = '".$question_id."'";
    $action = $db->query($sql_update);
    if($action == False)
        $flag = False;

    $sql_update = "UPDATE `ihome_praise` SET
        `is_read` = '0' WHERE `question_id` = '".$question_id."'";
    $action = $db->query($sql_update);
    if($action == False)
        $flag = False;

    if($flag != False)
        exit(json_encode(array('status'=>'success')));
    else {
        exit(json_encode(array('status'=>'error')));
    }
 ?>
