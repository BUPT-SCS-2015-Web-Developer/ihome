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
        $type = 'solved';
    if($type=='solved')
        $type = '1';
    else {
        $type = '0';
    }

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
        from `ihome_question` WHERE `create_user` = '".$_SESSION['school_id']."' and `is_reply` = '".$type."'";
    $result = $db->query($sql_query);
    $res = array('status' => 'success','data' => array());
    if($result == True){
         if($result->num_rows != 0)
         {
            foreach ($result as $key => $value) {
                $res['data'][] = $value;
            }
        }
    }
    else
        exit(json_encode(array('status'=>'failed')));
    echo json_encode($res);
 ?>
