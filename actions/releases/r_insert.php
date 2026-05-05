<?php
    require("../../include/conn.php"); // Path based on your rel_insert.php location[cite: 17, 18]
?>

<html>
<head>
    <title>Insert New Release</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f7f6; }
        table { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        select, input { width: 100%; padding: 8px; margin: 5px 0; }
    </style>
</head>
<body>
    <form action="r_insert-save.php" method="post">
        <table align="center">
            <tr>
                <th colspan="2"><h3>Add New Game Release</h3></th>
            </tr>
            <tr>
                <td>Select Game:</td>
                <td>
                    <select name="txtgame" required>
                        <option value="">-- Choose Game --</option>
                        <?php
                            $result = $conn->query("SELECT game_id, game_title FROM games ORDER BY game_title");
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['game_id']."'>".$row['game_title']."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Select Platform:</td>
                <td>
                    <select name="txtplatform" required>
                        <option value="">-- Choose Platform --</option>
                        <?php
                            $result = $conn->query("SELECT plat_id, plat_title FROM platforms ORDER BY plat_title");
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['plat_id']."'>".$row['plat_title']."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type="number" name="txtprice" step="0.01" placeholder="0.00" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <br>
                    <input type="submit" value="Save Release">
                    <button type="button" onClick="window.location.href='../../releases.php'">Cancel</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>