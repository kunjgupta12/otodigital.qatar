<?php require "adheader.php"; ?>
<?php require "slidebar.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Mechanic</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                <h3 class="card-title">Mechanic Information</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                    <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['id']; ?>">
                                    <div class="form-group">
                                        <label for="inputClientCompany">Mechanic Name:<span class="required-text">*</span></label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="m_name" placeholder="Enter Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">WhatsApp Contact No:<span class="required-text">*</span></label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="m_mob" placeholder="Enter Mobile No" oninput="validateMobileNumber(this)" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Email:</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="m_email" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Address:<span class="required-text">*</span></label>
                                        <textarea type="text" id="inputClientCompany" class="form-control" name="m_add" value="" placeholder="Enter Address" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Password:<span class="required-text">*</span></label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="password" value="" placeholder="Enter Password" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="all_mechanics.php" class="btn btn-secondary">Cancel</a>
                                            <input type="submit" name="btn-mec" value="Save Changes" class="btn btn-success float-right">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
<script>
    var total = 0;

    function UpdateCost(elem) {

        if (elem.checked == true) {
            total += Number(elem.value);
        } else {
            total -= Number(elem.value);
        }

        document.getElementById('total').value = total.toFixed(0);
    }
</script>
   

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $('#brand').change(function() {
                        loadState($(this).find(':selected').val())
                })
            });

            function loadCountry() {
                $.ajax({
                    type: "POST",
                    url: "getmodel.php",
                    data: "get=brand"
                }).done(function(result) {


                    $(result).each(function() {
                        $("#brand").append($(result));
                    })
                });
            }
            function loadState(makeId) {
                $("#model").children().remove()
                $.ajax({
                    type: "POST",
                    url: "getmodel.php",
                    data: "get=model&makeId=" + makeId
                }).done(function(result) {

                    $("#model").append($(result));

                });
            }
            loadCountry();
        </script>

<script>
    function validateMobileNumber(input) {
        // Remove non-numeric characters from the input
        var mobileNumber = input.value.replace(/\D/g, '');

        // Check if the length is exactly 10 digits
        if (mobileNumber.length === 10) {
            input.setCustomValidity('');
        } else {
            input.setCustomValidity('WhatsApp number must be 10 digits');
        }
    }
</script>
    <style>
        .required-text {
            color: red;
        }
    </style>
    <script>
        function validateGST() {
            var gstInput = document.getElementById('inputClientCompany').value;
            // GST number pattern (you may need to adjust this based on your specific requirements)
            var gstPattern = /^[0-9]{2}[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}[0-9A-Za-z]{1}[A-Za-z]{1}[0-9A-Za-z]{1}$/;

            if (gstInput === '' || gstPattern.test(gstInput)) {
                // GST number is valid or empty (optional)
                alert('GST number is valid!');
                return true;
            } else {
                // GST number is invalid
                alert('Invalid GST number! Please enter a valid GST number or leave it empty.');
                return false;
            }
        }
    </script>
</body>
</html>