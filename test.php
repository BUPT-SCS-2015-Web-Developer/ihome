<?php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
include_once "API/head.php";
//session_start();

echo $_SESSION['name'];
echo $_SESSION['school_id'];
?>
