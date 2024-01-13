<?php
include("connection.php");
var_dump();
// Start the session (assuming you haven't started it elsewhere)
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['noticeDate']) && isset($_POST['noticeTitle']) && isset($_POST['noticeField'])) {
    // Handle the form submission for the Notice Board
    $noticeDate = mysqli_real_escape_string($conn, $_POST['noticeDate']);
    $noticeTitle = mysqli_real_escape_string($conn, $_POST['noticeTitle']);
    $noticeField = mysqli_real_escape_string($conn, $_POST['noticeField']);
   

    // Get the staffID of the logged-in user
    $loggedInStaffID = $_SESSION['staffID'];

    // Insert into the notice table (modify the table name accordingly)
    $insertNoticeQuery = "INSERT INTO importantnotice (noticeDate, noticeTitle, noticeField) VALUES ('$noticeDate', '$noticeTitle', '$noticeField')";
    $insertNoticeResult = mysqli_query($conn, $insertNoticeQuery);

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
