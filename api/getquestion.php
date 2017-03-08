<?php
    session_start();
    if(!array_key_exists('school_id', $_SESSION))
        exit(json_encode(array('status'=>'login first')));
    //include "iapp.php";
    include "db_config.php";
    $db = new mysqli($db_host,$db_user,$db_password,$db_database);
    if (!$db)
    {
      exit(json_encode(array('status'=>'error')));
    }
    $db->query("set names 'utf8'");

    if(array_key_exists('id', $_GET))
        $id = addslashes($_GET['id']);
    elseif (array_key_exists('id', $_POST))
        $id = addslashes($_POST['id']);
    else
        exit();

    $sql_query = "SELECT * FROM `ihome_question` WHERE  `id` = '".$id."'";
    $result = $db->query($sql_query);
    if($result->num_rows == 0){
        exit(json_encode(array('status'=>'failed')));
    }
    $res = array('status' => 'success','data' => array('is_praise'=>'','is_follow'=>'','comment' => array()));
    foreach ($result as $row => $value) {
        $res['data'] += $value;
    }

    $sql_query = "SELECT `user_id`, `content`, `floor`, `reply_floor`, `create_time` FROM `ihome_comment` WHERE  `question_id` = '".$id."' and `status` = '1' ORDER BY `floor`";
    $result = $db->query($sql_query);
    $i=0;
    foreach ($result as $row => $value) {
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

    echo json_encode($res);
?>
