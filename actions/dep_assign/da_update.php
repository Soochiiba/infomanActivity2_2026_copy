<?php
require("../../include/conn.php");

    // Initialize variables
    $vassign_id = "";
    $ve_id = "";
    $vdep_id = "";

    // Check if assignment ID exists via GET
    if (isset($_GET['vid']) && !empty($_GET['vid'])) {
        $vassign_id = mysqli_real_escape_string($conn, $_GET['vid']);
        
        // Fetch existing assignment record
        $sql = "SELECT * FROM dep_assignment WHERE assign_id = '$vassign_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $vassign_id = $row['assign_id'];
            $ve_id      = $row['e_id'];
            $vdep_id    = $row['dep_id'];
        }
    }
?>

<html>
<head><title>Update Department Assignment</title></head>
    <body>
        <form action="da_update-save.php" method="post" name="formupdate">
        <table border="1" align="center" style="padding: 20px;">    
            <tr>
                <td colspan="2" align="center"><b>Update Department Assignment</b></td>
            </tr>

            <!-- Hidden primary key[cite: 21] -->
            <input type="hidden" name="txtassign_id" value="<?php echo $vassign_id; ?>">                

            <tr>
                <td><label>Assignment ID:</label></td>
                <td><strong><?php echo htmlspecialchars($vassign_id); ?></strong></td>
            </tr>

            <tr>
                <td><label>Select Employee:</label></td>
                <td>
                    <select name="txte_id" required>
                        <?php
                        $resEmp = $conn->query("SELECT e_no, fName, lName FROM employees ORDER BY lName");
                        while($row = $resEmp->fetch_assoc()) {
                            $selected = ($row['e_no'] == $ve_id) ? "selected" : "";
                            echo "<option value='".$row['e_no']."' $selected>".$row['lName'].", ".$row['fName']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td><label>Select Department:</label></td>
                <td>
                    <select name="txtdep_id" required>
                        <?php
                        $resDep = $conn->query("SELECT dep_id, dep_desc FROM departments ORDER BY dep_desc");
                        while($row = $resDep->fetch_assoc()) {
                            $selected = ($row['dep_id'] == $vdep_id) ? "selected" : "";
                            echo "<option value='".$row['dep_id']."' $selected>".$row['dep_desc']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Update Assignment" />
                    <button type="button" onClick="window.location.href='../../edit/edit-depAssign.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>
    </body>
</html>