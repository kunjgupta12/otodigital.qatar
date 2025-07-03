<?php
require("connection.php");

//////////////////////////////////////Customers///////////////////////////////////

////////////////////////////////////Create Customer////////////////////////////
if (isset($_POST['btn-cus'])) {

    $gid = $_POST['g_id'];
    $cid = $_POST['c_id'];
    $name = $_POST['name'];
    $email = $_POST['cus_email'];
    $mobile = $_POST['mobile'];
    $gst = $_POST['c_gst'];
    $c_add = $_POST['c_add'];


    $query = "SELECT MAX(c_id) as max_cid FROM customer";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $max_cid = $row['max_cid'];

    // Increment the value
    $cid = $max_cid + 1;

    $sql = "INSERT INTO `customer`(`g_id`,`c_id`,`cus_name`,`cus_email`,`cus_mob`,`c_gst`,`c_add`) 
    VALUES ('$gid','$cid','$name','$email','$mobile','$gst','$c_add')";
    $res = mysqli_query($conn, $sql);
    if ($res == 1) {
        // header("Location:dashboard.php");
        echo '<script type="text/JavaScript">';
        echo 'alert("Customer Added Successfully");';
        echo 'window.location= "allcustomers.php";';
        echo '</script>';
    } else {
        echo "Error!!";
    }
}

/////////////////////////Edit Customer/////////////////////////

if (isset($_POST['edit-cus'])) {
    update_customer($conn);
}

function update_customer($conn)
{

    $id = mysqli_real_escape_string($conn, $_POST['c_id']);
    $gid = mysqli_real_escape_string($conn, $_POST['g_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $cus_email = mysqli_real_escape_string($conn, $_POST['cus_email']);
    $c_gst = mysqli_real_escape_string($conn, $_POST['c_gst']);
    $c_add = mysqli_real_escape_string($conn, $_POST['c_add']);

    $check_sql = "SELECT * FROM customer WHERE id = '$id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {

        $update_sql = "UPDATE customer SET g_id = '$gid', cus_name = '$name', cus_mob = '$mobile', cus_email = '$cus_email', c_add = '$c_add',c_gst = '$c_gst' WHERE id = '$id'";
        $update_result = mysqli_query($conn, $update_sql);

        $update_sql1 = "UPDATE all_vehicle SET g_id = '$gid',  contact = '$mobile' WHERE id = '$id'";
        $update_result1 = mysqli_query($conn, $update_sql1);

        if ($update_result) {
            echo '<script type="text/JavaScript">';
            echo 'alert("Customer Updated Successfully");';
            echo 'window.location= "allcustomers.php";';
            echo '</script>';
        } else {
            echo '<script type="text/JavaScript">';
            echo 'alert("Error updating Customer!");';
            echo 'window.location= "allcustomers.php";';
            echo '</script>';
        }
    } else {
        header("location: allcustomers.php");
        exit(); // Ensure script stops executing after redirection
    }
}
/////////////////// display Customers ///////////////////////
if (isset($_SESSION['id'])) {
    function display_customers($conn, $g_id)
    {
        $g_id = $_SESSION['id'];

        $sql = "SELECT c.*, COUNT(v.id) as vehicle_count 
        FROM customer c
        LEFT JOIN all_vehicle v ON c.c_id = v.c_id
        WHERE c.g_id = $g_id
        GROUP BY c.id
        ORDER BY c.created_at DESC";
        $res = mysqli_query($conn, $sql);

        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <!--<td><?php echo $row['created_at']; ?></td>-->
                <td><?php echo $row['cus_name']; ?></td>
                <td><?php echo $row['cus_mob']; ?></td>
                <td><?php echo $row['cus_email']; ?></td>

                <td><?php echo $row['c_add']; ?></td>
                <td><?php echo $row['c_gst']; ?></td>
                <td><?php echo $row['vehicle_count']; ?></td>
                <td style="white-space: nowrap;">
                    <a class="btn btn-success ml-1" href="editcustomer.php?id=<?php echo $row['id']; ?>" title="Edit Customer"> &#9998; </a>
                    <a class="btn btn-warning" href="viewvehicles.php?id=<?php echo $row['c_id']; ?>" title="VIEW ALL VEHICLE">VIEW</a>
                    <a class="btn btn-success ml-1" href="addcar.php?id=<?php echo $row['id']; ?>" title="ADD VEHICLE">ADD</a>
                    <a class="btn btn-success ml-1" href="viewjobcard.php?id=<?php echo $row['c_id']; ?>" title="VIEW JOB CARD">VIEW JOB CARD</a>
                    <a class="btn btn-danger ml-1" href="delete_customer.php?c_id=<?php echo $row['c_id']; ?>" title="DELETE">DELETE</a>
                </td>
            </tr>
        <?php $i++;
        } ?>
        <?php
    }
}


/////////////////////////////////////--End Customers--/////////////////////////////////

/////////////////////////////////////Mechanics////////////////////////////////////////

/////////////////// display Mechanics ///////////////////////
if (isset($_SESSION['id'])) {
    function display_mechanics($conn, $g_id)
    {
        $g_id = $_SESSION['id'];

        $sql = "SELECT * FROM all_mechanics
        WHERE g_id = $g_id
        ORDER BY created_at DESC";
        $res = mysqli_query($conn, $sql);

        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['m_name']; ?></td>
                <td><?php echo $row['m_mob']; ?></td>
                <td><?php echo $row['m_email']; ?></td>
                <td><?php echo $row['m_add']; ?></td>
                <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
                <!-- <td>
                    <a class="btn" href="editcustomer.php?id=<?php echo $row['id']; ?>" title="Edit Customer" > &#9998; </a>
                    <a class="btn" href="viewvehicles.php?id=<?php echo $row['c_id']; ?>" title="VIEW ALL VEHICLE">&#128065;</a>
                    <a class="btn" href="addcar.php?id=<?php echo $row['id']; ?>" title="ADD VEHICLE">&#10133;</a>
                </td> -->
            </tr>
        <?php $i++;
        } ?>
        <?php
    }
}

///////////////////////////////////Add Mechanic////////////////////////////
if (isset($_POST['btn-mec'])) {

    $gid = $_POST['g_id'];
    $m_name = $_POST['m_name'];
    $m_email = $_POST['m_email'];
    $m_mob = $_POST['m_mob'];
    $m_add = $_POST['m_add'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `all_mechanics`(`g_id`,`m_name`,`m_email`,`m_mob`,`m_add`,`password`) 
    VALUES ('$gid','$m_name','$m_email','$m_mob','$m_add','$password')";
    $res = mysqli_query($conn, $sql);
    if ($res == 1) {
        // header("Location:dashboard.php");
        echo '<script type="text/JavaScript">';
        echo 'alert("New Mechanic Has been Added Successfully");';
        echo 'window.location= "all_mechanics.php";';
        echo '</script>';
    } else {
        echo "Error!!";
    }
}
/////////////////////////////////////--End Mechanics--////////////////////////////////////////

/////////////////////////////////////////Vehicles//////////////////////////////////////

///////////////////////////////////////Add Vehhicle////////////////////////////////////
if (isset($_POST['btn-addcar'])) {

    $gid = $_POST['g_id'];
    $cid = $_POST['c_id'];
    $vid = $_POST['v_id'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $regno = $_POST['regno'];
    // Replace brand if 'Other' selected
    $brand = ($_POST['brand'] === 'Other') ? $_POST['other_brand'] : $_POST['brand'];

    // Replace model if 'Other' selected
    $model = ($_POST['brand'] === 'Other') ? $_POST['other_model'] : $_POST['model'];
    $fuel = $_POST['fuel'];
    $Chessis_no = $_POST['Chessis_no'];
    $engine_no = $_POST['engine_no'];
    $transmission = $_POST['transmission'];
    $braking = $_POST['braking'];

    $sql = "INSERT INTO `all_vehicle`(`g_id`,`c_id`,`v_id`,`name`,`contact`,`registration`,`carbrand`,`carmodel`,`fueltype`,`chassis_no`,`engine_no`,`transmission`,`braking`) 
    VALUES ('$gid','$cid','$vid','$name','$mobile','$regno','$brand','$model','$fuel','$Chessis_no','$engine_no','$transmission','$braking')";
    $res = mysqli_query($conn, $sql);
    if ($res == 1) {
        echo '<script type="text/JavaScript">';
        echo 'alert("Car Has Been Added Successfully");';
        echo 'window.location= "createvehicles_jobcard.php";';
        echo '</script>';
        exit();
    } else {
        echo "Error!!";
    }
}


/////////////////// display Cars ///////////////////////

if (isset($_SESSION['id'])) {

    function display_cars($conn)
    {
        $g_id = $_SESSION['id'];

        $sql = "SELECT * FROM all_vehicle WHERE g_id = $g_id  ORDER BY created_at DESC";

        $res = mysqli_query($conn, $sql);

        $i = 1;
        $shown = [];
        while ($row = mysqli_fetch_assoc($res)) {
            if (in_array($row['id'], $shown)) continue;
            $shown[] = $row['id'];
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($row['registration']); ?></td>
                <td><?php echo htmlspecialchars($row['carbrand']); ?></td>
                <td><?php echo htmlspecialchars($row['carmodel']); ?></td>
                <td><?php echo htmlspecialchars($row['engine_no']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['contact']); ?></td>
                <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
                <td><strong><a class="btn btn-primary" href="createjobcard.php?id=<?php echo $row['id']; ?>">Create Job Card</a></strong></td>
            </tr>
        <?php $i++;
        }
    }
}




/////////////////// display Cars ///////////////////////


if (isset($_SESSION['id'])) {
    function display_cars1($conn)
    {
        $g_id = $_SESSION['id'];

        // Select distinct vehicle IDs with customer mobile
        $sql = "SELECT * FROM all_vehicle WHERE g_id = $g_id ORDER BY created_at DESC";

        $res = mysqli_query($conn, $sql);

        $i = 1;
        $shown = []; // to track already shown vehicle IDs
        while ($row = mysqli_fetch_assoc($res)) {
            if (in_array($row['id'], $shown)) continue; // skip duplicate IDs
            $shown[] = $row['id'];
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <?php echo $row['carbrand']; ?><br>
                    <?php echo $row['carmodel']; ?><br>
                    <?php echo $row['registration']; ?>
                </td>
                <td>
                    <?php echo $row['name']; ?><br>
                    <?php echo $row['contact']; ?>
                </td>
                <td>
                    <?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?>
                </td>
                <td>
                    <strong><a class="btn btn-primary" href="createjobcard.php?id=<?php echo $row['id']; ?>">Create JobCard</a></strong>
                </td>
            </tr>
        <?php $i++;
        }
    }
}





/////////////////// display All Cars ///////////////////////

if (isset($_SESSION['id'])) {
    function display_allpayment($conn)
    {
        $g_id = $_SESSION['id'];
        $jobcard_id = $_GET['id'];

        $sql = "SELECT ph.*, c.cus_name
                FROM payment_history ph
                JOIN customer c ON ph.c_id = c.c_id
               
                WHERE ph.g_id = $g_id AND ph.jobcard_id = $jobcard_id
                ORDER BY ph.created_at DESC";

        $res = mysqli_query($conn, $sql);
        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) {

            $sql = "SELECT `jobcard_id` FROM `payment_history` WHERE jobcard_id = $jobcard_id ORDER BY id";
            $result = mysqli_query($conn, $sql);
            while ($row1 = mysqli_fetch_assoc($result)) {
                $sql2 = "SELECT `job_card_type` FROM `jobcard` WHERE id = $row1[jobcard_id]";
                $query2 = mysqli_query($conn, $sql2);
                $result2 = mysqli_fetch_assoc($query2);
            }
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
                <td><?php echo $result2['job_card_type']; ?></td>

                <td><?php echo $row['cus_name']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['payment_type']; ?></td>
            </tr>
        <?php
            $i++;
        }
    }
}

if (isset($_SESSION['id'])) {
    function display_allcars($conn, $g_id)
    {
        $g_id = $_SESSION['id'];
        $c_id = $_GET['id'];

        $sql = "SELECT * FROM all_vehicle where g_id = $g_id AND c_id = $c_id ORDER BY created_at DESC";
        $res = mysqli_query($conn, $sql);

        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['carbrand']; ?></td>
                <td><?php echo $row['carmodel']; ?></td>
                <td><?php echo $row['registration']; ?></td>
                <td><strong><a href="createjobcard.php?id=<?php echo $row['id']; ?>">Create Job Card</a></strong></td>
            </tr>

        <?php $i++;
        } ?>
        <?php }
}

/////////////////// display All Cars ///////////////////////

if (isset($_SESSION['id'])) {
    function display_alljobcard($conn)
    {
        $g_id = $_SESSION['id']; // safer to cast
        $c_id = $_GET['id'];     // make sure it's numeric

        $sql = "SELECT jobcard.*, customer.cus_name, customer.cus_mob, 
                       all_vehicle.registration, all_vehicle.carbrand, all_vehicle.carmodel 
                FROM jobcard 
                JOIN customer ON jobcard.c_id = customer.c_id 
                JOIN all_vehicle ON jobcard.v_id = all_vehicle.v_id 
                WHERE jobcard.g_id =  $g_id AND jobcard.c_id = $c_id 
                ORDER BY jobcard.created_at DESC";
        $res = mysqli_query($conn, $sql);
        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr class="text-center">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['job_card_type']; ?></td>
                <td><?php echo $row['carbrand']; ?><br>
                    <?php echo $row['carmodel']; ?><br>
                    <?php echo $row['registration']; ?>
                </td>
                <td><?php echo $row['cus_name']; ?><br>
                    <?php echo $row['cus_mob']; ?>
                </td>
                <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
                <td><strong>
                        <?php
                        switch ($row['work_status']) {
                            case 1:
                                echo "Pending";
                                break;
                            case 2:
                                echo "Approved";
                                break;
                            case 3:
                                echo "Working";
                                break;
                            default:
                                echo "Complete";
                                break;
                        }
                        ?>
                    </strong></td>
            </tr>
        <?php
            $i++;
        }
    }
}




/////////////////////////////////////--End Vehicle--/////////////////////////////////


