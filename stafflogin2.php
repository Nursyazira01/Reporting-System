<?php
session_start(); // Start the session

$staffID = $_POST['staffID'];
$Staffpassword = $_POST['Staffpassword'];

// database connection here
$con = new mysqli("localhost", "root", "", "murnireportingsystem2");
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM staff WHERE staffID = ?");
    $stmt->bind_param("s", $staffID);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data["Staffpassword"] == $Staffpassword) {
            $_SESSION['staffID'] = $staffID; // Store user ID in the session
            header("Location: viewreport.php");
            exit(); // Ensure that no further code is executed after the redirection
        } else {
            echo "<h2>Incorrect Username or Password </h2>";
        }
    } else {
        echo "<h2>User does not exist</h2>";
    }
    $stmt->close();
}
?>
