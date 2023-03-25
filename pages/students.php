<?php 
session_start();

if(!isset($_SESSION['entrance']) || empty($_SESSION['entrance'])){
    header("Location: index.php");
}
else if(isset($_SESSION['Level']) === "Student"){
    header("Location: questions.php");
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
    <link href="../browser-components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../browser-components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../browser-components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
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
                        <li class="active">
                            Examinee
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-inline form-padding">
                        <form id="frmSearch" role="form">
                            <!-- <a onclick="create_student()" class="btn btn-primary">Add Student</a> -->
                            <a href="ae_student.php" class="btn btn-primary">Add Examinee</a>
                        </form>
                    </div>
                    <br>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            List of Examinee
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover paginated tablesorter" id="tbl_students">
                                    <thead>
                                        <tr>
                                            <th>Fullname</th>
                                            <th>Mobile No</th>
                                            <th>Gender</th>
                                            <th>Birthday</th>
                                            <th>Pref. Course</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="searchable"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('modals/bulkstudent.php'); ?>
        <?php include('modals/student.php'); ?>
        <?php include('modals/editStudent.php'); ?>
        <?php include('modals/keyStudent.php'); ?>
    </div>
    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/jquery.tablesorter/dist/js/jquery.tablesorter.js"></script>
    <script src="../browser-components/jquery.tablesorter/dist/js/jquery.tablesorter.widgets.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../browser-components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../browser-components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../browser-components/notifyjs/dist/notify.js"></script>
    <script src="../browser-components/notifyjs/dist/styles/bootstrap/notify-bootstrap.js"></script>
    <script src="../browser-components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
    <script src="../browser-components/spin.js/spin.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/pages/student.js"></script>
</body>
</html>