/////////////////////////////////////--Jobcard--/////////////////////////////////////
if (isset($_POST['btn-create-jobcard'])) {
    //include("dbconnect.php"); 
    // Fetch and sanitize form data
    $gid = $_POST['g_id'];
    $cid = $_POST['c_id'];
    $vid = $_POST['v_id'];
    $uid = $_POST['uid'];
    $odometer = $_POST['odometer'];
    $fuelmeter = $_POST['fuelmeter'];
    $insexpiry = $_POST['insexpiry'];
    $inventry = $_POST['inventry'];
    $insurance_company = mysqli_real_escape_string($conn, $_POST['insurance_company']);
    $job_card_type = $_POST['job_card_type'] ?? 'test';
    $voice_of_customer = mysqli_real_escape_string($conn, $_POST['voice_of_customer']);
    $instruction_of_mechanic = mysqli_real_escape_string($conn, $_POST['instruction_of_mechanic']);
    $service_due_date = $_POST['service_due_date'];
    $mobile = $_POST['mobile'];

    // Package, Service, and Parts Details
    $service_discount = $_POST['service_discount'];

    $partIndex = $_POST['partIndex'];

    $serviceName = $_POST['service'] ?? [];
    $ser = $_POST['price'] ?? [];
    $serDiscountedPrice = $_POST['discounted_price'] ?? [];
    $hsn = $_POST['hsn_code'] ?? [];
    $serviceCgst = $_POST['serviceCgst'] ?? [];
    $serviceCgstValue = $_POST['serviceCgstValue'] ?? [];
    $totalprice = $_POST['total'] ?? [];

    $partId = $_POST['partId'] ?? [];
    $partName = $_POST['partName'] ?? [];
    $partPrice = $_POST['partPrice'] ?? [];
    $partDiscountPrice = $_POST['partDiscountPrice'] ?? [];
    $partNumber = $_POST['partNumber'] ?? $_POST['partNumberN'];
    $partHsnCode = $_POST['partHsnCode'] ?? [];
    $partQty = $_POST['partQty'] ?? [];
    $partCgst = $_POST['partCgst'] ?? [];
    // $partCgstValue = $_POST['partCgstValue'] ?? [];
    $part_discount = floatval($_POST['part_discount'] ?? 0);

    $partTotal = $_POST['partTotal'] ?? [];

    $srno = $_POST['srno'] ?? [];

    $packageIds = $_POST['packageId'] ?? [];
    $packageName = $_POST['packageName'] ?? [];
    $packagePrices = $_POST['packagePrice'] ?? [];
    $packageDiscountPrice = $_POST['packageDiscountPrice'] ?? [];
    $packageHsnCode = $_POST['packageHsnCode'] ?? [];
    $packageQty = $_POST['packageQty'] ?? [];
    $packageCgst = $_POST['packageCgst'] ?? [];
    $packageTotal = $_POST['packageTotal'] ?? [];
    $package_discount = $_POST['package_discount'] ?? [];


    if ($job_card_type === 'Accident') {
        $insurance_code = mysqli_real_escape_string($conn, $_POST['insurance_code'] ?? '');
        $insurance_company_name = mysqli_real_escape_string($conn, $_POST['insurance_company_name'] ?? '');
        $insurance_gstin = mysqli_real_escape_string($conn, $_POST['insurance_gstin'] ?? '');
        $insurance_claim_number = mysqli_real_escape_string($conn, $_POST['insurance_claim_number'] ?? '');
        $insurance_policy_number = mysqli_real_escape_string($conn, $_POST['insurance_policy_number'] ?? '');
    }


    //--------------------------------------------------------------
    $getGarageName = mysqli_query($conn, "SELECT g_name FROM call_login WHERE g_id = '$gid'");
    $garageData = mysqli_fetch_assoc($getGarageName);

    $garageWords = explode(" ", strtoupper($garageData['g_name']));
    $initials = substr($garageWords[0], 0, 1) . (isset($garageWords[1]) ? substr($garageWords[1], 0, 1) : 'X');

    $month = strtoupper(date("M"));
    $prefix = "IN{$month}{$initials}";
    $getLastInvoice = mysqli_query($conn, "
        SELECT MAX(CAST(SUBSTRING(invoice_no, LENGTH('$prefix') + 1) AS UNSIGNED)) AS last_serial 
        FROM jobcard 
        WHERE invoice_no LIKE '{$prefix}%'
    ");
    $row = mysqli_fetch_assoc($getLastInvoice);
    $serial = isset($row['last_serial']) ? $row['last_serial'] + 1 : 1;
    $serial = str_pad($serial, 2, '0', STR_PAD_LEFT);
    $invoice_no = "{$prefix}{$serial}";

    //-------------------------------------------------------------------

    $getGarageName = mysqli_query($conn, "SELECT g_name FROM call_login WHERE g_id = '$gid'");
    $garageData = mysqli_fetch_assoc($getGarageName);
    $prefix = strtoupper(substr(preg_replace("/[^A-Z]/", "", $garageData['g_name']), 0, 3));
    $getLastJobCard = mysqli_query($conn, "
        SELECT MAX(CAST(SUBSTRING_INDEX(job_card_no, '/', -1) AS UNSIGNED)) AS last_no 
        FROM jobcode_service_items 
        WHERE job_card_no LIKE '$prefix/JC/%'
    ");
    $row = mysqli_fetch_assoc($getLastJobCard);
    $last_no = $row['last_no'] ? $row['last_no'] + 1 : 1;
    $job_card_no = $prefix . '/JC/' . $last_no;


    // Upload images
    function uploadMultipleFiles($files, $dir = 'uploads/')
    {
        $uploaded = [];
        foreach ($files['tmp_name'] as $key => $tmp_name) {
            $filename = $dir . basename($files['name'][$key]);
            move_uploaded_file($tmp_name, $filename);
            $uploaded[] = $filename;
        }
        return implode(",", $uploaded);
    }

    $img1 = uploadMultipleFiles($_FILES['img1']);
    $img2 = uploadMultipleFiles($_FILES['img2']);

    // Total price calculation
    $finalTotal = 0;
    foreach ($totalprice as $val) {
        if (is_numeric($val)) $finalTotal += $val;
    }

    foreach ($partTotal as $val1) {
        if (is_numeric($val1)) $finalTotal += $val1;
    }

    foreach ($packageTotal as $val2) {
        if (is_numeric($val2)) $finalTotal += $val2;
    }

    // Insert jobcard
    $jobcard_sql = "INSERT INTO `jobcard`(
    `g_id`, `c_id`, `v_id`, `uid`, `invoice_no`, `odometer`, `fuelmeter`, `insexpiry`, `inventory`, 
     `insurance_policy_number`, 
    `img1`, `img2`, `totalprice`, `dueamount`, `status`, 
    `part_discount`, `service_discount`, `packageDiscount`, 
    `job_card_type`, `job_card_no`,`insurance_company_name`, `insurance_code`, `insurance_gstin`, `insurance_claim_number`
) VALUES (
    '$gid', '$cid', '$vid', '$uid', '$invoice_no', '$odometer', '$fuelmeter', '$insexpiry', '$inventry', 
    '$insurance_policy_number', 
    '$img1', '$img2', '$finalTotal', '$finalTotal', 'P', 
    '$part_discount', '$service_discount', '$package_discount', 
    '$job_card_type', '$job_card_no', '$insurance_company_name', '$insurance_code', '$insurance_gstin', '$insurance_claim_number')";

    if (mysqli_query($conn, $jobcard_sql)) {

        // Insert Parts
        foreach ($partName as $key => $partNameVal) {
            if ($partNameVal === '') continue;

            $totalGst = ($partCgst[$key] ?? 0) + ($partSgst[$key] ?? 0);
            $sql = "INSERT INTO jobcode_service_items (
            g_id, c_id, v_id, uid, partname, partPrice, partDiscountPrice,
            part_number, parthsncode, partqty, partcgst, 
            parttotalpay, p_s, voice_of_customer, instruction_of_mechanic,service_due_date
        ) VALUES (
            '$gid','$cid','$vid','$uid',
            '{$partName[$key]}','{$partPrice[$key]}','{$partDiscountPrice[$key]}',
            '{$partNumber[$key]}','{$partHsnCode[$key]}','{$partQty[$key]}',
            '{$partCgst[$key]}',
            '{$partTotal[$key]}','1','$voice_of_customer','$instruction_of_mechanic','$service_due_date'
        )";
            mysqli_query($conn, $sql);
        }


        // Insert Services
        foreach ($serviceName as $key => $service) {
            if (empty($service)) continue;

            $gst = ($serviceCgst[$key] ?? 0) + ($serviceSgst[$key] ?? 0);
            $sql = "INSERT INTO jobcode_service_items (
        g_id, c_id, v_id, uid, service, price, discounted_price,
        hsn_code, gst, cgst_percentage, cgst_value,
        total, p_s
    ) VALUES (
        '$gid','$cid','$vid','$uid',
        '{$serviceName[$key]}','{$ser[$key]}','{$serDiscountedPrice[$key]}',
        '{$hsn[$key]}','$gst',
        '{$serviceCgst[$key]}','{$serviceCgstValue[$key]}',
       
        '{$totalprice[$key]}','2'
    )";
            mysqli_query($conn, $sql);
        }

        // Insert Packages
        foreach ($packageIds as $key => $packageId) {
            if (empty($packageId)) continue;

            $totalGst = ($packageCgst[$key] ?? 0) + ($packageSgst[$key] ?? 0);
            $sql = "INSERT INTO jobcode_service_items (
        g_id, c_id, v_id, uid, package, packageprice, discountprice,
        hsncode,pqty, pcgst,  totalpay, p_s,
        job_card_type, voice_of_customer, instruction_of_mechanic,
        job_card_no, service_due_date
    ) VALUES (
        '$gid','$cid','$vid','$uid',
        '{$packageName[$key]}','{$packagePrices[$key]}','{$packageDiscountPrice[$key]}',
        '{$packageHsnCode[$key]}','{$packageQty[$key]}',
        '{$packageCgst[$key]}',
         '{$packageTotal[$key]}',
        '3','$job_card_type','$voice_of_customer','$instruction_of_mechanic',
        '$job_card_no','$service_due_date'
    )";
            mysqli_query($conn, $sql);
        }


        // Update inventory
        foreach ($partQty as $key => $value) {
            $update_inventory = "UPDATE `inventory` SET `Stock` = `Stock` - '$value' WHERE `id` = '$partId[$key]'";
            $runUpdateQuery = mysqli_query($conn, $update_inventory);
            if (!$runUpdateQuery) {
                echo "Error updating inventory: " . mysqli_error($conn);
            }
        }
        // Add user services
        foreach ($ser as $price) {
            mysqli_query($conn, "INSERT INTO user_service (sid, contact, price) VALUES ('$uid', '$mobile', '$price')");
        }

        header("Location: ShowJobCard.php");
        exit;
    } else {
        echo "Error creating job card: " . mysqli_error($conn);
    }
}



// function generateInvoiceNumber1() {
//     return mt_rand(10, 999);
// }

function generateInvoiceNumber()
{
    // Get current date and format it
    $date = date('dMY');

    // Check if the date has changed, if yes, reset serial number to 1
    if (!isset($_SESSION['last_invoice_date']) || $_SESSION['last_invoice_date'] != $date) {
        $_SESSION['last_invoice_date'] = $date;
        $_SESSION['serial_number'] = 1;
    }

    // Format the serial number with leading zeros
    $serial_number = str_pad($_SESSION['serial_number'], 2, '0', STR_PAD_LEFT);

    // Concatenate the parts to form the invoice number
    $invoice_number = "IN{$date}{$serial_number}";

    return $invoice_number;
}

// Increment the serial number for the next invoice
$_SESSION['serial_number'] = isset($_SESSION['serial_number']) ? $_SESSION['serial_number'] + 1 : 1;

// Example usage
$invoice_number = generateInvoiceNumber();
// echo $invoice_number;



////////////////////////Edit JobCard//////////////////////////////////


if (isset($_POST['btn-edit'])) {
    update_jobcard1($conn);
}

