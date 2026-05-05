<?php
    require_once('include/conn.php');

    $vsearch = isset($_POST['txtsearch']) ? mysqli_real_escape_string($conn, $_POST['txtsearch']) : "";

    // SQL logic with JOINs to link release_prices with games, platforms, and publishers
    $sql = "SELECT 
                rp.rel_id, 
                g.game_title, 
                pl.plat_title, 
                rp.price 
            FROM release_prices rp
            INNER JOIN games g ON rp.game_id = g.game_id
            INNER JOIN platforms pl ON rp.plat_id = pl.plat_id";

    // Add search functionality if a search term is provided
    if ($vsearch != "") {
        $sql .= " WHERE g.game_title LIKE '%$vsearch%' 
                  OR pl.plat_title LIKE '%$vsearch%'";
    }

    $sql .= " ORDER BY rp.rel_id ASC";
    $result = $conn->query($sql);

    if (!$result) { die("Query Error: " . $conn->error); }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Game Releases & Pricing</title>
    <style>
        /* Styling maintained from edit-depAssign.php for consistency */
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
    </style>
</head>
<body>
    <h2>Game Release & Pricing Management</h2>
    
    <form method="POST" action="releases.php">
        <input type="text" name="txtsearch" placeholder="Search Game, Platform..." value="<?php echo htmlspecialchars($vsearch); ?>">
        <button type="submit">Search</button>
        <a href="releases.php"><button type="button">Show All</button></a>
        <button type="button" onClick="window.location.href='TCPDF/tcpdf6/tcpdf/examples/mcs-releases.php'"> Print </button>
        <button type="button" onClick="window.location.href='actions/releases/r_insert.php'"> Add New Release </button>
    </form>
    
    <table>
        <thead>
            <tr>
                <th> ID </th>
                <th> Game Title </th>
                <th> Platform </th>
                <th> Price </th>
                <th> Actions </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row['rel_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['game_title']); ?></td>   
                    <td><?php echo htmlspecialchars($row['plat_title']); ?></td>  
                    <td>$<?php echo number_format($row['price'], 2); ?></td>
                    <td>
                        <button type="button" class="btn-edit" 
                                onClick="window.location.href='actions/releases/r_update.php?vid=<?php echo $row['rel_id']; ?>'">
                            Update
                        </button>
                        <button type="button" class="btn-delete" 
                                onClick="if(confirm('Remove this release record?')) { window.location.href='actions/releases/r_delete.php?vid=<?php echo $row['rel_id']; ?>'; }">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php     
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>No release records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <button type="button" onClick="window.location.href='index.php'">Back</button>
</body>
</html>