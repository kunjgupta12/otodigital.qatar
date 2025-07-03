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
                                        <input type="text" id="inputClientCompany" class="form-control" name="" value="<?php echo $row['name'];?>" placeholder="Enter Name" readonly>
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
                            <input type="text" id="inputClientCompany" name="" class="form-control" value="<?php echo $row['registration']; ?>" placeholder="Enter Registration No." oninput="this.value = this.value.toUpperCase()" pattern="[A-Z0-9]*" title="Please enter only uppercase letters and numbers"  readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Car Brand:</label>
                            <input type="text" id="inputClientCompany" class="form-control" name="" value="<?php echo $row['carbrand'];?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Car Model:</label>
                            <input type="text" id="inputClientCompany" class="form-control" name="" value="<?php echo $row['carmodel'];?>" readonly>
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
                        // ?>
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
                        <select name="job_card_type" id="job_card_type" class="form-control ">
                        <option value="">Select Job Card Type</option>
                        <option value="Service">Service</option>
                        <option value="Accident">Accident</option>
                        <option value="Repair">Repair</option>
                       </select>

                       <label>Voice Of Customer </label>
                       <textarea id="editor" name="voice_of_customer" rows="3" placeholder="Enter Full Description" class="form-control "></textarea>
                </div>
                       
                <!-- /.card-body -->
            </div>
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
                <?php selectinventory($conn); ?>
            </div>

            <div class="card-body">
                <div id="wrapper">
                    <div id="form_div">
                        <div class="table-responsive">
                            <table class="table" id="partTable">
                                <thead>
                                    <tr>
                                        <th>Part Name<span class="required-text">*</span></th>
                                        <th>MRP<span class="required-text">*</span></th>
                                        <th>Discounted Price <span class="required-text">*</span></th>
                                        <th>Part Number</th> 
                                        <th>HSN Code</th>
                                        <th>Qty</th>
                                        <th>CGST(%)<span class="required-text">*</span></th>
                                        <th>SGST(%)<span class="required-text">*</span></th>
                                        <th>Total Cost</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="partRow1">                                        
                                        <td>
                                        <input type="hidden" class="partIndex" name="partIndex[]" value="1" readonly/>
                                        <input type="hidden" name="partId[]" id="partId" class="form-control-sm partId" readonly/>
                                        <select name="partName[]" id="partName1" class="form-control-sm partNameDropdown" onchange="setPartsData(1)">
                                         <option value="">Select Parts From Inventory</option>
                                         </select>
                                        </td>
                                        <td>
                                            <input type="number" step=".01" name="partPrice[]" id="partPrice1" placeholder="Price" class="form-control-sm">
                                        </td>
                                        <td>
                                            <input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPrice1" placeholder="Discounted Price" class="form-control-sm" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="partNumber[]" id="part_number" placeholder="Enter Part Number" class="form-control-sm">
                                        </td>
                                        <td>
                                            <input type="text" name="partHsnCode[]" id="partHsnCode1" placeholder="Enter HSN code" class="form-control-sm">
                                        </td>
                                        <td>
                                            <input type="number" step=".01" name="partQty[]" id="partQTY1" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;" value="0">
                                        </td>
                                        <td>
                                            <input type="number" step=".01" name="partCgst[]" id="partCgst1" placeholder="CGST%" class="form-control-sm partGst" style="width: 6rem;" value="0">
                                            <input type="hidden" name="partCgstValue[]" id="partCgstValue1" value="0">
                                        </td>
                                        <td>
                                            <input type="number" step=".01" name="partSgst[]" id="partSgst1" placeholder="SGST%" class="form-control-sm partGst" style="width: 6rem;" value="0">
                                            <input type="hidden" name="partSgstValue[]" id="partSgstValue1" value="0">
                                        </td>
                                        <td>
                                            <input type="text" name="partTotal[]" id="partTotal1" class="form-control-sm partTotal" readonly>
                                        </td>
                                        <td>
                                            <button type="button" disabled name="removePart" id="removePart1" class="btn btn-danger btn-sm w-100 removePartButton">Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="form-inline justify-content-between">
                                <div>
                                    <input type="button" class="btn btn-primary" id="addPart" value="Add Spares" style="margin-right: 10px;">
                                    <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#addInventoryModal">
                                     Add Inventory</button>

                                </div>
                                <div class="form-inline" style="margin-left: 2rem;">
                                    <label style="padding-right: 8px;">Discount (%)</label>
                                    <input style="margin-right: 10px;" name="part_discount" type="number" min="0" max="100" id="partDiscount" class="partGst" value="0">

                                    <label style="padding-right: 8px;">Total Payable</label>
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

  
        


        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Add Package</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div id="parts-dropdown" style="display: none;">
                <option value="">Select Service Package</option>
                <?php selectpackage($conn); ?>
            </div>

            <div class="card-body">
                <div id="wrapper">
                    <div id="form_div">
                        <div class="table-responsive">
                            <table class="table" id="partTable">
                                <thead>
                                    <tr>
                                        <th>Pacakge Name<span class="required-text">*</span></th>
                                        <th>Price<span class="required-text">*</span></th>
                                        <th>Discount Price<span class="required-text">*</span></th>
                                        <th>HSN Code<span class="required-text">*</span></th>
                                        <th>Quantity<span class="required-text">*</span></th>
                                        <th>CGST<span class="required-text">*</span></th>
                                        <th>SGST<span class="required-text">*</span></th>
                                        <th>Total Cost</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr id="packageRow1">                                        
    <td>
        <input type="hidden" name="packageIndex[]" value="1" readonly/>
        <input type="hidden" name="packageId[]" id="packageId1" class="form-control-sm" readonly/>

        <select name="packageName[]" id="packageName1" class="form-control-sm packageDropdown" onchange="setPackageData(1)">
            <option value="">Select Service Package</option>
            <?php selectpackage($conn); ?>
        </select>
    </td>
    
    <td>
        <input type="number" step=".01" name="packagePrice[]" id="packagePrice1" placeholder="Package Price" class="form-control-sm" readonly>
    </td>

    <td>
        <input type="number" step=".01" name="discountprice[]" id="discountprice1" placeholder="Discount Price" class="form-control-sm" readonly>
    </td>

    <td>
        <input type="text" step=".01" name="hsncode[]" id="hsncode1" placeholder="Hsn Code" class="form-control-sm" readonly>
    </td>

    <td>
    <input type="number" step=".01" name="stock[]" id="stock" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;" value="0">
    </td>

    <td>
        
        <input type="number" step=".01" name="cgst_percentage[]" id="cgst_percentage1" placeholder="CGST" class="form-control-sm" readonly>
    </td>

    <td>
        <input type="number" step=".01" name="sgst_percentage[]" id="sgst_percentage1" placeholder="SGST" class="form-control-sm" readonly>
    </td>

    <td>
        <input type="text" name="partTotal[]" id="partTotal1" class="form-control-sm partTotal" readonly>
    </td>
    <td>
        <button type="button" disabled name="removePart" id="removePart1" class="btn btn-danger btn-sm w-100 removePartButton">Remove</button>
    </td>
    </tr>

    </tbody>

 </table>
                        </div>
                        <div class="col-md-12">
                            <div class="form-inline justify-content-between">
                                <div>
                                <input type="button" class="btn btn-primary" id="addPackage" value="Add Spares" style="margin-right: 10px;">    
                                <a href="addpackage.php" class="btn btn-warning float-right">Add Package</a>

                                </div>
                                <div class="form-inline" style="margin-left: 2rem;">
                                    <label style="padding-right: 8px;">Discount (%)</label>
                                    <input style="margin-right: 10px;" name="part_discount" type="number" min="0" max="100" id="partDiscount" class="partGst" value="0">

                                    <label style="padding-right: 8px;">Total Payable</label>
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
                                        <th>CGST(%)</th>
                                        <th>SGST(%)</th>
                                        <th>Taxable Amt</th>
                                        <th>Action</th>                                  
                                    </tr>
                                </thead>
                                <tbody>
                                <tr id="1">
                                <!-- <div id="output"></div> -->
                                    <td> 
                                        <input type="hidden" name="srno[]" class="srno" value="1" readonly/>
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
                                        <input type="number" step=".01" name="serviceCgst[]" id="cgst1" placeholder="CGST%" class="form-control-sm gs_t" style="width: 6rem;" min="0" max="100" value="0">
                                        <input type="hidden" name="serviceCgstValue[]" id="serviceCgstValue1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" step=".01" name="serviceSgst[]" id="sgst1" placeholder="SGST%" class="form-control-sm gs_t" style="width: 6rem;" min="0" max="100" value="0">
                                        <input type="hidden" name="serviceSgstValue[]" id="serviceSgstValue1" value="0">
                                    </td>
                                    <td>
                                        <input type="text" name="total[]" id="total1" class="form-control-sm order_item_price" readonly>
                                    </td>
                                    <td> 
                                        <button type="button" disabled name="add"class="btn btn-danger btn-sm w-100">Remove</button>
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
                                    <textarea id="editor" name="instruction_of_mechanic" placeholder="Enter Full Description" class="form-control" ></textarea>
                                    

                               
                            </div>
                            
                        </div>
                    <!-- </form> -->

                </div>
                
            </div>
            <!-- /.card-body -->
        </div>


     <!-------------------------------------------------------------->
     <div class="card card-success">
           

            <div class="card-body">
                <div id="wrapper">
                <!-- <form action="adminFunction.php" method="post" enctype="multipart/form-data"> -->
                    <div id="form_div">
                        <div class="table-responsive">

                       <label>Service Due Date</label>
                       <input type="date" id="service_due_date" class="form-control"  name="service_due_date" value="">
                       
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

