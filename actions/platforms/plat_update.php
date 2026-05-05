<!-- FOR PLATFORM ACTION -->
<?php
require("../../include/conn.php");

    // Initialize variables based on platforms table structure[cite: 19, 21]
    $vplat_id = "";
    $vplat_title = "";

    // Check if platform ID exists via GET[cite: 19]
    if (isset($_GET['vid']) && !empty($_GET['vid'])) {
        $vplat_id = mysqli_real_escape_string($conn, $_GET['vid']);
        
        // Fetch existing record from platforms table[cite: 19, 21]
        $sql = "SELECT * FROM platforms WHERE plat_id = '$vplat_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $vplat_id    = $row['plat_id'];
            $vplat_title = $row['plat_title'];
        }
    }
?>

<html>
    <body>
        <form action="plat_update-save.php" method="post" name="formupdate" novalidate>
        <table border="1">    
            <tr>
                <td colspan="2" align="center"><b>Update Platform Record</b></td>
            </tr>

            <!-- Hidden field to pass the primary key[cite: 19] -->
            <input type="hidden" name="txtplat_id" value="<?php echo $vplat_id; ?>">                

            <tr>
                <td><label>Platform ID:</label></td>
                <td><strong><?php echo htmlspecialchars($vplat_id); ?></strong> (Read-Only)</td>
            </tr>

            <tr>
                <td><label>Platform Title:</label></td>
                <td><input type="text" name="txtplat_title" value="<?php echo htmlspecialchars($vplat_title); ?>"></td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Update Record" />
                    <button type="button" onClick="window.location.href='../../platforms.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>
    </body>
</html>