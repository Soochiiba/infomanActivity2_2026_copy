<?php
    require_once('../include/conn.php');

    // Get the selected game ID from the dropdown
    $vsearch = isset($_POST['txtsearch']) ? mysqli_real_escape_string($conn, $_POST['txtsearch']) : "";

    $resultTable = null;
    if ($vsearch != "") {
        /* 
           Query joins game_publishing with games and publishers 
           to display titles instead of just IDs.
        */
        $sql = "SELECT 
                    g.game_title, 
                    p.pub_title
                FROM game_publishing gp
                INNER JOIN games g ON gp.game_id = g.game_id
                INNER JOIN publishers p ON gp.pub_id = p.pub_id
                WHERE gp.game_id = '$vsearch'";
        
        $resultTable = $conn->query($sql);
        
        if (!$resultTable) {
            die("Query Failed: " . $conn->error);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Game Publisher View</title>
    <style>
        /* Styling maintained from select-employee.php */
        body {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding-top: 50px;
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-container {
            background-color: #4A90E2; 
            padding: 40px;
            border-radius: 20px;       
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            width: 400px;
            color: white;
            margin-bottom: 30px;
        }
        .results-table {
            width: 60%;
            border-collapse: collapse; 
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            border-radius: 8px;
            overflow: hidden; 
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
        select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        .back-btn {
            font-weight: bold;
            margin-top: 20px;
            background: #357ABD;
            border: 1px solid white;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="main-container">
        <h2>Game Publisher Lookup</h2>
        <form name="frm1" method="post" action="select-gamePub.php">
            <select name="txtsearch" id="txtsearch" onchange="this.form.submit()">
                <option value=""> -- Select Game Title -- </option>    
                <?php
                // Populate dropdown with game titles[cite: 23]
                $sql1 = "SELECT game_id, game_title FROM games ORDER BY game_title";
                $resGame = $conn->query($sql1);
                while($row1 = $resGame->fetch_assoc()) {
                    $selected = ($vsearch == $row1['game_id']) ? "selected" : "";
                    echo "<option value='".$row1['game_id']."' $selected>".$row1['game_title']."</option>";
                }
                ?>
            </select>
        </form>
        <button class="back-btn" type="button" onClick="window.location.href='search.php'"> Back </button>
        
        <button class="back-btn" type="button" 
            <?php if ($vsearch == "") echo "disabled style='opacity: 0.5; cursor: not-allowed;'"; ?>
            onClick="window.location.href='../TCPDF/tcpdf6/tcpdf/examples/mcs-gamPub.php?vid=<?php echo $vsearch; ?>'"> 
            Print 
        </button>

        <button class="back-btn" type="button" onClick="window.location.href='../games.php'"> List </button>
    </div>

    <?php if ($vsearch != "" && $resultTable): ?>
    <table class="results-table">
        <thead>
            <tr>
                <th> Game Title </th> 
                <th> Publisher </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($resultTable && $resultTable->num_rows > 0) {
                while($row = $resultTable->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['game_title']) . "</td> 
                            <td>" . htmlspecialchars($row['pub_title']) . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='2' style='text-align:center;'>No publisher assigned to this game.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php endif; ?>

</body>
</html>