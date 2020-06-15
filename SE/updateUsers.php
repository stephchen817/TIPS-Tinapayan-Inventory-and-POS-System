<?php
include "dbConnection.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(empty($_POST['editPassword']) || empty($_POST['editConPass'])){
            $error = "Please fill up the required information!";
        }else{
            $editPass = $_POST['editPassword'];
            $confirmPass = $_POST['editConPass'];
            $userID = $_POST['userID'];

            $passLength=strlen($editPass);
            
            if($passLength>=6){
                if($editPass == $confirmPass){
                    $encryptPass = md5($editPass);
                    $stmt = $conn->prepare("UPDATE employee SET password =? WHERE username =?");
                    $stmt->bind_param('ss', $encryptPass, $userID);
                    $stmt->execute();

                    header("location: users.php");
                    //echo "Record has been successfully updated!";
                }
            }
        }
    } 
?>  