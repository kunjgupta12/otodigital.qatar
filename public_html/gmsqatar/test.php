<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dual Dropdown</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<!-- Dual Dropdown -->
<div>
    <label for="serviceInput">Service/Part Name:</label>
    <div>
        
    <input type="text" id="serviceInput" placeholder="Enter Service/Part Name" style="display: none;">
        <select id="serviceDropdown" onchange="updateServiceName()">
            <option value="" selected>Select from Dropdown</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
        </select>
    </div>
</div>

<label>
<input list="browsers" name="myBrowser" /></label>
<select id="browsers">
  <option value="Chrome">1
  <option value="Firefox">2
  <option value="Internet Explorer">3
  <option value="Opera">4
  <option value="Safari">5
  <option value="Microsoft Edge">6
</select>

<script>
    // Function to update the input field based on the selected dropdown option
    function updateServiceName() {
        var selectedOption = $("#serviceDropdown").val();
        if (selectedOption === "") {
            // If "Select from Dropdown" is chosen, show the input field
            $("#serviceInput").val("").show();
        } else {
            // If a specific option is chosen, hide the input field
            $("#serviceInput").hide();
        }
    }

    // Initialize the function on page load
    $(document).ready(function () {
        updateServiceName(); // Call the function to set the initial state
    });
</script>

</body>
</html>
