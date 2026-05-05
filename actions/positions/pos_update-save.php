<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //retrieve form data
    $vold_pos_id = $_POST['txtpos_id_hidden']; 
    $vnew_pos_id = $_POST['txtpos_id'];
    $vpos_title  = $_POST['txtpos_title'];

    // Validate
    if (!empty($vold_pos_id) && !empty($vnew_pos_id) && !empty($vpos_title)) {
        
        // 3. Check for duplicates: See if the NEW ID or Title is already used by ANOTHER record[cite: 9, 14]
        $sql_check = "SELECT pos_id FROM positions 
                      WHERE (pos_id = '$vnew_pos_id' OR pos_title = '$vpos_title') 
                      AND pos_id != '$vold_pos_id'";
        
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            echo "<script>
                    alert('Error: Another position already exists with this ID or Title.');
                    history.back();
                  </script>";
        } else {
            $sql = "UPDATE positions SET 
                    pos_id = '$vnew_pos_id', 
                    pos_title = '$vpos_title' 
                    WHERE pos_id = '$vold_pos_id'";

            if ($conn->query($sql)) {
                echo "<script>
                    alert('Position record updated successfully.');
                    window.location.href='../../positions.php';
                    </script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        echo "Required fields are missing. Please ensure both ID and Title are filled.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>