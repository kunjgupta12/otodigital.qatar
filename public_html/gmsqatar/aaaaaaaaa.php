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
        <form action="adminFunction.php" method="post" id="jobcard" enctype="multipart/form-data">
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
                        
                        <div class="form-group">
                            <!-- <label for="inputClientCompany">Customer ID</label> -->
                            <input type="hidden" id="inputClientCompany" class="form-control" name="uid" value="<?php 
                                $query = "SELECT MAX(uid) as max_uid FROM jobcard";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $max_uid = $row['max_uid'];
                                    
                                // Increment the value
                                $new_uid = $max_uid + 1;
                                    
                                // Output the new_uid value
                                echo $new_uid;
                            ?>">
                        </div>
                    </div>
                    <?php
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM all_vehicle WHERE id='$id'";
                    $res = mysqli_query($conn, $sql);
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) { ?>
                            <div class="card-body">
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">Customer ID</label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php echo $row['g_id']; ?>">
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="c_id" value="<?php echo $row['c_id']; ?>">
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="v_id" value="<?php echo $row['v_id']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">Invoice No:<span class="required-text">*</span></label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="invoice_no" value="<?php echo generateInvoiceNumber1(); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Customer Name:</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="" value="<?php echo $row['name'];?>" placeholder="Enter Name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">WhatsApp/Mobile No:</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="" value="<?php echo $row['contact']; ?>" placeholder="Enter Mobile No" readonly>
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
                            <label for="inputClientCompany">Registration No:<span class="required-text">*</span></label>
                            <input type="text" id="inputClientCompany" name="" class="form-control" value="<?php echo $row['registration']; ?>" placeholder="Enter Registration No." oninput="this.value = this.value.toUpperCase()" pattern="[A-Z0-9]*" title="Please enter only uppercase letters and numbers"  readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Car Make:</label>
                            <select id="inputStatus" name="" class="form-control custom-select" readonly>
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
                            <label for="inputStatus">Car Model:</label>
                            <select id="inputStatus" name="" class="form-control custom-select" readonly>
                                <option value="<?php echo $row['carmodel']; ?>"><?php echo $row['carmodel']; ?></option>
                            </select>
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
                        <div class="form-group">
                            <label for="inputClientCompany">Odometer Reading:</label>
                            <input type="number" id="inputClientCompany" name="odometer" class="form-control" value="" placeholder="Enter Odometer Reading">
                        </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Car Photos</h3>

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
                    <label for="inputStatus">Car RC</label>
                    <select id="inputStatus" name="doc" class="form-control custom-select">
                        <option disabled>Select One</option>
                        <option>yes</option>
                        <option>No</option>
                    </select>
                </div> -->
                <br>
                <div class="form-group">
                    <label for="inputStatus">Car Insurance:<span class="required-text">*</span></label>
                    <select id="inputStatus" name="inventry" class="form-control custom-select">
                        <option disabled>Select One</option>
                        <option>yes</option>
                        <option>No</option>
                    </select>
                </div>
            </div>

        </div>

        <!-- inventory part -->

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Add Parts From Inventory</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div id="wrapper">
                    <div id="form_div">
                        <div class="table-responsive">
                            <table class="table" id="partTable">
                                <thead>
                                    <tr>
                                        <th>Part Name:<span class="required-text">*</span></th>
                                        <th>MRP:<span class="required-text">*</span></th>
                                        <th>HSN Code:</th>
                                        <th>Qty:</th>
                                        <!-- <th>GST%<span class="required-text">*</span></th> -->
                                        <th>Total Cost:</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="partRow1">
                                        
                                        <td>
                                            <input type="hidden" class="partIndex" name="partIndex[]" value="1" readonly/><input type="hidden" name="partId[]" id="partId" class="form-control-sm partId" readonly/>
                                            <select name="partName[]" id="partName1" class="form-control-sm partNameDropdown">
                                                <option value="">Select Parts From Inventory</option>
                                                <?php selectinventory($conn); ?>
                                            </select>
                                        </td>

                                        <td><input type="number" name="partPrice[]" id="partPrice1" placeholder="Price" class="form-control-sm"></td>
                                        <td><input type="text" name="partHsnCode[]" id="partHsnCode1" placeholder="Enter HSN code" class="form-control-sm"></td>
                                        <td><input type="number" name="partQty[]" id="partQTY1" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;"></td>
                                        <!-- <td><input type="number" name="partGst[]" id="partGst1" placeholder="GST%" class="form-control-sm partGst" style="width: 6rem;"></td> -->
                                        <td><input type="text" name="partTotal[]" id="partTotal1" class="form-control-sm partTotal" readonly></td>
                                        <td><button type="button" disabled name="removePart" id="removePart1" class="btn btn-danger btn-sm w-100 removePartButton">Remove</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="form-inline justify-content-between">
                                <div>
                                    <input type="button" class="btn btn-primary" id="addPart" value="Add">
                                </div>
                                <div class="form-inline" style="margin-left: 2rem;">
                                    <label style="padding-right: 8px;">Total</label>
                                    <input type="text" id="partGrandTotal" readonly>
                                </div>
                                <!-- <div class="col-12 mt-4">
                                    <input type="submit" class="btn btn-success float-right" name="btn-done" value="SUBMIT">
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- inventory part -->


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
                        <div class="table-responsive">
                            <table class="table" id="dynamicTable">
                                <thead>
                                    <tr> 
                                        <th>Services Name:<span class="required-text">*</span></th>
                                        <th>Cost:<span class="required-text">*</span></th>
                                        <th>HSN Code:</th>
                                        <th>GST%<span class="required-text">*</span></th>
                                        <th>Taxable Amt:</th> 
                                        <th>Action</th>                                  
                                    </tr>
                                </thead>
                                <tbody>
                                <tr id="1">
                                <!-- <div id="output"></div> -->
                                    <td> <input type="hidden" name="srno[]" class="srno" value="1" readonly/><input type="text" name="service[]" id="service1" placeholder="Enter Service Name" class="form-control-sm"></td>
                                    <td><input type="number" name="price[]" id="price1" placeholder="Price" class="form-control-sm"></td>
                                    <td><input type="text" name="hsn_code[]" id="hsn_code1" placeholder="Enter HSN code" class="form-control-sm"></td>
                                    <td><input type="number" name="gst[]" id="gst1" placeholder="GST%" class="form-control-sm gs_t" style="width: 6rem;"></td>
                                    <td><input type="text" name="total[]" id="total1" class="form-control-sm order_item_price" readonly></td>
                                    <td> <button type="button" disabled name="add"class="btn btn-danger btn-sm w-100">Remove</button></td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="col-md-12">
                                <div class="form-inline justify-content-between">
                                    <div>
                                        <input type="button" class="btn btn-primary" id="add" value="Add">
                                        <!-- <input type="submit" class="btn btn-success" name="btn-done" value="SUBMIT"> -->
                                    </div>
                                    <div class="form-inline" style="margin-left: 2rem;">
                                        <label style="padding-right: 8px;">Total</label>
                                        <!-- <span class="text-success" id="grandtotal"></span> -->
                                        <input type="text" id="grandtotal" readonly>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <a href="all_vehicles.php" class="btn btn-secondary">Cancel</a>
                                        <!-- <input type="button" class="btn btn-primary" id="add" value="Add"> -->
                                        <input type="submit" class="btn btn-success float-right" name="btn-create-jobcard" value="SUBMIT">
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
    var partIndex = 1;

    $("#addPart").click(function () {
        partIndex++;
        var html_code = '';
        html_code += '<tr id="partRow' + partIndex + '">';

        html_code += '<td><input type="hidden" class="partIndex" name="partIndex[]" value="' + partIndex + '" readonly/><input type="hidden" class="partId" name="partId[]" id="partId' + partIndex + '" readonly/><select type="text" name="partName[]" id="partName' + partIndex + '" placeholder="Enter Part Name" class="form-control-sm partNameDropdown">' + $("#partName1").html() + '</td>';
        
        html_code += '<td><input type="number" name="partPrice[]" id="partPrice' + partIndex + '" placeholder="Price" class="form-control-sm"></td>';
        html_code += '<td><input type="text" name="partHsnCode[]" id="partHsnCode' + partIndex + '" placeholder="Enter HSN code" class="form-control-sm"></td>';
        
        html_code += '<td><input type="number" name="partQty[]" id="partQTY' + partIndex + '" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;"></td>';

        // html_code += '<td><input type="number" name="partGst[]" id="partGst' + partIndex + '" placeholder="GST%" class="form-control-sm partGst" style="width: 6rem;"></td>';
        html_code += '<td><input type="text" name="partTotal[]" id="partTotal' + partIndex + '" class="form-control-sm partTotal" readonly></td>';
        html_code += '<td><button type="button" name="removePart" id="removePart' + partIndex + '" class="btn btn-danger btn-sm remove-part w-100 removePartButton">Remove</button></td>';
        $("#partTable").append(html_code);
    });

    $(document).on('change', '.partNameDropdown', function () {
    var partIndex = $(this).closest('tr').find('.partIndex').val();
    var selectedProduct = $(this).val();
    
    // Assuming the product data includes SalePrice and PartNumber
    var salePrice = $(this).find(':selected').data('sale-price');
    var partNumber = $(this).find(':selected').data('part-number');
    
    // Update the partPrice and partHsnCode fields
    $('#partPrice' + partIndex).val(salePrice);
    $('#partHsnCode' + partIndex).val(partNumber);
    
    // Recalculate the total after updating the fields
    calculatePartFinalTotal();
    });

    $(document).on('click', '.removePartButton', function () {
        var partRowId = $(this).closest('tr').attr('id');
        var grandTotal = $('#partGrandTotal').val();
        var partTotal = $('#partTotal' + partRowId).val();
        var finalTotal = parseFloat(grandTotal) - parseFloat(partTotal);
        $('#partGrandTotal').val(finalTotal.toFixed(2));
        $(this).parents('tr').remove();
        partIndex--;
    });

    // Calculation for GST amount and total grand total amount
    function calculatePartFinalTotal() {
        var finalPartTotal = 0;

        for (var j = 1; j <= partIndex; j++) {
            var price = $('#partPrice' + j).val();
            var qty = $('#partQTY' + j).val(); // Added line to get quantity
            var gst = $('#partGst' + j).val();
            
            // var perGst = price * gst / 100;
            var subtotal = parseFloat(price);
            
            // Calculate total based on quantity
            var total = subtotal * qty;
            
            finalPartTotal += parseFloat(total);
            
            $('#partTotal' + j).val(total.toFixed(2));
        }

        $('#partGrandTotal').val(finalPartTotal.toFixed(2));
    }

    $(document).on('keyup', '.partGst', function () {
        if ($('#partGst' + partIndex).val() == '') {
            $('#partTotal' + partIndex).val(0);
        }
        calculatePartFinalTotal();
    });
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
        html_code += '<td><input type="text" name="total[]" id="total'+i+'" class="form-control-sm order_item_price" readonly></td>';
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
        var sum = parseFloat(price) + parseFloat(pergst);
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

<script>
    function validateMobileNumber(input) {
        // Remove non-numeric characters from the input
        var mobileNumber = input.value.replace(/\D/g, '');

        // Check if the length is exactly 10 digits
        if (mobileNumber.length === 10) {
            input.setCustomValidity('');
        } else {
            input.setCustomValidity('Mobile number must be 10 digits');
        }
    }
</script>
<script>
    $(document).ready(function() {
        // Apply Select2 to the partName dropdown
        $('#partName1').select({
            placeholder: 'Select Part',
            allowClear: true,
            // Add any additional options or configurations here
        });

        // Add event listener to update SalePrice and HSNCode on dropdown change
        $('#partName1').on('change', function() {
            var selectedOption = $(this).find(':selected');
            var partId = selectedOption.data('part-id');
            var salePrice = selectedOption.data('sale-price');
            var partNumber = selectedOption.data('part-number');

            // Update the SalePrice and HSNCode input fields
            $('#partId').val(partId);
            $('#partPrice1').val(salePrice);
            $('#partHsnCode1').val(partNumber);
        });
    });
</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the form element by its ID
            var form = document.getElementById('jobcard'); // Replace 'yourFormID' with the actual ID of your form

            form.addEventListener('submit', function() {
                // Show the loader when the form is submitted
                document.getElementById('loader').style.display = 'block';
            });
        });
    </script>
