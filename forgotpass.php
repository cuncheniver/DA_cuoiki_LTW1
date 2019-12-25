<?php
require_once 'function.php';
ob_start();
error_reporting(0);
if (!isset($_SESSION))
  {
    session_start();
  }

?>
<!-- Form-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="./image/logo.PNG">
    <link rel="stylesheet" href="./css/st1.css">
    <script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    <script type="text/javascript"  src="js/st1.js"></script>
    
    <title>Forgot</title>
</head>
<body>
<br>
<br>
<br>
<?php
if($_SESSION['forgot'])
{
    echo "ĐÃ GỬI MAIL THAY ĐỔI MẬT KHẨU VÀO EMAIL CỦA BẠN";
    unset($_SESSION['forgot']);}
    else{
        if($_SESSION['none'])
        {
          
  
    unset($_SESSION['none']);
        }
    }
    ?>
<form action="forgotpass.php" method="POST">
<div class="form-group">
<label for="email">Dia chi mail</label>
<input type="email" class="form-control" id="email" name="emaill">
</div>
<div class="form-group"> <button type="submit"  name="forgot-password">yeu cau khoi phuc mat khau</button> </div>
</form>



<?php if (isset($_POST["forgot-password"]))
    {
        $x = $_POST["emaill"];

      





if ($_POST["emaill"] != '') {
  
    $email = $_POST['emaill'];
    $_SESSION['mail']=$email;
    $user= findUserByEmail($email);
    if($user)
    {
        
        
        sendEmail($user['email'],'yeu cau khoi phuc mat khau','click <a href="http://localhost:8080/khoiphuc.php
        "> vao day</a>');
       $_SESSION['forgot']= 1;
      
    }
    else
    {
       
        $_SESSION['none'] =1;
        echo "email khong ton tai";
    }
    

    
    
}else{
    $_SESSION['none'] =1;
    echo "CHƯA NHẬP EMAIL";
}

}
?>





</body>