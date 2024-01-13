<?php
include("connection.php");

// Start the session (assuming you haven't started it elsewhere)
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $announDate = mysqli_real_escape_string($conn, $_POST['announDate']);
    $announDateTo = mysqli_real_escape_string($conn, $_POST['announDateTo']);
    $announTitle = mysqli_real_escape_string($conn, $_POST['announTitle']);
    $announData = mysqli_real_escape_string($conn, $_POST['announData']);

    // Get the staffID of the logged-in user
    $loggedInStaffID = $_SESSION['staffID'];

    // Insert data into the importantannouncement table with staffID as foreign key
    $insertQuery = "INSERT INTO importantannouncement (announDate, announDateTo, announTitle, announData, staffID) VALUES ('$announDate', '$announDateTo', '$announTitle', '$announData', '$loggedInStaffID')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        header("Location: viewreport.php");
        exit();
    } else {
        echo "Error adding notice: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method";
}

mysqli_close($conn);
?>
