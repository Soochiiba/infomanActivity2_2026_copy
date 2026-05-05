<!-- FOR EMPLOYEE ACTION -->
<?php
require("../../include/conn.php");

    // Initialize variables
    $ve_no = "";
    $ve_idNum = "";
    $vpos_id = "";
    $vlName = "";
    $vfName = "";
    $vhire_date = "";

    // Check if employee exists via GET
    if (isset($_GET['vid']) && !empty($_GET['vid'])) {
        $ve_no = mysqli_real_escape_string($conn, $_GET['vid']);
        
        // Fetch existing record using correct employee columns[
        $sql = "SELECT * FROM employees WHERE e_no = '$ve_no'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ve_no      = $row['e_no'];
            $ve_idNum   = $row['e_idNum'];
            $vpos_id    = $row['pos_id'];
            $vlName     = $row['lName'];
            $vfName     = $row['fName'];
            $vhire_date = $row['hire_date'];
        }
    }
?>

<html>
    <body>
        <form action="e_update-save.php" method="post" name="formupdate" novalidate>
        <table border="1">    
            <tr>
                <td colspan="2" align=center><b>Update Employee Record</b></td>
            </tr>

            <!-- Hidden field to pass the primary key -->
            <input type="hidden" name="txte_no" value="<?php echo $ve_no; ?>">                

            <tr>
                <td><label>Employee Number:</label></td>
                <td><strong><?php echo htmlspecialchars($ve_no); ?></strong> (Read-Only)</td>
            </tr>

            <tr>
                <td><label>Employee ID:</label></td>
                <td><input type="text" name="txte_idNum" value="<?php echo htmlspecialchars($ve_idNum); ?>"></td>
            </tr>
            
            <tr>
                <td><label>Position ID:</label></td>
                <td><input type="text" name="txtpos_id" value="<?php echo htmlspecialchars($vpos_id); ?>"></td>
            </tr>

            <tr>
                <td><label>Last Name:</label></td>
                <td><input type="text" name="txtlName" value="<?php echo htmlspecialchars($vlName); ?>"></td>
            </tr>

            <tr>
                <td><label>First Name:</label></td>
                <td><input type="text" name="txtfName" value="<?php echo htmlspecialchars($vfName); ?>"></td>
            </tr>

            <tr>
                <td><label>Hire Date:</label></td>
                <td><input type="date" name="txthire_date" value="<?php echo htmlspecialchars($vhire_date); ?>"></td>
            </tr>

            <tr>
                <td colspan="2" align=center>
                    <input type="submit" value="Update Record" />
                    <button type="button" onClick="window.location.href='../../employees.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>
    </body>
</html>