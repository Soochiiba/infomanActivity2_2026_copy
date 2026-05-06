<?php
require("../../include/conn.php");

    // Initialize variables[cite: 23]
    $vgpub_id = "";
    $vgame_id = "";
    $vpub_id = "";

    // Check if Publishing ID exists via GET[cite: 23, 25]
    if (isset($_GET['vid']) && !empty($_GET['vid'])) {
        $vgpub_id = mysqli_real_escape_string($conn, $_GET['vid']);
        
        // Fetch existing publishing record[cite: 23]
        $sql = "SELECT * FROM game_publishing WHERE gpub_id = '$vgpub_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $vgpub_id = $row['gpub_id'];
            $vgame_id = $row['game_id'];
            $vpub_id  = $row['pub_id'];
        }
    }
?>

<html>
<head><title>Update Game Publishing</title></head>
    <body>
        <form action="gpub_update-save.php" method="post" name="formupdate">
        <table border="1" align="center" style="padding: 20px;">    
            <tr>
                <td colspan="2" align="center"><b>Update Game Publishing Assignment</b></td>
            </tr>

            <!-- Hidden primary key[cite: 23] -->
            <input type="hidden" name="txtgpub_id" value="<?php echo $vgpub_id; ?>">                

            <tr>
                <td><label>Publishing ID:</label></td>
                <td><strong><?php echo htmlspecialchars($vgpub_id); ?></strong></td>
            </tr>

            <tr>
                <td><label>Select Game:</label></td>
                <td>
                    <select name="txtgame_id" required>
                        <?php
                        // Fetch readable game titles[cite: 23, 25]
                        $resGame = $conn->query("SELECT game_id, game_title FROM games ORDER BY game_title");
                        while($row = $resGame->fetch_assoc()) {
                            $selected = ($row['game_id'] == $vgame_id) ? "selected" : "";
                            echo "<option value='".$row['game_id']."' $selected>".$row['game_title']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td><label>Select Publisher:</label></td>
                <td>
                    <select name="txtpub_id" required>
                        <?php
                        // Fetch readable publisher titles[cite: 23, 25]
                        $resPub = $conn->query("SELECT pub_id, pub_title FROM publishers ORDER BY pub_title");
                        while($row = $resPub->fetch_assoc()) {
                            $selected = ($row['pub_id'] == $vpub_id) ? "selected" : "";
                            echo "<option value='".$row['pub_id']."' $selected>".$row['pub_title']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Update Assignment" />
                    <button type="button" onClick="window.location.href='../../edit/edit-gamePub.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>
    </body>
</html>