<?php include('../server/auth/index.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="../img/eespr.ico">
    <title>PHYCHOMETRICIAN</title>

    <link href="../browser-components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/homemade.css" rel="stylesheet">
    <link href="../browser-components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../browser-components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <link href="../browser-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container">
        <?php if($message !== '') { ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Warning!</strong> <?php echo $message; ?>
        </div>
        <?php } ?>
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <br>
                        <h3 class="panel-title text-center">HELLO</h3>
                        <h3 class="panel-title text-center">PHYCHOMETRICIAN</h3>
                    <br>
                    </div>
                <div class="panel-body">
                    <form role="form" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" id="inputEmail" name="username" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" id="inputPassword" name="password" type="password">
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">LET ME IN</button>
                            <br>
                        </fieldset>
                    </form>
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
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
</body>
</html>