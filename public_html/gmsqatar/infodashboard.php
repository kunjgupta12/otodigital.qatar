
      <div class="col-lg-3 col-6">      
        <a href="dashboard.php">
        <div class="small-box bg-primary">
          
          <div class="inner d-flex align-items-center justify-content-between" >

          <div>
          <h3><?php countProduct($conn); ?> </h3>

             <p>Total Customers</p>
             </div>

          <img class="img-fluid" src="custom-img/order_App.png" style="width:20%; height:20%; ">

          </div>
        </div>
      </a>
      </div>
      <div class="col-lg-3 col-6">
        <a href="parts_inventory.php">
        <div class="small-box bg-success">
          <div class="inner d-flex align-items-center justify-content-between">
            <div>
            <h3><?php count_all_stock($conn); ?></h3>
            <p>Total Inventory Stocks</p>
            </div>
            <img class="img-fluid" src="custom-img/new-booking-app.png" style="width:20%; height:20%; ">
          </div>
        </div>
        </a>
      </div>
      
      <!--<div class="col-lg-3 col-6">-->
      <!--  <a href="all_vehicles.php">-->
      <!--  <div class="small-box bg-success">-->
      <!--    <div class="inner d-flex align-items-center justify-content-between">-->
      <!--      <div>-->
      <!--      <h3><?php count_all_vehicles($conn); ?></h3>-->
      <!--      <p>Total Vehicles</p>-->
      <!--      </div>-->
      <!--      <img class="img-fluid" src="custom-img/new-booking-app.png" style="width:20%; height:20%; ">-->
      <!--    </div>-->
      <!--  </div>-->
      <!--  </a>-->
      <!--</div>-->



      <!-- ./col -->
      <!-- <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner d-flex align-items-center justify-content-between">

            <div>
            <h3><?php countAppOrder($conn); ?></h3>
            <p>New Order(App)</p>
            </div>

            <img class="img-fluid" src="custom-img/order_App.png" style="width:20%; height:20%; ">

          </div>

        </div>
      </div> -->

      <!-- ./col -->
      <!-- <div class="col-lg-3 col-6">
        <div class="small-box bg-dark">
          <div class="inner d-flex align-items-center justify-content-between">

            <div>
            <h3><?php countAppbooking($conn); ?></h3>
            <p>New Booking(App)</p>
            </div>

            <img class="img-fluid" src="custom-img/new-booking-app.png" style="width:20%; height:20%; ">


          </div>
  


        </div>
      </div> -->

      <!-- ./col -->
      <div class="col-lg-3 col-6">  
        <a href="ShowJobCard.php">
        <div class="small-box bg-danger">
          <div class="inner  d-flex align-items-center justify-content-between">


            <div>
            <h3><?php countjobcard($conn); ?></h3>
            <p>Total Running JobCards</p>
            </div>

            <img class="img-fluid" src="custom-img/total-running-jobcard.png" style="width:20%; height:20%; ">


          </div>
      
        </div>
       </a>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <a href="ShowJobCard.php">
        <div class="small-box bg-warning">

          <div class="inner d-flex align-items-center justify-content-between">

            <div>
            <h3><?php count_complete_jobcard($conn); ?></h3>
            <p>Completed JobCards</p>
            </div>

            <img class="img-fluid" src="custom-img/total-completed-jobcard.png" style="width:20%; height:20%; ">
          </div>
        </div>
       </a>
      </div>
      <!--<div class="col-lg-3 col-6">-->
      <!--  <a href="">-->
      <!--  <div class="small-box bg-success">-->
      <!--    <div class="inner d-flex align-items-center justify-content-between">-->
      <!--      <div>-->
      <!--      <h3><?php count_complete_jobcard($conn); ?></h3>-->
      <!--      <p>Total G Coins</p>-->
      <!--      </div>-->
      <!--      <img class="img-fluid" src="custom-img/g_coin.png" style="width:33%; height:33%; ">-->
      <!--    </div>-->
      <!--  </div>-->
      <!--  </a>-->
      <!--</div>-->