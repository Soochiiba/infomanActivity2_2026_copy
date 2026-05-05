<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e_id   = $_POST['txte_id'];
    $dep_id = $_POST['txtdep_id'];

    if (!empty($e_id) && !empty($dep_id)) {
        
        // Validation: Check if this specific assignment already exists
        $sql_check = "SELECT assign_id FROM dep_assignment WHERE e_id = '$e_id' AND dep_id = '$dep_id'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            echo "Error: This employee is already assigned to that department.";
        } 
        else {
            // Insert into the master table[cite: 22]
            $sql = "INSERT INTO dep_assignment (e_id, dep_id) VALUES ('$e_id', '$dep_id')";

            if ($conn->query($sql)) {
                echo "Department assignment created successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Please select both an employee and a department.";
    }
}
?>

<!-- Redirect back to the edit list after 2 seconds[cite: 22] -->
<meta http-equiv="refresh" content="2;url=../../edit/edit-depAssign.php">