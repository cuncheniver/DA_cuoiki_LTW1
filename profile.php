<?php 
ob_start();
require_once 'function.php';
include 'layoutmain.php';
error_reporting(0);
if (!isset($_SESSION))
  {
    session_start();
  }
  $userId =$_SESSION['userId'];
  $profile = findProfile($userId);
   $currentUser= findUserById($userId); 
   $postbyUser= findAllPostsbyUser($userId);
   $userId =$_SESSION['userId'];
   $idpost=  findNewPostById($userId);
 
    
   if(!$currentUser)
   {
    
     header('location: Login.php');
     exit(0);
   }
?>
<body>

<!-- ==============================================
Navigation Sectionf
=============================================== -->  


<!-- ==============================================
News Feed Section
=============================================== --> 
<section class="profile-two">
 <div class="container-fluid">
  <div class="row">

   <div class="col-lg-3">
    <aside id="leftsidebar" class="sidebar">		  
     <ul class="list">
      <li>
       <div class="user-info">
        <div class="image">
       
         <a   href="">
          <img id="map"  src="upload/<?php print_r($profile['user_image']); ?>" class="img-responsive img-circle" alt="User">
          <span class="online-status online"></span>
         </a>
        </div>
        <h2>Edit Profile</h2>

<!-- Trigger/Open The Modal -->
<button id="myBtn">Edit</button>
<button id="CP" onclick="changeP(1)">Change passwords</button>
<script>  function changeP(id){ 

} </script>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Edit Profile</h2>
    </div>
    <div class="modal-body">
    <div class="row" style="padding-left:20%;">
    <div class="col-lg-2">
    <script type="text/javascript">
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                  $('#ns').css('background-image', 'url(' + e.target.result+ ')','center center;');
                          
                    
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
   
   
    </div>
    <div class="col-lg-8" >
    <div class="form-content">
    
                 
                 <form  action="function.php" method="POST" enctype="multipart/form-data">

<input id="ns"  onchange="readURL(this);" type="file" name="image" accept="image/gif, image/jpeg, image/png" for="avatarselect" class="page-input-title-img" style="background: url(upload/<?php print_r($profile['user_image']); ?>) center center;background-size: cover !important;">


                            <div class="form-group"><label for="username">Full Name</label><input type="text" id="name" name="name" required="required"    value="<?php print_r($profile['user_fullName']); ?>   "        /> </div>
                            <div class="form-group"><label for="phone">Phone</label><input type="tel" id="phone" name="phone" required="required" value=<?php print_r($profile['user_contact']); ?> /></div>
             
                            <div class="form-group"><button name="Save" type="submit">Save</button></div>
                        </form>
                    </div>
    </div>
    </div>
   
    </div>
  
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>  function changeP(id){ 

var modal1 = document.getElementById("changePas");
if(modal1.style.display == "block")
modal1.style.display = "none";
else
modal1.style.display = "block";

}
function up(){
     console.log("ok");
      passcu = $('#passcu').val();
      passmoi = $('#passmoi').val();
      passmoi2 = $('#passmoi2').val();
      if(passmoi == passmoi2) {

      $.ajax({
           url: "function.php",
           type: "POST",
           async: false,
           data:{
               "passcux" :passcu,
               "passmoi" : passmoi,
               
           },
           success: function (d) {
            $("#error").html(d); 
           }
       });

      } 
    else{
      $('#error').html("mật khẩu nhập lại không khớp");
    }    
        
  
    }
       

</script>
        <div class="detail">
       <div id="changePas" style="display:none;padding-top:10px" >

                          <div id="error"> </div>        
                          <div class="form-group"><label for="username">MẬT KHẨU HIỆN TẠI</label><input type="password" id="passcu" name="passcu" required="required"        /> </div>
                          <div class="form-group"><label for="phone">MẬT KHẨU MỚI</label><input type="password" id="passmoi" name="passmoi" required="required"  /></div>
                          <div class="form-group"><label for="phone"> NHẬP LẠI MẬT KHẨU MỚI</label><input type="password" id="passmoi2" name="passmoi" required="required"  /></div>
           
                          <button  onclick="up()" name="SaveC">Save</button>  
                   
                      <script> 
                    

                       </script>