<script src="dist/js/adminlte.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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

        html_code += '<td><input type="hidden" class="partIndex" name="partIndex[]" value="' + partIndex + '" readonly/><input type="hidden" class="partId" name="partId[]" id="partId' + partIndex + '" readonly/><select type="text" name="partName[]" id="partName' + partIndex + '" placeholder="Enter Part Name" class="form-control-sm partNameDropdown" style="width:100% !important;" onchange="setPartsData(' + partIndex + ')">' + $("#parts-dropdown").html() + '</td>';
        
        html_code += '<td><input type="number" step=".01" name="partPrice[]" id="partPrice' + partIndex + '" placeholder="Price" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPrice' + partIndex + '" placeholder="Discounted Price" class="form-control-sm" readonly></td>';

        html_code += '<td><input type="text" name="partNumber[]" id="part_number' + partIndex + '" placeholder="Enter Part Number" class="form-control-sm"></td>';

        html_code += '<td><input type="text" name="partHsnCode[]" id="partHsnCode' + partIndex + '" placeholder="Enter HSN code" class="form-control-sm"></td>';
        
        html_code += '<td><input type="number" step=".01" name="partQty[]" id="partQTY' + partIndex + '" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;"></td>';
        
        html_code += '<td><input type="number" step=".01" name="partCgst[]" id="partCgst' + partIndex + '" placeholder="CGST%" class="form-control-sm partGst" style="width: 6rem;"><input type="hidden" name="partCgstValue[]" id="partCgstValue' + partIndex + '" value="0"></td>';
        
        html_code += '<td><input type="number" step=".01" name="partSgst[]" id="partSgst' + partIndex + '" placeholder="SGST%" class="form-control-sm partGst" style="width: 6rem;"><input type="hidden" name="partSgstValue[]" id="partSgstValue' + partIndex + '" value="0"></td>';

        html_code += '<td><input type="text" name="partTotal[]" id="partTotal' + partIndex + '" class="form-control-sm partTotal" readonly></td>';
        html_code += '<td><button type="button" name="removePart" id="removePart' + partIndex + '" class="btn btn-danger btn-sm remove-part w-100 removePartButton">Remove</button></td>';
        $("#partTable").append(html_code);
        $('#partName' + partIndex).select2();
    });

   

    function setPartsData(partIndex) 
    {
        var selectedOption = $('#partName'+partIndex).find(':selected');
        console.log(selectedOption.data());
        var partId = selectedOption.data('part-id');
        var salePrice = selectedOption.data('sale-price');
        var partNumber = selectedOption.data('part-number');
        var hsnCode = selectedOption.data('hsn-code');
        var cgst = selectedOption.data('cgst');
        var sgst = selectedOption.data('sgst');
        
        // Update the SalePrice and HSNCode input fields
        $('#partId' + partIndex).val(partId);
        $('#partPrice' + partIndex).val(salePrice);
        $('#partDiscountPrice' + partIndex).val(salePrice);
        $('#part_number' + partIndex).val(partNumber);
        $('#partHsnCode' + partIndex).val(hsnCode);
        $('#partCgst' + partIndex).val(cgst);
        $('#partSgst' + partIndex).val(sgst);
        
        // Recalculate the total after updating the fields
        calculatePartFinalTotal();
    }

    $(document).on('click', '.removePartButton', function () {
        // var partRowId = $(this).closest('tr').attr('id');
        // var grandTotal = $('#partGrandTotal').val();
        // var partTotal = $('#partTotal' + partRowId).val();
        // var finalTotal = parseFloat(grandTotal) - parseFloat(partTotal);
        // $('#partGrandTotal').val(finalTotal.toFixed(2));
        $(this).parents('tr').remove();
        partIndex--;

        calculatePartFinalTotal();
    });

    // Calculation for GST amount and total grand total amount
    function calculatePartFinalTotal() {
        var finalPartTotal = 0;

        for (var j = 1; j <= partIndex; j++) {
            var price = $('#partPrice' + j).val();
            var qty = $('#partQTY' + j).val(); // Added line to get quantity
            var cgst = $('#partCgst' + j).val();
            var sgst = $('#partSgst' + j).val();
            var discount = $('#partDiscount').val();

            if(discount != "undefined")
            {
                price = price - ((price * discount) / 100);
                $('#partDiscountPrice' + j).val(price.toFixed(2));
            }

            // var perGst = price * gst / 100;
            var perCgst = 0;
            var perSgst = 0;
            
            var gstPer = Number(cgst) + Number(sgst);
            var totalGst = Number(price) - ((Number(price) * 100) / (100 + Number(gstPer)));
            
            if(cgst != "undefined")
            {
                perCgst = totalGst / 2;
            }

            if(sgst != "undefined")
            {
                perSgst = totalGst / 2;
            }

            // var subtotal = parseFloat(price) + parseFloat(perCgst) + parseFloat(perSgst);
            var subtotal = parseFloat(price);

            // Calculate total based on quantity
            var total = 0;
            if(subtotal > 0)
            {
                total = subtotal * qty;
            }
            
            finalPartTotal += parseFloat(total);
            
            $('#partTotal' + j).val(total.toFixed(2));
            $('#partCgstValue' + j).val(perCgst);
            $('#partSgstValue' + j).val(perSgst);
        }

        $('#partGrandTotal').val(finalPartTotal.toFixed(2));
    }

    $(document).on('keyup', '.partGst', function () {
        // if ($('#partCgst' + partIndex).val() == '' || $('#partSgst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePartFinalTotal();
    });
    
    $(document).on('change', '.partGst', function () {
        // if ($('#partCgst' + partIndex).val() == '' || $('#partSgst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePartFinalTotal();
    });
