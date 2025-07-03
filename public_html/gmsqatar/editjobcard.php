<?php require "adheader.php"; ?>
<?php require "slidebar.php";

//  require "function.php";

$serviceTotalPayable = 0;
$partsTotalPayable = 0;
$packagesTotalPayable  = 0;

?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add / Remove Services </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="ShowJobCard.php">Home</a></li>
                        <li class="breadcrumb-item active">Show JobCard</li>
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
        <form action="jobcard-update-process.php" method="post" enctype="multipart/form-data">
            <div class="row">

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
                                <?php
                                $id = $_GET['id'];

                                $sql = "SELECT * FROM jobcard WHERE id='$id'";
                                $res = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {

                                ?>
                                        <label>Job Card Type </label>
                                        <select name="job_card_type" id="job_card_type" class="form-control ">
                                            <option value="">Select Job Card Type</option>
                                            <option value="Service" <?php if ($row['job_card_type'] == 'Service') {
                                                                        echo 'selected';
                                                                    } ?>>Service</option>
                                            <option value="Accident" <?php if ($row['job_card_type'] == 'Accident') {
                                                                            echo 'selected';
                                                                        } ?>>Accident</option>
                                            <option value="Repair" <?php if ($row['job_card_type'] == 'Repair') {
                                                                        echo 'selected';
                                                                    } ?>>Repair</option>

                                        </select>
                                <?php }
                                } ?>

                                <?php
                                $id = $_GET['id'];

                                $voiceOfCustomer; // Default to empty

                                $sql2 = "SELECT * FROM jobcard WHERE id='$id'";
                                $res2 = mysqli_query($conn, $sql2);

                                if (mysqli_num_rows($res2) > 0) {
                                    $row2 = mysqli_fetch_assoc($res2);
                                    $itemId = $row2['uid'];

                                    $query1 = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' LIMIT 1";
                                    $res1 = mysqli_query($conn, $query1);
                                    if (mysqli_num_rows($res1) > 0) {
                                        $row1 = mysqli_fetch_assoc($res1);
                                        $voiceOfCustomer = $row1['voice_of_customer'];
                                    }
                                }
                                ?>

                                <label>Voice Of Customer</label>
                                <textarea id="editor" name="voice_of_customer" rows="3" placeholder="Enter Full Description" class="form-control"><?php echo $voiceOfCustomer; ?></textarea>

                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary">

                        <!-- inventory part -->

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Add/Remove Parts</h3>
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

                                    <?php
                                    $id = $_GET['id'];
                                    $part_discount = 0;

                                    $sql = "SELECT * FROM jobcard WHERE id='$id'";
                                    $res = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $part_discount = $row['part_discount'];
                                    ?>
                                            <div id="form_div">
                                                <div>
                                                    <input type="hidden" name="g_id" value="<?php echo $row['g_id']; ?>">
                                                    <input type="hidden" name="uid" value="<?php echo $row['uid']; ?>">
                                                    <input type="hidden" name="v_id" value="<?php echo $row['v_id']; ?>">
                                                    <input type="hidden" name="c_id" value="<?php echo $row['c_id']; ?>">
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table" id="partTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Part Name<span class="required-text">*</span></th>
                                                                <th>MRP<span class="required-text">*</span></th>
                                                                <th>Discounted Price<span class="required-text">*</span></th>
                                                                <th>Part Number</th>
                                                                <th>HSN Code</th>
                                                                <th>Qty</th>
                                                                <th>Regional Tax(%)</th>
                                                               
                                                                <th>Total Cost</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $i = 1;

                                                            $itemId = $row['uid'];
                                                            $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '1'";
                                                            $res = mysqli_query($conn, $query);
                                                            if (mysqli_num_rows($res) > 0) {
                                                                while ($row = mysqli_fetch_assoc($res)) {
                                                            ?>
                                                                    <tr id="partRow<?= $i ?>">
                                                                        <td>
                                                                            <input type="hidden" class="partIndex" name="partIndex[]" value="<?= $i ?>" readonly />
                                                                            <input type="text" name="partName[]" value="<?php echo $row['partname']; ?>" class="form-control-sm" readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" step=".01" name="partPrice[]" id="partPrice<?= $i ?>" value="<?php echo $row['partPrice']; ?>" placeholder="Price" class="form-control-sm" readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPrice<?= $i ?>" value="<?php echo $row['partDiscountPrice']; ?>" placeholder="Price" class="form-control-sm" readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" name="partNumber[]" id="partNumber<?= $i ?>" value="<?php echo $row['part_number']; ?>" placeholder="Part Number" class="form-control-sm" readonly />
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" name="partHsnCode[]" id="partHsnCode<?= $i ?>" value="<?php echo $row['parthsncode']; ?>" placeholder="Enter HSN code" class="form-control-sm" readonly />
                                                                        </td>

                                                                        <td>
                                                                            <input type="number" step=".01" name="partQty[]" id="partQty<?= $i ?>" value="<?php echo $row['partqty']; ?>" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;" />
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" step=".01" name="partCgst[]" id="partCgst<?= $i ?>" value="<?php echo $row['partcgst']; ?>" class="form-control-sm partGst" min="0" max="50">
                                                                            <input type="hidden" name="partCgstValue[]" id="partCgstValue<?= $i ?>" value="<?php echo $row['cgst_value']; ?>">
                                                                        </td>
                                                                      
                                                                        <td>
                                                                            <input type="text" name="partTotal[]" id="partTotal<?= $i ?>" value="<?php echo $row['parttotalpay']; ?>" class="form-control-sm partTotal" readonly>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" name="remove" class="btn btn-danger btn-sm w-100 remove-parts">Remove</button>
                                                                            <input type="hidden" name="part_service_id[]" value="<?php echo $row['id']; ?>">
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                    $i++;
                                                                    $partsTotalPayable += $row['parttotalpay'];
                                                                }
                                                            }
                                                            $partCount = $i - 1; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-inline justify-content-between">
                                                        <div>
                                                            <input type="button" class="btn btn-primary" id="addPart" value="Add">
                                                        </div>

                                                        <div class="form-inline" style="margin-left: 2rem;">
                                                            <label style="padding-right: 8px;">Discount (%)</label>
                                                            <input style="margin-right: 10px;" name="part_discount" type="number" min="0" max="100" id="partDiscount" class="partGst" value="<?= $part_discount; ?>">

                                                            <label style="padding-right: 8px;">Total Payable</label>
                                                            <input type="text" id="partGrandTotal" value="<?= $partsTotalPayable; ?>.00" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>

                <?php }
                                    } ?>



                <!-- ----------------------------------------------------------------------------------------->



                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Add/Remove Package</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div id="package-dropdown" style="display: none;">
                        <option value="">Select Service Package</option>
                        <?php selectpackage($conn); ?>
                    </div>

                    <div class="card-body">
                        <div id="wrapper">

                            <?php
                            $id = $_GET['id'];
                            $package_discount = 0;

                            $sql = "SELECT * FROM jobcard WHERE id='$id'";
                            $res = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $package_discount = $row['packageDiscount'];
                            ?>
                                    <div id="form_div">
                                        <div>
                                            <input type="hidden" name="g_id" value="<?php echo $row['g_id']; ?>">
                                            <input type="hidden" name="uid" value="<?php echo $row['uid']; ?>">
                                            <input type="hidden" name="v_id" value="<?php echo $row['v_id']; ?>">
                                            <input type="hidden" name="c_id" value="<?php echo $row['c_id']; ?>">
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="packageTable">
                                                <thead>
                                                    <tr>
                                                        <th>Package Name<span class="required-text">*</span></th>
                                                        <th>Package Price<span class="required-text">*</span></th>
                                                        <th>Discounted Price<span class="required-text">*</span></th>
                                                        <th>Hsn Code</th>
                                                        <th>Qty</th>
                                                        <th>Regional Tax(%)</th>
                                                        
                                                        <th>Total Cost</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;

                                                    $itemId = $row['uid'];
                                                    $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '3'";
                                                    //  $query = "SELECT FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '3' AND g_id = '".$_SESSION['id']."'";

                                                    $res = mysqli_query($conn, $query);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        while ($row = mysqli_fetch_assoc($res)) {
                                                    ?>
                                                            <tr id="packageRow<?= $i ?>">
                                                                <td>
                                                                    <input type="hidden" class="packageIndex" name="packageIndex[]" value="<?= $i ?>" readonly />
                                                                    <input type="text" name="packageId[]" value="<?php echo $row['package']; ?>" class="form-control-sm" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type="number" step=".01" name="packagePrice[]" id="packagePrice<?= $i ?>" value="<?php echo $row['packageprice']; ?>" placeholder="Price" class="form-control-sm" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type="number" step=".01" name="packageDiscountPrice[]" id="packageDiscountPrice<?= $i ?>" value="<?php echo $row['discountprice']; ?>" placeholder=" Discounted Price" class="form-control-sm" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="packageHsnCode[]" id="packageHsnCode<?= $i ?>" value="<?php echo $row['hsncode']; ?>" placeholder=" Hsn Code" class="form-control-sm" readonly />
                                                                </td>

                                                                <td>
                                                                    <input type="number" step=".01" name="packageQty[]" id="packageQTY<?= $i ?>" value="<?php echo $row['pqty']; ?>" placeholder="QTY" class="form-control-sm packageGst" style="width: 6rem;" />
                                                                </td>
                                                                <td>
                                                                    <input type="number" step=".01" name="packageCgst[]" id="packageCgst<?= $i ?>" value="<?php echo $row['pcgst']; ?>" class="form-control-sm packageGst" min="0" max="50">
                                                                </td>
                                                              
                                                                <td>
                                                                    <input type="text" name="packageTotal[]" id="packageTotal<?= $i ?>" value="<?php echo $row['totalpay']; ?>" class="form-control-sm packageTotal" readonly>
                                                                </td>
                                                                <td>
                                                                    <button type="button" name="remove" class="btn btn-danger btn-sm w-100 remove-package">Remove</button>
                                                                    <input type="hidden" name="package_service_id[]" value="<?php echo $row['id']; ?>">
                                                                </td>
                                                            </tr>
                                                    <?php
                                                            $i++;
                                                            // echo "test $i";
                                                            $packagesTotalPayable += $row['totalpay'];
                                                           
                                                        }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-inline justify-content-between">
                                                <div>
                                                    <input type="button" class="btn btn-primary" id="addpackage" value="Add Package">
                                                </div>
                                                <!-- <div class="form-inline" style="margin-left: 2rem;">
                                    <label style="padding-right: 8px;">Total</label>
                                    <input type="text" id="partGrandTotal" readonly>
                                </div> -->
                                                <!-- <div class="col-12 mt-4">
                                    <input type="submit" class="btn btn-success float-right" name="btn-done" value="SUBMIT">
                                </div> -->
                                                <div class="form-inline" style="margin-left: 2rem;">
                                                    <label style="padding-right: 8px;">Discount (%)</label>
                                                    <input style="margin-right: 10px;" name="package_discount" type="number" min="0" max="100" id="packageDiscount" class="packageGst" value="<?= $package_discount; ?>">

                                                    <label style="padding-right: 8px;">Total Payable</label>
                                                    <input type="text" id="packageGrandTotal" value="<?= $packagesTotalPayable; ?>.00" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>

        <?php }
                            } ?>

        <!-- inventory part -->

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Add / Remove Services</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div id="wrapper">
                    <?php
                    $id = $_GET['id'];
                    $service_discount = 0;

                    $sql = "SELECT * FROM jobcard WHERE id='$id'";
                    $res = mysqli_query($conn, $sql);
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $service_discount = $row['service_discount'];
                    ?>
                            <div id="form_div">
                                <!--<div>-->
                                <!--    <input type="hidden" name="g_id" value="<?php echo $row['g_id']; ?>">-->
                                <!--    <input type="hidden" name="uid" value="<?php echo $row['uid']; ?>">-->
                                <!--</div>-->
                                <!-- <div class="col-md-12"> -->
                                <div class="table-responsive">
                                    <table class="table" id="dynamicTable">
                                        <thead>
                                            <tr>
                                                <th>Service Name/Part Name</th>
                                                <th>Service Cost</th>
                                                <th>Discounted Cost</th>
                                                <th>HSN Code</th>
                                                <th>Regional Tax(%)</th>
                                           
                                                <th>Taxable Amt</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $itemId = $row['uid'];
                                            $ser_i = 1;

                                            $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2'";
                                            $res = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($res) > 0) {

                                                while ($row = mysqli_fetch_assoc($res)) { ?>
                                                    <tr id="<?= $ser_i; ?>">
                                                        <!-- <div id="output"></div> -->
                                                        <td>
                                                            <input type="hidden" name="srno[]" class="srno" value="1" readonly />
                                                            <input type="text" name="service[]" id="service<?= $ser_i; ?>" value="<?php echo $row['service']; ?>" placeholder="Enter Service Name" class="form-control-sm">
                                                        </td>
                                                        <td>
                                                            <input type="number" step=".01" name="price[]" id="price<?= $ser_i; ?>" placeholder="Price" value="<?php echo $row['price']; ?>.00" class="form-control-sm gs_t">
                                                        </td>
                                                        <td>
                                                            <input type="number" step=".01" name="discounted_price[]" id="discountedPrice<?= $ser_i; ?>" placeholder="Discounted Price" class="form-control-sm" value="<?php echo $row['discounted_price']; ?>" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="hsn_code[]" id="hsn_code<?= $ser_i; ?>" placeholder="Enter HSN code" value="<?php echo $row['hsn_code']; ?>" class="form-control-sm" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" step=".01" name="serviceCgst[]" id="cgst<?= $ser_i; ?>" placeholder="SGST%" class="form-control-sm gs_t" style="width: 6rem;" min="0" max="100" value="<?php echo $row['cgst_percentage']; ?>">
                                                            <input type="hidden" name="serviceCgstValue[]" id="serviceCgstValue<?= $ser_i; ?>" value="<?php echo $row['cgst_value']; ?>">
                                                        </td>
                                                        
                                                        <td>
                                                            <input type="text" name="total[]" id="total<?= $ser_i; ?>" value="<?php echo $row['total']; ?>.00" class="form-control-sm order_item_price" readonly>
                                                        </td>
                                                        <td>
                                                            <button type="button" name="remove" class="btn btn-danger btn-sm w-100 remove-service">Remove</button>
                                                            <input type="hidden" name="service_id[]" value="<?php echo $row['id']; ?>">
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $ser_i++;
                                                    $serviceTotalPayable += $row['total'];
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- </div> -->
                                <div class="col-md-12">
                                    <div class="form-inline justify-content-between">
                                        <div>
                                            <input type="button" class="btn btn-primary" id="add" value="Add">
                                            <!-- <input type="submit" class="btn btn-success" name="btn-done" value="SUBMIT"> -->
                                        </div>
                                        <div class="form-inline" style="margin-left: 2rem;">
                                            <label style="padding-right: 8px;">Discount(%)</label>
                                            <input style="margin-right: 10px;" type="number" id="service_discount" name="service_discount" value="<?= $service_discount; ?>" min="0" max="100" class="gs_t">

                                            <label style="padding-right: 8px;">Total Payable</label>
                                            <!-- <span class="text-success" id="grandtotal"></span> -->
                                            <input type="text" id="grandtotal" value="<?= $serviceTotalPayable; ?>.00" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <div class="form-inline justify-content-between">
                                        <div>&emsp;</div>
                                        <div class="form-inline" style="margin-left: 2rem;">
                                            <label style="padding-right: 8px;">Gross Total</label>
                                            <!-- <span class="text-success" id="grandtotal"></span> -->
                                            <input type="text" value="<?= ($serviceTotalPayable + $partsTotalPayable + $packagesTotalPayable); ?>.00" id="grossTotal" readonly>
                                        </div>
                                    </div>
                                </div>
                                &nbsp;
                                <?php
                                $instruction = '';
                                $serviceDueDate = '';

                                $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId'  AND g_id = '" . $_SESSION['id'] . "' LIMIT 1";
                                $res = mysqli_query($conn, $query);

                                if (mysqli_num_rows($res) > 0) {
                                    $row = mysqli_fetch_assoc($res);
                                    $instruction = $row['instruction_of_mechanic'];
                                    $serviceDueDate = $row['service_due_date'];
                                }
                                ?>

                                <div class="col-12">
                                    <label>Instruction To Mechanic</label>
                                    <textarea id="editor" name="instruction_of_mechanic" placeholder="Enter Full Description" class="form-control"><?php echo htmlspecialchars($instruction); ?></textarea>

                                    <label>Service Due Date</label>
                                    <input type="date" id="service_due_date" class="form-control" name="service_due_date" value="<?php echo htmlspecialchars($serviceDueDate); ?>">
                                </div>


                                <div class="col-md-12 mt-4">
                                    <div class="form-inline justify-content-between">
                                        <div>&emsp;</div>
                                        <div class="col-12 mt-4">
                                            <!-- <input type="button" class="btn btn-primary" id="add" value="Add"> -->
                                            <a href="ShowJobCard.php" class="btn btn-secondary">Cancel</a>
                                            <input type="submit" class="btn btn-success float-right" name="btn-edit" value="SUBMIT">
                                        </div>


                                    </div>
                                </div>
                            </div>

                </div>

            </div>
            <!-- /.card-body -->
        </div>

<?php }
                    } ?>
                    </div>




                    <div class="row">
                        <div class="col-12">
                            <!--<a href="ShowJobCard.php" class="btn btn-secondary">Cancel</a>-->
                            <input type="hidden" name="btn-edit" value="Save Changes" class="btn btn-success float-right">

                        </div>
                    </div>
                </div>
            </div>
