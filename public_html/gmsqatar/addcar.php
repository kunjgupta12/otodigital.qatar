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
                    <h1>Add Vehicle </h1>
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
                                <input type="hidden" id="inputClientCompany" class="form-control" name="v_id" value="<?php
                                                                                                                        $query = "SELECT MAX(v_id) as max_vid FROM all_vehicle";
                                                                                                                        $result = mysqli_query($conn, $query);
                                                                                                                        $row = mysqli_fetch_assoc($result);
                                                                                                                        $max_vid = $row['max_vid'];

                                                                                                                        // Increment the value
                                                                                                                        $new_vid = $max_vid + 1;

                                                                                                                        // Output the new_uid value
                                                                                                                        echo $new_vid;
                                                                                                                        ?>">
                            </div>
                        </div>
                        <?php
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM customer WHERE id='$id'";
                        $res = mysqli_query($conn, $sql);
                        $res = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) { ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">Customer ID</label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php echo $row['g_id']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="inputClientCompany">Customer ID</label> -->
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="c_id" value="<?php echo $row['c_id']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Customer Name:</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="name" value="<?php echo $row['cus_name']; ?>" placeholder="Enter Name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">WhatsApp/Mobile No:</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="mobile" value="<?php echo $row['cus_mob']; ?>" placeholder="Enter Mobile No" readonly>
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
                                <input type="text" id="inputClientCompany" name="regno" class="form-control" value="" placeholder="Enter Registration No." oninput="this.value = this.value.toUpperCase()" pattern="[A-Z0-9]*" title="Please enter only uppercase letters and numbers" required>
                            </div>
                            <div class="form-group">
                                <label for="brand">Car Brand:<span class="required-text">*</span></label>
                                <select name="brand" id="brand" class="form-control" onchange="handleOtherFieldToggle()">
                                    <option>Select Brand</option>
                                 
                                </select>
                            </div>

                            <div class="form-group" id="otherBrandInput" style="display: none;">
                                <label for="otherBrand">Enter Brand Name:<span class="required-text">*</span></label>
                                <input type="text" id="otherBrand" name="other_brand" class="form-control" placeholder="Enter Brand">
                            </div>

                            <div class="form-group" id="modelselect">
                                <label for="model">Car Model:<span class="required-text">*</span></label>
                                <select id="model" name="model" class="form-control">
                                    <option>Select Model</option>
                                </select>
                            </div>

                            <div class="form-group" id="otherModelInput" style="display: none;">
                                <label for="otherModel">Enter Model Name:<span class="required-text">*</span></label>
                                <input type="text" id="otherModel" name="other_model" class="form-control" placeholder="Enter Model">
                            </div>

                            <script>
                                function handleOtherFieldToggle() {
                                    const brandValue = document.getElementById("brand").value;
                                    const otherBrandInput = document.getElementById("otherBrandInput");
                                    const modelSelect = document.getElementById("modelselect");
                                    const otherModelInput = document.getElementById("otherModelInput");

                                    const isOther = brandValue === "Other";

                                    otherBrandInput.style.display = isOther ? "block" : "none";
                                    modelSelect.style.display = isOther ? "none" : "block";
                                    otherModelInput.style.display = isOther ? "block" : "none";
                                }
                            </script>


                            <!-- <div class="form-group">
                            <label for="inputClientCompany">Car Year:</span></label>
                            <select type="year" id="year" name="car_year" class="form-control">
                                <option>Select Year</option>
                                <option>2024</option>
                                <option>2023</option>
                                <option>2022</option>
                                <option>2021</option>
                                <option>2020</option>
                                <option>2019</option>
                                <option>2018</option>
                                <option>Select Year</option>
                                <option>Select Year</option>
                                <option>Select Year</option>
                                <option>Select Year</option>
                            </select>
                        </div> -->
                            <div class="form-group">
                                <label for="inputClientCompany">Chassis Number:</label>
                                <input type="text" id="inputClientCompany" name="Chessis_no" class="form-control" value="" placeholder="Enter Chassis Number">
                            </div>

                            <div class="form-group">
                                <label for="inputClientCompany">Engine No:</label>
                                <input type="text" name="engine_no" id="engine_no" placeholder="Engine No" class="form-control">
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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
        <!-- /.card -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-12">
                    <a href="allcustomers.php" class="btn btn-secondary">Cancel</a>
                    <input type="submit" name="btn-addcar" value="Save Changes" class="btn btn-success float-right">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#brand').change(function() {
            loadState($(this).find(':selected').text()); // Send the brand title
        });
        loadCountry(); // Call loadCountry() when the document is ready
    });

    function loadCountry() {
        $.ajax({
            type: "POST",
            url: "getmodel.php",
            data: "get=brand"
        }).done(function(result) {
            // Clear existing options before appending new ones
            $("#brand").empty();
            // Prepend "Select Brand" option before appending the result
            $("#brand").append("<option>Select Brand</option>");
            // Append the result to the brand select element
            $("#brand").append(result);
        });
    }

    function loadState(makeTitle) { // Receive the brand title
        $("#model").children().remove();
        $.ajax({
            type: "POST",
            url: "getmodel.php",
            data: "get=model&makeTitle=" + makeTitle // Send the brand title
        }).done(function(result) {
            // Clear existing options before appending new ones
            $("#model").empty();
            // Prepend "Select Brand" option before appending the result
            $("#model").append("<option>Select Brand</option>");
            // Append the result to the model select element
            $("#model").append(result);
        });
    }
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

    $("#addPart").click(function() {
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

    $(document).on('change', '.partNameDropdown', function() {
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

    $(document).on('click', '.removePartButton', function() {
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

    $(document).on('keyup', '.partGst', function() {
        if ($('#partGst' + partIndex).val() == '') {
            $('#partTotal' + partIndex).val(0);
        }
        calculatePartFinalTotal();
    });
</script>
<script type="text/javascript">
    var i = 1;
    $("#add").click(function() {
        var length = $('.srno').length;
        console.log(length, 'length');
        ++i;
        var html_code = '';
        html_code += '<tr id="' + i + '">';
        html_code += '<td><input type="hidden" class="srno" name="srno[]" value="' + i + '" readonly/><input type="text" name="service[]" id="service' + i + '" placeholder="Enter Service Name" class="form-control-sm"></td>';
        html_code += '<td><input type="number" name="price[]" id="price' + i + '" placeholder="Price" class="form-control-sm"></td>';
        html_code += '<td><input type="text" name="hsn_code[]" id="hsn_code' + i + '" placeholder="Enter HSN code" class="form-control-sm"></td>';
        html_code += '<td><input type="number" name="gst[]" id="gst' + i + '" placeholder="GST%" class="form-control-sm gs_t" style="width: 6rem;"></td>';
        html_code += '<td><input type="text" name="total[]" id="total' + i + '" class="form-control-sm order_item_price" readonly></td>';
        html_code += '<td><button type="button" name="remove_row" id="' + i + '" class="btn btn-danger btn-sm remove-tr w-100 remove_row">Remove</button></td>';
        $("#dynamicTable").append(html_code);
    });

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
    //this section calculation gst amount and total grand total amount
    function cal_final_total(i) {
        var final_item_total = 0;
        var sum = 0;
        var sum1 = 0;
        var price = 0;
        var gst = 0;

        for (j = 1; j <= i; j++) {
            price = $('#price' + j).val();
            gst = $('#gst' + j).val();
            pergst = price * gst / 100;
            var sum = parseFloat(price) + parseFloat(pergst);
            var sum1 = parseFloat(sum) + parseFloat(sum1);
            $('#total' + j).val(sum.toFixed(2));
        }
        $('#grandtotal').val(sum1.toFixed(2));

    }
    $(document).on('keyup', '.gs_t', function() {
        if ($('#gst' + i).val() == '') {
            $('#order_item_price' + i).val(0);
        }
        cal_final_total(i);
    });

    //remove button click
    $(document).on('click', '.remove-tr', function() {
        var ntrid = $(this).closest('tr').attr('id');
        var grandtotal = $('#grandtotal').val();
        var ntotal = $('#total' + ntrid).val();
        var nfinal = parseFloat(grandtotal) - parseFloat(ntotal);
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