<!DOCTYPE html>
<html lang="en">
<style>/* Reset some default styles */
body, h1, h2, p, ul, li {
    margin: 0;
    padding: 0;
}

/* Apply basic styling to the body */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

/* Style the main panel */
.main-panel {
    max-width: 800px;
    margin: 20px auto;
    background-color: green;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Style the content wrapper */
.content-wrapper {
    padding: 20px;
}

/* Center the heading within a div */
.div_center {
    text-align: center;
}

/* Style the heading font size */
.font_size {
    font-size: 24px;
    color: #333;
}

/* Style the list of booked events */
ul {
    list-style: none;
    padding: 0;
}

/* Style each booked event item */
li {
    border-bottom: 1px solid #ccc;
    padding: 15px 0;
}

/* Style the event details */
h2 {
    font-size: 18px;
    color: #333;
    margin-bottom: 5px;
}

p {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
}
</style>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Eventrix</title>
    <link rel="stylesheet" href="admin/template/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/template/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="admin/template/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/template/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/template/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/template/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="admin/template/assets/css/style.css">
    <link rel="shortcut icon" href="admin/template/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <img src="logo/logo1.png" width="150px">
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="admin/template/assets/images/faces/logoo.jpg" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">Eventrix</h5>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title"><a href="{{url('graph')}}">Dashboard</a></span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Events</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{url('/create_event')}}">Add Events</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/show_event')}}">Show Events</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/show_reservation')}}">Booked Events</a></li>
              </ul>
            </div>
          </li>
      </nav>
      <div class="container-fluid page-body-wrapper">
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="admin/template/assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <li>
                  <x-app-layout>
                  </x-app-layout>
                </li>
          </div>
        </nav>
          <div class="main-panel">
          <div class="content-wrapper">
            
        </div>
      </div>
    </div>
    <script src="admin/template/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="admin/template/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin/template/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin/template/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin/template/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin/template/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="admin/template/assets/js/off-canvas.js"></script>
    <script src="admin/template/assets/js/hoverable-collapse.js"></script>
    <script src="admin/template/assets/js/misc.js"></script>
    <script src="admin/template/assets/js/settings.js"></script>
    <script src="admin/template/assets/js/todolist.js"></script>
    <script src="admin/template/assets/js/dashboard.js"></script>
  </body>
</html>