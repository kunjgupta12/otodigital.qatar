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
          <h1>Add Stock</h1>
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
              <h3 class="card-title col-md-10">ADD STOCK</h3>
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
                    $sql = "SELECT * FROM inventory WHERE id='$id'";
                    $res = mysqli_query($conn, $sql);
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) { ?>


              <input type="hidden" id="inputClientCompany" class="form-control" name="id" value="<?php echo $row['id']; ?>">
              <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php echo $row['g_id']; ?>">
              <div class="form-group">
                  <label for="qty">Product :</label>
                  <input type="text" class="form-control" name="Product" value="<?php echo $row['Product']; ?>" placeholder="Product Name">
              </div>

              <!-- <div class="form-group">
                  <input type="text" class="form-control" name="product-desc" value="" placeholder="Description">
              </div> -->

              <div class="form-group">
                  <label for="qty">Part Number :</label>
                  <input type="text" class="form-control" name="PartNumber" value="<?php echo $row['PartNumber']; ?>" placeholder="Part Number">
              </div>

              <div class="form-group">
                  <label for="qty">HSN Code :</label>
                  <input type="text" class="form-control" name="partHsnCode" value="<?php echo $row['HsnCode']; ?>" placeholder="HSN Code">
              </div>

              <div class="form-group">
                  <label for="qty">Location :</label>
                  <input type="text" class="form-control" name="Location" value="<?php echo $row['Location']; ?>" placeholder="Location">
              </div>

              <div class="form-group">
                  <label for="qty">Category :</label>
                  <input type="text" class="form-control" name="Category" value="<?php echo $row['Category']; ?>" placeholder="Category">
              </div>

	        <div class="form-group">
               <div class="row">
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="qty">Part Image :</label>
                    <input type="file" id="inputClientCompany" class="form-control" name="Photo" value="<?php echo $row['Photo']; ?>" placeholder="Part Image">
                  </div>
                 </div>
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="qty">Quantity :</label>
                    <input type="number" class="form-control" name="Stock" value="<?php echo $row['Stock']; ?>">
                  </div>
                 </div>
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="cost-price">Cost Price :</label>
                      <input type="number" min="0" step="any" class="form-control" name="CostPrice" value="<?php echo $row['CostPrice']; ?>">
                  </div>
                 </div>
                  <div class="col-md-3">
                   <div class="form-group">
                        <label for="sale-price">MRP :</label>
                        <input type="number" min="0" step="any" class="form-control" name="SalePrice" value="<?php echo $row['SalePrice']; ?>">
                   </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                        <label for="cgst">Regional Tax(%) :</label>
                        <input type="number" min="0" step="any" class="form-control" name="cgst_percentage" value="<?php echo $row['cgst_percentage']; ?>" max="50">
                   </div>
                  </div>
                
               </div>
            <div>
              <a href="parts_inventory.php" class="btn btn-secondary">Cancel</a>
              <button type="submit" name="update_product" class="btn btn-info float-right">Update</button>
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