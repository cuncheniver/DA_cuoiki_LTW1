<?php 
ob_start();
require_once 'function.php';
include 'layoutmain.php';
if (!isset($_SESSION))
  {
    session_start();
  }
  $userId =$_SESSION['userId'];
   $currentUser= findUserById($userId); 
  

   if(!$currentUser)
   {
    
     header('location: Login.php');
     exit(0);
   }
?>
<body>

<!-- ==============================================
Navigation Section
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
         <a href="photo_profile_two.html">
          <img src="upload/admin.jpg" class="img-responsive img-circle" alt="User">
          <span class="online-status online"></span>
         </a>
        </div>
        <div class="detail">
         <h4>Vanessa Wells</h4>
         <small>@vanessa</small>                        
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
   <div class="message-form-content">
    <div class="message-form-header">
        <div class="message-form-user"><img src="http://localhost:8080/phpsocial//thumb.php?src=default.png&amp;t=a"></div>
        Update your status
        <div class="message-form-private"></div>
        <div class="message-loader" id="post-loader9999999999" style="visibility: hidden">
            <div class="preloader"></div>
        </div>
    </div>

    <div class="message-form-inner">
        <textarea id="post9999999999" class="message-form" placeholder="What's on your mind?" name="message" style="height: 28px;"></textarea>
    </div>
    <div id="plugins-forms" style="display: none;"></div>

    <input type="hidden" name="privacy" id="message-privacy" value="1">
    <input type="hidden" name="group" id="message-group" value="">
    <input type="hidden" name="page" id="message-page" value="">

    <div class="selected-files" id="queued-files"></div>
    <div class="message-form-input" style="display: none;"><input type="text" name="value" id="form-value"></div>
    <div id="values">
        <label id="open_images" title="Upload images"><img src="http://localhost:8080/phpsocial//themes/dolphin/images/icons/events/camera.svg"></label>
        <input type="radio" name="type" value="video" id="video" class="input_hidden"><label for="video" title="Share a movie or a link from YouTube or Vimeo"><img src="http://localhost:8080/phpsocial//themes/dolphin/images/icons/events/video.svg"></label>
        <input type="radio" name="type" value="map" id="map" class="input_hidden"><label for="map" title="Add a place"><img src="http://localhost:8080/phpsocial//themes/dolphin/images/icons/events/map.svg"></label>
        <input type="radio" name="type" value="visited" id="visited" class="input_hidden"><label for="visited" title="Add a visited location"><img src="http://localhost:8080/phpsocial//themes/dolphin/images/icons/events/visited.svg"></label>
        <input type="radio" name="type" value="music" id="music" class="input_hidden"><label for="music" title="Share a song or a link from SoundCloud"><img src="http://localhost:8080/phpsocial//themes/dolphin/images/icons/events/music.svg"></label>
        <input type="radio" name="type" value="game" id="game" class="input_hidden"><label for="game" title="Add a played game"><img src="http://localhost:8080/phpsocial//themes/dolphin/images/icons/events/game.svg"></label>
        <input type="radio" name="type" value="food" id="food" class="input_hidden"><label for="food" title="Add a place where you ate at"><img src="http://localhost:8080/phpsocial//themes/dolphin/images/icons/events/food.svg"></label>

        <input name="images[]" id="images" size="27" type="file" class="inputImage" title="Upload images" multiple="multiple" accept="image/*">
    </div>

    <div type="button" name="action" class="message-btn button-active" value="Post"><a onclick="startUpload()">Post</a></div>
    <div class="message-btn button-normal" onclick="messageMenu(9999999999, 1)" title="Who should see the message" id="privacy-button"><a>
            <div id="privacy-btn" class="privacy-icons public-icon"></div>
        </a></div>
    <div id="message-menu9999999999" class="message-menu-container message-menu-privacy">
        <div class="message-menu-row" onclick="postPrivacy(1)">Public</div>
        <div class="message-menu-row" onclick="postPrivacy(2)">Friends</div>
        <div class="message-menu-row" onclick="postPrivacy(0)">Private</div>
    </div>
