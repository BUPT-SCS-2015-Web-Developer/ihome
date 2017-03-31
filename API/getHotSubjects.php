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

    $res = array('status' => 'success','data' => array());

    $sql_query = "SELECT
        `subject`
        from `ihome_question` ";
    $sql_order = "order by `hot` desc ";

    $sql_limit = "LIMIT 20";


    $sql_total = $sql_query.$sql_order.$sql_limit;
    $result = $db->query($sql_total);

    if($result->num_rows == 0)
        exit(json_encode(array('status'=>'none')));
    foreach ($result as $row => $value) {
        $res['data'][] = $value;
    }
    echo json_encode($res);
 ?>
