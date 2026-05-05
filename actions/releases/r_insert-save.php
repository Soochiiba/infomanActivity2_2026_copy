<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize data
    $game_id   = mysqli_real_escape_string($conn, $_POST['txtgame']);
    $plat_id   = mysqli_real_escape_string($conn, $_POST['txtplatform']);
    $price     = mysqli_real_escape_string($conn, $_POST['txtprice']);

    if (!empty($game_id) && !empty($plat_id) && !empty($price)) {
        
        // Check for duplicates: does this game already have a release on this platform by this publisher?[cite: 19]
        $sql_check = "SELECT rel_id FROM release_prices 
                      WHERE game_id = '$game_id' AND plat_id = '$plat_id'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            echo "<p style='color:red;'>Error: This specific release combination already exists in the database.</p>";
        } 
        else {
            // Insert into the release_prices table[cite: 19]
            $sql = "INSERT INTO release_prices (game_id, plat_id, price) 
                    VALUES ('$game_id', '$plat_id', '$price')";

            if ($conn->query($sql)) {
                echo "<p style='color:green;'>Release record added successfully!</p>";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
?>
<!-- Redirect back to the main list after 2 seconds[cite: 19] -->
<meta http-equiv="refresh" content="2;url=../../releases.php">