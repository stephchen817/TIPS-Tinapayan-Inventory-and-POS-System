<?php include "dbConnection.php";
      $qry = "SELECT products.prodID, products.prodDesc, COALESCE(products.startQty,0) AS startQty, COALESCE(spoilage.spoilageQty, 0) AS spoilageQty FROM products LEFT JOIN spoilage ON products.prodID = spoilage.prodID ORDER BY startQty ASC";
      $result = $conn->query($qry);
      if(!isset($_SESSION)){
          session_start();
      }
?>
<html>
<head>
        <title>Inventory Report</title>
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
                            <h2 style="color:white;font-size:30px;"class='loggedIn'><?php echo $_SESSION["loginUser"];?></h3>
                            <br>
                        </center>
                            <button id='return' style="font-family: Baloo Tamma" type="button" class="btn-block btn-info btn-secondary"
                            data-toggle="modal" data-target="#View">
                                Summary
                            </button>
                            <button onclick="window.location.href='reports.php'" id='return' style="font-family: Baloo Tamma" type="button" class="btn-block btn-info btn-secondary">
                                Return
                            </button>
                    </div>
                </section>
                <section class='sec-2' id='table'>
                    <table id='reptable' class = "table table-hover table-striped">
                        <tr>
                            <th class='h2' style="font-size:20;text-align:center;">Product ID</th>
                            <th class='h2' style="font-size:20;text-align:center;">Product Description</th>
                            <th class='h2' style="font-size:20;text-align:center;">Quantity</th>
                            <th class='h2' style="font-size:20;text-align:center;">Spoiled</th>                           
                        </tr>
                        <?php while($row = $result->fetch_assoc()):?>
                        <tr>
                            <td align = "center" class="contents"><?php echo $row['prodID']?></td>
                            <td align = "center" class="contents"><?php echo $row["prodDesc"];?></td>
                            <td align = "center" class="contents"><?php echo $row["startQty"];?></td>
                            <td align = "center" class="contents"><?php echo $row["spoilageQty"];  ?></td>
                        <?php endwhile;?>
                        </tr>
                        </form>  
                    </table>
                </section>  
            </main>
        </div>
        <div>
            <?php
                $low = "SELECT prodDesc, startQty FROM products ORDER BY startQty DESC LIMIT 3";
                $lowres = $conn->query($low);
                $top = "SELECT prodDesc, startQty FROM products ORDER BY startQty ASC LIMIT 3";
                $topres = $conn->query($top);
                $spoil = "SELECT SUM(spoilageQty) AS Total FROM spoilage";
                $sumspoil = $conn->query($spoil);
            ?>
            <div class="modal fade" id="View" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title" style="font-family:'Baloo Tamma';">Summary Report</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div id = "summary" class = "row">
                                <div class = "col">
                                    <b style="font-family:Open Sans;">Top Selling Goods</b>
                                </div>
                                <div class = "col">
                                    <b style="font-family:Open Sans;">Least Selling Goods</b>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col">
                                    <table>
                                            <?php while ($row1 = $topres->fetch_assoc()) :
                                                $prod = $row1['prodDesc'];
                                                $qty = $row1['startQty'];
                                            ?>
                                                <tr>
                                                    <td style='font-family:Open Sans;'> <?php echo $prod; ?> </td>
                                                    <td style='font-family:Open Sans;' align = "center"> <?php echo $qty; ?> </td>
                                                </tr>
                                            <?php endwhile; ?>
                                    </table>
                                </div>
                                <div class = "col">
                                    <table>
                                            <?php while ($row2 = $lowres->fetch_assoc()) :
                                                $prod = $row2['prodDesc'];
                                                $qty = $row2['startQty'];
                                            ?>
                                                <tr>
                                                    <td style='font-family:Open Sans;'> <?php echo $prod; ?> </td>
                                                    <td style='font-family:Open Sans;' align = "center"> <?php echo $qty; ?> </td>
                                                </tr>
                                            <?php endwhile; ?>
                                    </table>
                                </div>                            
                            </div>
                            
                        </div>
                        <div class= "modal-footer d-flex justify-content-start">
                            <?php while($row3=$sumspoil->fetch_assoc()):?> 
                                <p><B>Number of products spoiled:</B><?php echo " ".$row3["Total"]?></p>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
