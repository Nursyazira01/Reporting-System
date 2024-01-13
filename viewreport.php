<?php
	include("connection.php");
	session_start();

	// Get the staffID of the logged-in user
	$loggedInStaffID = $_SESSION['staffID'];

	$query = "SELECT * FROM report";
	$result = mysqli_query($conn, $query);
	$queryAnnouncement = "SELECT * FROM importantannouncement WHERE staffID = '$loggedInStaffID'";
	$resultAnnouncement = mysqli_query($conn, $queryAnnouncement);

	// Check if the delete button is clicked for report table
	if (isset($_POST['delete'])) {
    	$deleteID = $_POST['deleteID'];

    	// Perform delete operation in the database
    	$deleteQuery = "DELETE FROM report WHERE reportID = '$deleteID'";
    	$deleteResult = mysqli_query($conn, $deleteQuery);

    	if (!$deleteResult) {
        	echo "Error deleting record: " . mysqli_error($conn);
    	}
	}


	// Check if the update button is clicked for report table
	if (isset($_POST['update'])) {
    	$updateID = $_POST['updateID'];
    	$newAction = mysqli_real_escape_string($conn, $_POST['newAction']);
    	$newStatus = mysqli_real_escape_string($conn, $_POST['newStatus']);

    	// Perform update operation in the database
    	$updateQuery = "UPDATE report SET reportAction = '$newAction', reportStatus = '$newStatus', staffID = '$loggedInStaffID' WHERE reportID = '$updateID'";
    	$updateResult = mysqli_query($conn, $updateQuery);

    	if (!$updateResult) {
        	echo "Error updating record: " . mysqli_error($conn);
    		}
	}

	// Fetch the updated data after deletion or update
	$query = "SELECT * FROM report";
	$result = mysqli_query($conn, $query);

	// Check if the ADD button for important dates is clicked
	if (isset($_POST['DateButton'])) {
    	$announDate = mysqli_real_escape_string($conn, $_POST['announDate']);
    	$announData = mysqli_real_escape_string($conn, $_POST['announData']);

    	// Insert into the importantannouncement table
    	$insertQuery = "INSERT INTO importantannouncement (announDate, announDateTo, announTitle, announData, staffID) VALUES ('$announDate', '$announDateTo', '$announData', '$announTitle', '$loggedInStaffID')";
    	$insertResult = mysqli_query($conn, $insertQuery);

    	if (!$insertResult) {
        	echo "Error inserting record: " . mysqli_error($conn);
    	}
	}

	// Check if the delete button for Important Date Board is clicked
	if (isset($_POST['deleteAnnounNo'])) {
    	$deleteannounNo = $_POST['deleteAnnounNo'];

    	// Perform delete operation in the database
    	$deleteAnnounQuery = "DELETE FROM importantannouncement WHERE announNo = '$deleteannounNo'";
    	$deleteAnnounResult = mysqli_query($conn, $deleteAnnounQuery);

    	if (!$deleteAnnounResult) {
        	echo "Error deleting announcement: " . mysqli_error($conn);
    	}
	}

	if (isset($_POST['updateAnnouncement'])) {
    	// Get the announcement number to update
    	$updateAnnounNo = $_POST['updateAnnounNo'];

    	// Redirect or refresh the page as needed
    	header("Location: your_page.php");
	    	exit();
	}

	if (isset($_POST['editAnnouncement'])) {
    	// Get the announcement number to edit
    	$editAnnounNo = $_POST['editAnnounNo'];

    	// Perform actions to allow the user to edit the announcement
    	// Retrieve the data based on $editAnnounNo and populate the form for editing
    	$editAnnouncementQuery = "SELECT * FROM importantannouncement WHERE announNo = '$editAnnounNo'";
    	$editAnnouncementResult = mysqli_query($conn, $editAnnouncementQuery);

    	if ($editAnnouncementResult) {
        	$editAnnouncementData = mysqli_fetch_assoc($editAnnouncementResult);
        	// Use $editAnnouncementData to populate the form for editing
        	// ...
    	} else {
    	    echo "Error retrieving announcement data: " . mysqli_error($conn);
    	}
	}

