<?php include "dbConnection.php";

    $qry = "SELECT invoice_details.invoiceID, invoice.invoiceDate, invoice.customerName, invoice.customerAddress, 
    invoice_details.prodID, SUM(invoice_details.inv_qty) AS TotalQty, SUM(price.prodPrice * invoice_details.inv_qty) 
    AS TotalAmt FROM price INNER JOIN invoice_details ON invoice_details.prodID = price.prodID INNER JOIN invoice ON 
    invoice_details.invoiceID = invoice.invoiceID GROUP BY invoice_details.invoiceID HAVING DATE(invoiceDate) = CURRENT_DATE";
    
    $result = $conn->query($qry);
    if(!isset($_SESSION)){
          session_start();
      }
?>
<html>
<head>
        <title>Sales Report</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="styles/display.js" charset="utf-8"></script>

        <!--For font styles-->
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="styles/design.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
                            <h2 style="color:white;font-size:25px;"class='loggedIn'>DAILY</h2>
                            <br>
                        </center>
                            <button id='return' style="font-family: Baloo Tamma" type="button" class="btn-block btn-info btn-secondary"
                            data-toggle="modal" data-target="#View">
                                Summary
                            </button>
                            <button onclick="window.location.href='salesReport.php'" id='return' style="font-family: Baloo Tamma" type="button" class="btn-block btn-info btn-secondary">
                                Return
                            </button>
                    </div>
                </section>
                <section class='sec-2' id='table'>
                    <table id='reptable' class = "table table-hover table-striped">
                        <tr>
                            <th class='h2' style="font-size:20;text-align:center;">Invoice ID</th>
                            <th class='h2' style="font-size:20;text-align:center;">Invoice Date</th>
                            <th class='h2' style="font-size:20;text-align:center;">Customer Name</th>
                            <th class='h2' style="font-size:20;text-align:center;">Customer Address</th>
                            <th class='h2' style="font-size:20;text-align:center;">Items Bought</th>
                            <th class='h2' style="font-size:20;text-align:center;">Total Amount</th>
                        </tr>
                        <?php while($row = $result->fetch_assoc()):?>
                        <tr>
                            <td align = "center" class="contents"><?php echo $row['invoiceID']?></td>
                            <td align = "center" class="contents"><?php echo $row['invoiceDate']?></td>
                            <td align = "center" class="contents"><?php echo $row["customerName"];?></td>
                            <td align = "center" class="contents"><?php echo $row["customerAddress"];?></td>
                            <td align = "center" class="contents"><?php echo $row["TotalQty"];?></td>
                            <td align = "center" class="contents"><?php echo $row["TotalAmt"];?></td>
                            
                        <?php endwhile;?>
                        </tr>
                        </form>  
                    </table>
                </section>  
            </main>
        </div>
        <div>
            <?php
                $sale = "SELECT invoice.invoiceDate, SUM(price.prodPrice * invoice_details.inv_qty) AS TotalAmt FROM price 
                INNER JOIN invoice_details ON invoice_details.prodID = price.prodID INNER JOIN invoice ON invoice_details.invoiceID = invoice.invoiceID 
                WHERE DATE(invoice.invoiceDate) = CURRENT_DATE";
        
                $sumsales = $conn->query($sale);

                $date = new DateTime();
                $date->setTimezone(new DateTimeZone("Asia/Manila"));
            ?>
            <div class="modal fade" id="View" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title" style="font-family:'Baloo Tamma';">Summary Report</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <?php while($row3=$sumsales->fetch_assoc()):?> 
                                <p> Date: <?php echo $date->format('m-d-Y h:i:s')?></p> 
                                <p> Total Sales: <?php echo $row3['TotalAmt']?></p>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
