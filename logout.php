<?php
session_start();
include_once("class/Login.php");

$login = new Login;
$login->lastlog($_SESSION["id"]);



session_destroy();

header("location: index.php");

?>