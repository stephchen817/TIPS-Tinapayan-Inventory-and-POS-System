<?php
    include("dbConnection.php");
    $result = $conn->query("SELECT * FROM products");
    session_start();
?>

<html>
    <head>
        <title>inventory</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="styles/display.js" charset="utf-8"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="styles/design.css">
    </head>
    <body id='reppage'>
        <header class='container-fluid' id="header1">
            <p id="head">TIPS: TINAPAYAN INVENTORY AND POS SYSTEM</p>
        </header>
        <main>
            <section class='sec-1' id='panel'>
                <div>
                    <img src="images/user.png" id='pic'>
                    <center>
                        <h2 class='loggedIn' id='user'><?php echo $_SESSION["loginUser"] ?></h2>
                    </center>
                    <br>
                    <div class='container-fluid' id='buttons'>
                        <a id="addbtn" href="spoilage.php" type="button" class='button btn btn-info btn-block' >View Spoiled Items</a>
                        <a id="addbtn" type="button" class='button btn btn-info btn-block' data-toggle="modal" data-target="#Insert">Add Products</a>
                        <a href="menu.php" id='return' type="button" class="btn-block btn-info btn-secondary">Return</a>
                    </div>
                </div>
            </section>

            <section class='sec-2' id='table'>
                <table id='reptable' class="table table-hover table-striped">
                    <tr>
                        <th colspan="1" class='h2'style="text-align: center;">PRODUCT DETAILS</th>
                        <th colspan="4" class='h2'style="text-align: center;">INVENTORY</th>
                    </tr>
                    <tr> 
                        <td class="h3" style="text-align: center;">Product</td>
                        <td class="h3" style="text-align: center;">Quantity</td>
                        <td class="h3" style="text-align: center;">Breakpoint</td>
                        <td class="h3" style="text-align: center;" colspan="2"> Action</td>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) :
                        $id = $row['prodDesc'];
                        $prodID = $row['prodID']
                    ?>
                        <tr>
                            <td align = "center" class = "contents"> <?php echo $id; ?> </td>
                            <td align = "center" class = "contents"> <?php echo $row['startQty']; ?> </td>
                            <td align = "center" class = "contents"> <?php echo $row['breakpoint']; ?> </td>
                            <td align = "center" class = "contents"> 
                                <a data-toggle="modal" data-target="#Update" id="fxnbutton1" class="btn" data-userid='<?php echo $prodID;?>''>
                                    <i class="fas fa-edit"> </i>
                                </a>
                                <a href="Inventory2.php?delete=<?php echo $prodID;?>" id="fxnbutton2" class="btn">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </section>
        </main>

        <div class="modal fade hide" id="Insert" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Products</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="addProducts.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" name="ProductDesc" placeholder="Enter product description..." required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="ProdCurrentQty" placeholder="Enter product quantity..." required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="Breakpoint" placeholder="Enter breakpoint quantity..." required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="Price" placeholder="Enter product price..." required>
                            </div>
                    </div>
                    <div class="modal-footer d-flex right-content-center">
                        <input type="submit" id="submitNew" class="btn btn-default" value="Add Record">
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade hide" id="Update" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Products</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action='updateProducts.php' method="POST">
                            <input type="hidden" id="custId" name="prodId" value="">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="ProductDesc" placeholder="Enter product description...">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="ProdCurrentQty" placeholder="Enter product quantity...">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="Breakpoint" placeholder="Enter breakpoint quantity...">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="Price" placeholder="Enter price...">
                            </div>
                    </div>
                    <div class="modal-footer d-flex right-content-center">
                        <input id="save" type="submit" class="btn btn-default" value="Update">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            if(isset($_GET['delete'])){
                $delete_id = $_GET['delete'];
                mysqli_query($conn, "DELETE FROM price WHERE prodID='$delete_id'");
        		mysqli_query($conn, "DELETE FROM spoilage WHERE prodID='$delete_id'");
        		mysqli_query($conn, "DELETE FROM invoice_details WHERE prodID='$delete_id'");
                mysqli_query($conn, "DELETE FROM products WHERE prodID='$delete_id'");
               header("location:Inventory2.php");
            }   
        ?>
        <script>
            $('#Update').on('show.bs.modal', function(e) {
                var userid = $(e.relatedTarget).data('userid');
                $(e.currentTarget).find('input[name="prodId"]').val(userid);
            });
        </script>

    </body>

    
</html>