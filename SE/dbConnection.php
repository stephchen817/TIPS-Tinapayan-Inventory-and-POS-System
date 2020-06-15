<?php
    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "tinapayan";
    
    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
    if($conn->connect_errno >0){
        die("Unable to connect to database[".$conn->connect_error."]");
    }
?>