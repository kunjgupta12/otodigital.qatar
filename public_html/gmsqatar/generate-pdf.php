<?php
require 'vendor/autoload.php';
require("connection.php");
require "number-to-text.php";



$id = $_GET['id'];
$row = "";
$garrage = "";
$garrage_logo = "";
$garrage_qr = "";
$visa = "";
$mastercard = "";
$americanExpress = "";
$paypal = "";

$Query = "SELECT jc.*, av.*, cu.*, jc.created_at as job_date_time FROM jobcard jc
    JOIN all_vehicle av ON jc.v_id = av.v_id
    JOIN customer cu ON av.c_id = cu.c_id
    WHERE jc.id='$id'";
$res = mysqli_query($conn, $Query);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);;
    $partDiscount = $row['part_discount'];
    $serviceDiscount = $row['service_discount'];
    $packageDiscount = $row['packageDiscount'];
    $sql2 = "SELECT * FROM call_login WHERE g_id =" . $row['g_id'];
    $res2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($res2) > 0) {
        $garrage = mysqli_fetch_assoc($res2);

        $garrage_logo = '';
        $garrage_qr = '';

        if (!empty($garrage['img']) && file_exists($garrage['img'])) {
            $garrage_logo = 'data:image/png;base64,' . base64_encode(file_get_contents($garrage['img']));
        }

        if (!empty($garrage['qrcode']) && file_exists($garrage['qrcode'])) {
            $garrage_qr = 'data:image/png;base64,' . base64_encode(file_get_contents($garrage['qrcode']));
        }

        // Remote images (skip file_exists for URLs)
        $visa = base64_encode("https://www.merigarage.com/GarageAdmin/dist/img/credit/visa.png");
        $mastercard = base64_encode("https://www.merigarage.com/GarageAdmin/dist/img/credit/mastercard.png");
        $americanExpress = base64_encode("https://www.merigarage.com/GarageAdmin/dist/img/credit/american-express.png");
        $paypal = base64_encode("https://www.merigarage.com/GarageAdmin/dist/img/credit/paypal2.png");
    }
}


$jobCardType = strtolower($row['job_card_type']);

if ($jobCardType == 'accident') {
    $billToBlock = '
    <div class="col-sm-4 invoice-col">
        <strong>Bill To (Insurance):</strong>
        <address>
            <strong>Insurance Company:</strong> ' . $row['insurance_company'] . '<br>
            <strong>Insurance Code:</strong> ' . $row['insurance_code'] . '<br>
            <strong>GSTIN:</strong> ' . $row['insurance_gstin'] . '<br>
            <strong>Claim Number:</strong> ' . $row['insurance_claim_number'] . '<br>
            <strong>Policy Number:</strong> ' . $row['insurance_policy_number'] . '
        </address>
    </div>

    <div class="col-sm-4 invoice-col">
        <strong>Bill For (Customer):</strong>
        <address>
            <strong>Name: </strong>' . $row['name'] . '<br>
            <strong>Address:</strong>' . $row['c_add'] . '<br>
            <strong>Contact:</strong>' . $row['contact'] . '<br>
            <strong>Email:</strong>' . $row['cus_email'] . '<br>
            <strong>GST:</strong> ' . $row['c_gst'] . '
        </address>
    </div>';
} else {
    $billToBlock = '
    <div class="col-sm-4 invoice-col">
        <strong>Bill To:</strong>
        <address>
            <strong>Name: </strong>' . $row['name'] . '<br>
            <strong>Address:</strong>' . $row['c_add'] . '<br>
            <strong>Contact:</strong>' . $row['contact'] . '<br>
            <strong>Email:</strong>' . $row['cus_email'] . '<br>
            <strong>GST:</strong> ' . $row['c_gst'] . '
        </address>
    </div>';
}

// Setup PDF
$mpdf = new \Mpdf\Mpdf(['default_font' => 'dejavusans']);
$mpdf->SetTitle("Revenue Report");

