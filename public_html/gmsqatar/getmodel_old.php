<?php
require("connection.php");
$id = $_POST['makeId'];
// var_dump($id);
$sql = "SELECT * FROM `mericar_model` WHERE `makeId` = $id ";
$result = mysqli_query($conn, $sql);
?>
<option value="">Select Model</option>

<?php 

while($row = mysqli_fetch_array($result)){
    ?>
    <option value="<?php echo $row['id']; ?>"><?php echo $row['modelTitle']; ?> </option>

    <?php
}
?>