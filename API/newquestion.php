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

    if(!array_key_exists('school_id', $_SESSION))
        exit(json_encode(array('status'=>'login first')));

    if(array_key_exists('type', $_REQUEST))
        $type = htmlspecialchars($_REQUEST['type']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('subject', $_REQUEST))
        $subject = htmlspecialchars($_REQUEST['subject']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('content', $_REQUEST))
        $content = htmlspecialchars($_REQUEST['content']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('is_anonymous', $_REQUEST))
        $is_anonymous = htmlspecialchars($_REQUEST['is_anonymous']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    $sql_query = "INSERT INTO `ihome_question` SET ".
        "`type` = '".$type."', ".
        "`subject` = '".$subject."', ".
        "`content` = '".$content."', ".
        "`create_time` = now(), ".
        "`create_user` = '".$_SESSION['school_id']."', ".
        "`create_user_name` = '".$_SESSION['name']."', ".
        "`hot` = '0', ".
        "`is_verify` = '0', ".
        "`is_reply` = '0', ".
        "`is_anonymous` = '".$is_anonymous."'";
    $result = $db->query($sql_query);
    $sql_query = "SELECT * FROM `ihome_question` WHERE
    `type` = '".$type."' and
    `subject` = '".$subject."' and
    `content` = '".$content."'";
    $result = $db->query($sql_query);
    foreach ($result as $row => $value) {
        $id = $value['id'];
    }
    if($result == True)
    {
        echo(json_encode(array('status' => 'success', 'data'=>array('id' => $id))));
    }
    else {
        echo(json_encode(array('status' => 'error')));
    }
 ?>
