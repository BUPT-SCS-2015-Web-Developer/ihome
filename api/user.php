<?php
    session_start();
    if(!array_key_exists('school_id', $_SESSION))
        exit(json_encode(array('status'=>'login first')));

    //这里验证身份
    //include "iapp.php";
    include "db_config.php";
    $db = new mysqli($db_host,$db_user,$db_password,$db_database);
    if (!$db)
    {
      exit(json_encode(array('status'=>'error')));
    }
    $db->query("set names 'utf8'");

    if($_SESSION['type'] == 'ordinary')
        $id = $_SESSION['school_id'];
    elseif ($_SESSION['type'] == 'admin') {
        if(array_key_exists('id', $_GET))
            $id = addslashes($_GET['id']);
        elseif (array_key_exists('id', $_POST))
            $id = addslashes($_POST['id']);
        else
        {
            $id = $_SESSION['school_id'];
        }
    }
    $sql_query = "SELECT * FROM `ihome_user` WHERE `school_id` = '".$id."'";
    $result = $db->query($sql_query);
    $res = array('status' => 'success','data' => '');
    if($result->num_rows == 0){
        exit(json_encode(array('status'=>'failed')));
    }
    foreach ($result as $row => $value) {
        $res['data'] = $value;
    }
    $result->close();
    echo json_encode($res);
 ?>
