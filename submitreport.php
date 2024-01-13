<?php
session_start(); // Start the session

// Check if 'ID' is set in the session
$loggedInID = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;

// Check if the 'ID' session variable is set
if (!$loggedInID) {
    // Redirect to login page if the user is not logged in
    header("Location: studentlogin.php");
    exit();
}

    $reportType = isset($_POST['reportType']) ? $_POST['reportType'] : null;
    $reportDescription = isset($_POST['reportDescription']) ? $_POST['reportDescription'] : null;
    $reportCategory = ($reportType === 'House') ? (isset($_POST['reportCategory']) ? $_POST['reportCategory'] : null) : null;

    // Check if the file upload field is set and not empty
    if (isset($_FILES['uploadEvidence']) && !empty($_FILES['uploadEvidence']['name'])) {
        $uploadEvidence = file_get_contents($_FILES['uploadEvidence']['tmp_name']);
    } else {
        // Handle the case where no file is uploaded
        $uploadEvidence = null;
    }

if (!empty($reportType) && !empty($reportDescription)) {
    $servername = "localhost";
    $ID = "root";
    $IDpassword = "";
    $db_name = "murnireportingsystem2";

    // Create connection
    $conn = new mysqli($servername, $ID, $IDpassword, $db_name);

    if (mysqli_connect_error()) {
        die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    } else {
        // Use the logged-in user's ID as the resident ID
        $ID = $loggedInID;

        // Admin's foreign key will be set to NULL for user submissions
        $adminID = null;

        // Admin's foreign key will be set to NULL for user submissions
        $staffID = null;



     // Prepare INSERT statement
        $INSERT = "INSERT INTO report (ID, adminID, staffID, reportType, reportCategory, uploadEvidence, reportDescription, reportDate) VALUES (?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";

        $stmt = $conn->prepare($INSERT);

        if ($stmt) {
            // Adjust binding based on the chosen report type
            if ($reportCategory === 'Compound') {
                $stmt->bind_param("ssssbss", $ID, $adminID, $staffID, $reportType, null, $uploadEvidence, $reportDescription);
            } else {
                $stmt->bind_param("ssssbss", $ID, $adminID, $staffID, $reportType, $reportCategory, $uploadEvidence, $reportDescription);
            }

            $stmt->execute();
            echo "New record inserted successfully";

            // Redirect to viewprogressreport.php after successful insertion
            header("Location: viewprogressreport.php");
            exit();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }

        $conn->close();
    }
} else {
    echo "All fields are required";
    die();
}
?>