</body>

</html>











<?php
////////////////////////Edit JobCard//////////////////////////////////


if (isset($_POST['btn-edit'])) {
    update_jobcard($conn);
}

function update_jobcard($conn) {
    try {
        $conn->begin_transaction();

        $uid = $_POST['uid'];
        $g_id = $_POST['g_id'];

        $partIndex = $_POST['partIndex'];
        $partName = $_POST['partName'];
        $partPrice = $_POST['partPrice'];
        $partHsnCode = $_POST['partHsnCode'];
        $partQty = $_POST['partQty'];
        // $partGst = $_POST['partGst'];
        $partTotal = $_POST['partTotal'];
        $p_s_part = 1;

        $srno = $_POST['srno'];
        $serviceName = $_POST['service'];
        $ser = $_POST['price'];
        $hsn = $_POST['hsn_code'];
        $gst = $_POST['gst'];
        $totalprice = $_POST['total'];
        $p_s_service = 2;

        // Insert parts
        foreach ($partIndex as $key => $value) {
            $insert_part = $conn->prepare("INSERT INTO jobcode_service_items(p_s, g_id, uid, service, price, hsn_code, qty, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_part->bind_param("iiissssi", $p_s_part, $g_id, $uid, $partName[$key], $partPrice[$key], $partHsnCode[$key], $partQty[$key], $partTotal[$key]);
            if (!$insert_part->execute()) {
                throw new Exception("Error inserting part: " . $insert_part->error);
            }
        }

        // Insert services
        foreach ($srno as $key => $value) {
            $insert_service = $conn->prepare("INSERT INTO jobcode_service_items(g_id, uid, service, price, hsn_code, gst, total, p_s) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_service->bind_param("iisssssi", $g_id, $uid, $serviceName[$key], $ser[$key], $hsn[$key], $gst[$key], $totalprice[$key], $p_s_service);
            if (!$insert_service->execute()) {
                throw new Exception("Error inserting service: " . $insert_service->error);
            }
        }

        // Update jobcard status
        $update_jobcard_status = $conn->prepare("UPDATE jobcard SET work_status = 1 WHERE uid = ?");
        $update_jobcard_status->bind_param("i", $uid);
        if (!$update_jobcard_status->execute()) {
            throw new Exception("Error updating job card status: " . $update_jobcard_status->error);
        }

        $conn->commit();

        // Provide feedback to the user
        echo '<script type="text/JavaScript">';
        echo 'alert("Jobcard Updated Successfully");';
        echo 'window.location= "ShowJobCard.php";';
        echo '</script>';
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();

        // Handle the error (e.g., log it, display a user-friendly message)
        echo 'Error: ' . $e->getMessage();
    }
}



?>