function update_jobcard1($conn)
{
    try {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        die();
        $conn->begin_transaction();

        $uid = $_POST['uid'];
        $g_id = $_POST['g_id'];
        $v_id = $_POST['v_id'];
        $c_id = $_POST['c_id'];

        $partIndex = $_POST['partIndex'];
        $partName = $_POST['partName'];
        $partPrice = $_POST['partPrice'];
        $partDiscountPrice = $_POST['partDiscountPrice'];
        $partNumber = $_POST['partNumber'];
        $partHsnCode = $_POST['partHsnCode'];
        $partQty = $_POST['partQty'];
        $partCgst = $_POST['partCgst'];
        $partCgstValue = $_POST['partCgstValue'];
        $partSgst = $_POST['partSgst'];
        $partSgstValue = $_POST['partSgstValue'];
        $partTotal = $_POST['partTotal'];
        $part_service_id = $_POST['part_service_id'];
        $p_s_part = 1;
        $packageIds = $_POST['packageId'];
        $packagePrices = $_POST['packagePrice'];

        $srno = isset($_POST['srno']) ? $_POST['srno'] : [];
        $serviceName = isset($_POST['service']) ? $_POST['service'] : [];
        $ser = isset($_POST['price']) ? $_POST['price'] : [];
        $discounted_price = isset($_POST['discounted_price']) ? $_POST['discounted_price'] : [];
        $hsn = isset($_POST['hsn_code']) ? $_POST['hsn_code'] : [];
        $serviceCgst = isset($_POST['serviceCgst']) ? $_POST['serviceCgst'] : [];
        $serviceCgstValue = isset($_POST['serviceCgstValue']) ? $_POST['serviceCgstValue'] : [];
        $serviceSgst = isset($_POST['serviceSgst']) ? $_POST['serviceSgst'] : [];
        $serviceSgstValue = isset($_POST['serviceSgstValue']) ? $_POST['serviceSgstValue'] : [];
        $totalprice = isset($_POST['total']) ? $_POST['total'] : [];
        $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : [];

        $p_s_service = 2;

        $job_card_type = $_POST['job_card_type'];
        $voice_of_customer = $_POST['voice_of_customer'];
        $instruction_of_mechanic = $_POST['instruction_of_mechanic'];
        $job_card_no = $_POST['job_card_no'];

        $service_due_date = $_POST['service_due_date'];
        $part_discount = $_POST['part_discount'];
        $service_discount = $_POST['service_discount'];

        for ($i = 0; $i < count($packageIds); $i++) {
            $package = mysqli_real_escape_string($conn, $packageIds[$i]);
            $packageprice = mysqli_real_escape_string($conn, $packagePrices[$i]);


            // Insert parts
            foreach ($partIndex as $key => $value) {
                $totalGst = $partCgst[$key] + $partSgst[$key];

                if ($part_service_id[$key] == 0) {
                    $insert_code_items = "INSERT INTO `jobcode_service_items`(p_s, g_id, c_id, v_id, uid, service, price, discounted_price, part_number, hsn_code, gst, cgst_percentage, cgst_value, sgst_percentage, sgst_value, partqty, total,
                job_card_type,voice_of_customer,instruction_of_mechanic,job_card_no,service_due_date,package,packageprice) 
                VALUES (1,'$g_id','$c_id','$v_id','$uid','" . $partName[$key] . "','$partPrice[$key]','$partDiscountPrice[$key]','$partNumber[$key]','$partHsnCode[$key]','$totalGst', '$partCgst[$key]','$partCgstValue[$key]','$partSgst[$key]','$partSgstValue[$key]',
                '$partQty[$key]','$partTotal[$key]','$job_card_type','$voice_of_customer','$instruction_of_mechanic','$job_card_no','$service_due_date','$package','$packageprice')";
                    $runQuery = mysqli_query($conn, $insert_code_items);
                } else {
                    $update_code_items = "UPDATE `jobcode_service_items`
    SET 
        `g_id` = '$g_id',
        `c_id` = '$c_id',
        `v_id` = '$v_id',
        `uid` = '$uid',
        `service` = '{$partName[$key]}',
        `price` = '{$partPrice[$key]}',
        `discounted_price` = '{$partDiscountPrice[$key]}',
        `part_number` = '{$partNumber[$key]}',
        `hsn_code` = '{$partHsnCode[$key]}',
        `gst` = '$totalGst',
        `cgst_percentage` = '{$partCgst[$key]}',
        `cgst_value` = '{$partCgstValue[$key]}',
        `sgst_percentage` = '{$partSgst[$key]}',
        `sgst_value` = '{$partSgstValue[$key]}',
        `qty` = '{$partQty[$key]}',
        `partqty` = '{$partQty[$key]}',
        `total` = '{$partTotal[$key]}',
        `voice_of_customer` = '$voice_of_customer',
        `instruction_of_mechanic` = '$instruction_of_mechanic',
        `service_due_date` = '$service_due_date' WHERE 
    `id` = '{$part_service_id[$key]}' AND 
    `uid` = '$uid' AND 
    `c_id` = '$c_id' AND 
    `v_id` = '$v_id' AND   `g_id` = '$g_id'";
                    $runQuery = mysqli_query($conn, $update_code_items);
                }
            }
        }
        // Insert services
        for ($i = 0; $i < count($packageIds); $i++) {
            $package = mysqli_real_escape_string($conn, $packageIds[$i]);
            $packageprice = mysqli_real_escape_string($conn, $packagePrices[$i]);
            foreach ($srno as $key => $value) {
                $totalGst = $serviceCgst[$key] + $serviceSgst[$key];
                if ($service_id[$key] == 0) {
                    $insert_code_items = "INSERT INTO `jobcode_service_items`(g_id, c_id, v_id, uid, service, price, discounted_price, hsn_code, gst, cgst_percentage, cgst_value, sgst_percentage, sgst_value, total, p_s,
                job_card_type,voice_of_customer,instruction_of_mechanic,job_card_no,service_due_date,package,packageprice) VALUES ('$g_id','$c_id','$v_id','$uid','$serviceName[$key]','$ser[$key]','$discounted_price[$key]','$hsn[$key]','$totalGst','$serviceCgst[$key]','$serviceCgstValue[$key]','$serviceSgst[$key]','$serviceSgstValue[$key]','$totalprice[$key]', '2','$job_card_type','$voice_of_customer','$instruction_of_mechanic','$job_card_no','$service_due_date','$package','$packageprice')";
                    $runQuery = mysqli_query($conn, $insert_code_items);
                } else {
                    $update_code_items = "UPDATE `jobcode_service_items` SET `g_id`='$g_id',`c_id`='$c_id',`v_id`='$v_id',`uid`='$uid',`service`='$serviceName[$key]',`price`='$ser[$key]',`discounted_price`='$discounted_price[$key]',`hsn_code`='$hsn[$key]',`gst`='$totalGst',`cgst_percentage`='$serviceCgst[$key]',`cgst_value`='$serviceCgstValue[$key]',`sgst_percentage`='$serviceSgst[$key]',`sgst_value`='$serviceSgstValue[$key]',`total`='$totalprice[$key]',`voice_of_customer`='$voice_of_customer',`instruction_of_mechanic`='$instruction_of_mechanic',`service_due_date`='$service_due_date' WHERE `id`=" . $service_id[$key];
                    $runQuery = mysqli_query($conn, $update_code_items);
                }
            }
        }

        // Update jobcard status
        $update_jobcard_status = $conn->prepare("UPDATE jobcard SET part_discount = '$part_discount', service_discount = '$service_discount',job_card_type = '$job_card_type', work_status = 1 WHERE uid = ?");
        $update_jobcard_status->bind_param("i", $uid);
        if (!$update_jobcard_status->execute()) {
            throw new Exception("Error updating job card status: " . $update_jobcard_status->error);
        }

        $conn->commit();


        // Provide feedback to the user
        echo '<script type="text/JavaScript">';
        echo 'alert("Jobcard Updated Successfully ");';
        echo 'window.location= "ShowJobCard.php";';
        echo '</script>';
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();

        // Handle the error (e.g., log it, display a user-friendly message)
        echo 'Error: ' . $e->getMessage();
    }
}


/////////////////////Remove Service////////////////////

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $serviceId = $_POST['id'];

    // Perform the deletion query
    $deleteQuery = "DELETE FROM jobcode_service_items WHERE id = $serviceId";

    // Execute the query (make sure to handle errors appropriately)
    $result = mysqli_query($conn, $deleteQuery);

    // Send a response back to the AJAX request
    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}


/////////////////////////////////////--End Jobcard--/////////////////////////////////

/////////////////// display booking ///////////////////////
if (isset($_SESSION['id'])) {
    function display_product($conn, $g_id)
    {
        $g_id = $_SESSION['id'];

        $sql = "SELECT * FROM g_booking where g_id=$g_id ORDER BY created_at DESC";
        $res = mysqli_query($conn, $sql);

        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
                <td><?php echo $row['cus_name']; ?></td>
                <td><?php echo $row['cus_email']; ?></td>
                <td><?php echo $row['cus_mob']; ?></td>
                <td><?php echo $row['car_model']; ?></td>
                <!-- <td><?php echo $row['service']; ?></td> -->
                <!-- <td><?php echo $row['service_date']; ?></td> -->
                <!-- <td><?php echo $row['request']; ?></td> -->
                <td><strong><a href="jobcardweb.php?id=<?php echo $row['id']; ?>">Create Job Card</a></strong></td>
            </tr>

        <?php $i++;
        } ?>
        <?php }
}



/////////////////// display App booking ///////////////////////
if (isset($_SESSION['id'])) {
    function display_product1($conn)
    {
        $g_id = $_SESSION['id'];
        $sql = "SELECT * FROM booking_detail where g_id=$g_id ORDER BY created_at DESC";
        $res = mysqli_query($conn, $sql);
        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <!-- <td><?php echo $row['carbrand']; ?></td> -->
                <td><?php echo $row['carmodel']; ?></td>
                <td><?php echo $row['service']; ?></td>
                <td><?php echo $row['fuel']; ?></td>
                <td><?php echo $row['insurance']; ?></td>
                <td><?php echo $row['policyperoid']; ?></td>
                <td><?php echo $row['other_car']; ?></td>
                <td><?php echo $row['spl_req']; ?></td>
                <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
                <td><strong><a href="jobcardmake.php?id=<?php echo $row['id']; ?>">Create Job Card</a></strong></td>

            </tr>

        <?php $i++;
        } ?>
    <?php }
}
///////////////////// count booking //////////////////////

function countProduct($conn)
{
    $g_id = $_SESSION['id'];

    $sql = "select * from customer where g_id=$g_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}

///////////////////// count user //////////////////////

function countUser($conn)
{
    $sql = "select * from caruser";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}
///////////////////// count user //////////////////////

function countAppOrder($conn)
{
    $g_id = $_SESSION['id'];
    $sql = "select * from serviceorder where g_id=$g_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}

///////////////////// count user //////////////////////

function countAppbooking($conn)
{
    $g_id = $_SESSION['id'];
    $sql = "select * from booking_detail where g_id=$g_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}
///////////////////// count jobcard //////////////////////

function countjobcard($conn)
{
    $g_id = $_SESSION['id'];

    $sql = "select * from jobcard where g_id=$g_id and work_status=1";
    // $sql = "select * from jobcard";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}


///////////////////// count Stock  //////////////////////

function count_all_stock($conn)
{
    $g_id = $_SESSION['id'];

    $sql = "select * from inventory where g_id=$g_id";
    // $sql = "select * from jobcard";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}


///////////////////// count vehicles//////////////////////

function count_all_vehicles($conn)
{
    $g_id = $_SESSION['id'];

    $sql = "select * from all_vehicle where g_id=$g_id";
    // $sql = "select * from jobcard";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}

///////////////////// count complete jobcard //////////////////////

function count_complete_jobcard($conn)
{
    $g_id = $_SESSION['id'];

    $sql = "select * from jobcard where g_id=$g_id and work_status=0";
    // $sql = "select * from jobcard";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}
///////////////////// count Todays Revenew //////////////////////

function countRevenueToday($conn)
{
    $g_id = $_SESSION['id'];
    $sql = "SELECT SUM(amount) AS total FROM payment_history WHERE g_id = $g_id AND DATE(created_at) = CURDATE()";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        if ($row['total'] !== null) {
            echo $row['total'];
        } else {
            echo "0.00";
        }
    } else {
        echo "Query Error";
    }
}





///////////////////// count All Revenew //////////////////////

function countrevenewall($conn)
{
    $g_id = $_SESSION['id'];
    $sql = "SELECT SUM(amount) AS total FROM  payment_history WHERE g_id = $g_id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        if ($row['total'] !== null) {
            echo $row['total'];
        } else {
            echo "0.00";
        }
    } else {
        echo "Query Error";
    }
}

function totaldueamount($conn)
{
    $g_id = $_SESSION['id'];
    $g_id = mysqli_real_escape_string($conn, $g_id);
    $sql = "SELECT SUM(dueamount) AS total_due FROM jobcard WHERE g_id = '$g_id' ";
    $res = mysqli_query($conn, $sql);
    if ($res && $row = mysqli_fetch_assoc($res)) {
        echo $row['total_due'] !== null ? $row['total_due'] : "0";
    } else {
        echo "N/A";
    }
}



///////////////////// throw Notification  //////////////////////

function trial_end_date($conn)
{
    $g_id = $_SESSION['id'];

    $sql = "SELECT trial_end_date FROM call_login WHERE g_id = $g_id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);

        if ($row) {
            $trialEndDate = strtotime($row['trial_end_date']);
            $currentDate = strtotime(date('Y-m-d'));

            // Calculate the difference in days
            $daysRemaining = floor(($trialEndDate - $currentDate) / (60 * 60 * 24));

            if ($daysRemaining <= 7) {
                // Display the message only when 7 days or fewer are remaining
                echo '<a href="plans.php" class="dropdown-item">';
                echo '<i class="fas fa-exclamation-circle mr-2" style="color: red;"></i>';
                echo '<span class="dropdown-item dropdown-header">';
                echo '<div style="color: red; font-size: 5px; font-weight: bold; text-align: center; animation: blink 1s infinite;">';
                echo '<h5>Your Subscription expires in </br> ' . $daysRemaining . ' days: ' . date('Y-m-d', $trialEndDate) . '</h5>';
                echo '</div>';
            }
        } else {
            echo "N/A";
        }
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
    }
}

function trial_end_date1($conn)
{
    $g_id = $_SESSION['id'];

    $sql = "SELECT trial_end_date FROM call_login WHERE g_id = $g_id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);

        if ($row) {
            $trialEndDate = strtotime($row['trial_end_date']);
            $currentDate = strtotime(date('Y-m-d'));

            // Calculate the difference in days
            $daysRemaining = floor(($trialEndDate - $currentDate) / (60 * 60 * 24));

            if ($daysRemaining <= 7) {
                // Display the message only when 7 days or fewer are remaining
                echo '<span class="badge badge-danger navbar-badge">!</span>';
            }
        } else {
            echo "N/A";
        }
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
    }
}
//////////////// delete booking///////////////////////

if (isset($_POST['uid'])) {
    $_SESSION['uid'] = $_POST['uid'];
}

if (isset($_POST['btn-del']) && isset($_POST['uid'])) {
    $id = $_POST['uid'];
    $sql = "DELETE FROM bookingform WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("location:dashboard.php");
        $_SESSION['msg4'] = "Booking Deleted!!";
    }
}
// if (isset($_REQUEST['c_id'])) {

//     // Sanitize and prepare
//     $id = intval($_REQUEST['c_id']); // optional but safe
//     $stmt = $conn->prepare("DELETE FROM `customer` WHERE `c_id` = ?");
//     $stmt->bind_param("i", $id);
//     $stmt->execute();

//     // Redirect
//     header("Location: allcustomers.php");
// }
////////////////login admin//////////////////////

// if (isset($_POST['btn-sub'])) {
//     login($conn);
// }
// function login($conn)
// {
//     $g_mob = $_POST['g_mob'];
//     $password = $_POST['password'];

//     $hashed_password = hash('sha256', $password); // Hash the password using SHA-256

//     $sql = "SELECT * FROM garages_login WHERE g_mob='$g_mob' AND password='$hashed_password'";
//     $res = mysqli_query($conn, $sql);
//     if (mysqli_num_rows($res) > 0) {
//         $row = mysqli_fetch_assoc($res);
//         $_SESSION['user'] = $row['g_name'];
//         $_SESSION['id'] = $row['g_id'];
//         $_SESSION['img'] = $row['img'];
//         $_SESSION['g_email'] = $row['g_email'];
//         $_SESSION['g_mob'] = $row['g_mob'];
//         $_SESSION['g_address'] = $row['g_address'];
//         $_SESSION['password'] = $row['password'];
//         header("location:dashboard.php");
//         $_SESSION['msg5'] = "Welcome back!!";
//     } else {
//         header("location:login.php");
//         $_SESSION['msg'] = "Invalid Credentials!!";
//     }
// }

if (isset($_POST['btn-sub'])) {
    login($conn);
}
function login($conn)
{
    $g_mob = $_POST['g_mob'];
    $password = $_POST['password'];

    $hashed_password = hash('sha256', $password); // Hash the password using SHA-256

    $sql = "SELECT * FROM call_login WHERE g_mob='$g_mob' AND password='$hashed_password'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        // Check if the user's trial period has expired
        $trialEndDate = strtotime($row['trial_end_date']);
        $currentDate = strtotime(date('Y-m-d'));

        if ($currentDate > $trialEndDate) {
            // Trial period has expired, redirect to the plans page
            header("Location: plans.php");
            exit(); // Stop further execution of the script
        } else {
            // User's trial period is still valid
            $_SESSION['user'] = $row['g_name'];
            $_SESSION['id'] = $row['g_id'];
            $_SESSION['img'] = $row['img'];
            $_SESSION['qrcode'] = $row['qrcode'];
            $_SESSION['g_email'] = $row['g_email'];
            $_SESSION['g_mob'] = $row['g_mob'];
            $_SESSION['g_gst'] = $row['g_gst'];
            $_SESSION['state'] = $row['state'];
            $_SESSION['city'] = $row['city'];
            $_SESSION['g_address'] = $row['g_address'];
            $_SESSION['password'] = $row['password'];
            header("location: dashboard.php");
            $_SESSION['msg5'] = "Welcome back!!";
        }
    } else {
        header("location: forgot-pass.php");
        $_SESSION['msg'] = "Invalid Credentials!!";
    }
}

////////////////////////Register admin//////////////////////

// if(isset($_POST['btn-sub2'])){


//     // $username=$_POST['username'];vie
//     $g_name=$_POST['gname'];
//     $mobile=$_POST['mobile'];
//     $email=$_POST['email'];
//     $password=$_POST['password'];
//     $address=$_POST['address'];

