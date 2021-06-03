<?php require_once("../config/initialize.php"); 
use app\config\Connection;
use app\config\Functions;
use app\config\Session;
use app\includes\Meeting;
use app\includes\MeetingType;

$session = new Session;
$functions = new Functions;
$pdo = new Connection;
$meeting = new Meeting($pdo);

if(empty($_SESSION["user_token"])) {
  $functions->redirect_to("admin.php");
} else {

  if(isset($_REQUEST['token'])){
    $queryStrToken = isset($_GET['token']) ? $_GET['token'] : '';
    $token = isset($_SESSION['user_token']) ? $_SESSION['user_token'] : '';
    $loggedout = $session->logout($token, $queryStrToken);

    if ($loggedout) {
      $functions->redirect_to("admin.php");
    }
  }

  if(isset($_REQUEST['deleteid']))
   {
      $id=$_GET['deleteid'];
      $meeting->deletemeeting([$id]);
      $session->message("Meeting deleted successfully", "danger");
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
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
      <!-- Style.css -->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
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
                              <img class="d-flex align-self-center img-radius" src="../images/avatar.jpg" alt="Generic placeholder image">
                              <div class="media-body">
                                 <h5 class="notification-user"></h5>
                                 <p class="notification-msg"></p>
                                 <span class="notification-time"></span>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="media">
                              <img class="d-flex align-self-center img-radius" src="../images/avatar.jpg" alt="Generic placeholder image">
                              <div class="media-body">
                                 <h5 class="notification-user">Joseph William</h5>
                                 <p class="notification-msg"></p>
                                 <span class="notification-time"></span>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="media">
                              <img class="d-flex align-self-center img-radius" src="assets/images/avatar-4.jpg" alt="Generic placeholder image">
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
                     <img src="../images/avatar.jpg" class="img-radius" alt="User-Profile-Image">
                     <span></span>
                     <i class="ti-angle-down"></i>
                     </a>
                     <ul class="show-notification profile-notification">
                        <li>
                           <a href="admin_setting.php">
                           <i class="ti-settings"></i> Settings
                           </a>
                        </li>
                        <li>
                           <a href="admin_profile.php">
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
            <nav class="pcoded-navbar">
               <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
               <div class="pcoded-inner-navbar main-menu">
                  <div class="">
                     <div class="main-menu-header">
                        <img class="img-40 img-radius" src="../images/avatar.jpg" alt="User-Profile-Image">
                        <div class="user-details">
                           <span></span>
                           <span id="more-details"><i class="ti-angle-down"></i></span>
                        </div>
                     </div>
                     <div class="main-menu-content">
                        <ul>
                           <li class="more-details">
                              <a href="admin_profile.php"><i class="ti-user"></i>View Profile</a>
                              <a href="admin_setting.php"><i class="ti-settings"></i>Settings</a>
                              <a href="?token=<?php echo $_SESSION['user_token']; ?>"><i class="ti-layout-sidebar-left"></i>Logout</a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="pcoded-search">
                     <span class="searchbar-toggle">  </span>
                     <div class="pcoded-search-box ">
                        <input type="text" placeholder="Search">
                        <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
                     </div>
                  </div>
                  <ul class="pcoded-item pcoded-left-item">
                  <li class="">
                     <a href="admin_dash.php">
                     <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                     <span class="pcoded-mtext" data-i18n="nav.dash.main">Home</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  </li>
                  <li class="">
                     <a href="admin_task.php">
                     <span class="pcoded-micon"><i class="ti-layout"></i></span>
                     <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Task</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  <li class="active">
                     <a href="admin_meetings.php">
                     <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                     <span class="pcoded-mtext" data-i18n="nav.form-components.main">Meetings</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  </li>
                  <li>
                     <a href="admin_schedules.php">
                     <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                     <span class="pcoded-mtext" data-i18n="nav.form-components.main">Schedules</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  </li>
                  <li class="pcoded-hasmenu">
                     <a href="javascript:void(0)">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                     <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Manage Users</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                     <ul class="pcoded-submenu">
                  <li class=" ">
                     <a href="admin_manage_student.php">
                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                     <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Students</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  </li>
                  <li class=" ">
                     <a href="admin_manage_staff.php">
                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                     <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Staff</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  </li>
                  <li>
                     <a href="admin_manage_secretary.php">
                     <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                     <span class="pcoded-mtext" data-i18n="nav.form-components.main">Secretary</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  </li>
               </div>
            </nav>
         <div class="pcoded-content">
            <div class="pcoded-inner-content">
               <div class="main-body">
                  <div class="page-wrapper">
                     <div class="page-body">
                        <div class="row">
                           <!-- card1 start -->
                           <!-- Statestics Start -->
                           <div class="col-md-12 ">
                              <div class=" sub_sect2">
                                 <div class="card">
                                    <div class="card-body">
                                       <div class="col-md-12"><?php echo $session->check_message(); ?></div>
                                 <div class="mr">
                                    <h4 class="">ADD MEETING</h4>
                                    <hr>
                                    <?php
                                    if($results = $meeting->singlemeeting("SELECT `meetings`.*, `meetingtype`.`name` FROM `meetings` LEFT JOIN `meetingtype` ON `meetings`.`meetingTypeId`=`meetingtype`.`id` WHERE `meetings`.`id`=?",[$_GET['meetingid']])):

                                       $meetingtype = new MeetingType($pdo);
                                          $stmt = $meetingtype->singlemeetingtypes("select * from meetingtype where id =?", [$results->meetingTypeId]);
                                    ?>
                                    <form method="POST" action="controller.php" novalidate="">
                                    <div class="mt-3">
                                       <label for="typeOfMeeting" class="form-label ">Type of Meeting</label>
                                       <input class="form-control" type="text" name="" value="<?php echo $stmt->name; ?>" readonly="true">
                                    </div>
                                    <div class="mt-3">
                                       <label for="subjectOfMeeting" class="form-label">Subject of Meeting</label>
                                       <input class="form-control" type="text" value="<?php echo $results->subject; ?>" id="subjectOfMeeting" name="subjectOfMeeting" readonly="true">
                                 </div>
                                 <div class="mt-3">
                                       <label for="attendess" class="form-label">Attendees:</label>
                                       <input class="form-control" type="text" value="<?php echo $results->attendee; ?>" readonly="true">
                                 </div>
                                 <div class="mt-3 col-md-4">
                                       <label for="date" class="form-label">Date</label>
                                       <input class="form-control" type="text" placeholder=""value="<?php echo $results->meetingDate; ?>" readonly="true">
                                 </div>
                                 <div class="mt-3 col-md-4">
                                       <label for="date" class="form-label">Time</label>
                                       <input class="form-control" type="text" placeholder=""value="<?php echo $results->meetingTime; ?>" readonly="true">
                                 </div>
                                 <div class="mt-3">
                                       <label for="venue" class="form-label">Venue of Meeting</label>
                                       <input class="form-control" type="text" value="<?php echo $results->venue; ?>" name="venue" id="venue">
                                 </div>
                                 <div class="mt-3">
                                       <label for="greetingtxt" class="form-label">Greeting Text</label>
                                       <input class="form-control" type="text" value="<?php echo $results->greetingText; ?>" id="greetingtxt">
                                 </div>
                                 <div class="mt-3">
                                       <label for="greetingtxt" class="form-label">Agenda</label>
                                       <textarea class="form-control" id="agenda" rows="5" col="3"><?php echo $results->agenda; ?></textarea>
                                 </div>
                                 </form>
                                   <?php endif; ?>
                                 </div>
                                 </div>
                                 </div>
                              </div>
                              <div class="sub_sect2"></div>
                              <div class="sub_sect2"></div>
                              <div id="styleSelector"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Required Jquery -->
      <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
      <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
      <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
      <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
      <!-- jquery slimscroll js -->
      <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
      <!-- modernizr js -->
      <script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
      <!-- am chart -->
      <script src="assets/pages/widget/amchart/amcharts.min.js"></script>
      <script src="assets/pages/widget/amchart/serial.min.js"></script>
      <!-- Todo js -->
      <script type="text/javascript " src="assets/pages/todo/todo.js "></script>
      <!-- Custom js -->
      <script type="text/javascript" src="assets/pages/dashboard/custom-dashboard.js"></script>
      <script type="text/javascript" src="assets/js/script.js"></script>
      <script type="text/javascript " src="assets/js/SmoothScroll.js"></script>
      <script src="assets/js/pcoded.min.js"></script>
      <script src="assets/js/demo-12.js"></script>
      <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
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