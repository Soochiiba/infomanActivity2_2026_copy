<?php
    require("../../include/conn.php");
?>

<html>
<head>
    <title>Insert Department Assignment</title>
</head>
<body>
    <form action="da_insert-save.php" method="post" name="formadd">
        <table border="1">    
            <tr>
                <td colspan="2" align="center">
                    <b>Assign Employee to Department</b>
                </td>
            </tr>
            
            <tr>
                <td><label>Select Employee:</label></td>
                <td>
                    <select name="txte_id" required>
                        <option value="">-- Select Employee --</option>
                        <?php
                        $resEmp = $conn->query("SELECT e_no, fName, lName FROM employees ORDER BY lName");
                        while($row = $resEmp->fetch_assoc()) {
                            echo "<option value='".$row['e_no']."'>".$row['lName'].", ".$row['fName']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td><label>Select Department:</label></td>
                <td>
                    <select name="txtdep_id" required>
                        <option value="">-- Select Department --</option>
                        <?php
                        $resDep = $conn->query("SELECT dep_id, dep_desc FROM departments ORDER BY dep_desc");
                        while($row = $resDep->fetch_assoc()) {
                            echo "<option value='".$row['dep_id']."'>".$row['dep_desc']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Assign Department" />
                    <button type="button" onClick="window.location.href='../../edit/edit-depAssign.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>     
</body>
</html>