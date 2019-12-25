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
<br>
<br>
<br>
<center>
<form  action="khoiphuc.php" method="post">
		<table >
			<tr>
                <br>
                <br> 

                <br>
				<td colspan="2"><h3>Khôi Phục Mật khẩu</h3></td>
			</tr>	
		
		
      <tr>
				<td nowrap="nowrap"> <b>Mật Khẩu Mới</b></td>
        <td><input type="password" name="passmoi" rows="1" cols="100"></input></td>
			</tr>
            <tr>
				<td nowrap="nowrap"> <b>Nhập lại Mật Khẩu Mới</b></td>
        <td><input type="password" name="passmoi" rows="1" cols="100"></input></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><input type="submit" name="btn" value="Cập Nhật"></td>
			</tr>
	
		</table>
		
	</form>

<?php 

if (isset($_POST["btn"])) {
    // lấy thông tin người dùng
    $username =  $_SESSION['mail'];
        $oldpass= $_POST["passcu"];
        $newpass = $_POST["passmoi"];
    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
    //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
    
    $password = md5($newpass);
    $passcux = md5($oldpass);
    if ( $newpass =="") {
        echo " password bạn không được để trống!";
    }else{

        $sql = "select * from login where email  = '$username' ";
        $query = mysqli_query($connect,$sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows==0) {
            echo "eee !";
        }else{

            $sql = " UPDATE login SET password ='".$password."' where email = '$username'";
            //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
            mysqli_query($connect,$sql);
            $_SESSION['username'] = $username;
            setcookie('$username','$password');
            echo " Lấy lại mật khẩu thành công!";
        }
    }  
}
?>