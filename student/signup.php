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

    <link href="../dist/css/homemade2.css" rel="stylesheet">
    <?php include('includes/head.php'); ?>

</head>
<body>
    <?php include('includes/nav3.php'); ?>
    <div class="jumbotron">
        <form class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <label for="studid" class="col-lg-3 control-label">Student ID</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="studid" placeholder="Student ID">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fname" class="col-lg-3 control-label">Firstname</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="fname" placeholder="Firstname">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-lg-3 control-label">Lastname</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="lname" placeholder="Lastname">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-lg-3 control-label">Username</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="username" placeholder="Username">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-3 control-label">Email</label>
                    <div class="col-lg-9">
                        <input type="email" class="form-control" id="email" placeholder="Email Address">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobileno" class="col-lg-3 control-label">Mobile No.</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="mobileno" placeholder="Mobile No.">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobileno" class="col-lg-3 control-label">Gender</label>
                    <div class="col-lg-9">
                        <select class="form-control" id="gender" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobileno" class="col-lg-3 control-label">Address</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="address" placeholder="Address">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobileno" class="col-lg-3 control-label">Birthdate</label>
                    <div class="col-lg-9">
                        <input type="date" class="form-control" id="birthdate">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobileno" class="col-lg-3 control-label">Graduated School</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="gradschool" placeholder="Graduated School">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobileno" class="col-lg-3 control-label">Date Graduated</label>
                    <div class="col-lg-9">
                        <input type="date" class="form-control" id="graduated">
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobileno" class="col-lg-3 control-label">Pref. Course</label>
                    <div class="col-lg-9">
                        <select class="form-control" id="course" name="course">
                        </select>
                        <span class="help-inline"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a class="btn btn-primary" onclick="save()">Register</a>
                        <a class="btn btn-warning" onclick="clearFields()">Cancel</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <script src="../browser-components/jquery/dist/jquery.min.js"></script>
    <script src="../browser-components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/ripples.min.js"></script>
    <script src="../browser-components/bootstrap-material-design/dist/js/material.min.js"></script>
    <script src="../browser-components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../browser-components/notifyjs/dist/notify.js"></script>
    <script src="../browser-components/notifyjs/dist/styles/bootstrap/notify-bootstrap.js"></script>
    <script src="../js/student/register.js" type="text/javascript"></script>
    <script src="../dist/js/sb-admin-2.js">

    </script>
    <script type="text/javascript">
        $(function() {
            $.material.init();
        });
    </script>
</body>
</html>