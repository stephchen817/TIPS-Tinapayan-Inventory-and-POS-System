<?php
    #include "dbConnection.php";
?>
<html>
    <head>
        <title>menu</title>
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/design.css">
    </head>

    <body id = 'reppage' style = "background-color: #FFF3E1;">
        <header class='container-fluid' style = "background-color: #FFD5A6; height: 55px;" >
            <p style = "color: #C37214;font-size: 40px;">TIPS: TINAPAYAN INVENTORY AND POS SYSTEM</p>
        </header>
        <div class='row'>

			<div class="thumbnail text-center" id="user">
                <a href="switchUser.php">
                <img src="images/accounts.png" id='icon' alt="" class="img-responsive" style = "margin-top:140px; margin-left: 380px; margin-right: 33px; height: 280px; width: 290px;">
                <div class="caption" id='caption'>
				<p style = "color: black; margin-left: 355px; margin-top: -18px; font-size: 20px; color: white;"> Switch User  </p>

                    <p id="user-text"></p>
                </div>
                </a>
            </div>
 
			<div class="thumbnail text-center" id="privacy">
                <a href="users.php">
                <img src="images/login.png" id='icon' alt="" class="img-responsive" style = "margin-left: 25px; margin-top: 150px; height: 240px; width: 250px;">
                <div class="caption" id='caption'>
				<p style = "color: black; margin-left: -25px; margin-top: -25px; font-size: 20px; color: white;"> Privacy Settings  </p>

                    <p id="privacy-text"></p>
                </div>
                </a>
            </div>
		
        </div>
        <script type="text/javascript" src="styles/display.js" charset="utf-8"></script>
    </body>
</html>