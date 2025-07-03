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
          <h1>Edit Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
        <div class="row">
            <div class="col-md-4">
            <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profile</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">

                            <div class="form-group text-center">
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    <img src="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['img'];
                                        }; ?>" class="img-radius" alt="" style="width: 100px; border-radius:15px;">
                                </a><br>
                                <span class="badge badge-warning" style="font-size:25px"><?php
                                    if (isset($_SESSION['user'])) {
                                        echo $_SESSION['user'];
                                    }; ?></span>
                            </div>
                            <div class="form-group text-center">
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    <img src="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['qrcode'];
                                        }; ?>" class="img-radius" alt="" style="width: 100px; border-radius:15px;">
                                </a>
                            <h5 class="text-center">QR Code</h5>
                            </div><h6 class="text-center">_______________________________</h6><br>
                            <div class="form-group text-center" style="font-size:20px;">
                                <label for="inputClientCompany">Contact Number: <h5> <?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['g_mob'];
                                        }; ?></h5>
                                </label>
                            </div>
                            <div class="form-group text-center" style="font-size:20px">
                                <label for="inputClientCompany">GST: <h5> <?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['g_gst'];
                                        }; ?></h5>
                                </label>
                            </div>
                            <div class="form-group text-center" style="font-size:20px">
                                <label for="inputClientCompany">Email: <h5> <?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['g_email'];
                                        }; ?></h5>
                                </label>
                            </div>
                            <div class="form-group text-center" style="font-size:20px">
                                <label for="inputClientCompany">State: <h5> <?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['state'];
                                        }; ?></h5>
                                </label>
                            </div>
                            <div class="form-group text-center" style="font-size:20px">
                                <label for="inputClientCompany">City: <h5> <?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['city'];
                                        }; ?></h5>
                                </label>
                            </div>
                            <div class="form-group text-center" style="font-size:20px">
                                <label for="inputClientCompany">Address: <h5> <?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['g_address'];
                                        }; ?></h5>
                                </label>
                            </div>
                             
                            
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Details</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="adminFunction.php" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <!-- <label for="inputClientCompany">Customer ID</label> -->
                                <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php echo $_SESSION['id']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Garage Name</label>
                                <input type="text" id="inputClientCompany" class="form-control" name="name" value="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['user'];
                                        }; ?>" placeholder="Enter Garage Name" required>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Contact No</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="mobile" value="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['g_mob'];
                                        }; ?>" placeholder="Enter Mobile No" required>
                            </div>
                             <div class="form-group">
                                <label for="inputClientCompany">GST No</label>
                                <input type="text" id="inputClientCompany" class="form-control" name="gst" value="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['g_gst'];
                                        }; ?>" placeholder="Enter GST No">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Email</label>
                                <input type="email" id="inputClientCompany" class="form-control" name="email" value="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['g_email'];
                                        }; ?>" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany"><a class="nav-link" data-toggle="dropdown" href="#">
                                    <img src="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['img'];
                                        }; ?>" class="img-radius" alt="Logo" style="width: 40px; border-radius:15px;">
                                </a>Upload Garage Logo: </label>
                                <input type="file" id="inputClientCompany" class="form-control" name="img" value="" placeholder="Upload Garage Logo">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany"><a class="nav-link" data-toggle="dropdown" href="#">
                                    <img src="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['qrcode'];
                                        }; ?>" class="img-radius" alt="QR CODE" style="width: 40px; border-radius:15px;">
                                </a>Upload QR CODE: </label>
                                <input type="file" id="inputClientCompany" class="form-control" name="qrcode" value="" placeholder="Upload Garage QR">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">State</label>
                                <input type="text" id="inputClientCompany" class="form-control" name="state" value="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['state'];
                                        }; ?>" placeholder="Enter State" required>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">City</label>
                                <input type="text" id="inputClientCompany" class="form-control" name="city" value="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['city'];
                                        }; ?>" placeholder="Enter City" required>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Address</label>
                                <input type="text" id="inputClientCompany" class="form-control" style="height: 60px;" name="address" value="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['g_address'];
                                        }; ?>" placeholder="Enter Address" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="inputClientCompany">Address</label>
                                <textarea type="text" id="inputClientCompany" class="form-control" name="address" value="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['g_address'];
                                        }; ?>" placeholder="Enter Address" required></textarea>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                                    <input type="submit" name="edit-details" value="Save Changes" class="btn btn-success float-right">
                                </form>
                            </div>
                    </div>
                </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.card -->
            <div class="col-md-12">
            </div>
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
</body>

</html>