<?php require "adheader.php"; ?>
<?php require "slidebar.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li><u><b>JOBCARD APPROVEL</b></u></li>
          </ol>
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Jobcard Approvel</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  

  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        input[type="checkbox"] {
            transform: scale(1.5);
        }

        .customer-info-box {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
        }

        .customer-info {
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap to the next line on smaller screens */
            justify-content: space-between;
            margin-top: 10px;
        }

        .customer-info div {
            width: 100%; /* Adjusted width to 100% for responsiveness */
        }

        .customer-info strong {
            margin-right: 10px;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        /* Media Queries for responsiveness */
        @media screen and (max-width: 768px) {
            .customer-info-box,
            .info-box {
                width: 100%;
            }

            .customer-info div {
                width: 100%;
            }
        }
    </style>
<?php
  $id = $_GET['id'];
  $query = "SELECT * FROM jobcard WHERE id='$id'";
  $res = mysqli_query($conn, $query);
  
  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) { ?>

<section class="content">
        <div class="customer-info-box text-center">
            <h2 class="text-primary">YOUR INFORMATION</h2><br>
            <div class="customer-info">
                <div>
                    <strong><b>Name:</b></strong> <?php echo $row['name']; ?> <br>
                    <strong><b>Address:</b></strong> <?php echo $row['address']; ?>
                </div>
                <div>
                    <strong><b>Contact:</b></strong> <?php echo $row['contact']; ?> <br>
                    <strong><b>Email:</b></strong> <?php echo $row['email']; ?>
                </div>
                <div>
                    <strong><b>GST:</b></strong> <?php echo $row['c_gst']; ?>
                </div>
            </div><br>
            <h4 class="text-danger">Please.. uncheck the services you don't want.</h4>
        </div>

    <form id="jobcardForm">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service/Part Name:</th>
                    <th>HSN Code:</th>
                    <th>Taxable Amt:</th>
                    <th>GST%</th>
                    <th>MRP:</th>
                </tr>
            </thead>
            <tbody>
                        <?php
                        $itemId = $row['uid'];
                        $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId'";
                        $res = mysqli_query($conn, $query);
                        if (mysqli_num_rows($res) > 0) {
                          $i=1;
                          while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                              <td><input type="checkbox" name="services[]" checked></td>
                              <td><?php echo $row['service']; ?></td>
                              <td><?php echo $row['hsn_code']; ?></td>
                              <td class="total">₹<?php echo $row['total']; ?>.00</td>
                              <td><?php echo $row['gst']; ?>%</td>
                              <td class="price">₹<?php echo $row['price']; ?>.00</td>
                            </tr>
                        <?php $i++; }
                        } ?>
                      </tbody>
        </table>

        <table>
        <tr>
                          <th>Sub Total:</th>
                          <?php ?>
                          <td id="subTotal">₹
                            <?php
                            // get user uid
                            $user_id = $_GET['id'];
                            $ischek = "SELECT uid FROM `jobcard` WHERE id = $user_id";
                            $ischeck_query = mysqli_query($conn, $ischek);
                            $get_uid = mysqli_fetch_array($ischeck_query);
                            //end get user uid
                            $service_item_id= (int)$get_uid[0];
                            // echo  $service_item_id;
                            $query_item = "SELECT sum(total) FROM jobcode_service_items WHERE uid = $service_item_id";
                            $run_item = mysqli_query($conn, $query_item);
                            $data_item1 = mysqli_fetch_array($run_item);
                            echo $data_item1[0];
                         
                            ?>.00
                          </td>
                        </tr>
                        <tr>
                          <th><strong>GST Value:</strong></th>
                          <td id="gstValue">₹<?php $gst= $data_item2[0] - $data_item1[0];?>
                          <strong><?php echo $gst; ?>.00</strong></td>
                        </tr>
                       
                        <tr>
                          <th>Grand Total:</th>
                          <?php ?>
                          <td id="grandTotal">₹
                            <?php
                            $job_id = $_SESSION['uid'];
                            $query_item = "SELECT sum(price) FROM jobcode_service_items WHERE uid = $service_item_id";
                            $run_item = mysqli_query($conn, $query_item);
                            $data_item2 = mysqli_fetch_array($run_item);
                            echo $data_item2[0];
                            ?>.00
                            
                          </td>
                        </tr>
                        
                        
        </table>

        <table>
            <tr>
                <th style="background-color: white; color: black;">Please.. Approve Your Jobcard :</th>
                <td style="text-align: right;">
                    <a class="btn btn-success" href="jobcard_approved.php" title="Approved Your Jobcard">APPROVE</a>
                </td>
            </tr>
        </table>

        <!-- <a href="">
            <button type="submit">Approv</button>
        </a> -->
    </form>


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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Function to update totals
    function updateTotals() {
      var checkboxes = document.querySelectorAll('input[name="services[]"]');
      var subTotal = 0;
      var grandTotal = 0;

      checkboxes.forEach(function (checkbox) {
        var row = checkbox.closest('tr');
        var total = parseFloat(row.querySelector('.total').innerText.replace('₹', ''));
        var price = parseFloat(row.querySelector('.price').innerText.replace('₹', ''));

        if (checkbox.checked) {
          subTotal += total;
          grandTotal += price;
        }
      });

      // Update Sub Total
      document.getElementById('subTotal').innerText = '₹' + subTotal.toFixed(2);

      // Update Grand Total
      document.getElementById('grandTotal').innerText = '₹' + grandTotal.toFixed(2);

      // Update GST Value
      var gstValue = grandTotal - subTotal;
      document.getElementById('gstValue').innerText = '₹' + gstValue.toFixed(2);
    }

    // Attach event listener to checkboxes
    var checkboxes = document.querySelectorAll('input[name="services[]"]');
    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener('change', updateTotals);
    });

    // Initial update when the page loads
    updateTotals();
  });
</script>
<script>
    document.getElementById('approvalButton').addEventListener('click', function() {
        alert('Thank you for your approval! we will work as per your requirement.');
        // You can also perform other actions here if needed
    });
</script>

</body>

</html>