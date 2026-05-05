<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize data[cite: 28]
    $vpub_id       = mysqli_real_escape_string($conn, $_POST['txtpub_id']); 
    $vpub_title    = mysqli_real_escape_string($conn, $_POST['txtpub_title']);
    $vheadquarters = mysqli_real_escape_string($conn, $_POST['txtheadquarters']);
    
    // Cast to integer to maintain YEAR data type integrity[cite: 25]
    $vyear_founded = (int)$_POST['txtyear_founded'];

    // Basic validation[cite: 28]
    if (!empty($vpub_id) && !empty($vpub_title) && $vyear_founded >= 1901) {
        
        // Check if the new title is already taken by a DIFFERENT publisher[cite: 28]
        $sql_check = "SELECT pub_id FROM publishers 
                      WHERE pub_title = '$vpub_title' 
                      AND pub_id != '$vpub_id'";
        
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            echo "<script>
                    alert('Error: Another publisher already exists with this title.');
                    history.back();
                  </script>";
        } else {
            // Perform the UPDATE[cite: 27, 28]
            $sql = "UPDATE publishers SET 
                    pub_title = '$vpub_title', 
                    headquarters = '$vheadquarters', 
                    year_founded = $vyear_founded
                    WHERE pub_id = '$vpub_id'";

            if ($conn->query($sql)) {
                echo "<script>
                    alert('Publisher record updated successfully.');
                    window.location.href='../../publishers.php';
                    </script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        echo "Required fields are missing or invalid year provided.";
    }
}
$conn->close();
?>