$html = '<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @media (min-width: 576px) {
            .col-sm-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
        }

        .row {

            display: flex;
            flex-wrap: wrap;
            padding-right: 12px;
            padding-left: 12px;

        }

        address {
            margin-bottom: 1rem;
            font-style: normal;
            line-height: inherit;
        }

        .table-responsive {
            display: block;
            width: 100%;
            /* overflow-x: auto; */
            /* -webkit-overflow-scrolling: touch; */
        }

        

        .col-12 {
            flex: 0 0 auto;
            width: 100%;
        }

        .table:not(.table-dark) {
            color: inherit;
        }

        .table:not(.table-dark) {
            color: inherit;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .table thead th {
            vertical-align: top;
            border-bottom: 2px solid #dee2e6;
        }

        .table td,
        .table th {
            padding-top: 10px !important;
            padding-bottom: 10px !important;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 1px;
            border-collapse: collapse;
        }

        * .table th,
        .table td {
            padding-left: 20px !important;
            padding-right: 20px !important;
            text-wrap: nowrap;
        }

        .h5,
        h5 {
            font-size: 1.25rem;
        }

        .gap-3 {
            gap: 1rem !important;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
        }

        .align-items-start {
            align-items: flex-start !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .flex-wrap {
            flex-wrap: wrap !important;
        }

        .flex-row {
            flex-direction: row !important;
        }

        .d-flex {
            display: flex !important;
        }

        @media (min-width: 992px) {
            .col-xs-7 {
                flex: 0 0 auto;
                width: 58.33333333%;
            }
        }

        @media (min-width: 992px) {
            .col-xs-6 {
                flex: 0 0 auto;
                width: 50%;
            }
        }

        @media (min-width: 992px) {
            .col-xs-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
        }



        .lead {
            font-size: 1.25rem;
            font-weight: 300;
        }

        .shadow-none {
            box-shadow: none !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .btn {

            display: inline-block;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cuر.قor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            border: 1px solid #212529;
            border-radius: 4px;
            background-color: transparent;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05);
        }
        
        .table td, .table th
        {
            text-wrap: nowrap;
        }
        .table
        {
            width: 100% !important;
        }
    </style>
</head>

<body>
    <div class="invoice p-3 mb-3">
        <div class="row">
            <div class="col-12">
                <h4>
                    <img src="' . $garrage_logo . '" alt="" style="width: 150px;"> ' . $garrage['g_name'] . '/invoice
                    <small class="float-right">Date: ' . date("Y-m-d H:i:s", strtotime($row['job_date_time'] . "+330 minute")) . '</small>
                </h4>
            </div>
        </div>
        
<div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
        <address>
            <strong>Address / العنوان:</strong><br>
            ' . $garrage['g_address'] . '<br>
            <strong>Phone / الهاتف:</strong> ' . $garrage['g_mob'] . '<br>
            <strong>Email / البريد الإلكتروني:</strong> ' . $garrage['g_email'] . '<br>
            <strong>Tax Number / الرقم الضريبي:</strong> <strong>' . $garrage['g_gst'] . '</strong>
        </address>
    </div>
</div>';

$html .= $billToBlock;
$html .= '   <div class="col-sm-4 invoice-col">
            
  <b>Tax Invoice # / فاتورة ضريبية رقم: ' . $row['invoice_no'] . '</b><br>
  <strong>Registration No / رقم التسجيل:</strong> ' . $row['registration'] . '<br>
  <strong>Car Brand / ماركة السيارة:</strong> ' . $row['carbrand'] . '<br>
  <strong>Car Model / موديل السيارة:</strong> ' . $row['carmodel'] . '<br>
  <strong>Chassis No / رقم الهيكل:</strong> ' . $row['chassis_no'] . '<br>
  <strong>Engine No / رقم المحرك:</strong> ' . $row['engine_no'] . '<br>
  <strong>Job Card No / رقم بطاقة العمل:</strong> ' . $row['job_card_no'] . '<br>
  <strong>Job Card Type / نوع بطاقة العمل:</strong> ' . $row['job_card_type'] . '<br>
  <br>

            </div>
        </div>';

$html .= '<div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                 <thead>
    <tr>
        <th># / الرقم</th>
        <th>Parts / الأجزاء</th>
        <th>Part Number / رقم الجزء</th>
        <th>HSN Code / رمز HSN</th>
        <th>MRP / السعر الأقصى للبيع</th>
        <th>Discounted Price / السعر بعد الخصم</th>
        <th>Base Price / السعر الأساسي</th>
        <th>QTY / الكمية</th>
        <th>UOM / وحدة القياس</th>
        <th>Taxable Amount / المبلغ الخاضع للضريبة</th>
        <th>Regional Tax% / الضريبة الإقليمية %</th>
        <th>Total Cost / التكلفة الإجمالية</th>
    </tr>
</thead>

                    <tbody>';

$totalTaxableAmount = 0;
$totalTax = 0;
$totalDiscount = 0;
$gst_summary = [];

$itemId = $row['uid'];

$taxableAmount = 0;
$cgst = 0;
$totalCost = 0;

$query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '1' AND g_id = '" . $garrage['g_id'] . "'";
$res = mysqli_query($conn, $query);
if (mysqli_num_rows($res) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        $base_price = $row['partDiscountPrice'] * 100 / (100 + ($row['partcgst']));

        $cgst1 = ($base_price * $row['partcgst'] / 100) * $row['partqty'];
        $totalTaxableAmount += ($base_price * $row['partqty']);
        $totalTax += $cgst1;
        $totalDiscount += ($row['partPrice'] - $row['partDiscountPrice']) * $row['partqty'];
        if ($row['partcgst'] > 0) {
            $gstKey = 'partcgst' . $row['partcgst'];

            if (isset($gst_summary[$gstKey])) {
                $gst_summary[$gstKey]["totalAmount"] += $base_price * $row['partqty'];
                $gst_summary[$gstKey]["tax"] += ($base_price * $row['partcgst'] / 100) * $row['partqty'];
            } else {
                $pgst = array(
                    "title" => "CGST @" . $row['partcgst'] . "% (Parts)",
                    "totalAmount" => $base_price * $row['partqty'],
                    "tax" => ($base_price * $row['partcgst'] / 100) * $row['partqty']
                );

                $gst_summary[$gstKey] = $pgst;
            }
        }

        $html .= '<tr>
            <td>' . $i . '</td>
            <td>' . $row['partname'] . '</td>
            <td>' . $row['part_number'] . '</td>
            <td>' . $row['parthsncode'] . '</td>
            <td>ر.ق. ' . number_format($row['partPrice'], 2) . '</td>
            <td>ر.ق. ' . number_format($row['partDiscountPrice'], 2) . '(' . $partDiscount . '%)</td>
            <td>ر.ق. ' . number_format($base_price, 2) . '</td>
            <td>' . $row['partqty'] . '</td>
            <td>PCS</td>
            <td>ر.ق. ' . number_format(($base_price * $row['partqty']), 2) . '</td>
            <td>ر.ق. ' . number_format($cgst1, 2) . '( ' . $row['partcgst'] . '%) </td>
           
            <td>ر.ق. ' . number_format($row['partDiscountPrice'] * $row['partqty'], 2) . '</td>
        </tr>';

        $taxableAmount += ($base_price * $row['partqty']);
        $cgst += ($base_price * $row['partcgst'] / 100) * $row['partqty'];

        $totalCost = $taxableAmount + $cgst;
        $i++;
    }
}

$html .= '</tbody>
                    <tfoot>
                        <tr>
                            <th colspan="9" class="text-center">Total</th>
                            <th>ر.ق. ' . number_format($taxableAmount, 2) . '</th>
                            <th>ر.ق. ' . number_format($cgst, 2) . '</th>
                         
                            <th>ر.ق. ' . number_format($totalCost, 2) . '</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div><br>';



$html .= '<div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped ">
                <thead>
    <tr>
        <th># / الرقم</th>
        <th>Package / الباقة</th>
        <th>Package HSN Code / رمز HSN للباقة</th>
        <th>Package Price / سعر الباقة</th>
        <th>Discounted Price / السعر بعد الخصم</th>
        <th>Base Price / السعر الأساسي</th>
        <th>Package Qty / كمية الباقة</th>
        <th>UOM / وحدة القياس</th>
        <th>Taxable Amount / المبلغ الخاضع للضريبة</th>
        <th>Package Regional Tax (%) / الضريبة الإقليمية للباقة (%)</th>
        <th>Total Payable / الإجمالي المستحق</th>
    </tr>
</thead>

                <tbody>';


$taxableAmountSer1 = 0;
$cgstSer1 = 0;
$totalCostSer1 = 0;

$query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '3' AND g_id = '" . $garrage['g_id'] . "'";

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
                    "title" => "CGST @" . $row['pcgst'] . "% (Package)",
                    "totalAmount" => $base_price * $row['pqty'],
                    "tax" => ($base_price * $row['pcgst'] / 100) * $row['pqty']
                );

                $gst_summary[$gstKey] = $pgst;
            }
        }


        $html .= '<tr>
                        <td><?= $i; ?></td>
                        <td> ' . $row['package'] . '</td>
                        <td> ' . $row['hsncode'] . '</td> 
                        <td>' . $row['packageprice'] . '</td>
                        <td>ر.ق. ' . number_format($row['discountprice'], 2) . '(' . $packageDiscount . '%)</td>
                        <td>ر.ق. ' . number_format($base_price, 2) . '</td>
                        <td>' . $row['pqty'] . '</td>
                        <td>PCS</td>
                        <td>ر.ق. ' . number_format(($base_price * $row['pqty']), 2) . '</td>
                        <td>ر.ق. ' . number_format($cgst2, 2) . '( ' . $row['pcgst'] . '%) </td>
                          <td>ر.ق. ' . number_format($row['discountprice'] * $row['pqty'], 2) . '</td>                        
                    </tr> ';

        $taxableAmountSer1 += ($base_price * $row['pqty']);
        $cgstSer1 += ($base_price * $row['pcgst'] / 100) * $row['pqty'];

        // $totalCostSer = $row['totalcost'];

        $totalCostSer1 = $taxableAmountSer1 + $cgstSer1;
        $i++;
    }
}

