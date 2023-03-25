<?php 
session_start();

if(!isset($_SESSION['entrance_student']) || empty($_SESSION['entrance_student'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php include('includes/head.php'); ?>

</head>

<body>
    <?php include('includes/nav3.php'); ?>
    <div id="target1"></div>
    <div class="jumbotron">
        <h1 class="text-center"><strong>DETAILED RESULTS</strong></h1>
        <p class="text-center">View detailed results on each category</p>
    </div>
    <div class="container">
        <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
        <div id="lessons"></div>
    </div>

    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/ripples.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/material.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../browser-components/spin.js/spin.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/student/category.js" type="text/javascript"></script>
</body>
</html>
