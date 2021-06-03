<?php require_once("../config/initialize.php"); 
use app\config\Connection;
use app\config\Functions;
use app\config\Session;
use app\includes\Users;

$session = new Session;
$functions = new Functions;
$pdo = new Connection;
$users = new Users($pdo);
$user = $users->singleUser([$_SESSION['userId']]);

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

  if (isset($_POST['save_picture'])) {

    // for the database
    $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "../images/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['profileImage']['size'] > 200000) {
      $session->message("Image size should not be greated than 200Kb", "danger");
      /*$msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";*/
    }
    // check if file exists
    if(file_exists($target_file)) {
      $session->message("File already exists", "error");
      /*$msg = "File already exists";
      $msg_class = "alert-danger";*/
    } else
    // Upload image only if no errors
    {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
        
        $users->update("UPDATE `users` SET picture=? WHERE id=?", [$profileImageName, $_SESSION['userId']]);
          $session->message("Image uploaded and saved in the Database", "success");
      } else {
        $session->message("There was an erro uploading the file", "error");
        /*$error = "There was an erro uploading the file";
        $msg = "alert-danger";*/
      }
    }
    

  }

  //Change Name POST
  if (isset($_POST['save_name'])) {
    if (empty($_POST['name'])) {
      $session->message("Name field is empty", "error");
    }else {
      $res = $users->update("UPDATE `users` SET name=? WHERE id=?", [$_POST['name'], $_SESSION['userId']]);
          $session->message("Name changed and saved in the Database", "success");
    }
  }


  //Change Password POST 
  if (isset($_POST['save_password'])) {
    if (empty($_POST['new-password']) || empty($_POST['confirm-password'])) {
      $session->message("Password field is empty", "error");
    }else
    if ($_POST['confirm-password'] !== $_POST['new-password']) {
      $session->message("Password does not match", "error");
    }else {
      $res = $users->update("UPDATE `users` SET password=? WHERE id=?", [$_POST['confirm-password'], $_SESSION['userId']]);
          $session->message("Password changed and saved in the Database", "success");
        /*} else {
          $session->message("There was an error in the database", "error");
          
        }*/
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
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
      <!-- Style.css -->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
      <link rel="stylesheet" type="text/css" href="../css/style.css">
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
                  <li class="active">
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
  <?php ?>
  <div class="pcoded-inner-content">
    <!-- Page-header end -->
    
    <!-- Page body start -->
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <?php echo $session->check_message(); ?>
        </div>
        <div class="col-sm-6">
          <!-- Basic Form Inputs card start -->
          <div class="card">
            <div class="card-header">
              <h5>Change Profile Image</h5>
            </div>
           <div class="card-body">
              <form class="form" novalidate="" method="post" enctype="multipart/form-data">
                <div class="form-group" style="position: relative;">
                  <span class="img-div">
                    <img src="<?php echo (!empty($user->picture)) ? '../images/'.$user->picture : '../images/avatar.jpg'; ?>" onClick="triggerClick()" id="profileDisplay">
                  </span>
                  <input type="file" id="profileImage" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                </div>
                <button type="submit" class="btn btn-primary" name="save_picture">Save Changes</button>
              </form>
            </div>
          </div>

        </div>

        <div class="col-sm-6">
          <!-- Basic Form Inputs card start -->
          <div class="card">
            <div class="card-header">
              <h5>Edit Profile</h5>
            </div>
           <div class="card-body">
            <ul class="nav nav-tabs">
              <li class="nav-item"><a href="#" class="active nav-link">Change Name</a></li>
            </ul>
             <div class="tab-content pt-3">
                <div class="tab-pane active">
                <form class="form" novalidate="" method="post">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user->name; ?>">
                  </div>
                  <button type="submit" class="btn btn-primary" name="save_name">Save Changes</button>
                </form>
              </div>
            </div>

            </div>
          </div>
        </div>


      </div>

      <div class="row">
        <div class="col-sm-6">
          <!-- Basic Form Inputs card start -->
          <div class="card">
            <div class="card-header">
              <h5>Edit Profile</h5>
            </div>
           <div class="card-body">
            <ul class="nav nav-tabs">
              <li class="nav-item"><a href="#" class="active nav-link">Change Password</a></li>
            </ul>
             <div class="tab-content pt-3">
                <div class="tab-pane active">
                <form class="form" novalidate="" method="post">
                  <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input class="form-control" type="password" name="new-password" id="new-password" placeholder="••••••">
                  </div>
                  <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input class="form-control" type="password" name="confirm-password" id="confirm-password" placeholder="••••••">
                  </div>
                  <button type="submit" class="btn btn-primary" name="save_password">Save Changes</button>
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

    function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
</script>
<script type="../js/script.js"></script>
</body>

</html>

<?php } ?>
