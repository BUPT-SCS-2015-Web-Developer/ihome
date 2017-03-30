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
    $school_id = $_SESSION['school_id'];

    if(array_key_exists('id', $_REQUEST))
    {
        $question_id = htmlspecialchars($_REQUEST['id']);
        $sql_query = "UPDATE `ihome_praise` SET `is_read` = 1 WHERE `user_id` = '".$school_id."' and `question_id` = '".$question_id."'";
        $result = $db->query($sql_query);

        if($result == True)
            exit(json_encode(array('status'=>'success')));
        else {
            exit(json_encode(array('status'=>'error')));
            }
    }
    else
    {
        $sql_query = "UPDATE `ihome_praise` SET `is_read` = 1 WHERE `user_id` = '".$school_id."'";
        $result = $db->query($sql_query);

        if($result == True)
            exit(json_encode(array('status'=>'success')));
        else {
            exit(json_encode(array('status'=>'error')));
            }
    }
 ?>
