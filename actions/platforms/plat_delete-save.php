<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the platform ID[cite: 22]
    $vplat_id = $_POST['txtplat_id'];

    // Validation[cite: 22]
    if (!empty($vplat_id)) {
        // Delete platform record based on primary key[cite: 22]
        $sql = "DELETE FROM platforms WHERE plat_id = '$vplat_id'";
        
        if ($conn->query($sql)) {
            echo "<script>
                alert('Platform record deleted successfully.');
                window.location.href='../../platforms.php';
                </script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error: No platform ID provided.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>