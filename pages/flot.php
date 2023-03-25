<?php 
session_start();

if(!isset($_SESSION['entrance']) || empty($_SESSION['entrance'])){
    header("Location: index.php");
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

    <link href="../browser-components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/timeline.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../browser-components/morrisjs/morris.css" rel="stylesheet">
    <link href="../browser-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">
        <div id="target1"></div>
        <?php include('includes/nav-bar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="main.php">Dashboard</a>
                        </li>
                        <li>
                            <a href="students.php"> Students</a>
                        </li>
                        <li class="active">
                            Exam Result
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-md-12">
                    <div class="col-lg-8">
                        <a onclick="refresh()" class="btn btn-primary">Refresh</a>
                        <a onclick="printToPrinter()" class="btn btn-success">Print</a>
                    </div>
                </div> -->
                <hr>
            </div>
            <div class="row">             
                <div class="col-lg-12">
                    <div class="panel panel-default">
                         <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
                        <div class="panel-body" id="printTable">
                            <h1 class="text-center">Examination Result</h1>
                            <br>
                            <p class="lead"><strong>NAME: </strong><span id="StudentName"></span></p>
                            <hr>
                            <div id="result_summary">
                            </div>
                            <hr>
                            <div class="dataTable_wrapper" id="wrapTable"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../browser-components/notifyjs/dist/notify.js"></script>
    <script src="../browser-components/notifyjs/dist/styles/bootstrap/notify-bootstrap.js"></script>
    <script src="../browser-components/spin.js/spin.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/pages/print.js"></script>
    <script src="../js/pages/results.js"></script>
</body>
</html>