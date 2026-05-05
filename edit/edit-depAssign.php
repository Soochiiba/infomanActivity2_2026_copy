<?php
    require_once('../include/conn.php');

    $vsearch = isset($_POST['txtsearch']) ? mysqli_real_escape_string($conn, $_POST['txtsearch']) : "";

    // SQL logic with JOINs to display readable names instead of IDs
    if ($vsearch != "") {
        $sql = "SELECT da.assign_id, e.fName, e.lName, d.dep_desc 
                FROM dep_assignment da
                INNER JOIN employees e ON da.e_id = e.e_no
                INNER JOIN departments d ON da.dep_id = d.dep_id
                WHERE e.fName LIKE '%$vsearch%' 
                OR e.lName LIKE '%$vsearch%' 
                OR d.dep_desc LIKE '%$vsearch%'
                ORDER BY da.assign_id";
    } else {
        $sql = "SELECT da.assign_id, e.fName, e.lName, d.dep_desc 
                FROM dep_assignment da
                INNER JOIN employees e ON da.e_id = e.e_no
                INNER JOIN departments d ON da.dep_id = d.dep_id
                ORDER BY da.assign_id";
    }

    $result = $conn->query($sql);
?>

<html>
    <head>
        <title>Edit Department Assignments</title>
        <style>
            /* Styling adapted from your assignment.php */
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
            .btn-edit { background-color: #f0ad4e; } /* Orange for Update/Edit */
            .btn-delete { background-color: #d9534f; } /* Red for Delete */
        </style>
    </head>
    <body>
        <h2>Edit Department Assignments</h2>
        
        <form method="POST" action="edit-depAssign.php">
            <input type="text" name="txtsearch" placeholder="Search..." value="<?php echo htmlspecialchars($vsearch); ?>">
            <button type="submit">Search</button>
            <a href="edit-depAssign.php"><button type="button">All</button></a>
            <button type="reset" class="btn btn-warning btn-s" onClick="window.location.href='../TCPDF/tcpdf6/tcpdf/examples/mcs-depAssign.php'"> Print </button>
            <button type="button" onClick="window.location.href='../actions/dep_assign/da_insert.php'"> Insert New Assignment </button>
        </form>
        
        <table border="1">
            <tr>
                <th> Assign ID </th>
                <th> Employee Name </th>
                <th> Department </th>
                <th> Actions </th>
            </tr>

            <?php
            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $vassign_id = $row['assign_id'];
                    $vfullname  = $row['fName'] . " " . $row['lName']; // Joined names
                    $vdep_desc  = $row['dep_desc'];
            ?>
                <tr>
                    <td><?php echo $vassign_id; ?></td>
                    <td><?php echo $vfullname; ?></td>   
                    <td><?php echo $vdep_desc; ?></td>  
                    <td>
                        <button type="button" class="btn-edit" 
                                onClick="window.location.href='../actions/dep_assign/da_update.php?vid=<?php echo $vassign_id; ?>'">
                            Update
                        </button>
                        <button type="button" class="btn-delete" 
                                onClick="if(confirm('Delete this assignment?')) { window.location.href='../actions/dep_assign/da_delete.php?vid=<?php echo $vassign_id; ?>'; }">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php     
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center;'>No assignments found.</td></tr>";
            }
            ?>
        </table>
        <br>
        <button type="button" onClick="window.location.href='edit.php'">Back</button>
    </body>
</html>