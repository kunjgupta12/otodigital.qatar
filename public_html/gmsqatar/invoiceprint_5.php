<?php require("connection.php"); ?>
<?php require "number-to-text.php"; ?>
<?php  
    $partDiscount = 0;
    $serviceDiscount = 0;
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
<div class="wrapper" id="mainContainer">
    <!-- Main content -->
    <?php
        $id=$_GET['id'];
        $Query="SELECT jc.*, av.*, cu.*, jc.created_at as job_date_time FROM jobcard jc
        JOIN all_vehicle av ON jc.v_id = av.v_id
        JOIN customer cu ON av.c_id = cu.c_id
        WHERE jc.id='$id'";
        $res=mysqli_query($conn,$Query);
        if(mysqli_num_rows($res)>0) {
            while($row=mysqli_fetch_assoc($res))
            { 
                $partDiscount = $row['part_discount'];
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
                      <small class="float-right">Date: <?php echo date("Y-m-d H:i:s", strtotime($row['job_date_time']."+330 minute")); ?></small>
                    </h4>
                  </div>
                </div>
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    <address>
                      <strong>Address:</strong><br>
                      <?php echo $_SESSION['g_address']; ?><br>
                      Phone:<?php echo $_SESSION['g_mob']; ?><br>
                      Email: <?php echo $_SESSION['g_email']; ?><br>
                      GST: <strong><?php echo $_SESSION['g_gst']; ?></strong>
                    </address>
                  </div>
                  <div class="col-sm-4 invoice-col">
                    Bill To
                    <address>
                     
                    <strong>Name: </strong>  <?php echo $row['name']; ?><br>
                    <strong>Address:</strong>     <?php echo $row['c_add']; ?><br>
                    <strong> Contact:</strong>   <?php echo $row['contact']; ?><br>
                    <strong> Email:</strong>   <?php echo $row['cus_email']; ?><br>
                    <!--<strong> GST:</strong> <?php echo $row['c_gst']; ?>-->
                    </address>
                  </div>
                  <div class="col-sm-4 invoice-col">
                    <b>Tax Invoice #<?php echo $row['invoice_no']; ?></b><br>
                    <strong>Registration No:</strong>   <?php echo $row['registration']; ?><br>
                    <strong>Odometer Reading:</strong>   <?php echo $row['odometer']; ?><br>
                    <strong>Car Brand:</strong>   <?php echo $row['carbrand']; ?><br>
                    <strong>Car Model:</strong>   <?php echo $row['carmodel']; ?><br>
                     <strong>Chassis No:</strong>   <?php echo $row['chassis_no']; ?><br> 
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
                                    <th>#</th>
                                    <th>Parts</th>
                                    <th>Part Number</th>
                                    <th>HSN Code</th>
                                    <th>MRP</th>
                                    <th>Discounted Price</th>
                                    <th>Base Price</th>
                                    <th>QTY</th>
                                    <th>UOM</th>
                                    <th>Taxable Amount</th>
                                    <th>CGST% </th>
                                    <th> SGST%</th>
                                    <th>Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $itemId = $row['uid'];
                                    
                                    $taxableAmount = 0;
                                    $cgst = 0;
                                    $sgst = 0;
                                    $totalCost = 0;

                                    $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '1' AND g_id = '".$_SESSION['id']."'";
                                    $res = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($res) > 0) 
                                    {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($res)) 
                                        {
                                            $base_price = $row['discounted_price'] - $row['cgst_value'] - $row['sgst_value'];
                                            $totalTaxableAmount += ($base_price * $row['qty']);
                                            $totalTax += ($row['cgst_value'] + $row['sgst_value']) * $row['qty'];
                                            $totalDiscount += ($row['price'] - $row['discounted_price']) * $row['qty'];
                                            
                                            if($row['cgst_percentage'] > 0)
                                            {
                                                $gstKey = 'cgst_parts_'.$row['cgst_percentage'];

                                                if(isset($gst_summary[$gstKey]))
                                                {
                                                    $gst_summary[$gstKey]["totalAmount"] += $base_price * $row['qty'];
                                                    $gst_summary[$gstKey]["tax"] += $row['cgst_value'] * $row['qty'];
                                                }
                                                else
                                                {
                                                    $pgst = array(
                                                        "title" => "CGST @".$row['cgst_percentage']."% (Parts)",
                                                        "totalAmount" => $base_price * $row['qty'],
                                                        "tax" => $row['cgst_value'] * $row['qty']
                                                    );

                                                    $gst_summary[$gstKey] = $pgst;
                                                }
                                            }

                                            if($row['sgst_percentage'] > 0)
                                            {
                                                $gstKey = 'sgst_parts_'.$row['sgst_percentage'];

                                                if(isset($gst_summary[$gstKey]))
                                                {
                                                    $gst_summary[$gstKey]["totalAmount"] += $base_price * $row['qty'];
                                                    $gst_summary[$gstKey]["tax"] += $row['sgst_value'] * $row['qty'];
                                                }
                                                else
                                                {
                                                    $pgst = array(
                                                        "title" => "SGST @".$row['sgst_percentage']."% (Parts)",
                                                        "totalAmount" => $base_price * $row['qty'],
                                                        "tax" => $row['sgst_value'] * $row['qty']
                                                    );

                                                    $gst_summary[$gstKey] = $pgst;
                                                }
                                            }
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['service']; ?></td>
                                    <td><?= $row['part_number']; ?></td>
                                    <td><?= $row['hsn_code']; ?></td>
                                    <td>₹ <?= number_format($row['price'], 2); ?></td>
                                    <td>
                                        ₹ <?= number_format($row['discounted_price'], 2); ?>
                                        (<?= $partDiscount; ?>%)
                                    </td>
                                    <td>₹ <?= number_format($base_price, 2); ?></td>
                                    
                                    <td><?= $row['qty']; ?></td>
                                    <td>PCS</td>
                                    <td>₹ <?= number_format(($base_price * $row['qty']), 2); ?></td>
                                    <td> 
                                        ₹ <?= number_format($row['cgst_value'] * $row['qty'], 2); ?>
                                        (<?= $row['cgst_percentage']; ?>%) 
                                    </td>
                                    <td> 
                                        ₹ <?= number_format($row['sgst_value'] * $row['qty'], 2); ?>
                                        (<?= $row['sgst_percentage']; ?>%) 
                                    </td>
                                    <td>₹ <?= number_format($row['total'], 2); ?></td>
                                </tr>
                                <?php
                                    $taxableAmount += ($base_price * $row['qty']);
                                    $cgst += $row['cgst_value'] * $row['qty'];
                                    $sgst += $row['sgst_value'] * $row['qty'];
                                    $totalCost += $row['total'];
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
                                    <th>₹ <?= number_format($taxableAmount, 2); ?></th>
                                    <th>₹ <?= number_format($cgst, 2); ?></th>
                                    <th>₹ <?= number_format($sgst, 2); ?></th>
                                    <th>₹ <?= number_format($totalCost, 2); ?></th>
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
                                    <th>#</th>
                                    <th>Service</th>
                                    <th>HSN Code</th>
                                    <th>Service Cost</th>
                                    <th>Unit Price</th>
                                    <th>QTY</th>
                                    <th>UOM</th>
                                    <th>Taxable Amount</th>
                                    <th>CGST%</th>
                                    <th>SGST%</th>
                                    <th>Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $taxableAmountSer = 0;
                                    $cgstSer = 0;
                                    $sgstSer = 0;
                                    $totalCostSer = 0;

                                    $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2' AND g_id = '".$_SESSION['id']."'";
                                    $res = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($res) > 0) 
                                    {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($res)) 
                                        {
                                            $totalTaxableAmount += ($row['discounted_price'] * $row['qty']);
                                            $totalTax += $row['cgst_value'] + $row['sgst_value'];
                                            $totalDiscount += (($row['price'] - $row['discounted_price']) * $row['qty']);
                                            
                                            if($row['cgst_percentage'] > 0)
                                            {
                                                $gstKey = 'cgst_labor_'.$row['cgst_percentage'];

                                                if(isset($gst_summary[$gstKey]))
                                                {
                                                    $gst_summary[$gstKey]["totalAmount"] += $row['discounted_price'] * $row['qty'];
                                                    $gst_summary[$gstKey]["tax"] += $row['cgst_value'] * $row['qty'];
                                                }
                                                else
                                                {
                                                    $pgst = array(
                                                        "title" => "CGST @".$row['cgst_percentage']."% (Labor)",
                                                        "totalAmount" => $row['discounted_price'] * $row['qty'],
                                                        "tax" => $row['cgst_value'] * $row['qty']
                                                    );

                                                    $gst_summary[$gstKey] = $pgst;
                                                }
                                            }

                                            if($row['sgst_percentage'] > 0)
                                            {
                                                $gstKey = 'sgst_labor_'.$row['sgst_percentage'];

                                                if(isset($gst_summary[$gstKey]))
                                                {
                                                    $gst_summary[$gstKey]["totalAmount"] += ($row['discounted_price'] * $row['qty']);
                                                    $gst_summary[$gstKey]["tax"] += ($row['sgst_value'] * $row['qty']);
                                                }
                                                else
                                                {
                                                    $pgst = array(
                                                        "title" => "SGST @".$row['sgst_percentage']."% (Labor)",
                                                        "totalAmount" => $row['discounted_price'] * $row['qty'],
                                                        "tax" => ($row['sgst_value'] * $row['qty'])
                                                    );

                                                    $gst_summary[$gstKey] = $pgst;
                                                }
                                            }
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['service']; ?></td>
                                    <td><?= $row['hsn_code']; ?></td>
                                    <td>₹<?= number_format($row['price'], 2); ?></td>
                                    <td>₹ <?= number_format($row['discounted_price'], 2); ?>(<?= $serviceDiscount; ?>%)</td>
                                    <td><?= $row['qty']; ?></td>
                                    <td>PCS</td>
                                    <td>₹ <?= number_format(($row['discounted_price'] * $row['qty']), 2); ?></td>
                                    <td> 
                                        ₹ <?= number_format($row['cgst_value'] * $row['qty'], 2); ?>
                                        (<?= $row['cgst_percentage']; ?>%) 
                                    </td>
                                    <td> 
                                        ₹ <?= number_format($row['sgst_value'] * $row['qty'], 2); ?>
                                        (<?= $row['sgst_percentage']; ?>%) 
                                    </td>
                                    <td>₹ <?= number_format($row['total'], 2); ?></td>
                                </tr>                                
                                <?php
                                    $taxableAmountSer += ($row['discounted_price'] * $row['qty']);
                                    $cgstSer += $row['cgst_value'] * $row['qty'];
                                    $sgstSer += $row['sgst_value'] * $row['qty'];
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
                                    <th>₹ <?= number_format($taxableAmountSer, 2); ?></th>
                                    <th>₹ <?= number_format($cgstSer, 2); ?></th>
                                    <th>₹ <?= number_format($sgstSer, 2); ?></th>
                                    <th>₹ <?= number_format($totalCostSer, 2); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

                <h3 class="h5">Tax Summary </h3>
                <div class=" d-flex flex-row justify-content-between mt-4 align-items-start flex-wrap gap-3">
                    <div class="col-lg-7 col-12">
                        <div class=" table-responsive">
                            <table class="table border">
                                <thead>

                                    <tr>
                                        <th>Particulars</th>
                                        <th class="text-right">Taxable Amount</th>
                                        <th class="text-right">Tax Amount</th>
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
                                                <td class="text-right">₹ <?= number_format($value['totalAmount'], 2); ?></td>
                                                <td class="text-right">₹ <?= number_format($value['tax'], 2); ?></td>
                                            </tr>
                                        <?php endforeach ?>                                        
                                    <?php endif ?>                                        
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-right">Total</th>
                                        <th class="text-right">
                                            ₹ <?= number_format($tax, 2); ?>
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
                                        <th>Total Taxable Amount:</th>
                                        <td class="text-right">
                                            ₹ <?= number_format($totalTaxableAmount, 2); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Tax Amount:</th>
                                        <td class="text-right">
                                            ₹ <?= number_format($totalTax, 2); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Discount:</th>
                                        <td class="text-right">
                                            ₹ <?= number_format($totalDiscount, 2); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Payble:</th>
                                        <td class="text-right">
                                            ₹ <?= number_format($totalTaxableAmount + $totalTax, 2); ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" style="font-weight: bold;">
                        In Rupees : 
                        <?php 
                            $totalPayable = number_format($totalTaxableAmount + $totalTax, 0, '.', '');
                            // $intVal = floor($totalPayable);
                            
                            echo ucfirst(numberToWords($totalPayable)); 

                            // if($totalPayable > $intVal)
                            // {
                            //     $fraction = intVal(($totalPayable - $intVal) * 100);
                            //     // echo $fraction;
                            //     echo " and " . numberToWords($fraction) . " paisa only.";
                            // }
                            // else
                            // {
                                echo " only.";
                            // }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-12">
                        <p class="lead">Payment Methods:</p>
                        <img src="dist/img/credit/visa.png"  alt="Visa">
                        <img src="dist/img/credit/mastercard.png"
                             alt="Mastercard">
                        <img src="dist/img/credit/american-express.png"
                             alt="American Express">
                        <img src="dist/img/credit/paypal2.png"  alt="Paypal"><br>
                        <img src="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['qrcode'];
                                        }; ?>" class="img-radius" alt="" style="width: 220px; border-radius:15px;">

                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">

                        </p>
                    </div>
                </div>
                <strong>Note:</strong><br> Please Note That Grand Total Is GST Included Payable Amount, Terms And Conditions Apply.

                <div style="text-align: right !important; padding-right: 50px; margin-bottom: 100px;"> 
                    For <?= $_SESSION['user']; ?>
                </div>
                <div style="clear: both;">
                    <span style="float:left; padding-left: 50px;">
                        Receiver Signature-
                    </span>
                    <span style="float:right; padding-right: 50px;">
                        Authorised Signatory
                    </span>
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
        pdf.addHTML($("#mainContainer"), 0, -20, { allowTaint: true, useCORS: true, pagesplit: false }, function () {
            pdf.save('Invoice.pdf');
        });
    }

    // downloadPDF();
    
    window.print();
</script> 
</body>
</html>