</div>
</form>
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
<script>
    // $(function Readdata() {
    //     $("#example1").DataTable({
    //         "responsive": true,
    //         "lengthChange": false,
    //         "autoWidth": false,
    //         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    //     $('#example2').DataTable({
    //         "paging": true,
    //         "lengthChange": false,
    //         "searching": false,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": false,
    //         "responsive": true,
    //     });
    // });
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
    var partIndex = <?= $partCount; ?>;

    $("#addPart").click(function() {
        console.log(partIndex);
        partIndex++;
        var html_code = '';
        html_code += '<tr id="partRow' + partIndex + '">';

        html_code += '<td><input type="hidden" class="partIndex" name="partIndex[]" value="' + partIndex + '" readonly/><input type="hidden" class="partId" name="partId[]" id="partId' + partIndex + '" readonly/><select type="text" name="partName[]" id="partName' + partIndex + '" placeholder="Enter Part Name" class="form-control-sm partNameDropdown">' + $("#parts-dropdown").html() + '</td>';

        html_code += '<td><input type="number" step=".01" name="partPrice[]" id="partPrice' + partIndex + '" placeholder="Price" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partDiscountPrice[]" id="partDiscountPrice' + partIndex + '" placeholder="Discounted Price" class="form-control-sm" readonly/></td>';

        html_code += '<td><input type="text" name="partNumber[]" id="partNumber' + partIndex + '" placeholder="Part Number" class="form-control-sm"></td>';

        html_code += '<td><input type="text" name="partHsnCode[]" id="partHsnCode' + partIndex + '" placeholder="Enter HSN code" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="partQty[]" id="partQty' + partIndex + '" placeholder="QTY" class="form-control-sm partGst" style="width: 6rem;"></td>';

        html_code += '<td><input type="number" step=".01" name="partCgst[]" id="partCgst' + partIndex + '" placeholder="Regional Tax%" class="form-control-sm partGst" style="width: 6rem;"><input type="hidden" name="partCgstValue[]" id="partCgstValue' + partIndex + '" value="0"></td>';

     
        html_code += '<td><input type="text" name="partTotal[]" id="partTotal' + partIndex + '" class="form-control-sm partTotal" readonly></td>';
        html_code += '<td><button type="button" name="removePart" id="removePart' + partIndex + '" class="btn btn-danger btn-sm remove-part w-100 removePartButton">Remove</button><input type="hidden" name="part_service_id[]" value="0"></td>';
        $("#partTable").append(html_code);
        $("#partName" + partIndex).select2();

    });

    $(document).on('change', '.partNameDropdown', function() {
        var partIndex = $(this).closest('tr').find('.partIndex').val();
        var selectedProduct = $(this).val();

        // Assuming the product data includes SalePrice and PartNumber
        var salePrice = $(this).find(':selected').data('sale-price');
        var partNumber = $(this).find(':selected').data('part-number');
        var hsnCode = $(this).find(':selected').data('hsn-code');
        var cgst = $(this).find(':selected').data('cgst');
      

        // Update the partPrice and partHsnCode fields
        $('#partPrice' + partIndex).val(salePrice);
        $('#partDiscountPrice' + partIndex).val(salePrice);
        $('#partNumber' + partIndex).val(partNumber);
        $('#partHsnCode' + partIndex).val(hsnCode);
        $('#partCgst' + partIndex).val(cgst);
    
        // Recalculate the total after updating the fields
        calculatePartFinalTotal();
    });

    $(document).on('click', '.removePartButton', function() {
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

        // Loop over every row keyed by .partIndex
        $('.partIndex').each(function() {
            var j = $(this).val(); // row index
            var price = $('#partPrice' + j).val();
            var qty = $('#partQty' + j).val(); // Added line to get quantity
            var cgst = $('#partCgst' + j).val();
          
            var discount = $('#partDiscount').val();

            if (discount != "undefined") {
                price = price - ((price * discount) / 100);
                $('#partDiscountPrice' + j).val(price.toFixed(2));

            }

            // var perGst = price * gst / 100; - parseFloat(perGst)
            var perCgst = 0;
        

            var gstPer = Number(cgst) ;
            var totalGst = Number(price) - ((Number(price) * 100) / (100 + Number(gstPer)));

            if (cgst != "undefined") {
                perCgst = totalGst ;
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
            $('#partDiscountPrice' + j).val(subtotal.toFixed(2));
            $('#partCgstValue' + j).val(perCgst.toFixed(2));
           
        });

        // update grand totals
        $('#partGrandTotal').val(finalPartTotal.toFixed(2));
        var serviceGrandTotal = parseFloat($('#grandtotal').val()) || 0;
         var packageGrandTotal = parseFloat($('#packageGrandTotal').val()) ;
        var grossTotal = finalPartTotal + serviceGrandTotal+packageGrandTotal;
        $('#grossTotal').val(grossTotal.toFixed(2));
    }





    $(document).on('keyup', '.partGst', function() {
        // if ($('#partGst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePartFinalTotal();
    });

    $(document).on('change', '.partGst', function() {
        // if ($('#partGst' + partIndex).val() == '') {
        //     $('#partTotal' + partIndex).val(0);
        // }
        calculatePartFinalTotal();
    });
</script>


<script type="text/javascript">
    var packageIndex = <?= $i - 1; ?>;

    $("#addpackage").click(function() {
        packageIndex++;
        var html_code = '';
        html_code += '<tr id="packageRow' + packageIndex + '">';

        html_code += '<td><input type="hidden" class="packageIndex" name="packageIndex[]" value="' + packageIndex + '" readonly/><input type="hidden" class="packageId" name="packageId[]" id="packageId' + packageIndex + '" readonly/><select type="text" name="packageName[]" id="packageName' + packageIndex + '" placeholder="Enter Package Name" class="form-control-sm packageNameDropdown">' + $("#package-dropdown").html() + '</td>';

        html_code += '<td><input type="number" step=".01" name="packagePrice[]" id="packagePrice' + packageIndex + '" placeholder="Price" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="packageDiscountPrice[]" id="packageDiscountPrice' + packageIndex + '" placeholder="Discounted Price" class="form-control-sm" readonly/></td>';

        //    html_code += '<td><input type="text" name="partNumber[]" id="partNumber' + partIndex + '" placeholder="Part Number" class="form-control-sm"></td>';

        html_code += '<td><input type="text" name="packageHsnCode[]" id="packageHsnCode' + packageIndex + '" placeholder="Enter HSN code" class="form-control-sm"></td>';

        html_code += '<td><input type="number" step=".01" name="packageQty[]" id="packageQTY' + packageIndex + '" placeholder="QTY" class="form-control-sm packageGst" style="width: 6rem;"></td>';

        html_code += '<td><input type="number" step=".01" name="packageCgst[]" id="packageCgst' + packageIndex + '" placeholder="Regional Tax%" class="form-control-sm packageGst" style="width: 6rem;"><input type="hidden" name="partCgstValue[]" id="partCgstValue' + partIndex + '" value="0"></td>';

      
        html_code += '<td><input type="text" name="packageTotal[]" id="packageTotal' + packageIndex + '" class="form-control-sm packageTotal" readonly></td>';
        html_code += '<td><button type="button" name="removePackage" id="removePackage' + packageIndex + '" class="btn btn-danger btn-sm remove-package w-100 removePackageButton">Remove</button><input type="hidden" name="package_service_id[]" value="0"></td>';
        $("#packageTable").append(html_code);
        $("#packageName" + packageIndex).select2();
    });

    $(document).on('change', '.packageNameDropdown', function() {
        var packageIndex = $(this).closest('tr').find('.packageIndex').val();
        var selectedPackage = $(this).val();

        // Assuming the product data includes SalePrice and PartNumber
        var salepPrice = $(this).find(':selected').data('salep-price');
        var pdiscountprice = $(this).find(':selected').data('discountp-price');
        var hsnCodep = $(this).find(':selected').data('hsnp-code');
        var cgstp = $(this).find(':selected').data('cgstp');
    

        // Update the partPrice and partHsnCode fields

        $('#packagePrice' + packageIndex).val(salepPrice);
        $('#packageDiscountPrice' + packageIndex).val(pdiscountprice);
        $('#packageHsnCode' + packageIndex).val(hsnCodep);
        $('#packageCgst' + packageIndex).val(cgstp);
      
        // Recalculate the total after updating the fields
        calculatePackageFinalTotal();
    });

    $(document).on('click', '.removePackageButton', function() {

        $(this).parents('tr').remove();
        packageIndex--;
        calculatePackageFinalTotal();
    });

    // Calculation for GST amount and total grand total amount
    function calculatePackageFinalTotal() {
        var finalPackageTotal = 0;

        for (var j = 1; j <= packageIndex; j++) {
            var price = $('#packagePrice' + j).val();
            var qty = $('#packageQTY' + j).val(); // Added line to get quantity
            var cgst = $('#packageCgst' + j).val();
        
            var discount = $('#packageDiscount').val();

            if (discount != "undefined") {
                price = price - ((price * discount) / 100);
                $('#packageDiscountPrice' + j).val(price.toFixed(2));
            }

            var perCgst = 0;
           

            var gstPer = Number(cgst);
            var totalGst = Number(price) - ((Number(price) * 100) / (100 + Number(gstPer)));

            if (cgst != "undefined") {
                perCgst = totalGst / 2;
            }

         
            var subtotal = parseFloat(price);


            var total = 0;
            if (subtotal > 0) {
                total = subtotal * qty;
            }

            finalPackageTotal += parseFloat(total);

            $('#packageTotal' + j).val(total.toFixed(2));

        }

        $('#packageGrandTotal').val(finalPackageTotal.toFixed(2));
        var partGrandTotal = $('#partGrandTotal').val();
        var serviceGrandTotal = $('#grandtotal').val();
        var gtossTotal = parseFloat(finalPackageTotal) + parseFloat(serviceGrandTotal) + parseFloat(partGrandTotal);
        $('#grossTotal').val(gtossTotal.toFixed(2));
    }

    $(document).on('keyup', '.packageGst', function() {

        calculatePackageFinalTotal();
    });

    $(document).on('change', '.packageGst', function() {

        calculatePackageFinalTotal();
    });
</script>



<script type="text/javascript">
    var i = <?= ($ser_i - 1); ?>;
    $("#add").click(function() {
        var length = $('.srno').length;
        ++i;
        var html_code = '';
        html_code += '<tr id="' + i + '">';
        html_code += '<td><input type="hidden" class="srno" name="srno[]" value="' + i + '" readonly/><input type="text" name="service[]" id="service' + i + '" placeholder="Enter Service Name" class="form-control-sm"></td>';
        html_code += '<td><input type="number" step=".01" name="price[]" id="price' + i + '" placeholder="Price" class="form-control-sm gs_t"></td>';
        html_code += '<td><input type="number" step=".01" name="discounted_price[]" id="discountedPrice' + i + '" placeholder="Price" class="form-control-sm" readonly></td>';
        html_code += '<td><input type="text" name="hsn_code[]" id="hsn_code' + i + '" placeholder="Enter HSN code" class="form-control-sm"></td>';
        html_code += '<td><input type="number" step=".01" name="serviceCgst[]" id="cgst' + i + '" placeholder="Regional Tax%" class="form-control-sm gs_t" style="width: 6rem;" min="0" max="100"><input type="hidden" name="serviceCgstValue[]" id="serviceCgstValue' + i + '" value="0"></td>';
         html_code += '<td><input type="text" name="total[]" id="total' + i + '" class="form-control-sm order_item_price" readonly></td>';
        html_code += '<td><button type="button" name="remove_row" id="' + i + '" class="btn btn-danger btn-sm remove-tr w-100 remove_row">Remove</button><input type="hidden" name="service_id[]" value="0"></td>';
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
                var perSgst = 0;

                var cgst = $('#cgst' + j).val();
          
                if (cgst != "undefined") {
                    var perCgst = price * cgst / 100;
                    $('#serviceCgstValue' + j).val(perCgst);
                }
              

                sum = parseFloat(price) + parseFloat(perCgst) + parseFloat(perSgst);
                sum1 = parseFloat(sum) + parseFloat(sum1);

                $('#total' + j).val(sum.toFixed(2));
            }
        }

        if (isNaN(sum1)) {
            sum1 = 0;
        }

        $('#grandtotal').val(sum1.toFixed(2));
 
        var packageGrandTotal = $('#packageGrandTotal').val();
     
        var partGrandTotal = $('#partGrandTotal').val();
        var gtossTotal = parseFloat(sum1) + parseFloat(partGrandTotal)+parseFloat(packageGrandTotal);
        $('#grossTotal').val(gtossTotal.toFixed(2));
    }

    $(document).on('keyup', '.gs_t', function() {
        // if($('#gst'+i).val() ==''){
        //     $('#order_item_price'+i).val(0);
        // }
        cal_final_total();
    });

    $(document).on('change', '.gs_t', function() {
        // if($('#gst'+i).val() ==''){
        //     $('#order_item_price'+i).val(0);
        // }
        cal_final_total();
    });

    //remove button click
    $(document).on('click', '.remove-tr', function() {
        // var ntrid = $(this).closest('tr').attr('id');
        // var grandtotal = $('#grandtotal').val();
        // var ntotal = $('#total'+ntrid).val();
        // var nfinal =  parseFloat(grandtotal) - parseFloat(ntotal);
        // // console.log(nfinal, 'ntrid');
        // $('#grandtotal').val(nfinal.toFixed(2));
        $(this).parents('tr').remove();
        i--;
        cal_final_total();
    });
</script>

<script>
    $(document).on('click', '.remove-service', function() {
        var row = $(this).closest('tr');
        var serviceId = row.find('input[name="service_id[]"]').val();

        // AJAX request to delete service
        $.ajax({
            url: 'adminFunction.php', // Change to the actual PHP script to handle deletion
            method: 'POST',
            data: {
                id: serviceId
            },
            success: function(response) {
                // Handle success (remove row from the table)
                row.remove();
                // You may also want to update the total or perform other actions here
                calculatePartFinalTotal();
                cal_final_total();
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.remove-parts', function() {
        var row = $(this).closest('tr');
        var serviceId = row.find('input[name="part_service_id[]"]').val();

        // AJAX request to delete service
        $.ajax({
            url: 'adminFunction.php', // Change to the actual PHP script to handle deletion
            method: 'POST',
            data: {
                id: serviceId
            },
            success: function(response) {
                // Handle success (remove row from the table)
                row.remove();
                // You may also want to update the total or perform other actions here
                calculatePartFinalTotal();
                cal_final_total();
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });
</script>


</body>

</html>