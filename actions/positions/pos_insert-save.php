<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // fetch dataa
    $vpos_title = mysqli_real_escape_string($conn, $_POST['txtpos_title']);

    // Validation: Ensure the title isn't empty
    if (!empty($vpos_title)) {
        
        // Check if this title already exists to avoid duplicates
        $sql_check = "SELECT pos_id FROM positions WHERE pos_title = '$vpos_title'";
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            echo "<script>
                    alert('Error: This position title already exists.');
                    history.back();
                  </script>";
        } 
        else {
            $sql = "INSERT INTO positions (pos_title) VALUES ('$vpos_title')";
            
            if ($conn->query($sql)) {
                echo "<script>
                    alert('New position record inserted successfully.');
                    window.location.href='../../positions.php';
                    </script>";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Please enter a Position Title.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>