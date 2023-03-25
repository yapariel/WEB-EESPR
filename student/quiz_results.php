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
    <div class="container">
        <div class="starter-template">
            <h1 class="text-center">RESULT</h1>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive bg-primary">
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
            <table class="table table-hover table-bordered" id="tblResults">
                <thead class="bg-primary" style="font-size:1.5em;">
                    <tr>
                        <th>#</th>
                        <th class="text-center">Question</th>
                        <th class="text-center">Your Answer</th>
                        <th class="text-center">Correct Answer</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/ripples.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/material.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../browser-components/spin.js/spin.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/student/quiz_results.js" type="text/javascript"></script>
</body>
<?php include('includes/footer.php'); ?>
</html>
