<!-- FOR GAMES ACTION -->
<?php
    require("../../include/conn.php");
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
        <!-- Form action points to g_insert-save.php, matching e_insert structure -->
        <form action="g_insert-save.php" method="post" name="formadd" novalidate>
            <table border="1" align="center">    
                <tr>
                    <td colspan="2" align="center">
                        <b>Insert New Game</b>
                    </td>
                </tr>
                
                <tr>
                    <td><label>Enter Game Title:</label></td>
                    <td><input type="text" name="txtgametitle" id="txtgametitle"></td>
                </tr>
                
                <tr>
                    <td><label>Enter Genre:</label></td>
                    <td><input type="text" name="txtgenre" id="txtgenre"></td>
                </tr>

                <tr>
                    <td><label>Enter ESRB Rating:</label></td>
                    <td><input type="text" name="txtesrbrating" id="txtesrbrating"></td>
                </tr>

                <tr>
                    <td><label>Enter Game Description:</label></td>
                    <td><textarea name="txtgamedesc" id="txtgamedesc" rows="4" cols="30"></textarea></td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Insert Record" />
                        <!-- Redirects back to games.php as requested -->
                        <button type="reset" onClick="window.location.href='../../games.php'">Back</button>
                    </td>
                </tr>
            </table>
        </form>     
    </body>
</html>