<!-- FOR EMPLOYEE ACTION -->

<?php
    require("../../include/conn.php");
    $vgender = "";
?>

<html>
    <head>
        <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f7f6; }
        table { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        select, input { width: 100%; padding: 8px; margin: 5px 0; }
    </style>

    </head>
    <body>
        <form action="e_insert-save.php" method="post" name="formadd" enctype="multipart/form-data" novalidate>
            <table border="1" align ="center">    
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