//     // Check if the username already exists
//     $sql_check = "SELECT * FROM garages_login WHERE g_mob='$mobile'";
//     $res_check = mysqli_query($conn, $sql_check);
//     if (mysqli_num_rows($res_check) > 0) {
//         // If the username already exists, show an error message
//         $_SESSION['msgf'] = "An account with this Number already exists.";
//         header("Location:login.php");
//     } else {
//         // If the username doesn't exist, insert the new user into the table
//         $hashed_password = hash('sha256', $password);
//         $sql_insert = "INSERT INTO `garages_login`(`g_name`, `g_mob`, `g_email`, `g_address`, `password`) 
//         VALUES ('$g_name', '$mobile', '$email', '$address', '$hashed_password')";
//         $res_insert = mysqli_query($conn, $sql_insert);
//         if ($res_insert == 1) {
//             header("Location:login.php");
//             $_SESSION['msgf'] = "Account created!";
//         } else {
//             echo "Error!";
//         }
//     }
// }

if (isset($_POST['btn-sub2'])) {
    register($conn);
}

function register($conn)
{
    $g_name = $_POST['gname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // Check if the mobile number already exists
    $sql_check = "SELECT * FROM call_login WHERE g_mob='$mobile'";
    $res_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($res_check) > 0) {
        // If the mobile number already exists, show an error message
        $_SESSION['msgf'] = "An account with this Number already exists.";
        header("Location: login.php");
    } else {
        // Calculate the trial end date (7 days from the registration date)
        $trialEndDate = date('Y-m-d', strtotime('+7 days'));

        // Hash the user's password
        $hashed_password = hash('sha256', $password);

        // Insert the user data into the database, including the trial end date
        $sql_insert = "INSERT INTO `call_login`(`g_name`, `g_mob`, `g_email`, `g_address`, `password`, `trial_end_date`) 
        VALUES ('$g_name', '$mobile', '$email', '$address', '$hashed_password', '$trialEndDate')";

        $res_insert = mysqli_query($conn, $sql_insert);

        if ($res_insert) {
            // Registration successful
            $_SESSION['msgf'] = "Account created! You now have a 7-days trial period.";
            header("Location: login.php");
        } else {
            // Registration failed
            echo "Error!";
        }
    }
}

////////// 3 - Month /////
if (isset($_POST['btn-3mon'])) {
    register($conn);
}

function register3mon($conn)
{
    $g_name = $_POST['gname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // Check if the mobile number already exists
    $sql_check = "SELECT * FROM call_login WHERE g_mob='$mobile'";
    $res_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($res_check) > 0) {
        // If the mobile number already exists, show an error message
        $_SESSION['msgf'] = "An account with this Number already exists.";
        header("Location: login.php");
    } else {
        // Calculate the trial end date (7 days from the registration date)
        $trialEndDate = date('Y-m-d', strtotime('+90 days'));

        // Hash the user's password
        $hashed_password = hash('sha256', $password);

        // Insert the user data into the database, including the trial end date
        $sql_insert = "INSERT INTO `call_login`(`g_name`, `g_mob`, `g_email`, `g_address`, `password`, `trial_end_date`) 
        VALUES ('$g_name', '$mobile', '$email', '$address', '$hashed_password', '$trialEndDate')";

        $res_insert = mysqli_query($conn, $sql_insert);

        if ($res_insert) {
            // Registration successful
            $_SESSION['msgf'] = "Account created! You now have a 7-day trial period.";
            header("Location: login.php");
        } else {
            // Registration failed
            echo "Error!";
        }
    }
}




////////////////Fotgot Password//////////////////////

if (isset($_POST['btn-sub3'])) {
    update_password($conn);
}

function update_password($conn)
{
    $g_mob = $_POST['g_mob']; // Assuming you have a form field for the username
    $newPassword = $_POST['password']; // Assuming you have a form field for the new password


    // Check if the username exists in the garages_login table
    $check_sql = "SELECT * FROM call_login WHERE g_mob = '$g_mob'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Username exists, hash the new password
        // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $hashed_password = hash('sha256', $newPassword); // Hash the password using SHA-256

        // Update the hashed password in the garages_login table
        $update_sql = "UPDATE call_login SET password = '$hashed_password' WHERE g_mob = '$g_mob'";
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            header("Location: login.php"); // Redirect to a success page
            $_SESSION['msg6'] = "Password Changed!!";
            exit();
        } else {
            echo "Error updating password!";
        }
    } else {
        // echo "Username not found!";
        header("location: login.php");
        $_SESSION['msg7'] = "User not found!";
    }
}


/////////////////// display messages ///////////////////////

function display_message($conn)
{
    $sql = "SELECT * FROM customermsg";
    $res = mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['msg']; ?></td>
            <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
            <td class="project-actions text-right">
                <form action="adminFunction.php" method="post">
                    <input type="hidden" name="uid" value="<?php echo $row['id']; ?>">
                    <!-- <input type="submit" class="btn btn-danger btn-sm" name="Msg-del" value="Delete"> -->
                </form>
            </td>
        </tr>

    <?php $i++;
    } ?>
    <?php }

///////////////////// count message //////////////////////

function countMessage($conn)
{
    $g_id = $_SESSION['id'];
    $sql = "select * from customermsg where g_id=$g_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}

//////////////// delete booking///////////////////////

if (isset($_POST['uid'])) {
    $_SESSION['uid'] = $_POST['uid'];
}

if (isset($_POST['Msg-del']) && isset($_POST['uid'])) {
    $id = $_POST['uid'];
    $sql = "DELETE FROM customermsg WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("location:message.php");
        $_SESSION['msg4'] = "Message Deleted!!";
    }
}


//////////////// delete Jobcard///////////////////////


if (isset($_POST['jobcard-del']) && isset($_POST['uid'])) {
    $id = $_POST['uid'];
    $sql = "DELETE FROM customermsg WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("location:message.php");
        $_SESSION['msg4'] = "Message Deleted!!";
    }
}

///////////////////////job card/////////////////////////////////////////





/////////////////////Remove Service////////////////////

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $serviceId = $_POST['id'];

    // Perform the deletion query
    $deleteQuery = "DELETE FROM jobcode_service_items WHERE id = $serviceId";

    // Execute the query (make sure to handle errors appropriately)
    $result = mysqli_query($conn, $deleteQuery);

    // Send a response back to the AJAX request
    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}



///////////////////////show service on admin /////////////////////////////////

function show_service($conn)
{
    $sql = "SELECT * FROM service";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) {
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <option value="<?php echo $row['service']; ?>"><?php echo $row['service']; ?></option>
        <?php  }
    }
}
function show_price($conn)
{
    $sql = "SELECT * FROM service";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) {
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <input type="text" class="form-control" name="price" value="" placeholder="Enter Price" required>
        <?php  }
    }
}

//////////////////////// update price in service table //////////////////////////

if (isset($_POST['update'])) {
    update_price($conn);
}

function update_price($conn)
{

    $id = $_POST['sid'];
    $service = $_POST['service'];
    $price = $_POST['price'];

    $sql = "UPDATE `service` SET `service`='$service', `price`='$price' WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if ($res == 1) {
        echo "Price Updated!!";
    } else {
        echo "Error!!";
    }
}

///////////////////////////////////View Details/////////////////////////////////////////////////////////



function view_details($conn)
{
    $id = $_GET['id'];

    $sql = "SELECT jc.*, av.*, cu.* FROM jobcard jc
    JOIN all_vehicle av ON jc.v_id = av.v_id
    JOIN customer cu ON av.c_id = cu.c_id
    WHERE jc.id='$id' AND cu.g_id='" . $_SESSION['id'] . "'";
    $res = mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['invoice_no']; ?></td>
            <td><?php echo $row['name']; ?> </td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['cus_email']; ?></td>
            <td><?php echo $row['c_add']; ?></td>
            <!--<td><?php echo $row['c_gst']; ?></td>-->
            <td><?php echo $row['carbrand']; ?></td>
            <td><?php echo $row['carmodel']; ?></td>
            <td><?php echo $row['fueltype']; ?></td>
            <td><?php echo $row['registration']; ?></td>
            <td><?php echo $row['engine_no']; ?></td>
            <!-- <td><?php echo $row['chassis_no']; ?></td> -->
            <td><?php echo $row['odometer']; ?></td>
            <td><?php echo $row['transmission']; ?></td>
            <td><?php echo $row['braking']; ?></td>
            <td><?php echo $row['fuelmeter']; ?>%</td>
            <!-- <td><?php echo $row['document']; ?></td> -->
            <td><?php echo $row['inventory']; ?></td>
            <td><?php echo $row['insurance_company']; ?></td>
            <td><?php echo $row['insexpiry']; ?></td>
            <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
            <td><br><img src="<?php echo implode('" alt="" style="width: 200px;"><img src="', explode(",", $row['img1'])); ?>" alt="" style="width: 200px;"></td>
            <td><br><img src="<?php echo implode('" alt="" style="width: 200px;"><img src="', explode(",", $row['img2'])); ?>" alt="" style="width: 200px;"></td>
            <td><strong><?php if ($row['work_status'] == 1) {
                            echo "Working";
                        } else {
                            echo "Complete";
                        } ?></td>
            <!--<td></a></strong><br><a class="btn btn-success float-right" href="ShowJobCard.php">Back</a></td>-->
        </tr>

    <?php $i++;
    } ?>
    <?php }



