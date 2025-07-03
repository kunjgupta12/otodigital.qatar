<?php
require "adheader.php";
require "slidebar.php";

// Enable error reporting (for development/debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$g_id = $_SESSION['id'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Customer Service Reminder</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
    <div class="row">
      <?php require "infodashboard.php"; ?>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title col-md-10">Send Service > <b>Reminder</b></h3>
              <h3 class="card-title col-md-2">
                <?php
                if (isset($_SESSION['msg4'])) {
                  echo $_SESSION['msg4'];
                  unset($_SESSION['msg4']);
                }
                ?>
              </h3>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-center">Customer Name</th>
                    <th class="text-center">Mobile</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Service Date/Time</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Send Reminder</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "SELECT 
  c.cus_name, c.cus_mob, c.cus_email,
  j.id AS jobcard_id, j.created_at, j.work_status,
  j.carmodel, j.registration,
  s.service_due_date
FROM (
  SELECT c_id, MIN(service_due_date) AS service_due_date
  FROM jobcode_service_items
  WHERE service_due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
  GROUP BY c_id
) s
JOIN customer c ON c.c_id = s.c_id
-- Join the jobcard with the earliest created_at per customer for consistency
JOIN jobcard j ON j.c_id = c.c_id
  AND j.created_at = (
    SELECT MIN(created_at) 
    FROM jobcard 
    WHERE c_id = c.c_id
  )
WHERE j.g_id = $g_id
ORDER BY s.service_due_date DESC

";

                  $res = mysqli_query($conn, $sql);

                  if (!$res) {
                    echo "<tr><td colspan='7' class='text-center'>SQL Error: " . mysqli_error($conn) . "</td></tr>";
                  } elseif (mysqli_num_rows($res) == 0) {
                    echo "<tr><td colspan='7' class='text-center'>No data present.</td></tr>";
                  } else {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($res)) {
                      $formatted_due_date = date("Y-m-d", strtotime($row['service_due_date']));
                  ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['cus_name']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['cus_mob']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['cus_email']) ?></td>
                        <td class="text-center"><?= $formatted_due_date ?></td>
                        <td class="text-center"><strong><?= ($row['work_status'] == 1) ? "Working" : "Complete" ?></strong></td>
                        <td class="text-center">
                          <a class="btn btn-primary" href="service-reminder.php?id=<?= $row['jobcard_id'] ?>">Mail</a>
                          <a class="btn btn-success"
                            href="service-reminder-whatsapp.php?id=<?= $row['jobcard_id'] ?>" target="_blank" ?>
                            WhatsApp</a>
                        </td>
                      </tr>
                  <?php
                    }
                  }
                  ?>

                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<footer class="main-footer">
  <strong>Copyright &copy;2022 <a href="#">Garage Software Pvt Ltd</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
</aside>

</div>

<!-- JS dependencies -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>

</html>