<?php require_once("../config/initialize.php"); ?>
<?php
//Import custom Mailer classe into the global namespace
use app\config\Connection;
use app\config\Functions;
use app\config\Session;

use app\includes\Users;

$pdo = new Connection;
$session = new Session;
$functions = new Functions;


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

	if(isset($_POST["submit"])){
		$staff_name=$_POST['staff_fname'].' '.$_POST['staff_lname'];
		$staffphone=$_POST['staffphone'];
		$staffdept= $_POST['staffdept'];
		$position= $_POST['position'];
		$staffemail=$_POST['staffemail'];
		$staffpassword=$_POST['staffpassword'];
		$jobtype=$_POST['jobtype'];

		$users = new Users($pdo);
		$rowEmail = $users->singleEmail("SELECT COUNT(*) FROM `users` WHERE `email`=?", [$staffemail]);

		if($rowEmail>0){
			$session->message("Error: Email Already exist.", "error");
		}else {

			$sql = $users->create("INSERT INTO users (`name`, `phone`, `department`, `position`, `email`, `password`, `jobtype`, `memberType`, `isActive`, `createdBy`) VALUES (?,?,?,?,?,?,?,?,?,?)", [$staff_name, $staffphone, $staffdept, $position, $staffemail, $staffpassword, $jobtype, '2', '1', 'Admin']);
			$session->message("New record successfully inserted", "success");
		}

	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Meeting Management System</title>
<meta charset="utf-8">
	<!--style-->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<!--bootsrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="../css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="../fonts/line-awesome/css/line-awesome.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="../css/signup.css"/>
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
                  <li>
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
                  <li class="pcoded-hasmenu active">
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
	<div class="col-sm-12">
      <?php echo $session->check_message(); ?>
    </div>
<!-- card1 start -->
<!-- Statestics Start -->
<body class="form-v4 card">
		<div class="form-v4-content">
			<form class="form-detail" action="" method="post">
				<div class="form-group color">
					<div class="form-row form-row-1 ">
						<label for="first_name">First Name</label>
						<input type="text" name="staff_fname" id="staff_fname" class="input-text">
					</div>
					<div class="form-row form-row-1">
						<label for="last_name">Last Name</label>
						<input type="text" name="staff_lname" id="staff_lname" class="input-text">
					</div>
					<div class="form-row form-row-1">
						<label for="last_name">Phone No.</label>
						<input type="num" name="staffphone" id="staffphone" class="input-text">
					</div>
				</div>
				<div class="form-group">
					<div class="form-row form-row-1">
						<label for="last_name">Depatment</label>
						<input type="text" name="staffdept" id="staffdept" class="input-text">
					</div>
				<div class="form-row form-row-1">
						<label for="last_name">Position</label>
						<input type="text" name="position" id="
						position" class="input-text">
				</div>
				</div>
				<div class="form-row form-row-1">
						<label for="last_name">Jobtype</label>
						<input type="text" name="jobtype" id="jobtype" class="input-text">
					</div>
					
				<div class="form-row">
					<label for="your_email">Email Address</label>
					<input type="text" name="staffemail" id="staffemail" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
				</div>
				<div class="form-group">
					<div class="form-row form-row-1 ">
						<label for="password">Password</label>
						<input type="password" name="staffpassword" id="staffpassword" class="input-text" required>
					</div>
				</div>
				<div class="form-row-last">
					 <button type="submit" class="btn btn-secondary" name="submit">submit</button>
				</div>
			</form>
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