</script>

<script type="text/javascript">
    var partIndex = 1;

    $("#addPackage").click(function () {
        partIndex++;
        var html_code = '';
        html_code += '<tr id="partRow' + partIndex + '">';

        html_code += '<td><input type="hidden" class="partIndex" name="partIndex[]" value="' + partIndex + '" readonly/><input type="hidden" class="partId" name="partId[]" id="partId' + partIndex + '" readonly/><select type="text" name="partName[]" id="partName' + partIndex + '" placeholder="Enter Part Name" class="form-control-sm partNameDropdown" style="width:100% !important;" onchange="setPartsData(' + partIndex + ')">' + $("#parts-dropdown").html() + '</td>';
        
        html_code += '<td><input type="number" step=".01" name="partPrice[]" id="partPrice' + partIndex + '" placeholder="Price" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPrice' + partIndex + '" placeholder="Discounted Price" class="form-control-sm" readonly></td>';

        html_code += '<td><input type="text" name="partNumber[]" id="part_number' + partIndex + '" placeholder="Enter Part Number" class="form-control-sm"></td>';

        html_code += '<td><input type="text" name="partHsnCode[]" id="partHsnCode' + partIndex + '" placeholder="Enter HSN code" class="form-control-sm"></td>';
        
        html_code += '<td><input type="number" step=".01" name="partQty[]" id="partQTY' + partIndex + '" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;"></td>';
        
        html_code += '<td><input type="number" step=".01" name="partCgst[]" id="partCgst' + partIndex + '" placeholder="CGST%" class="form-control-sm partGst" style="width: 6rem;"><input type="hidden" name="partCgstValue[]" id="partCgstValue' + partIndex + '" value="0"></td>';
        
        html_code += '<td><input type="number" step=".01" name="partSgst[]" id="partSgst' + partIndex + '" placeholder="SGST%" class="form-control-sm partGst" style="width: 6rem;"><input type="hidden" name="partSgstValue[]" id="partSgstValue' + partIndex + '" value="0"></td>';

        html_code += '<td><input type="text" name="partTotal[]" id="partTotal' + partIndex + '" class="form-control-sm partTotal" readonly></td>';
        html_code += '<td><button type="button" name="removePart" id="removePart' + partIndex + '" class="btn btn-danger btn-sm remove-part w-100 removePartButton">Remove</button></td>';
        $("#partTable").append(html_code);
        $('#partName' + partIndex).select2();
    });

   

    function setPartsData(partIndex) 
    {
        var selectedOption = $('#partName'+partIndex).find(':selected');
        console.log(selectedOption.data());
        var partId = selectedOption.data('part-id');
        var salePrice = selectedOption.data('sale-price');
        var partNumber = selectedOption.data('part-number');
        var hsnCode = selectedOption.data('hsn-code');
        var cgst = selectedOption.data('cgst');
        var sgst = selectedOption.data('sgst');
        
        // Update the SalePrice and HSNCode input fields
        $('#partId' + partIndex).val(partId);
        $('#partPrice' + partIndex).val(salePrice);
        $('#partDiscountPrice' + partIndex).val(salePrice);
        $('#part_number' + partIndex).val(partNumber);
        $('#partHsnCode' + partIndex).val(hsnCode);
        $('#partCgst' + partIndex).val(cgst);
        $('#partSgst' + partIndex).val(sgst);
        
        // Recalculate the total after updating the fields
        calculatePartFinalTotal();
    }

    $(document).on('click', '.removePartButton', function () {
        // var partRowId = $(this).closest('tr').attr('id');
        // var grandTotal = $('#partGrandTotal').val();
        // var partTotal = $('#partTotal' + partRowId).val();
        // var finalTotal = parseFloat(grandTotal) - parseFloat(partTotal);
        // $('#partGrandTotal').val(finalTotal.toFixed(2));
        $(this).parents('tr').remove();
        partIndex--;

        calculatePartFinalTotal();
    });

    // Calculation for GST amount and total grand total amount
    function calculatePartFinalTotal() {
        var finalPartTotal = 0;

        for (var j = 1; j <= partIndex; j++) {
            var price = $('#partPrice' + j).val();
            var qty = $('#partQTY' + j).val(); // Added line to get quantity
            var cgst = $('#partCgst' + j).val();
            var sgst = $('#partSgst' + j).val();
            var discount = $('#partDiscount').val();

            if(discount != "undefined")
            {
                price = price - ((price * discount) / 100);
                $('#partDiscountPrice' + j).val(price.toFixed(2));
            }

            // var perGst = price * gst / 100;
            var perCgst = 0;
            var perSgst = 0;
            
            var gstPer = Number(cgst) + Number(sgst);
            var totalGst = Number(price) - ((Number(price) * 100) / (100 + Number(gstPer)));
            
            if(cgst != "undefined")
            {
                perCgst = totalGst / 2;
            }

            if(sgst != "undefined")
            {
                perSgst = totalGst / 2;
            }

            // var subtotal = parseFloat(price) + parseFloat(perCgst) + parseFloat(perSgst);
            var subtotal = parseFloat(price);

            // Calculate total based on quantity
            var total = 0;
            if(subtotal > 0)
            {
                total = subtotal * qty;
            }
            
            finalPartTotal += parseFloat(total);
            
            $('#partTotal' + j).val(total.toFixed(2));
            $('#partCgstValue' + j).val(perCgst);
            $('#partSgstValue' + j).val(perSgst);
        }

        $('#partGrandTotal').val(finalPartTotal.toFixed(2));
    }

    $(document).on('keyup', '.partGst', function () {
        // if ($('#partCgst' + partIndex).val() == '' || $('#partSgst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePartFinalTotal();
    });
    
    $(document).on('change', '.partGst', function () {
        // if ($('#partCgst' + partIndex).val() == '' || $('#partSgst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePartFinalTotal();
    });
