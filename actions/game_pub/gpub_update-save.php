<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture data from POST
    $vgpub_id = $_POST['txtgpub_id']; 
    $vgame_id = $_POST['txtgame_id'];
    $vpub_id  = $_POST['txtpub_id'];

    if (!empty($vgpub_id) && !empty($vgame_id) && !empty($vpub_id)) {
        
        // Check if this Game-Publisher combo already exists in a DIFFERENT record[cite: 24]
        $sql_check = "SELECT gpub_id FROM game_publishing 
                      WHERE game_id = '$vgame_id' AND pub_id = '$vpub_id' 
                      AND gpub_id != '$vgpub_id'";
        
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            echo "<script>
                    alert('Error: This game is already assigned to that publisher in another record.');
                    history.back();
                  </script>";
        } else {
            // Perform the UPDATE[cite: 24]
            $sql = "UPDATE game_publishing SET 
                    game_id = '$vgame_id', 
                    pub_id = '$vpub_id'
                    WHERE gpub_id = '$vgpub_id'";

            if ($conn->query($sql)) {
                echo "<script>
                    alert('Publishing record updated successfully.');
                    window.location.href='../../edit/edit-gamePub.php';
                    </script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        echo "Required fields are missing.";
    }
}
$conn->close();
?>