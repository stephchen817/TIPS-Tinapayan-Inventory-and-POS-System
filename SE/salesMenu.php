<?php
    include "dbConnection.php";
    $result = $conn->query("SELECT * FROM products WHERE startQty <= breakpoint");
?>
<html>
    <head>
        <title>menu</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/design.css">
        <style type="text/css">
        #element1 {display:inline-block;}
        #element2 {display:inline-block; float:right; margin-top:7px; font-size:40px; color:orange; cursor:pointer;}
        </style>
    </head>

    <body id = 'reppage' style = "background-color: #FFF3E1;">
        <header class='container-fluid' style = "background-color: #FFD5A6; height: 55px;" >
            <p style = "color: #C37214;font-size: 40px;" id='element1'>TIPS: TINAPAYAN INVENTORY AND POS SYSTEM</p>
            <?php
                $string = "\\n";
                $newline = "\\n";
                if ($result != null){
                    echo '<i class="fas fa-exclamation-circle" onclick="myFunction()" id="element2"></i>';
                    while ($row = $result->fetch_assoc()){
                        $string = $string.$row['prodDesc'];
                        $string = $string.$newline;
                    }
                }
            ?>
        </header>
        <div class='row'>

            <div class="thumbnail text-center" id="report">
                <a href='reports.php'>
                <img src="images/report.png" id='icon' alt="" class="img-responsive" style = "margin-left: 218px;margin-top: 150px; height: 240px; width: 250px;">
                <div class="caption" id='caption'>
				<p style = "color: black; margin-left: 160px; margin-top: -25px; font-size: 20px; color: white;"> Reports  </p>
					<p id="report-text"></p>
                </div>
                </a>
            </div>

            <div class="thumbnail text-center" id="inventory">
                <form action='Inventory2.php' method='post'>
                <input type='image' src="images/stocks.png" id='icon' alt="" class="img-responsive" style = "margin-top:150px; height: 240px; width: 250px;">
                <div class="caption" id='caption'>
				<p style = "color: black; margin-left: 10px; margin-top: -20px; font-size: 20px; color: white;"> Inventory </p>

                    <p id="inventory-text"></p>
                </div>
                </form>
            </div>

            <div class="thumbnail text-center" id="user">
                <a href="switchUser.php">
                <img src="images/accounts.png" id='icon' alt="" class="img-responsive" style = "margin-top:150px; margin-left: 30px; margin-right: 33px; height: 280px; width: 290px;">
                <div class="caption" id='caption'>
				<p style = "color: black; margin-left: -2px;margin-top: -15px; font-size: 20px; color: white;"> Switch User  </p>

                    <p id="user-text"></p>
                </div>
                </a>
            </div>
			
            </div>
        </div>
        <script type="text/javascript" src="styles/display.js" charset="utf-8"></script>

        <script>
            function myFunction() {
                alert("Products on a critical level:\n <?php echo $string?>");
            }
        </script>
    </body>
</html>