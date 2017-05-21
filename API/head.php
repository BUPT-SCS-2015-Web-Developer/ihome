<?php
session_start();
//include "assets/API/header_api_session.php";
//include "API/login.php";
if(!array_key_exists('school_id', $_SESSION))
    header("Location: http://ihome.buptyiban.org/iapp.php");
if($_SESSION['school_id'] == '')
    header("Location: http://ihome.buptyiban.org/iapp.php");
 ?>
