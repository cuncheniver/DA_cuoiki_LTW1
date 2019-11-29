<?php 

$host = "localhost";
$username = "root";
$password = "";
$dbName = "social";
$db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $username, $password);
$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connect = mysqli_connect($host,$username,'',$dbName);
mysqli_set_charset($connect, 'UTF8');
$context =mysqli_real_escape_string($connect,$_POST['context']);
 
?>
<h1><?php echo $context ?><h1>
<?php
?>