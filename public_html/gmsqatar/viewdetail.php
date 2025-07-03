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
                                        <strong>Address / العنوان:</strong><br>
                                        <?php echo $_SESSION['g_address']; ?><br>

                                        <strong>Phone / الهاتف:</strong> <?php echo $_SESSION['g_mob']; ?><br>

                                        <strong>Email / البريد الإلكتروني:</strong> <?php echo $_SESSION['g_email']; ?><br>

                                        <strong>Tax Number / الرقم الضريبي:</strong> <?php echo $_SESSION['g_gst']; ?>
                                    </address>

                                </div>
                                <?php
                                $itemId = $row['uid'];
                                $gId = $_SESSION['id'];

                                // Step 1: Fetch from jobcode_service_items
                                $serviceDueDate = '';
                                $jobcardType = '';
                                $jobcardNo = '';

                                $stmt = $conn->prepare("SELECT job_card_no, job_card_type, service_due_date FROM jobcode_service_items WHERE g_id = ? LIMIT 1");
                                $stmt->bind_param("i", $gId);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($itemRow = $result->fetch_assoc()) {
                                    $jobcardNo = $itemRow['job_card_no'];
                                    $jobcardType = $itemRow['job_card_type'];
                                }
                                $stmt->close();

                                // Step 2: Fetch from jobcard using $_GET['id']
                                $partsDiscount = 0;
                                $serviceDiscount = 0;
                                $packageDiscount = 0;
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $stmt2 = $conn->prepare("SELECT part_discount, service_discount FROM jobcard WHERE id = ? AND g_id = ?");
                                    $stmt2->bind_param("ii", $id, $gId);
                                    $stmt2->execute();
                                    $res = $stmt2->get_result();

                                    if ($row = $res->fetch_assoc()) {
                                        $partsDiscount = $row['part_discount'];
                                        $serviceDiscount = $row['service_discount'];
                                        $packageDiscount = $row['packageDiscount'];
                                    }
                                    $stmt2->close();
                                }
                                ?>
                                <?php
                                $id = $_GET['id'];
                                $query = "SELECT jc.*, av.*, cu.*, jc.created_at as job_date_time FROM jobcard jc
  JOIN all_vehicle av ON jc.v_id = av.v_id
  JOIN customer cu ON av.c_id = cu.c_id
  WHERE jc.id='$id' AND cu.g_id = '" . $_SESSION['id'] . "'";
                                $res = mysqli_query($conn, $query);

                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {

                                ?>
                                        <!-- Output HTML -->
                                        <div class="col-sm-4 invoice-col">
                                            <address>
                                                <strong>Job Card No / رقم بطاقة العمل:</strong> <?php echo $row['job_card_no']; ?><br>
                                                <strong>Job Card Type / نوع بطاقة العمل:</strong> <?php echo $row['job_card_type']; ?><br>
                                            </address>

                                        </div>
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
                                        $date = new DateTime($row1['service_due_date']);
                                        $serviceDueDate = $date->format('d M Y');
                                    }
                                }
                                ?>
                                <div>
                                    <strong>Service Due Date / تاريخ استحقاق الخدمة:</strong>
                                    <?= htmlspecialchars($serviceDueDate) ?>
                                </div>



                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#<br><small>رقم</small></th>
                                            <th>Invoice No :<br><small>رقم الفاتورة</small></th>
                                            <th>Customer Name :<br><small>اسم العميل</small></th>
                                            <th>Mobile :<br><small>رقم الجوال</small></th>
                                            <th>Email :<br><small>البريد الإلكتروني</small></th>
                                            <th>Address :<br><small>العنوان</small></th>
                                            <th>Car Brand :<br><small>ماركة السيارة</small></th>
                                            <th>Car Model :<br><small>طراز السيارة</small></th>
                                            <th>Fuel Type :<br><small>نوع الوقود</small></th>
                                            <th>Registration No :<br><small>رقم التسجيل</small></th>
                                            <th>Engine No :<br><small>رقم المحرك</small></th>
                                            <th>Odo-Meter :<br><small>عداد المسافات</small></th>
                                            <th>Transmission :<br><small>ناقل الحركة</small></th>
                                            <th>Braking :<br><small>الفرامل</small></th>
                                            <th>Fuelmeter :<br><small>مقياس الوقود</small></th>
                                            <th>Insurance :<br><small>التأمين</small></th>
                                            <th>Insurance Company :<br><small>شركة التأمين</small></th>
                                            <th>Insurance Expiry :<br><small>انتهاء التأمين</small></th>
                                            <th>Created Date :<br><small>تاريخ الإنشاء</small></th>
                                            <th>Interior Image :<br><small>صورة الداخلية</small></th>
                                            <th>Exterior Image :<br><small>صورة الخارجية</small></th>
                                            <th>Status :<br><small>الحالة</small></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php view_details($conn); ?>
                                    </tbody>

                                </table>


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
                                        $mech = $row1['instruction_of_mechanic'];
                                    }
                                }






                                echo '<h3 class="card-title col-md-10">Job Card Details</h3>';
                                echo '<div id="wrapper">';
                                echo '<div id="form_div">';
                                echo '<div class="table-responsive">';
                                echo '<table class="table table-bordered table-striped" id="dynamicTable">';
                                echo '<thead>
        <tr>
            <th>Voice Of Customer<br><small>صوت العميل</small></th>
            <th>Instruction To Mechanic<br><small>تعليمات للفني</small></th>
        </tr>
      </thead><tbody>';


                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($voiceOfCustomer) . '</td>';
                                echo '<td>' . htmlspecialchars($mech) . '</td>';
                                echo '</tr>';


                                echo '</tbody></table></div></div></div>';
                                ?>

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



                    <div class="card-body">
                        <h3 class="card-title col-md-10">Parts Details</h3>
                        <div id="wrapper">
                            <?php
                            $grandTotal = 0;
                            $partsDiscount = 0;
                            $serviceDiscount = 0;

                            $id = $_GET['id'];
                            $sql = "SELECT * FROM jobcard WHERE id='$id' AND g_id = '" . $_SESSION['id'] . "'";
                            $res = mysqli_query($conn, $sql);
                            $res = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $partsDiscount = $row['part_discount'];
                                    $serviceDiscount = $row['service_discount'];
                                    $packageDiscount = $row['packageDiscount'];
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
                                                        <th>Parts Name<br><small>اسم القطعة</small></th>
                                                        <th>MRP<br><small>السعر الأقصى</small></th>
                                                        <th>Discounted Price<br><small>السعر بعد الخصم</small></th>
                                                        <th>Part Number<br><small>رقم القطعة</small></th>
                                                        <th>Part Hsn Code<br><small>رمز القطعة HSN</small></th>
                                                        <th>QTY<br><small>الكمية</small></th>
                                                        <th>Regional Tax(%)<br><small>الضريبة الإقليمية (%)</small></th>
                                                        <th>Total Cost<br><small>التكلفة الإجمالية</small></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $itemId = $row['uid'];
                                                    $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '1' AND g_id = '" . $_SESSION['id'] . "'";
                                                    $res = mysqli_query($conn, $query);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        $i = 1;
                                                        while ($row = mysqli_fetch_assoc($res)) { ?>
                                                            <tr id="1">
                                                                <!-- <div id="output"></div> -->
                                                                <td><?php echo $row['partname']; ?></td>
                                                                <td><?php echo $row['partPrice']; ?>.00</td>
                                                                <td><?php echo $row['partDiscountPrice']; ?>(<?php echo $partsDiscount; ?>%)</td>
                                                                <td><?php echo $row['part_number']; ?></td>
                                                                <td><?php echo $row['parthsncode']; ?></td>
                                                                <td><?php echo $row['partqty']; ?></td>
                                                                <td><?php echo $row['partcgst']; ?></td>

                                                                <td><?php echo $row['parttotalpay']; ?></td>
                                                            </tr>
                                                    <?php
                                                            $i++;
                                                            $grandTotal += $row['parttotalpay'];
                                                        }
                                                    } ?>
                                                </tbody>
                                            </table>
                                            <!-- </div> -->
                                            <br>


                                            &nbsp;
                                            <h3 class="card-title col-md-10">Service Package</h3>
                                            <div id="wrapper">
                                                <div id="form_div">
                                                    <!-- <div class="col-md-12"> -->
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" id="dynamicTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Package Name<br><small>اسم الباقة</small></th>
                                                                    <th>Package Price<br><small>سعر الباقة</small></th>
                                                                    <th>Discount Price<br><small>السعر بعد الخصم</small></th>
                                                                    <th>HSN Code<br><small>رمز HSN</small></th>
                                                                    <th>Qty<br><small>الكمية</small></th>
                                                                    <th>Regional Tax(%)<br><small>الضريبة الإقليمية (%)</small></th>
                                                                    <th>Total Cost<br><small>التكلفة الإجمالية</small></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                //$itemId = $row['uid'];
                                                                $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '3' AND g_id = '" . $_SESSION['id'] . "'";

                                                                $res = mysqli_query($conn, $query);
                                                                if (mysqli_num_rows($res) > 0) {
                                                                    $i = 1;
                                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                                                        <tr id="1">
                                                                            <!-- <div id="output"></div> -->

                                                                            <td><?php echo $row['package']; ?></td>
                                                                            <td><?php echo $row['packageprice']; ?></td>
                                                                            <td><?php echo $row['discountprice']; ?> (<?php echo $packageDiscount; ?>%)</td>
                                                                            <td><?php echo $row['hsncode']; ?></td>
                                                                            <td><?php echo $row['pqty']; ?></td>
                                                                            <td><?php echo $row['pcgst']; ?></td>
                                                                            <td><?php echo $row['totalpay']; ?></td>
                                                                        </tr>
                                                                <?php
                                                                        $i++;
                                                                        $grandTotal += $row['totalpay'];
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
                                                                    <th>Service Name/Part Name<br><small>اسم الخدمة / اسم القطعة</small></th>
                                                                    <th>Cost<br><small>التكلفة</small></th>
                                                                    <th>Discounted Cost<br><small>التكلفة بعد الخصم</small></th>
                                                                    <th>HSN Code<br><small>رمز HSN</small></th>
                                                                    <th>Regional Tax(%)<br><small>الضريبة الإقليمية (%)</small></th>
                                                                    <th>Taxable Amt<br><small>المبلغ الخاضع للضريبة</small></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php
                                                                // $itemId = $row['uid'];
                                                                $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2' AND g_id = '" . $_SESSION['id'] . "'";
                                                                $res = mysqli_query($conn, $query);
                                                                if (mysqli_num_rows($res) > 0) {
                                                                    $i = 1;
                                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                                                        <tr id="1">
                                                                            <!-- <div id="output"></div> -->
                                                                            <td><?php echo $row['service']; ?></td>
                                                                            <td><?php echo $row['price']; ?>.00</td>
                                                                            <td><?php echo $row['discounted_price']; ?>(<?php echo $serviceDiscount; ?>%)</td>
                                                                            <td><?php echo $row['hsn_code']; ?></td>
                                                                            <td><?php echo $row['cgst_value']; ?>(<?php echo $row['cgst_percentage']; ?>%)</td>
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

    <strong>Copyright &copy;2022 <a href="">OTODIGITAL TECHNOLOGIES PVT </a>.</strong> All rights reserved.
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