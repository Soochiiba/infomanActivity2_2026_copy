<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the position ID
    $vpos_id = mysqli_real_escape_string($conn, $_POST['txtpos_id']);

    if (!empty($vpos_id)) {
        // Attempt to delete the record
        $sql = "DELETE FROM positions WHERE pos_id = '$vpos_id'";
        
        if ($conn->query($sql)) {
            echo "<script>
                alert('Position deleted successfully.');
                window.location.href='../../positions.php';
                </script>";
        } else {
            // Check if deletion failed due to foreign key constraints
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error: No position ID provided.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>