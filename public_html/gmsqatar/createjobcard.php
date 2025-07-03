<?php require "adheader.php"; ?>
<?php require "slidebar.php";

//  require "function.php";
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">


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
<div class="modal fade" id="addPartModal" tabindex="-1" aria-labelledby="addPartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="partInsertForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPartModalLabel">Add New Spare Part</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label for="newPartName" class="form-label">Part Name</label>
                        <input type="text" class="form-control" id="newPartName" name="Product" required>
                    </div>
                    <div class="col-md-6">
                        <label for="newPartNumber" class="form-label">Part Number</label>
                        <input type="text" class="form-control" id="newPartNumber" name="PartNumber" required>
                    </div>
                    <div class="col-md-6">
                        <label for="newPartName" class="form-label">Location</label>
                        <input type="text" class="form-control" id="Location" name="Location">
                    </div>
                    <div class="col-md-6">
                        <label for="newPartName" class="form-label">Category</label>
                        <input type="text" class="form-control" id="Category" name="Category">
                    </div>
                    <div class="col-md-4">
                        <label for="newSalePrice" class="form-label">Cost Price</label>
                        <input type="number" class="form-control" id="CostPrice" name="CostPrice" step="0.01" required>
                    </div>
                    <div class="col-md-4">
                        <label for="newSalePrice" class="form-label">MRP</label>
                        <input type="number" class="form-control" id="MRP" name="MRP" step="0.01" required>
                    </div>
                    <div class="col-md-4">
                        <label for="newHsnCode" class="form-label">HSN Code</label>
                        <input type="text" class="form-control" id="newHsnCode" name="HsnCode">
                    </div>
                    <div class="col-md-4">
                        <label for="newHsnCode" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="Quantity" name="Quantity">
                    </div>
                    <div class="col-md-2">
                        <label for="newCgst" class="form-label">Regional Tax %</label>
                        <input type="number" class="form-control" id="newCgst" name="cgst_percentage" step="0.01">
                    </div>
                 
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Insert Part</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                        // $res = mysqli_query($conn, $sql);
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
                                        <input type="hidden" id="inputClientCompany" class="form-control" name="invoice_no" value="<?php echo generateInvoiceNumber(); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Customer Name:</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="" value="<?php echo $row['name']; ?>" placeholder="Enter Name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">WhatsApp/Mobile No:</label>
                                        <input type="text" id="inputClientCompany" class="form-control" name="mobile" value="<?php echo $row['contact']; ?>" placeholder="Enter Mobile No" readonly>
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
                                <input type="text" id="inputClientCompany" name="" class="form-control" value="<?php echo $row['registration']; ?>" placeholder="Enter Registration No." oninput="this.value = this.value.toUpperCase()" pattern="[A-Z0-9]*" title="Please enter only uppercase letters and numbers" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Car Brand:</label>
                                <input type="text" id="inputClientCompany" class="form-control" name="" value="<?php echo $row['carbrand']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Car Model:</label>
                                <input type="text" id="inputClientCompany" class="form-control" name="" value="<?php echo $row['carmodel']; ?>" readonly>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
        <?php }
                        } ?>
        <!--<div class="col-md-12">-->
        <!--    <div class="card card-warning">-->
        <!--        <div class="card-header">-->
        <!--            <h3 class="card-title">Assign To</h3>-->

        <!--            <div class="card-tools">-->
        <!--                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">-->
        <!--                    <i class="fas fa-minus"></i>-->
        <!--                </button>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="card-body">-->
        <!--            <div class="form-group">-->
        <!--                <label for="inputStatus">Select Mechanic<span class="required-text">*</span></label>-->
        <!--                <select class="form-control" name="society_id" id="society_id">-->
        <!--                    <option value="">Select One</option>-->
        <?php
        //     $id = $_SESSION['id'];
        //     $sql = "SELECT id, m_name FROM all_mechanics WHERE g_id='$id'";
        //     $result = $conn->query($sql);
        //     if ($result->num_rows > 0) {
        //         while ($row = $result->fetch_assoc()) {
        //         echo "<option value='" . $row['id'] . "'>" . $row['m_name'] . "</option>";
        //         }
        //     }
        // 
        ?>
        <!--                </select>-->
        <!--            </div>-->
        <!--        </div>-->

        <!--    </div>-->
        <!--</div>-->
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Job Card</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Job Card Type </label>
                        <select name="job_card_type" id="job_card_type" class="form-control">
                            <option value="">Select Job Card Type</option>
                            <option value="Service">Service</option>
                            <option value="Accident">Accident</option>
                            <option value="Repair">Repair</option>
                        </select>

                        <label>Voice Of Customer </label>
                        <textarea id="editor" name="voice_of_customer" rows="3" placeholder="Enter Full Description" class="form-control"></textarea>
                    </div>

                    <!-- Additional fields for Accident type -->
                    <div id="accident_fields" style="display: none; margin-top: 15px;">
                        <div class="form-group">
                            <label>Insurance Code</label>
                            <input type="text" name="insurance_code" class="form-control" placeholder="Enter Insurance Code">
                        </div>
                        <div class="form-group">
                            <label>Insurance Company Name</label>
                            <input type="text" name="insurance_company_name" class="form-control" placeholder="Enter Company Name">
                        </div>
                        <div class="form-group">
                            <label>Insurance GSTIN</label>
                            <input type="text" name="insurance_gstin" class="form-control" placeholder="Enter GSTIN">
                        </div>
                        <div class="form-group">
                            <label>Insurance Claim Number</label>
                            <input type="text" name="insurance_claim_number" class="form-control" placeholder="Enter Claim Number">
                        </div>
                        <div class="form-group">
                            <label>Insurance Policy Number</label>
                            <input type="text" name="insurance_policy_number" class="form-control" placeholder="Enter Policy Number">
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $('#job_card_type').on('change', function() {
                        if ($(this).val() === 'Accident') {
                            $('#accident_fields').slideDown();
                        } else {
                            $('#accident_fields').slideUp();
                        }
                    });
                </script>

                <!-- /.card -->
            </div>
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
                        <label for="inputStatus">Vehicle Insurance:<span class="required-text">*</span></label>
                        <select id="inputStatus" name="inventry" class="form-control custom-select">
                            <option disabled>Select One</option>
                            <option>yes</option>
                            <option>No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Vehicle Insurance Company<span class="required-text">*</span></label>
                        <input type="text" id="insurance_company" class="form-control" name="insurance_company" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Vehicle Insurance Expiry:<span class="required-text">*</span></label>
                        <input type="date" id="inputClientCompany" class="form-control" name="insexpiry" value="">
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

                <div id="parts-dropdown" style="display: none;">
                    <option value="">Select Parts From Inventory</option>
                    <!--<?php selectinventory($conn); ?>-->
                </div>

                <div class="card-body">
                    <div id="wrapper">
                        <div id="form_div">
                            <div class="table-responsive">
                                <span class="mb-2 d-block">Search by Name</span>
                                <table class="table" id="partTable">
                                    <thead>
                                        <tr>
                                            <th>Part Name<span class="required-text">*</span></th>
                                            <th>MRP<span class="required-text">*</span></th>
                                            <th>Discounted Price <span class="required-text">*</span></th>
                                            <th>Part Number</th>
                                            <th>HSN Code</th>
                                            <th>Qty</th>
                                            <th>Regional Tax(%)<span class="required-text">*</span></th>

                                            <th>Total Cost</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyByName">
                                        <tr id="partRow1">
                                            <td>
                                                <input type="hidden" class="partIndex" name="partIndex[]" value="1" readonly />
                                                <input type="hidden" name="partId[]" id="partId" class="form-control-sm" readonly />
                                                <select name="partName[]" id="partName1" class="form-control-sm partNameDropdown" onchange="setPartsData(1)">
                                                    <option value="">Select Parts From Inventory</option>

                                                </select>
                                            </td>
                                            <td><input type="number" step=".01" name="partPrice[]" id="partPrice1" placeholder="Price" class="form-control-sm"></td>
                                            <td><input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPrice1" placeholder="Discounted Price" class="form-control-sm"></td>
                                            <td><input type="text" name="partNumber[]" id="part_number" placeholder="Enter Part Number" class="form-control-sm"></td>
                                            <td><input type="text" name="partHsnCode[]" id="partHsnCode1" placeholder="Enter HSN code" class="form-control-sm"></td>
                                            <td><input type="number" step=".01" name="partQty[]" id="partQTY1" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;" value="0"></td>
                                            <td>
                                                <input type="number" step=".01" name="partCgst[]" id="partCgst1" placeholder="Regional Tax %" class="form-control-sm partGst" style="width: 6rem;" value="0">
                                                <input type="hidden" name="partCgstValue[]" id="partCgstValue1" value="0">
                                            </td>

                                            <td><input type="number" name="partTotal[]" id="partTotal1" class="form-control-sm partTotal"></td>
                                            <td><button type="button" disabled name="removePart" id="removePart1" class="btn btn-danger btn-sm w-100 removePartButton">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="col-md-12 mt-2">
                                    <div class="form-inline justify-content-between">
                                        <div>
                                            <input type="button" class="btn btn-primary" id="addPart" data-mode="name" value="Add Spares" style="margin-right: 10px;">
                                            <a class="btn btn-warning float-right" id='addInventory' title="Add Spares In Inventory">Add Inventory</a>
                                         </div>
                                        <div class="form-inline" style="margin-left: 2rem;">
                                            <label style="padding-right: 8px;">Discount (%)</label>
                                            <input style="margin-right: 10px;" name="part_discount" type="number" min="0" max="100" id="partDiscount" class="partGst" value="0">
                                            <label style="padding-right: 8px;">Total Payable</label>
                                            <input type="text" id="partGrandTotal" readonly>
                                        </div>
                                    </div>
                                </div>

                                <span class="mb-2 d-block">Search by Number</span>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Part Name<span class="required-text">*</span></th>
                                            <th>MRP<span class="required-text">*</span></th>
                                            <th>Discounted Price <span class="required-text">*</span></th>
                                            <th>Part Number</th>
                                            <th>HSN Code</th>
                                            <th>Qty</th>
                                            <th>Regional Tax(%)<span class="required-text">*</span></th>

                                            <th>Total Cost</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyByNumber">
                                        <tr id="partRowNumber1">
                                            <td><input type="text" name="partName[]" id="partNameN1" placeholder="Part Name" class="form-control-sm"></td>
                                            <td><input type="number" step=".01" name="partPrice[]" id="partPriceN1" placeholder="Price" class="form-control-sm"></td>
                                            <td><input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPriceN1" placeholder="Discounted Price" class="form-control-sm"></td>
                                            <td>
                                                <input type="hidden" class="partIndex" name="partIndex[]" value="1" />
                                                <input type="hidden" name="partId[]" id="partIdN1" class="form-control-sm" />
                                                <select name="partNumber[]" id="partNumberN1" class="form-control-sm partNumberDropdown" onchange="setPartNumberData(1)">
                                                    <option value="">Select Part Number</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="partHsnCode[]" id="partHsnCodeN1" placeholder="Enter HSN code" class="form-control-sm"></td>
                                            <td><input type="number" step=".01" name="partQty[]" id="partQTYN1" placeholder="QTY" class="form-control-sm partGstN" style="width: 6rem;" value="0"></td>
                                            <td>
                                                <input type="number" step=".01" name="partCgst[]" id="partCgstN1" placeholder="Regional Tax%" class="form-control-sm partGstN" style="width: 6rem;" value="0">
                                                <input type="hidden" name="partCgstValue[]" id="partCgstValue1" value="0">
                                            </td>

                                            <td><input type="number" name="partTotal[]" id="partTotalN1" class="form-control-sm partTotal" readonly></td>
                                            <td><button type="button" disabled name="removePart" id="removePart1" class="btn btn-danger btn-sm w-100 removePartButton">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="col-md-12 mt-2">
                                    <div class="form-inline justify-content-between">
                                        <div>
                                            <input type="button" class="btn btn-primary" id="addPartNumber" data-mode="name" value="Add Spares" style="margin-right: 10px;">
                                         <a class="btn btn-warning float-right" id='addInventoryN' title="Add Spares In Inventory">Add Inventory</a>
                                          </div>
                                        <div class="form-inline" style="margin-left: 2rem;">
                                            <label style="padding-right: 8px;">Discount (%)</label>
                                            <input style="margin-right: 10px;" name="part_discountN" type="number" min="0" max="100" id="partDiscountN" class="partGstN" value="0">
                                            <label style="padding-right: 8px;">Total Payable</label>
                                            <input type="text" id="partGrandTotalN" readonly>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Add Package From </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div id="package-dropdown" style="display: none;">
                    <option value="">Select Service Package </option>
                    <?php selectpackage($conn); ?>
                </div>

                <div class="card-body">
                    <div id="wrapper">
                        <div id="form_div">
                            <div class="table-responsive">
                                <table class="table" id="packageTable">
                                    <thead>
                                        <tr>
                                            <th>Pacakge Name<span class="required-text">*</span></th>
                                            <th>Price<span class="required-text">*</span></th>
                                            <th>Discount Price<span class="required-text">*</span></th>
                                            <th>HSN Code<span class="required-text">*</span></t>
                                            <th>Quantity<span class="required-text">*</span></th>
                                            <th>Regional Tax<span class="required-text">*</span></th>

                                            <th>Total Cost</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="packageRow1">
                                            <td>
                                                <input type="hidden" class="packageIndex" name="packageIndex[]" value="1" readonly />
                                                <input type="hidden" name="packageId[]" id="packageId" class="form-control-sm" readonly />

                                                <select name="packageName[]" id="packageName1" class="form-control-sm packageDropdown select2Package" onchange="setPackageData(1)">
                                                    <option value="">Select Service Package</option>
                                                    <?php selectpackage($conn); ?>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="number" step=".01" name="packagePrice[]" id="packagePrice1" placeholder="Package Price" class="form-control-sm packageGst" readonly>
                                            </td>

                                            <td>
                                                <input type="number" step=".01" name="packageDiscountPrice[]" id="packageDiscountPrice1" placeholder="Discount Price" class="form-control-sm packageGst" readonly>
                                            </td>

                                            <td>
                                                <input type="text" step=".01" name="packageHsnCode[]" id="packageHsnCode1" placeholder="Hsn Code" class="form-control-sm packageGst" readonly>
                                            </td>

                                            <td>
                                                <input type="number" step=".01" name="packageQty[]" id="packageQty1" placeholder="Qty" class="form-control-sm packageGst">
                                            </td>

                                            <td>

                                                <input type="number" step=".01" name="packageCgst[]" id="packageCgst1" placeholder="Regional Tax" class="form-control-sm packageGst" readonly>
                                                <input type="hidden" id="packageCgstValue" name="packageCgstValue[]">

                                            </td>



                                            <td>


                                                <input type="text" id="packageTotal1" name="packageTotal[]" class="form-control-sm packageTotal" readonly>
                                            </td>
                                            <td>
                                                <button type="button" disabled name="removePackage" id="removePackage" class="btn btn-danger btn-sm w-100 removePackageButton">Remove</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="form-inline justify-content-between">
                                    <div>
                                        <input type="button" class="btn btn-primary" id="addPackage" value="Add Package" style="margin-right: 10px;">
                                        <a class="btn btn-warning float-right" href="service-package.php" title="Add Package">Add Package</a>
                                    </div>
                                    <div class="form-inline" style="margin-left: 2rem;">
                                        <label style="padding-right: 8px;">Discount (%)</label>
                                        <input style="margin-right: 10px;" name="package_discount" type="number" min="0" max="100" id="packageDiscount" class="packageGst" value="0">

                                        <label style="padding-right: 8px;">Total Payable</label>
                                        <input type="text" id="packageGrandTotal" name="packageGrandTotal" readonly>
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
                                            <th>Services Name<span class="required-text">*</span></th>
                                            <th>Cost<span class="required-text">*</span></th>
                                            <th>Discounted Cost<span class="required-text">*</span></th>
                                            <th>HSN Code</th>
                                            <th>Regional Tax(%)</th>

                                            <th>Taxable Amt</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="1">
                                            <!-- <div id="output"></div> -->
                                            <td>
                                                <input type="hidden" name="srno[]" class="srno" value="1" readonly />
                                                <input type="text" name="service[]" id="service1" placeholder="Enter Service Name" class="form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number" step=".01" name="price[]" id="price1" placeholder="Price" class="form-control-sm gs_t">
                                            </td>
                                            <td>
                                                <input type="number" step=".01" name="discounted_price[]" id="discountedPrice1" placeholder="Discounted Price" class="form-control-sm" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="hsn_code[]" id="hsn_code1" placeholder="Enter HSN code" class="form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number" step=".01" name="serviceCgst[]" id="cgst1" placeholder="Regional Tax%" class="form-control-sm gs_t" style="width: 6rem;" min="0" max="100" value="0">
                                                <input type="hidden" name="serviceCgstValue[]" id="serviceCgstValue1" value="0">
                                            </td>

                                            <td>
                                                <input type="text" name="total[]" id="total1" class="form-control-sm order_item_price" readonly>
                                            </td>
                                            <td>
                                                <button type="button" disabled name="add" class="btn btn-danger btn-sm w-100">Remove</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="form-inline justify-content-between">
                                    <div>
                                        <input type="button" class="btn btn-primary" id="add" value="Add Service">
                                        <!-- <input type="submit" class="btn btn-success" name="btn-done" value="SUBMIT"> -->
                                    </div>
                                    <div class="form-inline" style="margin-left: 2rem;">
                                        <label style="padding-right: 8px;">Discount(%)</label>
                                        <input style="margin-right: 10px;" type="number" id="service_discount" name="service_discount" value="0" min="0" max="100" class="gs_t">

                                        <label style="padding-right: 8px;">Total Payable</label>
                                        <!-- <span class="text-success" id="grandtotal"></span> -->
                                        <input type="text" id="grandtotal" readonly>
                                    </div>

                                </div>
                                <label>Instruction To Mechanic </label>
                                <textarea id="editor" name="instruction_of_mechanic" placeholder="Enter Full Description" class="form-control"></textarea>

                            </div>
                        </div>
                        <!-- </form> -->

                    </div>

                </div>
                <!-- /.card-body -->
            </div>

            <div class="card card-success">


                <div class="card-body">
                    <div id="wrapper">
                        <!-- <form action="adminFunction.php" method="post" enctype="multipart/form-data"> -->
                        <div id="form_div">
                            <div class="table-responsive">

                                <label>Service Due Date</label>
                                <input type="date" id="service_due_date" class="form-control" name="service_due_date" value="">

                            </div>
                            &nbsp;
                            <div class="col-md-12">


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

       <script>
                                            // Show modal on Add Inventory click
                                            document.getElementById('addInventory').addEventListener('click', function() {
                                                var modal = new bootstrap.Modal(document.getElementById('addPartModal'));
                                                modal.show();
                                            });
   document.getElementById('addInventoryN').addEventListener('click', function() {
                                                var modal = new bootstrap.Modal(document.getElementById('addPartModal'));
                                                modal.show();
                                            });

                                            // Handle AJAX form submission
                                            document.getElementById('partInsertForm').addEventListener('submit', function(e) {
                                                e.preventDefault();

                                                const form = e.target;
                                                const formData = new FormData(form);

                                                fetch('insert_part_modal.php', {
                                                        method: 'POST',
                                                        body: formData
                                                    })
                                                    .then(response => response.json())
                                                    .then(res => {
                                                        if (res.success) {
                                                            alert("✅ " + res.message);
                                                            const modalEl = bootstrap.Modal.getInstance(document.getElementById('addPartModal'));
                                                            modalEl.hide();
                                                            form.reset();

                                                    
                                                        } else {
                                                            alert("❌ " + res.message);
                                                        }
                                                    })
                                                    .catch(err => {
                                                        console.error("AJAX error:", err);
                                                        alert("⚠️ Something went wrong.");
                                                    });
                                            });
                                        </script>
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
    // Initialize Select2 and setup auto-fill functionality
    function initPartNameDropdown() {
        $('.partNameDropdown').each(function() {
            console.log("Initializing select2 for part dropdown...");

            $(this).select2({
                placeholder: "Search Parts...",
                ajax: {
                    url: 'get_parts.php',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var partNameId = $(this).attr('id'); // Gets the ID (e.g., partName1)
                        return {
                            term: params.term,
                            part_name_id: partNameId
                        };
                    },
                    processResults: function(data) {
                        let results = data.results;


                        return {
                            results: data.results
                        };

                    },
                    cache: true
                },
                minimumInputLength: 1,
            }).on('select2:select', function(e) {
                var data = e.params.data;
                var partIndex = $(this).attr('id').replace('partName', '');
                console.log(data);

          

                // Normal flow for existing part
                $('#partId' + partIndex).val(data.part_id);
                $('#partPrice' + partIndex).val(data.sale_price);
                $('#part_number' + partIndex).val(data.part_number);
                $('#partHsnCode' + partIndex).val(data.hsn_code);
                $('#partCgst' + partIndex).val(data.cgst_percentage);
                $('#partSgst' + partIndex).val(data.sgst_percentage);

                var discount = parseFloat($('#partDiscount').val());
                var price = parseFloat(data.sale_price);
                if (!isNaN(price) && !isNaN(discount)) {
                    var discountedPrice = price - (price * discount / 100);
                    $('#partDiscountPrice' + partIndex).val(discountedPrice.toFixed(2));
                }
            });

        });
    }

    function initPartNumberDropdown() {
        $('.partNumberDropdown').each(function() {
            $(this).select2({
                placeholder: "Search Parts...",
                ajax: {
                    url: 'get_partNumber.php',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        const partNumberId = $(this).attr('id');
                        return {
                            term: params.term,
                            part_number_id: partNumberId
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            }).on('select2:select', function(e) {
                const data = e.params.data;
                const partIndex = $(this).attr('id').replace('partNumberN', '');

                // Existing part handling
                $('#partIdN' + partIndex).val(data.part_id);
                $('#partNameN' + partIndex).val(data.id);
                $('#partPriceN' + partIndex).val(data.sale_price);
                $('#partHsnCodeN' + partIndex).val(data.hsn_code);
                $('#partCgstN' + partIndex).val(data.cgst_percentage);
                $('#partSgstN' + partIndex).val(data.sgst_percentage);
                $('#partNumber' + partIndex).val(data.text);

                let discount = parseFloat($('#partDiscountN').val());
                let price = parseFloat(data.sale_price);
                if (!isNaN(price) && !isNaN(discount)) {
                    let discountedPrice = price - (price * discount / 100);
                    $('#partDiscountPriceN' + partIndex).val(discountedPrice.toFixed(2));
                }
            });

        });
    }

    let partIndexN = 1;

    $("#addPartNumber").click(function() {


        partIndexN++;
        let html_code = '';
        html_code += '<tr id="tbodyByNumber' + partIndexN + '">';

        html_code += '<td><input type="text" name="partName[]" id="partNameN' + partIndexN + '" placeholder="Part Name" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partPrice[]" id="partPriceN' + partIndexN + '" placeholder="Price" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPriceN' + partIndexN + '" placeholder="Discounted Price" class="form-control-sm" readonly></td>';

        html_code += '<td><input type="hidden" class="partIndex" name="partIndex[]" value="' + partIndexN + '" readonly />';
        html_code += '<input type="hidden" name="partId[]" id="partIdN' + partIndexN + '" class="form-control-sm" readonly />';
        html_code += '<select name="partNumber[]" id="partNumberN' + partIndexN + '" class="form-control-sm partNumberDropdown" onchange="setPartNumberData(' + partIndexN + ')">';
        html_code += '<option value="">Select Part Number</option>';
        html_code += $("#partNumberN1").html(); // clone existing options
        html_code += '</select></td>';

        html_code += '<td><input type="text" name="partHsnCodeN[]" id="partHsnCodeN' + partIndexN + '" placeholder="Enter HSN code" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partQty[]" id="partQTY' + partIndexN + '" placeholder="QTY" class="form-control-sm partGstN" style="width: 6rem;" value="0"></td>';

        html_code += '<td><input type="number" step=".01" name="partCgst[]" id="partCgstN' + partIndexN + '" placeholder="Regional Tax%" class="form-control-sm partGstN" style="width: 6rem;" value="0">';
        html_code += '<input type="hidden" name="partCgstValue[]" id="partCgstValue' + partIndexN + '" value="0"></td>';


        html_code += '<td><input type="number" name="partTotal[]" id="partTotalN' + partIndexN + '" class="form-control-sm partTotal" readonly></td>';

        html_code += '<td><button type="button" name="removePart" id="removePart' + partIndexN + '" class="btn btn-danger btn-sm w-100 removePartButton">Remove</button></td>';

        html_code += '</tr>';

        $("#tbodyByNumber").append(html_code).show();

        // re-initialize Select2 and other behaviors
        $('#partNumberN' + partIndexN).select2();
        initPartNumberDropdown();

    });


    var partIndex = 1;

    // Add part row functionality
    $("#addPart").click(function() {
        partIndex++;
        var html_code = '';
        html_code += '<tr id="partRow' + partIndex + '">';

        html_code += '<td><input type="hidden" class="partIndex" name="partIndex[]" value="' + partIndex + '" readonly/><input type="hidden" class="partId" name="partId[]" id="partId' + partIndex + '" readonly/><select type="text" name="partName[]" id="partName' + partIndex + '" placeholder="Enter Part Name" class="form-control-sm partNameDropdown" style="width:100% !important;" onchange="setPartsData(' + partIndex + ')">' + $("#parts-dropdown").html() + '</td>';

        html_code += '<td><input type="number" step=".01" name="partPrice[]" id="partPrice' + partIndex + '" placeholder="Price" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPrice' + partIndex + '" placeholder="Discounted Price" class="form-control-sm" readonly></td>';

        html_code += '<td><input type="text" name="partNumber[]" id="part_number' + partIndex + '" placeholder="Enter Part Number" class="form-control-sm"></td>';

        html_code += '<td><input type="text" name="partHsnCode[]" id="partHsnCode' + partIndex + '" placeholder="Enter HSN code" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partQty[]" id="partQTY' + partIndex + '" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;"></td>';

        html_code += '<td><input type="number" step=".01" name="partCgst[]" id="partCgst' + partIndex + '" placeholder="Regional Tax%" class="form-control-sm partGst" style="width: 6rem;"><input type="hidden" name="partCgstValue[]" id="partCgstValue' + partIndex + '" value="0"></td>';


        html_code += '<td><input type="text" name="partTotal[]" id="partTotal' + partIndex + '" class="form-control-sm partTotal" readonly></td>';
        html_code += '<td><button type="button" name="removePart" id="removePart' + partIndex + '" class="btn btn-danger btn-sm remove-part w-100 removePartButton">Remove</button></td>';
        $("#partTable").append(html_code);
        $('#partName' + partIndex).select2(); // Reinitialize select2 for new part
        console.log("INIT PART DROP HITS-----------");
        initPartNameDropdown(); // Re-initialize Select2 for the new dropdown

    });

    function setPartsData(partIndex) {}

    function setPartNumberData(partIndex) {}

    $(document).on('click', '.removePartButton', function() {

        $(this).parents('tr').remove();
        partIndex--;

        calculatePartFinalTotal();
        calculatePartFinalTotalNumber();
    });

    // Calculation for GST amount and total grand total amount
    function calculatePartFinalTotal() {
        var finalPartTotal = 0;

        for (var j = 1; j <= partIndex; j++) {
            var price = $('#partPrice' + j).val();
            var qty = $('#partQTY' + j).val(); // Added line to get quantity
            var cgst = $('#partCgst' + j).val();
            var discount = $('#partDiscount').val();

            if (discount != "undefined") {
                price = price - ((price * discount) / 100);
                $('#partDiscountPrice' + j).val(price.toFixed(2));
            }

            // var perGst = price * gst / 100;
            var perCgst = 0;

            var gstPer = Number(cgst);
            var totalGst = Number(price) - ((Number(price) * 100) / (100 + Number(gstPer)));

            if (cgst != "undefined") {
                perCgst = totalGst;
            }



            // var subtotal = parseFloat(price) + parseFloat(perCgst) + parseFloat(perSgst);
            var subtotal = parseFloat(price);

            // Calculate total based on quantity
            var total = 0;
            if (subtotal > 0) {
                total = subtotal * qty;
            }

            finalPartTotal += parseFloat(total);

            $('#partTotal' + j).val(total.toFixed(2));
            $('#partCgstValue' + j).val(perCgst);

        }

        $('#partGrandTotal').val(finalPartTotal.toFixed(2));
    }

    function calculatePartFinalTotalNumber() {
        var finalPartTotal = 0;

        for (var j = 1; j <= partIndexN; j++) {
            var price = $('#partPriceN' + j).val();
            var qty = $('#partQTYN' + j).val(); // Added line to get quantity
            var cgst = $('#partCgstN' + j).val();
            var discount = $('#partDiscountN').val();

            if (discount != "undefined") {
                price = price - ((price * discount) / 100);
                $('#partDiscountPriceN' + j).val(price.toFixed(2));
            }

            // var perGst = price * gst / 100;
            var perCgst = 0;

            var gstPer = Number(cgst);
            var totalGst = Number(price) - ((Number(price) * 100) / (100 + Number(gstPer)));

            if (cgst != "undefined") {
                perCgst = totalGst;
            }



            // var subtotal = parseFloat(price) + parseFloat(perCgst) + parseFloat(perSgst);
            var subtotal = parseFloat(price);

            // Calculate total based on quantity
            var total = 0;
            if (subtotal > 0) {
                total = subtotal * qty;
            }

            finalPartTotal += parseFloat(total);

            $('#partTotalN' + j).val(total.toFixed(2));
            $('#partCgstValueN' + j).val(perCgst);

        }

        $('#partGrandTotalN').val(finalPartTotal.toFixed(2));
    }
    $(document).on('keyup', '.partGst', function() {

        const mode = $('input[name="searchMode"]:checked').val(); // read from radio directly

        calculatePartFinalTotal();

    });

    $(document).on('change', '.partGst', function() {
        const mode = $('input[name="searchMode"]:checked').val(); // read from radio directly


        calculatePartFinalTotal();

    });
    $(document).on('keyup', '.partGstN', function() {

        const mode = $('input[name="searchMode"]:checked').val(); // read from radio directly

        calculatePartFinalTotalNumber();

    });

    $(document).on('change', '.partGstN', function() {
        const mode = $('input[name="searchMode"]:checked').val(); // read from radio directly


        calculatePartFinalTotalNumber();

    });
</script>

<script type="text/javascript">
    var packageIndex = 1;

    $("#addPackage").click(function() {
        packageIndex++;
        var html_code = '';
        html_code += '<tr id="packageRow1' + packageIndex + '">';
        html_code += '<td><input type="hidden" class="packageIndex" name="packageIndex[]" value="' + packageIndex + '" readonly/><input type="hidden" class="packageId" name="packageId[]" id="packageId' + packageIndex + '" readonly/><select type="text" name="packageName[]" id="packageName' + packageIndex + '" placeholder="Enter Package Name" class="form-control-sm packageDropdown select2Package" style="width:100% !important;" onchange="setPackageData(' + packageIndex + ')">' + $("#package-dropdown").html() + '</td>';
        html_code += '<td><input type="number" step=".01" name="packagePrice[]" id="packagePrice' + packageIndex + '" placeholder="Price" class="form-control-sm packageGst"></td>';
        html_code += '<td><input type="number" step=".01" name="packageDiscountPrice[]" id="packageDiscountPrice' + packageIndex + '" placeholder="Discount Price" class="form-control-sm packageGst"></td>';
        html_code += '<td><input type="text" step=".01" name="packageHsnCode[]" id="packageHsnCode' + packageIndex + '" placeholder="Hsn Code" class="form-control-sm packageGst"></td>';
        html_code += '<td><input type="number" step=".01" name="packageQty[]" id="packageQty' + packageIndex + '" placeholder="Qty" class="form-control-sm packageGst"></td>';
        html_code += '<td><input type="number" step=".01" name="packageCgst[]" id="packageCgst' + packageIndex + '" placeholder="Regional Tax" class="form-control-sm packageGst"></td>';
        html_code += '<td><input type="text" name="packageTotal[]" id="packageTotal' + packageIndex + '" class="form-control-sm packageTotal" readonly></td>';
        html_code += '<td><button type="button" name="removePackage" id="removePackage' + packageIndex + '" class="btn btn-danger btn-sm remove-part w-100 removePackageButton">Remove</button></td>';
        $("#packageTable").append(html_code);
        $('#packageName' + packageIndex).select2();
    });

    function setPackageData(packageIndex) {
        var selectedOption = $('#packageName' + packageIndex).find(':selected');
        console.log(selectedOption.data());
        var packageId = selectedOption.data('package-id');
        var salepprice = selectedOption.data('salep-price');
        var discountPricep = selectedOption.data('discountp-price');
        //var hsnCodep = selectedOption.data('hsnp-code');
        var hsnpcode = selectedOption.data('hsnp-code');
        var cgstp = selectedOption.data('cgstp');

        // Update the SalePrice and HSNCode input fields
        $('#packageId' + packageIndex).val(packageId);
        $('#packagePrice' + packageIndex).val(salepprice);
        $('#packageDiscountPrice' + packageIndex).val(discountPricep);
        // $('#part_number' + partIndex).val(partNumber);
        $('#packageHsnCode' + packageIndex).val(hsnpcode);
        $('#packageCgst' + packageIndex).val(cgstp);

        // Recalculate the total after updating the fields
        calculatePackageFinalTotal();
    }


    $(document).on('click', '.removePackageButton', function() {
        // var partRowId = $(this).closest('tr').attr('id');
        // var grandTotal = $('#partGrandTotal').val();
        // var partTotal = $('#partTotal' + partRowId).val();
        // var finalTotal = parseFloat(grandTotal) - parseFloat(partTotal);
        // $('#partGrandTotal').val(finalTotal.toFixed(2));
        $(this).parents('tr').remove();
        packageIndex--;

        calculatePackageFinalTotal();
    });

    function calculatePackageFinalTotal() {
        var finalPackageTotal = 0;

        for (var j = 1; j <= packageIndex; j++) {
            var price = $('#packagePrice' + j).val();
            var qty = $('#packageQty' + j).val(); // Added line to get quantity
            var cgst = $('#packageCgst' + j).val();

            var discount = $('#packageDiscount').val();

            if (discount != "undefined") {
                price = price - ((price * discount) / 100);
                $('#packageDiscountPrice' + j).val(price.toFixed(2));
            }

            // var perGst = price * gst / 100;
            var perCgst = 0;
            var perSgst = 0;

            var gstPer = Number(cgst) + Number(sgst);
            var totalGst = Number(price) - ((Number(price) * 100) / (100 + Number(gstPer)));

            if (cgst != "undefined") {
                perCgst = totalGst;
            }


            // var subtotal = parseFloat(price) + parseFloat(perCgst) + parseFloat(perSgst);
            var subtotal = parseFloat(price);

            // Calculate total based on quantity
            var total = 0;
            if (subtotal > 0) {
                total = subtotal * qty;
            }

            finalPackageTotal += parseFloat(total);

            $('#packageTotal' + j).val(total.toFixed(2));
            $('#packageCgstValue' + j).val(perCgst);
        }

        $('#packageGrandTotal').val(finalPackageTotal.toFixed(2));
    }

    $(document).on('keyup', '.packageGst', function() {
        // if ($('#partCgst' + partIndex).val() == '' || $('#partSgst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePackageFinalTotal();
    });

    $(document).on('change', '.packageGst', function() {
        // if ($('#partCgst' + partIndex).val() == '' || $('#partSgst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePackageFinalTotal();
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
        html_code += '<td><input type="number" step=".01" name="price[]" id="price' + i + '" placeholder="Price" class="form-control-sm gs_t"></td>';
        html_code += '<td><input type="number" step=".01" name="discounted_price[]" id="discountedPrice' + i + '" placeholder="Price" class="form-control-sm" readonly></td>';
        html_code += '<td><input type="text" name="hsn_code[]" id="hsn_code' + i + '" placeholder="Enter HSN code" class="form-control-sm"></td>';
        html_code += '<td><input type="number" step=".01" name="cgst[]" id="cgst' + i + '" placeholder="Regional Tax%" class="form-control-sm gs_t" style="width: 6rem;" min="0" max="100"><input type="hidden" name="serviceCgstValue[]" id="serviceCgstValue' + i + '" value="0"></td>';
        html_code += '<td><input type="text" name="total[]" id="total' + i + '" class="form-control-sm order_item_price" readonly></td>';
        html_code += '<td><button type="button" name="remove_row" id="' + i + '" class="btn btn-danger btn-sm remove-tr w-100 remove_row">Remove</button></td>';
        $("#dynamicTable").append(html_code);

    });

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
    //this section calculation gst amount and total grand total amount
    function cal_final_total() {
        var sum = 0;
        var sum1 = 0;

        for (j = 1; j <= i; j++) {
            var price = $('#price' + j).val();
            if (price != "undefined") {
                var discount = $('#service_discount').val();

                if (discount != "undefined") {
                    price = price - ((price * discount) / 100);
                    $('#discountedPrice' + j).val(price.toFixed(2));
                }

                var perCgst = 0;

                var cgst = $('#cgst' + j).val();


                if (cgst != "undefined") {
                    var perCgst = price * cgst / 100;
                    $('#serviceCgstValue' + j).val(perCgst);
                }

                sum = parseFloat(price) + parseFloat(perCgst);
                sum1 = parseFloat(sum) + parseFloat(sum1);

                $('#total' + j).val(sum.toFixed(2));
            }
        }

        $('#grandtotal').val(sum1.toFixed(2));
    }

    $(document).on('keyup', '.gs_t', function() {
        // if($('#gst'+i).val() ==''){
        //     $('#order_item_price'+i).val(0);
        // }
        cal_final_total(i);
    });

    $(document).on('change', '.gs_t', function() {
        // if($('#gst'+i).val() ==''){
        //     $('#order_item_price'+i).val(0);
        // }
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
        initPartNameDropdown();

        initPartNumberDropdown();
        // Auto-fill fields on selection
        $('#partName1').on('select2:select', function(e) {
            let data = e.params.data;
            $('#partId').val(data.part_id);
            $('#partPrice1').val(data.sale_price);
            $('#part_number').val(data.part_number);
        });
        $('#partNumber1').on('select2:select', function(e) {
            let data = e.params.data;
            $('#partId').val(data.part_id);
            $('#partPrice1').val(data.sale_price);
            $('#part_number').val(data.part_number);
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Auto-fill fields on selection
        $('#partName' + partIndex).on('select2:select', function(e) {
            let data = e.params.data;
            $('#partId').val(data.part_id);
            $('#partPrice1').val(data.sale_price);
            $('#part_number').val(data.part_number);
        });
        $('#partNumber' + partIndex).on('select2:select', function(e) {
            let data = e.params.data;
            $('#partId').val(data.part_id);
            $('#partPrice1').val(data.sale_price);
            $('#partNumber').val(data.part_number);
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Apply Select2 to the partName dropdown
        // $('#partName1').select({
        //     placeholder: 'Select Part',
        //     allowClear: true,
        //     // Add any additional options or configurations here
        // });

        $('#packageName1').select2();

        // Add event listener to update SalePrice and HSNCode on dropdown change
        $('#packageName1').on('change', function() {
            var selectedOption = $(this).find(':selected');
            var packageId = selectedOption.data('package-id');
            var salepPrice = selectedOption.data('salep-price');
            var discountPrice = selectedOption.data('discount-price');
            var hsnpcode = selectedOption.data('hsnp-code');
            var cgstp = selectedOption.data('cgstp');


            // Update the SalePrice and HSNCode input fields
            $('#packageId').val(packageId);
            $('#packagePrice').val(salepPrice);
            $('#packageDiscountPrice').val(discountPrice);
            $('#packageHsnCode').val(hsnpcode);
            $('#packageCgst').val(cgstp);
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
<!-- <script>
    $(document).ready(function()
    {
        // Initialize select2
        $('#partName1').select2();
    
    });
</script> -->

<script>
    $(document).ready(function() {
        $('.select2Package').select2({
            placeholder: "Select Service Package",
            allowClear: true
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#addInventoryForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('add_product', true);
            formData.append('addinventoryfrom', true);
            $.ajax({
                url: 'adminFunction.php',
                type: 'POST',
                data: formData,

                contentType: false,
                processData: false,
                success: function(response) {
                    var responsevar = JSON.parse(response);

                    // console.log({
                    //     value: responsevar.name,
                    //     text: responsevar.name,
                    //     'data-part-id': responsevar.id,
                    //     'data-sale-price': responsevar.SalePrice,
                    //     'data-part-number': responsevar.PartNumber,
                    //     'data-hsn-code': responsevar.hsncode,
                    //     'data-cgst': responsevar.cgst_percentage,
                    //     'data-sgst': responsevar.sgst_percentage
                    // });

                    var newOption = new Option(responsevar.name, responsevar.name, false, false); // Not selected by default

                    $(newOption)
                        .attr('data-part-id', responsevar.name)
                        .attr('data-sale-price', responsevar.SalePrice)
                        .attr('data-part-number', responsevar.PartNumber)
                        .attr('data-hsn-code', responsevar.hsncode)
                        .attr('data-cgst', responsevar.cgst_percentage)

                    $('#partName1').append(newOption);

                    setTimeout(function() {
                        // location.reload();
                    }, 1000);

                    alert('Product Added Successfully!');

                    //   const modalEl = document.getElementById('addInventoryModal');
                    //   const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    //   modal.hide();

                    $('#addInventoryForm')[0].reset();
                    //loadInventoryOptions(); 
                    // alert('Error: ' + response);

                },
                error: function() {
                    alert('AJAX request failed!');
                }
            });
        });

        //loadInventoryOptions();

    });
</script>
</body>

</html>