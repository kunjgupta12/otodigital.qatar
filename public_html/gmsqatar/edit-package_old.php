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
          <h1>Edit Package</h1>
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
              <h3 class="card-title col-md-10">Package</h3>
              <h3 class="card-title col-md-2"><?php if (isset($_SESSION['msg4'])) {
                                                echo $_SESSION['msg4'];
                                                unset($_SESSION['msg4']);
                                              } ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
         <div class="col-md-12">
<!--     *************************     -->
          <form method="post" action="adminFunction.php" enctype="multipart/form-data">
                  <?php
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM servicepackage WHERE id='$id'";
                    $res = mysqli_query($conn, $sql);
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) { ?>


              <input type="hidden" id="inputClientCompany" class="form-control" name="id" value="<?php echo $row['id']; ?>">
              <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php echo $row['g_id']; ?>">
              <div class="form-group">
                  <label for="qty">Package :</label>
                  <input type="text" class="form-control" name="package" value="<?php echo $row['package']; ?>" placeholder="Package Name">
              </div>

              <div class="form-group">
                  <label for="qty">Price :</label>
                  <input type="number" class="form-control" name="packageprice" value="<?php echo $row['packageprice']; ?>" placeholder="Price">
              </div>

              <div class="form-group">
              <label for="discountprice">Discount Price:</label>
              <input type="number"  class="form-control" name="discountprice" placeholder="Discount Price" value="<?php echo $row['discountprice']; ?>">
              </div>

              <div class="form-group">
              <label for="hsncode">Hsn Code:</label>   
              <input type="text"  class="form-control" name="hsncode" placeholder="Hsn Code" value="<?php echo $row['hsncode']; ?>">
              </div>
    
              <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="stock">Quantity:</label>  
              <input type="number"  class="form-control" name="stock" placeholder="Quantity" value="<?php echo $row['stock']; ?>">
              </div>
              </div>
              <div class="col-md-4">
              <div class="form-group">
              <label for="cgst">CGST:</label>  
              <input type="number"  class="form-control" name="cgst_percentage" placeholder="CGST" value="<?php echo $row['cgst_percentage']; ?>">
              </div>
              </div>
              <div class="col-md-4">
              <div class="form-group">
              <label for="sgst">SGST:</label>  
              <input type="number"  class="form-control" name="sgst_percentage" placeholder="SGST" value="<?php echo $row['sgst_percentage']; ?>">
              </div>
              </div>
              </div>

              <a href="addpackage.php" class="btn btn-secondary">Cancel</a>
              <button type="submit" name="update_package" class="btn btn-info float-right">Update</button>
            </div>
    <?php }
                    } ?>

<!--     *************************     -->
          </form>

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