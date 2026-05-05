<!-- FOR EMPLOYEE ACTION -->

<?php
    require("../../include/conn.php");
    $vgender = "";
?>

<html>
    <body>
        <form action="e_insert-save.php" method="post" name="formadd" enctype="multipart/form-data" novalidate>
            <table border="1">    
                <tr>
                    <td colspan="2" align=center>
                        <b>Insert Employee</b>
                    </td>
                </tr>

                <!-- <tr>
                    <td>
                    <label >Enter Employee Number:</label>
                    </td>
                    <td>
                    <input type="text" name="txtemployeenumber" id="txtemployeenumber" value="<?php echo $vemployeenumber; ?>">
                    </td>
                </tr> -->
                
                <tr>
                    <td>
                    <label >Enter Last Name:</label>
                    </td>
                    <td>
                    <input type="text" name="txtlastname" id="txtlastname">
                    </td>
                </tr>
                
                <tr>
                    <td>
                    <label >Enter First Name:</label>
                    </td>
                    <td>
                    <input type="text" name="txtfirstname" id="txtfirstname">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label >Enter Employee ID:</label>
                    </td>
                    <td>
                        <input type="text" name="txtidnumber" id="txtidnumber">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label >Enter Position ID:</label>
                    </td>

                    <td>
                        <input type="text" name="txtposition" id="txtposition">                      
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Enter Hire Date:</label>
                    </td>
                    <td>
                        <input type="date" name="txthiredate" id="txthiredate">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align=center>
                        <input type="submit" value="Insert Record" />
                        <button type="reset" class="btn btn-warning btn-s" onClick="window.location.href='../../employees.php'">Back</button>
                    </td>
                </tr>
            </table>
        </form>     
    </body>
</html>