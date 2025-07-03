
<?php include("header2.php"); ?>
<?php include("connection.php"); ?>
<nav class="wsmenu clearfix">
<ul class="wsmenu-list">
  <li class="nl-simple"><a href="index.php">Home / الرئيسية</a></li>
  <li class="nl-simple"><a class="active" href="services.php">Services / الخدمات</a></li>
  <li class="nl-simple"><a href="pricing.php">Plans / الخطط</a></li>
  <li class="nl-simple"><a href="about.php">About / حول</a></li>
  <li class="nl-simple"><a href="webinar.php">Webinar / ندوة</a></li>
  <li class="nl-simple"><a href="career.php">Career / الوظائف</a></li>
  <li class="nl-simple"><a class="active2" href="parts.php">Parts / الأجزاء</a></li>
  <li class="nl-simple"><a href="contact.php">Contact Us / اتصل بنا</a></li>
</ul>
</nav>
</div>
</div>	
</header>

<section id="team-page" class="page-hero-section bg-lightgrey tra-lines division">
  <div class="container">	
    <div class="row">	
      <div class="col-md-10 col-lg-8 offset-md-1 offset-lg-2">
        <div class="hero-txt text-center">
          <h3 class="h3-md"><span class="own-text-1">Jobcard / بطاقة العمل</span> 
          <span class="own-text-2">Approval / الموافقة</span></h3>
        </div>
      </div>	
    </div>
  </div> 
</section>

