<?php
    include "dbConnection.php";
    if(!isset($_SESSION)){
        session_start();
    }
    $error = " ";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(empty($_POST['new_user']) || empty($_POST['new_pass']) || empty($_POST['con_pass'])){
                $error = "Please fill up the required information!";
        }else{
            $new_username = $_POST['new_user'];
            $new_password = $_POST['new_pass'];
            $confirm_pass = $_POST['con_pass'];
            $new_role = $_POST['new_role'];
        }
        if(isset($_POST['add'])){
            $qry = $conn->prepare("SELECT username FROM employee WHERE username=?");
            $qry->bind_param('s',$new_username);
            $qry->execute();
            $qry->store_result();
            if($qry->num_rows== 0){
                $passLength=strlen($new_password);
                if($passLength>=6){
                    if(($new_password == $confirm_pass)){
                        $encrypt = md5($new_password);
                        $stmt = $conn->prepare("INSERT INTO employee(username, password, role) VALUES (?, ?, ?)");
                        $stmt->bind_param('sss', $new_username, $encrypt, $new_role);
                        $stmt->execute();
                        //echo '<script> alert("You have successfully created an account!"); </script>';
                        header("location: users.php?message=success");
                    }
                }else{
                    header("location: users.php?message=shortPW");
                  //echo '<script> alert("Password must contain at least 6 characters!"); </script>';
                }
            }else{
                header("location: users.php?message=existing");
            }
                mysqli_close($conn);
        }
    }
?>