function display_jobcard($conn)
{

    $g_id = $_SESSION['id'];
    $where = "jobcard.g_id = $g_id AND customer.g_id = $g_id";

    // Check if filter is submitted, otherwise use session-stored filters
    if (isset($_POST['filter']) || isset($_POST['filter_type']) || isset($_POST['vehicle_search'])) {
        // Save filters in session
        $_SESSION['filter_type'] = $_POST['filter_type'] ?? '';
        $_SESSION['registration'] = $_POST['registration'] ?? '';
        $_SESSION['month'] = $_POST['month'] ?? date('n');
        $_SESSION['year'] = $_POST['year'] ?? date('Y');
        $_SESSION['from_date'] = $_POST['from_date'] ?? '';
        $_SESSION['to_date'] = $_POST['to_date'] ?? '';
    } else {
        // Load filters from session if available
        $_POST['filter_type'] = $_SESSION['filter_type'] ?? '';
        $_POST['registration'] = $_SESSION['registration'] ?? '';
        $_POST['month'] = $_SESSION['month'] ?? date('n');
        $_POST['year'] = $_SESSION['year'] ?? date('Y');
        $_POST['from_date'] = $_SESSION['from_date'] ?? '';
        $_POST['to_date'] = $_SESSION['to_date'] ?? '';
    }

    $filterType = $_POST['filter_type'] ?? '';
    $registration = $_POST['registration'] ?? '';

    if (!empty($registration)) {
        $where .= " AND all_vehicle.registration = '" . mysqli_real_escape_string($conn, $registration) . "'";
    } elseif (!empty($filterType)) {
        if ($filterType == "Today") {
            $today = date('Y-m-d');
            $where .= " AND DATE(jobcard.created_at) = '$today'";
        } elseif ($filterType == "month") {
            $month = $_POST['month'];
            $year = $_POST['year'];
            $where .= " AND MONTH(jobcard.created_at) = '$month' AND YEAR(jobcard.created_at) = '$year'";
        } elseif ($filterType == "custom") {
            $from = $_POST['from_date'];
            $to = $_POST['to_date'];
            if (!empty($from) && !empty($to)) {
                $where .= " AND DATE(jobcard.created_at) BETWEEN '$from' AND '$to'";
            }
        }
    } else {
        // Default: show today's jobcards if no filter is selected at all
        $today = date('Y-m-d');
        $where .= " AND DATE(jobcard.created_at) = '$today'";
    }



    $sql_1 = "SELECT 
        jobcard.*, 
        jobcard.job_card_type,
        jobcard.status,
        jobcard.totalPrice, 
        jobcard.dueamount,
        customer.cus_name, 
        customer.cus_mob, 
        all_vehicle.registration, 
        all_vehicle.carbrand, 
        all_vehicle.carmodel 
    FROM jobcard 
    JOIN customer ON jobcard.c_id = customer.c_id 
    JOIN all_vehicle ON jobcard.v_id = all_vehicle.v_id 
    WHERE $where AND jobcard.g_id = $g_id AND customer.g_id = $g_id
    ORDER BY jobcard.created_at DESC";
    $res = mysqli_query($conn, $sql_1);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr class="text-center">
            <td><?php echo $i; ?></td>
            <td><?php echo $row['job_card_type']; ?></td>
            <td><?php echo $row['carbrand']; ?><br><?php echo $row['carmodel']; ?><br><?php echo $row['registration']; ?></td>
            <td><?php echo $row['cus_name']; ?><br><?php echo $row['cus_mob']; ?></td>

            <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
            <td><strong>
                    <?php
                    if ($row['work_status'] == 1) {
                        echo "Pending";
                    } elseif ($row['work_status'] == 2) {
                        echo "Approved";
                    } elseif ($row['work_status'] == 3) {
                        echo "Working";
                    } else {
                        echo "Complete";
                    }
                    ?>

                    <?php
                    $phone = $row['cus_mob'];
                    $name = $row['name'];
                    $user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
                    $carModel = $row['carmodel'];
                    $jobCardLink = "https://https://otodigital.store/gmsqatar/jobcard_approvel.php?id=" . $row['id'];
                    $gMob = isset($_SESSION['g_mob']) ? $_SESSION['g_mob'] : '';
                    $gAddress = isset($_SESSION['g_address']) ? $_SESSION['g_address'] : '';
                    $message = "Job Card Approval: Dear, $name I hope this message finds you well. This is $user. 
 We would like to inform you that your $carModel is due for routine maintenance service.Please approve your Job Card through this link: 
 $jobCardLink Our team of certified technicians is ready to provide the necessary services after your approval. We take pride in delivering high-quality service to our valued customers,
 and your satisfaction is our top priority..!Best regards,$user Contact: $gMob Address: $gAddress";
                    $whatsappLink = "$message";
                    ?>
                </strong>
            </td>
            <td class="text-center" style="white-space: nowrap;">
                <a class="btn fas fa-envelope" style="font-size: 3em; color: orange;" href="jobcard-approvel.php?id=<?php echo $row['id']; ?>" title="Send Jobcard Approvel On Mail"></a>
                <a href="https://api.whatsapp.com/send/?phone=%2B91<?php echo $row['cus_mob']; ?>&text=Job Card Approval: Dear <?php echo $row['name']; ?>,I hope this message finds you well. This is <?php if (isset($_SESSION['user'])) {
                                                                                                                                                                                                            echo $_SESSION['user'];
                                                                                                                                                                                                        }; ?>. We would like to inform you that your <?php echo $row['carmodel']; ?> is due for routine maintenance service.                                                               Please approve your Job Card through this link: [Job Card Approval Link]: https://merigarage.com/GarageAdmin/jobcard_approvel.php?id=<?php echo $row['id']; ?>

                Our team of certified technicians is ready to provide the necessary services after your approval. We take pride in delivering high-quality service to our valued customers, and your satisfaction is our top priority..! Best regards,<?php if (isset($_SESSION['user'])) {
                                                                                                                                                                                                                                                            echo $_SESSION['user'];
                                                                                                                                                                                                                                                        }; ?> Contact: <?php if (isset($_SESSION['user'])) {
                                                                                                                                                                                                                                                                            echo $_SESSION['g_mob'];
                                                                                                                                                                                                                                                                        }; ?> 
                Address: <?php if (isset($_SESSION['user'])) {
                                echo $_SESSION['g_address'];
                            }; ?>
                &type=phone_number&app_absent=0" class="btn fab fa-whatsapp" style="font-size: 3em; color: green;" title="Send Jobcard Approvel On WhatsApp" target="_blank"></a>

                <input type="text" value="<?php echo $whatsappLink; ?>" id="whatsappMessage" style="position: absolute; left: -9999px;">
                <button onclick="copyWhatsAppMessage()" class="btn" style="font-size: 1em; background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" title="Copy WhatsApp Message Link">
                    Copy Link
                </button>

                <!-- <a class="btn btn-success" href="service-reminder.php?id=<?php echo $row['id']; ?>" title="Send Service Reminder">Reminder</a> -->
                <!-- <a href="https://wa.me/+91<?php echo $row['contact']; ?>" class="btn btn-primary" title="Send WhatsApp Message" target="_blank">WhatsApp</a> -->
                <!-- <a class="btn btn-warning" href="send_invoice.php?id=<?php echo $row['id']; ?>" title="Send Invoice">Send</a> -->
            </td>

            <td class="text-center">
                <?php if ($row['work_status'] == 3): ?>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $row['uid']; ?>">
                        <input type="hidden" name="g_id" value="<?php echo $row['g_id']; ?>">
                        <input type="hidden" name="uid" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="u_name" value="<?php echo $row['cus_name']; ?>">
                        <input type="hidden" name="u_contact" value="<?php echo $row['cus_mob']; ?>">
                        <input type="hidden" name="status" value="<?php echo $row['work_status']; ?>">
                        <input type="submit" value="Mark Done" name="btn-proccess" class="btn btn-danger">
                    </form>
                <?php elseif ($row['work_status'] == 0): ?>
                    <a class="btn btn-primary" href="invoice.php?id=<?php echo $row['id']; ?>">Invoice &#128194;</a>
                <?php elseif ($row['work_status'] == 1): ?>
                    <h6>Approval Pending</h6>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $row['uid']; ?>">
                        <input type="hidden" name="g_id" value="<?php echo $row['g_id']; ?>">
                        <input type="hidden" name="uid" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="u_name" value="<?php echo $row['cus_name']; ?>">
                        <input type="hidden" name="u_contact" value="<?php echo $row['cus_mob']; ?>">
                        <input type="hidden" name="status" value="<?php echo $row['work_status']; ?>">
                        <input type="submit" value="Self-Approve" name="btn-self-approve" class="btn btn-warning">
                    </form>
                <?php elseif ($row['work_status'] == 2): ?>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $row['uid']; ?>">
                        <input type="hidden" name="g_id" value="<?php echo $row['g_id']; ?>">
                        <input type="hidden" name="uid" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="u_name" value="<?php echo $row['cus_name']; ?>">
                        <input type="hidden" name="u_contact" value="<?php echo $row['cus_mob']; ?>">
                        <input type="hidden" name="status" value="<?php echo $row['work_status']; ?>">
                        <input type="submit" value="Start Job" name="btn-start" class="btn btn-success">
                    </form>
                <?php endif; ?>
            </td>

            <td>
                <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                    <?php if ($row['status'] == 'P') { ?>
                        <span class="badge bg-danger text-dark">Due</span>
                    <?php } else { ?>
                        <span class="badge bg-success">Paid</span>
                    <?php } ?>
                    <?php if ($row['status'] == 'P') { ?>
                        <select name="payment_status" class="form-select form-select-sm" style="width: auto;" onchange="handlePaymentStatusChange(this, <?php echo $row['id']; ?>)">
                            <option value="">Select</option>
                            <option value="paid">Paid</option>
                            <option value="partial">Partial Paid</option>
                        </select>
                    <?php } ?>
                    <a href="paymenthistory.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-success">History</a>
                </div>
            </td>

            <!-- Modal -->
            <div id="partialPaidModal" style="display:none; position:fixed; top:30%; left:40%; background:#fff; padding:20px; border:1px solid #ccc; z-index:1000;">
                <h3>Due Amount : <span id="dueAmountText"></span></h3>
                <div>&nbsp;</div>
                <h6>Enter Due Amount</h6>
                <input type="number" id="amount" class="form-control" placeholder="Enter amount">
                <input type="hidden" id="jobcardId">
                <br>
                <button onclick="submitamount()" class="btn btn-success">Submit</button>
                <button onclick="closeModal()" class="btn btn-secondary">Cancel</button>
            </div>

            <!-- Background overlay -->
            <div id="modalOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;"></div>


            <script>
                function handlePaymentStatusChange(selectElement, jobcardId) {
                    var value = selectElement.value;

                    if (value === "paid") {
                        fetch('update_status.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'action=markPaid&id=' + jobcardId
                            })
                            .then(response => response.text())
                            .then(data => {
                                alert("Marked as paid!");
                                location.reload();
                            });
                    } else if (value === "partial") {
                        // Fetch dueamount using AJAX
                        fetch('due-amount.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'id=' + jobcardId
                            })
                            .then(response => response.text())
                            .then(dueAmount => {
                                document.getElementById('partialPaidModal').style.display = 'block';
                                document.getElementById('modalOverlay').style.display = 'block';
                                document.getElementById('jobcardId').value = jobcardId;
                                document.getElementById('dueAmountText').textContent = dueAmount;
                            });
                    }
                }



                function submitamount() {
                    var amount = document.getElementById('amount').value;
                    var jobcardId = document.getElementById('jobcardId').value;

                    if (amount === '' || amount <= 0) {
                        alert("Please enter a valid amount.");
                        return;
                    }

                    fetch('update_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'action=partialPaid&id=' + jobcardId + '&amount=' + amount
                        })
                        .then(response => response.text())
                        .then(data => {
                            alert("Partial payment recorded!");
                            closeModal();
                            location.reload();
                        });
                }


                function closeModal() {
                    document.getElementById('partialPaidModal').style.display = 'none';
                    document.getElementById('modalOverlay').style.display = 'none';
                    document.getElementById('amount').value = '';
                }
            </script>

            <td>
                <select class="dropdown-select1 text-center" name="mechanic" data-job-id="<?php echo $row['uid']; ?>" style="background-color: white; border: 1px solid black; border-radius: 10%;">
                    <option value="0">Select One</option> <!-- New row -->
                    <?php
                    // $g_id= $_SESSION['id'];
                    // Fetch executives from the database and populate the dropdown
                    $mechanicSql = "SELECT * FROM all_mechanics WHERE g_id = $g_id";
                    $mechanicRes = mysqli_query($conn, $mechanicSql);
                    while ($mechanicRow = mysqli_fetch_assoc($mechanicRes)) {
                        $selected = ($row['id'] == $mechanicRow['id']) ? "selected" : "";
                        echo "<option value='" . $mechanicRow['id'] . "' " . ($row['m_id'] == $mechanicRow['id'] ? "selected" : "") . ">" . $mechanicRow['m_name'] . "</option>";
                    }
                    ?>
                </select>
            </td>

            <!-- <a class="btn btn-success" href="send_invoice.php?id=<?php echo $row['id']; ?>">Send</a> -->
            <td>
                <a class="btn" href="viewdetail.php?id=<?php echo $row['id']; ?>" title="View All details">&#128065;</a>
                <?php if ($row['status'] == 'C') { ?>
                    <a href="#" class="btn" onclick="alert('You cannot edit this job card'); return false;">&#9998;</a>
                <?php } else { ?>
                    <a class="btn" href="editjobcard.php?id=<?php echo $row['id']; ?>" title="Edit Jobcard">&#9998;</a>
                <?php } ?>
                <a class="btn" href="delete_jobcard.php?id=<?php echo $row['id']; ?>" title="Delete Jobcard"> &#128465; </a>
            </td>
            <!-- <td class="text-center">
                <a class="btn btn-success" href="service-reminder.php?id=<?php echo $row['id']; ?>" title="Send Service Reminder">Reminder</a>
                <a href="https://wa.me/+91<?php echo $row['contact']; ?>" class="btn btn-primary" title="Send WhatsApp Message" target="_blank">WhatsApp</a>
                <a class="btn btn-warning" href="send_invoice.php?id=<?php echo $row['id']; ?>" title="Send Invoice">Send</a>
                <a class="btn btn-secondary" href="jobcard-approvel.php?id=<?php echo $row['id']; ?>" title="Send Jobcard Approvel">Approvel</a>
            </td> -->
        </tr>

    <?php $i++;
    } ?>
    <script>
        $(document).ready(function() {
            $('.dropdown-select1').change(function() {
                var jobId = $(this).data('job-id');
                var mechanicId = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'update_mechanic.php',
                    data: {
                        jobId: jobId,
                        mechanicId: mechanicId
                    },
                    success: function(response) {
                        // Handle success
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <?php }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btn-proccess'])) {
        $uid = $_POST['uid'];

        $update_sql = "UPDATE `jobcard` SET `work_status`=0, `completed_work_date` = CURDATE() WHERE id='$uid'";

        if (mysqli_query($conn, $update_sql)) {
            header("Location:ShowJobCard.php");
            exit(); // Exit after redirect
        }
    }

    if (isset($_POST['btn-start'])) {
        $uid = $_POST['uid'];

        $update_sql = "UPDATE `jobcard` SET `work_status`=3 WHERE id='$uid'";

        if (mysqli_query($conn, $update_sql)) {
            header("Location:ShowJobCard.php");
            exit(); // Exit after redirect
        }
    }

    if (isset($_POST['btn-self-approve'])) {
        $uid = $_POST['uid'];

        $update_sql = "UPDATE `jobcard` SET `work_status`=2 WHERE id='$uid'";

        if (mysqli_query($conn, $update_sql)) {
            header("Location:ShowJobCard.php");
            exit(); // Exit after redirect
        }
    }
}

////////////////////////approval/////////////////////////////////

function display_approvel($conn)
{
    $g_id = $_SESSION['id'];
    $sql_1 = "SELECT jobcard.*, customer.cus_name, customer.cus_mob, customer.cus_email FROM jobcard JOIN customer ON jobcard.c_id = customer.c_id WHERE jobcard.g_id = $g_id ORDER BY jobcard.created_at DESC";
    $res = mysqli_query($conn, $sql_1);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td class="text-center"><?php echo $row['cus_name']; ?></td>
            <td class="text-center"><?php echo $row['cus_mob']; ?></td>
            <td class="text-center"><?php echo $row['cus_email']; ?></td>
            <td class="text-center"><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>
            <td class="text-center"><strong><?php if ($row['work_status'] == 1) {
                                                echo "Working";
                                            } else {
                                                echo "Complete";
                                            } ?></a></strong></td>
            <!-- <td class="text-center"><strong><?php if ($row['approval_status'] == 1) {
                                                        echo "Approved";
                                                    } else {
                                                        echo "Pending";
                                                    } ?></a></strong></td> -->
            <td class="text-center">
                <a class="btn btn-info" href="jobcard-approvel.php?id=<?php echo $row['id']; ?>" title="Send Jobcard Approvel">Mail</a>
                <a href="https://api.whatsapp.com/send/?phone=%2B91<?php echo $row['cus_mob']; ?>&text=Job Card Approval:

                                    Dear <?php echo $row['name']; ?>,

                                    I hope this message finds you well. This is <?php if (isset($_SESSION['user'])) {
                                                                                    echo $_SESSION['user'];
                                                                                }; ?>. We would like to inform you that your <?php echo $row['carmodel']; ?> is due for routine maintenance service.                                                               Please approve your Job Card through this link: [Job Card Approval Link]: https://merigarage.com/GarageAdmin/jobcard_approvel.php?id=<?php echo $row['id']; ?>

                Our team of certified technicians is ready to provide the necessary services after your approval. We take pride in delivering high-quality service to our valued customers, and your satisfaction is our top priority..!                                                        Best regards,                                       <?php if (isset($_SESSION['user'])) {
                                                                                                                                                                                                                                                                                                                                                        echo $_SESSION['user'];
                                                                                                                                                                                                                                                                                                                                                    }; ?>                                                     Contact: <?php if (isset($_SESSION['user'])) {
                                                                                                                                                                                                                                                                                                                                                                                                                            echo $_SESSION['g_mob'];
                                                                                                                                                                                                                                                                                                                                                                                                                        }; ?> 
                Address: <?php if (isset($_SESSION['user'])) {
                                echo $_SESSION['g_address'];
                            }; ?>
                &type=phone_number&app_absent=0" class="btn btn-success" title="Send WhatsApp Message" target="_blank">WhatsApp</a>

                <!-- <a class="btn btn-success" href="service-reminder.php?id=<?php echo $row['id']; ?>" title="Send Service Reminder">Reminder</a> -->
                <!-- <a href="https://wa.me/+91<?php echo $row['contact']; ?>" class="btn btn-primary" title="Send WhatsApp Message" target="_blank">WhatsApp</a> -->
                <!-- <a class="btn btn-warning" href="send_invoice.php?id=<?php echo $row['id']; ?>" title="Send Invoice">Send</a> -->
            </td>
        </tr>

    <?php $i++;
    } ?>
    <?php }


////////////////////////Reminder/////////////////////////////////
function display_reminder($conn)
{
    if (!isset($_SESSION['id'])) {
        echo "<tr><td colspan='7' class='text-center'>Session not found.</td></tr>";
        return;
    }

    $g_id = $_SESSION['id'];

    $sql = "SELECT customer.cus_name, customer.cus_mob, customer.cus_email,
        jobcard.id AS jobcard_id, jobcard.created_at, jobcard.work_status,
        jobcard.carmodel, jobcard.registration, 
        MIN(jobcode_service_items.service_due_date) AS service_due_date
        FROM jobcard
        JOIN customer ON jobcard.c_id = customer.c_id
        JOIN jobcode_service_items ON jobcard.c_id = jobcode_service_items.c_id
        WHERE jobcard.g_id = $g_id
        AND jobcode_service_items.service_due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
        GROUP BY jobcode_service_items.c_id
        ORDER BY service_due_date DESC";

    $res = mysqli_query($conn, $sql);
    echo $res;
    if (!$res) {
        echo "<tr><td colspan='7' class='text-center'>SQL Error: " . mysqli_error($conn) . "</td></tr>";
        return;
    }


    if (mysqli_num_rows($res) == 0) {
        echo "<tr><td colspan='7' class='text-center'>No data present.</td></tr>";
        return;
    }

    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        $formatted_due_date = date("Y-m-d", strtotime($row['service_due_date']));
    ?>
        <tr>
            <td><?= $i++ ?></td>
            <td class="text-center"><?= $row['cus_name'] ?></td>
            <td class="text-center"><?= $row['cus_mob'] ?></td>
            <td class="text-center"><?= $row['cus_email'] ?></td>
            <td class="text-center"><?= $formatted_due_date ?></td>
            <td class="text-center"><strong><?= ($row['work_status'] == 1) ? "Working" : "Complete" ?></strong></td>
            <td class="text-center">
                <a class="btn btn-primary" href="service-reminder.php?id=<?= $row['jobcard_id'] ?>">Mail</a>
                <a class="btn btn-success"
                    href="https://api.whatsapp.com/send/?phone=%2B91<?= $row['cus_mob'] ?>&text=Hi <?= urlencode($row['cus_name']) ?>, this is <?= urlencode($_SESSION['user']) ?> from the garage. Reminder: Your <?= urlencode($row['carmodel']) ?> (Reg. No. <?= urlencode($row['registration']) ?>) is due for service. Please contact us to book your appointment. Thanks, <?= urlencode($_SESSION['user']) ?>, <?= urlencode($_SESSION['g_mob']) ?>, <?= urlencode($_SESSION['g_address']) ?>&type=phone_number&app_absent=0"
                    target="_blank">WhatsApp</a>
            </td>
        </tr>
    <?php
    }
}




