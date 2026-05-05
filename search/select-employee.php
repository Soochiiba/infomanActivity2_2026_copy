<?php
    require_once('../include/conn.php');

    // Get the selected employee number from the dropdown
    $vsearch = isset($_POST['txtsearch']) ? mysqli_real_escape_string($conn, $_POST['txtsearch']) : "";

    $result = null;
    if ($vsearch != "") {
        /* 
           We join dep_assignment to link the employee to their department.
           We also join positions directly from the employees table to get the job title.
        */
                $sql = "SELECT 
                    e.e_idNum, 
                    e.fName, 
                    e.lName, 
                    p.pos_title, 
                    d.dep_desc
                FROM dep_assignment da
                INNER JOIN employees e ON da.e_id = e.e_no
                INNER JOIN departments d ON da.dep_id = d.dep_id
                INNER JOIN positions p ON e.pos_id = p.pos_id
                WHERE da.e_id = '$vsearch'";
        
        $result = $conn->query($sql);
        
        if (!$result) {
            die("Query Failed: " . $conn->error);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Assignment View</title>
    <style>
        /* Styling adapted from select-faculty.php */
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
            width: 80%;
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
        <h2>Employee Lookup</h2>
        <form name="frm1" method="post" action="select-employee.php">
            <select name="txtsearch" id="txtsearch" onchange="this.form.submit()">
                <option value=""> -- Select Employee -- </option>    
                <?php
                    $sql1 = "SELECT e_no, fName, lName FROM employees ORDER BY lName";
                    $resEmp = $conn->query($sql1);
                        while($row1 = $resEmp->fetch_assoc()) {
                            $selected = ($vsearch == $row1['e_no']) ? "selected" : "";
                            echo "<option value='".$row1['e_no']."' $selected>".$row1['lName'].", ".$row1['fName']."</option>";
                        }
                ?>
            </select>
        </form>

        <button class="back-btn" type="button" onClick="window.location.href='search.php'"> Back </button>

        <button class="back-btn" type="button" 
            <?php if ($vsearch == "") echo "disabled style='opacity: 0.5; cursor: not-allowed;'"; ?>
            onClick="window.location.href='../TCPDF/tcpdf6/tcpdf/examples/mcs-empDep.php?vid=<?php echo $vsearch; ?>'"> 
            Print 
        </button>

        <button class="back-btn" type="button" onClick="window.location.href='../employees.php'"> List </button>
    </div>

    <?php if ($vsearch != "" && $result): ?>
    <table class="results-table">
        <thead>
            <tr>
                <th> ID Number </th> 
                <th> Full Name </th>
                <th> Position </th>
                <th> Department </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['e_idNum'] . "</td> 
                            <td>" . $row['fName'] . " " . $row['lName'] . "</td>
                            <td>" . $row['pos_title'] . "</td>
                            <td>" . $row['dep_desc'] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center;'>No details found for this employee.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php endif; ?>

</body>
</html>