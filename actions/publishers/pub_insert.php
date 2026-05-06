<!-- FOR PUBLISHER ACTION -->
<?php
    require("../../include/conn.php");
?>

<html>
    <head>
        <style>
            body { font-family: 'Segoe UI', sans-serif; padding: 40px; background-color: #f4f7f6; }
            table { background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
            td { padding: 15px; }
            input[type="text"] { padding: 8px; width: 250px; border-radius: 4px; border: 1px solid #ccc; }
            .btn-insert { background-color: #4A90E2; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
            .btn-back { background-color: #f0ad4e; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; text-decoration: none; }
        </style>
    </head>

    <body>
        <form action="pub_insert-save.php" method="post" name="formadd" novalidate>
            <table border="1" align="center">    
                <tr>
                    <td colspan="2" align="center" style="background-color: #4A90E2; color: white; border-radius: 8px 8px 0 0;">
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