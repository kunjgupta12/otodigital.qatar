<?php
require("connection.php");
if (isset($_POST['btn-edit'])) {
    update_jobcard1($conn);
}

function update_jobcard1($conn)
{
    try {
        $conn->begin_transaction();

        $uid = $_POST['uid'];
        $g_id = $_POST['g_id'];
        $v_id = $_POST['v_id'];
        $c_id = $_POST['c_id'];

        $partIndex = $_POST['partIndex'] ?? [];
        $partName = $_POST['partName'] ?? [];
        $partPrice = $_POST['partPrice'] ?? [];
        $partDiscountPrice = $_POST['partDiscountPrice'] ?? [];
        $partNumber = $_POST['partNumber'] ?? [];
        $partHsnCode = $_POST['partHsnCode'] ?? [];
        $partQty = $_POST['partQty'] ?? [];
        $partCgst = $_POST['partCgst'] ?? [];
        $partCgstValue = $_POST['partCgstValue'] ?? [];
        $partSgst = $_POST['partSgst'] ?? [];
        $partSgstValue = $_POST['partSgstValue'] ?? [];
        $partTotal = $_POST['partTotal'] ?? [];
        $part_service_id = $_POST['part_service_id'] ?? [];
        $packageIndex = $_POST['packageIndex'] ?? [];
        $packageName = $_POST['packageName'];
        $packagePrices = $_POST['packagePrice'];

        $packageDiscountPrice = $_POST['packageDiscountPrice'];
        $packageHsnCode = $_POST['packageHsnCode'];
        $packageQty = $_POST['packageQty'];
        $packageCgst = $_POST['packageCgst'];
        $packageSgst = $_POST['packageSgst'];
        $packageTotal = $_POST['packageTotal'];
        $package_discount = $_POST['package_discount'];
        $package_service_id = $_POST['package_service_id'];

        $srno = $_POST['srno'] ?? [];
        $serviceName = $_POST['service'] ?? [];
        $ser = $_POST['price'] ?? [];
        $discounted_price = $_POST['discounted_price'] ?? [];
        $hsn = $_POST['hsn_code'] ?? [];
        $serviceCgst = $_POST['serviceCgst'] ?? [];
        $serviceCgstValue = $_POST['serviceCgstValue'] ?? [];
        $serviceSgst = $_POST['serviceSgst'] ?? [];
        $serviceSgstValue = $_POST['serviceSgstValue'] ?? [];
        $totalprice = $_POST['total'] ?? [];
        $service_id = $_POST['service_id'] ?? [];

        $job_card_type = $_POST['job_card_type'] ?? '';
        $voice_of_customer = $_POST['voice_of_customer'] ?? '';
        $instruction_of_mechanic = $_POST['instruction_of_mechanic'] ?? '';
        $job_card_no = $_POST['job_card_no'] ?? '';
        $service_due_date = $_POST['service_due_date'] ?? '';
        $part_discount = $_POST['part_discount'] ?? 0;
        $service_discount = $_POST['service_discount'] ?? 0;

        // PARTS
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



        foreach ($partIndex as $key => $value) {
            if (
                isset(
                    $partName[$key],
                    $partPrice[$key],
                    $partDiscountPrice[$key],
                    $partNumber[$key],
                    $partHsnCode[$key],
                    $partCgst[$key],
                    $partCgstValue[$key],
                    $partSgst[$key],
                    $partSgstValue[$key],
                    $partQty[$key],
                    $partTotal[$key],
                    $part_service_id[$key]
                )
            ) {
                $totalGst = floatval($partCgst[$key]) + floatval($partSgst[$key]);

                if (intval($part_service_id[$key]) === 0) {
                    $insert = "INSERT INTO jobcode_service_items 
    (p_s, g_id, c_id, v_id, uid, partname, partPrice, partDiscountPrice, part_number, parthsncode, partqty, partcgst, partsgst, parttotalpay) 
    VALUES (1, '$g_id', '$c_id', '$v_id', '$uid', '{$partName[$key]}', '{$partPrice[$key]}', '{$partDiscountPrice[$key]}', '{$partNumber[$key]}', '{$partHsnCode[$key]}',
            '{$partQty[$key]}', '{$partCgst[$key]}', '{$partSgst[$key]}', '{$partTotal[$key]}')";
                    if (!mysqli_query($conn, $insert)) throw new Exception(mysqli_error($conn));
                } else {
                    $update = "UPDATE jobcode_service_items SET 
                        service='{$partName[$key]}', price='{$partPrice[$key]}', discounted_price='{$partDiscountPrice[$key]}', part_number='{$partNumber[$key]}', hsn_code='{$partHsnCode[$key]}',
                        partcgst='{$partCgst[$key]}', partsgst='{$partSgst[$key]}', 
                        partqty='{$partQty[$key]}', parttotalpay='{$partTotal[$key]}' ,partDiscountPrice='{$partDiscountPrice[$key]}'
                        WHERE id='{$part_service_id[$key]}'";
                    if (!mysqli_query($conn, $update)) throw new Exception(mysqli_error($conn));
                }
            }
        }

        // SERVICES
        foreach ($srno as $key => $value) {
            $totalGst = floatval($serviceCgst[$key]) + floatval($serviceSgst[$key]);

            if (intval($service_id[$key]) === 0) {
                $insert = "INSERT INTO jobcode_service_items 
                    (p_s, g_id, c_id, v_id, uid, service, price, discounted_price, hsn_code, gst, cgst_percentage, cgst_value, sgst_percentage, sgst_value, total) 
                    VALUES (2, '$g_id', '$c_id', '$v_id', '$uid', '{$serviceName[$key]}', '{$ser[$key]}', '{$discounted_price[$key]}', '{$hsn[$key]}', '$totalGst', 
                            '{$serviceCgst[$key]}', '{$serviceCgstValue[$key]}', '{$serviceSgst[$key]}', '{$serviceSgstValue[$key]}', '{$totalprice[$key]}')";
                if (!mysqli_query($conn, $insert)) throw new Exception(mysqli_error($conn));
            } else {
                $update = "UPDATE jobcode_service_items SET 
                    service='{$serviceName[$key]}', price='{$ser[$key]}', discounted_price='{$discounted_price[$key]}', hsn_code='{$hsn[$key]}',
                    gst='$totalGst', cgst_percentage='{$serviceCgst[$key]}', cgst_value='{$serviceCgstValue[$key]}',
                    sgst_percentage='{$serviceSgst[$key]}', sgst_value='{$serviceSgstValue[$key]}', total='{$totalprice[$key]}'
                    WHERE id='{$service_id[$key]}'";
                if (!mysqli_query($conn, $update)) throw new Exception(mysqli_error($conn));
            }
        }

        // PACKAGES

        if (!empty($packageName[$key]) && !empty($packagePrices[$key]) && !empty($packageQty[$key])) {
            $insert = "INSERT INTO jobcode_service_items (
        g_id, c_id, v_id, uid, package, packageprice, discountprice,
        hsncode, pqty, pcgst, psgst, totalpay, p_s,
        job_card_type, voice_of_customer, instruction_of_mechanic,
        job_card_no, service_due_date
    ) VALUES (
        '$g_id', '$c_id', '$v_id', '$uid','" . $packageName[$key] . "','" . $packagePrices[$key] . "', '" . $packageDiscountPrice[$key] . "','" . $packageHsnCode[$key] . "', 
        '" . $packageQty[$key] . "','" . $packageCgst[$key] . "', '" . $packageSgst[$key] . "','" . $packageTotal[$key] . "',
        '3','" . mysqli_real_escape_string($conn, $job_card_type) . "','" . mysqli_real_escape_string($conn, $voice_of_customer) . "','" . mysqli_real_escape_string($conn, $instruction_of_mechanic) . "',
        '" . mysqli_real_escape_string($conn, $job_card_no) . "','" . mysqli_real_escape_string($conn, $service_due_date) . "'
    )";

            $res = mysqli_query($conn, $insert);
        }



        ///---------------------------------------------------------------------
        $packageQty = $_POST['packageQty'];
        $packageCgst = $_POST['packageCgst'];
        $packageSgst = $_POST['packageSgst'];
        $packageTotal = $_POST['packageTotal'];
        foreach ($packageIndex as $key => $value) {
            if($package_service_id>0){
            $update = "UPDATE jobcode_service_items SET pqty='$packageQty[$key]', pcgst='$packageCgst[$key]', psgst='$packageSgst[$key]', discountprice='$packageDiscountPrice[$key]'
                , totalpay='$packageTotal[$key]' WHERE id='$package_service_id[$key]'";}
            mysqli_query($conn, $update);
        }

        $sql1 = "UPDATE jobcode_service_items SET voice_of_customer='$voice_of_customer', instruction_of_mechanic='$instruction_of_mechanic',
                service_due_date='$service_due_date' WHERE uid =$uid";
        $res1 = mysqli_query($conn, $sql1);

      $update_jobcard_status = $conn->prepare("UPDATE jobcard SET part_discount = ?, service_discount = ?, packageDiscount = ?,status='P' ,job_card_type = ?, dueamount = ?, work_status = 1 WHERE uid = ?");
      
      $update_jobcard_status->bind_param("ddssdi", $part_discount, $service_discount, $package_discount, $job_card_type, $finalTotal, $uid);
      if (!$update_jobcard_status->execute()) {
            throw new Exception("Jobcard update failed: " . $update_jobcard_status->error);
        }

        $conn->commit();

        echo '<script>alert("Jobcard Updated Successfully"); window.location = "ShowJobCard.php";</script>';
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo 'Error: ' . $e->getMessage();
        echo $packagePrices[$key];  // Debugging

    }
}
