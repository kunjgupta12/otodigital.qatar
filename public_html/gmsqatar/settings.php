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
          <h1>Settings</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Settings</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                        <!-- Left Column - col-md-4 -->
                            <div class="col-md-4">
                                <div class="form-group text-center">
                                    <a class="nav-link" data-toggle="dropdown" href="#">
                                        <img src="<?php if (isset($_SESSION['user'])) { echo $_SESSION['img']; }; ?>" class="img-radius" alt="" style="width: 100px; border-radius:15px;">
                                    </a><br>
                                    <span class="badge badge-warning" style="font-size:25px">
                                        <?php if (isset($_SESSION['user'])) { echo $_SESSION['user']; }; ?>
                                    </span>
                                </div>
                                <h6 class="text-center">_______________________________</h6>
                            </div>

                        <!-- Right Column - col-md-8 -->
                    <div class="col-md-8">
                        <form action="adminFunction.php" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <!-- <label for="inputClientCompany">Number</label> -->
                                <input type="hidden" id="inputClientCompany" class="form-control" name="g_mob" value="<?php
                                    if (isset($_SESSION['user'])) {

                                    echo $_SESSION['g_mob'];
                                }; ?>" placeholder="Enter Garage Name" required>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">New Password:</label>
                                <input type="password" id="inputClientCompany" class="form-control" name="password" value="" placeholder="Enter New Password" required>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Re-Type New Password:</label>
                                <input type="password" id="retypePassword" class="form-control" name="" value="" placeholder="Re-Type New Password" required>
                            </div>
                            <div class="row">
                            <div class="col-12">
                                <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                                <input type="submit" name="btn-sub3" value="Update" class="btn btn-success float-right">
                            </form>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->
                </div>
            
                <!-- /.card -->
            </div>
            <!-- /.card -->
        </div>
    </section>
  <!-- /.modal -->
  <!-- Main content -->

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
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            var password = form.querySelector('input[name="password"]').value;
            var retypePassword = form.querySelector('#retypePassword').value;

            if (password !== retypePassword) {
                alert('Passwords do not match. Please re-enter.');
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>
</body>

</html>