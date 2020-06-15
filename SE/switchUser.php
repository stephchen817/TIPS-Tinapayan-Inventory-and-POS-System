<?php
    include "dbConnection.php";

    $qry = "SELECT username FROM employee";
    $result = $conn->query($qry);
?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>change</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/Dark-NavBar-1.css">
        <link rel="stylesheet" href="assets/css/Dark-NavBar-2.css">
        <link rel="stylesheet" href="assets/css/Dark-NavBar.css">
        <link rel="stylesheet" href="assets/css/login-form-1.css">
        <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
        <link rel="stylesheet" href="assets/css/login-form.css">
        <link rel="stylesheet" href="assets/css/simple-footer.css">
		<link rel="stylesheet" href="assets/css/styles.css">
		
		<link href="https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/design.css">
    </head>
    <body>
		<header class='container-fluid' id="header">
            <p>TIPS: TINAPAYAN INVENTORY AND POS SYSTEM</p>
        </header>
        <div class="container" style="height: 400px;">
            <div class="row flex center v-center full-height" style="height: 613px;">
                <div class="col-8 col-sm-4">
                    <div class="form-box">
                        <form action = "password.php" method = "get">
                            <fieldset>
                                <legend>Sign in</legend>
                                <img id="avatar" class="avatar round" src="assets/img/avatar.png">
                                <?php while($row = $result->fetch_assoc()):
                                    $id = $row["username"];?>
                                <!--<button class="btn btn-block" type="submit" style="margin-bottom:15px; background-color: #d2650b; color: white"><?php //echo $row["username"]?></button>-->
                                 <a href="password.php?user=<?php echo $id;?>" name = "signout" class = "btn btn-block" style="margin-bottom:15px; background-color: #d2650b; color: white"><?php echo $id?></a>
                                 <?php endwhile; ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
    <?php
        if(isset($_GET["signout"])){
            session_destroy();
        }
    ?>