<!-- FOR GAMES ACTION -->
<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturing data from the g_insert.php form
    $gametitle    = $_POST['txtgametitle'];
    $genre        = $_POST['txtgenre'];
    $esrbrating   = $_POST['txtesrbrating'];
    $gamedesc     = $_POST['txtgamedesc'];

    // Validation: Ensures required fields are not empty[cite: 19]
    if (!empty($gametitle) && !empty($genre) && !empty($esrbrating)) {
        
        // Duplicate Check: Prevents adding the same game title twice[cite: 19]
        $sql_check_title = "SELECT game_id FROM games WHERE game_title = '$gametitle'";
        $result_title = $conn->query($sql_check_title);

        if (!$result_title) {
            die("Database Query Error: " . $conn->error);
        }

        if ($result_title->num_rows > 0) {
            echo "Error: A game with the title '" . htmlspecialchars($gametitle) . "' already exists.";
        } 
        else {
            // INSERT query: Excludes game_id because it is auto-increment[cite: 20]
            $sql = "INSERT INTO games (game_title, genre, esrb_rating, game_desc) 
                    VALUES ('$gametitle', '$genre', '$esrbrating', '$gamedesc')";

            if ($conn->query($sql)) {
                echo "New game record inserted successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Please fill in all required fields: Game Title, Genre, and ESRB Rating.";
    }
}
?>

<!-- Auto-refresh and redirect back to the main list after 2 seconds[cite: 19] -->
<meta http-equiv="refresh" content="2;url=../../games.php">