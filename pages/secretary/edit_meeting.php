<?php require_once("../../config/initialize.php"); 
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
  $functions->redirect_to("../secretary.php");
} else {

  if(isset($_REQUEST['token'])){
    $queryStrToken = isset($_GET['token']) ? $_GET['token'] : '';
    $token = isset($_SESSION['user_token']) ? $_SESSION['user_token'] : '';
    $loggedout = $session->logout($token, $queryStrToken);

    if ($loggedout) {
      $functions->redirect_to("../secretary.php");
    }
  }

  if(isset($_REQUEST['deleteid']))
   {
      $id=$_GET['deleteid'];
      $meeting->deletemeeting([$id]);
      $session->message("Meeting deleted successfully", "danger");
   }

   if ($results = $meeting->singlemeeting("SELECT `meetings`.*, `meetingtype`.`name` FROM `meetings` LEFT JOIN `meetingtype` ON `meetings`.`meetingTypeId`=`meetingtype`.`id` WHERE `meetings`.`id`=?",[$_GET['meetingid']])){

      $meetingtype = new MeetingType($pdo);
      $stmt = $meetingtype->singlemeetingtypes("select * from meetingtype where id =?", [$results->meetingTypeId]);

   }

   //Reschedule POST
  if (isset($_POST['save_schedule'])) {
    if (!empty($_POST['meeting-date'])) {
      $stmt = $meeting->countMeetings("SELECT COUNT(*) FROM `meetings` WHERE `meetingDate`='{$_POST['meeting-date']}'");
         if($stmt->fetchColumn() < 1){

         $res = $meeting->update("UPDATE `meetings` SET meetingDate=? WHERE id=?", [$_POST['meeting-date'], $_POST['meetingid']]);
         $session->message("Meeting Date Rescheduled", "success");
         }else{
            $session->message("Pick a new date while Rescheduling.", "error");
         }
    }elseif(!empty($_POST['meeting-time'])) {
      $res = $meeting->update("UPDATE `meetings` SET meetingTime=? WHERE id=?", [$_POST['meeting-time'], $_POST['meetingid']]);
          $session->message("Meeting Time Rescheduled", "success"); 
    }else {
      $session->message("field is empty", "error");
    }
  }

  //Status POST
  if (isset($_POST['save_status'])) {
     if (!empty($_POST['status'])) {
        $res = $meeting->update("UPDATE `meetings` SET status=? WHERE id=?", [$_POST['status'], $_POST['meetingid']]);
         $session->message("Meeting status changed", "success");
     }else {
      $session->message("field is empty", "error");
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
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
            <?php include "sec_nav.php"; ?>
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
                                    <h6 class="">Meeting Type: <b><?php echo (isset($stmt->name)) ? $stmt->name : ''; ?></b>&nbsp;&nbsp; <span class="badge badge-info"><?php echo $results->status; ?></span></h6>
                                    <hr>
                                    <p>Meeting Subject: <b><?php echo $results->subject; ?></b></p>
                                    <hr>
                                    <p>Previous Date & Time: <b><?php echo $results->meetingDate.' '.$results->meetingTime; ?></b></p>
                                 </div>
                                 </div>
                                 </div>
                              </div>
                              <div class="sub_sect2"></div>
                              <div class="sub_sect2"></div>
                              <div id="styleSelector"></div>
                           </div>

         <div class="col-sm-6">
          <!-- Basic Form Inputs card start -->
          <div class="card">
            <div class="card-header">
              <h5>Meeting Rescheduling</h5>
            </div>
           <div class="card-body">
            <ul class="nav nav-tabs">
              <li class="nav-item"><a href="#" class="active nav-link">Reschedule this meeting</a></li>
            </ul>
             <div class="tab-content pt-3">
                <div class="tab-pane active">
                <form class="form" novalidate="" method="post">
                  <input type="hidden" name="meetingid" value="<?php echo $_GET['meetingid']; ?>">
                  <div class="form-group">
                    <label for="meeting-date">New Meeting Date</label>
                    <input class="form-control" type="date" name="meeting-date" id="meeting-date" >
                  </div>
                  <div class="form-group">
                    <label for="meeting-time">New Meeting Time</label>
                    <input class="form-control" type="time" name="meeting-time" id="meeting-time" >
                  </div>
                  <button type="submit" class="btn btn-primary" name="save_schedule">Reschedule</button>
                </form>
              </div>
            </div>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <!-- Basic Form Inputs card start -->
          <div class="card">
            <div class="card-header">
              <h5>Change Meeting Status</h5>
            </div>
           <div class="card-body">
            <ul class="nav nav-tabs">
              <li class="nav-item"><a href="#" class="active nav-link">Change this meeting status</a></li>
            </ul>
             <div class="tab-content pt-3">
                <div class="tab-pane active">
                <form class="form" novalidate="" method="post">
                  <input type="hidden" name="meetingid" value="<?php echo $_GET['meetingid']; ?>">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                       <option><?php echo $results->status; ?></option>
                       <option>____________________</option>
                       <option value="cancelled">cancelled</option>
                       <option value="completed">completed</option>
                       <option value="upcoming">upcoming</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary" name="save_status">Save Changes</button>
                </form>
              </div>
            </div>

            </div>
          </div>
        </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
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