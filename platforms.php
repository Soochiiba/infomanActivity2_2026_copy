<?php
    require_once('include/conn.php');
    
    // Search logic handler
    $vsearch = isset($_POST['txtsearch']) ? mysqli_real_escape_string($conn, $_POST['txtsearch']) : "";

    if ($vsearch != "") {
        $sql = "SELECT * FROM platforms 
                WHERE plat_id LIKE '%$vsearch%' 
                OR    plat_title      LIKE '%$vsearch%' 
                OR    plat_id      LIKE '%$vsearch%'
                ORDER BY plat_id";   
    } else {
        $sql = "SELECT * FROM platforms ORDER BY plat_id";
    }

    $result1 = $conn->query($sql);
    if (!$result1) {
    die("Query Failed: " . $conn->error);
    }
?>

<html>
    <style>
        body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f7f6;
        padding: 40px;
        color: #333;
        }

        /* Table Container styling */
        table {
            width: 100%;
            border-collapse: collapse; 
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            border-radius: 8px;
            overflow: hidden; 
        }

        /* Header styling */
        th {
            background-color: #4A90E2;
            color: white;
            text-align: left;
            padding: 15px;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        /* Cell styling */
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        /* Zebra Striping */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Hover effect */
        tr:hover {
            background-color: #f1f7ff;
            transition: 0.3s;
        }

        /* Search Bar UI */
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

        button:hover {
            background-color: #357ABD;
        }
    </style>

    <head>
        <title>Platform List</title>
    </head>

    <body>
        <form method="POST" action="platforms.php">
            <input type="text" name="txtsearch" placeholder="Search platforms..." value="<?php echo htmlspecialchars($vsearch); ?>">
            <button type="submit">  Search  </button>
            <a href="platforms.php"><button type="button"> All </button></a>

            <button type="reset" class="btn btn-warning btn-s" onClick="window.location.href='TCPDF/tcpdf6/tcpdf/examples/mcs-platforms.php'"> Print </button>
            <button type="reset" class="btn btn-warning btn-s" onClick="window.location.href='actions/platforms/plat_insert.php'"> Insert </button>
        </form>
        
        <table border="1" cellspacing="1">
            <tr>
                <th>    Position ID         </th>
                <th>    Position Title      </th>
                <th>    Actions             </th>
            </tr>

            <?php
            if($result1 && $result1->num_rows > 0) {
                while($row = $result1->fetch_assoc()) {
                    $vplat_id = $row['plat_id'];
                    $vplat_title      = $row['plat_title'];
            ?>
                <tr>
                    <td><?php echo $vplat_id; ?></td>
                    <td><?php echo $vplat_title; ?></td> 
                    <td> 
                        <button type="button" class="btn btn-warning btn-s" onClick="window.location.href='actions/platforms/plat_update.php?vid=<?php echo $vplat_id; ?>'">Update</button>
                        <button type="button" class="btn btn-warning btn-s" onClick="window.location.href='actions/platforms/plat_delete.php?vid=<?php echo $vplat_id; ?>'">Delete</button>
                    </td> 
                     
                </tr>
            <?php     
                }
            } else {
                echo "<tr><td colspan='7'>No records found.</td></tr>";
            }
            ?>
        </table>
        <br>
        <button type="button" onClick="window.location.href='index.php'">   Back    </button>
    </body>
</html>