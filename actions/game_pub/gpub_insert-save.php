<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game_id = $_POST['txtgame_id'];
    $pub_id  = $_POST['txtpub_id'];

    if (!empty($game_id) && !empty($pub_id)) {
        
        // Validation: Check if this game-publisher pair already exists
        $sql_check = "SELECT gpub_id FROM game_publishing WHERE game_id = '$game_id' AND pub_id = '$pub_id'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            echo "Error: This publisher is already assigned to that game.";
        } 
        else {
            // Insert into the game_publishing table
            $sql = "INSERT INTO game_publishing (game_id, pub_id) VALUES ('$game_id', '$pub_id')";

            if ($conn->query($sql)) {
                echo "Game publishing record created successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Please select both a game and a publisher.";
    }
}
?>

<!-- Redirect back to the publishing list after 2 seconds[cite: 23] -->
<meta http-equiv="refresh" content="2;url=../../edit/edit-gamePub.php">