</div>

         <h4><?php print_r($profile['user_fullName']); 
          print_r($idpost['id']);
         ?></h4>
        <small> Contact: <?php print_r($profile['user_contact']); ?> </small>                        
        </div>
        <div class="row">
         <div class="col-12">
          <a title="facebook" href="#" class=" waves-effect waves-block"><i class="fa fa-facebook"></i></a>
          <a title="twitter" href="#" class=" waves-effect waves-block"><i class="fa fa-twitter"></i></a>
          <a title="instagram" href="#" class=" waves-effect waves-block"><i class="fa fa-instagram"></i></a>
         </div>                                
        </div>
       </div>
      </li>
      <li>
       <small class="text-muted"><a href="photo_profile_two.html"><?php  $s = countPost($profile['id']); echo $s['post'] ; ?>Posts <em class="fa fa-angle-right pull-right"></em></a> </small><br>
       <small class="text-muted"><a href="photo_followers.html"><?php  $s = countFollower($profile['id']); echo $s['fl'] ; ?> Followers <em class="fa fa-angle-right pull-right"></em></a> </small><br>
       <small class="text-muted"><a href="photo_followers.html"><?php  $s = countFollowing($profile['id']); echo $s['fl'] ; ?> Following <em class="fa fa-angle-right pull-right"></em></a> </small>
         
      </li>                    
     </ul>
     
    </aside>				
   </div><!--/ col-lg-3-->
   
   <div class="col-lg-6" style="background: #fff;margin-top:20px">
   <div class="message-container">
	<form  name="f"  method="POST" enctype="multipart/form-data" id="fileUploadForm">
		<div class="message-form-content">
			<div class="message-form-header">
				<div class="message-form-user"></div>
				Update your status
				<div class="message-form-private"></div>
				<div class="message-loader" id="post-loader9999999999" style="visibility: hidden"><div class="preloader"></div></div>
			</div>
			
			<div class="message-form-inner">
				<textarea id="post9999999999" id="content" class="message-form" placeholder="What's on your mind?" name="context"></textarea>
			</div>
			<div id="plugins-forms" style="display: none;"></div>
			
			
		
			
			<div class="selected-files" id="queued-files"></div>
      <div class="message-btn button-normal" onclick="messageMenu(9999999999, 1)" title="Who should see the message" id="privacy-button"><a>
        <div  id="privacy-btn" class="privacy-icons public-icon" value="xx"></div>
        <input id="sos" name="trangthai" type="text"  size="27" value="1" style="display:none" >
		
    </a></div>
    <div id="message-menu9999999999" class="message-menu-container message-menu-privacy message-menu-active">
    <div class="message-menu-row" onclick="postPrivacy(1)">Public</div>
    <div class="message-menu-row" onclick="postPrivacy(2)">Friends</div>
    <div class="message-menu-row" onclick="postPrivacy(0)">Private</div>
    </div>
			<div class="message-form-input"><input type="text" name="value" id="form-value"></div>
			<div id="values">
				<label id="open_images" title="Upload images"><img src="./image/icons/events/camera.svg"></label>
				<input type="radio" name="type" value="video" id="video" class="input_hidden"><label for="video" title="Share a movie or a link from YouTube or Vimeo"><img src="./image/icons/events/video.svg"></label>
			
				<input name="images[]" id="images" size="27" type="file" class="inputImage" title="Upload images" multiple="multiple" accept="image/*">
			</div>
			
			<button type="submit" id="action" value="POST" name="action" class="message-btn button-active" ><a>Post</a></button>
	
		</div>
	
	</form>
</div>

    <div class="message-container last-message" id="ok">
    
    </div>
    <div id="output"></div>
    <div id="likes" class="modal-large" style="display: none;">
      <div class="modal-container modal-container-large">
        <div class="modal-inner">
            <div class="modal-title">Likes</div>
        </div>
        <div class="message-divider"></div>
        <div class="modal-inner modal-inner-large">
            <div id="likes-result" class="modal-listing-results scrollable">
               
            </div>
        </div>
        <div class="message-divider"></div>
        <div class="modal-menu">
            <div class="modal-cancel button-normal" id="delete-cancel"><a onclick="likesModal(0, 0, 1)">Close</a></div>
      </div>
    </div>
