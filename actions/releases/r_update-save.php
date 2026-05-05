<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture data from POST
    $vrel_id  = mysqli_real_escape_string($conn, $_POST['txtrel_id']);
    $vgame_id = mysqli_real_escape_string($conn, $_POST['txtgame']);
    $vplat_id = mysqli_real_escape_string($conn, $_POST['txtplatform']);
    $vprice   = mysqli_real_escape_string($conn, $_POST['txtprice']);

    if (!empty($vrel_id) && !empty($vgame_id) && !empty($vplat_id)) {
        
        // Check if this game/platform combo already exists on a DIFFERENT record[cite: 21]
        $sql_check = "SELECT rel_id FROM release_prices 
                      WHERE game_id = '$vgame_id' AND plat_id = '$vplat_id' 
                      AND rel_id != '$vrel_id'";
        
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            echo "<script>
                    alert('Error: This game is already listed on this platform.');
                    history.back();
                  </script>";
        } else {
            // Perform the UPDATE[cite: 21]
            $sql = "UPDATE release_prices SET 
                    game_id = '$vgame_id', 
                    plat_id = '$vplat_id', 
                    price   = '$vprice'
                    WHERE rel_id = '$vrel_id'";

            if ($conn->query($sql)) {
                echo "<script>
                    alert('Release record updated successfully.');
                    window.location.href='../../releases.php';
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