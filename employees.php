<?php
    require_once('include/conn.php');
    
    // Search logic handler
    $vsearch = isset($_POST['txtsearch']) ? mysqli_real_escape_string($conn, $_POST['txtsearch']) : "";

    if ($vsearch != "") {
        $sql = "SELECT * FROM employees 
                WHERE e_no LIKE '%$vsearch%' 
                OR    e_idNum      LIKE '%$vsearch%' 
                OR    pos_id      LIKE '%$vsearch%'
                OR    lName         LIKE '%$vsearch%'
                OR    fName     LIKE '%$vsearch%' 
                OR    hire_date     LIKE '%$vsearch%'
                ORDER BY e_no";
    } else {
        $sql = "SELECT * FROM employees ORDER BY e_no";
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
        <title>Employee List</title>
    </head>

    <body>
        <form method="POST" action="employees.php">
            <input type="text" name="txtsearch" placeholder="Search employees..." value="<?php echo htmlspecialchars($vsearch); ?>">
            <button type="submit">  Search  </button>
            <a href="employees.php"><button type="button"> All </button></a>

            <button type="reset" class="btn btn-warning btn-s" onClick="window.location.href='TCPDF/tcpdf6/tcpdf/examples/mcs-employees.php'"> Print </button>
            <button type="reset" class="btn btn-warning btn-s" onClick="window.location.href='actions/employees/e_insert.php'"> Insert </button>
        </form>
        
        <table border="1" cellspacing="1">
            <tr>
                <th>    Employee Number </th>
                <th>    Employee ID      </th>
                <th>    Position     </th>
                <th>    Last Name    </th>
                <th>    First Name         </th>
                <th>    Hire Date       </th>
                <th>    Action         </th>
            </tr>

            <?php
            if($result1 && $result1->num_rows > 0) {
                while($row = $result1->fetch_assoc()) {
                    $ve_no = $row['e_no'];
                    $ve_idNum      = $row['e_idNum'];
                    $vpos_id      = $row['pos_id'];
                    $vlName     = $row['lName'];
                    $vfName     = $row['fName'];
                    $vhire_date = $row['hire_date'];
            ?>
                <tr>
                    <td><?php echo $ve_no; ?></td>
                    <td><?php echo $ve_idNum; ?></td>   
                    <td><?php echo $vpos_id; ?></td>  
                    <td><?php echo $vlName; ?></td>  
                    <td><?php echo $vfName; ?></td> 
                    <td><?php echo $vhire_date; ?></td>
                    <td> 
                        <button type="button" class="btn btn-warning btn-s" onClick="window.location.href='actions/employees/e_update.php?vid=<?php echo $ve_no; ?>'">Update</button>
                        <button type="button" class="btn btn-warning btn-s" onClick="window.location.href='actions/employees/e_delete.php?vid=<?php echo $ve_no; ?>'">Delete</button>
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