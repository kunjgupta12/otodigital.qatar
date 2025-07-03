<?php require "adheader.php"; ?>
<?php require "slidebar.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Customer Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>            
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                                <form action="adminFunction.php" method="post" enctype="multipart/form-data">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Customer Information</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                
                            <form method="post" action="adminFunction.php" enctype="multipart/form-data">
                            <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM customer WHERE id='$id'";
                                $res = mysqli_query($conn, $sql);
                                $res = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) { ?>

                                    <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php echo $row['g_id']; ?>">
                                    <input type="hidden" id="inputClientCompany" class="form-control" name="c_id" value="<?php echo $row['id']; ?>">
                                    <div class="form-group">
                                        <label for="inputClientCompany">Customer Name/Company Name:<span class="required-text">*</span></label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="name" value="<?php echo $row['cus_name']; ?>" placeholder="Enter Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">WhatsApp Contact No:<span class="required-text">*</span></label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="mobile" value="<?php echo $row['cus_mob']; ?>" placeholder="Enter Mobile No" oninput="validateMobileNumber(this)" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Email:</label>
                                        <input type="email" id="inputClientCompany" class="form-control" name="cus_email" value="<?php echo $row['cus_email']; ?>" placeholder="Enter Email" required>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">GST No(if company or firm<span class="required-text">**</span>):</label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="c_gst" placeholder="Enter GST No" onblur="validateGST()">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Address:<span class="required-text">*</span></label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="c_add" value="<?php echo $row['c_add']; ?>" placeholder="Enter Address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Customer GST:</label>
                                        <input type="text"  name="c_gst" id="c_gst" placeholder="Customer GST" value="<?php echo $row['c_gst']; ?>"  class="form-control" >
                                        </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                                            <input type="submit" name="edit-cus" value="Update Changes" class="btn btn-success float-right">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
    <?php }
                    } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy;2022 <a href="">Garage Software Pvt Ltd</a>.</strong> All rights reserved.
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
<!-- Content Wrapper. Contains page content -->

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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