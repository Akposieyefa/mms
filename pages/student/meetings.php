<?php require_once("../../config/initialize.php"); 
use app\config\Connection;
use app\config\Functions;
use app\config\Session;
use app\includes\Meeting;

$session = new Session;
$functions = new Functions;
$pdo = new Connection;
$meeting = new Meeting($pdo);

if(empty($_SESSION["user_token"])) {
  $functions->redirect_to("../student.php");
} else {

  if(isset($_REQUEST['token'])){
    $queryStrToken = isset($_GET['token']) ? $_GET['token'] : '';
    $token = isset($_SESSION['user_token']) ? $_SESSION['user_token'] : '';
    $loggedout = $session->logout($token, $queryStrToken);

    if ($loggedout) {
      $functions->redirect_to("../student.php");
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
               <a href="index.html">
                  <h3>Welcome</h3>
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
                              <img class="d-flex align-self-center img-radius" src="../../images/avatar.jpg" alt="Generic placeholder image">
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
                           <a href="profile">
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
                           <!-- card1 start -->
                           <!-- Statestics Start -->
                           <div class="col-md-12 ">
                              <div class="card">
                                 <div class="card-header">
                                    <h4>Meetings</h4>
                                    <div class="card-header-left "></div>
                                    <div class="">
                                          <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						                  <thead>
						                    <tr>
						                    <th>#</th>
						                      <th> Type of Meeting</th>
						                      <th>Date and Time of Meeting </th>
						                      <th>Minutes of the Meeting</th>
						                    <th>View</th>
						                    <th>Status</th>
						                    
						                    </tr>
						                  </thead>
						                  <tfoot>
						                    <tr>
						                    <th>#</th>
						                      <th> Type of Meeting</th>
						                      <th>Date and Time of Meeting </th>
						                      <th>Minutes of the Meeting</th>
						                    <th>View</th>
						                    <th>Status</th>
						                    </tr>
						                    </tr>
						                  </tfoot>
						                  <tbody>

						                  <?php 
						$cnt = 1;
						if($results = $meeting->meetings("SELECT `meetings`.*, `meetingtype`.`name` FROM `meetings` LEFT JOIN `meetingtype` ON `meetings`.`meetingTypeId`=`meetingtype`.`id` WHERE `meetings`.`meetingTypeId`=?", ['4']))
						{
						foreach($results as $result)
						{       
							?>  
						                    <tr>
						                      <td><?php echo htmlentities($cnt);?></td>
						                      <td><?php echo ucfirst($result->name);?></td>
						                      <td><?php echo htmlentities($result->meetingDate).' '.$result->meetingTime;?></td>
						                      <td><?php echo (empty($result->minutesOfMeeting)) ? '' : '<a href="../../docs/'.$result->minutesOfMeeting.'" class="text-info"><i class="fa fa-download"></i> Download MOM</a>' ;?></td>
						                      <td><a href="meeting_details.php?meetingid=<?php echo $result->id;?>" title="view" class="text-info"><i class="fa fa-eye"></i></a></td>
						                       <td><?php echo ($result->status) ? "<span class='text-info'>".$result->status."</span>" : "--" ;?></td>
						                    </tr>
						                    <?php $cnt=$cnt+1; }} ?>
						                    
						                  </tbody>
						                </table>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-md-12 ">
                              <div class="card">
                                 <div class="card-header">
                                    <h4>Meeting Request</h4>
                                    <div class="card-header-left "></div>
                                    <div class="">
                                          <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                      <th>#</th>
                                        <th> Meeting Purpose</th>
                                        <th> Staff Email</th>
                                        <th>Date and Time of Meeting </th>
                                      <th>Status</th>
                                      
                                      </tr>
                                    </thead>
                                    <tfoot>
                                      <tr>
                                      <th>#</th>
                                        <th> Meeting Purpose</th>
                                        <th> Staff Email</th>
                                        <th>Date and Time of Meeting </th>
                                      <th>Status</th>
                                      </tr>
                                      </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php 
                  $cnt = 1;
                  if($results = $meeting->fetchmeetingRequest("SELECT * FROM `meetingrequest` WHERE `userId`=?", [$_SESSION['userId']]))
                  {
                  foreach($results as $result)
                  {       
                     ?>  
                                      <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo ucfirst($result->purpose);?></td>
                                        <td><?php echo $result->staffemail;?></td>
                                        <td><?php echo htmlentities($result->meetingDate).' '.$result->meetingTime;?></td>s
                                         <td><?php echo ($result->status) ? "<span class='text-info'>".$result->status."</span>" : "--" ;?></td>
                                      </tr>
                                      <?php $cnt=$cnt+1; }} ?>
                                      
                                    </tbody>
                                  </table>
                                    </div>
                                 </div>
                              </div>

                              <div class=" sub_sect2">
                              	<div class="card">
                              		<div class="card-body">
                              			<div class="col-md-12"><?php echo $session->check_message(); ?></div>
                                 <div class="mr">
                                    <h4>SEND MEETING REQUEST</h4>
                                    <hr>
                                    <form method="POST"action="controller.php" novalidate="">
                                    	<input type="hidden" name="action" value="meetingrequest">
                                    	<div class="">
										<label for="email" class="form-label ">Email address</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="staffname@example.com">
										</div>
										<div class="">
										<label for="purposeOfmeeting" class="form-label">Purpose of Meeting</label>
										<input class="form-control" type="text" placeholder="" aria-label="default input example" id="purposeOfmeeting" name="purposeOfmeeting">
										</div>
										<div class="col-md-4">
										<label for="meetingDate" class="form-label">Date</label>
										<input class="form-control" type="date" placeholder="" aria-label="default input example" id="meetingDate" name="meetingDate">
										</div>
										<div class="col-md-4">
										<label for="meetingTime" class="form-label">Time</label>
										<input class="form-control" type="time" placeholder="" aria-label="default input example" id="meetingTime" name="meetingTime">
										</div>
										<div class="mt-3 col-md-4">
										<button class="form-control btn-primary">SEND</button>
										</div>
                                    </form>
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