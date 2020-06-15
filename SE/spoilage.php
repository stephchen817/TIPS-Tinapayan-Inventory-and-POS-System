<?php
    include("dbConnection.php");
    $result = $conn->query("SELECT spoilage.spoilageID, spoilage.spoilageDate, spoilage.spoilageQty, spoilage.reason, spoilage.prodID, products.prodDesc FROM spoilage INNER JOIN products ON spoilage.prodID = products.prodID");

    session_start();
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="styles/display.js" charset="utf-8"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>spoilage</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!--FONT STYLES-->
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300&display=swap" rel="stylesheet">
        <!--DELETE AND UPDATE ICONS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <!--auto suggest-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>
        <!--UI stylesheet-->
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
        <header class='container-fluid' id="header1">
            <p>TIPS: TINAPAYAN INVENTORY AND POS SYSTEM</p>
        </header>
        <main>
            <section class='sec-1' id='panel'>
                <div>
                    <img src="images/user.png" id='pic'>
                    <center>
                        <h2 class='loggedIn' id='user'><?php echo $_SESSION["loginUser"]; ?></h2>
                    </center>

                    <div class='container-fluid' id='buttons'>
                        <a id="addbtn" class='button btn btn-info btn-block' data-toggle="modal" data-target="#Insert">Insert</a>
                        <a id="return" class='button btn btn-info btn-block' href="Inventory2.php">Return</a>
                    </div>
                </div>
            </section>

            <section class='sec-2' id='table'>
                <table id='reptable' class="table-hover table-striped">
                    <tr>
                        <th colspan="2" class='h2' style="text-align:center;">SPOILAGE DETAILS</th>
                        <th colspan="5" class='h2' style="text-align:center;">PRODUCT DETAILS</th>
                    </tr>
                    <tr>
                        <td class="h3">Date Spoiled</th>
                        <td class="h3">Spoilage ID</th>
                        <td class="h3">Product ID</th>
                        <td class="h3">Product Description</th>
                        <td class="h3">Quantity</th>
                        <td class="h3">Reason</th>
                        <td class="h3">Action</th>
                    </tr>

                    <?php
                    while ($row = $result->fetch_assoc()) :
                        $id = $row["spoilageID"];
                    ?>
                        <tr id="<?php echo $id;?>">
                            <td align="center" class="contents"> <?php echo $row["spoilageDate"];?> </td>
                            <td align="center" class="contents" data-target="spoilID"> <?php echo $id ?> </td>
                            <td align="center" class="contents" data-target="prodID"> <?php echo $row["prodID"]; ?> </td>
                            <td align="center" class="contents" data-target="prodDesc"> <?php echo $row["prodDesc"]; ?> </td>
                            <td align="center" class="contents" data-target="spoilQty"> <?php echo $row["spoilageQty"]; ?> </td>
                            <td align="center" class="contents" data-target="reason"> <?php echo $row["reason"]; ?> </td>
                            <td align="center" class="contents"> 
                                <a href="#" id="fxnbutton1" class="btn" id="fxnbutton1" data-role="update" data-id="<?php echo $id?>"data-toggle="modal" data-target="#Update"><i class="fas fa-edit"></i></a>
                                <a href="spoilage.php?delete=<?php echo $id;?>" class="btn" id='fxnbutton2'><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    
                </table>
            </section>

        <div>
            <!-- INSERT: modalid: #Insert, formID: #insert_record, submit button id: #submitNew -->
            <div class="modal fade" id="Insert" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Insert new record</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="insert_record" action="addSpoilage.php">
                                <div class="form-group">
                                    <div id="prodname">
                                    <input class="form-control typeahead" type="text" placeholder="Enter product name..." id="" name="prodname">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="number" placeholder="Enter number of products spoiled..." name="qty">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter reason..." name="reason">
                                </div>
                        </div>
                        <div class="modal-footer d-flex right-content-center">
                            <input id="submitNew" type="submit" class="btn btn-default" value="Add">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        require "dbConnection.php";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['prodcode']) || empty($_POST['qty']) || empty($_POST['reason'])) {
                $error = "Please fill up the required information!";
            } else {
                $prodcode = $_POST["prodcode"];
                $spoilqty = $_POST["qty"];
                $reason = $_POST["reason"];

                $stmt = $conn->prepare("INSERT INTO spoilage(prodID, spoilageQty, reason) VALUES(?,?,?)");
                $stmt->bind_param('iis', $prodcode, $spoilqty, $reason);
                $stmt->execute();

                header("location: spoilage.php");
                mysqli_close($conn);
            }
        }
        ?>
        <!--EDIT RECORD: modalID: #Update, 
            formID: #upd_record, 
            submit button: #save -->
        <div>
            <div class="modal fade" id="Update" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Update Spoilage</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="updateSpoilage.php" method="POST" id="upd_record">
                                    <input type="hidden" id="spoilID" name="spoilID">
                                <div class="form-group">
                                    <input class="form-control typeahead" type="text" placeholder="Enter product name..." id="prodName" name="edit_prodname">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="number" placeholder="Enter number of products spoiled..." id="spoilQty" name="edit_qty">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter reason..." id="spoilReason" name="edit_reason">
                                </div>
                        </div>
                        <div class="modal-footer d-flex right-content-center">
                            <input name="update" id="save" type="submit" class="btn btn-default" value="Update">
                        </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    <?php
        if (isset($_GET['delete'])) {
            $delete_id = $_GET['delete'];
            mysqli_query($conn, "DELETE FROM spoilage WHERE spoilageID = '$delete_id'");
            header("location: spoilage.php");
        }
    ?>
        </main>
    </body> 
</html>
<script>

//INSERT RECORD: modalid: #Insert, formID: #insert_record, submit button: #submitNew 
$(document).ready(function () {
    $("#insert_record").on("submitNew", function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            success: function(data, textStatus, jqXHR) {
                $('#Insert .modal-header .modal-title').html("Success!");
                $('#Insert .modal-body').html(data);
                $("#submitNew").remove();
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();
    });
     
        $("#submitNew").on('click', function() {
            $("#insert_record").submit();
        });
    });

/*EDIT RECORD= modalID: #Update, 
formID: #upd_record, submit button: #save*/
$(document).ready(function(){
    $(document).on('click','a[data-role=update]', function(){
        var id=$(this).data('id');
        var prodDesc=$('#'+id).children('td[data-target=prodDesc]').text();
        var spoilQty=$('#'+id).children('td[data-target=spoilQty]').text();
        var reason=$('#'+id).children('td[data-target=reason]').text();

        $('#spoilID').val(id);
        $('#qty').val(spoilQty);
        $('#reason').val(reason);

        $('#Update').modal('toggle');
    })
});

$('#save').click(function(){
    var spoilID=$('#spoilID').val();
    var prodDesc=$('#prodName').val();
    var spoilQty=$('#spoilQty').val();
    var reason=$('#spoilReason').val();
    $.ajax({
        url:'updateSpoilage.php',
        type:'POST',
        data:{
            spoilID:spoilID, 
            prodDesc:prodDesc, 
            spoilQty:spoilQty,
            reason:reason
        }
    });
});
$(document).ready(function(){
        $('#prodName').typeahead({
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
    $(document).ready(function(){
        $('#prodname .typeahead').typeahead({
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