<!-- FOR POSITION ACTION -->
<?php
require_once("../../include/conn.php");

// Initialize variables
$vpos_id = "";
$vpos_title = "";

// Check if position ID is provided via GET
if (isset($_GET['vid']) && !empty($_GET['vid'])) {
    $vpos_id = mysqli_real_escape_string($conn, $_GET['vid']);
    
    // Fetch existing record[cite: 14]
    $sql = "SELECT * FROM positions WHERE pos_id = '$vpos_id'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vpos_id = $row['pos_id'];
        $vpos_title = $row['pos_title'];
    }
}
?>

<html>
<head>
    <title>Delete Position</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; padding: 40px; background-color: #f4f7f6; }
        table { background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        td { padding: 15px; }
        input[readonly] { background-color: #eee; border: 1px solid #ccc; padding: 8px; width: 250px; }
        .btn-delete { background-color: #d9534f; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
        .btn-back { background-color: #f0ad4e; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <form method="post" name="formdelete" id="formdelete" novalidate>
        <table border="0" align="center">    
            <tr>
                <td colspan="2" align="center" style="background-color: #d9534f; color: white; border-radius: 8px 8px 0 0;">
                    <b>Delete Position Record</b>
                </td>
            </tr>

            <tr>
                <td><label>Position ID:</label></td>
                <td>
                    <input type="text" name="txtpos_id" id="txtpos_id" value="<?php echo htmlspecialchars($vpos_id); ?>" readonly>
                </td>
            </tr>

            <tr>
                <td><label>Position Title:</label></td>
                <td>
                    <input readonly type="text" value="<?php echo htmlspecialchars($vpos_title); ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="button" value="Delete Record" class="btn-delete" onclick="confirmDelete()" />
                    <button type="button" class="btn-back" onClick="window.location.href='../../positions.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>

<script>
function confirmDelete() {
    if (confirm("Are you sure you want to delete this position? If employees are assigned to this ID, it may cause errors.")) {
        document.getElementById("formdelete").action = "pos_delete-save.php";
        document.getElementById("formdelete").submit();
    }
}
</script>
</body>
</html>