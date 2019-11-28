<?php 
ob_start();
require_once 'function.php';
include 'layoutmain.php';
if (!isset($_SESSION))
  {
    session_start();
  }
  $userId =$_SESSION['userId'];
  $profile = findProfile($userId);
   $currentUser= findUserById($userId); 
   $postbyUser= findAllPostsbyUser($userId);
    
    
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
        <div class="detail">
       

         <h4><?php print_r($profile['user_fullName']); ?></h4>
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
       <small class="text-muted"><a href="photo_profile_two.html">320 Posts <em class="fa fa-angle-right pull-right"></em></a> </small><br>
       <small class="text-muted"><a href="photo_followers.html">2456 Followers <em class="fa fa-angle-right pull-right"></em></a> </small><br>
       <small class="text-muted"><a href="photo_followers.html">456 Following <em class="fa fa-angle-right pull-right"></em></a> </small>
       <hr>
       <small class="text-muted">Bio: </small>
       <p>795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
       <hr>
       <small class="text-muted">Website: </small>
       <p>http://www.themashabrand.com </p> 
       <hr>                      
      </li>                    
     </ul>
    </aside>				
   </div><!--/ col-lg-3-->
   
   <div class="col-lg-6" style="background: #fff;">
   <div class="message-container">
	<form  name="form" action="function.php" method="POST" enctype="multipart/form-data">
		<div class="message-form-content">
			<div class="message-form-header">
				<div class="message-form-user"></div>
				Update your status
				<div class="message-form-private"></div>
				<div class="message-loader" id="post-loader9999999999" style="visibility: hidden"><div class="preloader"></div></div>
			</div>
			
			<div class="message-form-inner">
				<textarea id="post9999999999" class="message-form" placeholder="What's on your mind?" name="context"></textarea>
			</div>
			<div id="plugins-forms" style="display: none;"></div>
			
			
		
			
			<div class="selected-files" id="queued-files"></div>
			<div class="message-form-input"><input type="text" name="value" id="form-value"></div>
			<div id="values">
				<label id="open_images" title="Upload images"><img src="./image/icons/events/camera.svg"></label>
				<input type="radio" name="type" value="video" id="video" class="input_hidden"><label for="video" title="Share a movie or a link from YouTube or Vimeo"><img src="./image/icons/events/video.svg"></label>
			
				<input name="images[]" id="images" size="27" type="file" class="inputImage" title="Upload images" multiple="multiple" accept="image/*">
			</div>
			
			<button type="submit" name="action" class="message-btn button-active" ><a>Post</a></button>
	
		</div>
	
	</form>
