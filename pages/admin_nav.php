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