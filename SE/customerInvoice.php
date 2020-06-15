<?php include "dbConnection.php";
    $invId = 0;
    if(isset($_GET['inv'])){
        $invId = (int) $_GET['inv'];
    }

    $qry = "SELECT invoice_details.prodID, price.prodPrice, invoice_details.invoiceID, (invoice_details.inv_qty*price.prodPrice) AS Amount, invoice_details.prodDesc, invoice_details.inv_qty FROM invoice_details INNER JOIN price ON invoice_details.prodID = price.prodID WHERE invoice_details.invoiceID=$invId ORDER BY invoice_details.invoiceID ASC";
    $result = $conn->query($qry);
    if(!isset($_SESSION)){
        session_start();
    }
?>
<html>
<head>
        <title>customer</title>
    
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>

        
        <link rel="stylesheet" href="styles/design.css">

        <style type="text/css">
            .dropdown-menu {
                background: #B57B3E !important;
            }
            .dropdown-item {
                background: #B57B3E !important;
            }
            .modal-backdrop{
                opacity:0.5 !important;
            }
        </style>
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
                            <h2 style="font-family:Baloo Tamma; font-size:25px;"class='loggedIn' id='username'><?php echo $_SESSION["loginUser"];?></h3>
                            <br>
                        </center>
                                <button id='addbtn' type="button" class="btn-block btn-info btn-primary" data-toggle="modal" data-target="#add_acc">
                                    Add Items
                                </button>
                            <form action='invoice.php'>
                                <button id='return' type="submit" class="btn-block btn-info btn-secondary">
                                    Return
                                </button>
                            </form>
                    </div>
                </section>
                <section class='sec-2' id='table'>
                    <table id='reptable' class = "table table-hover table-striped">
                        <tr>
                            <th class='h2' style="font-size:20;text-align:center;">INVOICE NUMBER</th>
                            <th class='h2' style="font-size:20;text-align:center;">PRODUCT DESCRIPTION</th>
                            <th class='h2' style="font-size:20;text-align:center;">INVOICE QUANTITY</th>
                            <th class='h2' style="font-size:20;text-align:center;">PRICE</th>
                            <th class='h2' colspan="2" style="font-size:20;text-align:center;">ACTION</th>                            
                        </tr>
                        <form method = "get" action="#">
                        <?php while($row = $result->fetch_assoc()): $id = $row["invoiceID"];?>
                        <tr id="<?php echo $row['username'];?>">
                            <td data-target="" align = "center" class="contents"><?php echo $row['invoiceID']?></td>
                            <td data-target="" align = "center" class="contents"><?php echo $row["prodDesc"];?></td>
                            <td data-target="" align = "center" class="contents"><?php echo $row["inv_qty"];?></td>
                            <td data-target="" align = "center" class="contents"><?php echo $row["prodPrice"];?></td>
                            <td align = "center">
                                <a href="#" data-role="update" data-toggle="modal" data-target="#upd_acc" id="fxnbutton1" class="btn" data-userid="<?php echo $row["prodDesc"];?>">
                                    <!--<i class="fas fa-user-edit"></i>-->
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="customerInvoice.php?inv=<?php echo $invId?>&delete=<?php echo $row['prodID']?>" id="fxnbutton2" class="btn">
                                    <!--<i class="fas fa-user-minus"></i>-->
                                    <i class="fas fa-trash-alt"></i>    
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
                            <h5 class="modal-title">Add items</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="AddAcc" action="addInvDetails.php" method="POST">
                            <input type="hidden" name="invID" value="<?php echo $invId ?>">
                            <input type="hidden" name="add/edit" value="add">
                            <div class="form-group">
                                <input class="form-control typeahead" type="text" id="new_prod" name="new_prod" placeholder="Enter product name..." required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="new_pass" name="new_prodqty" placeholder="Enter product quantity..." required>
                            </div>
                    </div>
                    <div class="modal-footer d-flex right-content-center">
                        <input type="submit" name="add" id="submitNew" class="btn" value="Save">
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
                        <h4 class="modal-title">Edit Quantity</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action = "addInvDetails.php" id="UpdAcc" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="invID" value="<?php echo $invId ?>">
                            <input type="hidden" name="add/edit" value="edit">
                            <input type="hidden" name="prodDesc" value="">
                        </div>
                        <div class="form-group">       
                            <input id="editPassword" class="form-control" type="number" name="editQty" placeholder="Enter new quantity..." required>
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
<!--script>
    //Create account: modal
    $(document).ready(function () {
    $("#AddAcc").on("submitNew", function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            success: function(data, textStatus, jqXHR) {
                $('#add_acc .modal-header .modal-title').html("Success!");
                $('#add_acc .modal-body').html(data);
                $("#submitNew").remove();
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();
    });
     
        $("#submitNew").on('click', function() {
            $("#AddAcc").submit();
        });
    });

    /* EDIT ACCOUNT 
      button for toggle: #fxnbutton1 (id) class: edit, modal_id: UpdAcc, formID:UpdAcc
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

</!--script-->

<script>
    $('#upd_acc').on('show.bs.modal', function(e) {
        var userid = $(e.relatedTarget).data('userid');
        $(e.currentTarget).find('input[name="prodDesc"]').val(userid);
    });
    $(document).ready(function(){
        $('#new_prod .typeahead').typeahead({
            hint:true, highlight: true, minLength: 1,
        source: function(query, result){
            $.ajax({
                url:"autosuggestProducts.php",
                method:"POST",
                data:{query:query},
                dataType:"json",
                success:function(data){
                    result($.map(data, function(item){
                    return item;
                    }));
                }
            })
        }
        });
    });
</script>

<?php
    if(isset($_GET['delete'])){
        $delete_id = (int) $_GET['delete'];
        mysqli_query($conn, "DELETE FROM invoice_details WHERE prodID = $delete_id");
        header("location: customerInvoice.php?inv=$invId");
    }
?>