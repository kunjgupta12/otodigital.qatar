<?php require "adheader1.php"; ?>
<?php require "slidebar1.php";

//  require "function.php";
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>All JObCards : <p id="currentDate" style="color: red;"></p></h1>
          
          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- /.modal -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title col-md-10">All JobCards : >  <b>Update Status</b></h3>
              <h3 class="card-title col-md-2">
                <?php 
                if (isset($_SESSION['msg4'])) {
                  echo $_SESSION['msg4'];
                  unset($_SESSION['msg4']);
                } 
                ?>
              </h3>
              <!-- <a class="btn btn-success float-right" href="addproduct.php" title="Add More Products">ADD PRODUCT</a> -->
            </div>

            <!-- /.card-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <!-- <th>Check all<span>&#x2192;</span> <input type="checkbox" title="Select_All" data-car-id="<?php echo $row['car_id']; ?>" id="checkAll"></th> -->
                    <th>#</th>
                    <th>Customer Details</th>
                    <th>Vehicle Details</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>View Jobcard</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $e_id = $_SESSION['id'];
                  display_jobcard($conn, $e_id);
                  ?>
                </tbody>
              </table>
            </div>
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
<!-- Include jQuery library first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Then include jQuery UI library -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

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
<script>
    function toggleStockForm(rowId) {
        var stockForm = document.getElementById('stockForm_' + rowId);
        stockForm.style.display = (stockForm.style.display === 'none' || stockForm.style.display === '') ? 'block' : 'none';
    }
</script>
<script>
// Get current date
var currentDate = new Date();

// Format the date
var formattedDate = currentDate.toDateString();

// Display the date in the HTML element with id="currentDate"
document.getElementById("currentDate").innerHTML = formattedDate;
</script>

</body>

</html>