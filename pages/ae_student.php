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
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../browser-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">
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
                            <a href="students.php"> Examinee</a>
                        </li>
                        <li class="active">
                           Add Examinee
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Add Examinee
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form">
                                        <input type="hidden" name="id" />
                                        <div class="form-group">
                                            <input type="hidden" name="id" id="id"/>
                                            <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
                                            <label>Examinee ID</label>
                                            <input type="text" class="form-control" name="studid" id="studid" placeholder="Examinee ID" />
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="fname" id="fname" placeholder="Firstname" />
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Lastname" />
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" />
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile No.</label>
                                            <input type="text" class="form-control" name="mobileno" id="mobileno" placeholder="Mobile No" />
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Birthdate</label>
                                            <input type="date" class="form-control" name="birthdate" id="birthdate"/>
                                            <span class="help-inline"></span>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Date Graduated</label>
                                            <input type="date" class="form-control" name="graduated" id="graduated"/>
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Last School Attended</label>
                                            <input type="text" class="form-control" name="last_school" id="last_school" placeholder="Last School Attended" />
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Preferred Course</label>
                                            <select class="form-control" id="pref_course" name="pref_course">
                                            </select>
                                            <span class="help-inline"></span>
                                        </div> -->
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Date Graduated</label>
                                            <input type="date" class="form-control" name="graduated" id="graduated"/>
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Last School Attended</label>
                                            <input type="text" class="form-control" name="last_school" id="last_school" placeholder="Last School Attended" />
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Preferred Course</label>
                                            <select class="form-control" id="pref_course" name="pref_course">
                                            </select>
                                            <span class="help-inline"></span>
                                        </div>
                                        <label>Username</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" id="username" placeholder="Username">
                                        </div>
                                        <span class="help-inline"></span>
                                        <label>Password</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">*</span>
                                            <input type="password" class="form-control" id="password"  placeholder="Password">
                                        </div>
                                        <span class="help-inline"></span>
                                        <label>Confirm Password</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">*</span>
                                            <input type="password" class="form-control" id="password2" placeholder="Confirm Password" />
                                        </div>
                                        <span class="help-inline"></span>
                                    </form>
                                    <a id="btn-save" class="btn btn-primary" onclick="save()">Submit</a>
                                    <a href="javascript:clear();" class="btn btn-warning">Delete</a>
                                </div>
                            </div>
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
    <script src="../js/pages/student2.js"></script>
</body>
</html>