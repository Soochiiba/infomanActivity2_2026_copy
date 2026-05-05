<?php
    require_once('../include/conn.php');

    $vsearch = isset($_POST['txtsearch']) ? mysqli_real_escape_string($conn, $_POST['txtsearch']) : "";

    // SQL logic with JOINs to display readable game and publisher names instead of IDs
    if ($vsearch != "") {
        $sql = "SELECT gp.gpub_id, g.game_title, p.pub_title 
                FROM game_publishing gp
                INNER JOIN games g ON gp.game_id = g.game_id
                INNER JOIN publishers p ON gp.pub_id = p.pub_id
                WHERE g.game_title LIKE '%$vsearch%' 
                OR p.pub_title LIKE '%$vsearch%'
                ORDER BY gp.gpub_id";
    } else {
        $sql = "SELECT gp.gpub_id, g.game_title, p.pub_title 
                FROM game_publishing gp
                INNER JOIN games g ON gp.game_id = g.game_id
                INNER JOIN publishers p ON gp.pub_id = p.pub_id
                ORDER BY gp.gpub_id";
    }

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Game Publishing</title>
        <style>
            /* Styling adapted from your edit-depAssign.php */
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f4f7f6;
                padding: 40px;
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse; 
                background-color: white;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
                border-radius: 8px;
                overflow: hidden; 
                margin-top: 20px;
            }

            th {
                background-color: #4A90E2;
                color: white;
                text-align: left;
                padding: 15px;
                text-transform: uppercase;
                font-size: 14px;
            }

            td {
                padding: 12px 15px;
                border-bottom: 1px solid #eee;
            }

            tr:nth-child(even) { background-color: #f9f9f9; }
            tr:hover { background-color: #f1f7ff; transition: 0.3s; }

            input[type="text"] {
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                width: 250px;
            }

            button {
                padding: 10px 20px;
                background-color: #4A90E2;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            button:hover { background-color: #357ABD; }
            .btn-edit { background-color: #f0ad4e; }
            .btn-delete { background-color: #d9534f; }
            .btn-print { background-color: #f0ad4e; }
        </style>
    </head>
    <body>
        <h2>Edit Game Publishing Assignments</h2>
        
        <form method="POST" action="edit-gamePub.php">
            <input type="text" name="txtsearch" placeholder="Search Game or Publisher..." value="<?php echo htmlspecialchars($vsearch); ?>">
            <button type="submit">Search</button>
            <a href="edit-gamePub.php"><button type="button">All</button></a>
            <!-- Link to your existing Print script -->
            <button type="button" class="btn-print" onClick="window.location.href='../TCPDF/tcpdf6/tcpdf/examples/mcs-gamPub.php'"> Print </button>
            <button type="button" onClick="window.location.href='../actions/game_pub/gp_insert.php'"> Insert New Publishing </button>
        </form>
        
        <table>
            <tr>
                <th> Publishing ID </th>
                <th> Game Title </th>
                <th> Publisher </th>
                <th> Actions </th>
            </tr>

            <?php
            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $vgpub_id    = $row['gpub_id'];
                    $vgame_title = $row['game_title'];
                    $vpub_title  = $row['pub_title'];
            ?>
                <tr>
                    <td><?php echo $vgpub_id; ?></td>
                    <td><?php echo $vgame_title; ?></td>   
                    <td><?php echo $vpub_title; ?></td>  
                    <td>
                        <button type="button" class="btn-edit" 
                                onClick="window.location.href='../actions/game_pub/gp_update.php?vid=<?php echo $vgpub_id; ?>'">
                            Update
                        </button>
                        <button type="button" class="btn-delete" 
                                onClick="if(confirm('Delete this publishing assignment?')) { window.location.href='../actions/game_pub/gp_delete.php?vid=<?php echo $vgpub_id; ?>'; }">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php     
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center;'>No publishing records found.</td></tr>";
            }
            ?>
        </table>
        <br>
        <button type="button" onClick="window.location.href='edit.php'">Back</button>
    </body>
</html>