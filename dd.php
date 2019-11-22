<?php
session_start();
require_once 'function.php';

$mail=$_SESSION['mail'];

$pass=$_SESSION['pass'];
$name=$_SESSION['ten'];
$password = md5($pass);
       
$result = $db->exec("INSERT INTO login (user_name,password,email) VALUES('$name','$password','$mail')");
$_SESSION['ok'] = $name;
header('location: login.php');
?>