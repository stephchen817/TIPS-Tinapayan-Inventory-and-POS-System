<form method = "POST">
    <table>
        <tr>
            <td>Enter new password: </td>
            <td><input type = "password" name = "editPassword" placeholder="Enter new password"></td>        
        </tr>
        <tr>
            <td>Confirm new password: </td>
            <td><input type = "password" name = "editConPass" placeholder="Confirm new password"></td>        
        </tr>
        
    </table>
    <input type = "submit" name = "update" value ="Save Changes">
</form>
<?php
    include "dbConnection.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(empty($_POST['editPassword']) || empty($_POST['editConPass'])){
            $error = "Please fill up the required information!";
        }else{
            $editPass = $_POST['editPassword'];
            $confirmPass = $_POST['editConPass'];

            if(isset($_GET['edit'])){
                $id = $_GET['edit'];
                if($editPass == $confirmPass){
                    $encryptPass = md5($editPass);
                    $stmt = $conn->prepare("UPDATE employee SET password =? WHERE username =?");
                    $stmt->bind_param('ss', $encryptPass, $id);
                    $stmt->execute();
                }
            }
        }
    }
?>  
