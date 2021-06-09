<?php require_once("../../config/initialize.php"); ?>
<?php
//Import custom Mailer classe into the global namespace
use app\config\Connection;
use app\config\Functions;
use app\config\Session;
use app\includes\Users;

$session = new Session;
$functions = new Functions;
$pdo = new Connection;

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

<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" />

<!-- If you use the default popups, use this. -->


<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css" />

<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css" />

<!-- Required Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



<link rel="stylesheet" href="../assets/css/calendar.css">
</head>

<body>
  <script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>

  <script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>

  <script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>

  <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>
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
<!-- card1 start -->
<!-- Statestics Start -->
<div class="col-md-12 ">

<div class="card">
<div class="card-header">
<h4>Schedule</h4>
<div class="float-right"><span class="help-text text-danger">view can be month, week, day</span><input type="text" id="defaultView"> <button type="submit" id="change" onclick="return calender();">Change</button></div>
</div>
<div class="card-body">
  <div id="menu">
      <span id="menu-navi">
        <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Today</button>
        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
          <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
        </button>
        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
          <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
        </button>
      </span>
      <span id="renderRange" class="render-range"></span>
    </div>
  <div id="calendar" style="height: 800px;"></div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
  //document.getElementById("change").addEventListener("click", calender);
  function calender() {
  var changeDefaultView = document.getElementById("defaultView").value;

  var Calendar = tui.Calendar;

  var calendar = new Calendar('#calendar', {
  defaultView: changeDefaultView,
  taskView: true,
  scheduleView: ['time'],  // e.g. true, false, or ['allday', 'time'])
  template: {
    monthDayname: function(dayname) {
      return '<span class="calendar-week-dayname-name">' + dayname.label + '</span>';
    },
    milestone: function(schedule) {
      return '<span style="color:red;"><i class="fa fa-flag"></i> ' + schedule.title + '</span>';
    },
    milestoneTitle: function() {
      return 'Milestone';
    },
    task: function(schedule) {
      return '&nbsp;&nbsp;#' + schedule.title;
    },
    taskTitle: function() {
      return '<label><input type="checkbox" />Task</label>';
    },
    allday: function(schedule) {
      return schedule.title + ' <i class="fa fa-refresh"></i>';
    },
    alldayTitle: function() {
      return 'All Day';
    },
    time: function(schedule) {
      return schedule.title + ' <i class="fa fa-refresh"></i>' + schedule.start;
    },
    month: {
      daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      startDayOfWeek: 0,
      narrowWeekend: true
    },
    // list of Calendars that can be used to add new schedule
    calendars: [],
    // whether use default creation popup or not
    useCreationPopup: false,
    // whether use default detail popup or not
    useDetailPopup: false
    },
    week: {
      daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      startDayOfWeek: 0,
      narrowWeekend: true
    }
});

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    if (this.responseText) {
       const res = JSON.parse(this.responseText);
       
          calendar.createSchedules([
            {
                id: res[0].id,
                calendarId: '1',
                title: res[0].title,
                category: 'time',
                dueDateClass: '',
                start: res[0].start,
                end: res[0].end,
                isReadOnly: true
            }
          ]);

    }
  }
  };
  xhttp.open("POST", "../event.php", true);
  xhttp.setRequestHeader("Content-type", "application/json");
  xhttp.send();

  /*calendar.createSchedules([
    {
        id: '1',
        calendarId: '1',
        title: 'my schedule',
        category: 'time',
        dueDateClass: '',
        start: '2021-06-01',
        end: '2021-06-08',
        isReadOnly: true
    },
    {
        id: '2',
        calendarId: '1',
        title: 'second schedule',
        category: 'time',
        dueDateClass: '',
        start: '2021-06-09',
        end: '2021-07-08',
        isReadOnly: true    // schedule is read-only
    }
]);*/
}
  
</script>
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
