<?php
require_once("connection.php");
if (!empty($_POST["coutrycode"])) {
    $query = mysqli_query($conn, "SELECT * FROM  mericar_model WHERE makeId = '" . $_POST["coutrycode"] . "'");
?>
    <option value="">Select Model</option>
    <?php
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $row["modelTitle"]; ?>"><?php echo $row["modelTitle"]; ?></option>
<?php
    }
}



?>