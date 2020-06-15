<?php
    require 'dbConnection.php';
    session_start();
    $error = '';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(empty($_POST['username']) || empty($_POST['password'])){
                $error = "Username or Password is invalid!";
        }
        else{
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $role = $_POST['role'];
            $encryptedPass = md5($pass);

            $stmt = $conn->prepare("SELECT * FROM EMPLOYEE WHERE USERNAME=? AND PASSWORD=? AND ROLE=?");
            $stmt->bind_param('sss', $user, $encryptedPass, $role);
            $stmt->execute();
            $stmt->store_result();
            
            if($stmt->num_rows==1){
                $_SESSION['loginUser'] = $user;
                $_SESSION['loginPass'] = $pass;
                $_SESSION['loginRole'] = $role;
                if($_SESSION['loginRole'] == "encoder"){
                    header('location: encoderMenu.php');
                }else if($_SESSION['loginRole'] == "salesAdmin"){
                    header('location: salesMenu.php');
                }else{
                    header('location: accountsMenu.php');
                }
            }else{
                    $error = "Invalid username or password!";?>
                    <p style = "color: #bd640a; font-family: Calibri;"><?php echo $error;?></p>
            <?php
                mysqli_close($conn);
            }
}}?>