///////////////////////Add garage/////////////////////////////////////////

if (isset($_POST['Add-garage'])) {

    $dir = "uploads/";
    $file1 = $dir . basename($_FILES['img1']['name']);
    move_uploaded_file($_FILES['img1']['tmp_name'], $file1);

    $name = $_POST['name'];
    $g_gst = $_POST['g_gst'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    $sql = "INSERT INTO `garages`(`g_name`,`g_gst`,`g_mob`,`g_email`,`g_address`,`state`,`city`,`img`) 
    VALUES ('$name','$g_gst','$mobile','$email','$address','$state','$city','$file1')";
    $res = mysqli_query($conn, $sql);
    if ($res == 1) {
        $app_price = "INSERT INTO `app_price`(`basic_s_car_ser_petrol`, `basic_h_car_ser_petrol`, `basic_m_car_ser_petrol`, `basic_se_car_ser_petrol`, `basic_su_car_ser_petrol`, `basic_pr_car_ser_petrol`, `basic_s1_car_ser_diesel`, `basic_s2_car_ser_diesel`, `basic_s3_car_ser_diesel`, `basic_s4_car_ser_diesel`, `basic_s5_car_ser_diesel`, `stand1`, `stand2`, `stand3`, `stand4`, `stand5`, `stand6`, `stand7`, `stand8`, `stand9`, `stand10`, `stand11`, `stand12`, `stand13`, `stand14`, `stand15`, `stand16`, `stand17`, `stand18`, `stand19`, `stand20`, `stand21`, `stand22`, `spa1`, `spa2`, `spa3`, `spa4`, `spa5`, `spa6`, `paint1`, `paint2`, `paint3`, `paint4`, `paint5`, `paint6`, `ac1`, `ac2`, `ac3`, `ac4`, `ac5`, `ac6`, `ac7`, `ac8`, `ac9`, `ac10`, `ac11`, `ac12`) 
        VALUES ('1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1')";
        $result = mysqli_query($conn, $app_price);
        if ($result == 1) {
            header("Location:login.php");
        }
    } else {
        echo "Error!!";
    }
}

/////////////////// display garage///////////////////////

function display_garage($conn)
{

    $sql = "SELECT * FROM garages";
    $res = mysqli_query($conn, $sql);

    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['g_name']; ?></td>
            <td><?php echo $row['g_email']; ?></td>
            <td><?php echo $row['g_mob']; ?></td>
            <td><img src="<?php echo $row['img']; ?>" alt="" style="width :100px"></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['g_address']; ?></td>
        </tr>

    <?php $i++;
    } ?>
    <?php }

////////////////// display App order ///////////////////////

function order($conn)
{
    $g_id = $_SESSION['id'];
    $sqll = "SELECT * FROM serviceorder WHERE g_id=$g_id ORDER BY created_at DESC";
    $res1 = mysqli_query($conn, $sqll);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res1)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['customerName']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['order_service']; ?></td>
            <td><?php echo $row['order_price']; ?></td>
            <td><?php echo $row['total_price']; ?></td>
            <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at'] . "+330 minute")); ?></td>


        </tr>
    <?php $i++;
    }
}
/////////////////////create user details//////////////////////////////////


function selectCarmodel($conn)
{
    $sql = "SELECT * FROM mericar_model";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <option value="<?php echo $row['modelTitle']; ?>"><?php echo $row['modelTitle']; ?></option>
    <?php }
}

function selectCarbrand($conn)
{
    $sql = "SELECT * FROM mericar_make";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <option value="<?php echo $row['makeTitle']; ?>"><?php echo $row['makeTitle']; ?></option>
    <?php }
}

function selectinventory($conn)
{
    $g_id = $_SESSION['id'];
    $sql = "SELECT * FROM inventory WHERE g_id = $g_id";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) { ?>
        <option value="<?php echo $row['Product']; ?>" data-part-id="<?php echo $row['id']; ?>" data-sale-price="<?php echo $row['SalePrice']; ?>" data-part-number="<?php echo $row['PartNumber']; ?>" data-hsn-code="<?php echo $row['HsnCode']; ?>" data-cgst="<?php echo $row['cgst_percentage']; ?>" data-sgst="<?php echo $row['sgst_percentage']; ?>">
            <?php echo $row['Product']; ?>
        </option>
    <?php }
}
function selectinventory2($conn)
{
    $g_id = $_SESSION['id'];
    $searchTerm = $_GET['term'];

    $sql = "SELECT * FROM inventory WHERE g_id = ? AND Product LIKE ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(['error' => $conn->error]);
        exit();
    }

    $like = "%" . $searchTerm . "%";
    $stmt->bind_param("is", $g_id, $like);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "id" => $row['Product'], // ID used by Select2 or jQuery UI autocomplete
            "label" => $row['Product'],
            "value" => $row['Product'],
            "part_id" => $row['id'],
            "sale_price" => $row['SalePrice'],
            "part_number" => $row['PartNumber'],
            "hsn_code" => $row['HsnCode'],
            "cgst" => $row['cgst_percentage'],
            "sgst" => $row['sgst_percentage']
        ];
    }

    echo json_encode($data);
    exit();
}

function selectpackage($conn)
{
    $g_id = $_SESSION['id'];
    $sql = "SELECT * FROM servicepackage WHERE g_id = $g_id";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) { ?>
        <option value="<?php echo $row['package']; ?>" data-package-id="<?php echo $row['id']; ?>" data-salep-price="<?php echo $row['packageprice']; ?>" data-discountp-price="<?php echo $row['discountprice']; ?>" data-hsnp-code="<?php echo $row['hsncode']; ?>" data-cgstp="<?php echo $row['cgst_percentage']; ?>" data-sgstp="<?php echo $row['sgst_percentage']; ?>">
            <?php echo $row['package']; ?>
        </option>
        <?php }
}



function selectpackage1($conn)
{
    $g_id = $_SESSION['id'];
    $sql = "SELECT * FROM servicepackage WHERE g_id = $g_id";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        echo '<option 
            value="' . htmlspecialchars($row['id']) . '" 
            data-package-id="' . $row['id'] . '" 
            data-package-price="' . $row['packageprice'] . '" 
            data-discount-price="' . $row['packageDiscountprice'] . '" 
            data-hsn-code="' . $row['packageHsnCode'] . '" 
            data-qty="' . $row['packageQty'] . '" 
            data-cgst="' . $row['packageCgst'] . '" 
            data-sgst="' . $row['packageSgst'] . '">
            ' . $row['package'] . '
        </option>';
    }
}





// if (isset($_POST['add_product'])) {

//     $dir = "products/";
//     $newFileName = $dir . uniqid() . '_' . basename($_FILES['Photo']['name']);
//     move_uploaded_file($_FILES['Photo']['tmp_name'], $newFileName);

//     $gid = $_SESSION['id'];
//     $pid = $_POST['pid'] ?? '';
//     $Product = $_POST['Product'];
//     $PartNumber = $_POST['PartNumber'];
//     $partHsnCode = $_POST['partHsnCode'];
//     $Category = $_POST['Category'] ?? '';
//     $Location = $_POST['Location'] ?? '';
//     $Stock = $_POST['Stock'] ?? 0;
//     $CostPrice = $_POST['CostPrice'] ?? 0;
//     $SalePrice = $_POST['SalePrice'] ?? 0;
//     $cgst = $_POST['cgst_percentage'] ?? 0;
//     $sgst = $_POST['sgst_percentage'] ?? 0;

//     $stmt = $conn->prepare("INSERT INTO inventory (g_id, pid, Product, Photo, PartNumber, HsnCode, Category, Location, Stock, CostPrice, SalePrice, cgst_percentage, sgst_percentage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("isssssssiiiii", $gid, $pid, $Product, $newFileName, $PartNumber, $partHsnCode, $Category, $Location, $Stock, $CostPrice, $SalePrice, $cgst, $sgst);

//     if ($stmt->execute()) {
//         echo 'success';
//     } else {
//         echo 'error';
//     }
// }




if (isset($_POST['add_product'])) {

    $dir = "products/";
    $file = $dir . basename($_FILES['Photo']['name']);
    move_uploaded_file($_FILES['Photo']['tmp_name'], $file);
    $gid = $_SESSION['id'];
    $pid = $_POST['pid'];
    $Product = $_POST['Product'];
    $PartNumber = $_POST['PartNumber'];
    $partHsnCode = $_POST['partHsnCode'];
    $Category = $_POST['Category'];
    $Location = $_POST['Location'];
    $Stock = $_POST['Stock'];
    $CostPrice = $_POST['CostPrice'];
    $SalePrice = $_POST['SalePrice'];
    $cgst_percentage = $_POST['cgst_percentage'];


    $sql = "INSERT INTO `inventory`(`g_id`,`pid`,`Product`,`Photo`,`PartNumber`,`HsnCode`,`Category`,`Location`,`Stock`,`CostPrice`,`SalePrice`,`cgst_percentage`) 
    VALUES ('$gid','$pid','$Product','$file','$PartNumber','$partHsnCode','$Category','$Location','$Stock','$CostPrice','$SalePrice','$cgst_percentage')";

    $res = mysqli_query($conn, $sql);

    if (isset($_POST['addinventoryfrom'])) {

        $id = mysqli_insert_id($conn); // Get the last inserted ID
        $response = array(
            "name" => $Product,
            "hsncode" => $partHsnCode,
            "CostPrice" => $CostPrice,
            "SalePrice" => $SalePrice,
            "PartNumber" => $PartNumber,
            "cgst_percentage" => $cgst_percentage,
            "sgst_percentage" => $sgst_percentage,
            "id" => $id
        );
        echo json_encode($response);
    } else {
        header("Location:parts_inventory.php");
    }
}





if (isset($_POST['add_package'])) {
    $gid = $_SESSION['id'];

    $pid = $_POST['pid'];
    $package = $_POST['package'];
    $packageprice = $_POST['packageprice'];

    $hsncode = $_POST['hsncode'];
    $stock = $_POST['stock'];
    $cgst_percentage = $_POST['cgst_percentage'];


    $sql = "INSERT INTO `servicepackage`(`g_id`,`pid`,`package`,`packageprice`,`discountprice`,`hsncode`,`stock`,`cgst_percentage`) 
    VALUES ('$gid','$pid','$package','$packageprice','$packageprice','$hsncode','$stock','$cgst_percentage')";

    $res = mysqli_query($conn, $sql);
    header("Location:service-package.php");
}

///////////////////////Add Price on google App/////////////////////////////////////////

if (isset($_POST['save_price'])) {

    // $g_id=$_POST['g_id'];
    $basic_s_car_ser_petrol = $_POST['basic_s_car_ser_petrol'];
    $basic_h_car_ser_petrol = $_POST['basic_h_car_ser_petrol'];
    $basic_m_car_ser_petrol = $_POST['basic_m_car_ser_petrol'];
    $basic_se_car_ser_petrol = $_POST['basic_se_car_ser_petrol'];
    $basic_su_car_ser_petrol = $_POST['basic_su_car_ser_petrol'];
    $basic_pr_car_ser_petrol = $_POST['basic_pr_car_ser_petrol'];
    $basic_s1_car_ser_diesel = $_POST['basic_s1_car_ser_diesel'];
    $basic_s2_car_ser_diesel = $_POST['basic_s2_car_ser_diesel'];
    $basic_s3_car_ser_diesel = $_POST['basic_s3_car_ser_diesel'];
    $basic_s4_car_ser_diesel = $_POST['basic_s4_car_ser_diesel'];
    $basic_s5_car_ser_diesel = $_POST['basic_s5_car_ser_diesel'];

    $stand1 = $_POST['stand1'];
    $stand2 = $_POST['stand2'];
    $stand3 = $_POST['stand3'];
    $stand4 = $_POST['stand4'];
    $stand5 = $_POST['stand5'];
    $stand6 = $_POST['stand6'];
    $stand7 = $_POST['stand7'];
    $stand8 = $_POST['stand8'];
    $stand9 = $_POST['stand9'];
    $stand10 = $_POST['stand10'];
    $stand11 = $_POST['stand11'];
    $stand12 = $_POST['stand12'];
    $stand13 = $_POST['stand13'];
    $stand14 = $_POST['stand14'];
    $stand15 = $_POST['stand15'];
    $stand16 = $_POST['stand16'];
    $stand17 = $_POST['stand17'];
    $stand18 = $_POST['stand18'];
    $stand19 = $_POST['stand19'];
    $stand20 = $_POST['stand20'];
    $stand21 = $_POST['stand21'];
    $stand22 = $_POST['stand22'];

    $spa1 = $_POST['spa1'];
    $spa2 = $_POST['spa2'];
    $spa3 = $_POST['spa3'];
    $spa4 = $_POST['spa4'];
    $spa5 = $_POST['spa5'];
    $spa6 = $_POST['spa6'];

    $paint1 = $_POST['paint1'];
    $paint2 = $_POST['paint2'];
    $paint3 = $_POST['paint3'];
    $paint4 = $_POST['paint4'];
    $paint5 = $_POST['paint5'];
    $paint6 = $_POST['paint6'];

    $ac1 = $_POST['ac1'];
    $ac2 = $_POST['ac2'];
    $ac3 = $_POST['ac3'];
    $ac4 = $_POST['ac4'];
    $ac5 = $_POST['ac5'];
    $ac6 = $_POST['ac6'];
    $ac7 = $_POST['ac7'];
    $ac8 = $_POST['ac8'];
    $ac9 = $_POST['ac9'];
    $ac10 = $_POST['ac10'];
    $ac11 = $_POST['ac11'];
    $ac12 = $_POST['ac12'];

    $sql = "INSERT INTO `app_price`(`basic_s_car_ser_petrol`, `basic_h_car_ser_petrol`, `basic_m_car_ser_petrol`, `basic_se_car_ser_petrol`, `basic_su_car_ser_petrol`, `basic_pr_car_ser_petrol`, `basic_s1_car_ser_diesel`, `basic_s2_car_ser_diesel`, `basic_s3_car_ser_diesel`, `basic_s4_car_ser_diesel`, `basic_s5_car_ser_diesel`, `stand1`, `stand2`, `stand3`, `stand4`, `stand5`, `stand6`, `stand7`, `stand8`, `stand9`, `stand10`, `stand11`, `stand12`, `stand13`, `stand14`, `stand15`, `stand16`, `stand17`, `stand18`, `stand19`, `stand20`, `stand21`, `stand22`, `spa1`, `spa2`, `spa3`, `spa4`, `spa5`, `spa6`, `paint1`, `paint2`, `paint3`, `paint4`, `paint5`, `paint6`, `ac1`, `ac2`, `ac3`, `ac4`, `ac5`, `ac6`, `ac7`, `ac8`, `ac9`, `ac10`, `ac11`, `ac12`) 
    VALUES ('$basic_s_car_ser_petrol','$basic_h_car_ser_petrol','$basic_m_car_ser_petrol','$basic_se_car_ser_petrol','$basic_su_car_ser_petrol','$basic_pr_car_ser_petrol','$basic_s1_car_ser_diesel','$basic_s2_car_ser_diesel','$basic_s3_car_ser_diesel','$basic_s4_car_ser_diesel','$basic_s5_car_ser_diesel','$stand1','$stand2','$stand3','$stand4','$stand5','$stand6','$stand7','$stand8','$stand9','$stand10','$stand11','$stand12','$stand13','$stand14','$stand15','$stand16','$stand17','$stand18','$stand19','$stand20','$stand21','$stand22','$spa1','$spa2','$spa3','$spa4','$spa5','$spa6','$paint1','$paint2','$paint3','$paint4','$paint5','$paint6','$ac1','$ac2','$ac3','$ac4','$ac5','$ac6','$ac7','$ac8','$ac9','$ac10','$ac11','$ac12')";
    $res = mysqli_query($conn, $sql);
    if ($res == 1) {
        header("Location:change_price.php");
    } else {
        echo "Error!!";
    }
}

