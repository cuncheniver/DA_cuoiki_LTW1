<?php 

require_once 'function.php';
session_start();
unset($_SESSION['username']) ;
unset($_SESSION['userId']);
setcookie("username", "", time()-3600);
header('location: login.php');
?>