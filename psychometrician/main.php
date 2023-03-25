<?php 
session_start();

if(!isset($_SESSION['entrance']) || empty($_SESSION['entrance'])){
    header("Location: index.php");
}
else if(isset($_SESSION['Level']) === "Student"){
    header("Location: questions.php");
}

?>
<?php require_once '../server/connection.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="../../img/eespr.ico">
    <title>EESPR</title>

    <link href="../browser-components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../browser-components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/timeline.css" rel="stylesheet">
    <link href="../dist/css/homemade1.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../browser-components/morrisjs/morris.css" rel="stylesheet">
    <link href="../browser-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper">
        <?php include('includes/nav-bar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                    <div class="col-lg-12">
                                              
                        <h1 class="page-header">
                            PHYCHOMETRICIAN<small class="text-primary"></small>
                        </h1>
                </div>
            </div>
    </div>
    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