<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
}
h1 { text-align: center; color: #333; }
table {
  width: 80%;
  margin: 20px auto;
  border-collapse: collapse;
  background-color: white;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
th, td {
  padding: 5px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
th {
  background-color: #0247FE;
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
  flex-wrap: wrap;
  justify-content: space-between;
  margin-top: 10px;
}
.customer-info div {
  width: 100%;
}
.customer-info strong {
  margin-right: 10px;
}
button {
  display: block;
  margin: 20px auto;
  padding: 10px 20px;
  background-color: #0247FE;
  color: white;
  border: none;
  cursor: pointer;
}
@media screen and (max-width: 768px) {
  .customer-info-box, .info-box { width: 100%; }
  .customer-info div { width: 100%; }
}
</style>

<body>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT jc.*, av.*, cu.* FROM jobcard jc
            JOIN all_vehicle av ON jc.v_id = av.v_id
            JOIN customer cu ON av.c_id = cu.c_id
            WHERE jc.id='$id'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $address = $row['c_add'];
    $contact = $row['contact'];
    $email = $row['cus_email'];
    $gst = $row['c_gst'];
    $g_id = $row['g_id'];
  }

  $query = "SELECT * FROM call_login WHERE g_id = $g_id";
  $result = mysqli_query($conn, $query);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $g_name = $row['g_name'];
    $g_mob = $row['g_mob'];
    $g_email = $row['g_email'];
    $g_gst = $row['g_gst'];
    $g_img = $row['img'];
    $g_address = $row['g_address'];
  }

  $query = "SELECT jcsi.* FROM jobcode_service_items jcsi
            JOIN jobcard jc ON jcsi.uid = jc.uid
            WHERE jc.id = $id";
  $result = mysqli_query($conn, $query);
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12"><h4><img src="<?php echo $g_img; ?>" style="width: 150px;"> <?php echo $g_name; ?></h4></div>
    <div class="col-md-6">
      <strong>Address / العنوان:</strong><br>
      <?php echo $g_address; ?><br>
      Phone / الهاتف: <?php echo $g_mob; ?><br>
      Email / البريد الإلكتروني: <?php echo $g_email; ?><br>
      Tax Number / الرقم الضريبي: <strong><?php echo $g_gst; ?></strong>
    </div>
    <div class="col-md-6">
      <h2 class="text-primary">YOUR INFORMATION / معلوماتك</h2><br>
      <div><strong>Name / الاسم:</strong> <?php echo $name; ?><br>
      <strong>Address / العنوان:</strong> <?php echo $address; ?></div>
      <div><strong>Contact / الاتصال:</strong> <?php echo $contact; ?><br>
      <strong>Email / البريد الإلكتروني:</strong> <?php echo $email; ?></div>
    </div>
    <div class="col-md-12 text-center mt-4">
      <h4 class="text-danger">Please.. uncheck the services you don't want. / الرجاء إلغاء تحديد الخدمات التي لا تريدها.</h4>
    </div>
  </div>
</div>

<form id="jobcardForm" method="post" action="approveFunction.php">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table>
<thead>
  <tr>
    <th>#</th>
    <th>Service/Part Name / اسم الخدمة أو القطعة</th>
    <th>HSN Code / رمز النظام</th>
    <th>MRP / السعر الأقصى</th>
    <th>Discounted Price / السعر بعد الخصم</th>
    <th>QTY / الكمية</th>
    <th>Taxable% / الضريبة%</th>
    <th>Total Cost / التكلفة الكلية</th>
  </tr>
</thead>
<tbody>
<?php
$subTotal = 0;
$grandTotlal = 0;
while ($row = mysqli_fetch_assoc($result)) {
  $isPackage = !empty($row['package']);
  $serviceId = $row['id'];
  $name =  $row['package'] ?? $row['service']??$row['partname'];
  $hsn_code = $isPackage ? $row['hsncode'] : $row['hsn_code']??$row['parthsncode'];
  $price = $row['partPrice']?? $row['packageprice'] ?? $row['price']??$row['partPrice'];
  $qty = $isPackage ? $row['pqty'] : $row['partqty'];
  $discountprice = $isPackage ? $row['discountprice'] : $row['partDiscountPrice'];
  $gst = $isPackage ? ($row['pcgst'] + $row['psgst']) : ($row['partcgst'] + $row['partsgst']);
  $total = $isPackage ? $row['totalpay'] : $row['parttotalpay'];
  $subTotal += $price * $qty;
  $grandTotlal += $discountprice * $qty;
  echo "<tr>";
  echo "<td><input type='checkbox' name='services[]' value='$serviceId' checked></td>";
  echo "<td>$name</td>";
  echo "<td>$hsn_code</td>";
  echo "<td class='price'>₹" . number_format($price, 2) . "</td>";
  echo "<td class='discountprice'>" . number_format($discountprice, 2) . "</td>";
  echo "<td class='qty'>$qty</td>";
  echo "<td>$gst%</td>";
  echo "<td class='total'>₹" . number_format($total, 2) . "</td>";
  echo "</tr>";
}
?>
</tbody>
</table>

<table>
  <tr>
    <th>Sub Total (MRP) / المجموع الفرعي:</th>
    <td id="subTotal">₹ <?php echo $subTotal; ?></td>
  </tr>
  <tr>
    <th>Grand Total (Total Cost) / الإجمالي الكلي:</th>
    <td id="grandTotal">₹ <?php echo $grandTotlal; ?>.00</td>
  </tr>
</table>

<table>
<tr>
  <th style="background-color: white; color: black;">Please.. Approve Your Jobcard / الرجاء الموافقة على بطاقة العمل:</th>
  <td style="text-align: right;">
    <button type="submit" name="approvalButton" id="approvalButton">Approve / موافقة</button>
  </td>
</tr>
</table>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
  function updateTotals() {
    var checkboxes = document.querySelectorAll('input[name="services[]"]');
    var subTotal = 0;
    var grandTotal = 0;
    checkboxes.forEach(function (checkbox) {
      var row = checkbox.closest('tr');
      if (!row) return;
      var total = parseFloat(row.querySelector('.total').innerText.replace(/[₹,]/g, '').trim());
      var price = parseFloat(row.querySelector('.discountprice').innerText.replace(/[₹,]/g, '').trim());
      var qty = parseFloat(row.querySelector('.qty').innerText.replace(/[₹,]/g, '').trim());
      if (checkbox.checked) {
        if (!isNaN(price) && !isNaN(qty)) subTotal += price * qty;
        if (!isNaN(total)) grandTotal += total;
      }
    });
    document.getElementById('subTotal').innerText = '₹ ' + subTotal.toFixed(2);
    document.getElementById('grandTotal').innerText = '₹ ' + grandTotal.toFixed(2);
  }

  var checkboxes = document.querySelectorAll('input[name="services[]"]');
  checkboxes.forEach(cb => cb.addEventListener('change', updateTotals));
});
</script>

<?php include("footer2.php"); ?>
</body>
</html>
