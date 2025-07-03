<?php require "adheader.php"; ?>
<?php require "slidebar.php"; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jobcard All Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="ShowJobCard.php">Home</a></li>
                        <li class="breadcrumb-item active">JobCard Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
       
    </section>

    <!-- /.modal -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title col-md-10">Customer Details</h3>
                            <h3 class="card-title col-md-2"><?php if (isset($_SESSION['msg4'])) {
                                                                echo $_SESSION['msg4'];
                                                                unset($_SESSION['msg4']);
                                                            } ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        <div class="row">
                  <div class="col-12">
                    <h4>
                      <img src="<?php
              if (isset($_SESSION['user'])) {

                echo $_SESSION['img'];
              }; ?>" alt="" style="width: 150px;"> <?php echo $_SESSION['user']; ?>
                    </h4>
                  </div>
                  <div class="col-sm-4 invoice-col">
                    <address>
                      <strong>Address:</strong><br>
                      <?php echo $_SESSION['g_address']; ?><br>
                      Phone:<?php echo $_SESSION['g_mob']; ?><br>
                      Email: <?php echo $_SESSION['g_email']; ?><br>
                      GST: <strong><?php echo $_SESSION['g_gst']; ?></strong>
                    </address>
                  </div> 
                 <?php 
             
             $grandTotal = 0;
             $partsDiscount = 0;
             $serviceDiscount = 0;

             $id = $_GET['id'];
             $sql = "SELECT * FROM jobcard WHERE id='$id' AND g_id = '".$_SESSION['id']."'";
             $res = mysqli_query($conn, $sql);
             $res = mysqli_query($conn, $sql);
             if (mysqli_num_rows($res) > 0) {
                 while ($row = mysqli_fetch_assoc($res)) 
                 {
                     $partsDiscount = $row['part_discount'];
                     $serviceDiscount = $row['service_discount'];
      
                     $itemId = $row['uid'];
                  $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2' AND g_id = '".$_SESSION['id']."'";
                  $res = mysqli_query($conn, $query);
                  if (mysqli_num_rows($res) > 0) {
                      $i=1;
                      while ($row = mysqli_fetch_assoc($res)) { 
                 ?>
                  <div class="col-sm-4 invoice-col">
                    <address>
                        
                      <strong>Job card No:</strong>

                      <?php echo $row['job_card_no']; ?><br>
                      <strong>Job card Type:</strong>

                      <?php echo $row['job_card_type']; ?><br>

                      <?php  } } } }?>
                    </address>
                  </div> 

                      </div>

               

                  
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice No :</th>
                                        <th>Customer Name :</th>
                                        <th>Mobile :</th>
                                        <th>Email :</th>
                                        <th>Address :</th>
                                        <!-- <th>Customer GST :</th> -->
                                        <th>Car Brand :</th>
                                        <th>Car Model :</th>
                                        <th>Fuel Type :</th>
                                        <th>Registration No :</th>
                                        <th>Engine No :</th>
                                        <th>Odo-Meter :</th>
                                        <th>Transmission :</th>
                                        <th>Braking :</th>
                                        <th>Fuelmeter :</th>
                                        <!-- <th>Car RC :</th> -->
                                        <th>Insurance :</th>
                                        <th>Insurance Company :</th>
                                        <th>Insurance Expiry :</th>
                                        <th>Created Date :</th>
                                        <th>Interior Image :</th>
                                        <th>Exterior Image :</th>
                                        <th>Status :</th>
                                         <!--<th>Action :</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php view_details($conn); ?>
                                </tbody>

                            </table>
                            <div class="card-body">
                            <h3 class="card-title col-md-10">Parts Details</h3>
                <div id="wrapper">
                <?php
                    $grandTotal = 0;
                    $partsDiscount = 0;
                    $serviceDiscount = 0;

                    $id = $_GET['id'];
                    $sql = "SELECT * FROM jobcard WHERE id='$id' AND g_id = '".$_SESSION['id']."'";
                    $res = mysqli_query($conn, $sql);
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) 
                        {
                            $partsDiscount = $row['part_discount'];
                            $serviceDiscount = $row['service_discount'];
                ?>

                    <div id="form_div">
                        <div>
                            <input type="hidden" name="g_id" value="<?php echo $row['g_id']; ?>">
                            <input type="hidden" name="uid" value="<?php echo $row['uid']; ?>">
                        </div>
                        <!-- <div class="col-md-12"> -->
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dynamicTable">
                                <thead>
                                    <tr> 
                                        <th>Parts Name</th>
                                        <th>MRP</th>
                                        <th>Discounted Price</th>
                                        <th>Part Number</th>
                                        <th>Part Hsn Code</th>
                                        <th>QTY</th>
                                        <th>CGST(%)</th>
                                        <th>SGST(%)</th>
                                        <th>Discount(%)</th>
                                        <th>Total Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $itemId = $row['uid'];
                                    $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '1' AND g_id = '".$_SESSION['id']."'";
                                    $res = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($res) > 0) {
                                        $i=1;
                                        while ($row = mysqli_fetch_assoc($res)) { ?>
                                <tr id="1">
                                <!-- <div id="output"></div> -->
                                    <td><?php echo $row['partname']; ?></td>
                                    <td><?php echo $row['partPrice']; ?>.00</td>
                                    <td><?php echo $row['partDiscountPrice']; ?></td>
                                    <td><?php echo $row['part_number']; ?></td>
                                    <td><?php echo $row['parthsncode']; ?></td>
                                    <td><?php echo $row['partqty']; ?></td>
                                    <td><?php echo $row['partcgst']; ?></td>
                                    <td><?php echo $row['partsgst']; ?></td>
                                    <td><?php echo $row['partdiscountper']; ?></td>
                                    <td><?php echo $row['parttotalpay']; ?></td>
                                </tr>
                                <?php 
                                        $i++; 
                                        $grandTotal += $row['total'];
                                    }
                                } ?>
                                </tbody>
                            </table>
                            <!-- </div> -->
                            <br>
                            &nbsp;
                            <h3 class="card-title col-md-10">Job Card Details</h3>
                            <div id="wrapper">
                                <div id="form_div">
                                    <!-- <div class="col-md-12"> -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="dynamicTable">
                                            <thead>
                                                <tr> 
                                                   
                                                    <th>Voice Of Customer</th>
                                                    <th>Instruction To Mechanic</th>     
                                                              
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                // $itemId = $row['uid'];
                                                $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2' AND g_id = '".$_SESSION['id']."'";
                                                $res = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($res) > 0) {
                                                    $i=1;
                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                            <tr id="1">
                                            <!-- <div id="output"></div> -->
                                               
                                                <td><?php echo $row['voice_of_customer']; ?></td>
                                                <td><?php echo $row['instruction_of_mechanic']; ?></td>    
                                            </tr>
                                            <?php 
                                                    $i++; 
                                                    
                                                }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- </div> -->
                                    <div class="col-md-12">
                                        <div class="form-inline float-right">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            &nbsp;
                            <h3 class="card-title col-md-10">Service Package</h3>
                            <div id="wrapper">
                                <div id="form_div">
                                    <!-- <div class="col-md-12"> -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="dynamicTable">
                                            <thead>
                                                <tr>   
                                                    <th>Package Name</th>
                                                    <th>Package Price</th>
                                                    <th>Discount Price</th>
                                                    <th>HSN Code</th>
                                                    <th>Qty</th>
                                                    <th>CGST (%)</th>
                                                    <th>SGST (%)</th>               
                                                    <th>Discount(%)</th>              
                                                    <th>Total Cost</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                //$itemId = $row['uid'];
                                                $query = "SELECT j.*,s.package AS service_package_name,s.packageprice AS service_package_price 
                                              
                                            FROM 
                                                jobcode_service_items j 
                                            LEFT JOIN 
                                                servicepackage s ON j.package = s.id
                                            WHERE 
                                                j.uid = '$itemId' AND j.p_s = '3' AND j.g_id = '".$_SESSION['id']."'
                                            ";
                                            
                                                $res = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($res) > 0) {
                                                    $i=1;
                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                            <tr id="1">
                                            <!-- <div id="output"></div> -->
                                               
                                                <td><?php echo $row['service_package_name']; ?></td>
                                                <td><?php echo $row['service_package_price']; ?></td>
                                                <td><?php echo $row['discountprice']; ?></td>
                                                <td><?php echo $row['hsncode']; ?></td>
                                                <td><?php echo $row['pqty']; ?></td>
                                                <td><?php echo $row['pcgst']; ?></td> 
                                                <td><?php echo $row['psgst']; ?></td> 
                                                <td><?php echo $row['discountper']; ?></td>  
                                                <td><?php echo $row['totalpay']; ?></td>   
                                            </tr>
                                            <?php 
                                                    $i++; 
                                                    
                                                }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- </div> -->
                                    <div class="col-md-12">
                                        <div class="form-inline float-right">
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card-body"> -->
                            <h3 class="card-title col-md-10">Service Details</h3>
                            <div id="wrapper">
                                <div id="form_div">
                                    <!-- <div class="col-md-12"> -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="dynamicTable">
                                            <thead>
                                                <tr> 
                                                    <th>Service Name/Part Name</th>
                                                    <th>Cost</th>
                                                    <th>Discounted Cost</th>
                                                    <th>HSN Code</th>
                                                    <th>CGST</th>
                                                    <th>SGST</th>
                                                    <th>Taxable Amt</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                // $itemId = $row['uid'];
                                                $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2' AND g_id = '".$_SESSION['id']."'";
                                                $res = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($res) > 0) {
                                                    $i=1;
                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                            <tr id="1">
                                            <!-- <div id="output"></div> -->
                                                <td><?php echo $row['service']; ?></td>
                                                <td><?php echo $row['price']; ?>.00</td>
                                                <td><?php echo $row['discounted_price']; ?>(<?php echo $serviceDiscount; ?>%)</td>
                                                <td><?php echo $row['hsn_code']; ?></td>
                                                <td><?php echo $row['cgst_value']; ?>(<?php echo $row['cgst_percentage']; ?>%)</td>
                                                <td><?php echo $row['sgst_value']; ?>(<?php echo $row['sgst_percentage']; ?>%)</td>
                                                <td><?php echo $row['total']; ?>.00</td>
                                            </tr>
                                            <?php 
                                                    $i++; 
                                                    $grandTotal += $row['total'];
                                                }
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- </div> -->
                                    <div class="col-md-12">
                                        <div class="form-inline float-right">
                                            <div class="form-inline float-right" style="margin-left: 2rem;">
                                                <label style="padding-right: 8px;">Total: </label><?php echo $grandTotal; ?>.00
                                            </div>
                                            <div class="col-12 mt-4">
                                                <a href="ShowJobCard.php" class="btn btn-success float-right">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>            
                    </div>
        
        <?php }
                    } ?>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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
<script>
    $(function Readdata() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
             
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>