<?php require_once("../config/initialize.php"); 
use app\config\Connection;
use app\config\Functions;
use app\includes\Tasks;
use app\config\Session;
use app\includes\Users;

$session = new Session;
$functions = new Functions;
$pdo = new Connection;
$task = new Tasks($pdo);
$user = new Users($pdo);

if(empty($_SESSION["user_token"])) {
  $functions->redirect_to("staff.php");
} else {

  if(isset($_REQUEST['token'])){
    $queryStrToken = isset($_GET['token']) ? $_GET['token'] : '';
    $token = isset($_SESSION['user_token']) ? $_SESSION['user_token'] : '';
    $loggedout = $session->logout($token, $queryStrToken);

    if ($loggedout) {
      $functions->redirect_to("staff.php");
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
                           <a href="staff_setting.php">
                           <i class="ti-settings"></i> Settings
                           </a>
                        </li>
                        <li>
                           <a href="staff_profile.php">
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
                              <a href="staff_profile.php"><i class="ti-user"></i>View Profile</a>
                              <a href="staff_setting.php"><i class="ti-settings"></i>Settings</a>
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
                     <a href="staff_dashboard.php">
                     <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                     <span class="pcoded-mtext" data-i18n="nav.dash.main">Home</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  </li>
                  <li class="active">
                     <a href="staff_task.php">
                     <span class="pcoded-micon"><i class="ti-layout"></i></span>
                     <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Task</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                    </li>
                  <li>
                     <a href="staff_meetings.php">
                     <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                     <span class="pcoded-mtext" data-i18n="nav.form-components.main">Meetings</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  </li>
                  <li>
                     <a href="staff_schedules.php">
                     <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                     <span class="pcoded-mtext" data-i18n="nav.form-components.main">Schedules</span>
                     <span class="pcoded-mcaret"></span>
                     </a>
                  </li>
                  <li class="">
                    <a href="staff_requests.php">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Requests</span>
                    <span class="pcoded-mcaret"></span>
                    </a>
                  </li>
                 </ul>
               </div>
            </nav>
            <div class="pcoded-content">
               <div class="pcoded-inner-content">
                  <div class="main-body">
                     <div class="page-wrapper">
                        <div class="page-body">
                           <div class="row">
                            <div class="col-md-12">
                              <div class="card">
                                <div class="card-header">
                                  <h4>List of Tasks</h4>
                                </div>
                                <div class="card-body">
                                  <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                <th>#</th>
                                  <th> Created By</th>
                                  <th>Title </th>
                                <th>Details</th>
                                <th>Deadline</th>
                                <th>Created On</th>
                                <th>Status</th>
                                
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                <th>#</th>
                                  <th> Created By</th>
                                  <th>Title </th>
                                <th>Details</th>
                                <th>Deadline</th>
                                <th>Created On</th>
                                <th>Status</th>
                                </tr>
                                </tr>
                              </tfoot>
                              <tbody>

                              <?php 
            $cnt = 1; 
            if($results = $task->allTasks("SELECT `listtask`.*, `users`.`name`, `users`.`email` FROM `listtask` LEFT JOIN `users` ON `users`.`id` = `listtask`.`createdBy` WHERE `listtask`.`createdBy`=?", [$_SESSION['userId']]))
            {
            foreach($results as $result)
            {       
              ?>  
                                <tr>
                                  <td><?php echo htmlentities($cnt);?></td>
                                  <td><?php echo ucfirst($result->name);?></td>
                                  <td><?php echo htmlentities($result->title);?></td>
                                  <td><?php echo (empty($result->details)) ? "-" : $result->details;?></td>
                                  <td><?php echo $result->deadline;?></td>
                                  <td><?php echo $result->createdOn;?></td>
                                  <td><?php echo $result->status;?></td>
                                </tr>
                                <?php $cnt=$cnt+1; }} ?>
                                
                              </tbody>
                            </table>
                                </div>
                              </div>
                            </div>
                             <div class="col-md-12 col-xl-8">
                              <?php echo $session->check_message(); ?>
                                <div class="card">
                                  <div class="card-header"><h4>Add New Task</h4></div>
                                  <div class="card-body">
                                    <form method="post" action="controller.php">
                                      <input type="hidden" name="action" value="addtask">
                                    <div class="mt-3">
                                      <label for="title" class="form-label">User</label>
                                      <select class="form-control" name="user">
                                        <option>--please select user--</option>
                                        <?php $results = $user->fetchStudentUsers();
                                         foreach ($results as $result) {
                                           ?>
                                           <option value="<?php echo $result->id; ?>"><?php echo $result->name; ?></option>
                                          <?php
                                         }

                                        ?>
                                      </select>
                                    </div>
                                    <div class="mt-3">
                                      <label for="title" class="form-label">Task Name</label>
                                      <input class="form-control" type="text"name="title" id="title">
                                    </div>
                                    <div class="mt-3">
                                      <label for="details" class="form-label">Details</label>
                                      <textarea rows="6" cols="5" class="form-control" name="details" id="details"></textarea>
                                    </div>
                                    <div class="mt-3">
                                      <label for="starttime" class="form-label">Start Time</label>
                                      <input class="form-control" type="date" name="starttime" id="starttime" >
                                    </div>
                                    <div class="mt-3">
                                      <label for="deadline" class="form-label">Deadline</label>
                                      <input class="form-control" type="date" name="deadline" id="deadline" >
                                    </div>
                                    <div class="mt-3">
                                      <label for="status" class="form-label">Status</label>
                                      <input class="form-control" type="text" name="status" id="status" >
                                    </div>
                                    <br>
                                    <button type="submit" name="save_task" class="btn btn-primary">Save</button>
                                    </form>
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