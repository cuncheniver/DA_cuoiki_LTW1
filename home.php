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
              
        
        <?php    
      
        
      $sql0 = "select id from login";
      $result0 = mysqli_query($connect, $sql0);   
        while($row0=mysqli_fetch_array($result0))
      {?>
    
            <div id="output<?php echo $row0['id'] ?>"></div>
       <?php } ?>
              
            </div>
            <script>
   $(document).ready(function(){
        
    <?php    
  
    $idd = $_SESSION['userId'];
  $sql0 = "select id from login";
  $result0 = mysqli_query($connect, $sql0);   
    while($row0=mysqli_fetch_array($result0))
  {?>
  <?php 
   $relationship= findRelationship($idd,$row0['id']);
   $isFriend = count($relationship)===2;
   ?>
   $fr=0;
    <?php if($isFriend) {?>
        $fr =1;
    <?php }?>
    displaystt(<?php echo $row0['id'] ?>,<?php echo $idd?>,$fr);
    <?php    $pID = $row0['id'];
  

  $sql = "select * from post  where uid = '$pID' ORDER BY id DESC";
  $result = mysqli_query($connect, $sql);
  while($row=mysqli_fetch_array($result))
  {?>
      displaycmt(<?php echo $row['id']?>);
   <?php } ?>
   <?php } ?>
    
       
    
       
      
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
       
    
   }
 });
 
 return false;
});




   });
   function displaystt(id,idk,isfr){
       $.ajax({
           url: "function.php",
           type: "POST",
           async: false,
           data:{
                "ID":id,
               "IDkhach":idk,
               "isFriend":isfr,
               "display":1
           },
           success: function (d) {            
            $("#output"+id).html(d); 
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
