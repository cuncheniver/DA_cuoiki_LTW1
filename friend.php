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
   $userId =$_SESSION['userId'];
   $idpost=  findNewPostById($userId);
   $user=findUserById($_GET['id']);
   $profilefr = findProfile($_GET['id']);
    
   if(!$currentUser)
   {
    
     header('location: Login.php');
     exit(0);
   }
?>

<section class="user-profile">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="post-content">
                    <div class="author-post text-center">
                        <a href="#"><img class="img-fluid img-circle" src="upload/<?php print_r($profilefr['user_image']) ?>" alt="Image"></a>
                    </div><!-- /author -->
                </div><!-- /.post-content -->
            </div><!-- /col-sm-12 -->

        </div>
        <!--/ row-->
    </div>
    <!--/ container -->
</section>
<section class="details">
	  <div class="container">
	   <div class="row">
	    <div class="col-lg-12">
		 
          <div class="details-box row">
		   <div class="col-lg-9">
           <div class="content-box">
		     <h4><?php print_r($profilefr['user_fullName']) ?> <i class="fa fa-check"></i></h4>
             <p>Welcome to the offical account of <?php print_r($profilefr['user_fullName']) ?>. </p>
			 <small><span><?php print_r($profilefr['user_contact']) ?></span></small>
           </div><!--/ media -->
		   </div> 
		   <div class="col-lg-3">
           <div class="follow-box">
		    <a href="" class="kafe-btn kafe-btn-mint"><i class="fa fa-check"></i> Following</a>
           </div><!--/ dropdown -->
		   </div>
          </div><!--/ details-box -->
		  
		</div>
	   </div>
	  </div><!--/ container -->
	 </section>
     <section class="home-menu">
    <div class="container">
        <div class="row">

            <div class="menu-category">
                <ul class="menu">
                    <li class="current-menu-item"><a href="photo_profile.html">Posts <span>1.7k</span></a></li>
                    <li><a href="photo_followers.html">Followers <span>1.3M</span></a></li>
                    <li><a href="photo_followers.html">Following <span>1200</span></a></li>
                </ul>
            </div>

        </div>
        <!--/row -->
    </div>
    <!--/container -->
</section>
<section class="newsfeed">
    <div class="container">

    <div id="output"></div>
        <!--/ row -->
        <script>
   $(document).ready(function(){
        
    displaystt(<?php print_r($profilefr['user_ID']) ?>,<?php print_r($userId) ?>);
       
    
       
       <?php    $Id =$profilefr['user_ID'];
  

  $sql = "select * from post where uid = '$Id' ORDER BY id DESC";
  $result = mysqli_query($connect, $sql);
  while($row=mysqli_fetch_array($result))
  {?>
      displaycmt(<?php echo $row['id']?>,<?php print_r($userId) ?>);
   <?php } ?>
  




   });
   function displaystt(id,idk){
       $.ajax({
           url: "function.php",
           type: "POST",
           async: false,
           data:{
               "ID":id,
               "IDkhach":idk,
               "display":1
           },
           success: function (d) {
            $("#output").html(d); 
           }
       });
   }    
  
  

      </script>
    </div>
    <!--/ container -->
</section>