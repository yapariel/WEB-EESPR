<?php 
session_start();

// if(!isset($_SESSION['entrance_student_visited']) || empty($_SESSION['entrance_student_visited'])){
//     $_SESSION['entrance_student_visited'] = true;
//     echo "<script>alert('Please change your password before taking the exam. Go to Profile and click Update Account')</script>";
// }

if(!isset($_SESSION['entrance_student']) || empty($_SESSION['entrance_student'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include('includes/head.php'); ?>
<link href="../dist/css/homemade.css" rel="stylesheet">
</head>

<body>
    <?php include('includes/nav1.php'); ?>
    <div class="container">
        <div class="starter-template">
            <br>
            <h1 class="text-center"><strong>READY TO TAKE THE EXAM?</strong></h1>
            <br>
            <a href="lessons.php" class="btn btn-primary btn-lg btn-block"><strong>TAKE EXAM</strong></a>
            <a href="profile.php" class="btn btn-primary btn-lg btn-block"><strong>PROFILE</strong></a>
            <a href="logout.php" class="btn btn-danger btn-lg btn-block"><strong>LOGOUT</strong></a>
        </div>
    </div>

    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/ripples.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/material.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
        $(function() {
            $.material.init();
        });
    </script>
</body>
<?php include('includes/footer.php'); ?>
</html>
