<!-- FOR GAMES ACTION -->
<?php
require("../../include/conn.php");

    // Initialize variables based on games table structure[cite: 22, 23]
    $vgame_id = "";
    $vgame_title = "";
    $vgenre = "";
    $vesrb_rating = "";
    $vgame_desc = "";

    // Check if game ID exists via GET[cite: 22, 23]
    if (isset($_GET['vid']) && !empty($_GET['vid'])) {
        $vgame_id = mysqli_real_escape_string($conn, $_GET['vid']);
        
        // Fetch existing record from games table[cite: 22, 23]
        $sql = "SELECT * FROM games WHERE game_id = '$vgame_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $vgame_id     = $row['game_id'];
            $vgame_title  = $row['game_title'];
            $vgenre       = $row['genre'];
            $vesrb_rating = $row['esrb_rating'];
            $vgame_desc   = $row['game_desc'];
        }
    }
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
        <form action="g_update-save.php" method="post" name="formupdate" novalidate>
        <table border="1" align="center">    
            <tr>
                <td colspan="2" align="center"><b>Update Game Record</b></td>
            </tr>

            <!-- Hidden field to pass the primary key[cite: 21, 22] -->
            <input type="hidden" name="txtgame_id" value="<?php echo $vgame_id; ?>">                

            <tr>
                <td><label>Game ID:</label></td>
                <td><strong><?php echo htmlspecialchars($vgame_id); ?></strong> (Read-Only)</td>
            </tr>

            <tr>
                <td><label>Game Title:</label></td>
                <td><input type="text" name="txtgame_title" value="<?php echo htmlspecialchars($vgame_title); ?>"></td>
            </tr>
            
            <tr>
                <td><label>Genre:</label></td>
                <td><input type="text" name="txtgenre" value="<?php echo htmlspecialchars($vgenre); ?>"></td>
            </tr>

            <tr>
                <td><label>ESRB Rating:</label></td>
                <td><input type="text" name="txtesrb_rating" value="<?php echo htmlspecialchars($vesrb_rating); ?>"></td>
            </tr>

            <tr>
                <td><label>Game Description:</label></td>
                <td><textarea name="txtgame_desc" rows="4" cols="30"><?php echo htmlspecialchars($vgame_desc); ?></textarea></td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Update Record" />
                    <button type="button" onClick="window.location.href='../../games.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>
    </body>
</html>