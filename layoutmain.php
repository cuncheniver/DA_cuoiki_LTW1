<?php 
ob_start();
require_once 'function.php';

if (!isset($_SESSION))
  {
    session_start();
  }
  $userId =$_SESSION['userId'];
  $profile = findProfile($userId);
   $currentUser= findUserById($userId); 
   
    
    
   if(!$currentUser)
   {
    
     header('location: Login.php');
     exit(0);
   }
?>
<html lang="en">

<head>

    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CX_DA</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:description" content="">

    <!-- ==============================================
		Favicons
		=============================================== -->
    <link rel="icon" href="img/logo.jpg">
    <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">

    <!-- ==============================================
		CSS
		=============================================== -->
        <link rel="stylesheet" href="./css/st1.css">
    <link type="text/css" href="css/demos/photo.css" rel="stylesheet">
    <link type="text/css" href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    

    <!-- ==============================================
		Feauture Detection
		=============================================== -->
    <script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    <script src='https://cdn.rawgit.com/jackmoore/zoom/master/jquery.zoom.min.js'></script>
    <script type="text/javascript"  src="js/functions.js"></script>
    <script type="text/javascript"  src="js/jquery.js"></script>
   
   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  -webkit-animation-name: fadeIn; /* Fade in the background */
  -webkit-animation-duration: 0.4s;
  animation-name: fadeIn;
  animation-duration: 0.4s
}

/* Modal Content */
.modal-content {
  position: fixed;
  bottom: 0;
  background-color: #fefefe;
  width: 100%;
  -webkit-animation-name: slideIn;
  -webkit-animation-duration: 0.4s;
  animation-name: slideIn;
  animation-duration: 0.4s
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 100px 30px}

.modal-footer {
  padding:  50px 30px;
  background-color: #5cb85c;
  color: white;
}

/* Add Animation */
@-webkit-keyframes slideIn {
  from {bottom: -300px; opacity: 0} 
  to {bottom: 0; opacity: 1}
}

@keyframes slideIn {
  from {bottom: -300px; opacity: 0}
  to {bottom: 0; opacity: 1}
}

@-webkit-keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}

@keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}
</style>
</head>
<body>
 <!-- ==============================================
     Navigation Section
     =============================================== -->
     <header class="tr-header">
    
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php"><i class="fa fa-meh-o"></i> CX</a>
                </div><!-- /.navbar-header -->
                <div class="navbar-left">
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>
                </div><!-- /.navbar-left -->
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li>
                            <div class="search-dashboard">
                                <form>
                                    <input placeholder="Search here" type="text">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a  class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-bell noti-icon"></i>
                                <span id="CNT">
                                
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <div class="dropdown-item noti-title">
                                    <h6 class="m-0">
                                        <span class="pull-right">
                                            <a href="" class="text-dark"><small>Clear All</small></a>
                                        </span>Notification
                                    </h6>
                                </div>

                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 416.983px;">
                                    <div class="slimscroll" style="max-height: 230px; overflow: hidden; width: auto; height: 416.983px;">
                                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 416.983px;">
                                            <div id="Slim" style="overflow: hidden; width: auto; height: 416.983px;">
                                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                    <div class="notify-icon bg-success"><i class="fa fa-comment"></i></div>
                                                    <p class="notify-details">noti ví dụ<small class="text-muted">1 min ago</small></p>
                                                </a>
                                                <!--/ dropdown-item-->
                                               
                                                <!--/ dropdown-item-->
                                            </div>
                                            <div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 8px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
                                            <div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: block; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
                                        </div>
                                        <!--/ .Slim-->
                                        <div class="slimScrollBar" style="background: rgb(158, 165, 171) none repeat scroll 0% 0%; width: 8px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
                                        <div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
                                    </div>
                                    <!--/ .slimscroll-->
                                </div>
                                <!--/ .slimScrollDiv-->
                                <a href="photo_notifications.html" class="dropdown-item text-center notify-all">
                                    View all <i class="fa fa-arrow-right"></i>
                                </a><!-- All-->
                            </div>
                            <!--/ dropdown-menu-->
                        </li>
                        
                       

                        <li class="dropdown mega-avatar">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <span class="avatar w-32"><img src="upload/<?php print_r($profile['user_image']); ?>" class="img-resonsive img-circle" alt="..." width="25" height="25"></span>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">
                                <?php print_r($_SESSION['username']) ?>
                                </span>
                            </a>
                            <div class="dropdown-menu w dropdown-menu-scale pull-right">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="profile.php"><span>Profile</span></a>
                                
                                <a class="dropdown-item" href="setting.php">Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="out.php">Sign out</a>
                                <a class="dropdown-item" href="home.php">Home</a>
                            </div>
                        </li><!-- /navbar-item -->

                    </ul><!-- /.sign-in -->
                </div><!-- /.nav-right -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->
        
    </header><!-- Page Header -->

    <!-- ==============================================
	 Navbar Second Section
	 =============================================== -->
  


<footer>
<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/base.js"></script>
    <script src="plugins/slimscroll/jquery.slimscroll.js"></script>
<script>
$('#Slim,#Slim2').slimScroll({
       height:"auto",
       position: 'right',
       railVisible: true,
       alwaysVisible: true,
       size:"8px",
   });		
</script>

</footer>
</body>