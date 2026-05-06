<!-- FOR GAMES ACTION -->
<?php
require_once("../../include/conn.php");

// Initialize variables based on games table structure[cite: 24, 26]
$vgame_id = "";
$vgame_title = "";

// Check if game ID is provided via GET[cite: 24, 26]
if (isset($_GET['vid']) && !empty($_GET['vid'])) {
    $vgame_id = mysqli_real_escape_string($conn, $_GET['vid']);
    
    // Fetch existing record to show user what they are deleting[cite: 24, 26]
    $sql = "SELECT * FROM games WHERE game_id = '$vgame_id'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vgame_id = $row['game_id'];
        $vgame_title = $row['game_title'];
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
    <form method="post" name="formdelete" id="formdelete" novalidate>
        <table border="1">    
            <tr>
                <td colspan="2" align="center">
                    <b>Delete Game Record</b>
                </td>
            </tr>

            <tr>
                <td><label>Game ID:</label></td>
                <td>
                    <input type="text" name="txtgame_id" id="txtgame_id" value="<?php echo htmlspecialchars($vgame_id); ?>" readonly>
                </td>
            </tr>

            <tr>
                <td><label>Game Title:</label></td>
                <td>
                    <input readonly type="text" value="<?php echo htmlspecialchars($vgame_title); ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <!-- Confirmation logic matches e_delete.php[cite: 26] -->
                    <input type="button" value="Delete Record" onclick="confirmDelete()" />
                    <button type="button" onClick="window.location.href='../../games.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>

<script>
function confirmDelete() {
    if (confirm("Are you sure you want to delete this game? This action cannot be undone.")) {
        document.getElementById("formdelete").action = "g_delete-save.php";
        document.getElementById("formdelete").submit();
    }
}
</script>
</body>
</html>