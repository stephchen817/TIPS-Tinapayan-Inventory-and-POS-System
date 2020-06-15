<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>pass</title>
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
        <div class="container full-height" style="height: 400px;">
            <div class="row flex center v-center full-height" style="height: 613px;">
                <div class="col-8 col-sm-4">
                    <div class="form-box">
                        <form action="accountsMenu.php">
                            <fieldset>
                                <legend>Sign in</legend>
                                <img id="avatar" class="avatar round" src="assets/img/avatar.png">
                                <?php if(isset($_GET["user"])){ $userID = $_GET["user"];}?>
                                <legend><?php echo $userID ?></legend> 
                                <input class="form-control" type="password" id="password" name="txtLogPword" placeholder="password" required="">
                                <button class="btn btn-primary btn-block" type="submit" style="margin-bottom:15px;" name = "login">LOGIN</button>
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