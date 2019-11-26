<?php
require_once 'function.php';
ob_start();
error_reporting(0);
if (!isset($_SESSION))
  {
    session_start();
  }
  $userId =$_SESSION['userId'];
   $currentUser= findUserById($userId); 
  

   if($currentUser)
   {
    
     header('location: home.php');
     exit(0);
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
    <script> $(document).ready(function() {
    var panelOne = $('.form-panel.two').height(),
      panelTwo = $('.form-panel.two')[0].scrollHeight;
  
    $('.form-panel.two').not('.form-panel.two.active').on('click', function(e) {
     
  
      $('.form-toggle').addClass('visible');
  
      $('.form-panel.two').addClass('active');
     
    });
  
    $('.form-toggle').on('click', function(e) {
     
      $(this).removeClass('visible');
     
      $('.form-panel.two').removeClass('active');
   
    });
    
  });
</script>
    <title>Login</title>
</head>
<body>
  
        <div class="form">
       
               
          
                <div class="form-toggle"></div>
                <div class="form-panel one">
                <?php



if($_SESSION['used'])
{echo "Mail kích hoat đã gửi vào email của bạn";
    echo $_SESSION['used'];
    unset($_SESSION['used']);}

    if($_SESSION['ok'])
{echo "đăng ký thành công";
    unset($_SESSION['ok']);
   }
   if($_SESSION['fail'])
   {echo "tài khoản đã tồn tại";
       unset($_SESSION['fail']);
      }
      if($_SESSION['loginfail'])
      {echo "tên đăng nhập hoặc mật khẩu không đúng";
          unset($_SESSION['loginfail']);
         }
   
?>

 
                    
           

                    <div class="form-header">
                        <h1>Account Login</h1>
                    </div>
                    <div class="form-content">
                        <form action="function.php" method="POST">
                            <div class="form-group"><label for="username">Username</label><input type="text" id="username" name="username" required="required" /></div>
                            <div class="form-group"><label for="password">Password</label><input type="password" id="password" name="password" required="required" /></div>
                            <div class="form-group"><label class="form-remember"><input type="checkbox"/>Remember Me</label><a class="form-recovery" href="#">Forgot Password?</a></div>
                            <div class="form-group"><button name="login" type="submit">Log In</button></div>
                        </form>
                    </div>
                </div>
                <div class="form-panel two">
                    <div class="form-header">
                        <h1>Register Account</h1>
                    </div>
                    <div class="form-content">
                        <form action="function.php" method="POST">
                            <div class="form-group"><label for="username">Username</label><input type="text" id="username" name="username" required="required" /></div>
                            <div class="form-group"><label for="password">Password</label><input type="password" id="password" name="password" required="required" /></div>
                            <div class="form-group"><label for="cpassword">Confirm Password</label><input type="password" id="cpassword" name="cpassword" required="required" /></div>
                            <div class="form-group"><label for="email">Email Address</label><input type="email" id="email" name="email" required="required" /></div>
                            <div class="form-group"><button name="register" type="submit">Register</button></div>
                        </form>
                        
                    </div>
                </div>
            </div>
      
</body>
</html>
