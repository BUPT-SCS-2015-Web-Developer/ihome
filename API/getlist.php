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

    if(array_key_exists('search', $_REQUEST))
        $search = htmlspecialchars($_REQUEST['search']);
    else
        $search = '';

    if(array_key_exists('type', $_REQUEST))
        $type = htmlspecialchars($_REQUEST['type']);
    else
        $type = '';

    $res = array('status' => 'success','data' => array());

    if(array_key_exists('sortby', $_REQUEST))
        $sortby = htmlspecialchars($_REQUEST['sortby']);
    else
        $sortby = 'hot';
    if($sortby == 'time')
        $sortby = 'create_time';
    if($sortby == 'recommended')
    {
        $list = array();
        $sql_query = "SELECT * FROM `ihome_recommend` WHERE `status` = '1'";
        $result = $db->query($sql_query);
        if($result == True)
        foreach ($result as $key => $value) {
            $list[] = $value['question_id'];
        }

        foreach ($list as $key => $question) {
            $sql_query = "SELECT * FROM `ihome_question` WHERE `id` = '".$question."' and `is_verify` = '1'";
            $result = $db->query($sql_query);
            if($result == True)
            {
                foreach($result as $key => $value)
                {
                    if($value['is_anonymous']=='1')
                    {
                        $value['create_user'] = '0';
                        $value['create_user_name'] = '匿名用户';
                    }
                    $res['data'][] = $value;
                }
            }
        }
        foreach($res['data'] as $val => $k){
            if(strlen($res['data'][$val]['content']) > 15){
                $res['data'][$val]['content'] = mb_substr($res['data'][$val]['content'], 0, 10, 'utf-8');
                $res['data'][$val]['content'] = $res['data'][$val]['content']."...";
            }
        }
        exit(json_encode($res));
    }

    if(array_key_exists('start', $_REQUEST))
        $start = htmlspecialchars($_REQUEST['start']);
    else
        $start = '0';

    $sql_query = "SELECT
        `id`,
        `type`,
        `subject`,
        `content`,
        `create_user`,
        `create_time`,
        `hot`
        from `ihome_question` ";
    $sql_where = "WHERE
        (`subject` LIKE '%".$search."%' or
        `content` LIKE '%".$search."%' or
        `create_user` LIKE '%".$search."%') ";
    $sql_where_and = "`type` = '".$type."' ";
    $sql_order = "order by `".$sortby."` desc ";

    $sql_limit = "LIMIT ".$start.", "."10";

    if($search == "" && $type == "")
        $sql_total = $sql_query.$sql_order.$sql_limit;
    elseif($search != "" && $type == "")
        $sql_total = $sql_query.$sql_where.$sql_order.$sql_limit;
    elseif ($search == "" && $type != "")
        $sql_total = $sql_query." WHERE ".$sql_where_and.$sql_order.$sql_limit;
    else
        $sql_total = $sql_query.$sql_where." and ".$sql_where_and.$sql_order.$sql_limit;

    $result = $db->query($sql_total);

    if($result->num_rows == 0)
        exit(json_encode(array('status'=>'success', 'data' => array())));
    foreach ($result as $row => $value) {
        $sql_comment = "SELECT * FROM `ihome_comment` WHERE `question_id` = '".$value['id']."'";
        $result_comment = $db->query($sql_comment);
        $value['commentNum'] = $result_comment->num_rows;

        $sql_praise = "SELECT * FROM `ihome_praise` WHERE `question_id` = '".$value['id']."'";
        $result_praise = $db->query($sql_praise);
        $value['praiseNum'] = $result_praise->num_rows;

        $res['data'][] = $value;
    }

    foreach($res['data'] as $val => $k){
        if(strlen($res['data'][$val]['content']) > 50){
            $res['data'][$val]['content'] = mb_substr($res['data'][$val]['content'], 0, 50, 'utf-8');
            $res['data'][$val]['content'] = $res['data'][$val]['content']."...";
        }
    }
    echo json_encode($res);
 ?>
