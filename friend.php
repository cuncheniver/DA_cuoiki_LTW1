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
                        <a href="#"><img class="img-fluid img-circle" src="assets/img/users/13.jpeg" alt="Image"></a>
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
		     <h4>Anna Morgan <i class="fa fa-check"></i></h4>
             <p>Welcome to the offical account of Anna Morgan. Success is in the PIXELS, <span class="hashtag">#pixels</span></p>
			 <small><span>www.themashabrand.com</span></small>
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

        <div class="row">

            <div class="col-lg-4">
                <a href="#myModal" data-toggle="modal">
                    <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/14.jpg') no-repeat;
		          background-size: cover;
                  background-position: center center;
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;">
                        <div class="explore-top">
                            <div class="explore-like"><i class="fa fa-heart"></i> <span>14,100</span></div>
                            <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/ col-lg-4 -->

            <div class="col-lg-4">
                <a href="#myModal" data-toggle="modal">
                    <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/18.jpg') no-repeat;
		          background-size: cover;
                  background-position: center center;
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;">
                        <div class="explore-top">
                            <div class="explore-like"><i class="fa fa-heart"></i> <span>100,100</span></div>
                            <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/ col-lg-4 -->

            <div class="col-lg-4">
                <a href="#myModal" data-toggle="modal">
                    <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/15.jpg') no-repeat;
		          background-size: cover;
                  background-position: center center;
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;">
                        <div class="explore-top">
                            <div class="explore-like"><i class="fa fa-heart"></i> <span>100</span></div>
                            <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/ col-lg-4 -->

        </div>
        <!--/ row -->

        <div class="row">

            <div class="col-lg-4">
                <a href="#myModal" data-toggle="modal">
                    <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/25.jpg') no-repeat;
		          background-size: cover;
                  background-position: center center;
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;">
                        <div class="explore-top">
                            <div class="explore-like"><i class="fa fa-heart"></i> <span>324</span></div>
                            <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/ col-lg-4 -->

            <div class="col-lg-4">
                <a href="#myModal" data-toggle="modal">
                    <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/36.jpg') no-repeat;
		          background-size: cover;
                  background-position: center center;
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;">
                        <div class="explore-top">
                            <div class="explore-like"><i class="fa fa-heart"></i> <span>1023</span></div>
                            <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/ col-lg-4 -->

            <div class="col-lg-4">
                <a href="#myModal" data-toggle="modal">
                    <div class="explorebox" style="background: linear-gradient( rgba(34,34,34,0.2), rgba(34,34,34,0.2)), url('assets/img/posts/26.jpg') no-repeat;
		          background-size: cover;
                  background-position: center center;
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;">
                        <div class="explore-top">
                            <div class="explore-like"><i class="fa fa-heart"></i> <span>40</span></div>
                            <div class="explore-circle pull-right"><i class="far fa-bookmark"></i></div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/ col-lg-4 -->

        </div>
        <!--/ row -->

    </div>
    <!--/ container -->
</section>