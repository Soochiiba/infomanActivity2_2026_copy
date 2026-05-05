<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the release ID[cite: 21]
    $vrel_id = mysqli_real_escape_string($conn, $_POST['txtrel_id']);

    // Validation[cite: 21]
    if (!empty($vrel_id)) {
        // Delete release record based on primary key[cite: 21]
        $sql = "DELETE FROM release_prices WHERE rel_id = '$vrel_id'";
        
        if ($conn->query($sql)) {
            echo "<script>
                alert('Release record deleted successfully.');
                window.location.href='../../releases.php'; // Redirect back to list[cite: 21]
                </script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error: No release ID provided.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>