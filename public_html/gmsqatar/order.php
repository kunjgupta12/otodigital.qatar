<?php require "adheader.php"; ?>
<?php require "slidebar.php";

//  require "function.php";
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Customer Booking Management </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
          
          <div class="inner d-flex align-items-center justify-content-between" >

          <div>
          <h3><?php countProduct($conn); ?> </h3>

             <p>New Booking (Website)</p>
             </div>

          <img class="img-fluid" src="custom-img/order_website.png" style="width:20%; height:20%; ">

          </div>
        </div>
      </div>



      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner d-flex align-items-center justify-content-between">

            <div>
            <h3><?php countAppOrder($conn); ?></h3>
            <p>New Order(App)</p>
            </div>

            <img class="img-fluid" src="custom-img/order_App.png" style="width:20%; height:20%; ">

          </div>

        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-dark">
          <div class="inner d-flex align-items-center justify-content-between">

            <div>
            <h3><?php countAppbooking($conn); ?></h3>
            <p>New Booking(App)</p>
            </div>

            <img class="img-fluid" src="custom-img/new-booking-app.png" style="width:20%; height:20%; ">


          </div>
  


        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner  d-flex align-items-center justify-content-between">


            <div>
            <h3><?php countjobcard($conn); ?></h3>
            <p>Total Running JobCards</p>
            </div>

            <img class="img-fluid" src="custom-img/total-running-jobcard.png" style="width:20%; height:20%; ">


          </div>
      
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">

          <div class="inner d-flex align-items-center justify-content-between">

            <div>
            <h3><?php count_complete_jobcard($conn); ?></h3>
            <p>Completed JobCards</p>
            </div>

            <img class="img-fluid" src="custom-img/total-completed-jobcard.png" style="width:20%; height:20%; ">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner d-flex align-items-center justify-content-between">
            <div>
            <h3><?php count_complete_jobcard($conn); ?></h3>
            <p>Total G Coins</p>
            </div>
            <img class="img-fluid" src="custom-img/g_coin.png" style="width:33%; height:33%; ">
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </section>

  <!-- /.modal -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title col-md-10">Order Description</h3>
              <h3 class="card-title col-md-2"><?php if (isset($_SESSION['msg4'])) {
                                                echo $_SESSION['msg4'];
                                                unset($_SESSION['msg4']);
                                              } ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Order</th>
                    <th>Order Price</th>
                    <th>Total Price</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>

                  <?php order($conn); ?>
                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">

  <strong>Copyright &copy;2022 <a href="">Garage Software Pvt Ltd</a>.</strong> All rights reserved.
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
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script>
  $(function Readdata() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>

</html>