</script>

<script type="text/javascript">
    var partIndex = 1;

    $("#addPackage").click(function () {
        partIndex++;
        var html_code = '';
        html_code += '<tr id="partRow' + partIndex + '">';

       // html_code += '<td><input type="hidden" class="partIndex" name="partIndex[]" value="' + partIndex + '" readonly/><input type="hidden" class="partId" name="partId[]" id="partId' + partIndex + '" readonly/><select type="text" name="partName[]" id="partName' + partIndex + '" placeholder="Enter Part Name" class="form-control-sm partNameDropdown" style="width:100% !important;" onchange="setPartsData(' + partIndex + ')">' + $("#parts-dropdown").html() + '</td>';
        
        html_code += '<td><input type="number" step=".01" name="partPrice[]" id="partPrice' + partIndex + '" placeholder="Price" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPrice' + partIndex + '" placeholder="Discounted Price" class="form-control-sm" readonly></td>';

        html_code += '<td><input type="text" name="partNumber[]" id="part_number' + partIndex + '" placeholder="Enter Part Number" class="form-control-sm"></td>';

        html_code += '<td><input type="text" name="partHsnCode[]" id="partHsnCode' + partIndex + '" placeholder="Enter HSN code" class="form-control-sm"></td>';
        
        html_code += '<td><input type="number" step=".01" name="partQty[]" id="partQTY' + partIndex + '" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;"></td>';
        
        html_code += '<td><input type="number" step=".01" name="partCgst[]" id="partCgst' + partIndex + '" placeholder="CGST%" class="form-control-sm partGst" style="width: 6rem;"><input type="hidden" name="partCgstValue[]" id="partCgstValue' + partIndex + '" value="0"></td>';
        
        html_code += '<td><input type="number" step=".01" name="partSgst[]" id="partSgst' + partIndex + '" placeholder="SGST%" class="form-control-sm partGst" style="width: 6rem;"><input type="hidden" name="partSgstValue[]" id="partSgstValue' + partIndex + '" value="0"></td>';

        html_code += '<td><input type="text" name="partTotal[]" id="partTotal' + partIndex + '" class="form-control-sm partTotal" readonly></td>';
        html_code += '<td><button type="button" name="removePart" id="removePart' + partIndex + '" class="btn btn-danger btn-sm remove-part w-100 removePartButton">Remove</button></td>';
        $("#partTable").append(html_code);
        $('#partName' + partIndex).select2();
    });

   

    function setPartsData(partIndex) 
    {
        var selectedOption = $('#partName'+partIndex).find(':selected');
        console.log(selectedOption.data());
        var partId = selectedOption.data('part-id');
        var salePrice = selectedOption.data('sale-price');
        var partNumber = selectedOption.data('part-number');
        var hsnCode = selectedOption.data('hsn-code');
        var cgst = selectedOption.data('cgst');
        var sgst = selectedOption.data('sgst');
        
        // Update the SalePrice and HSNCode input fields
        $('#partId' + partIndex).val(partId);
        $('#partPrice' + partIndex).val(salePrice);
        $('#partDiscountPrice' + partIndex).val(salePrice);
        $('#part_number' + partIndex).val(partNumber);
        $('#partHsnCode' + partIndex).val(hsnCode);
        $('#partCgst' + partIndex).val(cgst);
        $('#partSgst' + partIndex).val(sgst);
        
        // Recalculate the total after updating the fields
        calculatePartFinalTotal();
    }

    $(document).on('click', '.removePartButton', function () {
        // var partRowId = $(this).closest('tr').attr('id');
        // var grandTotal = $('#partGrandTotal').val();
        // var partTotal = $('#partTotal' + partRowId).val();
        // var finalTotal = parseFloat(grandTotal) - parseFloat(partTotal);
        // $('#partGrandTotal').val(finalTotal.toFixed(2));
        $(this).parents('tr').remove();
        partIndex--;

        calculatePartFinalTotal();
    });

    // Calculation for GST amount and total grand total amount
    function calculatePartFinalTotal() {
        var finalPartTotal = 0;

        for (var j = 1; j <= partIndex; j++) {
            var price = $('#partPrice' + j).val();
            var qty = $('#partQTY' + j).val(); // Added line to get quantity
            var cgst = $('#partCgst' + j).val();
            var sgst = $('#partSgst' + j).val();
            var discount = $('#partDiscount').val();

            if(discount != "undefined")
            {
                price = price - ((price * discount) / 100);
                $('#partDiscountPrice' + j).val(price.toFixed(2));
            }

            // var perGst = price * gst / 100;
            var perCgst = 0;
            var perSgst = 0;
            
            var gstPer = Number(cgst) + Number(sgst);
            var totalGst = Number(price) - ((Number(price) * 100) / (100 + Number(gstPer)));
            
            if(cgst != "undefined")
            {
                perCgst = totalGst / 2;
            }

            if(sgst != "undefined")
            {
                perSgst = totalGst / 2;
            }

            // var subtotal = parseFloat(price) + parseFloat(perCgst) + parseFloat(perSgst);
            var subtotal = parseFloat(price);

            // Calculate total based on quantity
            var total = 0;
            if(subtotal > 0)
            {
                total = subtotal * qty;
            }
            
            finalPartTotal += parseFloat(total);
            
            $('#partTotal' + j).val(total.toFixed(2));
            $('#partCgstValue' + j).val(perCgst);
            $('#partSgstValue' + j).val(perSgst);
        }

        $('#partGrandTotal').val(finalPartTotal.toFixed(2));
    }

    $(document).on('keyup', '.partGst', function () {
        // if ($('#partCgst' + partIndex).val() == '' || $('#partSgst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePartFinalTotal();
    });
    
    $(document).on('change', '.partGst', function () {
        // if ($('#partCgst' + partIndex).val() == '' || $('#partSgst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePartFinalTotal();
    });
