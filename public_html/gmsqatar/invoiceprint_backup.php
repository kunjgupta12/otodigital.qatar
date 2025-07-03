<?php require("connection.php"); ?>

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
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <?php
    $id=$_GET['id'];
    $Query="SELECT jc.*, av.*, cu.*, jc.created_at as job_date_time FROM jobcard jc
    JOIN all_vehicle av ON jc.v_id = av.v_id
    JOIN customer cu ON av.c_id = cu.c_id
    WHERE jc.id='$id'";
    $res=mysqli_query($conn,$Query);
    if(mysqli_num_rows($res)>0) {
        while($row=mysqli_fetch_assoc($res)){ ?>

<section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <img src="<?php
              if (isset($_SESSION['user'])) {

                echo $_SESSION['img'];
              }; ?>" alt="" style="width: 200px;"> <?php echo $_SESSION['user'];?>
          <small class="float-right">Date: <?php echo date("Y-m-d H:i:s", strtotime($row['job_date_time']."+330 minute")); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
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
      <!-- /.col -->
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
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
                    <b>Tax Invoice #<?php echo $row['invoice_no']; ?></b><br>
                    <strong>Registration No:</strong>   <?php echo $row['registration']; ?><br>
                    <strong>Car Brand:</strong>   <?php echo $row['carbrand']; ?><br>
                    <strong>Car Model:</strong>   <?php echo $row['carmodel']; ?><br>
                     <strong>Chassis No:</strong>   <?php echo $row['chassis_no']; ?><br> 
                    <br>
                  </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

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
                          <th>HSN Code</th>
                          <th>MRP (GST inc)</th>
                          <th>QTY</th>
                          <th>Total Cost</th>
                          <!--<th>GST%</th>-->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $itemId = $row['uid'];
                        $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '1'";
                        $res = mysqli_query($conn, $query);
                        if (mysqli_num_rows($res) > 0) {
                          $i=1;
                          while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['service']; ?></td>
                              <td><?php echo $row['hsn_code']; ?></td>
                              <td>₹<?php echo $row['price']; ?>.00</td>
                              <td><?php echo $row['qty']; ?></td>
                              <td>₹<?php echo $row['total']; ?>.00</td>
                              <!--<td><?php echo $row['gst']; ?>%</td>-->
                            </tr>
                        <?php $i++; }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div><br>

                <!-- parts items -->

                <!-- <div class="card-header">
                  <h3 class="card-title"><b>SERVICES/OTHERS COST</b></h3>
                </div> -->
                
    <!-- Table row -->
    <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Service</th>
                          <th>HSN Code</th>
                          <th>Service Cost</th>
                          <th>GST%</th>
                          <th>Total Cost (GST inc)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // $itemId = $row['uid'];
                        $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId' AND p_s = '2'";
                        $res = mysqli_query($conn, $query);
                        if (mysqli_num_rows($res) > 0) {
                          $i=1;
                          while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['service']; ?></td>
                              <td><?php echo $row['hsn_code']; ?></td>
                              <td>₹<?php echo $row['price']; ?>.00</td>
                              <td><?php echo $row['gst']; ?>%</td>
                              <td>₹<?php echo $row['total']; ?>.00</td>
                            </tr>
                        <?php $i++; }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods:</p>
        <img src="dist/img/credit/visa.png" alt="Visa">
        <img src="dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="dist/img/credit/american-express.png" alt="American Express">
        <img src="dist/img/credit/paypal2.png" alt="Paypal"><br>
                    <img src="<?php
                                        if (isset($_SESSION['user'])) {

                                            echo $_SESSION['qrcode'];
                                        }; ?>" class="img-radius" alt="" style="width: 220px; border-radius:15px;">

        
      </div>
      <!-- /.col -->
      <div class="col-6">
                    <div class="table-responsive">
                       <table class="table">
                        <tr>
                          <th>Sub Total (Parts + Service Cost):</th>
                          <?php ?>
                          <td>₹
                            <?php
                            // get user uid
                            $user_id = $_GET['id'];

                            // Check if user exists
                            $ischeck = "SELECT uid FROM `jobcard` WHERE id = $user_id";
                            $ischeck_query = mysqli_query($conn, $ischeck);
                            $get_uid = mysqli_fetch_array($ischeck_query);

                            // Get user uid
                            $service_item_id = (int)$get_uid[0];

                            // Query to get sum of total where p_s = '1'
                            $query_item_total = "SELECT sum(total) FROM jobcode_service_items WHERE uid = $service_item_id AND p_s = '1'";
                            $run_item_total = mysqli_query($conn, $query_item_total);
                            $data_item_total = mysqli_fetch_array($run_item_total);

                            // Query to get sum of price
                            $query_item_price = "SELECT sum(price) FROM jobcode_service_items WHERE uid = $service_item_id AND p_s = '2'";
                            $run_item_price = mysqli_query($conn, $query_item_price);
                            $data_item_price = mysqli_fetch_array($run_item_price);

                            // Calculate the sum of both values
                            $total_sum = $data_item_total[0] + $data_item_price[0];

                            // Echo the result
                            echo $total_sum;
                         
                            ?>.00
                          </td>
                        </tr>
                       <tr>
                          <th>GST Value (On Service):</th>
                          <?php ?>
                          <td>₹
                            <?php
                            $job_id = $_SESSION['uid'];
                            $query_gst = "SELECT gst, qty, price, sum(price * gst / 100 * qty) AS calculated_value FROM jobcode_service_items WHERE uid = $service_item_id AND p_s IN ('1', '2')";
                            $run_gst = mysqli_query($conn, $query_gst);
                            if ($run_gst) {
                              while ($gst_item = mysqli_fetch_assoc($run_gst)) {
                                echo round($gst_item['calculated_value']);
                              }
                            } else {
                              echo "Error in query: " . mysqli_error($conn);
                            }
                          ?>.00
                            
                          </td>
                        </tr>
                        <tr>
                          <th>Grand Total (Total Cost):</th>
                          <?php ?>
                          <td>₹
                            <?php
                            $job_id = $_SESSION['uid'];
                            $query_item = "SELECT sum(total) FROM jobcode_service_items WHERE uid = $service_item_id";
                            $run_item = mysqli_query($conn, $query_item);
                            $data_item2 = mysqli_fetch_array($run_item);
                            echo $data_item2[0];
                            ?>.00
                            
                          </td>
                        </tr>
                        
                      </table>
                    </div>
                  </div>
      <!-- /.col -->
    </div>
    <strong>Note:</strong><br> Please Note That Grand Total Is GST Included Payable Amount, Terms And Conditions Apply.
    <!-- /.row -->
  </section>

     <?php   }
    }
  ?>
 
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
