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

    if(array_key_exists('attitude', $_REQUEST))
        $attitude = htmlspecialchars($_REQUEST['attitude']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('result', $_REQUEST))
        $result = htmlspecialchars($_REQUEST['result']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('efficiency', $_REQUEST))
        $efficiency = htmlspecialchars($_REQUEST['efficiency']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('all_in_all', $_REQUEST))
        $all_in_all = htmlspecialchars($_REQUEST['all_in_all']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('description', $_REQUEST))
        $description = htmlspecialchars($_REQUEST['description']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    $sql_query = "UPDATE `ihome_question` SET
    `attitude` = '".$attitude."',
    `result` = '".$result."',
    `efficiency` = '".$efficiency."',
    `all_in_all` = '".$all_in_all."',
    `description` = '".$description."'
     WHERE `id` = '".$question_id."'";
    $sql_result = $db->query($sql_query);
    if($sql_result == True)
    {
        echo(json_encode(array('status' => 'success')));
    }
    else {
        echo(json_encode(array('status' => 'error')));
    }
 ?>
