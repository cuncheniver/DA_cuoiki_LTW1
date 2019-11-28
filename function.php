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
$db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $username, $password);
$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connect = mysqli_connect($host,$username,'',$dbName);
mysqli_set_charset($connect, 'UTF8');
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
      header('Location: home.php');
}
}
if (isset($_POST["Save"])) {

    $user_id = $_SESSION['userId'];
  
    $ten = $_POST["name"];
   
    
    $sdt = $_POST["phone"];
    $tenanh=$_FILES['image']['name'];
    $fileExt = explode('.',$tenanh);
    $fileActualExt = strtolower(end($fileExt));
    if(!empty($tenanh))
    {
      $tmp = $_FILES['image']['tmp_name'];
      $tenanh =$user_id.".".$fileActualExt ; // goi so cho anh de khong trung
      $newp='upload/'.$tenanh;
      $_SESSION['anh']=$tenanh;
      if(!move_uploaded_file($tmp,$newp))
      {
        $error ='upload anh that bai';
      }
      else{
        
        move_uploaded_file($tmp,$newp);
        
    $sq = "select * from profile where user_ID = '$user_id' ";
    $query = mysqli_query($connect,$sq);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows==0) {
      $sql1 = "INSERT INTO profile(user_ID,user_fullName,user_contact,user_image) VALUES ( '$user_id','$ten', '$sdt','$tenanh')";
      mysqli_query($connect,$sql1);
    }
    else{
        
        
        $sql = " UPDATE profile SET user_fullName ='".$ten."',user_contact='".$sdt."', user_image ='".$tenanh."' where user_ID='".$user_id."' ";
        mysqli_query($connect,$sql);
    } 
       
      
        
        
        $_SESSION['link'] =$newp;
      
      }
    }else{
             
    $sq = "select * from profile where user_ID = '$user_id' ";
    $query = mysqli_query($connect,$sq);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows==0) {
      $sql1 = "INSERT INTO profile(user_ID,user_fullName,user_contact,user_image) VALUES ( '$user_id','$ten', '$sdt','')";
      mysqli_query($connect,$sql1);
    }
    else{
        
        
        $sql = " UPDATE profile SET user_fullName ='".$ten."',user_contact='".$sdt."' where user_ID='".$user_id."' ";
        mysqli_query($connect,$sql);
    } 
       
    }
    $_SESSION['link'] =$newp;

    header('location: profile.php');







  }
function findUserById($id){
    global $db;
    $stmt = $db->prepare("SELECT * FROM login WHERE id=? LIMIT 1");
    $stmt -> execute(array($id));
    $user = $stmt ->fetch(PDO::FETCH_ASSOC);
    return $user;   
}   
if(isset($_POST["action"])) {
   
    $user_id = $_SESSION['userId'];
   $x='';
$i = 0 ;   
    foreach ($_FILES['images']['name'] as $file)
            {
                    
                    
                    $errors= array();
                    $file_name = $_FILES['images']['name'][$i];
                    $file_size =$_FILES['images']['size'][$i];
                    $file_tmp =$_FILES['images']['tmp_name'][$i];
                    $file_type=$_FILES['images']['type'][$i]; 
                    $newp='upload/'.$file_name;
                    
                    $fileExt = explode('.',$file_name);
                    $fileActualExt = strtolower(end($fileExt));
                    move_uploaded_file($file_tmp,$newp);
               $i++;
            }
           
         $x= implode(',',$_FILES['images']['name'] )   ;
  


    $context = $_POST["context"];
    $sql = "INSERT INTO `post`(`uid`, `context`, `type`, `value`, `time`, `public`, `likes`, `comments`, `shares`) VALUES ($user_id ,'$context','images','$x',now(),1,0,0,0)";
    mysqli_query($connect,$sql);        
   
}

function findProfile($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM `profile` WHERE user_ID=? LIMIT 1");
  
    $stmt -> execute(array($userId));
    
    $user = $stmt ->fetch(PDO::FETCH_ASSOC);
    return $user;



		return $result->fetch_assoc();
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