$html .= ' </tbody>                            
                         <tfoot>
                      <tr>
                       

                          <tr>
                            <th colspan="8" class="text-center">Total</th>
                            <th>ر.ق. ' . number_format($taxableAmountSer1, 2) . '</th>
                            <th>ر.ق. ' . number_format($cgstSer1, 2) . '</th>
                          
                            <th>ر.ق. ' . number_format($totalCostSer1, 2) . '</th>
                        </tr>

                        
                    </tr>
                </tfoot>
            </table>
        </div>
    </div><br>';



$html .= '<div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped ">
                   <thead>
  <tr>
    <th># / الرقم</th>
    <th>Service / الخدمة</th>
    <th>HSN Code / رمز HSN</th>
    <th>Service Cost / تكلفة الخدمة</th>
    <th>Unit Price / سعر الوحدة</th>
    <th>QTY / الكمية</th>
    <th>UOM / وحدة القياس</th>
    <th>Taxable Amount / المبلغ الخاضع للضريبة</th>
    <th>Regional Tax% / الضريبة الإقليمية %</th>
    <th>Total Cost (Tax inc) / التكلفة الإجمالية (شاملة الضريبة)</th>
  </tr>
</thead>

                   
                    <tbody>';

$taxableAmountSer = 0;
$cgstSer = 0;

