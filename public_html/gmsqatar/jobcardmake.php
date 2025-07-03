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
        <form action="adminFunction.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
            <form action="adminFunction.php" method="post" enctype="multipart/form-data">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Customer Information</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <?php
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM booking_detail WHERE id='$id'";
                    $res = mysqli_query($conn, $sql);
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) { ?>
                            <div class="card-body">
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">Customer ID</label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="uid" value="<?php echo $row['id']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">Customer ID</label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php echo $row['g_id']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">Invoice No:<span class="required-text">*</span></label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="invoice_no" value="<?php echo generateInvoiceNumber(); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Customer Name:</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="name" value="<?php echo $row['name']; ?>" placeholder="Enter Name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">WhatsApp/Mobile No:</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="mobile" value="<?php echo $row['mobile']; ?>" placeholder="Enter Mobile No" readonly>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">Email</label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="email" value="<?php echo $row['email']; ?>" placeholder="Enter Email" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Address:<span class="required-text">*</span></label>
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
                        <!-- <form action="adminFunction.php" method="post" enctype="multipart/form-data"> -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                            <label for="inputStatus">Car Make:<span class="required-text">*</span></label>
                            <select id="inputStatus" name="carbrand" class="form-control custom-select" readonly>
                                <?php 
                                    $brand_sql = "SELECT * FROM `mericar_make`";
                                    $b_result = mysqli_query($conn, $brand_sql);
                                    while($rows = mysqli_fetch_array($b_result)){
                                ?>
                                <option disabled>Select one</option>
                                <option value="<?php echo $rows['makeId']; ?>" <?php echo ($rows['makeId'] == $row['carbrand']) ? 'selected' : ''  ?> ><?php echo $rows['makeTitle']; ?></option>
                                <!-- <option value="<?php echo $row['carbrand']; ?>"><?php echo $row['carbrand']; ?></option> -->
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Car Model:<span class="required-text">*</span></label>
                            <select id="inputStatus" name="carmodel" class="form-control custom-select" readonly>
                                <option disabled>Select one</option>
                                <option value="<?php echo $row['carmodel']; ?>"><?php echo $row['carmodel']; ?></option>
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label for="inputStatus">Fuel Type:<span class="required-text">*</span></label>
                            <select id="inputStatus" name="fuel" class="form-control custom-select">
                                <option disabled>Select one</option>
                                <option value="CNG">CNG</option>
                                <option value="PETROL">PETROL</option>
                                <option value="DIESEL">DIESEL</option>
                                <option value="ELECTRONIC">ELECTRONIC</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Registration No:<span class="required-text">*</span></label>
                            <input type="text" id="inputClientCompany" name="regino" class="form-control" value="" placeholder="Enter Registration No." oninput="this.value = this.value.toUpperCase()" pattern="[A-Z0-9]*" title="Please enter only uppercase letters and numbers" required>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Odometer Reading:</label>
                            <input type="text" id="inputClientCompany" name="odometer" class="form-control" value="" placeholder="Enter Odometer Reading">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
    <?php }
                    } ?>
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
                    <label for="inputStatus">Transmission:<span class="required-text">*</span></label>
                    <select id="inputStatus" name="transmission" class="form-control custom-select">
                        <option disabled>Select one</option>
                        <option value="Manual">Manual</option>
                        <option value="Automatic">Automatic</option>
                        <option value="CVT">CVT</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputStatus">Braking:<span class="required-text">*</span></label>
                    <select id="inputStatus" name="braking" class="form-control custom-select">
                        <option disabled>Select one</option>
                        <option value="ABS">ABS</option>
                        <option value="Non-ABS">Non-ABS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputStatus">Fuel Meter:<span class="required-text">*</span></label>
                    <select id="inputStatus" name="fuelmeter" class="form-control custom-select">
                        <option disabled>Select one</option>
                        <option value="0-10">0-10%</option>
                        <option value="10-30">10%-30%</option>
                        <option value="30-60"> 30%-60%</option>
                        <option value="60-80">60%-80%</option>
                        <option value="80-100">80%-100%</option>
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
                    <label for="inputClientCompany">Interior Images: (Choose Multiple Images)<span class="required-text">*</span></label>
                    <input type="file" id="inputClientCompany" name="img1[]" class="form-control" accept="image/*" placeholder="Choose Multiple Images" multiple>
                </div>
                <div class="form-group">
                    <label for="inputClientCompany">Exterior Images: (Choose Multiple Images)<span class="required-text">*</span></label>
                    <input type="file" id="inputClientCompany" name="img2[]" class="form-control" accept="image/*" placeholder="Choose Multiple Images" multiple>
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
                <!-- <div class="form-group"><br>
                    <label for="inputStatus">Car Documents</label>
                    <select id="inputStatus" name="doc" class="form-control custom-select">
                        <option disabled>Select One</option>
                        <option>yes</option>
                        <option>No</option>
                    </select>
                </div> -->
                <br>
                <div class="form-group">
                    <label for="inputStatus">Car Inventory:<span class="required-text">*</span></label>
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
                <!-- <form action="adminFunction.php" method="post" enctype="multipart/form-data"> -->
                    <div id="form_div">
                            <table class="table" id="dynamicTable">
                                <thead>
                                    <tr> 
                                        <th>Service Name/Part Name:<span class="required-text">*</span></th>
                                        <th>MRP:<span class="required-text">*</span></th>
                                        <th>HSN Code:</th>
                                        <th>GST%<span class="required-text">*</span></th>
                                        <th>Taxable Amt:</th> 
                                        <th>Action</th>                                  
                                    </tr>
                                </thead>
                                <tbody>
                                <tr id="1">
                                <!-- <div id="output"></div> -->
                                    <td> <input type="hidden" name="srno[]" class="srno" value="1" readonly/> <input type="text" name="service[]" id="service1" placeholder="Enter Service Name" class="form-control-sm"></td>
                                    <td><input type="number" name="price[]" id="price1" placeholder="Price" class="form-control-sm"></td>
                                    <td><input type="text" name="hsn_code[]" id="hsn_code1" placeholder="Enter HSN code" class="form-control-sm"></td>
                                    <td><input type="number" name="gst[]" id="gst1" placeholder="GST%" class="form-control-sm gs_t" style="width: 6rem;"></td>
                                    <td><input type="text" name="total[]" id="total1" class="form-control-sm order_item_price"></td>
                                    <td> <button type="button" disabled name="add"class="btn btn-danger btn-sm w-100">Remove</button></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <div class="form-inline justify-content-between">
                                    <div>
                                        <input type="button" class="btn btn-primary" id="add" value="Add">
                                        <!-- <input type="submit" class="btn btn-success" name="btn-done" value="SUBMIT"> -->
                                    </div>
                                    <div class="form-inline" style="margin-left: 2rem;">
                                        <label style="padding-right: 8px;">Total</label>
                                        <!-- <span class="text-success" id="grandtotal"></span> -->
                                        <input type="number" id="grandtotal">
                                    </div>
                                    <div class="col-12 mt-4">
                                        <!-- <input type="button" class="btn btn-primary" id="add" value="Add"> -->
                                        <input type="submit" class="btn btn-success float-right" name="btn-done" value="SUBMIT">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </form> -->

                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
        <div class="row">
            <div class="col-12">
                <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
                <input type="hidden" name="btn-done" value="Save Changes" class="btn btn-success float-right">
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
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
     var i = 1;
    $("#add").click(function(){
        var length = $('.srno').length;
        console.log(length, 'length');
        ++i;
        var html_code = '';
        html_code += '<tr id="'+i+'">';
        html_code += '<td><input type="hidden" class="srno" name="srno[]" value="'+i+'" readonly/><input type="text" name="service[]" id="service'+i+'" placeholder="Enter Service Name" class="form-control-sm"></td>';
        html_code += '<td><input type="number" name="price[]" id="price'+i+'" placeholder="Price" class="form-control-sm"></td>';
        html_code += '<td><input type="text" name="hsn_code[]" id="hsn_code'+i+'" placeholder="Enter HSN code" class="form-control-sm"></td>';
        html_code += '<td><input type="number" name="gst[]" id="gst'+i+'" placeholder="GST%" class="form-control-sm gs_t" style="width: 6rem;"></td>';
        html_code += '<td><input type="text" name="total[]" id="total'+i+'" class="form-control-sm order_item_price"></td>';
        html_code += '<td><button type="button" name="remove_row" id="'+i+'" class="btn btn-danger btn-sm remove-tr w-100 remove_row">Remove</button></td>';
        $("#dynamicTable").append(html_code);
    });
    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
    //this section calculation gst amount and total grand total amount
    function cal_final_total(i)
{
    var final_item_total = 0;
    var sum = 0;
    var sum1 = 0;
    var price = 0;
    var gst = 0;
    
    for(j=1; j<=i; j++)
    {
        price = $('#price'+j).val();
        gst = $('#gst'+j).val();
        pergst = price * gst / 100;
        var sum = parseFloat(price) - parseFloat(pergst);
        var sum1 = parseFloat(sum) + parseFloat(sum1);
        $('#total'+j).val(sum.toFixed(2));        
    }
    $('#grandtotal').val(sum1.toFixed(2));

}
$(document).on('keyup', '.gs_t', function(){
    if($('#gst'+i).val() ==''){
        $('#order_item_price'+i).val(0);
    }
    cal_final_total(i);
});

    //remove button click
    $(document).on('click', '.remove-tr', function(){
    var ntrid = $(this).closest('tr').attr('id');
    var grandtotal = $('#grandtotal').val();
    var ntotal = $('#total'+ntrid).val();
    var nfinal =  parseFloat(grandtotal) - parseFloat(ntotal);
    // console.log(nfinal, 'ntrid');
    $('#grandtotal').val(nfinal.toFixed(2));
    $(this).parents('tr').remove();
    i--;  
});
</script>
    <style>
        .required-text {
            color: red;
        }
    </style>
</body>

</html>