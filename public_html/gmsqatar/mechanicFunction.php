<?php 
require("connection.php");

/////////////////////////////////////executive_login////////////////////////////

if (isset($_POST['btn-log'])) {
    loginmec($conn);
}

function loginmec($conn)
{
    $m_mob = $_POST['m_mob'];
    $password = $_POST['password'];
    
    
    $sql = "SELECT * FROM all_mechanics WHERE m_mob='$m_mob' AND password='$password'";
    $res = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        
        $_SESSION['user'] = $row['m_name'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['g_id'] = $row['g_id'];
        $_SESSION['created_At'] = date("Y-m-d H:i:s", strtotime($row['created_At']."+330 minute"));
        $_SESSION['password'] = $row['password'];
        header("location: mechanic_dashboard.php");
        $_SESSION['msg5'] = "Welcome back!!";
    } else {
        header("location: mechanic_login.php");
        $_SESSION['msg'] = "Invalid Credentials!!";
    }
}

if(isset($_POST['btn-forgot'])){
    update_passwordmec($conn);
}

function update_passwordmec($conn){
    $m_mob = $_POST['m_mob'];
    $newPassword = $_POST['password'];
    
    $check_sql = "SELECT * FROM all_mechanics WHERE m_mob = '$m_mob'";
    $check_result = mysqli_query($conn, $check_sql);

    if(mysqli_num_rows($check_result) > 0){
        $update_sql = "UPDATE all_mechanics SET password = '$newPassword' WHERE m_mob = '$m_mob'";
        $update_result = mysqli_query($conn, $update_sql);

        if($update_result){
            header("Location: mechanic_login.php");
            $_SESSION['msg6'] = "Password Changed!!";
            exit();
        }else{
            echo "Error updating password!";
        }
    }else{
        header("location: mechanic_login.php");
        $_SESSION['msg7'] = "User not found!";
    }
}


/////////////////// display status ///////////////////////
if(isset($_SESSION['id'])){
function display_jobcard($conn)
{
    $m_id= $_SESSION['id'];
    $g_id= $_SESSION['g_id'];
    $sql_1 = "SELECT jobcard.*, customer.cus_name, customer.cus_mob, all_vehicle.carbrand, all_vehicle.carmodel, all_vehicle.registration FROM jobcard 
    JOIN customer ON jobcard.c_id = customer.c_id JOIN all_vehicle ON jobcard.v_id = all_vehicle.v_id 
    JOIN all_mechanics ON jobcard.m_id = all_mechanics.id
    WHERE jobcard.g_id = $g_id AND jobcard.m_id = $m_id ORDER BY jobcard.created_at DESC;";
    $res = mysqli_query($conn, $sql_1);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['cus_name']; ?><br><?php echo $row['cus_mob']; ?></td>
            <!-- <td></td> -->
            <td><?php echo $row['registration']; ?><br> <?php echo $row['carbrand']; ?> <?php echo $row['carmodel']; ?></td>
            <!-- <td></td> -->
            <td><?php echo date("Y-m-d H:i:s", strtotime($row['created_at']."+330 minute")); ?></td>
            <td><strong><?php if(($row['work_status']==3) || ($row['work_status']==4)|| ($row['work_status']==2)|| ($row['work_status']==1)){
                echo "Working";
            }else{ 
                echo "Complete";
            } ?></a></strong></td>
             
            <td class="text-center"><?php if(($row['work_status']==3) || ($row['work_status']==4)|| ($row['work_status']==2)|| ($row['work_status']==1)|| ($row['work_status']==0)){?>
                       <a class="btn btn-primary" href="jobcard.php?id=<?php echo $row['id'];?>">View JOBCARD</a>
                      
             <?php }
            ?></td>

        </tr>

    <?php $i++;
    } ?>
    <?php }

  if(isset($_POST['btn-proccess'])){
    $uid=$_POST['uid'];
    
    $update_sql="UPDATE `jobcard` SET `work_status`=0 WHERE id='$uid'";

    if(mysqli_query($conn,$update_sql)){
        header("Location:ShowJobCard.php");
    }
  } 

}

