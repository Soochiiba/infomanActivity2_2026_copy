<!-- FOR POSITION ACTION -->
<?php
    require("../../include/conn.php");
?>

<html>
<head>
    <title>Insert Position</title>
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
    <form action="pos_insert-save.php" method="post" name="formadd" novalidate>
        <table border="0" align="center">    
            <tr>
                <td colspan="2" align="center" style="background-color: #4A90E2; color: white; border-radius: 8px 8px 0 0;">
                    <b>Insert New Position</b>
                </td>
            </tr>
            
            <tr>
                <td><label>Position Title:</label></td>
                <td><input type="text" name="txtpos_title" id="txtpos_title" placeholder="e.g., Software Engineer"></td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Insert Record" class="btn-insert" />
                    <button type="button" class="btn-back" onClick="window.location.href='../../positions.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>     
</body>
</html>