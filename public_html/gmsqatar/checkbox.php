<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Dashboard</title>
    <link href="img/LOGOKR.png" rel="icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="">
    <div class="wrapper">
        <div class="content">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Customer Job Card </h1>
                        </div>
                    </div>
                </div>
            </section>
            <?php require("adminFunction.php");




            if (isset($_POST['get-data'])) {
                get_data($conn);
            }
            function get_data($conn)
            {
                $mob = $_POST['mob1'];
                $id = $_POST['cust_id'];
                $sql = "SELECT * FROM jobcard WHERE contact='$mob' AND id='$id'";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) { ?>
                        <section class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Customer Information</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="inputClientCompany">Customer ID</label>
                                                <input type="number" id="inputClientCompany" class="form-control" name="uid" value="<?php echo $row['id']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputClientCompany">Customer Name</label>
                                                <input type="text" id="inputClientCompany" class="form-control" name="name" value="<?php echo $row['name']; ?>" placeholder="Enter Name" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputClientCompany">Contact No</label>
                                                <input type="text" id="inputClientCompany" class="form-control" name="mobile" value="<?php echo $row['contact']; ?>" placeholder="Enter Mobile No" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputClientCompany">Email</label>
                                                <input type="email" id="inputClientCompany" class="form-control" name="email" value="<?php echo $row['email']; ?>" placeholder="Enter Email" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputClientCompany">Address</label>
                                                <textarea type="text" id="inputClientCompany" class="form-control" name="address" value="<?php echo $row['address']; ?>" placeholder="Enter Address" disabled></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card card-warning">

                                    </div>
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Book Service's</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        <h5>Total Price:<?php echo $row['totalPrice']; ?></h5>
                                                <?php }
                                        } ?>
                                                <?php $sql = "SELECT * FROM user_service WHERE contact='$mob'";
                                                $res = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($res) > 0) {
                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                                        <form action="adminFunction.php" method="post" enctype="multipart/form-data">
                                                    </div>
                                        <?php  }
                                                } else {
                                                }
                                            }
                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <a href="../../royalApp/index.php" class="btn btn-secondary">Cancel</a>
                                            <a href="../../royalApp/confirm.php" class="btn btn-primary">Confirm</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
    <script src="dist/js/adminlte.min.js"></script>
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