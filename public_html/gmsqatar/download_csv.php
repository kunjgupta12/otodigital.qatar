<?php
// Set the correct MIME type
header('Content-Type: text/csv');

// Set filename and force download
header('Content-Disposition: attachment; filename="sample.csv"');

// Output CSV data here
// For example, if you have CSV data stored in a variable called $csv_data:
echo $csv_data;
?>
