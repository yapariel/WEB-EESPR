<?php 

/*** begin our session ***/
session_start();

/*** check if the users is already logged in ***/
if(isset( $_SESSION['entrance_student'] )){
    header("Location: main.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="../img/eespr.ico">
    <title>EESPR</title>

    <link href="../browser-components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/homemade.css" rel="stylesheet">
    <link href="../browser-components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../browser-components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <link href="../browser-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <?php include('includes/head.php'); ?>

</head>
<body>
    <div class="container">
        <div id="target1"></div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4"> 
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                    <br>
                        <h3 class="panel-title text-center"><strong>PLEASE LOGIN TO TAKE THE EXAM</strong></h3>
                    <br>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="username" id="username" type="text" autofocus>
                                    <span class="help-inline"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                                    <span class="help-inline"></span>
                                </div>
                                <div class="terms-privacy">
                                <input type="checkbox" id="terms-and-conditions" name="terms-and-conditions" required> <label for="terms-and-conditions">Agree to <a href="terms.php">Terms and Conditions</a> and <a href="privacy.php">Privacy Policy</a></label>
                                </div>
                                <a href="" class="btn btn-lg btn-primary btn-block btn-login" type="submit"><strong>LET ME IN</strong></a>
                                <br>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <br>
    <p>Entrance Examination System with Program Recommendation | 2023</p>
    </div>
    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/ripples.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/material.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../browser-components/notifyjs/dist/notify.js"></script>
    <script src="../browser-components/notifyjs/dist/styles/bootstrap/notify-bootstrap.js"></script>
    <script src="../browser-components/spin.js/spin.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/student/login.js" type="text/javascript"></script>
</body>
<?php include('includes/footer.php'); ?>
</html>
