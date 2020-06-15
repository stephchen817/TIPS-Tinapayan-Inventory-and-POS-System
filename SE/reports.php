<?php
    #include "dbConnection.php";
?>
<html>
    <head>
	    <meta charset="utf-8">
		<meta name viewport content ="width=device=width, initial-scale=1.0">
        <title>Reports</title>
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	
	<body style = "background-color: #FFF3E1;overflow: hidden;">	
	
        <header class='container-fluid' style = "background-color: #FFF3E1; height: 55px;" >
            <p style = "color: #C37214;font-size: 40px;font-family: 'Baloo Tamma';margin-left: 10px;">TIPS: TINAPAYAN INVENTORY AND POS SYSTEM</p>
            </header>
            <div class='row'style="background-color:#FFAC4B;height: 540px; margin-left: 30px;margin-right: 30px;">
			
			
		<div class="thumbnail text-center">
                <img src="images/sales.png" id='icon' alt="" class="img-responsive" style = "margin-right:auto;margin-left:330px;margin-top:70;height: 300px; width: 300px;">
                <div class="caption" id='caption'>
				<p style = "color: black; margin-left: 320px; margin-top: -45px; font-size: 20px; color: white;"> Sales  </p>
                    <p id="sales-text"></p>
					<button onclick="window.location.href='salesReport.php'" id='return' type="button" style = "margin-top: 25px;margin-left:320px;width: 100px;font-size: 23px;color:white;font-family: 'Baloo Tamma';background-color: D46600;border-radius:8px;border: none;">View</button>                                                     
                </div>
            </div>	
		</section>
		
		<div class="thumbnail text-center">
                <img src="images/inventory.png" id='icon' alt="" class="img-responsive" style = "margin-right:auto;margin-left:50px;margin-top:70px;-top:50px;height: 300px; width: 300px; border-radius: 50%">
                <div class="caption" id='caption'>
				<p style = "color: black; margin-left: 60px; margin-top: -45px; font-size: 20px; color: white;"> Inventory  </p>
                    <p id="sales-text"></p>
					<button onclick="window.location.href='inventoryReport.php'" id='return' type="button" style = "margin-top: 25px;margin-left: 45px;width: 100px;font-size: 23px;color: white;font-family: 'Baloo Tamma';background-color: D46600;border-radius:8px;border: none;">View</button>                                                     
                </div>
            </div>	
		</section>  
            </div>