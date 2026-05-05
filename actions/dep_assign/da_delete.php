<?php
    require_once('../../include/conn.php');

    // Check if the assignment ID (vid) was passed through the URL
    if (isset($_GET['vid']) && !empty($_GET['vid'])) {
        
        // Sanitize the input to prevent SQL injection
        $vassign_id = mysqli_real_escape_string($conn, $_GET['vid']);

        // SQL query to delete the specific assignment record
        $sql = "DELETE FROM dep_assignment WHERE assign_id = '$vassign_id'";

        if ($conn->query($sql)) {
            // Use JavaScript for a confirmation alert before redirecting
            echo "<script>
                    alert('Department assignment deleted successfully.');
                    window.location.href='../../edit/edit-depAssign.php';
                  </script>";
        } else {
            // Display error if the deletion fails[cite: 19, 22]
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        // Redirect back if no ID was provided
        header("Location: ../../edit/edit-depAssign.php");
    }

    $conn->close();
?>