$totalCostSer = 0;

$query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2' AND g_id = '" . $garrage['g_id'] . "'";
$res = mysqli_query($conn, $query);
if (mysqli_num_rows($res) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        $totalTaxableAmount += ($row['discounted_price'] * $row['qty']);
        $totalTax += $row['cgst_value'];
        $totalDiscount += (($row['price'] - $row['discounted_price']) * $row['qty']);

        if ($row['cgst_percentage'] > 0) {
            $gstKey = 'cgst_labor_' . $row['cgst_percentage'];

            if (isset($gst_summary[$gstKey])) {
                $gst_summary[$gstKey]["totalAmount"] += $row['discounted_price'] * $row['qty'];
                $gst_summary[$gstKey]["tax"] += $row['cgst_value'] * $row['qty'];
            } else {
                $pgst = array(
                    "title" => "Regional Tax@" . $row['cgst_percentage'] . "% (Service)",
                    "totalAmount" => $row['discounted_price'] * $row['qty'],
                    "tax" => $row['cgst_value'] * $row['qty']
                );

                $gst_summary[$gstKey] = $pgst;
            }
        }


        $html .= '<tr>
            <td>' . $i . '</td>
            <td>' . $row['service'] . '</td>
            <td>' . $row['hsn_code'] . '</td>
            <td>ر.ق. ' . number_format($row['price'], 2) . '</td>
            <td>ر.ق. ' . number_format($row['discounted_price'], 2) . '(' . $serviceDiscount . '%)</td>
            <td>' . $row['qty'] . '</td>
            <td>PCS</td>
            <td>ر.ق. ' . number_format(($row['discounted_price'] * $row['qty']), 2) . '</td>
            <td>ر.ق. ' . number_format($row['cgst_value'] * $row['qty'], 2) . '(' . $row['cgst_percentage'] . '%) </td>
             <td>ر.ق. ' . number_format($row['total'], 2) . '</td>
        </tr>';

        $taxableAmountSer += ($row['discounted_price'] * $row['qty']);
        $cgstSer += $row['cgst_value'] * $row['qty'];
        $totalCostSer += $row['total'];

        $i++;
    }
}

