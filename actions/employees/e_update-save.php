<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture data from POST
    $ve_no      = $_POST['txte_no']; 
    $ve_idNum   = $_POST['txte_idNum'];
    $vpos_id    = $_POST['txtpos_id'];
    $vlName     = $_POST['txtlName'];
    $vfName     = $_POST['txtfName'];
    $vhire_date = $_POST['txthire_date'];

    // Basic validation
    if (!empty($ve_no) && !empty($ve_idNum) && !empty($vlName) && !empty($vfName)) {
        
        // Check if the NEW ID or Name is already taken by a DIFFERENT employee
        $sql_check = "SELECT e_no FROM employees 
                      WHERE (e_idNum = '$ve_idNum' OR (lName = '$vlName' AND fName = '$vfName')) 
                      AND e_no != '$ve_no'";
        
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            echo "<script>
                    alert('Error: Another employee already exists with this Name or ID.');
                    history.back();
                  </script>";
        } else {
            // Perform the UPDATE
            $sql = "UPDATE employees SET 
                    e_idNum = '$ve_idNum', 
                    pos_id = '$vpos_id', 
                    lName = '$vlName', 
                    fName = '$vfName',
                    hire_date = '$vhire_date'
                    WHERE e_no = '$ve_no'";

            if ($conn->query($sql)) {
                echo "<script>
                    alert('Employee record updated successfully.');
                    window.location.href='../../employees.php';
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