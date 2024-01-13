<?php
session_start(); // Start the session

$ID = $_POST['ID'];
$IDpassword = $_POST['IDpassword'];

// database connection here
$con = new mysqli("localhost", "root", "", "murnireportingsystem2");
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM resident WHERE ID = ?");
    $stmt->bind_param("s", $ID);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data["IDpassword"] == $IDpassword) {
            $_SESSION['ID'] = $ID; // Store user ID in the session
            header("Location: makeonlinereport.php");
            exit(); // Ensure that no further code is executed after the redirection

        } else {
            
            echo "<h2>ewfewf</h2>";

        }
    } else {
        echo "<h2>Account does not exist, please go to UCC for any inquiries</h2>";
    }
    $stmt->close();
}
?>
