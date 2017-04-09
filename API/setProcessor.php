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
    $flag = True;

    if(!array_key_exists('school_id', $_SESSION))
        exit(json_encode(array('status'=>'login first')));
    $school_id = $_SESSION['school_id'];

    if(array_key_exists('id', $_REQUEST))
        $question_id = htmlspecialchars($_REQUEST['id']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    if(array_key_exists('processor', $_GET))
        $processor = htmlspecialchars($_GET['processor']);
    elseif (array_key_exists('processor', $_POST))
        $processor = htmlspecialchars($_POST['processor']);
    else
        exit(json_encode(array('status'=>'parameter error')));

    $group = array('管委会','学生事务部','教务部','安全保卫部','后勤保障部','宣传部','医务室','图书馆');
    if(!in_array($processor, $group))
        exit(json_encode(array('status'=>'parameter error')));

    $sql_query = "UPDATE `ihome_question` SET `processor` = '".$processor."',`progress` = '审核通过，相关部门处理中' WHERE `id` = '".$question_id."'";
    $result = $db->query($sql_query);
    if($result == False)
        exit(json_encode(array('status'=>'error')));
    else {
        exit(json_encode(array('status'=>'success')));
    }
 ?>
