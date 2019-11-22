<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$host = "localhost";
$username = "root";
$password = "";
$dbName = "social";
$db = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
$connect = mysqli_connect($host,$username,'',$dbName);
if (isset($_POST["register"])) 
{
    $name=mysqli_real_escape_string($connect,$_POST['username']);
    $_SESSION['ten']=$name;
    $mail=mysqli_real_escape_string($connect,$_POST['email']);
    $_SESSION['mail']=$mail;
    $pass=mysqli_real_escape_string($connect,$_POST['password']);
    $_SESSION['pass']=$pass;

  
    if (  $pass == "" || $mail == "" || $name="") {
        echo "bạn vui lòng nhập đầy đủ thông tin";
    }
    else 
    {
      $name= $_SESSION['ten'];
          $sq="select * from login where email='$mail' or user_name='$name'";
            $kt=mysqli_query($connect, $sq);
            
            if(mysqli_num_rows($kt)  > 0){
                $_SESSION['fail'] = true;
               echo "k";
               header('location: login.php');
            }else{
                $_SESSION['used']=$mail;
               
                
       
if (isset($mail)) {
    $email = $mail;
  
    if($email)
    {
        
        $secret =generateRandomString();
        sendEmail($email,'Kick hoat tai khoan','click <a href="http://localhost:8080/DA_cuoiki_LTW1/dd.php"> vao day</a>');
        header('location: login.php');
       
      
    }
    else
    {
        echo "email khong ton tai";
    }
 
  
}


    
}
}
}
function createUser($name,$pass)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO login (name,pass) VALUES(?,?)");
    $stmt -> execute(array($name,$pass));
    
    return $db->lastInsertId();
}

if (isset($_POST["login"])) 
{
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $username = strip_tags($username);
    $username = addslashes($username);
    $pass = strip_tags($pass);
    $pass = addslashes($pass);
    $password = md5($pass);
    $sql = "select * from login where user_name = '$username' and password = '$password' ";
    $query = mysqli_query($connect,$sql);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows==0) {
        $_SESSION['loginfail']=1 ;
        header('Location: login.php');
    }else{
       
    $sql = "select id from login where user_name = '$username'";
    $result = mysqli_query($connect, $sql);


if ($result) {
   
    while ($row=mysqli_fetch_row($result)) {
        $userId= $row[0];
    }

 
    mysqli_free_result($result);
    $_SESSION['userId']=$userId ;
   
    }
    $_SESSION['username'] = $username;
 
  
 
    setcookie('$username','$password');
      header('Location: homeuser.php');
}
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendEmail($email,$subject,$content)
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
//Server settings
$mail->SMTPDebug = 2;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'nguyentranphu1233@gmail.com';                 // SMTP username
$mail->Password = 'FUdmtlnlacccpCK3';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

//Recipients
$mail->setFrom('nguyentranphu1233@gmail.com', 'phune');
$mail->addAddress($email);     // Add a recipient


//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $content;

$_SESSION['used'] = $email  ;
$mail->send();
return true;
} catch (Exception $e) {
return false;
}
}
?>