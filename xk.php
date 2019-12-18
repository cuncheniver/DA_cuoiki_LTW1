<?php  echo $row['id'];?>

$sql1 = "INSERT INTO `comments`( `uid`, `postid`, `content`, `value`, `time`, `likes`) VALUES ()";
    mysqli_query($connect,$sql1);

    $userId =$_SESSION['userId'];
    $profile = findProfile($userId);
    
  $sql = "select * from comments where postid = 'id' ORDER BY id DESC";
  $result = mysqli_query($connect, $sql);
  while($row=mysqli_fetch_array($result))
  {
  }

<div class="message-replies-content" id="comments-list3">

    <div class="message-reply-container" id="comment3">
        <div class="message-menu comment-menu" onclick="messageMenu(3, 4)"></div>
        <div id="comment-menu3" class="message-menu-container">
            <div class="message-menu-row" onclick="edit_comment(3, 0, 3)" id="edit_text_c3">Edit</div>
            <div class="message-menu-row" onclick="deleteModal(3, 0, 3)">Delete</div>
        </div>
        <div class="message-reply-avatar" id="avatar-c-3">
            <a href="http://localhost/phpsocial//index.php?a=profile&amp;u=phu" rel="loadpage"><img onmouseover="profileCard(1, 3, 1, 0, 0)" onmouseout="profileCard(0, 0, 1, 1, 0);" onclick="profileCard(0, 0, 1, 1, 0);" src="http://localhost/phpsocial//thumb.php?t=a&amp;w=50&amp;h=50&amp;src=554998916_654242243_1232677585.jpeg"></a>
        </div>
        <div class="message-reply-message">
            <span class="message-reply-author" id="author-c-3"><a href="http://localhost/phpsocial//index.php?a=profile&amp;u=phu" rel="loadpage">phu</a></span>: <span id="comment_text3"></span>
            <div class="comment-image-thumbnail"><a onclick="gallery('180503509_2064233188_1208021343.jpg', 3, 'media', 2)" id="180503509_2064233188_1208021343.jpg"><img src="http://localhost/phpsocial//thumb.php?t=m&amp;w=200&amp;h=200&amp;src=180503509_2064233188_1208021343.jpg"></a></div>
        </div>
        <div class="message-reply-footer" id="comment-action3">
            <div class="message-time"><span class="like-comment"><a onclick="doLike(3, 1)" id="doLikeC3">Like</a> -&nbsp;</span>
                <span id="time-c-3">
                    <div class="timeago" title="2019-12-18T13:46:39+01:00">5 hours ago</div>
                </span>
                <div class="actions_btn loader" id="action-c-loader3"></div>
            </div>
        </div>
        <div class="delete_preloader" id="del_comment_3"></div>
    </div>
</div>