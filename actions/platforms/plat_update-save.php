<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture data from POST[cite: 20]
    $vplat_id    = $_POST['txtplat_id']; 
    $vplat_title = $_POST['txtplat_title'];

    // Basic validation[cite: 20]
    if (!empty($vplat_id) && !empty($vplat_title)) {
        
        // Check if the NEW Title is already taken by a DIFFERENT platform record[cite: 20]
        $sql_check = "SELECT plat_id FROM platforms 
                      WHERE plat_title = '$vplat_title' 
                      AND plat_id != '$vplat_id'";
        
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            echo "<script>
                    alert('Error: Another platform already exists with this title.');
                    history.back();
                  </script>";
        } else {
            // Perform the UPDATE on the platforms table[cite: 20]
            $sql = "UPDATE platforms SET 
                    plat_title = '$vplat_title'
                    WHERE plat_id = '$vplat_id'";

            if ($conn->query($sql)) {
                echo "<script>
                    alert('Platform record updated successfully.');
                    window.location.href='../../platforms.php';
                    </script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        echo "Required fields are missing: Platform Title is mandatory.";
    }
}
$conn->close();
?>