</script>

<script>
function setPackageData(index) {
    const dropdown = document.getElementById('packageName' + index);
    const selected = dropdown.options[dropdown.selectedIndex];

    document.getElementById('packageId' + index).value = selected.value;
    document.getElementById('packagePrice' + index).value = selected.getAttribute('data-package-price') || '';
    document.getElementById('discountprice' + index).value = selected.getAttribute('data-discount-price') || '';
    document.getElementById('hsncode' + index).value = selected.getAttribute('data-hsn-code') || '';
    document.getElementById('stock' + index).value = selected.getAttribute('data-stock') || '';
    document.getElementById('cgst_percentage' + index).value = selected.getAttribute('data-cgst') || '';
    document.getElementById('sgst_percentage' + index).value = selected.getAttribute('data-sgst') || '';
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
        html_code += '<td><input type="number" step=".01" name="price[]" id="price'+i+'" placeholder="Price" class="form-control-sm gs_t"></td>';
        html_code += '<td><input type="number" step=".01" name="discounted_price[]" id="discountedPrice'+i+'" placeholder="Price" class="form-control-sm" readonly></td>';
        html_code += '<td><input type="text" name="hsn_code[]" id="hsn_code'+i+'" placeholder="Enter HSN code" class="form-control-sm"></td>';
        html_code += '<td><input type="number" step=".01" name="cgst[]" id="cgst'+i+'" placeholder="CGST%" class="form-control-sm gs_t" style="width: 6rem;" min="0" max="100"><input type="hidden" name="serviceCgstValue[]" id="serviceCgstValue'+i+'" value="0"></td>';
        html_code += '<td><input type="number" step=".01" name="sgst[]" id="sgst'+i+'" placeholder="SGST%" class="form-control-sm gs_t" style="width: 6rem;" min="0" max="100"><input type="hidden" name="serviceSgstValue[]" id="serviceSgstValue'+i+'" value="0"></td>';
        html_code += '<td><input type="text" name="total[]" id="total'+i+'" class="form-control-sm order_item_price" readonly></td>';
        html_code += '<td><button type="button" name="remove_row" id="'+i+'" class="btn btn-danger btn-sm remove-tr w-100 remove_row">Remove</button></td>';
        $("#dynamicTable").append(html_code);
    });
    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
    //this section calculation gst amount and total grand total amount
    function cal_final_total()
    {
        var sum = 0;
        var sum1 = 0;

        for(j=1; j<=i; j++)
        {
            var price = $('#price'+j).val();
            if(price != "undefined")
            {
                var discount = $('#service_discount').val();

                if(discount != "undefined")
                {
                    price = price - ((price * discount) / 100);
                    $('#discountedPrice' + j).val(price.toFixed(2));
                }

                var perCgst = 0;
                var perSgst = 0;

                var cgst = $('#cgst'+j).val();
                var sgst = $('#sgst'+j).val();

                if(cgst != "undefined") 
                { 
                    var perCgst = price * cgst / 100;
                    $('#serviceCgstValue' + j).val(perCgst);
                }
                if(cgst != "undefined") 
                { 
                    var perSgst = price * sgst / 100;
                    $('#serviceSgstValue' + j).val(perSgst);
                }

                sum = parseFloat(price) + parseFloat(perCgst) + parseFloat(perSgst);
                sum1 = parseFloat(sum) + parseFloat(sum1);
                
                $('#total'+j).val(sum.toFixed(2));
            }
        }

        $('#grandtotal').val(sum1.toFixed(2));
    }

