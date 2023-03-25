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

    <?php include('includes/nav1.php'); ?>
    <div id="target1"></div>
    <div class="alert alert-danger" role="alert" id="notification">
        <!-- <a href="javascript:window.history.back();" class="close"></a> -->
         <button type="button" class="close" onclick="javascript:window.history.back();" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> No questions in this lesson!
    </div>
    <div class="alert alert-warning offset-client" role="alert" id="timer">
        <div class="offset" id="countdown"></div>
    </div>
    <div class="container">
        <form class="form-horizontal">
            <input type="hidden" id="category_id" name="category_id" />
            <input type="hidden" id="time_limit" name="hidden" value="2" />
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
            <div class="main"></div>
            <div class="col-lg-12">
                <button type="button" id="prev" class="btn btn-success btn-lg btn-block hide" disabled>Prev</button>
                <button type="button" id="next" class="btn btn-success btn-lg btn-block">Next</button>
                <button type="button" class="btn btn-success confirmend btn-lg btn-block hide" name="submit">Submit Answer</button>
            </div>
        </form>
    </div>

    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/ripples.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/material.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../browser-components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
    <script src="../browser-components/spin.js/spin.js"></script>
    <script src="../browser-components/notifyjs/dist/notify.js"></script>
    <script src="../browser-components/notifyjs/dist/styles/bootstrap/notify-bootstrap.js"></script>
    <script src="../browser-components/jquery.countdown/dist/jquery.countdown.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/student/quiz.js" type="text/javascript"></script>
</body>
</html>
