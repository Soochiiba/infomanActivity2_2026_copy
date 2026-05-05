<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the employee number
    $ve_no = $_POST['txte_no'];

    // Validation
    if (!empty($ve_no)) {
        // Delete employee record based on primary key
        $sql = "DELETE FROM employees WHERE e_no = $ve_no";
        
        if ($conn->query($sql)) {
            echo "<script>
                alert('Employee record deleted successfully.');
                window.location.href='../../employees.php';
                </script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error: No employee number provided.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>