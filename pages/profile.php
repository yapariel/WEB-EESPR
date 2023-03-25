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
                        <li class="active">
                           Manage Profile
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Admin Profile
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs" role="tablist" id="myTabs">                                    
                                <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Security</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="profile">
                                    <br>
                                    <form role="form"  id="frmProfile" class="padding-top">
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['entrance']['id'];?>">
                                        <input type="hidden" name="csrf" value="<?php echo $_SESSION['form_token'];?>">
                                        <div class="form-group col-md-6" >
                                            <label>First Name</label>
                                            <input class="form-control" type="text" name="fname" id="fname" placeholder="First Name"/>
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name</label>
                                            <input class="form-control" type="text" name="lname" id="lname" placeholder="Last Name"/ >
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" id= "email" placeholder="Email Address"/>
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile No.</label>
                                            <input class="form-control" type="text" name="mobileno" id="mobileno" placeholder="Mobile No."/>
                                            <span class="help-inline"></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <a id="btn-save" class="btn btn-primary" onclick="saveProfile()">Update</a>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Clear</button>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="settings">
                                    <br>
                                    <form role="form"  id="frmAccount" class="padding-top">
                                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['entrance']['id'];?>">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                                <input class="form-control" type="text" name="username" id="username" placeholder="Username" />
                                                <span class="help-inline"></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" />
                                                    <span class="help-inline"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Confirm Password</label>
                                                    <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm Password" />
                                                    <span class="help-inline"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <a id="btn-save" class="btn btn-primary" onclick="saveAccount()">Update</a>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Clear</button>
                                        </div>
                                    </form>                                        
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
    <script src="../browser-components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
    <script src="../browser-components/spin.js/spin.js"></script>
    <script src="../js/pages/profile.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
</body>
</html>
