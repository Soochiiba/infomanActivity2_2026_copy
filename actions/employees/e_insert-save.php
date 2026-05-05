<!-- FOR EMPLOYEE ACTION  -->

<?php
require("../../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e_idnumber = $_POST['txtidnumber'];
    $position   = $_POST['txtposition'];
    $lastname   = $_POST['txtlastname'];
    $firstname  = $_POST['txtfirstname'];
    $hire_date  = $_POST['txthiredate'];

    if (!empty($e_idnumber) && !empty($position) && !empty($lastname) && !empty($firstname) && !empty($hire_date)) {
        
        $sql_check_name = "SELECT e_no FROM employees WHERE lName = '$lastname' AND fName = '$firstname'";
        $result_name = $conn->query($sql_check_name);
        
        $sql_check_id = "SELECT e_no FROM employees WHERE e_idNum = '$e_idnumber'";
        $result_id = $conn->query($sql_check_id);

        if (!$result_name || !$result_id) {
            die("Database Query Error: " . $conn->error);
        }

        if ($result_name->num_rows > 0) {
            echo "Error: An employee with the name " . htmlspecialchars($firstname) . " " . htmlspecialchars($lastname) . " already exists.";
        } 
        else if ($result_id->num_rows > 0) {
            echo "Error: The Employee ID '" . htmlspecialchars($e_idnumber) . "' is already assigned to another employee.";
        } 
        else {
            $sql = "INSERT INTO employees (e_idNum, pos_id, lName, fName, hire_date) 
                    VALUES ('$e_idnumber', '$position', '$lastname', '$firstname', '$hire_date')";

            if ($conn->query($sql)) {
                echo "New employee record inserted successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Please fill in all required fields: Last Name, First Name, Employee ID, and Hire Date.";
    }
}
?>

<meta http-equiv="refresh" content="2;url=../../employees.php">