</div>
    <div class="row">
    
     <div class="col-lg-6">
        <a href="#myModal" data-toggle="modal">
        <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/6.jpg') no-repeat;
                 background-size: cover;
                 background-position: center center;
                 -webkit-background-size: cover;
                 -moz-background-size: cover;
                 -o-background-size: cover;">
         <div class="explore-top">
          <div class="explore-like"><i class="fa fa-heart"></i> <span>312</span></div>
          <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
         </div>		  
        </div>
        </a>
     </div>
    
     <div class="col-lg-6">
        <a href="#myModal" data-toggle="modal">
        <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/9.jpg') no-repeat;
                 background-size: cover;
                 background-position: center center;
                 -webkit-background-size: cover;
                 -moz-background-size: cover;
                 -o-background-size: cover;">
         <div class="explore-top">
          <div class="explore-like"><i class="fa fa-heart"></i> <span>624</span></div>
          <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
         </div>		  
        </div>
        </a>
     </div>
     
    </div><!--/ row -->
    
    <div class="row">
    
     <div class="col-lg-6">
        <a href="#myModal" data-toggle="modal">
        <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/32.jpg') no-repeat;
                 background-size: cover;
                 background-position: center center;
                 -webkit-background-size: cover;
                 -moz-background-size: cover;
                 -o-background-size: cover;">
         <div class="explore-top">
          <div class="explore-like"><i class="fa fa-heart"></i> <span>12</span></div>
          <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
         </div>		  
        </div>
        </a>
     </div>
    
     <div class="col-lg-6">
        <a href="#myModal" data-toggle="modal">
        <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/30.jpg') no-repeat;
                 background-size: cover;
                 background-position: center center;
                 -webkit-background-size: cover;
                 -moz-background-size: cover;
                 -o-background-size: cover;">
         <div class="explore-top">
          <div class="explore-like"><i class="fa fa-heart"></i> <span>1499</span></div>
          <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
         </div>		  
        </div>
        </a>
     </div>
     
    </div><!--/ row -->
    
    <div class="row">
    
     <div class="col-lg-6">
        <a href="#myModal" data-toggle="modal">
        <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/19.jpg') no-repeat;
                 background-size: cover;
                 background-position: center center;
                 -webkit-background-size: cover;
                 -moz-background-size: cover;
                 -o-background-size: cover;">
         <div class="explore-top">
          <div class="explore-like"><i class="fa fa-heart"></i> <span>1742</span></div>
          <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
         </div>		  
        </div>
        </a>
     </div>
    
     <div class="col-lg-6">
        <a href="#myModal" data-toggle="modal">
        <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/8.jpg') no-repeat;
                 background-size: cover;
                 background-position: center center;
                 -webkit-background-size: cover;
                 -moz-background-size: cover;
                 -o-background-size: cover;">
         <div class="explore-top">
          <div class="explore-like"><i class="fa fa-heart"></i> <span>1269</span></div>
          <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
         </div>		  
        </div>
        </a>
     </div>
     
    </div><!--/ row -->
    
    <div class="row">
    
     <div class="col-lg-6">
        <a href="#myModal" data-toggle="modal">
        <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/36.jpg') no-repeat;
                 background-size: cover;
                 background-position: center center;
                 -webkit-background-size: cover;
                 -moz-background-size: cover;
                 -o-background-size: cover;">
         <div class="explore-top">
          <div class="explore-like"><i class="fa fa-heart"></i> <span>12456</span></div>
          <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
         </div>		  
        </div>
        </a>
     </div>
    
     <div class="col-lg-6">
        <a href="#myModal" data-toggle="modal">
        <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/25.jpg') no-repeat;
                 background-size: cover;
                 background-position: center center;
                 -webkit-background-size: cover;
                 -moz-background-size: cover;
                 -o-background-size: cover;">
         <div class="explore-top">
          <div class="explore-like"><i class="fa fa-heart"></i> <span>10945</span></div>
          <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
         </div>		  
        </div>
        </a>
     </div>
     
    </div><!--/ row -->
   
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