////////////////// update App Price ///////////////////////

if (isset($_POST['update_price'])) {
    update_app_price($conn);
}

function update_app_price($conn)
{

    $G_id = $_SESSION['id'];
    $basic_s_car_ser_petrol = $_POST['basic_s_car_ser_petrol'];
    $basic_h_car_ser_petrol = $_POST['basic_h_car_ser_petrol'];
    $basic_m_car_ser_petrol = $_POST['basic_m_car_ser_petrol'];
    $basic_se_car_ser_petrol = $_POST['basic_se_car_ser_petrol'];
    $basic_su_car_ser_petrol = $_POST['basic_su_car_ser_petrol'];
    $basic_pr_car_ser_petrol = $_POST['basic_pr_car_ser_petrol'];
    $basic_s1_car_ser_diesel = $_POST['basic_s1_car_ser_diesel'];
    $basic_s2_car_ser_diesel = $_POST['basic_s2_car_ser_diesel'];
    $basic_s3_car_ser_diesel = $_POST['basic_s3_car_ser_diesel'];
    $basic_s4_car_ser_diesel = $_POST['basic_s4_car_ser_diesel'];
    $basic_s5_car_ser_diesel = $_POST['basic_s5_car_ser_diesel'];

    $stand1 = $_POST['stand1'];
    $stand2 = $_POST['stand2'];
    $stand3 = $_POST['stand3'];
    $stand4 = $_POST['stand4'];
    $stand5 = $_POST['stand5'];
    $stand6 = $_POST['stand6'];
    $stand7 = $_POST['stand7'];
    $stand8 = $_POST['stand8'];
    $stand9 = $_POST['stand9'];
    $stand10 = $_POST['stand10'];
    $stand11 = $_POST['stand11'];
    $stand12 = $_POST['stand12'];
    $stand13 = $_POST['stand13'];
    $stand14 = $_POST['stand14'];
    $stand15 = $_POST['stand15'];
    $stand16 = $_POST['stand16'];
    $stand17 = $_POST['stand17'];
    $stand18 = $_POST['stand18'];
    $stand19 = $_POST['stand19'];
    $stand20 = $_POST['stand20'];
    $stand21 = $_POST['stand21'];
    $stand22 = $_POST['stand22'];

    $spa1 = $_POST['spa1'];
    $spa2 = $_POST['spa2'];
    $spa3 = $_POST['spa3'];
    $spa4 = $_POST['spa4'];
    $spa5 = $_POST['spa5'];
    $spa6 = $_POST['spa6'];

    $paint1 = $_POST['paint1'];
    $paint2 = $_POST['paint2'];
    $paint3 = $_POST['paint3'];
    $paint4 = $_POST['paint4'];
    $paint5 = $_POST['paint5'];
    $paint6 = $_POST['paint6'];

    $ac1 = $_POST['ac1'];
    $ac2 = $_POST['ac2'];
    $ac3 = $_POST['ac3'];
    $ac4 = $_POST['ac4'];
    $ac5 = $_POST['ac5'];
    $ac6 = $_POST['ac6'];
    $ac7 = $_POST['ac7'];
    $ac8 = $_POST['ac8'];
    $ac9 = $_POST['ac9'];
    $ac10 = $_POST['ac10'];
    $ac11 = $_POST['ac11'];
    $ac12 = $_POST['ac12'];

    $sql = "UPDATE `app_price` SET `basic_s_car_ser_petrol`='$basic_s_car_ser_petrol',`basic_h_car_ser_petrol`='$basic_h_car_ser_petrol',`basic_m_car_ser_petrol`='$basic_m_car_ser_petrol',`basic_se_car_ser_petrol`='$basic_se_car_ser_petrol',`basic_su_car_ser_petrol`='$basic_su_car_ser_petrol',`basic_pr_car_ser_petrol`='$basic_pr_car_ser_petrol',
    `basic_s1_car_ser_diesel`='$basic_s1_car_ser_diesel',`basic_s2_car_ser_diesel`='$basic_s2_car_ser_diesel',`basic_s3_car_ser_diesel`='$basic_s3_car_ser_diesel',`basic_s4_car_ser_diesel`='$basic_s4_car_ser_diesel',`basic_s5_car_ser_diesel`='$basic_s5_car_ser_diesel',`stand1`='$stand1',`stand2`='$stand2',`stand3`='$stand3',`stand4`='$stand4',
    `stand5`='$stand5',`stand6`='$stand6',`stand7`='$stand7',`stand8`='$stand8',`stand9`='$stand9',`stand10`='$stand10',`stand11`='$stand11',`stand12`='$stand12',`stand13`='$stand13',`stand14`='$stand14',`stand15`='$stand15',`stand16`='$stand16',`stand17`='$stand17',`stand18`='$stand18',`stand19`='$stand19',`stand20`='$stand20',`stand21`='$stand21',
    `stand22`='$stand22',`spa1`='$spa1',`spa2`='$spa2',`spa3`='$spa3',`spa4`='$spa4',`spa5`='$spa5',`spa6`='$spa6',`paint1`='$paint1',`paint2`='$paint2',`paint3`='$paint3',`paint4`='$paint4',`paint5`='$paint5',`paint6`='$paint6',`ac1`='$ac1',`ac2`='$ac2',`ac3`='$ac3',`ac4`='$ac4',`ac5`='$ac5',`ac6`='$ac6',`ac7`='$ac7',`ac8`='$ac8',`ac9`='$ac9',
    `ac10`='$ac10',`ac11`='$ac11',`ac12`='$ac12' WHERE g_id='$G_id'";
    $res = mysqli_query($conn, $sql);
    if ($res == 1) {
        header("Location:change_price.php");
    } else {
        echo "Error!!";
    }
}



////////////////////////Subscription-Part//////////////////////////////////

////////////////////////3-month//////////////////////////////////////

if (isset($_POST['btn-verify3'])) {
    // Check if the 'g_mob' key exists in the $_POST array
    if (isset($_POST['g_mob'])) {
        // Capture the mobile number from the POST data
        $mobileNumber = $_POST['g_mob'];

        // Call the function with the sanitized mobile number
        verifyMobile($conn, $mobileNumber);
    } else {
        // Handle the case where 'g_mob' is not set in $_POST
        echo "Mobile number not provided.";
    }
}

function verifyMobile($conn, $mobileNumber)
{
    // Sanitize the input to prevent SQL injection
    $mobileNumber = mysqli_real_escape_string($conn, $mobileNumber);

    $query = "SELECT * FROM call_login WHERE g_mob = '$mobileNumber'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Mobile number exists, update trail_end_date and insert into 'sales' table
        $row = $result->fetch_assoc();
        $currentDate = date('Y-m-d');
        $newTrailEndDate = date('Y-m-d', strtotime($row['trial_end_date'] . ' + 90 days'));

        // Update 'call_login' table
        $updateQuery = "UPDATE call_login SET trial_end_date = '$newTrailEndDate' WHERE g_mob = '$mobileNumber'";
        $conn->query($updateQuery);

        // Insert into 'sales' table
        $g_id = $row['g_id'];
        $g_name = $row['g_name'];
        $payment_for = '3 Months';
        $price = '1499'; // You can modify this as needed
        $expiry = $newTrailEndDate;

        $insertQuery = "INSERT INTO sales (g_id, g_name, g_mob, payment_for, price, expiry) VALUES ('$g_id', '$g_name', '$mobileNumber', '$payment_for', '$price', '$expiry')";
        $conn->query($insertQuery);

        echo '<script type="text/JavaScript">';
        echo 'alert("Thanks For Your Verification!! Now You Can Login..");';
        echo 'window.location= "login.php";';
        echo '</script>';
        exit();
    } else {
        echo '<script type="text/JavaScript">';
        echo 'alert("Please check your number. It should be the same as the TRIAL VERSION");';
        echo 'window.location= "3_months_subscription.php";';
        echo '</script>';
    }
}


////////////////////////6-month//////////////////////////////////////

if (isset($_POST['btn-verify6'])) {
    // Check if the 'g_mob' key exists in the $_POST array
    if (isset($_POST['g_mob'])) {
        // Capture the mobile number from the POST data
        $mobileNumber = $_POST['g_mob'];

        // Call the function with the sanitized mobile number
        verifyMobile6($conn, $mobileNumber);
    } else {
        // Handle the case where 'g_mob' is not set in $_POST
        echo "Mobile number not provided.";
    }
}

function verifyMobile6($conn, $mobileNumber)
{
    // Sanitize the input to prevent SQL injection
    $mobileNumber = mysqli_real_escape_string($conn, $mobileNumber);

    $query = "SELECT * FROM call_login WHERE g_mob = '$mobileNumber'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Mobile number exists, update trail_end_date and insert into 'sales' table
        $row = $result->fetch_assoc();
        $currentDate = date('Y-m-d');
        $newTrailEndDate = date('Y-m-d', strtotime($row['trial_end_date'] . ' + 180 days'));

        // Update 'call_login' table
        $updateQuery = "UPDATE call_login SET trial_end_date = '$newTrailEndDate' WHERE g_mob = '$mobileNumber'";
        $conn->query($updateQuery);

        // Insert into 'sales' table
        $g_id = $row['g_id'];
        $g_name = $row['g_name'];
        $payment_for = '6 Months';
        $price = '2699'; // You can modify this as needed
        $expiry = $newTrailEndDate;

        $insertQuery = "INSERT INTO sales (g_id, g_name, g_mob, payment_for, price, expiry) VALUES ('$g_id', '$g_name', '$mobileNumber', '$payment_for', '$price', '$expiry')";
        $conn->query($insertQuery);

        echo '<script type="text/JavaScript">';
        echo 'alert("Thanks For Your Verification!! Now You Can Login..");';
        echo 'window.location= "login.php";';
        echo '</script>';
        exit();
    } else {
        echo '<script type="text/JavaScript">';
        echo 'alert("Please check your number. It should be the same as the TRIAL VERSION");';
        echo 'window.location= "3_months_subscription.php";';
        echo '</script>';
    }
}
////////////////////////1-year//////////////////////////////////////

if (isset($_POST['btn-verify12'])) {
    // Check if the 'g_mob' key exists in the $_POST array
    if (isset($_POST['g_mob'])) {
        // Capture the mobile number from the POST data
        $mobileNumber = $_POST['g_mob'];

        // Call the function with the sanitized mobile number
        verifyMobile12($conn, $mobileNumber);
    } else {
        // Handle the case where 'g_mob' is not set in $_POST
        echo "Mobile number not provided.";
    }
}

function verifyMobile12($conn, $mobileNumber)
{
    // Sanitize the input to prevent SQL injection
    $mobileNumber = mysqli_real_escape_string($conn, $mobileNumber);

    $query = "SELECT * FROM call_login WHERE g_mob = '$mobileNumber'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Mobile number exists, update trail_end_date and insert into 'sales' table
        $row = $result->fetch_assoc();
        $currentDate = date('Y-m-d');
        $newTrailEndDate = date('Y-m-d', strtotime($row['trial_end_date'] . ' + 360 days'));

        // Update 'call_login' table
        $updateQuery = "UPDATE call_login SET trial_end_date = '$newTrailEndDate' WHERE g_mob = '$mobileNumber'";
        $conn->query($updateQuery);

        // Insert into 'sales' table
        $g_id = $row['g_id'];
        $g_name = $row['g_name'];
        $payment_for = '1 year';
        $price = '4599'; // You can modify this as needed
        $expiry = $newTrailEndDate;

        $insertQuery = "INSERT INTO sales (g_id, g_name, g_mob, payment_for, price, expiry) VALUES ('$g_id', '$g_name', '$mobileNumber', '$payment_for', '$price', '$expiry')";
        $conn->query($insertQuery);

        echo '<script type="text/JavaScript">';
        echo 'alert("Thanks For Your Verification!! Now You Can Login..");';
        echo 'window.location= "login.php";';
        echo '</script>';
        exit();
    } else {
        echo '<script type="text/JavaScript">';
        echo 'alert("Please check your number. It should be the same as the TRIAL VERSION");';
        echo 'window.location= "3_months_subscription.php";';
        echo '</script>';
    }
}




///////////////////////Edit garage details/////////////////////////////////////////

if (isset($_POST['edit-details'])) {
    $dir = "uploads/";
    $file1 = $dir . basename($_FILES['img']['name']);
    move_uploaded_file($_FILES['img']['tmp_name'], $file1);
    $file2 = $dir . basename($_FILES['qrcode']['name']);
    move_uploaded_file($_FILES['qrcode']['tmp_name'], $file2);

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gst = $_POST['gst'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    // Assuming you have a session variable named g_id
    $g_id = $_SESSION['id'];

    // Check if the record exists
    $checkSql = "SELECT * FROM `call_login` WHERE `g_id` = '$g_id'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Record exists, perform update
        $updateSql = "UPDATE `call_login` SET 
            `g_name` = '$name',
            `g_mob` = '$mobile',
            `g_email` = '$email',
            `g_gst` = '$gst',
            `g_address` = '$address',
            `state` = '$state',
            `city` = '$city',
            `img` = '$file1',
            `qrcode` = '$file2'
            WHERE `g_id` = '$g_id'";

        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            echo '<script type="text/JavaScript">';
            echo 'alert("Profile Updated Successfully");';
            echo 'window.location= "login.php";';
            echo '</script>';
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    } else {
        echo "Record not found for g_id: $g_id";
    }
}


