<!-- FOR RELEASE ACTION -->
<?php
require_once("../../include/conn.php");

// Initialize variables
$vrel_id = "";
$vgame_title = "";
$vplat_title = "";

// Check if release ID is provided via GET
if (isset($_GET['vid']) && !empty($_GET['vid'])) {
    $vrel_id = mysqli_real_escape_string($conn, $_GET['vid']);
    
    // Fetch existing record with JOINs to show readable names[cite: 22, 23]
    $sql = "SELECT rp.rel_id, g.game_title, pl.plat_title 
            FROM release_prices rp
            INNER JOIN games g ON rp.game_id = g.game_id
            INNER JOIN platforms pl ON rp.plat_id = pl.plat_id
            WHERE rp.rel_id = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vrel_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vrel_id = $row['rel_id'];
        $vgame_title = $row['game_title'];
        $vplat_title = $row['plat_title'];
    }
    $stmt->close();
}
?>

<html>
<head>
    <title>Delete Release Record</title>
</head>
<body>
    <form method="post" name="formdelete" id="formdelete" novalidate>
        <table border="1" align="center">    
            <tr>
                <td colspan="2" align="center">
                    <b>Confirm Delete Release Record</b>
                </td>
            </tr>

            <tr>
                <td><label>Release ID:</label></td>
                <td>
                    <input type="text" name="txtrel_id" id="txtrel_id" value="<?php echo htmlspecialchars($vrel_id); ?>" readonly>
                </td>
            </tr>

            <tr>
                <td><label>Game Title:</label></td>
                <td>
                    <input readonly type="text" value="<?php echo htmlspecialchars($vgame_title); ?>" style="width: 100%;">
                </td>
            </tr>
            
            <tr>
                <td><label>Platform:</label></td>
                <td>
                    <input readonly type="text" value="<?php echo htmlspecialchars($vplat_title); ?>" style="width: 100%;">
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="button" value="Delete Record" onclick="submitToDeleteSave()" />
                    <button type="button" onClick="window.location.href='../../releases.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>

<script>
function submitToDeleteSave() {
    if (confirm("Are you sure you want to delete this release record? This action cannot be undone.")) {
        document.getElementById("formdelete").action = "r_delete-save.php"; //
        document.getElementById("formdelete").submit();
    }
}
</script>
</body>
</html>