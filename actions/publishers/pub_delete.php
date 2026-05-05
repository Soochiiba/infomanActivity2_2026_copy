<!-- FOR PUBLISHER ACTION -->
<?php
require_once("../../include/conn.php");

// Initialize variables
$vpub_id = "";
$vpub_title = "";

// Check if publisher ID is provided via GET
if (isset($_GET['vid']) && !empty($_GET['vid'])) {
    $vpub_id = $_GET['vid'];
    
    // Fetch existing record using prepared statement for security
    $sql = "SELECT * FROM publishers WHERE pub_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vpub_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vpub_id = $row['pub_id'];
        $vpub_title = $row['pub_title'];
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
                    <b>Delete Publisher Record</b>
                </td>
            </tr>

            <tr>
                <td><label>Publisher Number:</label></td>
                <td>
                    <input type="text" name="txtpub_id" id="txtpub_id" value="<?php echo htmlspecialchars($vpub_id); ?>" readonly>
                </td>
            </tr>

            <tr>
                <td><label>Publisher Title:</label></td>
                <td>
                    <input readonly type="text" value="<?php echo htmlspecialchars($vpub_title); ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="button" value="Delete Record" onclick="confirmDelete()" />
                    <button type="button" onClick="window.location.href='../../publishers.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>

<script>
function confirmDelete() {
    if (confirm("Are you sure you want to delete this publisher? This action cannot be undone.")) {
        document.getElementById("formdelete").action = "pub_delete-save.php";
        document.getElementById("formdelete").submit();
    }
}
</script>
</body>
</html>