</div>

    <div class="message-container last-message" id="message3" data-filter="" data-last="3" data-username="phu" data-type="1" data-userid="1">
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
                    <a href="http://localhost/phpsocial//index.php?a=profile&amp;u=phu" rel="loadpage">phu</a>
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

            </div>

        </div>
        <div class="message-divider"></div>
        <div class="message-type-image event-picture">
            <div class="image-container-padding">
              <a onclick="gallery('1320257503_78764593_2015581271.jpg', 3, 'media', 1)" id="1320257503_78764593_2015581271.jpg">
                    <div class="image-thumbnail-container">
                        <div class="image-thumbnail"><img src="http://localhost/phpsocial//thumb.php?t=m&amp;w=300&amp;h=300&amp;src=1320257503_78764593_2015581271.jpg"></div>
                    </div>
                </a></div>
        </div>
        <div class="message-divider"></div>
        <div class="message-replies">
            <div class="message-actions">
                <div class="message-actions-content" id="message-action3"><a onclick="doLike(3, 0)" id="doLike3">Like</a> - <a onclick="focus_form(3)">Comment</a> - <a onclick="share(3)">Share</a>
                    <div class="actions_btn loader" id="action-loader3"></div>
                </div>
            </div>
            <div class="message-replies-content" id="comments-list3">

            </div>
        </div>
        <div class="message-comment-box-container" id="comment_box_3">
            <div class="message-reply-avatar">
                <img src="upload/<?php print_r($profile['user_image']) ?>">
            </div>
            <div class="message-comment-box-form">
                <textarea id="comment-form3" onclick="showButton(3)" placeholder="Leave a comment..." class="comment-reply-textarea"></textarea>
                <label for="commentimage3" class="c-w-icon c-w-icon-picture comment-image-btn" title="Upload image" data-active-comment="3"></label>
            </div>
            <div class="comments-buttons">
                <div id="comments-controls3" class="comments-controls" style="display: none;">
                    <div class="comment-btn button-active">
                        <a id="post-comment" onclick="postComment(3)">Post</a>
                    </div>
                    <div id="queued-comment-files3"></div>
                </div>
                <input type="file" name="commentimage" id="commentimage3" style="display: none;" accept="image/*">
            </div>
            <div class="delete_preloader" id="post_comment_3"></div>
        </div>
      </div>
    </div>
   
   </div>
   <div class="col-lg-3">
   
    <div class="suggestion-box full-width">
       <div class="suggestions-list">
           <div class="suggestion-body">
               <img class="img-responsive img-circle" src="assets/img/users/1.jpg" alt="">
               <div class="name-box">
                   <h4>Vanessa Wells</h4>
                   <span>@vannessa</span>
               </div>
               <span><i class="fa fa-plus"></i></span>
           </div>
           <div class="suggestion-body">
               <img class="img-responsive img-circle" src="assets/img/users/2.jpg" alt="">
               <div class="name-box">
                   <h4>Anthony McCartney</h4>
                   <span>@antony</span>
               </div>
               <span><i class="fa fa-plus"></i></span>
           </div>
           <div class="suggestion-body">
               <img class="img-responsive img-circle" src="assets/img/users/3.jpg" alt="">
               <div class="name-box">
                   <h4>Anna Morgan</h4>
                   <span>@anna</span>
               </div>
               <span><i class="fa fa-plus"></i></span>
           </div>
           <div class="suggestion-body">
               <img class="img-responsive img-circle" src="assets/img/users/4.jpg" alt="">
               <div class="name-box">
                   <h4>Sean Coleman</h4>
                   <span>@sean</span>
               </div>
               <span><i class="fa fa-plus"></i></span>
           </div>
           <div class="suggestion-body">
               <img class="img-responsive img-circle" src="assets/img/users/5.jpg" alt="">
               <div class="name-box">
                   <h4>Grace Karen</h4>
                   <span>@grace</span>
               </div>
               <span><i class="fa fa-plus"></i></span>
           </div>
           <div class="suggestion-body">
               <img class="img-responsive img-circle" src="assets/img/users/6.jpg" alt="">
               <div class="name-box">
                   <h4>Clifford Graham</h4>
                   <span>@clifford</span>
               </div>
               <span><i class="fa fa-plus"></i></span>
           </div>
       </div><!--suggestions-list end-->
   </div>	

   <div class="trending-box">
    <div class="row">
     <div class="col-lg-12">
       <h4>Trending Photos</h4>
     </div>
    </div>
   </div>
   
   <div class="trending-box">
    <div class="row">
     <div class="col-lg-6">
      <a href="#"><img src="assets/img/posts/17.jpg" class="img-responsive" alt="Image"></a>
     </div>
     <div class="col-lg-6">
      <a href="#"><img src="assets/img/posts/12.jpg" class="img-responsive" alt="Image"></a>
     </div>
    </div>
    <div class="row">
     <div class="col-lg-6">
      <a href="#"><img src="assets/img/posts/21.gif" class="img-responsive" alt="Image"></a>
     </div>
     <div class="col-lg-6">
      <a href="#"><img src="assets/img/posts/23.gif" class="img-responsive" alt="Image"></a>
     </div>
    </div>
    <div class="row">
     <div class="col-lg-6">
      <a href="#"><img src="assets/img/posts/11.jpg" class="img-responsive" alt="Image"></a>
     </div>
     <div class="col-lg-6">
      <a href="#"><img src="assets/img/posts/20.jpg" class="img-responsive" alt="Image"></a>
     </div>
    </div>
   </div>		
   
   
   </div>
   
  </div><!--/ row-->	
 </div><!--/ container -->
</section><!--/ profile -->

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