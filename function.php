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
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connect = mysqli_connect($host, $username, '', $dbName);
mysqli_set_charset($connect, 'UTF8');
if (isset($_POST["register"]))
{
    $name = mysqli_real_escape_string($connect, $_POST['username']);
    $_SESSION['ten'] = $name;
    $mail = mysqli_real_escape_string($connect, $_POST['email']);
    $_SESSION['mail'] = $mail;
    $pass = mysqli_real_escape_string($connect, $_POST['password']);
    $_SESSION['pass'] = $pass;

    if ($pass == "" || $mail == "" || $name = "")
    {
        echo "bạn vui lòng nhập đầy đủ thông tin";
    }
    else
    {
        $name = $_SESSION['ten'];
        $sq = "select * from login where email='$mail' or user_name='$name'";
        $kt = mysqli_query($connect, $sq);

        if (mysqli_num_rows($kt) > 0)
        {
            $_SESSION['fail'] = true;
            echo "k";
            header('location: login.php');
        }
        else
        {
            $_SESSION['used'] = $mail;

            if (isset($mail))
            {
                $email = $mail;

                if ($email)
                {

                    $secret = generateRandomString();
                    sendEmail($email, 'Kick hoat tai khoan', 'click <a href="http://localhost:8080/DA_cuoiki_LTW1/dd.php"> vao day</a>');
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
function createUser($name, $pass)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO login (name,pass) VALUES(?,?)");
    $stmt->execute(array(
        $name,
        $pass
    ));

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
    $query = mysqli_query($connect, $sql);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows == 0)
    {
        $_SESSION['loginfail'] = 1;
        header('Location: login.php');
    }
    else
    {

        $sql = "select id from login where user_name = '$username'";
        $result = mysqli_query($connect, $sql);

        if ($result)
        {

            while ($row = mysqli_fetch_row($result))
            {
                $userId = $row[0];
            }

            mysqli_free_result($result);
            $_SESSION['userId'] = $userId;

        }
        $_SESSION['username'] = $username;

        setcookie('$username', '$password');
        header('Location: home.php');
    }
}
if (isset($_POST["displaycmt"]))
{
    $userId = $_SESSION['userId'];

    $id = $_POST['cc'];
    $sql = "select * from comments where postid = $id ORDER BY id DESC";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result))
    {

        $profile = findProfile($row['uid']);
?>
          
    <div class="message-reply-container" id="comment<?php echo $row['id'] ?>">
        <div class="message-menu comment-menu" onclick="messageMenu(2, 4)"></div>
        <div id="comment-menu<?php echo row['id'] ?>" class="message-menu-container">
            <div class="message-menu-row" onclick="edit_comment(2, 0, 6)" id="edit_text_c2">Edit</div>
            <div class="message-menu-row" onclick="deleteModal(2, 0, 6)">Delete</div>
        </div>
        
        <div class="message-reply-avatar" id="avatar-c-<?php echo $row['id'] ?>">
            <a href="http://localhost:8080/phpsocial//index.php?a=profile&amp;u=phu" rel="loadpage"><img onmouseover="profileCard(1, 2, 1, 0, 0)" onmouseout="profileCard(0, 0, 1, 1, 0);" onclick="profileCard(0, 0, 1, 1, 0);" src="upload/<?php print_r($profile['user_image']) ?>"></a>
        </div>
       
        <div class="message-reply-message">
            <span class="message-reply-author" id="author-c-<?php echo $row['id'] ?>"><a href="http://localhost:8080/phpsocial//index.php?a=profile&amp;u=phu" rel="loadpage"><?php print_r($profile['user_fullName']) ?></a></span>: <span id="comment_text2"><?php echo $row['content'] ?></span>
            <?php if ($row['value'] != '')
        {
?>
            <div class="comment-image-thumbnail"><a onclick="gallery('127706057_210810256_1601482327.jpg', 2, 'media', 2)" id="127706057_210810256_1601482327.jpg"><img style="width: 30% !important;
    
    height: 40%;" src="upload/<?php print_r($row['value']) ?>" ></a></div>
        <?php
        } ?>
        </div>
        <div class="message-reply-footer" id="comment-action<?php echo $row['id'] ?>">
            <div class="message-time"><span class="like-comment"><a onclick="Dolike(<?php echo $row['id'] ?>, 1)" id="doLikeC<?php echo $row['id'] ?>">Like</a> -&nbsp;</span>
                <span id="time-c-<?php echo $row['id'] ?>">
                    <div class="timeago" title="2019-12-18T20:13:28+01:00"><?php echo $row['time'] ?></div>
                </span>
                <a onclick="likesModal(<?php echo $row['id'] ?>, 1)" title="View who liked" id="ac<?php echo $row['id'] ?>">
                    <div class="actions_btn like_btn"> </div>
                </a>
                <div class="actions_btn loader" id="action-c-loader<?php echo $row['id'] ?>"></div>
            </div>
        </div>
        <div class="delete_preloader" id="del_comment_<?php echo $row['id'] ?>"></div>
    </div>
      
   

    <?php
    }
}
if (isset($_POST["display"]))
{

    if (isset($_POST['isFriend']))
    {
        $isFriend = $_POST['isFriend'];
    }
    else
    {
        $isFriend = 0;
    }

    $ok = $_POST['ID'];
    $userFr = $_POST['IDkhach'];
    $profile = findProfile($ok);
    $profileFr = findProfile($userFr);
    $sql = "select * from post where uid = '$ok' ORDER BY id DESC";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result))
    {
        if ($ok == $userFr)
        {
?>  
    <script>console.log(<?php echo $ok ?>)</script>

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
                <span id="time-p-<?php echo $row['id'] ?>"><a rel="loadpage">
                        <div class="timeago" title="2019-11-28T14:06:48+01:00"><?php echo $row['time'] ?></div>
                    </a></span><span id="privacy<?php echo $row['id'] ?>">
                    <?php if ($row['public'] == 1)
            {
?>
                    <div class="privacy-icons public-icon" title="Public"></div>
                    <?php
            }
            else if ($row['public'] == 2)
            { ?>
                        <div class="privacy-icons friends-icon" title="Private"></div>
                  

                    <?php
            }
            else if ($row['public'] == 0)
            { ?>
                        <div class="privacy-icons private-icon" title="Private"></div>
                    <?php
            } ?>
                </span>
                <div id="message_loader<?php echo $row['id'] ?>"></div>
            </div>
        </div>
        <div class="message-message" id="message_text3">
            <?php echo $row['content'];

?>
        </div>

    </div>
    <div class="message-divider"></div>
    <?php if ($row['value'])
            {
                $i = 0;
                $list = explode(',', $row['value']);

?>
    <div class="message-type-image event-picture">
        <?php foreach ($list as $image)
                { ?>
        <div class="image-container-padding">
            <a onclick="gallery('1320257503_78764593_2015581271.jpg', 3, 'media', 1)" id="1320257503_78764593_2015581271.jpg">
                <div class="image-thumbnail-container">
                    <div class="image-thumbnail"><img src="upload/<?php echo $image; ?>"></div>
                </div>
            </a></div>
        <?php
                } ?>
    </div>
    <?php
            } ?>
    <div class="message-divider"></div>
    <div class="message-replies">
        <div class="message-actions">
            <div class="message-actions-content" id="message-action<?php echo $row['id']; ?>"><a onclick="Dolike(<?php echo $row['id']; ?>,0)" id="doLike<?php echo $row['id']; ?>">like</a> - <a onclick="focus_form(3)">Comment</a> - <a onclick="share(3)">Share</a>
            <div class="actions_btn comments_btn" id="ac<?php echo $row['id']; ?>"> 2</div>
            
            <a onclick="likesModal(<?php echo $row['id']; ?>, 0)" title="View who liked" id="al<?php echo $row['id']; ?>">
    <div class="actions_btn like_btn"> 1</div>
            </a>
                <div class="actions_btn loader" id="action-loader<?php echo $row['id']; ?>"></div>
            </div>
        </div>
        <div class="message-replies-content" id="comments-list<?php echo $row['id']; ?>">
                
        </div>
    </div>
    <div class="message-comment-box-container" id="comment_box_<?php echo $row['id']; ?>">
        <div class="message-reply-avatar">
            <img src="upload/<?php print_r($profileFr['user_image']) ?>">
        </div>
        <div class="message-comment-box-form">
            <textarea id="comment-form<?php echo $row['id']; ?>" onclick="showButton(<?php echo $row['id']; ?>)" placeholder="Leave a comment..." class="comment-reply-textarea"></textarea>
            <label for="commentimage<?php echo $row['id']; ?>" class="c-w-icon c-w-icon-picture comment-image-btn" title="Upload image" data-active-comment="<?php echo $row['id']; ?>"></label>
        </div>
        <div class="comments-buttons">
            <div id="comments-controls<?php echo $row['id']; ?>" class="comments-controls" style="display: none;">
                <div class="comment-btn button-active">
                    <a id="post-comment" onclick="postComments(<?php echo $row['id']; ?>)">Post</a>
                </div>
                <div id="f">

     </div>
        <?php
        }
        else
        { ?>

        <?php if ($row['public'] == 1)
            { ?>
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
                <span id="time-p-<?php echo $row['id'] ?>"><a rel="loadpage">
                        <div class="timeago" title="2019-11-28T14:06:48+01:00"><?php echo $row['time'] ?></div>
                    </a></span><span id="privacy<?php echo $row['id'] ?>">
                    <?php if ($row['public'] == 1)
                {
?>
                    <div class="privacy-icons public-icon" title="Public"></div>
                    <?php
                }
                else if ($row['public'] == 2)
                { ?>
                        <div class="privacy-icons friends-icon" title="Private"></div>
                  

                    <?php
                }
                else if ($row['public'] == 0)
                { ?>
                        <div class="privacy-icons private-icon" title="Private"></div>
                    <?php
                } ?>
                </span>
                <div id="message_loader<?php echo $row['id'] ?>"></div>
            </div>
        </div>
        <div class="message-message" id="message_text3">
            <?php echo $row['content'];

?>
        </div>

    </div>
    <div class="message-divider"></div>
    <?php if ($row['value'])
                {
                    $i = 0;
                    $list = explode(',', $row['value']);

?>
    <div class="message-type-image event-picture">
        <?php foreach ($list as $image)
                    { ?>
        <div class="image-container-padding">
            <a onclick="gallery('1320257503_78764593_2015581271.jpg', 3, 'media', 1)" id="1320257503_78764593_2015581271.jpg">
                <div class="image-thumbnail-container">
                    <div class="image-thumbnail"><img src="upload/<?php echo $image; ?>"></div>
                </div>
            </a></div>
        <?php
                    } ?>
       
    </div>
    <?php
                } ?>
    <div class="message-divider"></div>
    <div class="message-replies">
        <div class="message-actions">
            <div class="message-actions-content" id="message-action<?php echo $row['id']; ?>"><a onclick="Dolike(<?php echo $row['id']; ?>,0)" id="doLike<?php echo $row['id']; ?>">like</a> - <a onclick="focus_form(3)">Comment</a> - <a onclick="share(3)">Share</a>
            <div class="actions_btn comments_btn" id="ac<?php echo $row['id']; ?>"> 2</div>
            
            <a onclick="likesModal(<?php echo $row['id']; ?>, 0)" title="View who liked" id="al<?php echo $row['id']; ?>">
    <div class="actions_btn like_btn"> 1</div>
            </a>
                <div class="actions_btn loader" id="action-loader<?php echo $row['id']; ?>"></div>
            </div>
        </div>
        <div class="message-replies-content" id="comments-list<?php echo $row['id']; ?>">
                
        </div>
    </div>
    <div class="message-comment-box-container" id="comment_box_<?php echo $row['id']; ?>">
        <div class="message-reply-avatar">
            <img src="upload/<?php print_r($profileFr['user_image']) ?>">
        </div>
        <div class="message-comment-box-form">
            <textarea id="comment-form<?php echo $row['id']; ?>" onclick="showButton(<?php echo $row['id']; ?>)" placeholder="Leave a comment..." class="comment-reply-textarea"></textarea>
            <label for="commentimage<?php echo $row['id']; ?>" class="c-w-icon c-w-icon-picture comment-image-btn" title="Upload image" data-active-comment="<?php echo $row['id']; ?>"></label>
        </div>
        <div class="comments-buttons">
            <div id="comments-controls<?php echo $row['id']; ?>" class="comments-controls" style="display: none;">
                <div class="comment-btn button-active">
                    <a id="post-comment" onclick="postComments(<?php echo $row['id']; ?>)">Post</a>
                </div>
                <div id="f">

     </div>


        <?php
            }
            else ?>
        <?php if ($row['public'] == 2)
            {
?>
            <?php if ($isFriend == 1)
                { ?>
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
                <span id="time-p-<?php echo $row['id'] ?>"><a rel="loadpage">
                        <div class="timeago" title="2019-11-28T14:06:48+01:00"><?php echo $row['time'] ?></div>
                    </a></span><span id="privacy<?php echo $row['id'] ?>">
                    <?php if ($row['public'] == 1)
                    {
?>
                    <div class="privacy-icons public-icon" title="Public"></div>
                    <?php
                    }
                    else if ($row['public'] == 2)
                    { ?>
                        <div class="privacy-icons friends-icon" title="Private"></div>
                  

                    <?php
                    }
                    else if ($row['public'] == 0)
                    { ?>
                        <div class="privacy-icons private-icon" title="Private"></div>
                    <?php
                    } ?>
                </span>
                <div id="message_loader<?php echo $row['id'] ?>"></div>
            </div>
        </div>
        <div class="message-message" id="message_text3">
            <?php echo $row['content'];

?>
        </div>

    </div>
    <div class="message-divider"></div>
    <?php if ($row['value'])
                    {
                        $i = 0;
                        $list = explode(',', $row['value']);

?>
    <div class="message-type-image event-picture">
        <?php foreach ($list as $image)
                        { ?>
        <div class="image-container-padding">
            <a onclick="gallery('1320257503_78764593_2015581271.jpg', 3, 'media', 1)" id="1320257503_78764593_2015581271.jpg">
                <div class="image-thumbnail-container">
                    <div class="image-thumbnail"><img src="upload/<?php echo $image; ?>"></div>
                </div>
            </a></div>
        <?php
                        } ?>
       
    </div>
    <?php
                    } ?>
    <div class="message-divider"></div>
    <div class="message-replies">
        <div class="message-actions">
            <div class="message-actions-content" id="message-action<?php echo $row['id']; ?>"><a onclick="Dolike(<?php echo $row['id']; ?>,0)" id="doLike<?php echo $row['id']; ?>">like</a> - <a onclick="focus_form(3)">Comment</a> - <a onclick="share(3)">Share</a>
            <div class="actions_btn comments_btn" id="ac<?php echo $row['id']; ?>"> 2</div>
            
            <a onclick="likesModal(<?php echo $row['id']; ?>, 0)" title="View who liked" id="al<?php echo $row['id']; ?>">
    <div class="actions_btn like_btn"> 1</div>
            </a>
                <div class="actions_btn loader" id="action-loader<?php echo $row['id']; ?>"></div>
            </div>
        </div>
        <div class="message-replies-content" id="comments-list<?php echo $row['id']; ?>">
                
        </div>
    </div>
    <div class="message-comment-box-container" id="comment_box_<?php echo $row['id']; ?>">
        <div class="message-reply-avatar">
            <img src="upload/<?php print_r($profileFr['user_image']) ?>">
        </div>
        <div class="message-comment-box-form">
            <textarea id="comment-form<?php echo $row['id']; ?>" onclick="showButton(<?php echo $row['id']; ?>)" placeholder="Leave a comment..." class="comment-reply-textarea"></textarea>
            <label for="commentimage<?php echo $row['id']; ?>" class="c-w-icon c-w-icon-picture comment-image-btn" title="Upload image" data-active-comment="<?php echo $row['id']; ?>"></label>
        </div>
        <div class="comments-buttons">
            <div id="comments-controls<?php echo $row['id']; ?>" class="comments-controls" style="display: none;">
                <div class="comment-btn button-active">
                    <a id="post-comment" onclick="postComments(<?php echo $row['id']; ?>)">Post</a>
                </div>
                <div id="f">

     </div>
            <?php
                } ?>
        <?php
            } ?>

        <?php
        } ?>
                <script> function postComments(id) {
    var comment = $('#comment-form'+id).val();
    var pic = $('#queued-comment-files'+id).html();
    if(comment != "" || pic !="" )
    {
	
	// Remove the post button
	$('#comments-controls'+id).hide();
	
	// Show the loading animation
	
	
	var formData2 = new FormData();
	
	// Build the form
	formData2.append("idcmt", id);
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
                <div id="queued-comment-files<?php echo $row['id']; ?>"></div>
            </div>
            <input type="file" name="commentimage" id="commentimage<?php echo $row['id']; ?>" style="display: none;" accept="image/*">
        </div>
        <div class="delete_preloader" id="post_comment_<?php echo $row['id']; ?>"></div>
    </div>
</div>
<script>
 function Dolike(id,type){
    if(type == 1) {
		
	} else if(type == 2) {
		
	} else {
        console.log(id);
	
	
    }
    var trangthai = $('#doLike'+id).html();
    console.log(trangthai);
   
    $.ajax({
		type: "POST",
		url: "function.php",
		data: "id="+id+"&type="+type+"&like="+trangthai, 
		cache: false,
		success: function(html) {
            if(type == 1) {
                DisplayLike(id,type);
			} else if(type == 2) {
              
               
                
			} else {
                
                DisplayLike(id,type);
                if(trangthai == "like")
                {
                    loadNoti(<?php echo $_SESSION['userId'] ?>);     
                }
                
              countNT(<?php echo $_SESSION['userId'] ?>);
				
			}
			
		}
	});
	
   }
   function DisplayLike(id,type)
   {
    $.ajax({
		type: "POST",
        url: "function.php",
        async: true,
        data: "ID="+id+"&type="+type+"&displaylike="+type, 
        
		
		success: function(html) {
            var result = $.parseJSON(html);
            if(type == 1) {
				<?php $userId = $_SESSION['userId'];

                ?>

                
                $('#doLikeC'+id).html(result.TrangThai);

                if(result.count>0)
                {$('#ac'+id).html('<div class="actions_btn like_btn">'+result.count+'</div>');}
                else
                $('#al'+id).html('');
                <?php ?>
                
               
               
			} else if(type == 2) {
				
			} else {
                <?php $userId = $_SESSION['userId'];

?>

                
                $('#doLike'+id).html(result.TrangThai);

                if(result.count>0)
                {$('#al'+id).html('<div class="actions_btn like_btn">'+result.count+'</div>');}
                else
                $('#al'+id).html('');
                <?php ?>
                
                if(result.countCMT >0)
                {
                    $('#ac'+id).html(result.countCMT);
                }
                else
                $('#ac'+id).html(0);
				
			}
			
		}
	});
   }

   function loadNoti(id)
   {
    $.ajax({
		type: "POST",
        url: "function.php",
        async: true,
        data: "iNoti="+id, 
        
		
		success: function(html) {
			$('#Slim').html(html);
		}
	});
   }
   function countNT(id)
   {
    $.ajax({
		type: "POST",
        url: "function.php",
        async: true,
        data: "IC="+id, 
        
		
		success: function(html) {
			$('#CNT').html(html);
		}
	});
   }
  

</script>
<?php
    }
    exit();

}
if (isset($_POST["IC"]))
{
    $uId = $_POST["IC"];
    $kq = countNoti($uId);
    ?>
    <?php if($kq['noti'] >0) {?>
        <span class="badge badge-danger badge-pill noti-icon-badge"><?php echo $kq['noti'] ?></span>
    <?php } ?>
    <?php 

}

if (isset($_POST["iNoti"]))
{

    $y =  $_POST['iNoti']
?>
      
        <?php $userId = $_SESSION['userId'];

    $sq = "SELECT * FROM  `notifications` n WHERE n.to=$y";
    $rs = mysqli_query($connect, $sq);
    while ($row = mysqli_fetch_array($rs))
    { ?>
        <a href="javascript:void(0);" class="dropdown-item notify-item">
    <div class="notify-icon bg-success"><i class="fa fa-comment"></i></div>
    <p class="notify-details">noti ví dụ nè má<small class="text-muted">1 min ago</small></p>
</a>
        
   <?php
    } ?>
       




    <?php
}

function findLikeP($postId, $userId)
{
    global $db;
    $stmt = $db->prepare("SELECT count(*) as likee from likes WHERE postId =$postId and userId=$userId and type=0 ");
    $stmt->execute(array(
        $postId,
        $userId
    ));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
function findLikeCmt($postId, $userId)
{
    global $db;
    $stmt = $db->prepare("SELECT count(*) as likee from likes WHERE postId =$postId and userId=$userId and type=1 ");
    $stmt->execute(array(
        $postId,
        $userId
    ));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
function countNoti($Id)
{

    global $db;
    $stmt = $db->prepare("SELECT count(*) as noti from `notifications` n WHERE n.to=? and n.read=0");
    $stmt->execute(array($Id));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
function countLikePost($postId)
{

    global $db;
    $stmt = $db->prepare("SELECT count(*) as likee from likes WHERE postId =$postId and type=0");
    $stmt->execute(array(
        $postId
    ));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
function countLikeCmt($postId)
{

    global $db;
    $stmt = $db->prepare("SELECT count(*) as likee from likes WHERE postId =$postId and type=1");
    $stmt->execute(array(
        $postId
    ));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
function countCmtPost($postId)
{
    global $db;
    $stmt = $db->prepare("SELECT count(*) as cmt from comments WHERE postid =?");
    $stmt->execute(array(
        $postId
    ));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}

if (isset($_POST["listLikes"]))
{
    $pid = $_POST['ID'];
    $idUser = $_SESSION['userId'];
?>
      
        <?php $userId = $_SESSION['userId'];

    $sql = "SELECT * FROM `likes` JOIN profile p WHERE userId = p.user_ID and postId = $pid";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result))
    { ?>
    <div class="modal-listing">
    <div class="modal-listing-inner">
        <div id="friend<?php echo $row['id'] ?>"></div>
        <div class="message-avatar" id="avatar<?php echo $row['id'] ?>"><a href="friend.php?id=<?php print_r($row['user_ID']) ?>"><img src="upload/<?php print_r($row['user_image']) ?>"></a></div>
        <div class="message-top">

            <div class="message-time"><?php echo $row['user_fullName'] ?>&nbsp;</div>
        </div>

    </div>
</div>
        
   <?php
    } ?>
       




    <?php
}

if (isset($_POST['ID']) && isset($_POST['type']) && isset($_POST["displaylike"]))
{
    $pid = $_POST['ID'];
    $typee= $_POST['type'];
    $idUser = $_SESSION['userId'];
    if($typee == 0)
    {
    $s = countLikePost($pid);
    $s2 = countCmtPost($pid);
    $isLike = findLikeP($pid, $idUser);
    $btTT = "";
    if ($isLike['likee'] > 0)
    {
        $btTT = "Unlike";
    }
    else
    {
        $btTT = "like";
    }

    $member = array(
        'count' => $s['likee'],
        'TrangThai' => $btTT,
        'countCMT' => $s2['cmt']
    );
    }
    else{
        $s = countLikeCmt($pid);
        
        $isLike = findLikeCmt($pid, $idUser);
        $btTT = "";
        if ($isLike['likee'] > 0)
        {
            $btTT = "Unlike";
        }
        else
        {
            $btTT = "like";
        }
    
        $member = array(
            'count' => $s['likee'],
            'TrangThai' => $btTT
            
        );
    }

    echo json_encode($member);

}
if (isset($_POST['id']) && isset($_POST['type']) && isset($_POST['like']))
{
    $pid = $_POST['id'];
    $user_id = $_SESSION['userId'];
    $type = $_POST['type'];
    $k = $_POST['like'];
     $upId = findUserByPost($pid);
     $x = $upId['uid'];

   if($type==0)
   {
    if ($k == "like")
    {   
        
        $sql1 = "INSERT INTO `likes`(`postId`, `userId`, `createdAt`,`type`) VALUES ($pid,$user_id,now(),$type)";
        $sql2 = "UPDATE `post` SET `likes` = likes+1 WHERE id = $pid";
        $sql3 = "INSERT INTO `notifications`(`from`, `to`, `parent`, `child`, `type`, `read`, `time`) VALUES ($user_id,$x,$pid,0,1,0,now())";
        mysqli_query($connect, $sql1);
        mysqli_query($connect, $sql2);
        if($x !=$user_id)
        {
            mysqli_query($connect, $sql3);
        }
      
    }
    else
    {
        $sql1 = "DELETE FROM `likes` where postId =$pid  ";
        $sql2 = "UPDATE `post` SET `likes` = likes-1 WHERE id = $pid";
        mysqli_query($connect, $sql1);
        mysqli_query($connect, $sql2);
    }

   }
   else{
    $sql1 = "INSERT INTO `likes`(`postId`, `userId`, `createdAt`,`type`) VALUES ($pid,$user_id,now(),$type)";
    $sql2 = "UPDATE `comments` SET `likes` = likes+1 WHERE id = $pid";
    mysqli_query($connect, $sql1);
    mysqli_query($connect, $sql2);
   }
    
}

if (isset($_POST["Save"]))
{

    $user_id = $_SESSION['userId'];

    $ten = $_POST["name"];

    $sdt = $_POST["phone"];
    $tenanh = $_FILES['image']['name'];
    $fileExt = explode('.', $tenanh);
    $fileActualExt = strtolower(end($fileExt));
    if (!empty($tenanh))
    {
        $tmp = $_FILES['image']['tmp_name'];
        $tenanh = $user_id . "." . $fileActualExt; // goi so cho anh de khong trung
        $newp = 'upload/' . $tenanh;
        $_SESSION['anh'] = $tenanh;
        if (!move_uploaded_file($tmp, $newp))
        {
            $error = 'upload anh that bai';
        }
        else
        {

            move_uploaded_file($tmp, $newp);

            $sq = "select * from profile where user_ID = '$user_id' ";
            $query = mysqli_query($connect, $sq);
            $num_rows = mysqli_num_rows($query);
            if ($num_rows == 0)
            {
                $sql1 = "INSERT INTO profile(user_ID,user_fullName,user_contact,user_image) VALUES ( '$user_id','$ten', '$sdt','$tenanh')";
                mysqli_query($connect, $sql1);
            }
            else
            {

                $sql = " UPDATE profile SET user_fullName ='" . $ten . "',user_contact='" . $sdt . "', user_image ='" . $tenanh . "' where user_ID='" . $user_id . "' ";
                mysqli_query($connect, $sql);
            }

            $_SESSION['link'] = $newp;

        }
    }
    else
    {

        $sq = "select * from profile where user_ID = '$user_id' ";
        $query = mysqli_query($connect, $sq);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows == 0)
        {
            $sql1 = "INSERT INTO profile(user_ID,user_fullName,user_contact,user_image) VALUES ( '$user_id','$ten', '$sdt','')";
            mysqli_query($connect, $sql1);
        }
        else
        {

            $sql = " UPDATE profile SET user_fullName ='" . $ten . "',user_contact='" . $sdt . "' where user_ID='" . $user_id . "' ";
            mysqli_query($connect, $sql);
        }

    }
    $_SESSION['link'] = $newp;

    header('location: profile.php');

}

function findUserByPost($id)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM post  WHERE id=? LIMIT 1");
    $stmt->execute(array($id));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function findUserById($id)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM login WHERE id=? LIMIT 1");
    $stmt->execute(array($id));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function findNewPostById($id)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM `post` WHERE uid=? GROUP BY id DESC LIMIT 1");
    $stmt->execute(array(
        $id
    ));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
if (isset($_POST['idcmt']) )
{

    $user_id = $_SESSION['userId'];
    $id = $_POST['idcmt'];
    
    if(isset($_POST['comment']))
    {
        $text = $_POST['comment'];
    }
    else{ $text = "";}
    
        $tenanh = $_FILES['value']['name'];
        $fileExt = explode('.', $tenanh);
        $fileActualExt = strtolower(end($fileExt));
        if (!empty($tenanh))
        {

            $vl = $_FILES['value']['name'];

            $tmp = $_FILES['value']['tmp_name'];
            $newp = 'upload/' . $vl;
            if (!move_uploaded_file($tmp, $newp))
            {
                $error = 'upload anh that bai';
            }
            else
            {

                move_uploaded_file($tmp, $newp);
                $sql1 = "INSERT INTO `comments`( `uid`, `postid`, `content`, `value`, `time`, `likes`) VALUES ($user_id,$id,'$text','$vl',now(),0)";
                mysqli_query($connect, $sql1);

            }
        }
        else
        {
?>
            <script> console.log("ok")</script>
            <?php
            $vl = '';
            $sql1 = "INSERT INTO `comments`( `uid`, `postid`, `content`, `value`, `time`, `likes`) VALUES ($user_id,$id,'$text','$vl',now(),0)";
            mysqli_query($connect, $sql1);
        }
    

}

if (isset($_POST['context']) || isset($_POST['images']))
{
    $user_id = $_SESSION['userId'];
    $x = '';
    $i = 0;
    foreach ($_FILES['images']['name'] as $file)
    {

        $errors = array();
        $file_name = $_FILES['images']['name'][$i];
        $file_size = $_FILES['images']['size'][$i];
        $file_tmp = $_FILES['images']['tmp_name'][$i];
        $file_type = $_FILES['images']['type'][$i];
        $newp = 'upload/' . $file_name;

        $fileExt = explode('.', $file_name);
        $fileActualExt = strtolower(end($fileExt));
        move_uploaded_file($file_tmp, $newp);
        $i++;
    }

    $x = implode(',', $_FILES['images']['name']);

    $context = mysqli_real_escape_string($connect, $_POST['context']);
    $tt = mysqli_real_escape_string($connect, $_POST['trangthai']);
    $sql = "INSERT INTO `post`(`uid`, `content`, `type`, `value`, `time`, `public`, `likes`, `comments`, `shares`) VALUES ($user_id ,'$context','images','$x',now(),$tt,0,0,0)";
    mysqli_query($connect, $sql);

}

function findProfile($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM `profile` WHERE user_ID=? LIMIT 1");

    $stmt->execute(array(
        $userId
    ));

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;

    return $result->fetch_assoc();
}
function findAllPostsbyUser($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM post WHERE uid=? ");
    $stmt->execute(array(
        $userId
    ));
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;

}
function findRelationship($user1Id, $user2Id)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM friends where (user1Id=? and user2Id=?) or( user1Id =? and user2Id=?)");
    $stmt->execute(array(
        $user1Id,
        $user2Id,
        $user2Id,
        $user1Id
    ));
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function findfollow($user1Id, $user2Id)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM follow where (user1Id=? and user2Id=?)");
    $stmt->execute(array(
        $user1Id,
        $user2Id
    ));
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function addRelationship($user1Id, $user2Id)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO friends(user1Id,user2Id) values(?,?)");
    $stmt->execute(array(
        $user1Id,
        $user2Id
    ));

}
function findLike($user2Id, $text)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM SLL where  user2Id=? and  Text=?");
    $stmt->execute(array(
        $user2Id,
        $text
    ));
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function countFollower($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT count(*) as fl from follow WHERE user2Id =?");
    $stmt->execute(array(
        $userId
    ));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
function countFollowing($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT count(*) as fl from follow WHERE user1Id =?");
    $stmt->execute(array(
        $userId
    ));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}

function countFrends($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT count(*) as fr FROM friends f1, friends f2 where f1.user1Id =$userId and f1.user2Id=f2.user1Id and f2.user2Id =$userId");
    $stmt->execute(array(
        $userId
    ));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
function countPost($userId)
{
    global $db;
    $stmt = $db->prepare("SELECT count(*) as post FROM post WHERE uid = ? ");
    $stmt->execute(array(
        $userId
    ));
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
function addFollow($user1Id, $user2Id)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO follow(user1Id,user2Id) values(?,?)");
    $stmt->execute(array(
        $user1Id,
        $user2Id
    ));

}
function removeFollow($user1Id, $user2Id)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM follow where (user1Id=? and user2Id=?) ");
    $stmt->execute(array(
        $user1Id,
        $user2Id
    ));

}

function removeRelationship($user1Id, $user2Id)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM friends where (user1Id=? and user2Id=?) or (user1Id=? and user2Id=?)");
    $stmt->execute(array(
        $user1Id,
        $user2Id,
        $user2Id,
        $user1Id
    ));

}
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0;$i < $length;$i++)
    {
        $randomString .= $characters[rand(0, $charactersLength - 1) ];
    }
    return $randomString;
}

function sendEmail($email, $subject, $content)
{
    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    try
    {
        //Server settings
        $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'nguyentranphu1233@gmail.com'; // SMTP username
        $mail->Password = 'FUdmtlnlacccphongCK4'; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465; // TCP port to connect to
        //Recipients
        $mail->setFrom('nguyentranphu1233@gmail.com', 'phune');
        $mail->addAddress($email); // Add a recipient
        

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $content;

        $_SESSION['used'] = $email;
        $mail->send();
        return true;
    }
    catch(Exception $e)
    {
        return false;
    }
}
?>
