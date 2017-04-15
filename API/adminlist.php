<?php
//此页面不同类别管理员访问，可以访问到自己部门下的问题
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

    $type = $_SESSION['type'];
    if($type == 'admin')
        $sql_query = "SELECT * FROM `ihome_question` WHERE `type` = '2'";
    else
        $sql_query = "SELECT * FROM `ihome_question` WHERE `type` = '2' and `processor` = '".$type."'";

    $result = $db->query($sql_query);
    $res = array('status' => 'success','data' => array());

    if($result == True)
        if($result->num_rows != 0)
        {
            foreach ($result as $row => $value) {
                $res['data'][] = $value;
            }

            foreach($res['data'] as $val => $k){
                if(strlen($res['data'][$val]['content']) > 15){
                    $res['data'][$val]['content'] = mb_substr($res['data'][$val]['content'], 0, 10, 'utf-8');
                    $res['data'][$val]['content'] = $res['data'][$val]['content']."...";
                }
            }
        }
    echo json_encode($res);
 ?>
