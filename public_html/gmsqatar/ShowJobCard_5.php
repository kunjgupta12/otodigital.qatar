<?php require "adheader.php"; ?>
<?php require "slidebar.php"; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Show All Jobcards </h1>
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
              <h3 class="card-title col-md-10">All Job Cards > <b>Invoices</b> > View/Edit/Delete <b>Jobcard</b></h3>
              
              <h3 class="card-title col-md-2"><?php if (isset($_SESSION['msg4'])) {
                                                echo $_SESSION['msg4'];
                                                unset($_SESSION['msg4']);
                                              } ?></h3>
            </div>
           
           
            <form method="POST" action="">
  <div class="row align-items-end" style="margin: 10px; gap: 10px;">

    <!-- Filter Type -->
    <div class="col-md-2 col-sm-6">
      <label><strong>Filter Type</strong></label>
      <select name="filter_type" class="form-control" onchange="this.form.submit()">
        <option value="Today" <?= (!isset($_POST['filter_type']) || $_POST['filter_type'] == 'Today') ? 'selected' : '' ?>>Today</option>
        <option value="month" <?= (isset($_POST['filter_type']) && $_POST['filter_type'] == 'month') ? 'selected' : '' ?>>This Month</option>
        <option value="custom" <?= (isset($_POST['filter_type']) && $_POST['filter_type'] == 'custom') ? 'selected' : '' ?>>Custom Range</option>
      </select>
    </div>

    <!-- Month -->
    <div class="col-md-2 col-sm-6" id="monthFilter" style="<?= (isset($_POST['filter_type']) && $_POST['filter_type'] == 'month') ? '' : 'display: none;' ?>">
      <label>Month</label>
      <select name="month" class="form-control">
        <?php
        for ($m = 1; $m <= 12; $m++) {
          $monthName = date('F', mktime(0, 0, 0, $m, 10));
          $selected = (isset($_POST['month']) && $_POST['month'] == $m) ? 'selected' : '';
          echo "<option value='$m' $selected>$monthName</option>";
        }
        ?>
      </select>
    </div>

    <!-- Year -->
    <div class="col-md-2 col-sm-6" id="monthYear" style="<?= (isset($_POST['filter_type']) && $_POST['filter_type'] == 'month') ? '' : 'display: none;' ?>">
      <label>Year</label>
      <select name="year" class="form-control">
        <?php
        $currentYear = date('Y');
        for ($y = $currentYear; $y >= $currentYear - 10; $y--) {
          $selected = (isset($_POST['year']) && $_POST['year'] == $y) ? 'selected' : '';
          echo "<option value='$y' $selected>$y</option>";
        }
        ?>
      </select>
    </div>

    <!-- Custom Range -->
    <div class="col-md-2 col-sm-6" id="customFilter" style="<?= (isset($_POST['filter_type']) && $_POST['filter_type'] == 'custom') ? '' : 'display: none;' ?>">
      <label>Start Date</label>
      <input type="date" name="from_date" class="form-control" value="<?= $_POST['from_date'] ?? '' ?>">
    </div>

    <div class="col-md-2 col-sm-6" id="customToDate" style="<?= (isset($_POST['filter_type']) && $_POST['filter_type'] == 'custom') ? '' : 'display: none;' ?>">
      <label>End Date</label>
      <input type="date" name="to_date" class="form-control" value="<?= $_POST['to_date'] ?? '' ?>">
    </div>

    <!-- Search Button for Filter -->
    <div class="col-md-1 col-sm-6 d-flex">
      <button type="submit" name="filter" class="btn btn-success w-100">Search</button>
    </div>

    <!-- Vehicle No -->
    <div class="col-md-2 col-sm-6">
      <label><strong>Vehicle No.</strong></label>
      <input type="text" class="form-control" name="registration" placeholder="Enter Vehicle No" value="<?= $_POST['registration'] ?? '' ?>">
    </div>

    <!-- Search Button for Vehicle -->
    <div class="col-md-1 col-sm-6 d-flex">
      <button type="submit" name="vehicle_search" class="btn btn-success w-100">Search</button>
    </div>

  </div>
         </form>



         
<script>
  document.querySelector('select[name="filter_type"]').addEventListener('change', function () {
    const type = this.value;
    document.getElementById('monthFilter').style.display = (type === 'month') ? '' : 'none';
    document.getElementById('monthYear').style.display = (type === 'month') ? '' : 'none';
    document.getElementById('customFilter').style.display = (type === 'custom') ? '' : 'none';
    document.getElementById('customToDate').style.display = (type === 'custom') ? '' : 'none';
  });
</script>


            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-center">Job&nbsp;Card&nbsp;Type</th>
                    <th class="text-center">Vehicles Name</th>
                    <th class="text-center">Customer Details</th>
                    
                    <!--<th class="text-center">Mobile</th>-->
                    <!--<th class="text-center">Car Brand</th>-->
                    <!--<th class="text-center">Car Make</th>-->
                   
                    <th class="text-center">Created Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Send Approval</th>
                   
                    <th class="text-center">Action/Invoices</th>
                    <th class="text-center">Payment&nbsp;Status</th>
                    <th class="text-center">Assign To</th>
                    <th class="text-center"> View/Edit/Delete Jobcard</th>
                  </tr>
                </thead>
                <tbody>

                  <?php display_jobcard($conn); ?>
                </tbody>

                <script>
                    function copyWhatsAppMessage() {
                    var copyText = document.getElementById("whatsappMessage");
                    copyText.select();
                    copyText.setSelectionRange(0, 99999); // For mobile devices
                    document.execCommand("copy");
           alert("WhatsApp message link copied !");
} 
</script>
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
            
                
                $('.dropdown-select1').change(function() {
                    var Uid = $(this).closest('tr').find('.checkbox-row').data('uid');
                    var mechanicId = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: 'update_mechanic.php',
                        data: { Uid: Uid, mechanicId: mechanicId },
                        success: function(response) {
                            // Handle success
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            console.error(xhr.responseText);
                        }
                    });
                });
          
        </script>



</body>

</html>