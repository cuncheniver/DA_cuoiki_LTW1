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
?>
<?php
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
if(isset($_POST["displaycmt"]))
{
    $userId =$_SESSION['userId'];

   
    $id= $_POST['cc'];
  $sql = "select * from comments where postid = $id ORDER BY id DESC";
  $result = mysqli_query($connect, $sql);
  while($row=mysqli_fetch_array($result))
  {
    $profile = findProfile($row['uid']);
    ?>
      
<div class="message-reply-container" id="comment<?php echo row['id'] ?>">
    <div class="message-menu comment-menu" onclick="messageMenu(2, 4)"></div>
    <div id="comment-menu<?php echo row['id'] ?>" class="message-menu-container">
        <div class="message-menu-row" onclick="edit_comment(2, 0, 6)" id="edit_text_c2">Edit</div>
        <div class="message-menu-row" onclick="deleteModal(2, 0, 6)">Delete</div>
    </div>
    
    <div class="message-reply-avatar" id="avatar-c-2">
        <a href="http://localhost:8080/phpsocial//index.php?a=profile&amp;u=phu" rel="loadpage"><img onmouseover="profileCard(1, 2, 1, 0, 0)" onmouseout="profileCard(0, 0, 1, 1, 0);" onclick="profileCard(0, 0, 1, 1, 0);" src="upload/<?php print_r($profile['user_image'])?>"></a>
    </div>
   
    <div class="message-reply-message">
        <span class="message-reply-author" id="author-c-2"><a href="http://localhost:8080/phpsocial//index.php?a=profile&amp;u=phu" rel="loadpage"><?php print_r($profile['user_fullName'])?></a></span>: <span id="comment_text2"><?php echo $row['content'] ?></span>
        <?php if($row['value'] !='')
    {
    ?>
        <div class="comment-image-thumbnail"><a onclick="gallery('127706057_210810256_1601482327.jpg', 2, 'media', 2)" id="127706057_210810256_1601482327.jpg"><img style="width: 30% !important;

height: 40%;" src="upload/<?php print_r($row['value'])?>" ></a></div>
    <?php }?>
    </div>
    <div class="message-reply-footer" id="comment-action2">
        <div class="message-time"><span class="like-comment"><a onclick="doLike(2, 1)" id="doLikeC2">Like</a> -&nbsp;</span>
            <span id="time-c-2">
                <div class="timeago" title="2019-12-18T20:13:28+01:00"><?php echo $row['time']?></div>
            </span>
            <div class="actions_btn loader" id="action-c-loader2"></div>
        </div>
    </div>
    <div class="delete_preloader" id="del_comment_2"></div>
</div>

    <?php
  }
}
if(isset($_POST["display"]))
{
    
    $userId =$_POST['ID'];
    $userFr =$_POST['IDkhach'];
  $profile = findProfile($userId);
  $profileFr = findProfile($userFr);
  $sql = "select * from post where uid = '$userId' ORDER BY id DESC";
  $result = mysqli_query($connect, $sql);
  while($row=mysqli_fetch_array($result))
  {
?>
<div class="message-content">
    <div class="message-inner">
        <div class="message-avatar" id="avatar-p-3">
            <a href="" rel="loadpage">
                <img onmouseover="profileCard(1, 3, 0, 0, 0);" onmouseout="profileCard(0, 0, 0, 1, 0);" onclick="profileCard(0, 0, 1, 1, 0);" src="upload/<?php print_r($profile['user_image']) ?>">
            </a>
        </div>
        <div class="message-top">

            <div class="message-menu" onclick="messageMenu(3, 1)"></div>
            <div id="message-menu3" class="message-menu-container">
                <a href="http://localhost/phpsocial//index.php?a=post&amp;m=3" target="_blank">
                    <div class="message-menu-row">Show in tab</div>
                </a>
                <div class="message-menu-divider"></div>
                <div class="message-menu-row" onclick="edit_message(3)" id="edit_text3">Edit</div>
                <div class="message-menu-row" onclick="deleteModal(3, 1)">Delete</div>
                <div class="message-menu-divider"></div>
                <div class="message-menu-row" onclick="privacy(3, 1)">Public</div>
                <div class="message-menu-row" onclick="privacy(3, 2)">Friends</div>
                <div class="message-menu-row" onclick="privacy(3, 0)">Private</div>

            </div>
            <div class="message-author" id="author-p-3">
                <a href="http://localhost/phpsocial//index.php?a=profile&amp;u=phu" rel="loadpage"><?php print_r($profile['user_fullName']) ?></a>
            </div>
            <div class="message-time">
                <span id="time-p-3"><a href="http://localhost/phpsocial//index.php?a=post&amp;m=3" rel="loadpage">
                        <div class="timeago" title="2019-11-28T14:06:48+01:00">5 hours ago</div>
                    </a></span><span id="privacy3">
                    <div class="privacy-icons public-icon" title="Public"></div>
                </span>
                <div id="message_loader3"></div>
            </div>
        </div>
        <div class="message-message" id="message_text3">
            <?php echo $row['content'];
          echo $row['id'];
            ?>
        </div>

    </div>
    <div class="message-divider"></div>
    <?php if($row['value'])
    {
        $i=0;
        $list = explode(',',$row['value']);
       
    ?>
    <div class="message-type-image event-picture">
        <?php foreach($list  as $image)
        { ?>
        <div class="image-container-padding">
            <a onclick="gallery('1320257503_78764593_2015581271.jpg', 3, 'media', 1)" id="1320257503_78764593_2015581271.jpg">
                <div class="image-thumbnail-container">
                    <div class="image-thumbnail"><img src="upload/<?php echo $image ;?>"></div>
                </div>
            </a></div>
        <?php } ?>
    </div>
    <?php }?>
    <div class="message-divider"></div>
    <div class="message-replies">
        <div class="message-actions">
            <div class="message-actions-content" id="message-action<?php  echo $row['id'];?>"><a onclick="doLike(3, 0)" id="doLike3">Like</a> - <a onclick="focus_form(3)">Comment</a> - <a onclick="share(3)">Share</a>
                <div class="actions_btn loader" id="action-loader<?php  echo $row['id'];?>"></div>
            </div>
        </div>
        <div class="message-replies-content" id="comments-list<?php  echo $row['id'];?>">
                
        </div>
    </div>
    <div class="message-comment-box-container" id="comment_box_<?php  echo $row['id'];?>">
        <div class="message-reply-avatar">
            <img src="upload/<?php print_r($profileFr['user_image']) ?>">
        </div>
        <div class="message-comment-box-form">
            <textarea id="comment-form<?php  echo $row['id'];?>" onclick="showButton(<?php  echo $row['id'];?>)" placeholder="Leave a comment..." class="comment-reply-textarea"></textarea>
            <label for="commentimage<?php  echo $row['id'];?>" class="c-w-icon c-w-icon-picture comment-image-btn" title="Upload image" data-active-comment="<?php  echo $row['id'];?>"></label>
        </div>
        <div class="comments-buttons">
            <div id="comments-controls<?php  echo $row['id'];?>" class="comments-controls" style="display: none;">
                <div class="comment-btn button-active">
                    <a id="post-comment" onclick="postComments(<?php  echo $row['id'];?>)">Post</a>
                </div>
                <div id="f">

                </div>
                <script> function postComments(id) {
    var comment = $('#comment-form'+id).val();
    $('#post_comment_'+id).html('<div class="preloader preloader-center"></div>');
	
	// Remove the post button
	$('#comments-controls'+id).hide();
	
	// Show the loading animation
	$('#action-loader'+id).html('<div class="privacy_loader"></div>');
	
	var formData2 = new FormData();
	
	// Build the form
	formData2.append("id", id);
	formData2.append("comment", comment);
	
	
	if(typeof($('#commentimage'+id)[0].files[0]) !== "undefined") {

		formData2.append("type", "picture");
		formData2.append("value", $('#commentimage'+id)[0].files[0]);
    }
  
    
	
	
	
    $.ajax({
   url: 'function.php',
   type: 'POST',
   data: formData2,
   async: false,
   cache: false,
   contentType: false,
   processData: false,
   success: function (returndata) {
    displaycmt(id);
    $("#f").html(returndata); 
    $("#queued-comment-files"+id).html(""); 
   
   }
 });
	
}
function displaycmt(id){
  
       $.ajax({
           url: "function.php",
           type: "POST",
           async: false,
           data:{
                "cc" :id,
               "displaycmt":1
           },
           success: function (d) {
            $("#comments-list"+id).html(d); 
           }
       });
   }   
</script>
                <div id="queued-comment-files<?php  echo $row['id'];?>"></div>
            </div>
            <input type="file" name="commentimage" id="commentimage<?php  echo $row['id'];?>" style="display: none;" accept="image/*">
        </div>
        <div class="delete_preloader" id="post_comment_<?php  echo $row['id'];?>"></div>
    </div>
</div>

<?php

}exit();

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
function findNewPostById($id){
    global $db;
    $stmt = $db->prepare("SELECT * FROM `post` WHERE uid=? GROUP BY id DESC LIMIT 1");
    $stmt -> execute(array($id));
    $user = $stmt ->fetch(PDO::FETCH_ASSOC);
    return $user;   
}   
if(isset($_POST['id']) || isset($_POST['comment']) ) {
    
    $user_id = $_SESSION['userId'];
    $id= $_POST['id'];
    $text=$_POST['comment'];
 
    
    $tenanh=$_FILES['value']['name'];
    $fileExt = explode('.',$tenanh);
    $fileActualExt = strtolower(end($fileExt));
    if(!empty($tenanh))
    {
        
        $vl= $_FILES['value']['name'] ;
    
        $tmp = $_FILES['value']['tmp_name'];
        $newp='upload/'.$vl;
     if(!move_uploaded_file($tmp,$newp))
     {
       $error ='upload anh that bai';
     }
     else{
       
       move_uploaded_file($tmp,$newp);
      $sql1 = "INSERT INTO `comments`( `uid`, `postid`, `content`, `value`, `time`, `likes`) VALUES ($user_id,$id,'$text','$vl',now(),0)";
       mysqli_query($connect,$sql1);
        
     }
    }
    else{
        ?>
        <script> console.log("ok")</script>
        <?php
       $vl = '';
       $sql1 = "INSERT INTO `comments`( `uid`, `postid`, `content`, `value`, `time`, `likes`) VALUES ($user_id,$id,'$text','$vl',now(),0)";
        mysqli_query($connect,$sql1);
    }
    
    
}

if(isset($_POST['context']) || isset($_POST['images']) ) {
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
  
        
            
    $context =mysqli_real_escape_string($connect,$_POST['context']);
    $sql = "INSERT INTO `post`(`uid`, `content`, `type`, `value`, `time`, `public`, `likes`, `comments`, `shares`) VALUES ($user_id ,'$context','images','$x',now(),1,0,0,0)";
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
function findAllPostsbyUser($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM post WHERE uid=? ");
    $stmt ->execute(array($userId));
    $posts = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $posts;

}
function findRelationship($user1Id,$user2Id)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM friends where (user1Id=? and user2Id=?) or( user1Id =? and user2Id=?)");
    $stmt -> execute(array($user1Id,$user2Id,$user2Id,$user1Id));
    $posts= $stmt -> fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function findfollow($user1Id,$user2Id)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM follow where (user1Id=? and user2Id=?)");
    $stmt -> execute(array($user1Id,$user2Id));
    $posts= $stmt -> fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function addRelationship($user1Id,$user2Id)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO friends(user1Id,user2Id) values(?,?)");
    $stmt -> execute(array($user1Id,$user2Id));
  

}

function addFollow($user1Id,$user2Id)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO follow(user1Id,user2Id) values(?,?)");
    $stmt -> execute(array($user1Id,$user2Id));
  

}
function removeFollow($user1Id,$user2Id)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM follow where (user1Id=? and user2Id=?) ");
    $stmt -> execute(array($user1Id,$user2Id));
  

}

function removeRelationship($user1Id,$user2Id)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM friends where (user1Id=? and user2Id=?) or (user1Id=? and user2Id=?)");
    $stmt -> execute(array($user1Id,$user2Id,$user2Id,$user1Id));
  

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