<!-- FOR PLATFORM ACTION -->
<?php
require_once("../../include/conn.php");

// Initialize variables
$vplat_id = "";
$vplat_title = "";

// Check if platform ID is provided via GET[cite: 21]
if (isset($_GET['vid']) && !empty($_GET['vid'])) {
    $vplat_id = mysqli_real_escape_string($conn, $_GET['vid']);
    
    // Fetch existing record to display confirmation details[cite: 21]
    $sql = "SELECT * FROM platforms WHERE plat_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vplat_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vplat_id = $row['plat_id'];
        $vplat_title = $row['plat_title'];
    }
    $stmt->close();
}
?>

<html>
<body>
    <form method="post" name="formdelete" id="formdelete" novalidate>
        <table border="1">    
            <tr>
                <td colspan="2" align="center">
                    <b>Delete Platform Record</b>
                </td>
            </tr>

            <tr>
                <td><label>Platform ID:</label></td>
                <td>
                    <input type="text" name="txtplat_id" id="txtplat_id" value="<?php echo htmlspecialchars($vplat_id); ?>" readonly>
                </td>
            </tr>

            <tr>
                <td><label>Platform Title:</label></td>
                <td>
                    <input readonly type="text" value="<?php echo htmlspecialchars($vplat_title); ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="button" value="Delete Record" onclick="confirmPlatDelete()" />
                    <button type="button" onClick="window.location.href='../../platforms.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>

<script>
function confirmPlatDelete() {
    if (confirm("Are you sure you want to delete this platform? This action cannot be undone.")) {
        document.getElementById("formdelete").action = "plat_delete-save.php";
        document.getElementById("formdelete").submit();
    }
}
</script>
</body>
</html>