$html .= '</tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7" class="text-center">
                                Total
                            </th>
                            <th>ر.ق. ' . number_format($taxableAmountSer, 2) . '</th>
                            <th>ر.ق. ' . number_format($cgstSer, 2) . '</th>
                            
                            <th>ر.ق. ' . number_format($totalCostSer, 2) . '</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

       <h3 class="h5">Tax Summary / ملخص الضريبة</h3>
<div class="d-flex flex-row justify-content-between mt-4 align-items-start flex-wrap gap-3">
    <div class="col-xs-7 col-7">
        <div class="table-responsive">
            <table class="table border">
                <thead>
                    <tr>
                        <th>Particulars / التفاصيل</th>
                        <th>Taxable Amount / المبلغ الخاضع للضريبة</th>
                        <th>Tax Amount / مبلغ الضريبة</th>
                    </tr>
                </thead>

                        <tbody>';
$tax = 0;
if (!empty($gst_summary)) {
    foreach ($gst_summary as $key => $value) {
        $tax += $value['tax'];

        $html .= '<tr>
            <td><a href="">' . $value['title'] . '</a></td>
            <td>ر.ق. ' . number_format($value['totalAmount'], 2) . '</td>
            <td>ر.ق. ' . number_format($value['tax'], 2) . '</td>
        </tr>';
    }
}

$html .= '</tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-right">Total</th>
                                <th class="text-right">ر.ق. ' . number_format($tax, 2) . '</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-xs-4 col-4">
                <div class="table-responsive">
                    <table class="table border">
                   <tbody>
    <tr>
        <th>Total Taxable Amount / إجمالي المبلغ الخاضع للضريبة:</th>
        <td>ر.ق. <?php echo number_format($totalTaxableAmount, 2); ?></td>
    </tr>
    <tr>
        <th>Total Tax Amount / إجمالي مبلغ الضريبة:</th>
        <td>ر.ق. <?php echo number_format($totalTax, 2); ?></td>
    </tr>
    <tr>
        <th>Discount / الخصم:</th>
        <td>ر.ق. <?php echo number_format($totalDiscount, 2); ?></td>
    </tr>
    <tr>
        <th>Total Payable / إجمالي المستحق:</th>
        <td>ر.ق. <?php echo number_format($totalTaxableAmount + $totalTax, 2); ?></td>
    </tr>
</tbody>

                    </table>
                </div>
            </div>
        </div>';

$text = "";
$totalPayable = number_format($totalTaxableAmount + $totalTax, 0, ".", "");
// $intVal = intval($totalPayable);
$text .= ucfirst(numberToWords($totalPayable));

// if($totalPayable > $intVal)
// {
//     $fraction = intVal(($totalPayable - $intVal) * 100);
//     // echo $fraction;
//     $text .= " and " . numberToWords($fraction) . " paisa only.";
// }
// else
// {
$text .= " only.";
// }
$html .= '<div class="row">
            <div class="col-12" style="font-weight: bold;">
                In Dirhams / بالدرهم: ' . $text . '</div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-12">
                <p class="lead">Payment Methods / طرق الدفع:</p>
                <img src="' . $visa . '" alt="Visa">
                <img src="' . $mastercard . '" alt="Mastercard">
                <img src="' . $americanExpress . '" alt="American Express">
                <img src="' . $paypal . '" alt="Paypal"><br>
                <img src="' . $garrage_qr . '" class="img-radius" alt="" style="width: 220px; border-radius:15px;">
                
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"></p>
            </div>
        </div>

        <strong>Note / ملاحظة:</strong><br> Please Note That Grand Total Is GST Included Payable Amount, Terms And Conditions Apply. / يرجى ملاحظة أن الإجمالي يشمل ضريبة السلع والخدمات، وتطبق الشروط والأحكام.

        <div class="row" style="text-align: right; padding-right: 50px; margin-bottom: 100px;"> 
            For / نيابة عن ' . $garrage['g_name'] . '
        </div>

        <div style="clear: both;">
            <span style="float:left; padding-left: 50px;">
                Receiver Signature / توقيع المستلم -
            </span>
            <span style="float:right; padding-right: 50px;">
                Authorised Signatory / التوقيع المفوض
            </span>
        </div>
    </div>
</body>
</html>';
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html, 'UTF-8');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A2', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('invoice.pdf');