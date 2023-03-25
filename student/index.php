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
            <h1 class="text-center"><strong>HELLO STUDENT</strong></h1>
            <br>
            <a href="login.php" class="btn btn-primary btn-lg btn-block">LOGIN</a>
            <br>
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
