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
   $user=findUserById($_GET['id']);
   $relationship= findRelationship($currentUser['id'],$user['id']);
   $isFriend = count($relationship)===2;
   $follow= findfollow($currentUser['id'],$user['id']);
   $isFollow = count($follow)===1;
   $noRelationship = count($relationship)===0;
   
   $noFollow = count($follow)===0;
   if(count($relationship)===1)
   {
       $isRequesting= $relationship[0]['user1Id']===$currentUser['id'];
   }
   
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
           <?php  if ( $user['id']!== $currentUser['id']):
?>
<form action="fr.php" method="POST">


<input type="hidden" name="id" value="<?php echo $user['id']?>" >
<?php if($isFriend):?>

<input type="submit" name="action" class="btn btn-primary" value="Xoa ket ban" >
<?php elseif($noRelationship):?>
<input type="submit" name="action" class="btn btn-primary" value="gui yeu cau ket ban" >
<?php else: ?>
<?php if(!$isRequesting):?>
<input type="submit" name="action" class="btn btn-primary" value="chap nhan ket ban" >
<?php endif; ?>
<input type="submit" name="action" class="btn btn-primary" value="huy yeu cau ket ban" >
<?php  endif;?> 
<?php if($isFollow):?>
    <a href="" class="kafe-btn kafe-btn-mint"><i class="fa fa-check"></i> Following</a>
         
<input type="submit" name="action" class="btn btn-primary" value="Bõ theo dõi" >
<?php elseif($noFollow):?>
    <div class="follow-box">
    
<input class="kafe-btn kafe-btn-mint" type="submit" name="action" class="btn btn-primary" value="Theo dõi">
</div>
<?php  endif;?> 

</form>

<?php  endif;?> 
           <div class="follow-box">
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
                    <li class="current-menu-item"><a href="photo_profile.html">Posts <span><?php  $s = countPost($_GET['id']); echo $s['post'] ; ?> </span></a></li>
                    <li class="current-menu-item"><a href="photo_profile.html">Friends <span><?php  $s = countFrends($_GET['id']); echo $s['fr'] ; ?> </span></a></li>
                    <li><a href="photo_followers.html">Followers <span><?php  $s = countFollower($_GET['id']); echo $s['fl'] ; ?></span></a></li>
                    <li><a href="photo_followers.html">Following <span><?php  $s = countFollowing($_GET['id']); echo $s['fl'] ; ?></span></a></li>
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
        <!--/ row -->
        <script>
   $(document).ready(function(){
       $fr=0;
    <?php if($isFriend) {?>
        $fr =1;
    <?php }?>
    
    displaystt(<?php print_r($profilefr['user_ID']) ?>,<?php print_r($userId) ?>,$fr);
       
    
       
       <?php    $Id =$profilefr['user_ID'];
  

  $sql = "select * from post where uid = '$Id' ORDER BY id DESC";
  $result = mysqli_query($connect, $sql);
  while($row=mysqli_fetch_array($result))
  {?>
  DisplayLike(<?php echo $row['id']?>,0);
      displaycmt(<?php echo $row['id']?>,<?php print_r($userId) ?>);
   <?php } ?>
  

   var x= setInterval(function(){
    
    countNT(<?php echo $_SESSION['userId'] ?>);
    loadNoti(<?php echo $_SESSION['userId'] ?>); 
 
  },1000);
  

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
  

      </script>
    </div>
    <!--/ container -->
</section>
</body>