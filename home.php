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

   

    <!-- ============================================ -->
    <!-- secssion new feed-->
    <section class="profile-two">
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-3">
        <aside id="leftsidebar" class="sidebar">		  
        <ul class="list">
          <li>
          <div class="user-info">
 
        <!-- The Modal -->
        <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
         
          <div class="modal-body">
          <div class="row" style="padding-left:20%;">
          <div class="col-lg-2">
         
   
   
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
                             
        </div>
       
        </li>
        <li>
        <small class="text-muted"><a href="photo_profile_two.html"> Group <em class="fa fa-angle-right pull-right"></em></a> </small><br>
        <small class="text-muted"><a href="photo_followers.html"> Friend <em class="fa fa-angle-right pull-right"></em></a> </small><br>
        <small class="text-muted"><a href="photo_followers.html"> Game <em class="fa fa-angle-right pull-right"></em></a> </small>
        
          </aside>				
        </div><!--/ col-lg-3-->
        
        <div class="col-lg-6" style="background: #fff;">
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
            </div>
            <script>
            $(document).ready(function(){
                displaystt();
              $("form#fileUploadForm").submit(function(event){
          
      //disable the default form submission
      event.preventDefault();

      //grab all form data  
      var formData = new FormData($(this)[0]);

 $.ajax({
   url: 'function.php',
   type: 'POST',
   data: formData,
   async: false,
   cache: false,
   contentType: false,
   processData: false,
   success: function (returndata) {
       displaystt();
    $("textarea").val('');
    $("input").val('');
   }
 });
 
 return false;
});



   });
   function displaystt(){
       $.ajax({
           url: "function.php",
           type: "POST",
           async: false,
           data:{
               "display":1
           },
           success: function (d) {
            $("#output").html(d); 
           }
       });
   }    
   function displaycmt(){
       $.ajax({
           url: "function.php",
           type: "POST",
           async: false,
           data:{
               "displaycmt":1
           },
           success: function (d) {
            $("#output").html(d); 
           }
       });
   }   
      </script>
   

   
   
   </div>
   
  </div><!--/ row-->	
 </div><!--/ container -->
</section><!--/ profile -->
<?php
    include 'footer.php';
?>
