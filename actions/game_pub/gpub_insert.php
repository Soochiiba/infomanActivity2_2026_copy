<?php
    require("../../include/conn.php"); // Path based on your file structure
?>

<html>
<head>
    <title>Insert Game Publishing</title>
</head>
<body>
    <form action="gpub_insert-save.php" method="post" name="formadd">
        <table border="1">    
            <tr>
                <td colspan="2" align="center">
                    <b>Assign Publisher to Game</b>
                </td>
            </tr>
            
            <tr>
                <td><label>Select Game:</label></td>
                <td>
                    <select name="txtgame_id" required>
                        <option value="">-- Select Game --</option>
                        <?php
                        // Fetching games for the dropdown[cite: 22]
                        $resGame = $conn->query("SELECT game_id, game_title FROM games ORDER BY game_title");
                        while($row = $resGame->fetch_assoc()) {
                            echo "<option value='".$row['game_id']."'>".$row['game_title']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td><label>Select Publisher:</label></td>
                <td>
                    <select name="txtpub_id" required>
                        <option value="">-- Select Publisher --</option>
                        <?php
                        // Fetching publishers for the dropdown[cite: 22]
                        $resPub = $conn->query("SELECT pub_id, pub_title FROM publishers ORDER BY pub_title");
                        while($row = $resPub->fetch_assoc()) {
                            echo "<option value='".$row['pub_id']."'>".$row['pub_title']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Save Assignment" />
                    <button type="button" onClick="window.location.href='../../edit/edit-gamePub.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>     
</body>
</html>