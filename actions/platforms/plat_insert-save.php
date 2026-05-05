<!-- FOR PLATFORM ACTION -->
<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plat_title = $_POST['txtplattitle'];

    // Validation: Ensures the title is not empty[cite: 29]
    if (!empty($plat_title)) {
        
        // Duplicate Check: Prevents adding the same platform title twice[cite: 29]
        $sql_check_title = "SELECT plat_id FROM platforms WHERE plat_title = '$plat_title'";
        $result_title = $conn->query($sql_check_title);

        if (!$result_title) {
            die("Database Query Error: " . $conn->error);
        }

        if ($result_title->num_rows > 0) {
            echo "Error: A platform with the title '" . htmlspecialchars($plat_title) . "' already exists.";
        } 
        else {
            // INSERT query: Excludes plat_id as it is auto-increment[cite: 27]
            $sql = "INSERT INTO platforms (plat_title) VALUES ('$plat_title')";

            if ($conn->query($sql)) {
                echo "New platform record inserted successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Please fill in the required field: Platform Title.";
    }
}
?>

<!-- Auto-refresh and redirect back to platforms.php after 2 seconds[cite: 29] -->
<meta http-equiv="refresh" content="2;url=../../platforms.php">