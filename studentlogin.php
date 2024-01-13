<?php
    include("connection.php");

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

        {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: #F2DADF;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            position: absolute;
            top: 50%; /* Adjust the desired vertical position */
            left: 50%; /* Adjust the desired horizontal position */
            transform: translate(-50%, -50%);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;

            }

        .login-box input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .login-box button {
            background-color: #ff0090;
            color: #000;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-weight: bold;
        }


    </style>
</head>
<body>
    <div id="banner">
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
        </div>

            <div class="login-box">
                <h3>LOGIN PAGE FOR STUDENT</h3>
                <p>Please login first. Only registered are allow to access to this page</p>
                <form action="studentlogin2.php" method="post">
                    <input type="text" placeholder="Username" name="ID" required>
                    <input type="password" placeholder="Password" name="IDpassword" required>
                    <button type="submit" name= "submit">Login</button></a>
                </form>
            </div>
            
        </div>

    </div>


    <script>


<?php
session_start(); // Start session for user authentication


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserID = $_POST['UserID'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM logintable WHERE UserID = ID";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $UserID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['IDpassword'])) {
            // Password is correct, set session variables and redirect to onlinereportHOLD.html
            $_SESSION['ID'] = $UserID;
            header("Location: onlinereporthold.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    $stmt->close();
}

$conn->close();
?>

        </script>
</body>
</html>