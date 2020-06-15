<?php include "dbConnection.php";
      $qry = "SELECT username, role FROM employee";
      $result = $conn->query($qry);
      if(!isset($_SESSION)){
          session_start();
      }
      
?>
<html>
<head>
        <title>accounts</title>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="styles/display.js" charset="utf-8"></script>
        
        <!--For update, delete icons-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        
        <!--For font styles-->
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="styles/design.css">
        
</head>

<body id='reppage'>
    <div class='container-fluid' id="header1">
        <p id='head'>TIPS: TINAPAYAN INVENTORY AND POS SYSTEM</p>
    </div>
        <div class='container-w-75'>
            <main>
                <section class='sec-1' id='panel'>
                    <div class='container-xl'>
                        <img src="images/user.png" id='pic'>
                        <center>
                            <h2 class='loggedIn' id='user'><?php echo $_SESSION["loginUser"];?></h3>
                            <br>
                        </center>
                                <button id='addbtn' type="button" class="btn-block btn-info btn-primary" data-toggle="modal" data-target="#add_acc">
                                    Create Account
                                </button>
                                <button onclick="window.location.href ='accountsMenu.php';" id='return' type="button" class="btn-block btn-info btn-secondary">
                                    Return
                                </button>
                    </div>
                </section>
                <section class='sec-2' id='table'>
                    <table id='reptable' class = "table table-hover table-striped">
                        <tr>
                            <th class='h2' style="text-align: center;">Username</th>
                            <th class='h2' colspan="2" style="text-align: center;">Role</th>
                            <th class='h2' style="text-align: center;">Action</th>
                        </tr>
                        <form method = "get" action = "users.php">
                        <?php while($row = $result->fetch_assoc()): $id = $row["username"];?>
                        <tr id="<?php echo $row['username'];?>">
                            <td data-target="userID" align = "center" class = "contents"><?php echo $row['username']?></td>
                            <td data-target="userRole" align = "center" colspan="2" class = "contents"><?php echo $row["role"];?></td>
                            <td align = "center">
                                <a href="#" data-role="update" data-toggle="modal" data-target="#upd_acc" id="fxnbutton1" class="btn" data-id="<?php echo $id;?>">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="users.php?delete=<?php echo $id;?>" id="fxnbutton2" class="btn">
                                    <i class="fas fa-user-minus"></i>    
                                </a>
                            </form>
                            </td>
                        <?php endwhile;?>
                        </tr>
                        </form>  
                    </table>
                </section>  
            </main>
        </div>
<!-- 
    CREATE ACCOUNTS:
        formId: #AddAcc, div/modal id: add_acc, submit button id: save, button for modal: addbtn      
-->
        <div id="add_acc" class="modal fade hide" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Create new account</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="AddAcc" action="saveAccounts.php" method="POST">
                        <?php
                        if(isset($_GET['message'])){
                            $msg = $_GET['message'];
                            //echo "<script>alert('$msg')</script>";
                            if($msg == "shortPW"){
                                echo "<script>alert('Password needs to be atleast 6 characters long!')</script>";
                            }else if ($msg == "existing"){
                                echo "<script>alert('Account already exists!')</script>";
                            }else{
                                echo "<script>alert('You have successfully created an account!')</script>";
                            }
                        }   
                        ?>
                       
                            <div class="form-group">
                                <input class="form-control" type="text" id="new_user" name="new_user" placeholder="Enter username..." required>
                            </div>
                            <span id="message" style="font-family:Open Sans"></span>
                            <div class="form-group">
                                <input class="form-control" type="password" id="new_pass" name="new_pass" placeholder="Enter password..." required onkeyup='check();'>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" id="con_pass" name="con_pass" placeholder="Confirm password..."required onkeyup='check();'>
                            </div>

                            <div class="form-group">
                                <select class="custom-select" id='new_role' name = "new_role" required>
                                    <option class="placeholder" value="none" disabled selected hidden>Select Role... </option>
                                    <option value = "salesAdmin" name = "salesAdmin"> Sales Admin</option>
                                    <option value = "accounts" name = "accounts"> Accounts Admin</option>
                                    <option value = "encoder" name = "encode"> Encoder</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer d-flex right-content-center">
                        <input type="submit" id="submitNew" name="add" class="btn" value="Submit">
                    </div>
                        </form>
                </div>
            </div>
        </div>

<!-- EDIT ACCOUNT 
      modalID: upd_acc, formID: UpdAcc, submitButtonID: save,
-->
        <div class="modal fade hide" id="upd_acc" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Password</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action = "updateUsers.php" id="UpdAcc" method="POST">
                        <div class="form-group">
                            <!--<input id="userID" class="form-control" type="text" name="userID" disabled placeholder="Enter username...">-->
                            <input type="hidden" id="userID" name="userID">
                        </div>
                        <div class="form-group">       
                            <input id="editPassword" class="form-control" type="password" name="editPassword" placeholder="Type your new password...">
                        </div>
                        <div class="form-group">        
                            <input id="editConPass" class="form-control" type="password" name="editConPass" placeholder="Confirm new password...">
                        </div>       
                    </div>
                    <div class="modal-footer d-flex right-content-center">
                        <input id="save" name="save" type="submit" class="btn btn-default" value="Save">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<!-- 
    CREATE ACCOUNTS:
        formId: #AddAcc, div/modal id: add_acc, submit button id: save, button for modal: addbtn      
-->
<script>
    //Create account: modal
    $(document).ready(function () {
        $("#AddAcc").on("submitNew", function(e) {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                success: function(data) {
                    echo 
                }
            });
            e.preventDefault();
        });
     
        $("#submitNew").on('click', function() {
            $("#AddAcc").submit();
        });
    });

    /* EDIT ACCOUNT 
      button for toggle: #fxnbutton1 (id) class: edit, 
      modal_id: upd_acc, formID:UpdAcc
      submitButton(modal): id/name: save*/

    $(document).ready(function(){
        $(document).on('click', 'a[data-role=update]', function(){
            var id=$(this).data('id');
            var userID=$('#'+id).children('td[data-target=userID]').text();

            $('#userID').val(userID);
            $('#upd_acc').modal('toggle');
        })
    });

    $('#save').click(function(){    
        var userID=$('#userID').val();
        var editPassword=$('#editPassword').val();
        var editConPass=$('#editConPass').val();
        $ajax({
            url: 'updateUsers.php',
            type: 'POST',
            data:{
                userID:userID,
                editPassword:editPassword, 
                editConPass:editConPass
            },
            success:function(response){
                console.log(response);
            }
        });
    });
    //checks whether passwords match or not 	
    var check = function() {
    if (document.getElementById('new_pass').value ==
        document.getElementById('con_pass').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Passwords match!';
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Passwords do not match!';
    }
    }

</script>

<?php
    $userDel = $_SESSION["loginUser"];
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM employee WHERE username = '$delete_id'");
            if($delete_id==$userDel){
                session_destroy();
            }
        header("location:users.php");
    }
?>