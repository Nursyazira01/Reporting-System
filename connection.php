<?php 
    $servername = "localhost";
    $ID = "root";
    $IDpassword = "";
    $db_name = "murnireportingsystem2";  

    //create connection 


    $conn = new mysqli($servername, $ID, $IDpassword, $db_name);
    
    if($conn->connect_error){
        echo "Failed to connect";
        exit();
    }

    echo "";

   
?>