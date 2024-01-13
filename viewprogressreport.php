<?php
    include("connection.php");
    $query = "SELECT * FROM report ORDER BY reportDate DESC";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        #banner {
            background-color: #0074D9;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        #content-container {
            display: flex;
        }
        #buttons {
            background-color: #f0f0f0;
            padding: 20px;
        }
        .button {
            background-color: #0074D9;
            color: #fff;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            cursor: pointer;
        }
        #info-box {
            float: left;
            width: 20%;
            padding: 30px;
            background-color: #f0f0f0;
        }
        #centered-content {
            text-align: center;
            margin-top: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="banner">
        <h1>Murni Reporting System</h1>
    </div>

    <div id="content-container">
        <div id="info-box">
            <h2>Information Section</h2>
            <p>This is the information section on the left side of the homepage. You can add any content or information you want here.</p>
        </div>

        <div id="buttons">
            <a href="index.php" class="button">Homepage</a>
            <a href="studentlogin.php" class="button">Make Online Report</a>
            <a href="viewprogressreport.php" class="button">View Progress Report</a>
            <a href="stafflogin.php" class="button">View Report</a>

            <div style="text-align: center; margin-top: 50px;">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Student ID/Staff ID</th>
                        <th>Report ID</th>
                        <th>Report Type</th>
                        <th>Category</th>
                        <th>Report Description</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>

                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['reportDate']; ?></td>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['reportID']; ?></td>
                            <td><?php echo $row['reportType']; ?></td>
                            <td><?php echo $row['reportCategory']; ?></td>
                            <td><?php echo $row['reportDescription']; ?></td>
                            <td><?php echo empty($row['reportAction']) ? 'Action will be taken' : $row['reportAction']; ?></td>
                            <td><?php echo empty($row['reportStatus']) ? 'Pending' : $row['reportStatus']; ?></td>

                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
