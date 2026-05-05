<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture data from POST
    $vassign_id = $_POST['txtassign_id']; 
    $ve_id      = $_POST['txte_id'];
    $vdep_id    = $_POST['txtdep_id'];

    if (!empty($vassign_id) && !empty($ve_id) && !empty($vdep_id)) {
        
        // Check if this specific Employee-Department combo exists in another record
        $sql_check = "SELECT assign_id FROM dep_assignment 
                      WHERE e_id = '$ve_id' AND dep_id = '$vdep_id' 
                      AND assign_id != '$vassign_id'";
        
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            echo "<script>
                    alert('Error: This employee is already assigned to that department in another record.');
                    history.back();
                  </script>";
        } else {
            // Perform the UPDATE
            $sql = "UPDATE dep_assignment SET 
                    e_id = '$ve_id', 
                    dep_id = '$vdep_id'
                    WHERE assign_id = '$vassign_id'";

            if ($conn->query($sql)) {
                echo "<script>
                    alert('Assignment updated successfully.');
                    window.location.href='../../edit/edit-depAssign.php';
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