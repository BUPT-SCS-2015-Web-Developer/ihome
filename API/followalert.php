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

    $sql_follow = "SELECT question_id from `ihome_praise` WHERE
    `user_id` = '".$_SESSION['school_id']."' and
    `type` = 'follow' and
    `status` = '1' and
    `is_read` = '0'";
    $result = $db->query($sql_follow);
    if($result == False)
        exit(json_encode(array('status'=>'error')));
    $followList = array();
    foreach ($result as $key => $value) {
        $followList[] = $value['question_id'];
    }

    $res = array('status' => 'success','data' => array());
    foreach ($followList as $question_id) {
        $sql_query = "SELECT
            `id`,
            `type`,
            `subject`,
            `content`,
            `create_user`,
            `create_time`,
            `hot`,
            `is_reply`,
            `reply`
            from `ihome_question` WHERE `id` = '".$question_id."'";
        $result = $db->query($sql_query);
        if($result == True)
            if($result->num_rows != 0)
            {
                foreach ($result as $key => $value) {
                    $res['data'][] = $value;
                }
            }
    }
    $res['dataNum'] = sizeof($res['data']);
    echo json_encode($res);
 ?>
