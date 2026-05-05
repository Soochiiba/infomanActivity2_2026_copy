<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize title and headquarters
    $vpub_title    = mysqli_real_escape_string($conn, $_POST['txtpub_title']);
    $vheadquarters = mysqli_real_escape_string($conn, $_POST['txtheadquarters']);
    
    // Explicitly cast to integer to ensure valid YEAR format
    // This prevents empty strings from becoming '0000' in the database
    $vyear_founded = isset($_POST['txtyear_founded']) ? (int)$_POST['txtyear_founded'] : 0;

    // Validate that the year is within the MySQL YEAR range (1901-2155)
    if (!empty($vpub_title) && $vyear_founded >= 1901 && $vyear_founded <= 2155) {
        
        // Perform duplicate check
        $sql_check = "SELECT pub_id FROM publishers WHERE pub_title = '$vpub_title'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            echo "Error: A publisher with the title '" . htmlspecialchars($vpub_title) . "' already exists.";
        } else {
            // Use the variable without single quotes if the column is numeric
            $sql = "INSERT INTO publishers (pub_title, headquarters, year_founded) 
                    VALUES ('$vpub_title', '$vheadquarters', $vyear_founded)";

            if ($conn->query($sql)) {
                echo "New publisher record inserted successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Please enter a valid year between 1901 and 2155.";
    }
}
?>
<meta http-equiv="refresh" content="2;url=../../publishers.php">