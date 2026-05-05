<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the publisher ID
    $vpub_id = $_POST['txtpub_id'];

    // Validation
    if (!empty($vpub_id)) {
        // Delete record based on primary key
        $sql = "DELETE FROM publishers WHERE pub_id = $vpub_id";
        
        if ($conn->query($sql)) {
            echo "<script>
                alert('Publisher record deleted successfully.');
                window.location.href='../../publishers.php';
                </script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error: No publisher ID provided.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>