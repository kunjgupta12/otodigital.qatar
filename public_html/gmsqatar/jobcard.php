<?php require "adheader1.php"; ?>
<?php require "slidebar1.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>View Jobcard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="mechanic_dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">JobCard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <?php
  $id = $_GET['id'];
  $query = "SELECT jc.*, av.*, cu.* FROM jobcard jc
  JOIN all_vehicle av ON jc.v_id = av.v_id
  JOIN customer cu ON av.c_id = cu.c_id
  JOIN all_mechanics am ON jc.m_id = am.id
  JOIN call_login cl ON jc.g_id = cl.g_id
  WHERE jc.id='$id'";
  $res = mysqli_query($conn, $query);
  
  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) { ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="invoice p-3 mb-3">
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <!-- <img src="<?php echo $row['img']; ?>" alt="" style="width: 40px;">  -->
                      VEHICLE JOBCARD ID : <?php echo $row['uid']; ?>
                      <small class="float-right">Date: <?php echo date("Y-m-d H:i:s", strtotime($row['created_at']."+330 minute")); ?></small>
                    </h4>
                  </div>
                </div>
                <div class="row invoice-info">
                  <div class="col-sm-6 invoice-col">
                    <address>
                     
                    <strong>Customer Name: </strong>  <?php echo $row['name']; ?><br>
                    <strong>Address:</strong>     <?php echo $row['c_add']; ?><br>
                    <strong> Contact:</strong>   <?php echo $row['contact']; ?><br>
                    <strong> Email:</strong>   <?php echo $row['cus_email']; ?><br>
                    <!-- <strong> GST:</strong> <?php echo $row['c_gst']; ?> -->
                    </address>
                  </div>
                  <div class="col-sm-6 invoice-col">
                    <!-- <b>Tax Invoice #<?php echo $row['invoice_no']; ?></b><br> -->
                    <strong>Registration No:</strong>   <?php echo $row['registration']; ?><br>
                    <strong>Car Brand:</strong>   <?php echo $row['carbrand']; ?><br>
                    <strong>Car Model:</strong>   <?php echo $row['carmodel']; ?><br>
                     <strong>Chassis No:</strong>   <?php echo $row['chassis_no']; ?><br> 
                    <br>
                  </div>
                </div>

                <!-- parts items -->
                <!-- <div class="card-header">
                  <h3 class="card-title"><b>PARTS COST</b></h3>
                </div> -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Parts</th>
                          <th>QTY</th>
                          <th>HSN Code</th>
                          <!--<th>GST%</th>-->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $itemId = $row['uid'];
                        $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '1'";
                        $res = mysqli_query($conn, $query);
                        if (mysqli_num_rows($res) > 0) {
                          $i=1;
                          while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['service']; ?></td>
                              <td><?php echo $row['qty']; ?></td>
                              <td><?php echo $row['hsn_code']; ?></td>
                            </tr>
                        <?php $i++; }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div><br>

                <!-- parts items -->

                <!-- <div class="card-header">
                  <h3 class="card-title"><b>SERVICES/OTHERS COST</b></h3>
                </div> -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Service Name</th>
                          <th>HSN Code</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // $itemId = $row['uid'];
                        $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2'";
                        $res = mysqli_query($conn, $query);
                        if (mysqli_num_rows($res) > 0) {
                          $i=1;
                          while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['service']; ?></td>
                              <td><?php echo $row['hsn_code']; ?></td>
                            </tr>
                        <?php $i++; }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.row -->

                <div class="row no-print">
    <div class="col-12 text-center">
        <?php
        $id = $_GET['id'];
        $query = "SELECT jc.*, av.*, cu.* FROM jobcard jc
        JOIN all_vehicle av ON jc.v_id = av.v_id
        JOIN customer cu ON av.c_id = cu.c_id
        JOIN all_mechanics am ON jc.m_id = am.id
        JOIN call_login cl ON jc.g_id = cl.g_id
        WHERE jc.id='$id'";
        $res = mysqli_query($conn, $query);

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { ?>
                <form action="" method="post">
                    <input type="hidden" name="uid" value="<?php echo $row['uid']; ?>">
                    <?php if (($row['work_status'] == 1) || ($row['work_status'] == 2) || ($row['work_status'] == 3) || ($row['work_status'] == 4)) { ?>
                        <input type="submit" class="btn btn-danger" name="int-btn-reset" value="Mark Done">
                    <?php } else { ?>
                        <button class="btn btn-success" disabled>Completed</button>
                    <?php } ?>
                </form>
            <?php }
        } ?>

        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if uid is set
            if (isset($_POST['uid'])) {
                // Update the work_status to 4
                $uid = $_POST['uid'];
                $update_query = "UPDATE jobcard SET work_status = 0, `completed_work_date` = CURDATE() WHERE uid = '$uid'";
                $update_result = mysqli_query($conn, $update_query);
                if ($update_result) {
                    // Redirect or show a success message
                } else {
                    // Handle the error
                }
            }
        }
        ?>
    </div>
</div>

              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
  <?php }
  } ?>

  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer no-print">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://merigarage.com">Garage Software Pvt Ltd</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>

</html>