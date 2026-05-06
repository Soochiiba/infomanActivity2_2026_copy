<!-- FOR EMPLOYEE ACTION -->
<?php
require_once("../../include/conn.php");

// Initialize variables
$ve_no = "";
$vlName = "";
$vfName = "";

// Check if employee number is provided via GET
if (isset($_GET['vid']) && !empty($_GET['vid'])) {
    $ve_no = $_GET['vid'];
    
    // Fetch existing record using employee columns
    $sql = "SELECT * FROM employees WHERE e_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ve_no);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ve_no = $row['e_no'];
        $vlName = $row['lName'];
        $vfName = $row['fName'];
    }
    $stmt->close();
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
    <!-- Action is set dynamically by JavaScript -->
    <form method="post" name="formdelete" id="formdelete" novalidate>
        <table border="1" align="center">    
            <tr>
                <td colspan="2" align="center">
                    <b>Delete Employee Record</b>
                </td>
            </tr>

            <tr>
                <td><label>Employee Number:</label></td>
                <td>
                    <input type="text" name="txte_no" id="txte_no" value="<?php echo htmlspecialchars($ve_no); ?>" readonly>
                </td>
            </tr>

            <tr>
                <td><label>Last Name:</label></td>
                <td>
                    <input readonly type="text" value="<?php echo htmlspecialchars($vlName); ?>">
                </td>
            </tr>
            
            <tr>
                <td><label>First Name:</label></td>
                <td>
                    <input readonly type="text" value="<?php echo htmlspecialchars($vfName); ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="button" value="Delete Record" onclick="submitToDeleteSave()" />
                    <button type="button" onClick="window.location.href='../../employees.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>

<script>
function submitToDeleteSave() {
    if (confirm("Are you sure you want to delete this employee? This action cannot be undone.")) {
        document.getElementById("formdelete").action = "e_delete-save.php";
        document.getElementById("formdelete").submit();
    }
}
</script>
</body>
</html>