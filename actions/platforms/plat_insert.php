<!-- FOR PLATFORM ACTION -->
<?php
    require("../../include/conn.php");
?>

<html>
    <body>
        <!-- Action points to plat_insert-save.php, matching e_insert structure -->
        <form action="plat_insert-save.php" method="post" name="formadd" novalidate>
            <table border="1">    
                <tr>
                    <td colspan="2" align="center">
                        <b>Insert Platform</b>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Enter Platform Title:</label>
                    </td>
                    <td>
                        <input type="text" name="txtplattitle" id="txtplattitle">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Insert Record" />
                        <!-- Redirects back to platforms.php as defined in platforms_4.php -->
                        <button type="reset" onClick="window.location.href='../../platforms.php'">Back</button>
                    </td>
                </tr>
            </table>
        </form>     
    </body>
</html>