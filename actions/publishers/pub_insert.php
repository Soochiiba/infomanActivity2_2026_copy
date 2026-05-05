<!-- FOR PUBLISHER ACTION -->
<?php
    require("../../include/conn.php");
?>

<html>
    <body>
        <form action="pub_insert-save.php" method="post" name="formadd" novalidate>
            <table border="1">    
                <tr>
                    <td colspan="2" align="center">
                        <b>Insert Publisher</b>
                    </td>
                </tr>
                
                <tr>
                    <td><label>Publisher Title:</label></td>
                    <td><input type="text" name="txtpub_title" id="txtpub_title"></td>
                </tr>
                
                <tr>
                    <td><label>Headquarters:</label></td>
                    <td><input type="text" name="txtheadquarters" id="txtheadquarters"></td>
                </tr>

                <tr>
                    <td><label>Year Founded:</label></td>
                        <td>
                            <!-- Using type="number" with min/max ensures valid year ranges -->
                            <input type="number" 
                                name="txtyear_founded" 
                                id="txtyear_founded" 
                                min="1800" 
                                max="<?php echo date('Y'); ?>" 
                                placeholder="YYYY" 
                                required>
                        </td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Insert Record" />
                        <button type="button" onClick="window.location.href='../../publishers.php'">Back</button>
                    </td>
                </tr>
            </table>
        </form>     
    </body>
</html>