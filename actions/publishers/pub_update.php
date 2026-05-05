<!-- FOR PUBLISHER ACTION -->
<?php
require("../../include/conn.php");

    // Initialize variables
    $vpub_id = "";
    $vpub_title = "";
    $vheadquarters = "";
    $vyear_founded = "";

    // Check if publisher exists via GET
    if (isset($_GET['vid']) && !empty($_GET['vid'])) {
        $vpub_id = mysqli_real_escape_string($conn, $_GET['vid']);
        
        // Fetch existing record from publishers table[cite: 27, 29]
        $sql = "SELECT * FROM publishers WHERE pub_id = '$vpub_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $vpub_id       = $row['pub_id'];
            $vpub_title    = $row['pub_title'];
            $vheadquarters = $row['headquarters'];
            $vyear_founded = $row['year_founded'];
        }
    }
?>

<html>
    <body>
        <form action="pub_update-save.php" method="post" name="formupdate" novalidate>
        <table border="1">    
            <tr>
                <td colspan="2" align="center"><b>Update Publisher Record</b></td>
            </tr>

            <!-- Hidden field for primary key -->
            <input type="hidden" name="txtpub_id" value="<?php echo $vpub_id; ?>">                

            <tr>
                <td><label>Publisher ID:</label></td>
                <td><strong><?php echo htmlspecialchars($vpub_id); ?></strong> (Read-Only)</td>
            </tr>

            <tr>
                <td><label>Publisher Title:</label></td>
                <td><input type="text" name="txtpub_title" value="<?php echo htmlspecialchars($vpub_title); ?>"></td>
            </tr>
            
            <tr>
                <td><label>Headquarters:</label></td>
                <td><input type="text" name="txtheadquarters" value="<?php echo htmlspecialchars($vheadquarters); ?>"></td>
            </tr>

            <tr>
                <td><label>Year Founded:</label></td>
                <td>
                    <!-- type="number" ensures only year values are entered[cite: 26] -->
                    <input type="number" name="txtyear_founded" min="1901" max="2155" value="<?php echo htmlspecialchars($vyear_founded); ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Update Record" />
                    <button type="button" onClick="window.location.href='../../publishers.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>
    </body>
</html>