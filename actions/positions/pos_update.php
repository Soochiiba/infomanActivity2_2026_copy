<!-- FOR POSITION ACTION -->
<?php
require("../../include/conn.php");

    // Initialize variables
    $vpos_id = "";
    $vpos_title = "";

    // Check if position ID is provided via GETpositions
    if (isset($_GET['vid']) && !empty($_GET['vid'])) {
        // Sanitize input to prevent SQL injection
        $vpos_id = mysqli_real_escape_string($conn, $_GET['vid']);
        
        // Fetch existing record from positions table
        $sql = "SELECT * FROM positions WHERE pos_id = '$vpos_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $vpos_id = $row['pos_id'];
            $vpos_title = $row['pos_title'];
        } else {
            echo "Record not found.";
            exit;
        }
    }
?>

<html>
    <head>
        <title>Update Position</title>
        <style>
            body { font-family: 'Segoe UI', sans-serif; padding: 40px; background-color: #f4f7f6; }
            table { background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
            td { padding: 15px; }
            input[type="text"] { padding: 8px; width: 250px; border-radius: 4px; border: 1px solid #ccc; }
            .btn-update { background-color: #4A90E2; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
            .btn-back { background-color: #f0ad4e; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; text-decoration: none; }
        </style>
    </head>
    <body>
        <form action="pos_update-save.php" method="post" name="formupdate" novalidate>
            <table border="0" align="center">    
                <tr>
                    <td colspan="2" align="center" style="background-color: #4A90E2; color: white; border-radius: 8px 8px 0 0;">
                        <b>Update Position Record</b>
                    </td>
                </tr>

                <!-- Hidden field to pass the original pos_id to the save scriptpositions -->
                <input type="hidden" name="txtpos_id_hidden" value="<?php echo $vpos_id; ?>">                

                <tr>
                    <td><label>Position ID:</label></td>
                    <td>
                        <input type="text" name="txtpos_id" value="<?php echo htmlspecialchars($vpos_id); ?>">
                        <br><small>(Change only if necessary)</small>
                    </td>
                </tr>

                <tr>
                    <td><label>Position Title:</label></td>
                    <td>
                        <input type="text" name="txtpos_title" id="txtpos_title" value="<?php echo htmlspecialchars($vpos_title); ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Update Record" class="btn-update" />
                        <button type="button" class="btn-back" onClick="window.location.href='../../positions.php'">Back</button>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>