////////////////////////inventory Part///////////////////////////

////////////////////////Display Product///////////////////////////

if (isset($_SESSION['id'])) {
    function display_inventory($conn, $g_id)
    {
        $g_id = $_SESSION['id'];

        $sql = "SELECT * FROM inventory where g_id=$g_id ORDER BY ProductAdded DESC";
        $res = mysqli_query($conn, $sql);

        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr style="background-color: <?php echo ($row['Stock'] < 5) ? '#ffcccc' : 'transparent'; ?>">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['Product']; ?></td>
                <td><img src="<?php echo $row['Photo']; ?>" alt="" style="width: 70px;"></td>
                <td><?php echo $row['PartNumber']; ?></td>
                <td><?php echo $row['HsnCode']; ?></td>
                <td><?php echo $row['Category']; ?></td>
                <td><?php echo $row['Location']; ?></td>
                <td><?php echo $row['Stock']; ?></td>
                <td>ر.ق<?php echo $row['CostPrice']; ?></td>
                <td>ر.ق<?php echo $row['SalePrice']; ?></td>
                <td><?php echo $row['ProductAdded']; ?></td>
                <td>
                    <a class="btn" href="edit_stock.php?id=<?php echo $row['id']; ?>" title="Edit"> &#9998; </a>
                    <a class="btn" href="delete_product.php?id=<?php echo $row['id']; ?>" title="Delete Product"> &#128465; </a>
                </td>
            </tr>

        <?php $i++;
        } ?>
        <?php }
}

//////////////////////////////////Add Product///////////////////////////////


//-----------------------------------Service Package------------------------------//

if (isset($_SESSION['id'])) {
    function display_servicepackage($conn, $g_id)
    {
        $g_id = $_SESSION['id'];

        $sql = "SELECT * FROM servicepackage where g_id=$g_id ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);

        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['package']; ?></td>
                <td><?php echo $row['packageprice']; ?></td>
                <td><?php echo $row['hsncode']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td><?php echo $row['cgst_percentage']; ?></td>

                <td>
                    <!--<a class="btn" href="add_stock.php?id=<?php echo $row['id']; ?>" title="Add Stock" >&#10133;</a>-->
                    <a class="btn" href="edit-package.php?id=<?php echo $row['id']; ?>" title="Edit"> &#9998; </a>
                    <a class="btn" href="delete_package.php?id=<?php echo $row['id']; ?>" title="Delete Package"> &#128465; </a>
                </td>
            </tr>

        <?php $i++;
        } ?>
        <?php }
}

//----------------------------------------end-------------------------------
if (isset($_POST['add_stock'])) {
    add_stock($conn);
}

function add_stock($conn)
{
    $id = $_POST['id']; // Add this line to get the id from the form submission
    $g_id = $_POST['g_id'];
    $stock = $_POST['Stock'];
    $stockNew = $_POST['Stocknew'];

    // Calculate the new stock value
    $newStock = $stock + $stockNew;

    // Check if the id exists in the inventory table
    $check_sql = "SELECT * FROM inventory WHERE id = '$id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $update_sql = "UPDATE inventory SET Stock = '$newStock' WHERE id = '$id'";
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            echo '<script type="text/JavaScript">';
            echo 'alert("Stock Added");';
            echo 'window.location= "parts_inventory.php";';
            echo '</script>';
        } else {
            echo "Error updating Product!";
        }
    } else {
        // echo "Id not found!";
        header("location: parts_inventory.php");
    }
}


/////////////////////////Add Stock////////////////////////////////////////////

if (isset($_POST['update_product'])) {
    update_product($conn);
}

function update_product($conn)
{

    $dir = "products/";
    $file = $dir . basename($_FILES['Photo']['name']);
    move_uploaded_file($_FILES['Photo']['tmp_name'], $file);
    $id = $_POST['id'];
    $gid = $_POST['g_id'];  // Fetch values from $_POST
    $Product = $_POST['Product'];
    // $Photo = $_POST['Photo'];
    $PartNumber = $_POST['PartNumber'];
    $partHsnCode = $_POST['partHsnCode'];
    $Category = $_POST['Category'];
    $Location = $_POST['Location'];
    $Stock = $_POST['Stock'];
    $CostPrice = $_POST['CostPrice'];
    $SalePrice = $_POST['SalePrice'];
    $cgst_percentage = $_POST['cgst_percentage'];


    // Check if the username exists in the garages_login table
    $check_sql = "SELECT * FROM inventory WHERE id = '$id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {

        $update_sql = "UPDATE inventory SET g_id = '$gid', Product = '$Product', Photo = '$file', PartNumber = '$PartNumber', HsnCode = '$partHsnCode', Category = '$Category', Location = '$Location', Stock = '$Stock', CostPrice = '$CostPrice', SalePrice = '$SalePrice', cgst_percentage = '$cgst_percentage' WHERE id = '$id'";
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            echo '<script type="text/JavaScript">';
            echo 'alert("Product Updated");';
            echo 'window.location= "parts_inventory.php";';
            echo '</script>';
        } else {
            echo "Error updating Product!";
        }
    } else {
        // echo "Username not found!";
        header("location: parts_inventory.php");
    }
}


if (isset($_POST['update_package'])) {
    update_package($conn);
}
function update_package($conn)
{


    $id = $_POST['id'];
    $gid = $_POST['g_id'];
    $package = $_POST['package'];
    $packageprice = $_POST['packageprice'];
    //$discountprice = $_POST['discountprice'];
    $hsncode = $_POST['hsncode'];
    $stock = $_POST['stock'];
    $cgst_percentage = $_POST['cgst_percentage'];
    $sgst_percentage = $_POST['sgst_percentage'];


    $check_sql = "SELECT * FROM inventory WHERE id = '$id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {

        $update_sql = "UPDATE servicepackage SET g_id = '$gid', package = '$package', packageprice = '$packageprice',
        discountprice = '$packageprice',hsncode = '$hsncode', stock = '$stock',cgst_percentage = '$cgst_percentage',sgst_percentage = '$sgst_percentage' WHERE id = '$id'";
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            echo '<script type="text/JavaScript">';
            echo 'alert("Package Updated");';
            echo 'window.location= "service-package.php";';
            echo '</script>';
        } else {
            echo "Error updating Product!";
        }
    } else {
        // echo "Username not found!";
        header("location: service-package.php");
    }
}



////////////////////////////////Upload Parts From CSV or EXCEL///////////////////////////////////////
if (isset($_POST['Import1'])) {
    if (isset($_FILES["file"]) && $_FILES["file"]["size"] > 0) {
        // Check if the selected file is a CSV file
        $fileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        if (strtolower($fileType) === 'csv') {
            upload_product($conn);
        } else {
            // Display an alert if the selected file is not a CSV
            echo "<script type=\"text/javascript\">
                    alert(\"Please select a CSV file.\");
                    window.location = \"parts_inventory.php\"
                  </script>";
        }
    } else {
        // Display an alert if no file is selected
        echo "<script type=\"text/javascript\">
                alert(\"Please select a CSV file.\");
                window.location = \"parts_inventory.php\"
              </script>";
    }
}
function upload_product($conn)
{
    $filename = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $gid = $_POST['g_id'];
            $pid = $_POST['pid'];

            // Sanitize input to prevent SQL injection
            $product = mysqli_real_escape_string($conn, $getData[0]);
            $photo = mysqli_real_escape_string($conn, $getData[1]);
            $partNumber = mysqli_real_escape_string($conn, $getData[2]);
            $category = mysqli_real_escape_string($conn, $getData[3]);
            $location = mysqli_real_escape_string($conn, $getData[4]);
            $stock = mysqli_real_escape_string($conn, $getData[5]);
            $costPrice = mysqli_real_escape_string($conn, $getData[6]);
            $salePrice = mysqli_real_escape_string($conn, $getData[7]);

            $sql = "INSERT INTO inventory(g_id, pid, Product, Photo, PartNumber, Category, Location, Stock, CostPrice, SalePrice) 
                    VALUES ('$gid', '$pid', '$product', '$photo', '$partNumber', '$category', '$location', '$stock', '$costPrice', '$salePrice')";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                // Provide detailed error message
                echo "<script type=\"text/javascript\">
                        alert(\"Invalid File: Error - " . mysqli_error($conn) . "\");
                        window.location = \"parts_inventory.php\"
                      </script>";
            } else {
                echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"parts_inventory.php\"
                      </script>";
            }
        }
    }
}

function view_reminders($conn)
{
    $sql = "SELECT jc.*, av.*, cu.* FROM jobcard jc
    JOIN all_vehicle av ON jc.v_id = av.v_id
    JOIN customer cu ON av.c_id = cu.c_id
    WHERE jc.insexpiry != ''
    AND jc.g_id = " . $_SESSION['id'] . "
    GROUP BY jc.v_id     
    ORDER BY jc.insexpiry DESC";

    $res = mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        $date1 = date_create(date("Y-m-d"));
        $date2 = date_create($row['insexpiry']);
        $diff = date_diff($date1, $date2);
        $interval = $diff->format("%R%a");

        if ($interval <= 10) {
        ?>
            <tr class="bg-gradient-danger">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['name']; ?> </td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['cus_email']; ?></td>
                <td><?php echo $row['c_add']; ?></td>
                <td><?php echo $row['carbrand']; ?></td>
                <td><?php echo $row['carmodel']; ?></td>
                <td><?php echo $row['fueltype']; ?></td>
                <td><?php echo $row['registration']; ?></td>
                <td><?php echo $row['inventory']; ?></td>
                <td><?php echo $row['insexpiry']; ?></td>
                <td>
                    <strong>
                        <?php
                        if ($interval < 0) {
                            echo "Expired";
                        } else {
                            echo $diff->format("%a") . " days to renew";
                        }
                        ?>
                    </strong>
                </td>
                <td>
                    <a href="https://api.whatsapp.com/send/?phone=%2B91<?php echo $row['contact']; ?>&text=*Insurance Reminder:*

                    Dear customer,
                    I hope this message finds you well. This is <?= $_SESSION['user']; ?>. We would like to inform you that your motor insurance for your vehicle <?php echo $row['carbrand']; ?> <?php echo $row['carmodel']; ?> is expiring on <?php echo $row['insexpiry']; ?>

                    Please reach out to us to help for your motor insurance renewal.

                    Our team at <?= $_SESSION['user']; ?> is always available to provide you with necessary vehicle services and care. We take pride in delivering high-quality service to our valued customers, and your satisfaction is our top priority..!

                    Best regards,

                    <?= $_SESSION['user']; ?>
                    Contact: <?= $_SESSION['g_mob']; ?>
                     Address: <?= $_SESSION['g_address']; ?>&type=phone_number&app_absent=0" class="btn fab fa-whatsapp" style="font-size: 3em; color: green;" title="Send Reminder On WhatsApp" target="_blank"></a>
                </td>
            </tr>
        <?php
            $i++;
        } elseif ($interval <= 20) {
        ?>
            <tr class="bg-gradient-warning">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['name']; ?> </td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['cus_email']; ?></td>
                <td><?php echo $row['c_add']; ?></td>
                <td><?php echo $row['carbrand']; ?></td>
                <td><?php echo $row['carmodel']; ?></td>
                <td><?php echo $row['fueltype']; ?></td>
                <td><?php echo $row['registration']; ?></td>
                <td><?php echo $row['inventory']; ?></td>
                <td><?php echo $row['insexpiry']; ?></td>
                <td>
                    <strong>
                        <?php
                        if ($interval < 0) {
                            echo "Expired";
                        } else {
                            echo $diff->format("%a") . " days to renew";
                        }
                        ?>
                    </strong>
                </td>
                <td>
                    <a href="https://api.whatsapp.com/send/?phone=%2B91<?php echo $row['contact']; ?>&text=*Insurance Reminder:*

                    Dear customer,
                    I hope this message finds you well. This is <?= $_SESSION['user']; ?>. We would like to inform you that your motor insurance for your vehicle <?php echo $row['carbrand']; ?> <?php echo $row['carmodel']; ?> is expiring on <?php echo $row['insexpiry']; ?>

                    Please reach out to us to help for your motor insurance renewal.

                    Our team at <?= $_SESSION['user']; ?> is always available to provide you with necessary vehicle services and care. We take pride in delivering high-quality service to our valued customers, and your satisfaction is our top priority..!

                    Best regards,

                    <?= $_SESSION['user']; ?>
                    Contact: <?= $_SESSION['g_mob']; ?>
                     Address: <?= $_SESSION['g_address']; ?>&type=phone_number&app_absent=0" class="btn fab fa-whatsapp" style="font-size: 3em; color: green;" title="Send Reminder On WhatsApp" target="_blank"></a>
                </td>
            </tr>
        <?php
            $i++;
        } elseif ($interval <= 30) {
        ?>
            <tr class="bg-gradient-info">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['name']; ?> </td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['cus_email']; ?></td>
                <td><?php echo $row['c_add']; ?></td>
                <td><?php echo $row['carbrand']; ?></td>
                <td><?php echo $row['carmodel']; ?></td>
                <td><?php echo $row['fueltype']; ?></td>
                <td><?php echo $row['registration']; ?></td>
                <td><?php echo $row['inventory']; ?></td>
                <td><?php echo $row['insexpiry']; ?></td>
                <td>
                    <strong>
                        <?php
                        if ($interval < 0) {
                            echo "Expired";
                        } else {
                            echo $diff->format("%a") . " days to renew";
                        }
                        ?>
                    </strong>
                </td>
                <td>
                    <a href="https://api.whatsapp.com/send/?phone=%2B91<?php echo $row['contact']; ?>&text=*Insurance Reminder:*

                    Dear customer,
                    I hope this message finds you well. This is <?= $_SESSION['user']; ?>. We would like to inform you that your motor insurance for your vehicle <?php echo $row['carbrand']; ?> <?php echo $row['carmodel']; ?> is expiring on <?php echo $row['insexpiry']; ?>

                    Please reach out to us to help for your motor insurance renewal.

                    Our team at <?= $_SESSION['user']; ?> is always available to provide you with necessary vehicle services and care. We take pride in delivering high-quality service to our valued customers, and your satisfaction is our top priority..!

                    Best regards,

                    <?= $_SESSION['user']; ?>
                    Contact: <?= $_SESSION['g_mob']; ?>
                     Address: <?= $_SESSION['g_address']; ?>&type=phone_number&app_absent=0" class="btn fab fa-whatsapp" style="font-size: 3em; color: green;" title="Send Reminder On WhatsApp" target="_blank"></a>
                </td>
            </tr>
        <?php
            $i++;
        }
        ?>
<?php
    }
}
?>