// Handle Update Request
if (isset($_POST['updateAnnouncement'])) {
    $editedAnnounNo = $_POST['editAnnounNo'];
    $editedAnnounDate = mysqli_real_escape_string($conn, $_POST['editAnnounDate']);
    $editedAnnounDateTo = mysqli_real_escape_string($conn, $_POST['editAnnounDateTo']);
    $editedAnnounTitle = mysqli_real_escape_string($conn, $_POST['editAnnounTitle']);
    $editedAnnounData = mysqli_real_escape_string($conn, $_POST['editAnnounData']);

    // Perform the update operation in the database
    $updateAnnouncementQuery = "UPDATE importantannouncement SET announDate = '$editedAnnounDate', announDateTo = '$editedAnnounDateTo', announTitle = '$editedAnnounTitle', announData = '$editedAnnounData' WHERE announNo = '$editedAnnounNo'";
    $updateAnnouncementResult = mysqli_query($conn, $updateAnnouncementQuery);

    if ($updateAnnouncementResult) {
        // Redirect or refresh the page as needed
        header("Location: your_page.php");
        exit();
    } else {
        echo "Error updating announcement: " . mysqli_error($conn);
    }
}

// Check if the ADD button for important dates is clicked
	if (isset($_POST['NoticeButton'])) {
    	$noticeDate = mysqli_real_escape_string($conn, $_POST['noticeDate']);
    	$noticeData = mysqli_real_escape_string($conn, $_POST['noticeData']);

    	// Insert into the importantannouncement table
    	$insertQueryNotice = "INSERT INTO importantannotice (noticeDate, noticeTitle, noticeData, staffID) VALUES ('$noticeDate', '$noticeTitle', '$noticeData', '$loggedInStaffID')";
    	$insertResultNotice = mysqli_query($conn, $insertQueryNotice);

    	if (!$insertResultNotice) {
    		echo "Error inserting record: " . mysqli_error($conn);
		} else {
    		echo "Record inserted successfully!";
}

	}



?> 

<!DOCTYPE html> 
<html lang="en">

<head>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>

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

        #centered-content {
            text-align: center;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
        }

        th,td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
             white-space: normal;
        }

        .scrollable-table {
            overflow: auto;
            max-height: 400px;
            white-space: nowrap;
            /* Set the maximum height as needed */
        }

        .editButton {
        width: 50px; /* Adjust the width as needed */
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;

    }
    }

/* Add this if needed to handle table headers */
.scrollable-table thead {
    position: sticky;
    top: 0;
    background-color: #f0f0f0;
}

    </style>
</head>

