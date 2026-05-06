<?php
    require_once('../../include/conn.php');

    // Check if the publishing ID (vid) was passed through the URL
    if (isset($_GET['vid']) && !empty($_GET['vid'])) {
        
        // Sanitize the input to prevent SQL injection
        $vgpub_id = mysqli_real_escape_string($conn, $_GET['vid']);

        // SQL query to delete the specific publishing record
        $sql = "DELETE FROM game_publishing WHERE gpub_id = '$vgpub_id'";

        if ($conn->query($sql)) {
            // Use JavaScript for a confirmation alert before redirecting to game pub list
            echo "<script>
                    alert('Game publishing record deleted successfully.');
                    window.location.href='../../edit/edit-gamePub.php';
                  </script>";
        } else {
            // Display error if the deletion fails[cite: 23]
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        // Redirect back if no ID was provided[cite: 23, 24]
        header("Location: ../../edit/edit-gamePub.php");
    }

    $conn->close();
?>