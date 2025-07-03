<?php require("mechanicFunction.php"); 
if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
} else {
  header("location:executive_login.php");
  die();
}?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GARAGESOFTWARE - MECHANIC</title>
  <link href="img/autoclinch.jpg" rel="icon">
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

  <!-- FullCalendar CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.css" rel="stylesheet">
  <!-- FullCalendar JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.js"></script>

  <!-- Daterange picker -->
  
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
/* Styles for desktop */
.popup-form-container {
    max-width: 90%;
    max-height: 90%;
    overflow: auto;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

/* Styles for mobile */
@media screen and (max-width: 767px) {
    .popup-form-container {
        max-width: 50%;
        max-height: 50%;
        overflow: auto;
        position: fixed;
        top: 35%;
        left: 35%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
}


.popup-form-content {
    width: 100%;
}

/* Adjust styles for form elements */
.popup-form-content form {
    margin-bottom: 0;
}

.popup-form-content label {
    display: block;
    margin-bottom: 10px;
}

.popup-form-content select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
}

.popup-form-content button {
    padding: 10px 20px;
}

.close-popup {
    font-size: 30px;
    line-height: 1;
}

.ui-dialog-titlebar button.ui-dialog-titlebar-close {
    display: none;
}

</style>

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
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout1.php" role="button"><i class="fas fa-sign-out-alt" style='font-size:24px'></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->