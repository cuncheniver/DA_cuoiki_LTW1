<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$host = "localhost";
$username = "root";
$password = "";
$dbName = "social";
$connect = mysqli_connect($host,$username,'',$dbName);
if (isset($_POST["register"])) 
{
    $ten=mysqli_real_escape_string($connect,$_POST['name']);
    $_SESSION['ten']=$ten;
    $name=mysqli_real_escape_string($connect,$_POST['mail']);
    $_SESSION['mail']=$name;
    $pass=mysqli_real_escape_string($connect,$_POST['pass']);
    $_SESSION['pass']=$pass;
    
    
    if (  $pass == "" || $name == "" || $ten="") {
        echo "bạn vui lòng nhập đầy đủ thông tin";
    }
    else 
    {
        
          $sq="select * from login where mail='$name'";
            $kt=mysqli_query($connect, $sq);
    
            if(mysqli_num_rows($kt)  > 0){
                echo "Tài khoản đã tồn tại, vui lòng dùng tài khoản khác";
            }else{
        $success = false;
if (isset($name)) {
    $email = $name;
    
    if($email)
    {
        $secret =generateRandomString();
        sendEmail($email,'Kick hoat tai khoan','click <a href="http://localhost:8080/dd.php
        "> vao day</a>');
       
      
    }
    else
    {
        echo "email khong ton tai";
    }

    header('location: thongbao.php');
}

    
    
}
}
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


$mail->send();
return true;
} catch (Exception $e) {
return false;
}
}
?>