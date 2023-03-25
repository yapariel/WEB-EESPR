<?php 
session_start();

if(!isset($_SESSION['entrance_student']) || empty($_SESSION['entrance_student'])){
    header("Location: login.php");
}
?>


<head>
<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>
<link href="../dist/css/homemade.css" rel="stylesheet">
</head>

<body>

    <?php include('includes/nav3.php'); ?>
    <div id="target1"></div>
    <div class="container">
        <div class="starter-template">
            <h1 class="text-center"><strong>COURSE RECOMMENDATION</strong></h1>
            <p class="lead" style="text-align:center;">By checking and reviewing of your examination results. You are qualified to enroll with this following courses</p>
        </div>
        <h3 style="text-align:center;" class="text-left text-danger" id="suggest_course"></h3>
    </div>
    <div class="container">
        <div class="table-responsive bg-primary">
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
            <table class="table table-hover table-bordered" id="tblResults">
                <thead class="bg-primary" style="font-size:1.5em;">
                    <tr>
                        <th>#</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Score</th>
                        <th class="text-center">%</th>
                        <th class="text-center">Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="clearfix"></div>
        <br>
        <a href="profile.php" class="btn btn-primary btn-lg btn-block">BACK TO PROFILE</a>
        <a href="logout.php" class="btn btn-danger btn-lg btn-block">Logout</a>
    </div>
    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/ripples.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/material.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../browser-components/spin.js/spin.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/student/results.js" type="text/javascript"></script>
</body>
<?php include('includes/footer.php'); ?>
</html>