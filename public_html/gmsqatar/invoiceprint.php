<?php require("connection.php"); ?>
<?php require "number-to-text.php"; ?>
<?php
$partDiscount = 0;
$serviceDiscount = 0;
$packageDiscount = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service | Invoice </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <style>
        .table td,
        .table th {
            text-wrap: nowrap;
        }

        .table {
            width: 100% !important;
        }
    </style>
</head>

<body>
    <div class="wrapper" id="mainContainer">
        <!-- Main content -->
        <?php
        $id = $_GET['id'];
        $Query = "SELECT jc.*, av.*, cu.*, jc.created_at as job_date_time FROM jobcard jc
        JOIN all_vehicle av ON jc.v_id = av.v_id
        JOIN customer cu ON av.c_id = cu.c_id
        WHERE jc.id='$id'";
        $res = mysqli_query($conn, $Query);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $partDiscount = $row['part_discount'];
                $serviceDiscount = $row['service_discount'];
                $packageDiscount = $row['packageDiscount'];
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
                                                <strong>Address / العنوان:</strong><br>
                                                <?php echo $_SESSION['g_address']; ?><br>

                                                <strong>Phone / الهاتف:</strong> <?php echo $_SESSION['g_mob']; ?><br>

                                                <strong>Email / البريد الإلكتروني:</strong> <?php echo $_SESSION['g_email']; ?><br>

                                                <strong>Tax Number / الرقم الضريبي:</strong> <?php echo $_SESSION['g_gst']; ?>
                                            </address>

                                        </div>
                                        <?php if (strtolower($row['job_card_type']) == 'accident'): ?>
                                            <div class="col-sm-4 invoice-col">
                                                <strong>Bill To (Insurance) / الفاتورة إلى (شركة التأمين):</strong>
                                                <address>
                                                    <strong>Insurance Company / شركة التأمين:</strong> <?php echo $row['insurance_company_name']; ?><br>
                                                    <strong>Insurance Code / رمز التأمين:</strong> <?php echo $row['insurance_code']; ?><br>
                                                    <strong>GSTIN / الرقم الضريبي:</strong> <?php echo $row['insurance_gstin']; ?><br>
                                                    <strong>Claim Number / رقم المطالبة:</strong> <?php echo $row['insurance_claim_number']; ?><br>
                                                    <strong>Policy Number / رقم الوثيقة:</strong> <?php echo $row['insurance_policy_number']; ?>
                                                </address>

                                            </div>

                                            <div class="col-sm-4 invoice-col">
                                                <strong>Bill For (Customer) / الفاتورة لـ (العميل):</strong>
                                                <address>
                                                    <strong>Name / الاسم:</strong> <?php echo $row['name']; ?><br>

                                                    <strong>Address / العنوان:</strong> <?php echo $row['c_add']; ?><br>

                                                    <strong>Contact / الهاتف:</strong>
                                                    <?php
                                                    echo $row['contact'];     // English / Arabic label already shown
                                                    $custPhone = $row['contact'];
                                                    ?><br>

                                                    <strong>Email / البريد الإلكتروني:</strong> <?php echo $row['cus_email']; ?><br>

                                                    <strong>GST / ضريبة السلع والخدمات:</strong> <?php echo $row['c_gst']; ?>
                                                </address>

                                            </div>
                                        <?php else: ?>
                                            <div class="col-sm-4 invoice-col">
                                                <strong>Bill To / الفاتورة إلى:</strong>
                                                <address>
                                                    <strong>Name / الاسم:</strong> <?php echo $row['name']; ?><br>

                                                    <strong>Address / العنوان:</strong> <?php echo $row['c_add']; ?><br>

                                                    <strong>Contact / الهاتف:</strong>
                                                    <?php
                                                    echo $row['contact'];
                                                    $custPhone = $row['contact'];
                                                    ?><br>

                                                    <strong>Email / البريد الإلكتروني:</strong> <?php echo $row['cus_email']; ?><br>

                                                    <strong>GST / ضريبة السلع والخدمات:</strong> <?php echo $row['c_gst']; ?>
                                                </address>

                                            </div>
                                        <?php endif; ?>

                                        <div class="col-sm-4 invoice-col">
                                            <b>Tax Invoice # / فاتورة ضريبية رقم: <?php echo $row['invoice_no']; ?></b><br>

                                            <strong>Registration No / رقم التسجيل:</strong> <?php echo $row['registration']; ?><br>

                                            <strong>Odometer Reading / قراءة عداد الكيلومترات:</strong> <?php echo $row['odometer']; ?><br>

                                            <strong>Car Brand / ماركة السيارة:</strong> <?php echo $row['carbrand']; ?><br>

                                            <strong>Car Model / موديل السيارة:</strong> <?php echo $row['carmodel']; ?><br>

                                            <strong>Chassis No / رقم الهيكل:</strong> <?php echo $row['chassis_no']; ?><br>

                                            <strong>Engine No / رقم المحرك:</strong> <?php echo $row['engine_no']; ?><br>

                                            <strong>Job Card No / رقم بطاقة العمل:</strong> <?php echo $row['job_card_no']; ?><br>

                                            <strong>Job Card Type / نوع بطاقة العمل:</strong> <?php echo $row['job_card_type']; ?><br>
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
                                                <strong>Service Due Date / تاريخ استحقاق الخدمة:</strong> <?= htmlspecialchars($serviceDueDate) ?>
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
                                                                        "title" => "Regional Tax @" . $row['pcgst'] . "% (Package)",
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
                                    <!-- <div class="card-header">
                  <h3 class="card-title"><b>SERVICES/OTHERS COST</b></h3>
                </div> -->
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
                                                    $sgstSer = 0;
                                                    $totalCostSer = 0;

                                                    $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2' AND g_id = '" . $_SESSION['id'] . "'";
                                                    $res = mysqli_query($conn, $query);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        $i = 1;
                                                        while ($row = mysqli_fetch_assoc($res)) {
                                                            $totalTaxableAmount += ($row['discounted_price'] * $row['qty']);
                                                            $totalTax += ($row['cgst_value'] + $row['sgst_value']) * $row['qty'];
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

                                    <h3 class="h5">
                                        Tax Summary <br><small style="direction: rtl; display: block;">ملخص الضرائب</small>
                                    </h3>
                                    <div class="d-flex flex-row justify-content-between mt-4 align-items-start flex-wrap gap-3">
                                        <div class="col-lg-7 col-12">
                                            <div class="table-responsive">
                                                <table class="table border">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Particulars<br><small style="direction: rtl;">التفاصيل</small>
                                                            </th>
                                                            <th class="text-right">
                                                                Taxable Amount<br><small style="direction: rtl;">المبلغ الخاضع للضريبة</small>
                                                            </th>
                                                            <th class="text-right">
                                                                Tax Amount<br><small style="direction: rtl;">قيمة الضريبة</small>
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
                                                                            <?= htmlspecialchars($value['title']); ?><br>
                                                                            <small style="direction: rtl; display: block;"><?= /* Arabic translation for $value['title'] if available */ '' ?></small>
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
                                                                Total<br><small style="direction: rtl;">الإجمالي</small>
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
                                                                Total Taxable Amount:<br><small style="direction: rtl;">إجمالي المبلغ الخاضع للضريبة:</small>
                                                            </th>
                                                            <td class="text-right">
                                                                ر.ق <?= number_format($totalTaxableAmount, 2); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                Total Tax Amount:<br><small style="direction: rtl;">إجمالي قيمة الضريبة:</small>
                                                            </th>
                                                            <td class="text-right">
                                                                ر.ق <?= number_format($totalTax, 2); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                Discount:<br><small style="direction: rtl;">الخصم:</small>
                                                            </th>
                                                            <td class="text-right">
                                                                ر.ق <?= number_format($totalDiscount, 2); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                Total Payable:<br><small style="direction: rtl;">الإجمالي المستحق:</small>
                                                            </th>
                                                            <td class="text-right">
                                                                ر.ق <?= number_format($totalTaxableAmount + $totalTax, 2); ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12" style="font-weight: bold;">
                                            In Rupees :<br><small style="direction: rtl;">بالروبية :</small>
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
                                                Payment Methods:<br><small style="direction: rtl;">طرق الدفع:</small>
                                            </p>
                                            <img src="dist/img/credit/visa.png" alt="Visa">
                                            <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                                            <img src="dist/img/credit/american-express.png" alt="American Express">
                                            <img src="dist/img/credit/paypal2.png" alt="Paypal"><br>
                                            <img src="<?php if (isset($_SESSION['user'])) {
                                                            echo $_SESSION['qrcode'];
                                                        } ?>" class="img-radius" alt="" style="width: 220px; border-radius:15px;">
                                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"></p>
                                        </div>
                                    </div>

                                    <strong>
                                        Note:<br><small style="direction: rtl;">ملاحظة:</small>
                                    </strong><br>
                                    Please Note That Grand Total Is GST Included Payable Amount, Terms And Conditions Apply.<br>
                                    يرجى ملاحظة أن الإجمالي يشمل ضريبة GST، وتطبق الشروط والأحكام.

                                    <div style="text-align: right !important; padding-right: 50px; margin-bottom: 100px;">
                                        For <?= htmlspecialchars($_SESSION['user']); ?><br>
                                        لـ <?= htmlspecialchars($_SESSION['user']); ?>
                                    </div>

                                    <div style="clear: both;">
                                        <span style="float:left; padding-left: 50px;">
                                            Receiver Signature-<br><small>توقيع المستلم</small>
                                        </span>
                                        <span style="float:right; padding-right: 50px;">
                                            Authorised Signatory<br><small>المفوض بالتوقيع</small>
                                        </span>
                                    </div>
                                </div>
                                <!-- <div class="row no-print">
                             <div class="col-12">
                                  <button type="button" class="btn btn-default" onclick="downloadPDF()"><i class="fas fa-print"></i> Print</button>
                           </div>
                            </div> -->
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
<?php
            }
        }
?>

<!-- /.content -->
</div>
<!-- ./wrapper -->
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

    // downloadPDF();

    window.print();
</script>
</body>

</html>