$(document).on('keyup', '.gs_t', function(){
    // if($('#gst'+i).val() ==''){
    //     $('#order_item_price'+i).val(0);
    // }
    cal_final_total(i);
});

$(document).on('change', '.gs_t', function(){
    // if($('#gst'+i).val() ==''){
    //     $('#order_item_price'+i).val(0);
    // }
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
        // $('#partName1').select({
        //     placeholder: 'Select Part',
        //     allowClear: true,
        //     // Add any additional options or configurations here
        // });

        $('#partName1').select2();

        // Add event listener to update SalePrice and HSNCode on dropdown change
        $('#partName1').on('change', function() {
            var selectedOption = $(this).find(':selected');
            var partId = selectedOption.data('part-id');
            var salePrice = selectedOption.data('sale-price');
            var partNumber = selectedOption.data('part-number');

            // Update the SalePrice and HSNCode input fields
            $('#partId').val(partId);
            $('#partPrice1').val(salePrice);
            $('#part_number').val(partNumber);
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('jobcard'); // Replace 'yourFormID' with the actual ID of your form

        form.addEventListener('submit', function() {
            document.getElementById('loader').style.display = 'block';
        });
    });
</script>

<script>
    CKEDITOR.replace('editor');

    document.getElementById('post-form').addEventListener('submit', function() {
        document.getElementById('editor').value = CKEDITOR.instances.editor.getData();
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <div class="modal fade" id="addInventoryModal" tabindex="-1" role="dialog" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="addInventoryForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="addInventoryModalLabel">Add New Product</h5>
          <button type="button" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <input type="hidden" name="pid" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['id']; ?>">
          <input type="hidden" name="g_id" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['id']; ?>">

          <div class="form-group">
            <input type="text" class="form-control" name="Product" placeholder="Product Name">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="PartNumber" placeholder="Part Number">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="partHsnCode" placeholder="HSN Code">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="Location" placeholder="Location">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="Category" placeholder="Category">
          </div>

          <div class="row">
            <div class="col-md-4">
              <label>Upload Part Image</label>
              <input type="file" class="form-control" name="Photo">
            </div>
            <div class="col-md-4">
              <label>Quantity</label>
              <input type="number" class="form-control" name="Stock">
            </div>
            <div class="col-md-4">
              <label>Cost Price</label>
              <input type="number" min="0" step="any" class="form-control" name="CostPrice">
            </div>
            <div class="col-md-4 mt-3">
              <label>MRP</label>
              <input type="number" min="0" step="any" class="form-control" name="SalePrice">
            </div>
            <div class="col-md-4 mt-3">
              <label>CGST (%)</label>
              <input type="number" min="0" step="any" max="50" class="form-control" name="cgst_percentage">
            </div>
            <div class="col-md-4 mt-3">
              <label>SGST (%)</label>
              <input type="number" min="0" step="any" max="50" class="form-control" name="sgst_percentage">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="add_product" class="btn btn-primary" data-toggle="modal" data-target="#addInventoryModal">Add Product</button>
        </div>
      </form>
    </div>
  </div>
  </div>

<script>
$(document).ready(function() {
  function loadInventoryOptions() {
    $.ajax({
  url: 'getInventoryOptions.php?t=' + new Date().getTime(), 
  type: 'GET',
  success: function(options) {
    console.log('Dropdown updated with:', options);
    $('.partNameDropdown').html('<option value="">Select Parts From Inventory</option>' + options);
  },
  error: function() {
    alert('Failed to reload parts dropdown!');
  }
});

  }
  $('#addInventoryForm').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append('add_product', true);

    $.ajax({
      url: 'adminFunction.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      
      success: function(response) {
        if (response.trim() === 'success') {
          alert('Product Added Successfully!');
         // console.log(response,'Product Added Successfully!');

        //  location.reload();
        
        //   const modalEl = document.getElementById('addInventoryModal');
        //   const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        //   modal.hide();

          $('#addInventoryForm')[0].reset();
          loadInventoryOptions(); 
         // alert('Error: ' + response);
        }
      },
      error: function() {
        alert('AJAX request failed!');
      }
    });
  });

  loadInventoryOptions();

});
</script>

</body>

</html>