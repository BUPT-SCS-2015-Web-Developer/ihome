<?php
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
    $school_id = $_SESSION['school_id'];

    if(array_key_exists('type', $_GET))
        $type = addslashes($_GET['type']);
    elseif (array_key_exists('type', $_POST))
        $type = addslashes($_POST['type']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if($type!='praise' && $type!='follow')
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('id', $_GET))
        $question_id = addslashes($_GET['id']);
    elseif (array_key_exists('id', $_POST))
        $question_id = addslashes($_POST['id']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    $sql_query = "SELECT * FROM `ihome_praise` WHERE `user_id` = '".$school_id."' and `type` = '".$type."' and `question_id` = '".$question_id."'";
    $result = $db->query($sql_query);

    if($result->num_rows == 0)
    {
        $sql_insert = "INSERT INTO `ihome_praise` SET ".
            "`type` = '".$type."', ".
            "`user_id` = '".$school_id."', ".
            "`question_id` = '".$question_id."', ".
            "`status` = '1'";
        $action = $db->query($sql_insert);
        if($action == True)
            exit(json_encode(array('status'=>'success')));
        else {
            exit(json_encode(array('status'=>'error')));
        }
    }
    else {
        $flag = 0;
        foreach ($result as $row => $value) {
            $flag = $value['status'];
        }
        if($flag == '0')
            $flag = '1';
        else {
            $flag = '0';
        }
        $sql_update = "UPDATE `ihome_praise` SET
        `status` = '".$flag."' WHERE
        `user_id` = '".$school_id."' and
        `question_id` = '".$question_id."' and
        `type` = '".$type."'";
        $action = $db->query($sql_update);
        if($action == True)
            exit(json_encode(array('status'=>'success')));
        else {
            exit(json_encode(array('status'=>'error')));
        }
    }
 ?>
