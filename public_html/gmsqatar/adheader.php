<?php require("adminFunction.php"); 
if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
} else {
  header("location:login.php");
  die();
}?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>
  <link href="img/logo.png" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link href="form_style.css" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  
  <!-- jQuery (already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS (needed for modal) -->


  <script language='javascript' type='text/javascript'>
    function DisableBackButton() {
      window.history.forward()
    }
    DisableBackButton();
    window.onload = DisableBackButton;
    window.onpageshow = function(evt) {
      if (evt.persisted) DisableBackButton()
    }
    window.onunload = function() {
      void(0)
    }
  </script>
</head>
<style>
    @keyframes blink {
        50% {
            opacity: 0;
        }
    }
</style>
<style>
  #loader {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    width: 100px;
    height: 100px;
    border: 16px solid #f3f3f3;
    border-top: 16px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  @media only screen and (max-width: 768px) {
    #loader {
      width: 50px;
      height: 50px;
      border-width: 8px;
    }
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
  <div id="loader"></div>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="dashboard.php" class="nav-link">Home</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
        
        <li>
          <?php if (isset($_SESSION['msg5'])) { ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong><?php
                      if (isset($_SESSION['user'])) {
                        echo $_SESSION['user'];
                      } ?></strong>&nbsp;<?php echo $_SESSION['msg5']; ?>

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php unset($_SESSION['msg5']);
          ///////////////////////////////////
          } ?>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li> -->
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell" style='font-size:24px'></i>
            <?php echo trial_end_date1($conn); ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Notifications</span>
            
        <?php echo trial_end_date($conn); ?></span>
            </a>
            <a href="#" class="dropdown-item dropdown-footer"></a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <!-- <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user" style="font-size:26px"></i>
            <span class="badge badge-warning navbar-badge">|</span>
          </a> -->
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="<?php
              if (isset($_SESSION['user'])) {

                echo $_SESSION['img'];
              }; ?>" class="img-radius" alt="" style="width: 30px; border-radius:15px;">
            <span class="badge badge-warning" style="font-size:15px"><?php
              if (isset($_SESSION['user'])) {
                echo $_SESSION['user'];
              }; ?>
              <i class="fa fa-angle-down" style="font-size:15px"></i></span>
          </a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item dropdown-footer"></a>
            <a href="settings.php" class="dropdown-item">
              <i class="fas fa-cog mr-2"></i>
              <span class="text-muted text-sm">Settings</span>
            </a>
            <a href="profile.php" class="dropdown-item">
              <i class="fas fa-user mr-2"></i>
              <span class="text-muted text-sm">Profile</span>
            </a>
            <a href="logout.php" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i>
              <span class="text-muted text-sm">Logout</span>
            </a>
            <a href="#" class="dropdown-item dropdown-footer"></a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->