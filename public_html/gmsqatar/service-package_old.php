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
          <h1>Service Package</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <div class="row">


    <?php require "infodashboard.php"; ?>
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
              <h3 class="card-title col-md-10">All Package : > Add <b>Package</b></h3>
              <h3 class="card-title col-md-2">
                <?php 
                if (isset($_SESSION['msg4'])) {
                  echo $_SESSION['msg4'];
                  unset($_SESSION['msg4']);
                } 
                ?>
              </h3>
              <a class="btn btn-success float-right" href="addpackage.php" title="Add More Products">ADD PACKAGE</a>
            </div>


            <div style="margin-left: 25px;">
              <form class="form-horizontal" action="adminFunction.php" method="post" name="upload_excel" enctype="multipart/form-data">
              <input type="hidden" id="inputClientCompany" class="form-control" name="pid" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['id']; ?>">
              <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['id']; ?>">
                <div class="form-row align-items-center">
                  <!-- File Button -->
                  <div class="col-auto">
                    <label class="col-form-label" for="filebutton">Select Excel/CSV File Only..</label>
                    <input type="file" name="file" id="file" class="input-large">
                  </div>
                  <br><br><br><br>
                  <!-- Button -->
                  <div class="col-auto">
                    <button type="submit" id="submit" name="Import1" title="Click to upload" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                  </div>
                  <div class="col-auto">
                    <a href="download_csv.php?file=uploads/parts/sample.csv" download>
                      <button type="button" title="Download CSV File For Parts Upload" class="btn btn-success">Download Sample</button>
                    </a>
                  </div>
                </div>
              </form>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>Package</th>
                    <th>Price</th>
                    <th>Discount Price</th>
                    <th>Hsn Code</th>
                    <th>Stock</th>
                    <th>CGST(%)</th>
                    <th>SGST(%)</th>
                    <th>Edit/Delete Spares</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $g_id = $_SESSION['id'];
                  display_servicepackage($conn,$g_id);

                  ?>
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
<script>
    function toggleStockForm(rowId) {
        var stockForm = document.getElementById('stockForm_' + rowId);
        stockForm.style.display = (stockForm.style.display === 'none' || stockForm.style.display === '') ? 'block' : 'none';
    }
</script>
</body>

</html>