<?php require_once("../../config/initialize.php"); 
use app\config\Connection;
use app\config\Functions;
use app\includes\Tasks;
use app\config\Session;
use app\includes\Meeting;

$session = new Session;
$functions = new Functions;
$pdo = new Connection;
$meeting = new Meeting($pdo);
$task = new Tasks($pdo);

if(empty($_SESSION["user_token"])) {
	$functions->redirect_to("../staff.php");
} else {

	if(isset($_REQUEST['token'])){
		$queryStrToken = isset($_GET['token']) ? $_GET['token'] : '';
		$token = isset($_SESSION['user_token']) ? $_SESSION['user_token'] : '';
		$loggedout = $session->logout($token, $queryStrToken);

		if ($loggedout) {
			$functions->redirect_to("../staff.php");
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Meeting Management System</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="CodedThemes">
      <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="CodedThemes">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/css/bootstrap.min.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
   </head>
   <body>
      <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
      <nav class="navbar header-navbar pcoded-header">
         <div class="navbar-wrapper">
            <div class="navbar-logo">
               <a class="mobile-menu" id="mobile-collapse" href="#!">
               <i class="ti-menu"></i>
               </a>
               <a class="mobile-search morphsearch-search" href="#">
               <i class="ti-search"></i>
               </a>
               <a href="#">
                  <h4>Welcome <?php echo $_SESSION['userType']; ?></h4>
               </a>
               <a class="mobile-options">
               <i class="ti-more"></i>
               </a>
            </div>
            <div class="navbar-container container-fluid">
               <ul class="nav-left">
                  <li>
                     <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                  </li>
               </ul>
               <ul class="nav-right">
                  <li class="header-notification">
                     <a href="#!">
                     <i class="ti-bell"></i>
                     <span class="badge bg-c-pink"></span>
                     </a>
                     <ul class="show-notification">
                        <li>
                           <h6>Notifications</h6>
                           <label class="label label-danger">New</label>
                        </li>
                        <li>
                           <div class="media">
                              <img class="d-flex align-self-center img-radius" src="./../images/avatar.jpg" alt="Generic placeholder image">
                              <div class="media-body">
                                 <h5 class="notification-user"></h5>
                                 <p class="notification-msg"></p>
                                 <span class="notification-time"></span>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="media">
                              <img class="d-flex align-self-center img-radius" src="../../images/avatar.jpg" alt="Generic placeholder image">
                              <div class="media-body">
                                 <h5 class="notification-user">Joseph William</h5>
                                 <p class="notification-msg"></p>
                                 <span class="notification-time"></span>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="media">
                              <img class="d-flex align-self-center img-radius" src="../assets/images/avatar-4.jpg" alt="Generic placeholder image">
                              <div class="media-body">
                                 <h5 class="notification-user">Sara Soudein</h5>
                                 <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                 <span class="notification-time">30 minutes ago</span>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </li>
                  <li class="user-profile header-notification">
                     <a href="#!">
                     <img src="../../images/avatar.jpg" class="img-radius" alt="User-Profile-Image">
                     <span></span>
                     <i class="ti-angle-down"></i>
                     </a>
                     <ul class="show-notification profile-notification">
                        <li>
                           <a href="setting.php">
                           <i class="ti-settings"></i> Settings
                           </a>
                        </li>
                        <li>
                           <a href="profile.php">
                           <i class="ti-user"></i> Profile
                           </a>
                        </li>
                        <li>
                           <a href="?token=<?php echo $_SESSION['user_token']; ?>">
                           <i class="ti-layout-sidebar-left"></i> Logout
                           </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="pcoded-main-container">
         <div class="pcoded-wrapper">
            <?php include "nav.php"; ?>
            <div class="pcoded-content">
               <div class="pcoded-inner-content">
                  <div class="main-body">
                     <div class="page-wrapper">
                        <div class="page-body">
                           <div class="row">
                           	<style type="text/css">
                               .income h4 {
                                     text-align: left;
                                     margin-top: 0px;
                                     font-size: 30px;
                                     margin-bottom: 0px;
                                     padding-bottom: 0px;
                                 }


                                 .db .icon {
                                     color: #fff;
                                     font-size: 55px;
                                     margin-top: 7px;
                                     margin-bottom: 0px;
                                     float: right;
                                 }

                             </style>
                           <!-- card1 start -->
                           <!-- Statestics Start -->
                           <div class="col-md-4 ">
                              <div class="card income db mbm bg-info">
                                 <div class="card-body">

                                        <p class="icon">
                                            <i class="icon fa fa-layers"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?php echo $task->countTasks("SELECT COUNT(*) FROM `listtask` WHERE `createdBy`='{$_SESSION['userId']}'"); ?></span></h4>
                                        <p class="description">
                                            Tasks</p>
                                      <!-- /.info-box -->
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-4 ">
                              <div class="card income db mbm bg-success">
                                 <div class="card-body">

                                        <p class="icon">
                                            <i class="icon fa fa-layers"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?php echo $task->countCompletedTasks("SELECT COUNT(*) FROM `listtask` WHERE `createdBy`='{$_SESSION['userId']}' AND `status`='completed'"); ?></span></h4>
                                        <p class="description">
                                            Completed Task</p>
                                      <!-- /.info-box -->
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-4 ">
                              <div class="card income db mbm bg-warning">
                                 <div class="card-body">

                                        <p class="icon">
                                            <i class="icon fa fa-layers"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?php echo $meeting->countUpcomingMeetings("SELECT COUNT(*) FROM `meetings` WHERE `status`='upcoming' AND `meetingTypeId`='1' OR `meetingTypeId`='2' OR `meetingTypeId`='3' OR `meetingTypeId`='4'"); ?></span></h4>
                                        <p class="description">
                                            Upcoming Meetings</p>
                                      <!-- /.info-box -->
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-4 ">
                              <div class="card income db mbm bg-info">
                                 <div class="card-body">

                                        <p class="icon">
                                            <i class="icon fa fa-layers"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?php echo $meeting->countUpcomingMeetings("SELECT COUNT(*) FROM `meetings` WHERE `meetingTypeId`='1' OR `meetingTypeId`='2' OR `meetingTypeId`='3' OR `meetingTypeId`='4'"); ?></span></h4>
                                        <p class="description">
                                            Meetings</p>
                                      <!-- /.info-box -->
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-4 ">
                              <div class="card income db mbm bg-success">
                                 <div class="card-body">

                                        <p class="icon">
                                            <i class="icon fa fa-layers"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?php echo $meeting->countmeetingRequest("SELECT COUNT(*) FROM `meetingrequest` WHERE `staffemail`='{$_SESSION['userEmail']}'"); ?></span></h4>
                                        <p class="description">
                                            Meetings Request</p>
                                      <!-- /.info-box -->
                                 </div>
                              </div>
                           </div>
                           </div>
                           <div id="styleSelector">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      -->
      <!-- Required Jquery -->
      <script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
      <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js"></script>
      <script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
      <script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js"></script>
      <!-- jquery slimscroll js -->
      <script type="text/javascript" src="../assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
      <!-- modernizr js -->
      <script type="text/javascript" src="../assets/js/modernizr/modernizr.js"></script>
      <!-- am chart -->
      <script src="../assets/pages/widget/amchart/amcharts.min.js"></script>
      <script src="../assets/pages/widget/amchart/serial.min.js"></script>
      <!-- Todo js -->
      <script type="text/javascript " src="../assets/pages/todo/todo.js "></script>
      <!-- Custom js -->
      <script type="text/javascript" src="../assets/pages/dashboard/custom-dashboard.js"></script>
      <script type="text/javascript" src="../assets/js/script.js"></script>
      <script type="text/javascript " src="../assets/js/SmoothScroll.js"></script>
      <script src="../assets/js/pcoded.min.js"></script>
      <script src="../assets/js/demo-12.js"></script>
      <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script>
         var $window = $(window);
         var nav = $('.fixed-button');
         $window.scroll(function(){
         if ($window.scrollTop() >= 200) {
         nav.addClass('active');
         }
         else {
         nav.removeClass('active');
         }
         });
      </script>
   </body>
</html>
<?php } ?>