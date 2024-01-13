<?php
session_start();
include("connection.php");

$loggedInID = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;

if ($loggedInID) {
    // Query to retrieve name and contact number based on the user's ID
    $query = "SELECT Name, ContactNumber,houseNumber, roomNumber, block, floor FROM resident WHERE ID = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $loggedInID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        $Name = htmlspecialchars($userData['Name']);
        $contactNumber = htmlspecialchars($userData['ContactNumber']);
        $houseNumber = htmlspecialchars($userData['houseNumber']);
        $roomNumber = htmlspecialchars($userData['roomNumber']);
        $block = htmlspecialchars($userData['block']);
        $floor = htmlspecialchars($userData['floor']);


    } else {
        // Handle the case where user data is not found
        $Name = "Name not found";
        $contactNumber = "Contact number not found";
        $houseNumber = "House number not found";
        $roomNumber = "Room number not found";
        $block = "Block number not found";
        $floor = "Floor number not found";

    }
} else {
    // Redirect to login page if the user is not logged in
    header("Location: studentlogin.php");
    exit();
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

        /* Center the form on the page */
            {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

   
        }

        /* Style the text input */
    input[type="text"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 100px;
      box-sizing: border-box;
    }

    /* Style the submit/reset button */
    input[type="reset"] {
      background-color: #4caf50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="reset"]:hover {
      background-color: #45a049;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }


    </style>

    <script>


        
        // JavaScript function to reset form fields
        function resetForm() {
            
            
            document.getElementById("typeCat").value = "Curtains"; // Reset dropdown to default
            document.getElementById("file").value = ""; // Reset file input
            document.getElementById("reportDescription").value = "";
        }
    </script>


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
            <br><br><br><br><br>


            
            <form action="submitreport.php" method="post" enctype="multipart/form-data">

                <label for="studentId">Student ID: </label><input type="text" id="studentId" name="ID" value="<?php echo htmlspecialchars($loggedInID); ?>" readonly><br><br>
            
            <label for="fullName">Full name:</label>
                <input type="text" id="fullName" name="Name" value="<?php echo htmlspecialchars($Name); ?>" readonly><br><br>

                <label for="contactNumber">Contact Number:</label>
                <input type="text" id="contactNumber" name="contactNumber" value="<?php echo htmlspecialchars($contactNumber); ?>" readonly><br><br>    

                
                <label for="houseNumber">House Number:</label>
                <input type="text" id="houseNumber" name="houseNumber" value="<?php echo htmlspecialchars($houseNumber); ?>" readonly><br><br>

                <label for="roomNumber">Room Number:</label>
                <input type="text" id="roomNumber" name="roomNumber" value="<?php echo htmlspecialchars($roomNumber); ?>" readonly><br><br>

                
         
                <label for="floor">House Floor:</label><input type="text" id="floor" name="floor" value="<?php echo htmlspecialchars($floor); ?>" readonly><br><br>
                        


 <label for="typeofreport">Report Type:</label>   
                        <select id="typeofreport" name="reportType" >
                        <option value="Compound">Compound</option>
                        <option value="House">House</option>
                        </select>
                        <br><br>

                <label for="typeofcategory">Report Category:</label>   
                        <select id="typecategory" name="reportcategory" >
                        <option value="Curtains">Curtains</option>
                        <option value="Sink">Sink</option>
                        </select>
                        <br><br>

                       

      
                <label for="uploadEvidence">Upload Evidence:</label>
                    
                <label for="file">Select a file:</label>
                <input type="file" name="uploadEvidence" id="file" accept="image/*">
                <input type="submit" value="Upload">
                <br><br>

                <label for="reportDescription">Report Description:</label>
                <input type="text" id="reportDescription" name="reportDescription" placeholder="Type something..."><br><br>
                <input type="reset" value="Reset" onclick="resetForm()">
                <input type="submit" value="Submit">
                
            </form>
           
        </div>
    </div>
</body>
</html>