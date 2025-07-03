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
                    <h1>Customer Job Card </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Job Card</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="row">


            <!-- ./col -->
        </div>
    </section>

    <!-- /.modal -->
    <!-- Main content -->
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
                                <form action="adminFunction.php" method="post" enctype="multipart/form-data">
                                   
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">Customer ID</label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php echo $row['g_id']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Customer Name</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="name" value="" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Contact No</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="mobile" value="" placeholder="Enter Mobile No">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Email</label>
                                        <input type="email" id="inputClientCompany" class="form-control" name="email" value="" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Address</label>
                                        <textarea type="text" id="inputClientCompany" class="form-control" name="address" value="" placeholder="Enter Address" required></textarea>
                                    </div>
                            </div>


                            <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-12">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Car Details-1</h3>
                        <form action="adminFunction.php" method="post" enctype="multipart/form-data">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputStatus">Car Brand</label>
                            <select id="inputStatus" name="brand" class="form-control custom-select">
                                <option disabled>Select one</option>
                                <option value=""></option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputStatus">Fuel Type</label>
                            <select id="inputStatus" name="fuel" class="form-control custom-select">
                                <option disabled>Select one</option>
                                <option value="CNG">CNG</option>
                                <option value="PETROL">PETROL</option>
                                <option value="DIESEL">DIESEL</option>
                                <option value="ELECTRONIC">ELECTRONIC</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Registration No.</label>
                            <input type="text" id="inputClientCompany" name="regino" class="form-control" value="" placeholder="Enter Registration No.">
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Odometer Reading</label>
                            <input type="text" id="inputClientCompany" name="odometer" class="form-control" value="" placeholder="Enter Odometer Reading">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
   
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Car Details-2</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputStatus">Transmission</label>
                    <select id="inputStatus" name="transmission" class="form-control custom-select">
                        <option disabled>Select one</option>
                        <option value="Manual">Manual</option>
                        <option value="Automatic">Automatic</option>
                        <option value="CVT">CVT</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputStatus">Braking</label>
                    <select id="inputStatus" name="braking" class="form-control custom-select">
                        <option disabled>Select one</option>
                        <option value="ABS">ABS</option>
                        <option value="Non-ABS">Non-ABS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputStatus">Fuel Meter</label>
                    <select id="inputStatus" name="fuelmeter" class="form-control custom-select">
                        <option disabled>Select one</option>
                        <option value="Upto 25">Upto 25%</option>
                        <option value="Upto 50">Upto 50%</option>
                        <option value="Upto 75">Upto 75%</option>
                        <option value="Upto 100">Upto 100%</option>

                    </select>
                </div>


                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Car Photo</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputClientCompany">Interior Image</label>
                    <input type="file" id="inputClientCompany" name="img1" class="form-control" value="" placeholder="Choose Image">
                </div>
                <div class="form-group">
                    <label for="inputClientCompany">Exterior Image</label>
                    <input type="file" id="inputClientCompany" name="img2" class="form-control" value="" placeholder="Choose Image">
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->
    <div class="col-md-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Other Information</h3>
                <div class="form-group"><br>
                    <label for="inputStatus">Car RC</label>
                    <select id="inputStatus" name="doc" class="form-control custom-select">
                        <option disabled>Select One</option>
                        <option>yes</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputStatus">Car RC</label>
                    <select id="inputStatus" name="inventry" class="form-control custom-select">
                        <option disabled>Select One</option>
                        <option>yes</option>
                        <option>No</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Add Service</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div id="wrapper">

                    <div id="form_div">
                        <form method="post" action="newjobcard.php">
                            <table id="employee_table" align=center>
                            <thead>
                                    <tr> 
                                        <th>Service Name</th>
                                        <th>MRP</th>
                                        <th>GST</th>
                                        <th>Price</th>                                   
                                    </tr>
                                <tr id="row1">
                                    <td><input type="text" name="Service[]" placeholder="Enter Service Name" class="form-control"></td>
                                    <td><input type="text" name="Price[]" placeholder="Price"></td>
                                    <td><input type="text" name="GST[]" placeholder="GST%"></td>
                                    <td><input type="text" name="Total[]"></td>
                                </tr>
                            </table>
                            <input type="button" onclick="add_row();" value="ADD ROW">
                            <input type="submit" name="submit_row" value="SUBMIT">
                        </form>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="form-inline">
                        <div class="form-inline">
                            <label>Total Cost</label>
                            <input type="text" id="total" name="total" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="row">
            <div class="col-12">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" name="btn-done" value="Save Changes" class="btn btn-success float-right">
                </form>
            </div>
        </div>
    </div>
        </div>
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
<script type="text/javascript">
    function add_row() {
        $rowno = $("#employee_table tr").length;
        $rowno = $rowno + 1;
        $("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><input type='text' name='Service[]' placeholder='Enter Service Name'></td><td><input type='text' name='Price[]' placeholder='Price'></td><td><input type='text' name='GST[]' placeholder='GST%'></td><td><input type='text' name='Total[]'></td><td><input type='button' value='DELETE' onclick=delete_row('row" + $rowno + "')></td></tr>");
    }

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
</script>
</body>

</html>
<?php
if(isset($_POST['submit_row']))
{

 $name=$_POST['Service'];
 $age=$_POST['Price'];
 $job=$_POST['GST'];
 $Total=$_POST['Total'];

 for($i=0;$i<count($name);$i++)
 {
  if($name[$i]!="" && $age[$i]!="" && $job[$i]!="" && $Total[$i]!="")
  {
   $sql="insert into employee_table values('$name[$i]','$age[$i]','$job[$i]','$Total[$i]')";	 
  }
 }
}
?>