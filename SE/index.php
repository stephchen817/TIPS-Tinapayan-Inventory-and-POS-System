<?php
    require 'dbConnection.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>login</title>
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
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/design.css">
    </head>
    <body id ='reppage' style = "background-color: #FFDEB9;">

		<header class='container-fluid' id="header">
            <h1 style = "font-size: 33px; margin-top: 20px;">TIPS: TINAPAYAN INVENTORY AND POS SYSTEM</h1>
        </header>
        <div class="container full-height container full-width" style="height: 500px;">
            <div class="row flex center v-center full-height" style="height: 500px;">
                <div class="col-8 col-sm-4">
                    <div class="form-box">
                        <form method="post">
                            <fieldset>
                                <img id = "avatar" class="avatar round" src="images/avatar.png">
                                <?php require 'login.php';?>
                                <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
                                <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
                                <select class='custom-select' id='role' name = "role" required>
								    <option class = "placeholder" value ="none" disabled selected hidden>Role</option>
                                    <option value = "salesAdmin" name = "salesAdmin"> Sales Admin</option>
                                    <option value = "accounts" name = "accounts"> Accounts Admin</option>
                                    <option value = "encoder" name = "encode"> Encoder</option>
                                </select>
                                <button class="btn btn-block" type="submit" style="margin-bottom:15px; background-color: E99C29; color: white;">LOGIN</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>