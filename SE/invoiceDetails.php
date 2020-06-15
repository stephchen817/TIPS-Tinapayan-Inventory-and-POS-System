<?php include "dbConnection.php";
      $qry = "SELECT price.prodPrice, invoice_details.invoiceID, (invoice_details.inv_qty*price.prodPrice) AS Amount, invoice_details.prodDesc, invoice_details.inv_qty FROM invoice_details INNER JOIN price ON invoice_details.prodID = price.prodID ORDER BY invoice_details.invoiceID ASC";
      $result = $conn->query($qry);
      if(!isset($_SESSION)){
          session_start();
      }
?>
<html>
<head>
        <title>sales</title>
    
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
                            <h2 style="font-family:Baloo Tamma; font-size:25px;" class='loggedIn' id='username'><?php echo $_SESSION["loginUser"];?></h3>
                            <br>
                        </center>
                            <button onclick="window.location.href='sales.php'" id='return' type="button" class="btn-block btn-info btn-secondary">
                                Return
                            </button>
                            
                    </div>
                </section>
                <section class='sec-2' id='table'>
                    <table id='reptable' class = "table table-hover table-striped">
                        <tr>
                            <th class='h2' style="font-size:20;text-align:center;">INVOICE NUMBER</th>
                            <th class='h2' style="font-size:20;text-align:center;">PRODUCT DESCRIPTION</th>
                            <th class='h2' style="font-size:20;text-align:center;">INVOICE QUANTITY</th>
                            <th class='h2' style="font-size:20;text-align:center;">PRICE</th>
                            <th class='h2' style="font-size:20;text-align:center;">AMOUNT</th>                       
                        </tr>
                        <?php while($row = $result->fetch_assoc()): $id = $row["invoiceID"];?>
                        <tr>
                            <td data-target="" align = "center" class="contents"><?php echo $row['invoiceID']?></td>
                            <td data-target="" align = "center" class="contents"><?php echo $row["prodDesc"];?></td>
                            <td data-target="" align = "center" class="contents"><?php echo $row["inv_qty"];?></td>
                            <td data-target="" align = "center" class="contents"><?php echo $row["prodPrice"];?></td>
                            <td data-target="" align = "center" class="contents"><?php echo $row["Amount"];?></td>
                        <?php endwhile;?>
                        </tr>
                        </form>  
                    </table>
                </section>  
            </main>
        </div>