<body>
    <div id="banner">
        <h1>Murni Reporting System</h1>
    </div>

    <div id="content-container">
        <div id="buttons">
            <a href="index.php" class="button">Homepage</a>
            <a href="studentlogin.php" class="button">Make Online Report</a>
            <a href="viewprogressreport.php" class="button">View Progress Report</a>
            <a href="stafflogin.php" class="button">View Report</a>
        </div>

        <div id="centered-content" style="text-align: center; margin-top: 100px;">
    <form method="post" action="" onsubmit="return confirmDelete();">
        <h2>Report's Detail</h2>

        <table class="scrollable-table">
            <tr>
                <th>Date</th>
                <th>Student ID</th>
                <th>Report ID</th>
                <th>Report Type</th>
                <th>Category</th>
                <th>Report Description</th>
                <th>Action</th>
                <th>Status</th>
                <th>Admin Comment</th>
                <th>Delete</th>
                <th></th>
                <th>Update</th>
                

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
                    <td><?php echo $row['reportAction']; ?></td>
                    
                    <td><?php echo $row['reportStatus']; ?></td>
                    <td><?php echo $row['adminComment']; ?></td>
                    <td>
                        <form method="post" action="" onsubmit="return confirmDelete();">
                                <input type="hidden" name="deleteID" value="<?php echo $row['reportID']; ?>">
                                <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>

                    <td>
    <form method="post" action="">
        <input type="hidden" name="updateID" value="<?php echo $row['reportID']; ?>">
        <input type="text" name="newAction" placeholder="New Action" value="<?php echo $row['reportAction']; ?>">
    

    
        <select name="newStatus">
            <option value="Submitted" <?php echo ($row['reportStatus'] == 'Submitted') ? 'selected' : ''; ?>>Submitted</option>
            <option value="Pending" <?php echo ($row['reportStatus'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="Action taken" <?php echo ($row['reportStatus'] == 'Action taken') ? 'selected' : ''; ?>>Action taken</option>
        </select>
    </td>

    <td>
        <button type="submit" name="update">Update</button>
        <input type="hidden" name="staffID" value="<?php echo $loggedInStaffID; ?>">
    </form>
</td>


                </tr>
            <?php
            }
            ?>
        </table>
    </form>
</div>

            <br><br>

            <form method="post" action="">
                <h2>IMPORTANT DATE BOARD</h2>
                <div class="scrollable-table">
                <table>
                    <tr>
                        <th>DATE FROM</th>
                        <th>DATE TO</th>
                        <th>TOPIC</th>
                        <th>NOTICE</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                    <?php
        // Loop through the result of the 'importantannouncement' query
        while ($rowAnnouncement = mysqli_fetch_assoc($resultAnnouncement)) {
            ?>
            <tr>
                <td><?php echo $rowAnnouncement['announDate']; ?></td>
                <td><?php echo $rowAnnouncement['announDateTo']; ?></td>
                <td><?php echo $rowAnnouncement['announTitle']; ?></td>
                <td><?php echo $rowAnnouncement['announData']; ?></td>
                
                <td>
            <!-- Add an Edit button with a unique identifier -->
            <button class="editButton" type="button" onclick="toggleEditFields('<?php echo $rowAnnouncement['announNo']; ?>')">Edit</button>
            <!-- Edit fields that will be displayed when Edit button is clicked -->
            <div class="editFields" id="editFields<?php echo $rowAnnouncement['announNo']; ?>" style="display: none;">
                <form method="post" action="">
                    <input type="hidden" name="editAnnoun" value="<?php echo $rowAnnouncement['editAnnoun']; ?>"><br>
                    <label>Date From:</label>
                    <input type="text" name="editAnnounDate" value="<?php echo $rowAnnouncement['announDate']; ?>"><br>
                    <label>Date To:</label>
                    <input type="text" name="editAnnounDateTo" value="<?php echo $rowAnnouncement['announDateTo']; ?>"><br>
                    <label>Topic:</label>
                    <input type="text" name="editAnnounTitle" value="<?php echo $rowAnnouncement['announTitle']; ?>"><br>
                    <label>Notice:</label>
                    <input type="text" name="editAnnounData" value="<?php echo $rowAnnouncement['announData']; ?>"><br>
                    <button type="submit" name="updateAnnouncement">Update</button>
                </form>
            </div>
        </td>
    
    				

                
                <td>
                    <form method="post" action="" id="deleteAnnounForm">
                        <input type="hidden" name="deleteAnnounNo" value="<?php echo $rowAnnouncement['announNo']; ?>">
                        <button type="button" onclick="confirmDeleteAnnouncement('<?php echo $rowAnnouncement['announNo']; ?>')">Delete</button>
                        </form>
                    </td>

<script>
    function confirmDeleteAnnouncement(announNo) {
        var confirmDelete = confirm("Are you sure you want to delete this announcement?");
        if (confirmDelete) {
            // If the user clicks "OK" in the confirmation dialog, submit the form
            document.querySelector('#deleteAnnounForm input[name="deleteAnnounNo"]').value = announNo;
            document.querySelector('#deleteAnnounForm').submit();
        }
        // If the user clicks "Cancel," do nothing
    }
</script>

<script>
    function toggleEditFields(announNo) {
        // Get the corresponding edit fields element
        var editFields = document.getElementById('editFields' + announNo);

        // Toggle the visibility of the edit fields
        editFields.style.display = (editFields.style.display === 'none') ? 'table-cell' : 'none';
    }
</script>



        </td>
            </tr>
        <?php
        }
        ?>
                </table>
                </div>
            </form>
            
    </div>

    <br><br>

            <form method="post" action="process_announcement.php" id="addNoticeForm">
                <table>
                    <tr>
                        <th>DATE FROM</th>
                        <th>DATE TO</th>
                        <th>NOTICE</th>
                        <th>ADD</th>
                        
                    </tr>
                    <tr>
                        <td>
    <input type="date" id="announDate" name="announDate" placeholder="yyyy/mm/dd" pattern="\d{4}/\d{2}/\d{2}" title="Please enter a date in the format yyyy/mm/dd" required>
</td>
<td>
    <input type="date" id="announDateTo" name="announDateTo" placeholder="yyyy/mm/dd" pattern="\d{4}/\d{2}/\d{2}" title="Please enter a date in the format yyyy/mm/dd" required>
</td>


						<td>TITLE: <input type="text" id="announTitle" name="announTitle" placeholder="Add Title"> <br>     
                        DESCRIPTION: <input type="text" id="announData" name="announData" placeholder="Add event"></td> 

                        <td><button type="button" onclick="confirmAddAnnouncement()">ADD</button></td>
                        
                    </tr>
                </table>
            </form>
          <script>
    function confirmAddAnnouncement() {
        var userConfirmation = confirm("Are you sure you want to add this announcement?");
        if (userConfirmation) {
            document.getElementById("addNoticeForm").submit();
        } else {
            // Optional: Handle the case where the user clicks Cancel
            console.log("User canceled the action.");
        }
    }
</script>



    
</script>

</body>

</html>
