<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="" class="brand-link text-center">
    <img class="img-fluid" src="<?php
              if (isset($_SESSION['user'])) {

                echo $_SESSION['img'];
              }; ?>" alt="" style="width: 100px; border-radius:15px;">
  </a>
  <div class="sidebar">

    <div class="user-panel mt-3 d-flex">
      <div class="info">
        <a href="https://play.google.com/store/apps/details?id=com.garage.merigarage" class="nav-link text-center"><?php
                                    if (isset($_SESSION['user'])) {

                                      echo $_SESSION['user'];
                                    }; ?><br><font color="#ffffff"><b>Download NEW Mobile App</b></font></a><br>
      </div>

    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="parts_inventory.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Inventory</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="service-package.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Service Package</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="all_mechanics.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Add Mechanics</p>
          </a>
        </li> 
        <li class="nav-item">
          <a href="allcustomers.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>All Customer</p>
          </a>
        </li> 
        <li class="nav-item">
          <a href="all_vehicles.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>All Vehicles</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="createvehicles_jobcard.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Create JobCard</p>
          </a>
        </li> 
        <!--<li class="nav-item">-->
        <!--  <a href="dashboard.php" class="nav-link">-->
        <!--    <i class="nav-icon fas fa-th"></i>-->
        <!--    <p>-->
        <!--      Create Job Card-->
        <!--    </p>-->
        <!--  </a>-->
        <!--</li>-->
        <li class="nav-item">
          <a href="ShowJobCard.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>View All Jobcards</p>
          </a>
        </li>
        
        <!--<li class="nav-item">-->
        <!--  <a href="serviceapprovel.php" class="nav-link">-->
        <!--    <i class="nav-icon fas fa-th"></i>-->
        <!--    <p>Customer Approval</p>-->
        <!--  </a>-->
        <!--</li>-->
        <li class="nav-item">
          <a href="servicereminder.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Service Reminders</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="insurance-reminder.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Insurance Reminders</p>
          </a>
        </li>
        
        
        <!--<li class="nav-item">-->
        <!--  <a href="Appdashboard.php" class="nav-link">-->
        <!--    <i class="nav-icon fas fa-th"></i>-->
        <!--    <p>-->
        <!--      Customer App Booking (Premium)-->
        <!--    </p>-->
        <!--  </a>-->
        <!--</li>-->
        <!--<li class="nav-item">-->
        <!--  <a href="order.php" class="nav-link">-->
        <!--    <i class="nav-icon fas fa-th"></i>-->
        <!--    <p>-->
        <!--      Customer App Orders (Premium)-->
        <!--    </p>-->
        <!--  </a>-->
        <!--</li>-->
        <!--<li class="nav-item">-->
        <!--  <a href="change_price.php" class="nav-link">-->
        <!--    <i class="nav-icon fas fa-th"></i>-->
        <!--    <p>-->
        <!--     Edit Price on App<br>(Premium)-->
        <!--    </p>-->
        <!--  </a>-->
        <!--</li>-->
        <li>
          <a href="#" class="nav-link">
            <p>___________</p>
          </a>
        </li>
         <li class="nav-item">
          <a href="training_video.php" class="nav-link">
            <p>Training Video<br>
          </a>
           <a href="training_video.php" class="nav-link">
            <p>Support<br>
            +91 9958300122<br>
            info@merigarage.com
          </a>
        </li>
        <br><br>
        <li>
          <a href="#" class="nav-link">
            
            <p>___________</p>
          </a>
        </li>
        
      </ul>
    </nav>
  </div>
</aside>