/////////////////// display Interior status ///////////////////////
if(isset($_SESSION['id'])){
    function display_interior_status($conn)
    { 
        $e_id = $_SESSION['id'];
        
        $sql = "SELECT cars.*, executive.e_name 
        FROM cars 
        LEFT JOIN executive ON cars.assign = executive.e_id 
        WHERE assign = $e_id AND (interior_day = DAYOFWEEK(CURDATE()) OR interior_day = 10)  -- Get the current day of the week
        ORDER BY cars.car_id ASC";
        $res = mysqli_query($conn, $sql);
        
        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <!-- <td><input type="checkbox" class="checkbox-row" data-car-id="<?php echo $row['car_id']; ?>"></td> -->
                <td><?php echo $i; ?></td>
                <td><?php echo $row['Reg_No']; ?><br><?php echo $row['Make']; ?></td>
                <td>
                <?php if($row['interior_status']==1){?> 
                
                    <form action="" id="status<?php echo $row['car_id']; ?>" method="post">
                        <input type="hidden" name="car_id" value="<?php echo $row['car_id']; ?>">
                        <input type="hidden" name="status" value="0"> <!-- Assuming 0 is for "Make Done" -->
                        <input type="file" accept="image/*" capture="camera" id="fileInput<?php echo $row['car_id']; ?>" style="display: none;" onchange="uploadPhoto<?php echo $row['car_id']; ?>()">
                        <div style="white-space: nowrap;"> <!-- Add this div for button alignment -->
                            <input type="button" class="btn btn-success" style="margin-right: 5px;" value="&#x2713;" onclick="openCamera<?php echo $row['car_id']; ?>()">
                            <input type="submit" class="btn btn-danger" style="margin-right: 5px;" name="btn-no1" value="&#10006;">
                            <input type="submit" class="btn btn-warning" style="margin-right: 5px;" name="btn-na1" value="N/A">
                        </div> 
                        <!-- Loader -->
                        <div id="loader<?php echo $row['car_id']; ?>" style="display: none;"><img src="loader.gif" alt="Loading..." /></div>
                    </form>
            <?php }else{
                if($row['interior_status']==0){?>
                       <a class="btn btn-success" href="">Completed</a> 
                <?php } elseif ($row['interior_status'] == 2) { ?>
                        <a class="btn btn-danger" href="">Not Completed</a>
                 <?php } elseif ($row['interior_status'] == 3) { ?>
                        <a class="btn btn-warning" href="">Not Available</a>
                <?php }
            }; ?> 
                </td>
                <!-- <td>
                    <?php if($row['interior_status'] == 0 || $row['interior_status'] == 2 || $row['interior_status'] == 3) { ?>
                        <form action="" method="post">
                            <input type="hidden" name="reset_car_id" value="<?php echo $row['car_id']; ?>">
                            <input type="submit" class="btn btn-primary" name="int-btn-reset" value="Reset">
                        </form>
                    <?php } ?>
                </td> -->
                <td><?php echo $row['c_name']; ?></td>
                <td><?php echo $row['c_mob']; ?></td>
            </tr>
            <script>
                function openCamera<?php echo $row['car_id']; ?>() {
                    var fileInput = document.getElementById('fileInput<?php echo $row['car_id']; ?>');
                    fileInput.click();
                }

                function uploadPhoto<?php echo $row['car_id']; ?>() {
                // Show loader
                document.getElementById('loader<?php echo $row['car_id']; ?>').style.display = 'block';

                var file = document.getElementById('fileInput<?php echo $row['car_id']; ?>').files[0];
                var formData = new FormData();
                formData.append('photo', file);
                formData.append('car_id', <?php echo $row['car_id']; ?>);
                formData.append('status', 1); // Assuming status 1 is for "Make Done"

                // AJAX request to upload photo
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'car_interior_image_upload.php', true);
                xhr.onload = function() {
                if (xhr.status === 200) {
                // Hide loader
                    document.getElementById('loader<?php echo $row['car_id']; ?>').style.display = 'none';
                    // Success
                    location.reload(); // Reload the page
                } else {
                // Error
                    console.error(xhr.responseText);
                }
                };
                    xhr.send(formData);
                }
            </script>
        <?php $i++;
        } ?>
    <?php 
    }
}

if(isset($_POST['btn-yes']) || isset($_POST['btn-no1']) || isset($_POST['btn-na1'])) {
    $car_id = $_POST['car_id'];
    $interior_status = 0; // Default value
    
    if(isset($_POST['btn-yes'])) {
        $interior_status = 0; // Make Done
    } elseif(isset($_POST['btn-no1'])) {
        $interior_status = 2; // Make No
    } elseif(isset($_POST['btn-na1'])) {
        $interior_status = 3; // Not Available
    }
    
    // Get the current interior_day value for the car
    $get_interior_day_sql = "SELECT interior_day FROM cars WHERE car_id = '$car_id'";
    $result = mysqli_query($conn, $get_interior_day_sql);
    $row = mysqli_fetch_assoc($result);
    $current_day = $row['interior_day'];
    
    // Calculate the next interior_day value
    $next_day = ($current_day % 7) + 1;

    // Update the interior_day in the cars table
    $update_day_sql = "UPDATE `cars` SET `interior_day` = $next_day WHERE car_id = '$car_id'";
    mysqli_query($conn, $update_day_sql);

    // Update the interior_status in the cars table
    $update_sql = "UPDATE `cars` SET `interior_status` = $interior_status WHERE car_id = '$car_id'";
    if(mysqli_query($conn, $update_sql)) {
        // Insert into interior_status_log table
        $insert_sql = "INSERT INTO interior_status_log (car_id, work_status) VALUES ('$car_id', '$interior_status')";
        if(mysqli_query($conn, $insert_sql)) {
            header("Location: interior_executive_status.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// if(isset($_POST['int-btn-reset'])) {
//     $reset_car_id = $_POST['reset_car_id'];
    
//     $reset_sql = "UPDATE `cars` SET `interior_status` = 1 WHERE car_id = '$reset_car_id'";
//     if(mysqli_query($conn, $reset_sql)) {
//         $delete_sql = "DELETE FROM interior_status_log WHERE car_id = '$reset_car_id' AND DATE(timestamp) = CURDATE()";
//         if(mysqli_query($conn, $delete_sql)) {
//             header("Location: interior_executive_status.php");
//         } else {
//             echo "Error: " . mysqli_error($conn);
//         }
//     } else {
//         echo "Error: " . mysqli_error($conn);
//     }
// }


////////////////////////////////////////end-Interior status//////////////////////
?>