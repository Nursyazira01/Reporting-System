<?php
    include("connection.php");

// Fetch data from the 'importantannouncement' table with a condition and sorting
$queryAnnouncement = "SELECT * FROM importantannouncement WHERE announDateTo >= CURDATE() ORDER BY announDateTo ASC";
$resultAnnouncement = mysqli_query($conn, $queryAnnouncement);

// Check for errors in the query
if (!$resultAnnouncement) {
    echo "Error: " . mysqli_error($conn);
}

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
            background-color: #ff0090;
            color: #000;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        #info-box {
            float: left;
            width: 20%;
            padding: 30px;
            background-color: #f0f0f0;
        }

        .banner{
            width: 80%;
            height: 30%;
        }

        /* Add border styles for the table, th, and td */
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

    </style>
</head>
<body>
    <div class="banner">
        <img src="murnibanner.jpg" alt="Banner Image">
        <h1>Murni Resident Reporting System</h1>
    </div>

    <div id="content-container">
        <div id="info-box">
            <table>
                <tr>
                    <th><h2>Hello Murnians!</h2></th>
                </tr>
                <tr>
                    <td>This is the information section on the left side of the homepage. You can add any content or information you want here.</td>
                </tr>
            </table>
        </div>

        <div id="buttons">
             <a href="index.php" class="button">Homepage</a>
           <a href="studentlogin.php" class="button">Make Online Report</a>
            <a href="viewprogressreport.php" class="button">View Progress Report</a>
            <a href="stafflogin.php" class="button">View Report</a>

            <div style="text-align: center; margin-top: 50px;">
        <h2>Important date</h2>
        
    <div>
        <table>
            <tr>
                <th>DATE FROM</th>
                <th>DATE TO</th>
                <th>NOTICE</th>
            </tr>

            <?php
            // Loop through the result of the 'importantannouncement' query
            while ($rowAnnouncement = mysqli_fetch_assoc($resultAnnouncement)) {
                ?>
                <tr>
                    <td><?php echo $rowAnnouncement['announDate']; ?></td>
                    <td><?php echo $rowAnnouncement['announDateTo']; ?></td>
                    <td><?php echo $rowAnnouncement['announTitle']; ?><br><?php echo $rowAnnouncement['announData']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    <h2>Important Notice</h2>
    <p>This is some centered text on the homepage.</p>
</div>

           
        </div>
    </div>
</body>
</html>