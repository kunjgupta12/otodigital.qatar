<?php require "adheader.php"; ?>
<?php require "slidebar.php"; ?>
<?php require "number-to-text.php"; ?>

<?php
$partDiscount = 0;
$serviceDiscount = 0;
$packageDiscount = 0;
$custPhone = "";
?>
<style>
    .table td,
    .table th {
        text-wrap: nowrap;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="mainContainer">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="ShowJobCard.php">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php
    $id = $_GET['id'];
    $query = "SELECT jc.*, av.*, cu.*, jc.created_at as job_date_time FROM jobcard jc
  JOIN all_vehicle av ON jc.v_id = av.v_id
  JOIN customer cu ON av.c_id = cu.c_id
  WHERE jc.id='$id' AND cu.g_id = '" . $_SESSION['id'] . "'";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $partDiscount = $row['part_discount'];
            $packageDiscount = $row['packageDiscount'];
            $serviceDiscount = $row['service_discount'];
    ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="invoice p-3 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <img src="<?php
                                                        if (isset($_SESSION['user'])) {

                                                            echo $_SESSION['img'];
                                                        }; ?>" alt="" style="width: 150px;"> <?php echo $_SESSION['user']; ?>/invoice
                                            <small class="float-right">Date: <?php echo date("Y-m-d H:i:s", strtotime($row['job_date_time'] . "+330 minute")); ?></small>
                                        </h4>
                                    </div>
                                </div>
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <address>
                                            <strong>Address:</strong><br>
                                            <small>العنوان:</small><br>
                                            <?php echo $_SESSION['g_address']; ?><br>

                                            Phone: <?php echo $_SESSION['g_mob']; ?><br>
                                            <small>رقم الهاتف:</small><br>

                                            Email: <?php echo $_SESSION['g_email']; ?><br>
                                            <small>البريد الإلكتروني:</small><br>

                                            Tax Number: <strong><?php echo $_SESSION['g_gst']; ?></strong><br>
                                            <small>الرقم الضريبي:</small>
                                        </address>

                                    </div>
                                    <?php if (strtolower($row['job_card_type']) == 'accident'): ?>
                                        <div class="col-sm-4 invoice-col">
                                            <strong>Bill To (Insurance):</strong><br>
                                            <small>فاتورة إلى (شركة التأمين):</small>
                                            <address>
                                                <strong>Insurance Company:</strong> <?php echo $row['insurance_company_name']; ?><br>
                                                <small>شركة التأمين:</small><br>

                                                <strong>Insurance Code:</strong> <?php echo $row['insurance_code']; ?><br>
                                                <small>رمز التأمين:</small><br>

                                                <strong>GSTIN:</strong> <?php echo $row['insurance_gstin']; ?><br>
                                                <small>الرقم الضريبي (GSTIN):</small><br>

                                                <strong>Claim Number:</strong> <?php echo $row['insurance_claim_number']; ?><br>
                                                <small>رقم المطالبة:</small><br>

                                                <strong>Policy Number:</strong> <?php echo $row['insurance_policy_number']; ?><br>
                                                <small>رقم الوثيقة:</small>
                                            </address>

                                        </div>

                                        <div class="col-sm-4 invoice-col">
                                            <strong>Bill For (Customer):</strong><br>
                                            <small>فاتورة للعميل:</small>
                                            <address>
                                                <strong>Name:</strong> <?php echo $row['name']; ?><br>
                                                <small>الاسم:</small><br>

                                                <strong>Address:</strong> <?php echo $row['c_add']; ?><br>
                                                <small>العنوان:</small><br>

                                                <strong>Contact:</strong> <?php echo $row['contact'];
                                                                            $custPhone = $row['contact']; ?><br>
                                                <small>رقم الاتصال:</small><br>

                                                <strong>Email:</strong> <?php echo $row['cus_email']; ?><br>
                                                <small>البريد الإلكتروني:</small><br>

                                                <strong>Tax  Number:</strong> <?php echo $row['c_gst']; ?><br>
                                                <small>الرقم الضريبي:</small>
                                            </address>

                                        </div>
                                    <?php else: ?>
                                        <div class="col-sm-4 invoice-col">
                                            <strong>Bill To:</strong><br>
                                            <small>فاتورة إلى:</small>
                                            <address>
                                                <strong>Name:</strong> <?php echo $row['name']; ?><br>
                                                <small>الاسم:</small><br>

                                                <strong>Address:</strong> <?php echo $row['c_add']; ?><br>
                                                <small>العنوان:</small><br>

                                                <strong>Contact:</strong> <?php echo $row['contact'];
                                                                            $custPhone = $row['contact']; ?><br>
                                                <small>رقم الاتصال:</small><br>

                                                <strong>Email:</strong> <?php echo $row['cus_email']; ?><br>
                                                <small>البريد الإلكتروني:</small><br>

                                                <strong>Tax Number:</strong> <?php echo $row['c_gst']; ?><br>
                                                <small>الرقم الضريبي:</small>
                                            </address>

                                        </div>
                                    <?php endif; ?>

                                    <div class="col-sm-4 invoice-col">
                                        <b>Tax Invoice #<?php echo $row['invoice_no']; ?></b><br>
                                        <small>فاتورة ضريبية رقم:</small><br>

                                        <strong>Registration No:</strong> <?php echo $row['registration']; ?><br>
                                        <small>رقم التسجيل:</small><br>

                                        <strong>Odometer Reading:</strong> <?php echo $row['odometer']; ?><br>
                                        <small>قراءة عداد المسافات:</small><br>

                                        <strong>Car Brand:</strong> <?php echo $row['carbrand']; ?><br>
                                        <small>ماركة السيارة:</small><br>

                                        <strong>Car Model:</strong> <?php echo $row['carmodel']; ?><br>
                                        <small>طراز السيارة:</small><br>

                                        <strong>Chassis No:</strong> <?php echo $row['chassis_no']; ?><br>
                                        <small>رقم الهيكل:</small><br>

                                        <strong>Engine No:</strong> <?php echo $row['engine_no']; ?><br>
                                        <small>رقم المحرك:</small><br>

                                        <strong>Job Card No:</strong> <?php echo $row['job_card_no']; ?><br>
                                        <small>رقم بطاقة العمل:</small><br>

                                        <strong>Job Card Type:</strong> <?php echo $row['job_card_type']; ?><br>
                                        <small>نوع بطاقة العمل:</small><br>
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
                                            <strong>Service Due Date:</strong> <?= htmlspecialchars($serviceDueDate) ?>
                                            <br>
                                            <small>تاريخ موعد الخدمة:</small>
                                        </div>

                                        <br>
                                    </div>
                                </div>

                                <?php
                                $totalTaxableAmount = 0;
                                $totalTax = 0;
                                $totalDiscount = 0;
                                $gst_summary = [];
                                ?>

                                <!-- parts items -->
                                <!-- <div class="card-header">
                  <h3 class="card-title"><b>PARTS COST</b></h3>
                </div> -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#<br><small>رقم</small></th>
                                                    <th>Parts<br><small>الأجزاء</small></th>
                                                    <th>Part Number<br><small>رقم القطعة</small></th>
                                                    <th>Part HSN Code<br><small>كود HSN للقطعة</small></th>
                                                    <th>MRP<br><small>السعر الأقصى (MRP)</small></th>
                                                    <th>Discounted Price<br><small>السعر بعد الخصم</small></th>
                                                    <th>Base Price<br><small>السعر الأساسي</small></th>
                                                    <th>QTY<br><small>الكمية</small></th>
                                                    <th>UOM<br><small>وحدة القياس</small></th>
                                                    <th>Taxable Amount<br><small>المبلغ الخاضع للضريبة</small></th>
                                                    <th>Regional Tax%<br><small>نسبة الضريبة الإقليمية %</small></th>
                                                    <th>Total Cost<br><small>التكلفة الإجمالية</small></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $itemId = $row['uid'];

                                                $taxableAmount = 0;
                                                $cgst = 0;

                                                $totalCost = 0;

                                                $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '1' AND g_id = '" . $_SESSION['id'] . "'";
                                                $res = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($res) > 0) {
                                                    $i = 1;



                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $base_price = $row['partDiscountPrice'] * 100 / (100 + ($row['partcgst']));

                                                        $cgst1 = ($base_price * $row['partcgst'] / 100) * $row['partqty'];


                                                        $totalTaxableAmount += ($base_price * $row['partqty']);

                                                        // $totalTax += ($row['partcgst'] + $row['partcgst']) * $row['partqty'];

                                                        $totalTax += $cgst1;

                                                        $totalDiscount += ($row['partPrice'] - $row['partDiscountPrice']) * $row['partqty'];

                                                        if ($row['partcgst'] > 0) {
                                                            $gstKey = 'partcgst' . $row['partcgst'];

                                                            if (isset($gst_summary[$gstKey])) {
                                                                $gst_summary[$gstKey]["totalAmount"] += $base_price * $row['partqty'];
                                                                $gst_summary[$gstKey]["tax"] += ($base_price * $row['partcgst'] / 100) * $row['partqty'];
                                                            } else {
                                                                $pgst = array(
                                                                    "title" => "Regional Tax @" . $row['partcgst'] . "% (Parts)",
                                                                    "totalAmount" => $base_price * $row['partqty'],
                                                                    "tax" => ($base_price * $row['partcgst'] / 100) * $row['partqty']
                                                                );

                                                                $gst_summary[$gstKey] = $pgst;
                                                            }
                                                        }


                                                ?>

                                                        <tr>
                                                            <td><?= $i; ?></td>

                                                            <td><?= $row['partname']; ?></td>
                                                            <td><?= $row['part_number']; ?></td>
                                                            <td><?= $row['parthsncode']; ?></td>
                                                            <td>ر.ق <?= number_format($row['partPrice'], 2); ?></td>
                                                            <td>
                                                                ر.ق <?= number_format($row['partDiscountPrice'], 2); ?>
                                                                (<?= $partDiscount; ?>%)
                                                            </td>
                                                            <td>ر.ق <?= number_format($base_price, 2); ?></td>

                                                            <td><?= $row['partqty']; ?></td>
                                                            <td>PCS</td>
                                                            <td>ر.ق <?= number_format(($base_price * $row['partqty']), 2); ?></td>
                                                            <td>
                                                                ر.ق <?= number_format($cgst1, 2); ?>
                                                                (<?= $row['partcgst']; ?>%)
                                                            </td>

                                                            <td>ر.ق <?= number_format($row['partDiscountPrice'] * $row['partqty'], 2); ?></td>
                                                        </tr>
                                                <?php
                                                        $taxableAmount += ($base_price * $row['partqty']);
                                                        $cgst += ($base_price * $row['partcgst'] / 100) * $row['partqty'];


                                                        $totalCost = $taxableAmount + $cgst;


                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="9" class="text-center">
                                                        Total
                                                    </th>
                                                    <th>ر.ق <?= number_format($taxableAmount, 2); ?></th>
                                                    <th>ر.ق <?= number_format($cgst, 2); ?></th>
                                                    <th>ر.ق <?= number_format($totalCost, 2); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div><br>

                                <!-- parts items -->

                                <!-- <div class="card-header">
                  <h3 class="card-title"><b>SERVICES/OTHERS COST</b></h3>
                </div> -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped ">
                                            <thead>
                                                <tr>
                                                    <th>#<br><small>رقم</small></th>
                                                    <th>Package<br><small>الحزمة</small></th>
                                                    <th>Package Hsn_Code<br><small>رمز HSN للحزمة</small></th>
                                                    <th>Package Price<br><small>سعر الحزمة</small></th>
                                                    <th>Discounted Price<br><small>السعر بعد الخصم</small></th>
                                                    <th>Base Price<br><small>السعر الأساسي</small></th>
                                                    <th>Package Qty<br><small>كمية الحزمة</small></th>
                                                    <th>UOM<br><small>وحدة القياس</small></th>
                                                    <th>Taxable Amount<br><small>المبلغ الخاضع للضريبة</small></th>
                                                    <th>Package Regional Tax(%)<br><small>ضريبة الحزمة الإقليمية (%)</small></th>
                                                    <th>Total Payable<br><small>المبلغ الإجمالي المستحق</small></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $taxableAmountSer1 = 0;
                                                $cgstSer1 = 0;
                                                $sgstSer1 = 0;
                                                $totalCostSer1 = 0;

                                                $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '3' AND g_id = '" . $_SESSION['id'] . "'";

                                                $res = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($res) > 0) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $base_price = $row['discountprice'] * 100 / (100 + ($row['pcgst']));

                                                        $cgst2 = ($base_price * $row['pcgst'] / 100) * $row['pqty'];

                                                        $totalTaxableAmount += ($base_price * $row['pqty']);

                                                        // $totalTax += ($row['pcgst'] + $row['psgst']) * $row['pqty'];
                                                        $totalTax += $cgst2;
                                                        $totalDiscount += (($row['packageprice'] - $row['discountprice']) * $row['pqty']);

                                                        if ($row['pcgst'] > 0) {
                                                            $gstKey = 'cgst_labor_' . $row['pcgst'];

                                                            if (isset($gst_summary[$gstKey])) {
                                                                $gst_summary[$gstKey]["totalAmount"] += $base_price * $row['pqty'];
                                                                $gst_summary[$gstKey]["tax"] += ($base_price * $row['pcgst'] / 100) * $row['pqty'];
                                                            } else {
                                                                $pgst = array(
                                                                    "title" => "Regional @" . $row['pcgst'] . "% (Package)",
                                                                    "totalAmount" => $base_price * $row['pqty'],
                                                                    "tax" => ($base_price * $row['pcgst'] / 100) * $row['pqty']
                                                                );

                                                                $gst_summary[$gstKey] = $pgst;
                                                            }
                                                        }


                                                ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?= $row['package']; ?></td>
                                                            <td><?= $row['hsncode']; ?></td>
                                                            <td><?= $row['packageprice']; ?></td>
                                                            <td> ر.ق <?= number_format($row['discountprice'], 2) ?> (<?= $packageDiscount; ?>%)</td>
                                                            <td>ر.ق <?= number_format(($base_price), 2); ?></td>

                                                            <td><?= $row['pqty']; ?></td>
                                                            <td>PCS</td>
                                                            <td>ر.ق <?= number_format(($base_price) * $row['pqty'], 2); ?></td>
                                                            <td>ر.ق <?= number_format(($cgst2), 2); ?> (<?= $row['pcgst']; ?>%) </td>

                                                            <td>ر.ق <?= number_format($row['discountprice'] * $row['pqty'], 2); ?></td>
                                                        </tr>
                                                <?php
                                                        $taxableAmountSer1 += ($base_price * $row['pqty']);
                                                        $cgstSer1 += ($base_price * $row['pcgst'] / 100) * $row['pqty'];
                                                        // $totalCostSer = $row['totalcost'];

                                                        $totalCostSer1 = $taxableAmountSer1 + $cgstSer1;
                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="8" class="text-center">
                                                        Total
                                                    </th>
                                                    <th>ر.ق <?= number_format($taxableAmountSer1, 2); ?></th>

                                                    <th>ر.ق <?= number_format($cgstSer1, 2); ?></th>

                                                    <th>ر.ق <?= number_format($totalCostSer1, 2); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped ">
                                            <thead>
                                                <tr>
                                                    <th>#<br><small>رقم</small></th>
                                                    <th>Service<br><small>الخدمة</small></th>
                                                    <th>HSN Code<br><small>رمز HSN</small></th>
                                                    <th>Service Cost<br><small>تكلفة الخدمة</small></th>
                                                    <th>Unit Price<br><small>سعر الوحدة</small></th>
                                                    <th>QTY<br><small>الكمية</small></th>
                                                    <th>UOM<br><small>وحدة القياس</small></th>
                                                    <th>Taxable Amount<br><small>المبلغ الخاضع للضريبة</small></th>
                                                    <th>Regional Tax%<br><small>الضريبة الإقليمية %</small></th>
                                                    <th>Total Cost<br><small>التكلفة الإجمالية</small></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $taxableAmountSer = 0;
                                                $cgstSer = 0;

                                                $totalCostSer = 0;

                                                $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2' AND g_id = '" . $_SESSION['id'] . "'";
                                                $res = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($res) > 0) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $totalTaxableAmount += ($row['discounted_price'] * $row['qty']);
                                                        $totalTax += ($row['cgst_value']) * $row['qty'];
                                                        $totalDiscount += (($row['price'] - $row['discounted_price']) * $row['qty']);

                                                        if ($row['cgst_percentage'] > 0) {
                                                            $gstKey = 'cgst_labor_' . $row['cgst_percentage'];

                                                            if (isset($gst_summary[$gstKey])) {
                                                                $gst_summary[$gstKey]["totalAmount"] += $row['discounted_price'] * $row['qty'];
                                                                $gst_summary[$gstKey]["tax"] += $row['cgst_value'] * $row['qty'];
                                                            } else {
                                                                $pgst = array(
                                                                    "title" => "Regional Tax @" . $row['cgst_percentage'] . "% (Service)",
                                                                    "totalAmount" => $row['discounted_price'] * $row['qty'],
                                                                    "tax" => $row['cgst_value'] * $row['qty']
                                                                );

                                                                $gst_summary[$gstKey] = $pgst;
                                                            }
                                                        }


                                                ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?= $row['service']; ?></td>
                                                            <td><?= $row['hsn_code']; ?></td>
                                                            <td>ر.ق<?= number_format($row['price'], 2); ?></td>
                                                            <td>ر.ق <?= number_format($row['discounted_price'], 2); ?>(<?= $serviceDiscount; ?>%)</td>
                                                            <td><?= $row['qty']; ?></td>
                                                            <td>PCS</td>
                                                            <td>ر.ق <?= number_format(($row['discounted_price'] * $row['qty']), 2); ?></td>
                                                            <td>
                                                                ر.ق <?= number_format($row['cgst_value'] * $row['qty'], 2); ?>
                                                                (<?= $row['cgst_percentage']; ?>%)
                                                            </td>

                                                            <td>ر.ق <?= number_format($row['total'], 2); ?></td>
                                                        </tr>
                                                <?php
                                                        $taxableAmountSer += ($row['discounted_price'] * $row['qty']);
                                                        $cgstSer += $row['cgst_value'] * $row['qty'];

                                                        $totalCostSer += $row['total'];

                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="7" class="text-center">
                                                        Total
                                                    </th>
                                                    <th>ر.ق <?= number_format($taxableAmountSer, 2); ?></th>
                                                    <th>ر.ق <?= number_format($cgstSer, 2); ?></th>

                                                    <th>ر.ق <?= number_format($totalCostSer, 2); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.row -->


                                <h3 class="h5">Tax Summary <br><small>ملخص الضريبة</small></h3>
                                <div class="d-flex flex-row justify-content-between mt-4 align-items-start flex-wrap gap-3">
                                    <div class="col-lg-7 col-12">
                                        <div class="table-responsive">
                                            <table class="table border">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Particulars<br><small>التفاصيل</small>
                                                        </th>
                                                        <th class="text-right">
                                                            Taxable Amount<br><small>المبلغ الخاضع للضريبة</small>
                                                        </th>
                                                        <th class="text-right">
                                                            Tax Amount<br><small>مقدار الضريبة</small>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $tax = 0; ?>
                                                    <?php if (!empty($gst_summary)): ?>
                                                        <?php foreach ($gst_summary as $key => $value): ?>
                                                            <?php $tax += $value['tax']; ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="">
                                                                        <?= $value['title']; ?>
                                                                    </a>
                                                                </td>
                                                                <td class="text-right">ر.ق <?= number_format($value['totalAmount'], 2); ?></td>
                                                                <td class="text-right">ر.ق <?= number_format($value['tax'], 2); ?></td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2" class="text-right">
                                                            Total<br><small>الإجمالي</small>
                                                        </th>
                                                        <th class="text-right">
                                                            ر.ق <?= number_format($tax, 2); ?>
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="table-responsive">
                                            <table class="table border">
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            Total Taxable Amount:<br><small>إجمالي المبلغ الخاضع للضريبة</small>
                                                        </th>
                                                        <td class="text-right">ر.ق <?= number_format($totalTaxableAmount, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Total Tax Amount:<br><small>إجمالي مقدار الضريبة</small>
                                                        </th>
                                                        <td class="text-right">ر.ق <?= number_format($totalTax, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Discount:<br><small>الخصم</small>
                                                        </th>
                                                        <td class="text-right">ر.ق <?= number_format($totalDiscount, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Total Payable:<br><small>الإجمالي المستحق</small>
                                                        </th>
                                                        <td class="text-right">ر.ق <?= number_format($totalTaxableAmount + $totalTax, 2); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12" style="font-weight: bold;">
                                        In Rupees :<br><small>بالروبية :</small>
                                        <?php
                                        $totalPayable = number_format($totalTaxableAmount + $totalTax, 0, '.', '');
                                        echo ucfirst(numberToWords($totalPayable));
                                        echo " only.";
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <p class="lead">
                                            Payment Methods:<br><small>طرق الدفع:</small>
                                        </p>
                                        <img src="dist/img/credit/visa.png" alt="Visa">
                                        <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                                        <img src="dist/img/credit/american-express.png" alt="American Express">
                                        <img src="dist/img/credit/paypal2.png" alt="Paypal"><br>
                                        <img src="<?php if (isset($_SESSION['user'])) {
                                                        echo $_SESSION['qrcode'];
                                                    } ?>"
                                            class="img-radius" alt="" style="width: 220px; border-radius:15px;">
                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"></p>
                                    </div>
                                </div>

                                <strong>
                                    Note:<br><small>ملاحظة:</small>
                                </strong><br>
                                Please Note That Grand Total Is Tax Included Payable Amount, Terms And Conditions Apply.<br>
                                يرجى ملاحظة أن الإجمالي يشمل ضريبة Tax. وتطبق الشروط والأحكام.

                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="invoiceprint.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-default d-none d-sm-block" style="width: 250px">
                                            <i class="fas fa-print"></i> Print<br><small>طباعة</small>
                                        </a>
                                        <a href="generate-pdf.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-default d-none d-sm-block" style="width: 250px">
                                            <i class="fas fa-download"></i> Download<br><small>تحميل</small>
                                        </a>

                                        <button type="button" onclick="copyText()" class="btn btn-default" style="width: 250px">
                                            Copy<br><small>نسخ</small>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
    <?php }
    } ?>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer no-print">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://merigarage.com">OTODIGITAL TECHNOLOGIES  PVT</a>.</strong> All rights reserved.
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

<script type="text/javascript">
    function downloadPDF() {
        var pdf = new jsPDF('p', 'pt', 'a4');
        pdf.addHTML($("#mainContainer"), 0, -20, {
            allowTaint: true,
            useCORS: true,
            pagesplit: false
        }, function() {
            pdf.save('Invoice.pdf');
        });
    }

    function copyText() {
        // Copy the text inside the text field
        navigator.clipboard.writeText("https://merigarage.com/GarageAdmin/generate-pdf.php?id=<?= $_GET['id'] ?>");

        // Alert the copied text
        alert("Copied the text");
    }
</script>
</body>

</html>