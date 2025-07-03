<?php
require "config.php";


// Fetch the popup image URL and popupinfo from the database
$sql = "SELECT popup_image_url, popup_info FROM pupop LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $popupImageUrl = $row['popup_image_url'];
    $popupInfo = $row['popup_info'];
} else {
    // Default values if no record is found
    $popupImageUrl = 'your-default-image.jpg';
    $popupInfo = 'Default Popup Info';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Responsive Popup</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            z-index: 999; /* Ensure the popup appears on top of other elements */
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 80%; /* Set maximum width for the popup content */
            max-height: 80vh; /* Set maximum height for the popup content */
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #fff;
            background-color: #ff4444; /* Red color for the close button */
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        @media only screen and (max-width: 768px) {
            .popup-content {
                max-width: 90%;
            }
        }
    </style>
<body>
<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <img src="<?php echo $popupImageUrl; ?>" style="height:360px; width:335px;" alt="Popup Image">
        <p><?php echo $popupInfo; ?></p>
        <button style="background-color:#ff4444;" onclick="closePopup()">CLOSE</button>
    </div>
</div>

<script src="script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    openPopup();
});

function openPopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'block';

    // Trigger a reflow before adding the 'show' class to enable the fade-in effect
    popup.offsetHeight;

    popup.style.opacity = 1;
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

</script>
</body>
</html>
