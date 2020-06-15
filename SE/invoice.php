<?php include "dbConnection.php";
      $qry = "SELECT * FROM invoice";
      $result = $conn->query($qry);
      if(!isset($_SESSION)){
          session_start();
      }
?>
<html>
<head>
        <title>invoice</title>
    
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
                            <h2 style="font-family: Baloo Tamma; font-size: 23px;"class='loggedIn' id='username'><?php echo $_SESSION["loginUser"];?></h2>
                            <br>
                        </center>
                                <button id='addbtn' type="button" class="btn-block btn-info btn-primary" data-toggle="modal" data-target="#Add">
                                    Add Customer
                                </button>
                                <button onclick="window.location.href='sales1.php'" id='return' type="button" class="btn-block btn-info btn-secondary">
                                    Encode Transactions
                                </button>
                                <button onclick="window.location.href='encoderMenu.php'" id='return' type="button" class="btn-block btn-info btn-secondary">
                                    Return
                                </button>
                    </div>
                </section>
                <section class='sec-2' id='table'>
                    <table id='reptable' class = "table table-hover table-striped">
                        <tr>
                            <th class='h2' style="font-size:20;" style="text-align:center;">INVOICE NUMBER</th>
                            <th class='h2' style="font-size:20;" style="text-align:center;">INVOICE DATE</th>
                            <th class='h2' style="font-size:20;" style="text-align:center;">CUSTOMER NAME</th>
                            <th class='h2' style="font-size:20;" style="text-align:center;">CUSTOMER ADDRESS</th>
                            <th class='h2' style="font-size:20;" style="text-align:center;">USERNAME</th>
                            <th class='h2' colspan="3" style="font-size:20;" style="text-align:center;">ACTION</th>
                            
                        </tr>
                        <form method = "get" action = "users.php">
                        <?php while($row = $result->fetch_assoc()): $id = $row["invoiceID"];?>
                        <div class = "row">
                        <tr id="<?php echo $row['invoiceID'];?>">
                            <td data-target="invoiceID" align = "center" class = "contents"><?php echo $row['invoiceID']?></td>
                            <td data-target="invoiceDate" align = "center" class = "contents"><?php echo $row["invoiceDate"];?></td>
                            <td data-target="customerName" align = "center" class = "contents"><?php echo $row["customerName"];?></td>
                            <td data-target="customerAddress" align = "center" class = "contents"><?php echo $row["customerAddress"];?></td>
                            <td data-target="username" align = "center" class = "contents"><?php echo $row["username"];?></td>
                            <td align = "right">
                                    <div class="col-m-5">
                                    <a href="#" data-role="update" data-toggle="modal" data-target="#Update" id="fxnbutton1" class="btn" data-userid="<?php echo $id;?>">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    </div>
                                    <div class="col-m-5">
                                    <a href="invoice.php?delete=<?php echo $id;?>" id="fxnbutton2" class="btn">
                                        <i class="fas fa-user-minus"></i>    
                                    </a>
                                    </div>
                            </td>
                        </div>
                            <div class="row">
                                <td align ="left">
                                <div class="col-m-5">
                                    <a href="receiptPDF.php?invoiceID=<?php echo $id?>"id="fxnbutton2" class="btn">
                                        <i class="far fa-file-pdf"></i>
                                    </a>
                                </div>
                                <div class="col-m-5">
                                    <a href='customerInvoice.php?inv=<?php echo $id?>' id="fxnbutton2" class="btn">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </a>
                                </div>
                                </td>
                            </div>
                        </form>
                        <?php endwhile;?>
                        </tr>
                        </div>
                        </form>  
                    </table>
                </section>  
            </main>
        </div>
        <!--Add invoice record
            formID: #AddRec, modalID: #Add, submitButtonID/submitButtonName: #submitNew/add
            customerName ID/ name: #newCustomer
            customerAddress ID/name: #newAddress
        -->
        <div id="Add" class="modal fade hide" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Add customer details</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="AddRec" action="addInvoice.php" method="POST">
                            <input type="hidden" name="add/edit" value="add">
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="newCustomer" name="newCustomer" placeholder="Enter customer name..." required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="newAddress" name="newAddress" placeholder="Enter customer address..." required>
                            </div>
                    </div>
                    <div class="modal-footer d-flex right-content-center">
                        <input type="submit" name="add" id="submitNew" class="btn" value="Save">
                    </div>
                        </form>
                </div>
            </div>
        </div>
        <!--Edit Modal:
            modalID: #Update, formID: #UpdRec
            submitButtonID: #save,
            editCustomerName ID/Name: #editCustName,
            editCustomerAddress ID/Name: #editCustAdd
        -->
        <div class="modal fade hide" id="Update" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit invoice record</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action = "addInvoice.php" id="UpdRec" method="POST">
                        <input type="hidden" id="invoiceID" name="invoiceID" value="">
                        <input type="hidden" name="add/edit" value="edit">
                        <div class="form-group">       
                            <input id="editCustName" class="form-control" type="text" name="editCustName" placeholder="Edit customer name...">
                        </div>
                        <div class="form-group">        
                            <input id="editCustAdd" class="form-control" type="text" name="editCustAdd" placeholder="Edit customer address...">
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

<!--script>
    /*Add invoice record
        formID: #AddRec, modalID: #Add, submitButtonID/submitButtonName: #submitNew/add
        customerName ID/ name: #newCustomer
        customerAddress ID/name: #newAddress
    */
    $(document).ready(function () {
    $("#AddRec").on("submitNew", function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            success: function(data, textStatus, jqXHR) {
                $('#Add .modal-header .modal-title').html("Success!");
                $('#Add .modal-body').html(data);
                $("#submitNew").remove();
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();
    });
     
        $("#submitNew").on('click', function() {
            $("#AddRec").submit();
        });
    });

    /*Edit Modal:
        modalID: #Update, formID: #UpdRec
        submitButtonID: #save,
        editCustomerName ID/Name: #editCustName,
        editCustomerAddress ID/Name: #editCustAdd
    */
    $(document).ready(function(){
        $(document).on('click', 'a[data-role=update]', function(){
            var id=$(this).data('id');
            var userID=$('#'+id).children('td[data-target=userID]').text();

            $('#userID').val(userID);
            $('#Update').modal('toggle');
        })
    });

    $('#save').click(function(){    
        var userID=$('#userID').val();
        var editPassword=$('#editPassword').val();
        var editConPass=$('#editConPass').val();
        $ajax({
            url: 'addInvoice.php',
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

</!--script-->
<script>
    $('#Update').on('show.bs.modal', function(e) {
        var userid = $(e.relatedTarget).data('userid');
        $(e.currentTarget).find('input[name="invoiceID"]').val(userid);
    });
</script>
<?php
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM invoice_details WHERE invoiceID = '$delete_id'");
        mysqli_query($conn, "DELETE FROM invoice WHERE invoiceID = '$delete_id'");
        header("location: invoice.php");
    }
?>