<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the game ID[cite: 24, 25]
    $vgame_id = $_POST['txtgame_id'];

    // Validation to ensure ID is present[cite: 25]
    if (!empty($vgame_id)) {
        // Delete game record based on primary key[cite: 24, 25]
        $sql = "DELETE FROM games WHERE game_id = '$vgame_id'";
        
        if ($conn->query($sql)) {
            echo "<script>
                alert('Game record deleted successfully.');
                window.location.href='../../games.php';
                </script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error: No Game ID provided.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>