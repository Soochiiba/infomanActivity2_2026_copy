<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture data from POST[cite: 21, 23]
    $vgame_id     = $_POST['txtgame_id']; 
    $vgame_title  = $_POST['txtgame_title'];
    $vgenre       = $_POST['txtgenre'];
    $vesrb_rating = $_POST['txtesrb_rating'];
    $vgame_desc   = $_POST['txtgame_desc'];

    // Basic validation: Ensure required fields are not empty[cite: 21]
    if (!empty($vgame_id) && !empty($vgame_title) && !empty($vgenre)) {
        
        // Check if the NEW Title is already taken by a DIFFERENT game record[cite: 21, 23]
        $sql_check = "SELECT game_id FROM games 
                      WHERE game_title = '$vgame_title' 
                      AND game_id != '$vgame_id'";
        
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            echo "<script>
                    alert('Error: Another game already exists with this Title.');
                    history.back();
                  </script>";
        } else {
            // Perform the UPDATE on the games table[cite: 21, 23]
            $sql = "UPDATE games SET 
                    game_title = '$vgame_title', 
                    genre = '$vgenre', 
                    esrb_rating = '$vesrb_rating', 
                    game_desc = '$vgame_desc'
                    WHERE game_id = '$vgame_id'";

            if ($conn->query($sql)) {
                echo "<script>
                    alert('Game record updated successfully.');
                    window.location.href='../../games.php';
                    </script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        echo "Required fields are missing: Game Title and Genre are mandatory.";
    }
}
$conn->close();
?>