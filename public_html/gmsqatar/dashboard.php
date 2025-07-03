<?php require "adheader.php"; ?>
<?php require "slidebar.php"; ?>
<?php require("connection.php"); ?>

<style>
  * {
    box-sizing: border-box;
  }

  #myInput {
    background-image: url('/css/searchicon.png');
    background-position: 10px 10px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
  }

  #myTable {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ddd;
    font-size: 18px;
  }

  #myTable th, #myTable td {
    text-align: left;
    padding: 12px;
  }

  #myTable tr {
    border-bottom: 1px solid #ddd;
  }

  #myTable tr.header, #myTable tr:hover {
    background-color: #f1f1f1;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard / لوحة التحكم</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home / الرئيسية</a></li>
            <li class="breadcrumb-item active">Dashboard / لوحة التحكم</li>
          </ol>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Dashboard Cards -->
      <div class="col-lg-4 col-md-6">
        <a href="dashboard.php">
          <div class="small-box bg-primary">
            <div class="inner d-flex align-items-center justify-content-between">
              <div>
                <h3><?php countProduct($conn); ?></h3>
                <p>Total Customers / إجمالي العملاء</p>
              </div>
              <img class="img-fluid" src="custom-img/order_App.png" style="width:20%; height:20%;">
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="parts_inventory.php">
          <div class="small-box bg-success">
            <div class="inner d-flex align-items-center justify-content-between">
              <div>
                <h3><?php count_all_stock($conn); ?></h3>
                <p>Total Inventory Stocks / إجمالي المخزون</p>
              </div>
              <img class="img-fluid" src="custom-img/new-booking-app.png" style="width:20%; height:20%;">
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="ShowJobCard.php">
          <div class="small-box bg-danger">
            <div class="inner d-flex align-items-center justify-content-between">
              <div>
                <h3><?php countjobcard($conn); ?></h3>
                <p>Total Running JobCards / بطاقات العمل الجارية</p>
              </div>
              <img class="img-fluid" src="custom-img/total-running-jobcard.png" style="width:20%; height:20%;">
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="ShowJobCard.php">
          <div class="small-box bg-warning">
            <div class="inner d-flex align-items-center justify-content-between">
              <div>
                <h3><?php count_complete_jobcard($conn); ?></h3>
                <p>Completed JobCards / بطاقات العمل المكتملة</p>
              </div>
              <img class="img-fluid" src="custom-img/total-completed-jobcard.png" style="width:20%; height:20%;">
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="dashboard.php">
          <div class="small-box bg-success">
            <div class="inner d-flex align-items-center justify-content-between">
              <div>
                <h3>₹<?php countRevenueToday($conn); ?></h3>
                <p>Today's Revenue / إيرادات اليوم</p>
              </div>
              <img class="img-fluid" src="custom-img/revenew.png" style="width:33%; height:33%;">
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="dashboard.php">
          <div class="small-box bg-primary">
            <div class="inner d-flex align-items-center justify-content-between">
              <div>
                <h3>₹<?php countrevenewall($conn); ?></h3>
                <p>Total Revenue / إجمالي الإيرادات</p>
              </div>
              <img class="img-fluid" src="custom-img/revenew.png" style="width:33%; height:33%;">
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="dashboard.php">
          <div class="small-box bg-danger">
            <div class="inner d-flex align-items-center justify-content-between">
              <div>
                <h3>₹<?php totaldueamount($conn); ?></h3>
                <p>Total Due Amount / إجمالي المبلغ المستحق</p>
              </div>
              <img class="img-fluid" src="custom-img/revenew.png" style="width:33%; height:33%;">
            </div>
          </div>
        </a>
      </div>

      <!-- Month Filter Card -->
      <div class="col-lg-6 col-md-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h4>Select Month Range</h4>
            <form method="get" class="d-flex flex-column flex-md-row align-items-start gap-2">
              <div style="margin-right: 10px;">
                <label>From</label>
                <input type="month" name="start" class="form-control" value="<?= $_GET['start'] ?? date('Y-m') ?>" required>
              </div>
              <div style="margin-right: 10px;">
                <label>To</label>
                <input type="month" name="end" class="form-control" value="<?= $_GET['end'] ?? date('Y-m') ?>" required>
              </div>
              <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-light">Filter</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Download Report -->
      <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-end">
        <a href="generate_revenue_report.php" class="btn btn-danger" target="_blank">
          <i class="fas fa-file-pdf"></i> Download Report / تنزيل تقرير الإيرادات الكامل
        </a>
      </div>

      <?php
        $startMonth = $_GET['start'] ?? date('Y-m');
        $endMonth = $_GET['end'] ?? date('Y-m');

        $sql = "SELECT 
                  LEFT(created_at, 7) as month, 
                  SUM(amount) as total 
                FROM payment_history 
                WHERE LEFT(created_at, 7) BETWEEN ? AND ? 
                GROUP BY month 
                ORDER BY month";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $startMonth, $endMonth);
        $stmt->execute();
        $result = $stmt->get_result();

        $months = [];
        $totals = [];

        while ($row = $result->fetch_assoc()) {
            $timestamp = strtotime($row['month'] . "-01");
            $months[] = date("F Y", $timestamp);
            $totals[] = $row['total'];
        }
      ?>
    </div>
  </section>

  <!-- Chart Section -->
  <section class="content">
    <div class="container-fluid">
      <canvas id="paymentChart" width="100%" height="40"></canvas>
    </div>
  </section>
</div>

<footer class="main-footer">
  <strong>&copy; 2025 <a href="http://otodigital.in/">OTODIGITAL TECHNOLOGIES PVT LTD.</a></strong> All rights reserved. / جميع الحقوق محفوظة.
</footer>

<aside class="control-sidebar control-sidebar-dark"></aside>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('paymentChart').getContext('2d');
  const chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($months) ?>,
      datasets: [{
        label: 'Total Payment Amount (₹)',
        data: <?= json_encode($totals) ?>,
        backgroundColor: 'rgba(75, 192, 192, 0.6)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'top' },
        title: { display: true, text: 'Monthly Payment History' }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return '₹' + value.toLocaleString();
            }
          }
        }
      }
    }
  });
</script>
</body>
</html>
