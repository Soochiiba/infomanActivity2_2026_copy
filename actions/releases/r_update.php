<?php
require("../../include/conn.php");

// Initialize variables
$vrel_id = "";
$vgame_id = "";
$vplat_id = "";
$vprice = "";

// Check if release exists via GET
if (isset($_GET['vid']) && !empty($_GET['vid'])) {
    $vrel_id = mysqli_real_escape_string($conn, $_GET['vid']);
    
    // Fetch existing record from release_prices[cite: 22]
    $sql = "SELECT * FROM release_prices WHERE rel_id = '$vrel_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vrel_id  = $row['rel_id'];
        $vgame_id = $row['game_id'];
        $vplat_id = $row['plat_id'];
        $vprice   = $row['price'];
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
    <title>Update Release Record</title>
</head>
<body>
    <form action="r_update-save.php" method="post">
        <table border="1" align="center">    
            <tr>
                <td colspan="2" align="center"><b>Update Game Release</b></td>
            </tr>

            <!-- Hidden field for Primary Key[cite: 22] -->
            <input type="hidden" name="txtrel_id" value="<?php echo $vrel_id; ?>">                

            <tr>
                <td>Game:</td>
                <td>
                    <select name="txtgame">
                        <?php
                        $resGame = $conn->query("SELECT game_id, game_title FROM games ORDER BY game_title");
                        while($gRow = $resGame->fetch_assoc()){
                            $selected = ($gRow['game_id'] == $vgame_id) ? "selected" : "";
                            echo "<option value='".$gRow['game_id']."' $selected>".$gRow['game_title']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Platform:</td>
                <td>
                    <select name="txtplatform">
                        <?php
                        $resPlat = $conn->query("SELECT plat_id, plat_title FROM platforms ORDER BY plat_title");
                        while($pRow = $resPlat->fetch_assoc()){
                            $selected = ($pRow['plat_id'] == $vplat_id) ? "selected" : "";
                            echo "<option value='".$pRow['plat_id']."' $selected>".$pRow['plat_title']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td><input type="number" name="txtprice" step="0.01" value="<?php echo htmlspecialchars($vprice); ?>"></td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Update Record" />
                    <button type="button" onClick="window.location.href='../../releases.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>