</div>
   </div>
   
   <script>
   $(document).ready(function(){
    
    displaystt(<?php echo $_SESSION['userId']?>,<?php echo $_SESSION['userId']?>);
       
    
       
       <?php    $userId =$_SESSION['userId'];
  

  $sql = "select * from post where uid = '$userId' ORDER BY id DESC";
  $result = mysqli_query($connect, $sql);
  while($row=mysqli_fetch_array($result))
  {?>
      DisplayLike(<?php echo $row['id']?>,0);
      displaycmt(<?php echo $row['id']?>);
      <?php    $cmtID = $row['id'];
  ?>
      <?php

$sql2 = "select * from comments  where postid = '$cmtID' ORDER BY id DESC";
$result2 = mysqli_query($connect, $sql2);
while($row2=mysqli_fetch_array($result2))
{?>

  DisplayLike(<?php echo $row2['id']?>,1);
    
  



 <?php } ?>
   <?php } ?>
   var x= setInterval(function(){
    
    countNT(<?php echo $_SESSION['userId'] ?>);
    loadNoti(<?php echo $_SESSION['userId'] ?>); 
    ListFr(<?php echo $_SESSION['userId']?>);
 
  },1000);
  
    $("form#fileUploadForm").submit(function(event){
 
 //disable the default form submission
 event.preventDefault();

 //grab all form data  
 var formData = new FormData($(this)[0]);
 
 $.ajax({
   url: 'function.php',
   type: 'POST',
   data: 
     formData,
   async: false,
   cache: false,
   contentType: false,
   processData: false,
   success: function (returndata) {
      console.log(returndata);
      displaystt(<?php echo $_SESSION['userId']?>,<?php echo $_SESSION['userId']?>);
      <?php    $userId =$_SESSION['userId'];
  

  $sql = "select * from post where uid = '$userId' ORDER BY id DESC";
  $result = mysqli_query($connect, $sql);
  while($row=mysqli_fetch_array($result))
  {?>
      DisplayLike(<?php echo $row['id']?>,0);
      displaycmt(<?php echo $row['id']?>);
   <?php } ?>
    
   }
 });
 
 return false;
});




   });
   function displaystt(id,idk){
       $.ajax({
           url: "function.php",
           type: "POST",
           async: false,
           data:{
               "ID" :id,
               "IDkhach" : idk,
               "display":1
           },
           success: function (d) {
            $("#output").html(d); 
           }
       });
   }    
   function likesModal(id, type, close) {
	// Type 0: Message, Type 1: Comment
	if(close) {
		hideModal();
	} else {
		$('#likes').fadeIn();
		$('.modal-background').fadeIn();
		$('#likes-result').html('<div class="modal-listing-load-more"><div class="preloader preloader-center"></div></div>');
		$.ajax({
			type: "POST",
			url: "function.php",
			data: "ID="+id+"&extra="+type+"&listLikes="+type, 
			cache: false,
			success: function(html) {
				$('#likes-result').html(html);
			}
		});
	}
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
   function ListFr(id)
   {
    $.ajax({
		type: "POST",
        url: "function.php",
        async: true,
        data: "idList="+id, 
        
		
		success: function(html) {
			$('#friends-list').html(html);
		}
	});
   }
   function openChatWindow1(id) {
	var checkWindow = $('#chat-window-'+id).html();
	if(!checkWindow) {
        
        
        
        $.ajax({
		type: "POST",
        url: "function.php",
        async: true,
        data: "idFr="+id, 
        
		
		success: function(html) {
            $('.bc-container').append(html);

            
            var x= setInterval(function(){
                LoadChat(id);
                if($('#chat-container-'+id).length) {
				$('#chat-container-'+id).scrollTop($('#chat-container-'+id+'.chat-container')[0].scrollHeight);
			}
			if($('#bc-friends-chat-'+id).length) {
				$('#bc-friends-chat-'+id).scrollTop($('#bc-friends-chat-'+id+'.bc-friends-chat')[0].scrollHeight);
			}

 
  },1000);
		}
	});
	
	}
	
}
function LoadChat(id1)
   {
    $.ajax({
		type: "POST",
        url: "function.php",
        async: true,
        data: "IDchat1="+id1, 
        
		
		success: function(html) {
			$('#bc-friends-chat-'+id1).html(html);
		}
	});
   }
   function postChatt(id) {
    console.log(id);

	
		var message = $('input#c-w-'+id).val();
		$('#c-w-'+id).hide();
		$('#c-w-p-'+id).show();

	// Reset the chat input area
	$('#c-w-'+id).val('');
	$('.chat-user'+id).val('');
	
	
	$.ajax({
		type   : "POST",
		url: "function.php",
		data: 'messagee='+encodeURIComponent(message)+'&iid='+id,
		cache: false,
		success: function(html) {
			
		// Append the new chat to the div chat container
        $('#bc-friends-chat-'+id).append(html);
			$('#chat-container-'+id).append(html);
			
				$('#c-w-'+id).show();
				$('#c-w-'+id).focus();
				$('#c-w-p-'+id).hide();
			
                if($('#chat-container-'+id).length) {
				$('#chat-container-'+id).scrollTop($('#chat-container-'+id+'.chat-container')[0].scrollHeight);
			}
			if($('#bc-friends-chat-'+id).length) {
				$('#bc-friends-chat-'+id).scrollTop($('#bc-friends-chat-'+id+'.bc-friends-chat')[0].scrollHeight);
			}
		
		
		}
	});
}

      </script>

<div class="col-lg-3">
<center><div class="suggestion-box full-width">
<h2>Gợi ý kết bạn</h2>
</div> 
<div class="suggestion-box full-width">
    <div class="suggestions-list">
      <?php 
    
      

   

$sql = "SELECT * FROM login l join profile p on l.id = p.user_ID and l.id !=$userId";
$result = mysqli_query($connect, $sql);
while($row=mysqli_fetch_array($result))
{
  $relationship= findRelationship($currentUser['id'],$row['id']);
  $isFriend = count($relationship)===2;
?>  
<?php if(!$isFriend) {?>
        <div class="suggestion-body">
            <img class="img-responsive img-circle" src="upload/<?php print_r($row['user_image']) ?>" alt="Image">
            <div class="name-box">
            <a href="friend.php?id=<?php print_r($row['user_ID']) ?>"> <h4><?php echo $row['user_fullName']?></h4></a>
                <span>@<?php echo $row['user_name']?></span>
            </div>
            <span><i class="fa fa-plus"></i></span>
        </div>
<?php }?>
<?php }?>
      
    </div>
    
    <!--suggestions-list end-->
</div>






</div>
   
 
   

   
   
   </div>
   
  </div><!--/ row-->	
 </div><!--/ container -->
</section><!--/ profile -->
<?php 
include 'bcfrien.php';

?>
<!-- ==============================================
Modal Section
=============================================== -->
<div id="myModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-body">
   
    <div class="row">
    
     <div class="col-md-8 modal-image">
      <img class="img-responsive" src="assets/img/posts/9.jpg" alt="Image">
     </div><!--/ col-md-8 -->
     <div class="col-md-4 modal-meta">
      <div class="modal-meta-top">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <span aria-hidden="true">×</span><span class="sr-only">Close</span>
       </button><!--/ button -->
       <div class="img-poster clearfix">
        <a href=""><img class="img-responsive img-circle" src="assets/img/users/18.jpg" alt="Image"></a>
        <strong><a href="">Benjamin</a></strong>
        <span>12 minutes ago</span><br>
        <a href="" class="kafe kafe-btn-mint-small"><i class="fa fa-check-square"></i> Following</a>
       </div><!--/ img-poster -->
         
       <ul class="img-comment-list">
        <li>
         <div class="comment-img">
          <img src="assets/img/users/17.jpeg" class="img-responsive img-circle" alt="Image">
         </div>
         <div class="comment-text">
          <strong><a href="">Anthony McCartney</a></strong>
          <p>Hello this is a test comment.</p> <span class="date sub-text">on December 5th, 2016</span>
         </div>
        </li><!--/ li -->
        <li>
         <div class="comment-img">
          <img src="assets/img/users/15.jpg" class="img-responsive img-circle" alt="Image">
         </div>
         <div class="comment-text">
          <strong><a href="">Vanessa Wells</a></strong>
          <p>Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span>on December 5th, 2016</span>
         </div>
        </li><!--/ li -->
        <li>
         <div class="comment-img">
          <img src="assets/img/users/14.jpg" class="img-responsive img-circle" alt="Image">
         </div>
         <div class="comment-text">
          <strong><a href="">Sean Coleman</a></strong>
          <p class="">Hello this is a test comment.</p> <span class="date sub-text">on December 5th, 2016</span>
         </div>
        </li><!--/ li -->
        <li>
         <div class="comment-img">
          <img src="assets/img/users/13.jpeg" class="img-responsive img-circle" alt="Image">
         </div>
         <div class="comment-text">
          <strong><a href="">Anna Morgan</a></strong>
          <p class="">Hello this is a test comment.</p> <span class="date sub-text">on December 5th, 2016</span>
         </div>
        </li><!--/ li -->
        <li>
         <div class="comment-img">
          <img src="assets/img/users/3.jpg" class="img-responsive img-circle" alt="Image">
         </div>
         <div class="comment-text">
          <strong><a href="">Allison Fowler</a></strong>
          <p class="">Hello this is a test comment.</p> <span class="date sub-text">on December 5th, 2016</span>
         </div>
        </li><!--/ li -->
       </ul><!--/ comment-list -->
         
       <div class="modal-meta-bottom">
        <ul>
         <li><a class="modal-like" href="#"><i class="fa fa-heart"></i></a><span class="modal-one"> 786,286</span> | 
             <a class="modal-comment" href="#"><i class="fa fa-comments"></i></a><span> 786,286</span> </li>
         <li>
          <span class="thumb-xs">
           <img class="img-responsive img-circle" src="assets/img/users/13.jpeg" alt="Image">
          </span>
          <div class="comment-body">
            <input class="form-control input-sm" type="text" placeholder="Write your comment...">
          </div><!--/ comment-body -->	
         </li>				
        </ul>				
       </div><!--/ modal-meta-bottom -->
         
      </div><!--/ modal-meta-top -->
     </div><!--/ col-md-4 -->
     
    </div><!--/ row -->
   </div><!--/ modal-body -->
   
  </div><!--/ modal-content -->
 </div><!--/ modal-dialog -->
</div><!--/ modal -->	 
  
<!-- ==============================================
Scripts
=============================================== -->




</body>