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

    if(array_key_exists('id', $_REQUEST))
        $question_id = htmlspecialchars($_REQUEST['id']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    $sql_query = "UPDATE `ihome_question` SET `is_delete` = '1' WHERE `id` = '".$question_id."'";
    $result = $db->query($sql_query);
    if($result == True)
    {
        echo(json_encode(array('status' => 'success')));
    }
    else {
        echo(json_encode(array('status' => 'error')));
    }
 ?>
