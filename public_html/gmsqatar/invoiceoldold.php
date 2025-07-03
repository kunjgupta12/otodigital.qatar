<?php require "adheader.php"; ?>
<?php require "slidebar.php"; ?>
<?php require "number-to-text.php"; ?>

<?php  
    $partDiscount = 0;
    $serviceDiscount = 0;
    $custPhone = "";
?>
<style>
    .table td, .table th
    {
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
  WHERE jc.id='$id' AND cu.g_id = '".$_SESSION['id']."'";
  $res = mysqli_query($conn, $query);
  
  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) { 
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
                    <strong> Contact:</strong>   <?php echo $row['contact']; $custPhone = $row['contact'];  ?><br>
                    <strong> Email:</strong>   <?php echo $row['cus_email']; ?><br>
                    <strong> GST:</strong> <?php echo $row['c_gst']; ?>
                    </address>
                  </div>
                  <div class="col-sm-4 invoice-col">
                    <b>Tax Invoice #<?php echo $row['invoice_no']; ?></b><br>
                    <strong>Registration No:</strong>   <?php echo $row['registration']; ?><br>
                    <strong>Odometer Reading:</strong>   <?php echo $row['odometer']; ?><br>
                    <strong>Car Brand:</strong>   <?php echo $row['carbrand']; ?><br>
                    <strong>Car Model:</strong>   <?php echo $row['carmodel']; ?><br>
                     <strong>Chassis No:</strong>   <?php echo $row['chassis_no']; ?><br> 
                     <strong>Engine No:</strong>   <?php echo $row['engine_no']; ?><br> 
                     <strong>Job Card No:</strong>   <?php echo $row['job_card_no']; ?><br> 
                     <strong>Job Card Type:</strong>   <?php echo $row['job_card_type']; ?><br> 
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
                                    <th>Part Hsn Code</th>
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
                                              
                                            
                                            
                                            $base_price = $row['partDiscountPrice']*100/(100+($row['partcgst'] + $row['partcgst']));
                                            
                                           $cgst1=($base_price*$row['partcgst']/100)* $row['partqty'];
                                           $sgst1=($base_price*$row['partsgst']/100)* $row['partqty'];
                                             
                                            $totalTaxableAmount += ($base_price * $row['partqty']);

                                            $totalTax += ($row['partcgst'] + $row['partcgst']) * $row['partqty'];

                                            $totalDiscount += ($row['price'] - $row['discounted_price']) * $row['partqty'];
                                            
                                            if($row['partcgst'] > 0)
                                            {
                                                $gstKey = 'partcgst'.$row['partcgst'];

                                                if(isset($gst_summary[$gstKey]))
                                                {
                                                    $gst_summary[$gstKey]["totalAmount"] += $base_price * $row['partqty'];
                                                    $gst_summary[$gstKey]["tax"] += $row['partcgst'] * $row['partqty'];
                                                }
                                                else
                                                {
                                                    $pgst = array(
                                                        "title" => "CGST @".$row['partcgst']."% (Parts)",
                                                        "totalAmount" => $base_price * $row['partqty'],
                                                        "tax" => $row['partcgst'] * $row['partqty']
                                                    );

                                                    $gst_summary[$gstKey] = $pgst;
                                                }
                                            }

                                            if($row['partsgst'] > 0)
                                            {
                                                $gstKey = 'partsgst'.$row['partsgst'];

                                                if(isset($gst_summary[$gstKey]))
                                                {
                                                    $gst_summary[$gstKey]["totalAmount"] += $base_price * $row['partqty'];
                                                    $gst_summary[$gstKey]["tax"] += $row['partsgst'] * $row['partqty'];
                                                }
                                                else
                                                {
                                                    $pgst = array(
                                                        "title" => "SGST @".$row['partsgst']."% (Parts)",
                                                        "totalAmount" => $base_price * $row['partqty'],
                                                        "tax" => $row['partsgst'] * $row['partqty']
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
                                    <td>₹ <?= number_format($row['partPrice'], 2); ?></td>
                                    <td>
                                        ₹ <?= number_format($row['partDiscountPrice'], 2); ?>
                                        (<?= $partDiscount; ?>%)
                                    </td>
                                    <td>₹ <?= number_format($base_price, 2); ?></td>
                                    
                                    <td><?= $row['partqty']; ?></td>
                                    <td>PCS</td>
                                    <td>₹ <?= number_format(($base_price * $row['partqty']), 2); ?></td>
                                    <td> 
                                        ₹ <?= number_format($cgst1, 2); ?>
                                        (<?= $row['partcgst']; ?>%) 
                                    </td>
                                    <td> 
                                        ₹ <?= number_format( $sgst1, 2); ?>
                                        (<?= $row['partsgst']; ?>%) 
                                    </td>
                                    <td>₹ <?= number_format($row['partDiscountPrice']*$row['partqty'], 2); ?></td>
                                </tr>
                                <?php
                                    $taxableAmount += ($base_price * $row['partqty']);
                                    $cgst += ($base_price*$row['partcgst']/100)*$row['partqty'];

                                    $sgst += ($base_price*$row['partsgst']/100)* $row['partqty'];
                                    $totalCost = $taxableAmount+$cgst +$sgst;
                               
                                    
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
                                    <th>Package</th>
                                    <th>Package Price</th>
                                    <th>Discounted Price</th>
                                    <th>Package Hsn_Code</th>
                                    <th>Package Qty</th>
                                    <th>UOM</th>
                                    <th>Taxable Amount</th>
                                    <th>Package CGST(%)</th>
                                    <th>Package SGST(%)</th>
                                    
                                    <th>Total Payable</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $taxableAmountSer1 = 0;
                                    $cgstSer1 = 0;
                                    $sgstSer1 = 0;
                                    $totalCostSer1 = 0;
                                  
                                    $query = "SELECT 
        j.*, 
        s.package AS service_package_name, 
        s.packageprice AS service_package_price
    FROM 
        jobcode_service_items j
    LEFT JOIN 
        servicepackage s ON j.package = s.id
    WHERE 
        j.uid = '$itemId' AND j.p_s = '3' AND j.g_id = '".$_SESSION['id']."'
";
                                    $res = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($res) > 0) 
                                    {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($res)) 
                                        {   

                                          //$discountprice=$row['discountprice']-($row['discountprice']*$row['discountper']/100);

                                          $base_price = $row['discountprice']*100/(100+($row['pcgst'] + $row['psgst']));
                                            
                                          $cgst2=($base_price*$row['pcgst']/100)* $row['pqty'];
                                          $sgst2=($base_price*$row['psgst']/100)* $row['pqty'];
                                            
                                 

                                            $totalTaxableAmount += ($row['discountprice'] * $row['pqty']);
                                            $totalTax += ($row['pcgst'] + $row['psgst']) * $row['pqty'];
                                            $totalDiscount += (($row['service_package_price'] - $row['discountprice']) * $row['pqty']);
                                            
                                            if($row['pcgst'] > 0)
                                            {
                                                $gstKey = 'cgst_labor_'.$row['pcgst'];

                                                if(isset($gst_summary[$gstKey]))
                                                {
                                                    $gst_summary[$gstKey]["totalAmount"] += $row['discountprice'] * $row['pqty'];
                                                    $gst_summary[$gstKey]["tax"] += $row['pcgst'] * $row['pqty'];
                                                }
                                                else
                                                {
                                                    $pgst = array(
                                                        "title" => "CGST @".$row['pcgst']."% (Labor)",
                                                        "totalAmount" => $row['discountprice'] * $row['qty'],
                                                        "tax" => $row['pcgst'] * $row['pqty']
                                                    );

                                                    $gst_summary[$gstKey] = $pgst;
                                                }
                                            }

                                            if($row['psgst'] > 0)
                                            {
                                                $gstKey = 'sgst_labor_'.$row['psgst'];

                                                if(isset($gst_summary[$gstKey]))
                                                {
                                                    $gst_summary[$gstKey]["totalAmount"] += ($row['discountprice'] * $row['pqty']);
                                                    $gst_summary[$gstKey]["tax"] += ($row['psgst'] * $row['pqty']);
                                                }
                                                else
                                                {
                                                    $pgst = array(
                                                        "title" => "SGST @".$row['pcgst']."% (Labor)",
                                                        "totalAmount" => $row['discountprice'] * $row['pqty'],
                                                        "tax" => ($row['psgst'] * $row['pqty'])
                                                    );

                                                    $gst_summary[$gstKey] = $pgst;
                                                }
                                            }
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['service_package_name']; ?></td>
                                    <td><?= $row['service_package_price']; ?></td>
                                    <td> ₹ <?= number_format($row['discountprice'],2) ?>(<?= $partDiscount; ?>%)</td>  
                                    <td><?= $row['hsncode']; ?></td>  
                                    <td><?= $row['pqty']; ?></td>  
                                    <td>PCS</td>
                                    <td>₹ <?= number_format(($base_price), 2); ?></td>
                                    <td>₹ <?= number_format(($cgst2), 2); ?> (<?= $row['pcgst']; ?>%) </td>  
                                    <td>₹ <?= number_format(($sgst2), 2); ?> (<?= $row['psgst']; ?>%) </td>
                                    
                                    <td>₹ <?= number_format($row['discountprice']*$row['pqty'], 2); ?></td>                          
                                </tr>                                
                                <?php
                                 $taxableAmountSer1 += ($base_price * $row['pqty']);
                                 $cgstSer1 += ($base_price*$row['pcgst']/100)*$row['pqty'];
                                 $sgstSer1 += ($base_price*$row['psgst']/100)*$row['pqty'];
                                // $totalCostSer = $row['totalcost'];

                                 $totalCostSer1 = $taxableAmountSer1+$cgstSer1 +$sgstSer1;
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
                                    <th>₹ <?= number_format($taxableAmountSer1, 2); ?></th>
                                    
                                    <th>₹ <?= number_format($cgstSer1, 2); ?></th>
                                    <th>₹ <?= number_format($sgstSer1, 2); ?></th>
                                    
                                    <th>₹ <?= number_format($totalCostSer1, 2); ?></th>
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
                                            $totalTax += ($row['cgst_value'] + $row['sgst_value']) * $row['qty'];
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

                <div class="row no-print">
                  <div class="col-12">
                    <a href="invoiceprint.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-default d-none d-sm-block" style="width: 250px">
                        <i class="fas fa-print"></i> Print
                    </a>
                     <a href="generate-pdf.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-default d-none d-sm-block" style="width: 250px">
                        <i class="fas fa-download"></i> Download
                    </a>

                    <?php
                        // $url = "https://web.cloudwhatsapp.com/wapp/api/send?apikey=09384fbed93a4a2785a69d85f92b81db&mobile=".$custPhone."&msg=https://merigarage.com/GarageAdmin/invoiceprint.php?id=".$_GET['id'];
                    ?>

                    <!--<a href="<?= $url; ?>" target="_blank" class="btn btn-default">-->
                    <!--    <i class="fas fa-share"></i> Send-->
                    <!--</a>-->
                    <button type="button" onclick="copyText()" class="btn btn-default" style="width: 250px">Copy</button>
                    
                    <!--<a href="https://merigarage.com/GarageAdmin/generate-pdf.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-default d-block d-sm-none"> <i class="fas fa-print"></i> Print </a>-->
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
  <strong>Copyright &copy; 2014-2021 <a href="https://merigarage.com">Garage Software Pvt Ltd</a>.</strong> All rights reserved.
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
        pdf.addHTML($("#mainContainer"), 0, -20, { allowTaint: true, useCORS: true, pagesplit: false }, function () {
            pdf.save('Invoice.pdf');
        });
    }
    
    function copyText()
    {
        // Copy the text inside the text field
        navigator.clipboard.writeText("https://merigarage.com/GarageAdmin/generate-pdf.php?id=<?= $_GET['id'] ?>");
        
        // Alert the copied text
        alert("Copied the text");
    }
</script> 
</body>

</html>