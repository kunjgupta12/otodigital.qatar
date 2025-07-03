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
          <h1>Add Inventory</h1>
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
              <h3 class="card-title col-md-10">ADD NEW PRODUCT</h3>
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
              <input type="hidden" id="inputClientCompany" class="form-control" name="pid" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['id']; ?>">
              <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['id']; ?>">
              <div class="form-group">
                  <input type="text" class="form-control" name="Product" value="" placeholder="Product Name">
              </div>

              <!-- <div class="form-group">
                  <input type="text" class="form-control" name="product-desc" value="" placeholder="Description">
              </div> -->

              <div class="form-group">
                  <input type="text" class="form-control" name="PartNumber" value="" placeholder="Part Number">
              </div>

              <div class="form-group">
                  <input type="text" class="form-control" name="partHsnCode" value="" placeholder="HSN Code">
              </div>

              <div class="form-group">
                  <input type="text" class="form-control" name="Location" value="" placeholder="Location">
              </div>

              <div class="form-group">
                  <input type="text" class="form-control" name="Category" value="" placeholder="Category">
              </div>

	        <div class="form-group">
               <div class="row">
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="qty">Upload Part Image :</label>
                    <input type="file" id="inputClientCompany" class="form-control" name="Photo" value="" placeholder="Part Image">
                  </div>
                 </div>
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="qty">Quantity :</label>
                    <input type="number" class="form-control" name="Stock" value="">
                  </div>
                 </div>
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="cost-price">Cost Price :</label>
                      <input type="number" min="0" step="any" class="form-control" name="CostPrice" value="">
                  </div>
                 </div>
                  <div class="col-md-3">
                   <div class="form-group">
                        <label for="sale-price">MRP :</label>
                        <input type="number" min="0" step="any" class="form-control" name="SalePrice" value="">
                   </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                        <label for="cgst">Regional Tax(%) :</label>
                        <input type="number" min="0" step="any" class="form-control" name="cgst_percentage" value="" max="50">
                   </div>
                  </div>
                
               </div>
            <div>
              <a href="parts_inventory.php" class="btn btn-secondary">Cancel</a>
              <button type="submit" name="add_product" class="btn btn-info float-right">Add Product</button>
            </div>

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